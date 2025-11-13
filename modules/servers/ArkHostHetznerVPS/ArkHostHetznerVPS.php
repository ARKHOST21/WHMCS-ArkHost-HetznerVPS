<?php
/**
 *	WHMCS Server Module - Hetzner VPS
 *
 *	@package     WHMCS
 *	@version     1.2.1
 *	@copyright   Copyright (c) ArkHost 2025
 *	@author      ArkHost <support@arkhost.com>
 *  @link        https://arkhost.com
 */

if (!defined('WHMCS')) {
    http_response_code(403);
    exit('Access denied');
}

use WHMCS\Config\Setting;
use WHMCS\Database\Capsule;

function ArkHostHetznerVPS_GetVPSID(array $params) {
    // Check if we have model (new way) - ArkHostHetznerVPS format
    if (isset($params['model']) && is_object($params['model']) && isset($params['model']->serviceProperties)) {
        // Try our new format first
        $vpsId = $params['model']->serviceProperties->get('ArkHostHetznerVPS|VPS ID');
        if ($vpsId) {
            return str_replace(['ArkHostHetznerVPS-', 'VPS-'], '', $vpsId);
        }
        
        // Try ModulesGarden format for migration compatibility
        $serverId = $params['model']->serviceProperties->get('serverID|Server ID');
        if ($serverId) {
            return str_replace(['server-', 'Server-'], '', $serverId);
        }
    }
    
    // Check if we have customfields (alternative way)
    if (isset($params['customfields']) && is_array($params['customfields'])) {
        foreach ($params['customfields'] as $field => $value) {
            // Check for our new format: ArkHostHetznerVPS|VPS ID
            if (stripos($field, 'ArkHostHetznerVPS') !== false && stripos($field, 'VPS ID') !== false) {
                return str_replace(['ArkHostHetznerVPS-', 'VPS-'], '', $value);
            }
            
            // Check for ModulesGarden format: serverID|Server ID (MIGRATION COMPATIBILITY)
            if (stripos($field, 'serverID') !== false && stripos($field, 'Server ID') !== false) {
                return str_replace(['server-', 'Server-'], '', $value);
            }
            
            // Fallback: any field containing VPS ID
            if (stripos($field, 'VPS ID') !== false && !empty($value)) {
                return str_replace(['ArkHostHetznerVPS-', 'VPS-', 'server-', 'Server-'], '', $value);
            }
        }
    }
    
    // For ModulesGarden migration - check if server ID is in domain field
    if (isset($params['domain']) && is_numeric($params['domain'])) {
        return $params['domain'];
    }
    
    // For ModulesGarden migration - check username field
    if (isset($params['username']) && is_numeric($params['username'])) {
        return $params['username'];
    }
    
    // Check customfields for any numeric server ID (broader compatibility)
    if (isset($params['customfields']) && is_array($params['customfields'])) {
        foreach ($params['customfields'] as $field => $value) {
            // ModulesGarden might store it as "Server ID" or similar
            if ((stripos($field, 'server') !== false || stripos($field, 'vps') !== false) && is_numeric($value)) {
                return $value;
            }
        }
    }
    
    // Check if there's a dedicatedip field with server ID (some modules use this)
    if (isset($params['dedicatedip']) && preg_match('/(\d{6,})/', $params['dedicatedip'], $matches)) {
        return $matches[1];
    }
    
    return null;
}

function ArkHostHetznerVPS_GetConfigurableOption(array $params, $optionName) {
    // Check for WHMCS Configurable Options (add-ons) that customer has ordered
    if (isset($params['configoptions']) && is_array($params['configoptions'])) {
        foreach ($params['configoptions'] as $optName => $optValue) {
            // Check if option name contains the floating IP identifier
            if (stripos($optName, $optionName) !== false && !empty($optValue)) {
                return $optValue;
            }
        }
    }
    
    // Also check by option ID if available
    if (isset($params['configoptionshash']) && is_array($params['configoptionshash'])) {
        foreach ($params['configoptionshash'] as $optId => $optValue) {
            if (stripos($optId, $optionName) !== false && !empty($optValue)) {
                return $optValue;
            }
        }
    }
    
    return null;
}

function ArkHostHetznerVPS_API(array $params) {
    $url = 'https://api.hetzner.cloud/v1/';
    $data = [];
    $method = '';

    switch ($params['action']) {
        case 'Test':
            $url .= 'server_types?per_page=1';
            $method = 'GET';
            break;
            
        case 'Packages':
            $url .= 'server_types?per_page=50';
            $method = 'GET';
            break;

        case 'Operating Systems':
            $url .= 'images?type=system&per_page=50';
            $method = 'GET';
            break;
            
        case 'Datacenters':
            $url .= 'datacenters';
            $method = 'GET';
            break;
            
        case 'Upgrades':
            // Not supported in Hetzner API
            return array();
            break;

        case 'Discount':
            // Hetzner doesn't have a discount endpoint, return dummy data
            return array('percent' => 0);
            break;

        case 'Balance':
            // Hetzner doesn't have a balance endpoint, return dummy data
            return array('balance' => 'N/A');
            break;
           
        case 'Order':
            $url .= 'servers';
            $method = 'POST';
            
            $data = array(
                'name' => $params['domain'] ?? 'vps-' . time(),
                'server_type' => ArkHostHetznerVPS_GetOption($params, 'planid'),
                'image' => ArkHostHetznerVPS_GetOption($params, 'osid'),
                'start_after_create' => true,
                'labels' => array(
                    'whmcs_service_id' => (string)$params['serviceid'],
                    'whmcs_user_id' => (string)$params['userid']
                )
            );
            
            // Add datacenter if specified
            $datacenter = ArkHostHetznerVPS_GetOption($params, 'datacenter');
            if ($datacenter) {
                $data['datacenter'] = $datacenter;
            }
            
            // Handle backups
            if (ArkHostHetznerVPS_GetOption($params, 'backups') === 'on') {
                $data['automount'] = false;
                $data['backups'] = true;
            }
            
            // Handle IPv6
            if (ArkHostHetznerVPS_GetOption($params, 'ipv6') === 'on') {
                $data['enable_ipv6'] = false;
            }

            // Handle Cloud-Init user_data if provided
            $cloudInitYaml = ArkHostHetznerVPS_GetOption($params, 'cloud_init_yaml');
            if ($cloudInitYaml && trim($cloudInitYaml) !== '') {
                // Basic YAML validation - check if it starts with #cloud-config
                $trimmedYaml = trim($cloudInitYaml);
                if (strpos($trimmedYaml, '#cloud-config') !== 0) {
                    // Auto-prepend #cloud-config if missing
                    $cloudInitYaml = "#cloud-config\n" . $cloudInitYaml;
                }

                // Pass as plain text - Hetzner API accepts user_data as plain string (max 32KiB)
                $data['user_data'] = $cloudInitYaml;
            }

            // Handle SSH keys from custom field if needed
            // This would need to be implemented with a custom field
            break;

        case 'Server Info':
            $url .= 'servers/' . ArkHostHetznerVPS_GetVPSID($params);
            $method = 'GET';
            break;
        
        case 'Label':
            $url .= 'servers/' . ArkHostHetznerVPS_GetVPSID($params);
            $method = 'PUT';
            $data = array(
                'name' => $params['label'],
            );
            break;

        case 'Graphs':
            // Hetzner metrics endpoint requires specific format
            $serverId = ArkHostHetznerVPS_GetVPSID($params);
            
            // Determine time range based on period
            $period = $params['time'] ?? 'day';
            $end = time();
            switch ($period) {
                case 'hour':
                    $start = $end - 3600; // 1 hour
                    $step = 60; // 1 minute intervals
                    break;
                case 'day':
                    $start = $end - 86400; // 24 hours
                    $step = 300; // 5 minute intervals
                    break;
                case 'week':
                    $start = $end - 604800; // 7 days
                    $step = 1800; // 30 minute intervals
                    break;
                case 'month':
                    $start = $end - 2592000; // 30 days
                    $step = 7200; // 2 hour intervals
                    break;
                case 'year':
                    $start = $end - 31536000; // 365 days
                    $step = 86400; // 1 day intervals
                    break;
                default:
                    $start = $end - 86400;
                    $step = 300;
            }
            
            // Get all metric types at once
            $metricType = 'cpu,disk,network';
            
            // Format timestamps in ISO-8601 - Hetzner requires specific format without timezone
            $startISO = gmdate('Y-m-d\TH:i:s\Z', $start);
            $endISO = gmdate('Y-m-d\TH:i:s\Z', $end);
            
            $url .= 'servers/' . $serverId . '/metrics?type=' . $metricType . '&start=' . $startISO . '&end=' . $endISO . '&step=' . $step;
            $method = 'GET';
            break;

        case 'Operating Systems - Server':
            $url .= 'images?type=system&per_page=50';
            $method = 'GET';
            break;

        case 'Cancel':
            $url .= 'servers/' . ArkHostHetznerVPS_GetVPSID($params);
            $method = 'DELETE';
            break;

        case 'Stop Cancellation':
            // Not supported in Hetzner API
            return array('success' => true);
            break;

        case 'VNC Console':
            $url .= 'servers/' . ArkHostHetznerVPS_GetVPSID($params) . '/actions/request_console';
            $method = 'POST';
            // No data needed for request_console
            break;

        case 'Reinstall':
            // Rebuild server with new image (destroys all data)
            $url .= 'servers/' . ArkHostHetznerVPS_GetVPSID($params) . '/actions/rebuild';
            $method = 'POST';
            $data = array(
                'image' => $params['os'] // Can be image ID or name (e.g. "ubuntu-20.04")
            );
            break;

        case 'Reboot':
            $url .= 'servers/' . ArkHostHetznerVPS_GetVPSID($params) . '/actions/reboot';
            $method = 'POST';
            break;

        case 'Stop':
            $url .= 'servers/' . ArkHostHetznerVPS_GetVPSID($params) . '/actions/poweroff';
            $method = 'POST';
            break;

        case 'Shutdown':
            $url .= 'servers/' . ArkHostHetznerVPS_GetVPSID($params) . '/actions/shutdown';
            $method = 'POST';
            break;

        case 'Start':
            $url .= 'servers/' . ArkHostHetznerVPS_GetVPSID($params) . '/actions/poweron';
            $method = 'POST';
            break;

        case 'Disable':
            // Use poweroff for disable in Hetzner
            $url .= 'servers/' . ArkHostHetznerVPS_GetVPSID($params) . '/actions/poweroff';
            $method = 'POST';
            break;

        case 'Enable':
            // Use poweron for enable in Hetzner
            $url .= 'servers/' . ArkHostHetznerVPS_GetVPSID($params) . '/actions/poweron';
            $method = 'POST';
            break;

        case 'IPv4 Addresses':
            // Get server info which includes IP addresses
            $url .= 'servers/' . ArkHostHetznerVPS_GetVPSID($params);
            $method = 'GET';
            break;

        case 'Reverse DNS':
            // Hetzner handles rDNS differently
            return array('success' => false, 'message' => 'Not implemented');
            break;

        case 'Addons':
            // Not supported in Hetzner API
            return array();
            break;

        case 'Upgrade':
            // Hetzner requires creating a new server
            return array('success' => false, 'message' => 'Server upgrades not supported');
            break;

        case 'Hostname rDNS':
            // Update server name
            $url .= 'servers/' . ArkHostHetznerVPS_GetVPSID($params);
            $method = 'PUT';
            $data = array(
                'name' => $params['hostname']
            );
            break;

        case 'Create backup':
            // Create manual backup (still type=backup, but with distinct description)
            $url .= 'servers/' . ArkHostHetznerVPS_GetVPSID($params) . '/actions/create_image';
            $method = 'POST';
            $data = array(
                'description' => 'Manual backup - ' . date('Y-m-d H:i:s'),
                'type' => 'backup'
            );
            break;

        case 'Delete backup':
            // Delete image
            $imageId = $params['image_id'] ?? $params['file'] ?? '';
            $url .= 'images/' . $imageId;
            $method = 'DELETE';
            break;

        case 'List backups':
            // List images of type backup
            $url .= 'images?type=backup&bound_to=' . ArkHostHetznerVPS_GetVPSID($params);
            $method = 'GET';
            break;

        case 'Restore backup':
            // Rebuild from image
            $url .= 'servers/' . ArkHostHetznerVPS_GetVPSID($params) . '/actions/rebuild';
            $method = 'POST';
            $data = array(
                'image' => $params['image_id'] ?? $params['file'] ?? ''
            );
            break;

        case 'Get Firewall rules':
            // Get server info first to find attached firewalls
            $serverId = ArkHostHetznerVPS_GetVPSID($params);
            $url .= 'servers/' . $serverId;
            $method = 'GET';
            break;

        case 'List Firewalls':
            // List all available firewalls
            $url .= 'firewalls';
            $method = 'GET';
            break;

        case 'Create Firewall':
            $url .= 'firewalls';
            $method = 'POST';
            $data = array(
                'name' => $params['name'] ?? 'firewall-' . time(),
                'rules' => isset($params['rules']) ? $params['rules'] : array()
            );
            break;

        case 'Apply Firewall':
            $url .= 'firewalls/' . $params['firewall_id'] . '/actions/apply_to_resources';
            $method = 'POST';
            $serverId = ArkHostHetznerVPS_GetVPSID($params);
            $data = array(
                'apply_to' => array(
                    array(
                        'type' => 'server',
                        'server' => array(
                            'id' => intval($serverId)
                        )
                    )
                )
            );
            break;
        case 'Get Firewall Details':
            $url .= 'firewalls/' . $params['firewall_id'];
            $method = 'GET';
            break;
        case 'Update Firewall Rules':
            $url .= 'firewalls/' . $params['firewall_id'] . '/actions/set_rules';
            $method = 'POST';
            $data = array(
                'rules' => $params['rules']
            );
            break;

        case 'Remove Firewall':
            $url .= 'firewalls/' . $params['firewall_id'] . '/actions/remove_from_resources';
            $method = 'POST';
            $data = array(
                'remove_from' => array(
                    array(
                        'type' => 'server', 
                        'server' => ArkHostHetznerVPS_GetVPSID($params)
                    )
                )
            );
            break;

        case 'Add Firewall rules':
            // For Hetzner, we need to check if a firewall exists, create one if not, then update rules
            $serverId = ArkHostHetznerVPS_GetVPSID($params);
            
            // First, get server info to check if firewall is attached
            $serverParams = $params;
            $serverParams['action'] = 'Server Info';
            $serverInfo = ArkHostHetznerVPS_API($serverParams);
            
            $firewallId = null;
            if (isset($serverInfo['server']['public_net']['firewalls']) && !empty($serverInfo['server']['public_net']['firewalls'])) {
                // Use existing firewall
                $firewallId = $serverInfo['server']['public_net']['firewalls'][0]['id'];
                
                // Get current firewall rules
                $firewallParams = $params;
                $firewallParams['action'] = 'Get Firewall Details';
                $firewallParams['firewall_id'] = $firewallId;
                $firewallDetails = ArkHostHetznerVPS_API($firewallParams);
                
                $existingRules = isset($firewallDetails['firewall']['rules']) ? $firewallDetails['firewall']['rules'] : array();
            } else {
                // No firewall attached, create one
                $createParams = $params;
                $createParams['action'] = 'Create Firewall';
                // Simple unique name
                $createParams['name'] = 'server-' . $serverId . '-' . time();
                $createParams['rules'] = array();
                
                try {
                    $createResult = ArkHostHetznerVPS_API($createParams);
                } catch (Exception $e) {
                    // If name is still not unique, try with random suffix
                    if (strpos($e->getMessage(), 'uniqueness_error') !== false || strpos($e->getMessage(), 'name is already used') !== false) {
                        $createParams['name'] = 'firewall-server-' . $serverId . '-' . time() . '-' . rand(1000, 9999);
                        $createResult = ArkHostHetznerVPS_API($createParams);
                    } else {
                        throw $e;
                    }
                }
                $firewallId = $createResult['firewall']['id'];
                
                // Attach firewall to server
                $attachParams = $params;
                $attachParams['action'] = 'Apply Firewall';
                $attachParams['firewall_id'] = $firewallId;
                $attachResult = ArkHostHetznerVPS_API($attachParams);
                
                // Wait a moment for the firewall to be applied
                sleep(2);
                
                // Verify the firewall was attached
                $verifyParams = $params;
                $verifyParams['action'] = 'Server Info';
                $verifyInfo = ArkHostHetznerVPS_API($verifyParams);
                
                // Check if firewall is actually attached
                if (!isset($verifyInfo['server']['public_net']['firewalls']) || 
                    empty($verifyInfo['server']['public_net']['firewalls']) || 
                    $verifyInfo['server']['public_net']['firewalls'][0]['id'] != $firewallId) {
                    // Try to attach again if it failed
                    $attachParams = $params;
                    $attachParams['action'] = 'Apply Firewall';
                    $attachParams['firewall_id'] = $firewallId;
                    ArkHostHetznerVPS_API($attachParams);
                }
                
                $existingRules = array();
            }
            
            // Add new rule to existing rules
            // Handle protocol - Hetzner API doesn't accept "ANY", we need to create multiple rules
            $protocol = strtolower($params['protocol']);
            $rulesToAdd = array();
            
            if ($protocol === 'any') {
                // Create rules for tcp and udp when "ANY" is selected
                $protocols = array('tcp', 'udp');
                foreach ($protocols as $proto) {
                    $rule = array(
                        'direction' => isset($params['direction']) ? $params['direction'] : 'in',
                        'protocol' => $proto,
                    );
                    
                    // Handle IPs - use source_ips for inbound, destination_ips for outbound
                    $direction = isset($params['direction']) ? $params['direction'] : 'in';
                    if (!empty($params['source']) && $params['source'] !== 'Any') {
                        $sourceIp = trim($params['source']);
                        // If no CIDR notation, add /32 for IPv4 or /128 for IPv6
                        if (strpos($sourceIp, '/') === false) {
                            if (filter_var($sourceIp, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
                                $sourceIp .= '/128';
                            } else {
                                $sourceIp .= '/32';
                            }
                        }
                        if ($direction === 'out') {
                            $rule['destination_ips'] = array($sourceIp);
                            $rule['source_ips'] = array();
                        } else {
                            $rule['source_ips'] = array($sourceIp);
                            $rule['destination_ips'] = array();
                        }
                    } else {
                        // For "Any" or empty, use 0.0.0.0/0 and ::/0 for all IPs
                        if ($direction === 'out') {
                            $rule['destination_ips'] = array('0.0.0.0/0', '::/0');
                            $rule['source_ips'] = array();
                        } else {
                            $rule['source_ips'] = array('0.0.0.0/0', '::/0');
                            $rule['destination_ips'] = array();
                        }
                    }
                    
                    // Handle port - Hetzner expects port as a string
                    if (!empty($params['port'])) {
                        $rule['port'] = strval($params['port']);
                    }
                    
                    $rulesToAdd[] = $rule;
                }
            } else {
                // Single protocol rule
                $newRule = array(
                    'direction' => isset($params['direction']) ? $params['direction'] : 'in',
                    'protocol' => $protocol,
                );
                
                // Handle IPs - use source_ips for inbound, destination_ips for outbound
                $direction = isset($params['direction']) ? $params['direction'] : 'in';
                if (!empty($params['source']) && $params['source'] !== 'Any') {
                    $sourceIp = trim($params['source']);
                    // If no CIDR notation, add /32 for IPv4 or /128 for IPv6
                    if (strpos($sourceIp, '/') === false) {
                        if (filter_var($sourceIp, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
                            $sourceIp .= '/128';
                        } else {
                            $sourceIp .= '/32';
                        }
                    }
                    if ($direction === 'out') {
                        $newRule['destination_ips'] = array($sourceIp);
                        $newRule['source_ips'] = array();
                    } else {
                        $newRule['source_ips'] = array($sourceIp);
                        $newRule['destination_ips'] = array();
                    }
                } else {
                    // For "Any" or empty, use 0.0.0.0/0 and ::/0 for all IPs
                    if ($direction === 'out') {
                        $newRule['destination_ips'] = array('0.0.0.0/0', '::/0');
                        $newRule['source_ips'] = array();
                    } else {
                        $newRule['source_ips'] = array('0.0.0.0/0', '::/0');
                        $newRule['destination_ips'] = array();
                    }
                }
                
                // Handle port - Hetzner expects port as a string
                if (!empty($params['port']) && $protocol !== 'icmp') {
                    $newRule['port'] = strval($params['port']);
                }
                
                $rulesToAdd[] = $newRule;
            }
            
            // Add the new rules to existing rules
            // Note: Hetzner only supports ACCEPT rules for inbound traffic
            // The default policy is DROP for non-matched traffic
            foreach ($rulesToAdd as $ruleToAdd) {
                $existingRules[] = $ruleToAdd;
            }
            
            // Update firewall with new rules
            $updateParams = $params;
            $updateParams['action'] = 'Update Firewall Rules';
            $updateParams['firewall_id'] = $firewallId;
            $updateParams['rules'] = $existingRules;
            
            ArkHostHetznerVPS_API($updateParams);
            
            return array('success' => true, 'message' => 'Firewall rule added successfully');
            break;

        case 'Delete Firewall rule':
            // For Hetzner, we need to get all rules, remove the one, and update
            $serverId = ArkHostHetznerVPS_GetVPSID($params);
            
            // Get server info to find attached firewall
            $serverParams = $params;
            $serverParams['action'] = 'Server Info';
            $serverInfo = ArkHostHetznerVPS_API($serverParams);
            
            if (!isset($serverInfo['server']['public_net']['firewalls']) || empty($serverInfo['server']['public_net']['firewalls'])) {
                return array('success' => false, 'message' => 'No firewall attached to this server');
            }
            
            $firewallId = $serverInfo['server']['public_net']['firewalls'][0]['id'];
            
            // Get current firewall rules
            $firewallParams = $params;
            $firewallParams['action'] = 'Get Firewall Details';
            $firewallParams['firewall_id'] = $firewallId;
            $firewallDetails = ArkHostHetznerVPS_API($firewallParams);
            
            $existingRules = isset($firewallDetails['firewall']['rules']) ? $firewallDetails['firewall']['rules'] : array();
            $newRules = array();
            
            // Remove the rule with matching ID (we use index as ID)
            $ruleIdToDelete = $params['rule_id'];
            $inIndex = 0;
            $outIndex = 0;
            foreach ($existingRules as $rule) {
                if ($rule['direction'] === 'in') {
                    if ('fw_' . $firewallId . '_in_' . $inIndex != $ruleIdToDelete) {
                        $newRules[] = $rule;
                    }
                    $inIndex++;
                } else if ($rule['direction'] === 'out') {
                    if ('fw_' . $firewallId . '_out_' . $outIndex != $ruleIdToDelete) {
                        $newRules[] = $rule;
                    }
                    $outIndex++;
                } else {
                    // Keep other rules
                    $newRules[] = $rule;
                }
            }
            
            // Update firewall with remaining rules
            $updateParams = $params;
            $updateParams['action'] = 'Update Firewall Rules';
            $updateParams['firewall_id'] = $firewallId;
            $updateParams['rules'] = $newRules;
            
            ArkHostHetznerVPS_API($updateParams);
            
            return array('success' => true, 'message' => 'Firewall rule deleted successfully');
            break;

        case 'Commit Firewall rules':
            // Not applicable for Hetzner - changes are immediate
            return array('success' => true, 'message' => 'Firewall changes are applied immediately in Hetzner');
            break;

        case 'ISO Images':
            $url .= 'isos';
            $method = 'GET';
            break;

        case 'Load ISO':
            $url .= 'servers/' . ArkHostHetznerVPS_GetVPSID($params) . '/actions/attach_iso';
            $method = 'POST';
            // Hetzner expects the ISO name, not ID
            $data = array('iso' => $params['iso_id']);
            break;

        case 'Eject ISO':
            $url .= 'servers/' . ArkHostHetznerVPS_GetVPSID($params) . '/actions/detach_iso';
            $method = 'POST';
            break;

        case 'Reset root':
            $url .= 'servers/' . ArkHostHetznerVPS_GetVPSID($params) . '/actions/reset_password';
            $method = 'POST';
            break;
            
        case 'Server Metrics':
            $url .= 'servers/' . ArkHostHetznerVPS_GetVPSID($params) . '/metrics';
            $method = 'GET';
            break;
            
        case 'Create Snapshot':
            $url .= 'servers/' . ArkHostHetznerVPS_GetVPSID($params) . '/actions/create_image';
            $method = 'POST';
            $data = array(
                'description' => $params['description'] ?? 'Snapshot created on ' . date('Y-m-d H:i:s'),
                'type' => 'snapshot'
            );
            break;
            
        case 'List Snapshots':
            $url .= 'images?type=snapshot&bound_to=' . ArkHostHetznerVPS_GetVPSID($params);
            $method = 'GET';
            break;
            
        case 'Floating IPs':
            $url .= 'floating_ips';
            $method = 'GET';
            break;
            
        case 'Get Floating IP':
            $url .= 'floating_ips/' . $params['floating_ip_id'];
            $method = 'GET';
            break;
            
        case 'Assign Floating IP':
            $url .= 'floating_ips/' . $params['floating_ip_id'] . '/actions/assign';
            $method = 'POST';
            $data = array(
                'server' => ArkHostHetznerVPS_GetVPSID($params)
            );
            break;
            
        case 'Unassign Floating IP':
            $url .= 'floating_ips/' . $params['floating_ip_id'] . '/actions/unassign';
            $method = 'POST';
            break;
            
        case 'Create Floating IP':
            $url .= 'floating_ips';
            $method = 'POST';
            $data = array(
                'type' => $params['ip_type'] ?? 'ipv4',
                'description' => $params['description'] ?? 'Created via WHMCS',
                'labels' => $params['labels'] ?? array(),
                'home_location' => $params['location'] ?? null,
                'server' => isset($params['assign_to_server']) ? ArkHostHetznerVPS_GetVPSID($params) : null
            );
            break;
            
        case 'Delete Floating IP':
            $url .= 'floating_ips/' . $params['floating_ip_id'];
            $method = 'DELETE';
            break;
            
        case 'Update Floating IP':
            $url .= 'floating_ips/' . $params['floating_ip_id'];
            $method = 'PUT';
            $data = array(
                'description' => $params['description'] ?? null,
                'labels' => $params['labels'] ?? null
            );
            break;
            
        case 'Change Floating IP DNS':
            $url .= 'floating_ips/' . $params['floating_ip_id'] . '/actions/change_dns_ptr';
            $method = 'POST';
            $data = array(
                'ip' => $params['ip'],
                'dns_ptr' => $params['dns_ptr']
            );
            break;
            
        case 'Server Actions':
            $url .= 'servers/' . ArkHostHetznerVPS_GetVPSID($params) . '/actions';
            $method = 'GET';
            break;
            
        case 'Change Protection':
            $url .= 'servers/' . ArkHostHetznerVPS_GetVPSID($params) . '/actions/change_protection';
            $method = 'POST';
            $data = array(
                'delete' => isset($params['delete_protection']) ? $params['delete_protection'] : false,
                'rebuild' => isset($params['rebuild_protection']) ? $params['rebuild_protection'] : false
            );
            break;
            
        case 'Rescue Mode':
            $url .= 'servers/' . ArkHostHetznerVPS_GetVPSID($params) . '/actions/enable_rescue';
            $method = 'POST';
            $data = array(
                'type' => $params['rescue_type'] ?? 'linux64',
            );
            break;
            
        case 'Disable Rescue Mode':
            $url .= 'servers/' . ArkHostHetznerVPS_GetVPSID($params) . '/actions/disable_rescue';
            $method = 'POST';
            break;
            
        case 'Enable Backups':
            $url .= 'servers/' . ArkHostHetznerVPS_GetVPSID($params) . '/actions/enable_backup';
            $method = 'POST';
            break;
            
        case 'Disable Backups':
            $url .= 'servers/' . ArkHostHetznerVPS_GetVPSID($params) . '/actions/disable_backup';
            $method = 'POST';
            break;
            
        case 'List Volumes':
            $url .= 'volumes?server=' . ArkHostHetznerVPS_GetVPSID($params);
            $method = 'GET';
            break;
            
        case 'Create Volume':
            $url .= 'volumes';
            $method = 'POST';
            $data = array(
                'size' => $params['size'] ?? 10,
                'name' => $params['name'] ?? 'volume-' . time(),
                'server' => ArkHostHetznerVPS_GetVPSID($params),
                'automount' => isset($params['automount']) ? $params['automount'] : true,
                'format' => $params['format'] ?? 'ext4'
            );
            break;
            
        case 'Attach Volume':
            $url .= 'volumes/' . $params['volume_id'] . '/actions/attach';
            $method = 'POST';
            $data = array(
                'server' => ArkHostHetznerVPS_GetVPSID($params),
                'automount' => isset($params['automount']) ? $params['automount'] : true
            );
            break;
            
        case 'Detach Volume':
            $url .= 'volumes/' . $params['volume_id'] . '/actions/detach';
            $method = 'POST';
            break;
            
        case 'Delete Volume':
            $url .= 'volumes/' . $params['volume_id'];
            $method = 'DELETE';
            break;
            
        case 'List Networks':
            $url .= 'networks';
            $method = 'GET';
            break;
            
        case 'Attach to Network':
            $url .= 'servers/' . ArkHostHetznerVPS_GetVPSID($params) . '/actions/attach_to_network';
            $method = 'POST';
            $data = array(
                'network' => $params['network_id'],
                'ip' => isset($params['ip']) ? $params['ip'] : null,
                'alias_ips' => isset($params['alias_ips']) ? $params['alias_ips'] : array()
            );
            break;
            
        case 'Detach from Network':
            $url .= 'servers/' . ArkHostHetznerVPS_GetVPSID($params) . '/actions/detach_from_network';
            $method = 'POST';
            $data = array(
                'network' => $params['network_id']
            );
            break;

        default:
            throw new Exception('Invalid action: ' . $params['action']);
            break;
    }

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
    curl_setopt($curl, CURLOPT_TIMEOUT, 15);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_POSTREDIR, CURL_REDIR_POST_301);
    curl_setopt($curl, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
            curl_setopt($curl, CURLOPT_USERAGENT, 'ArkHostHetznerVPS WHMCS');
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        'Authorization: Bearer ' . $params['serverpassword'],
        'Content-Type: application/json'
    ));

    if ($method === 'POST' || $method === 'PATCH' || $method === 'PUT') {
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
    }

    $responseData = curl_exec($curl);
    $statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

    $responseData = json_decode($responseData, true);

    if ($statusCode === 0) throw new Exception('cURL Error: ' . curl_error($curl));

    curl_close($curl);

    
    logModuleCall(
                    'ArkHostHetznerVPS',
        $url,
        !empty($data) ? json_encode($data) : '',
        print_r($responseData, true)
    );

    // Hetzner API uses standard HTTP status codes
    if ($statusCode >= 400) {
        $errorMessage = 'Unknown error';
        $errorCode = '';
        
        if (isset($responseData['error'])) {
            $error = $responseData['error'];
            $errorMessage = isset($error['message']) ? $error['message'] : $errorMessage;
            $errorCode = isset($error['code']) ? ' (Code: ' . $error['code'] . ')' : '';
            
            // Add details if available
            if (isset($error['details'])) {
                $details = is_array($error['details']) ? json_encode($error['details']) : $error['details'];
                $errorMessage .= ' - Details: ' . $details;
            }
        }
        
        throw new Exception($errorMessage . $errorCode);
    }

    return $responseData;
}

function ArkHostHetznerVPS_Error($func, $params, Exception $err) {
    logModuleCall('ArkHostHetznerVPS', $func, $params, $err->getMessage(), $err->getTraceAsString());
}

function ArkHostHetznerVPS_MetaData() {
    return array(
        'DisplayName' => 'ArkHost - HetznerVPS',
        'APIVersion' => '1.1',
        'RequiresServer' => true,
    );
}

function ArkHostHetznerVPS_ConfigOptions() {
    $error = array(
        'error' => array(
            'FriendlyName' => 'Error',
            'Description' => 'Please double check if you selected a Server Group and/or your details are correct.',
            'Type' => '',
        ),
    );

    $array = array(
        'planid' => array(
            'FriendlyName' => 'Server Type',
            'Description' => 'The Hetzner server type (Configurable option: planid).',
            'Type' => 'dropdown',
            'Options' => array(),
        ),
        'osid' => array(
            'FriendlyName' => 'Operating System',
            'Description' => 'The Operating System image (Configurable option: osid).',
            'Type' => 'dropdown',
            'Options' => array(),
        ),
        'datacenter' => array(
            'FriendlyName' => 'Datacenter',
            'Description' => 'The datacenter location for the server.',
            'Type' => 'dropdown',
            'Options' => array(),
        ),
        'backups' => array(
            'FriendlyName' => 'Enable Backups',
            'Description' => 'Enable automatic backups (additional cost - billed by Hetzner, ~20% of server price).',
            'Type' => 'yesno',
        ),
        'ipv6' => array(
            'FriendlyName' => 'Disable IPv6',
            'Description' => 'Disable IPv6 for this server.',
            'Type' => 'yesno',
        ),
        'floating_ip_location' => array(
            'FriendlyName' => 'Floating IP Location',
            'Description' => 'Location for floating IPs (same as datacenter)',
            'Type' => 'dropdown',
            'Options' => array(),
        ),
        'create_floating_ip' => array(
            'FriendlyName' => 'Create Floating IP',
            'Description' => 'Automatically create a floating IP when provisioning this server (additional cost - billed by Hetzner).',
            'Type' => 'yesno',
        ),
        'cloud_init_yaml' => array(
            'FriendlyName' => 'Cloud-Init YAML (Optional)',
            'Description' => 'Custom cloud-init configuration in YAML format (max 32KiB). Passed as user_data to Hetzner API during server creation. Leave empty to skip cloud-init. <a href="https://docs.hetzner.cloud/#servers-create-a-server" target="_blank">Documentation</a>',
            'Type' => 'textarea',
            'Rows' => '10',
            'Cols' => '60',
        ),
    );
    
    try {
        if (basename($_SERVER['SCRIPT_NAME'], '.php') === 'configproducts' && ($_REQUEST['action'] === 'module-settings' || $_POST['action'] === 'module-settings')) {
            $id = 0;
            $product = null;
            $serverGroup = 0;

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $id = (int) $_POST['id'];

                $product = Capsule::table('tblproducts')->where('id', $id)->first();
                $serverGroup = (int) $_POST['servergroup'];
            } else {
                $id = (int) $_REQUEST['id'];
        
                $product = Capsule::table('tblproducts')->where('id', $id)->first();
                $serverGroup = (int) $product->servergroup;
            }
            
            // Only proceed if a server group is actually selected
            if ($serverGroup == 0) {
                return $array; // Return basic array structure when no server group selected
            }
            
            $serverGroup = Capsule::table('tblservergroupsrel')->where('groupid', $serverGroup)->first();
            if (!$serverGroup) {
                // Return basic array if server group not found, don't throw exception
                return $array;
            }

            $server = Capsule::table('tblservers')->where('id', $serverGroup->serverid)->first();
            if (!$server) {
                // Return basic array if server not found, don't throw exception
                return $array;
            }
        
            $params = array(
                'serverusername' => $server->username,
                'serverpassword' => decrypt($server->password),
            );
    
            $params['action'] = 'Packages';
            $packageslist = ArkHostHetznerVPS_API($params);
        
            // Hetzner returns server types in 'server_types' array
            if (isset($packageslist['server_types'])) {
                foreach ($packageslist['server_types'] as $package) {
                    $price = isset($package['prices'][0]['price_monthly']['gross']) ? 
                             number_format($package['prices'][0]['price_monthly']['gross'], 2) : '0.00';
                    $array['planid']['Options'] += array(
                        $package['name'] => $package['description'] . ' (€' . $price . '/mo)'
                    );
                }
            }
            
            if ($product->configoption1 == '') return $array;
        
            $params['action'] = 'Operating Systems';
            $params['plan_id'] = $product->configoption1;
            $operatingSystems = ArkHostHetznerVPS_API($params);
        
            // Hetzner returns images in 'images' array
            if (isset($operatingSystems['images'])) {
                foreach ($operatingSystems['images'] as $operatingSystem) {
                    if ($operatingSystem['type'] === 'system' && $operatingSystem['status'] === 'available') {
                        $array['osid']['Options'] += array(
                            $operatingSystem['name'] => $operatingSystem['description'] ?: $operatingSystem['name']
                        );
                    }
                }
            }
            
            // Fetch datacenters
            $params['action'] = 'Datacenters';
            $datacenters = ArkHostHetznerVPS_API($params);
            
            if (isset($datacenters['datacenters'])) {
                foreach ($datacenters['datacenters'] as $datacenter) {
                    $array['datacenter']['Options'] += array(
                        $datacenter['name'] => $datacenter['description'] . ' (' . $datacenter['location']['city'] . ')'
                    );
                    // Also populate floating IP locations
                    $array['floating_ip_location']['Options'] += array(
                        $datacenter['location']['name'] => $datacenter['location']['city'] . ', ' . $datacenter['location']['country']
                    );
                }
            }
        }
    } catch (Exception $err) {
        ArkHostHetznerVPS_Error(__FUNCTION__, $params, $err);

        // Return the basic array structure with error message instead of error array
        // This prevents the fields from disappearing
        return $array;
    }
    
    return $array;
}

function ArkHostHetznerVPS_GetOption(array $params, $id, $default = NULL) {
    $options = ArkHostHetznerVPS_ConfigOptions();

    $friendlyName = $options[$id]['FriendlyName'];

    if (isset($params['configoptions'][$friendlyName]) && $params['configoptions'][$friendlyName] !== '') {
        return $params['configoptions'][$friendlyName];
    } else if (isset($params['configoptions'][$id]) && $params['configoptions'][$id] !== '') {
        return $params['configoptions'][$id];
    } else if (isset($params['customfields'][$friendlyName]) && $params['customfields'][$friendlyName] !== '') {
        return $params['customfields'][$friendlyName];
    } else if (isset($params['customfields'][$id]) && $params['customfields'][$id] !== '') {
        return $params['customfields'][$id];
    }

    $found = false;
    $i = 0;
    
    foreach ($options as $key => $value) {
        $i++;
        if ($key === $id) {
            $found = true;
            break;
        }
    }

    if ($found && isset($params['configoption' . $i]) && $params['configoption' . $i] !== '') {
        return $params['configoption' . $i];
    }

    return $default;
}

function ArkHostHetznerVPS_TestConnection(array $params) {
    $err = '';

    try {
        $params['action'] = 'Test';
        ArkHostHetznerVPS_API($params);
    } catch (Exception $e) {
        ArkHostHetznerVPS_Error(__FUNCTION__, $params, $e);
        $err = 'Received the error: ' . $e->getMessage() . ' Check module debug log for more detailed error.';
    }

    return [
        'success' => $err === '',
        'error' => $err,
    ];
}

function ArkHostHetznerVPS_CreateAccount(array $params) {
    try {
        $params['action'] = 'Order';
        $create = ArkHostHetznerVPS_API($params);

        // Validate Hetzner API response
        if (!is_array($create) || !isset($create['server']['id'])) {
            if (is_array($create)) {
            }
            throw new Exception('Invalid response from API');
        }

        // Store the server ID (using our format)
        $params['model']->serviceProperties->save([
            'ArkHostHetznerVPS|VPS ID' => $create['server']['id'],
        ]);

        // Store the root password if provided
        if (isset($create['root_password'])) {
            Capsule::table('tblhosting')->where('id', $params['serviceid'])->update([
                'password' => encrypt($create['root_password'])
            ]);

            // Save the timestamp when password was set for expiration tracking (72 hours)
            $params['model']->serviceProperties->save([
                'ArkHostHetznerVPS|Password Set Time' => time()
            ]);
        }
        
        // Handle floating IP creation if requested via Configurable Options or Module Settings
        $floatingIpType = ArkHostHetznerVPS_GetConfigurableOption($params, 'floating');
        $createFloatingIP = ArkHostHetznerVPS_GetOption($params, 'create_floating_ip');
        
        if (($floatingIpType && $floatingIpType !== '' && strtolower($floatingIpType) !== 'none') || 
            ($createFloatingIP && $createFloatingIP === 'on')) {
            
            // Determine floating IP type - default to ipv4 if module setting is used
            $ipType = $floatingIpType && $floatingIpType !== '' ? $floatingIpType : 'ipv4';
            try {
                $floatingIpParams = $params;
                $floatingIpParams['action'] = 'Create Floating IP';
                $floatingIpParams['ip_type'] = $ipType;
                $floatingIpParams['location'] = ArkHostHetznerVPS_GetOption($params, 'floating_ip_location');
                $floatingIpParams['description'] = 'Server ID: ' . $create['server']['id'];
                $floatingIpParams['assign_to_server'] = true;
                
                $floatingIp = ArkHostHetznerVPS_API($floatingIpParams);
                
                if (isset($floatingIp['floating_ip']['id'])) {
                               
                    // Store floating IP information
                    $params['model']->serviceProperties->save([
                        'ArkHostHetznerVPS|Floating IP ID' => $floatingIp['floating_ip']['id'],
                        'ArkHostHetznerVPS|Floating IP' => $floatingIp['floating_ip']['ip'],
                    ]);
                }
            } catch (Exception $floatingIpErr) {
                // You might want to send an admin notification here
            }
        }
    } catch (Exception $err) {
        ArkHostHetznerVPS_Error(__FUNCTION__, $params, $err);
        return 'Received the error: ' . $err->getMessage() . ' Check module debug log for more detailed error.';
    }
    
    return 'success';
}

function ArkHostHetznerVPS_SuspendAccount(array $params) {
    try {
        $params['action'] = 'Disable';
        ArkHostHetznerVPS_API($params);
    } catch (Exception $err) {
        ArkHostHetznerVPS_Error(__FUNCTION__, $params, $err);
        return 'Received the error: ' . $err->getMessage() . ' Check module debug log for more detailed error.';
    }

    return 'success';
}

function ArkHostHetznerVPS_UnsuspendAccount(array $params) {
    try {
        $params['action'] = 'Enable';
        ArkHostHetznerVPS_API($params);
    } catch (Exception $err) {
        ArkHostHetznerVPS_Error(__FUNCTION__, $params, $err);
        return 'Received the error: ' . $err->getMessage() . ' Check module debug log for more detailed error.';
    }

    return 'success';
}

function ArkHostHetznerVPS_TerminateAccount(array $params) {
    try {
        // First, check if there's a floating IP to delete
        $floatingIpId = $params['model']->serviceProperties->get('ArkHostHetznerVPS|Floating IP ID');
        if ($floatingIpId) {
            try {
                $floatingIpParams = $params;
                $floatingIpParams['action'] = 'Delete Floating IP';
                $floatingIpParams['floating_ip_id'] = $floatingIpId;
                ArkHostHetznerVPS_API($floatingIpParams);
                
            } catch (Exception $floatingIpErr) {
            }
        }
        
        // Then terminate the server
        $params['action'] = 'Cancel';
        $params['when'] = 'now';
        ArkHostHetznerVPS_API($params);
        
        Capsule::table('tblhosting')->where('id', $params['serviceid'])->update(array(
            'username' => '',
            'password' => '',
        ));
    } catch (Exception $err) {
        ArkHostHetznerVPS_Error(__FUNCTION__, $params, $err);
        return 'Received the error: ' . $err->getMessage() . ' Check module debug log for more detailed error.';
    }

    return 'success';
}



function ArkHostHetznerVPS_ChangePackage(array $params) {
    try {
        $params['action'] = 'Upgrade';
        ArkHostHetznerVPS_API($params);
    } catch (Exception $err) {
        ArkHostHetznerVPS_Error(__FUNCTION__, $params, $err);
        return 'Received the error: ' . $err->getMessage() . ' Check module debug log for more detailed error.';
    }

    return 'success';
}

function ArkHostHetznerVPS_Start(array $params) {
    try {
        $params['action'] = 'Start';
        ArkHostHetznerVPS_API($params);
    } catch (Exception $err) {
        ArkHostHetznerVPS_Error(__FUNCTION__, $params, $err);
        return 'Received the error: ' . $err->getMessage() . ' Check module debug log for more detailed error.';
    }

    return 'success';
}

function ArkHostHetznerVPS_Reboot(array $params) {
    try {
        $params['action'] = 'Reboot';
        ArkHostHetznerVPS_API($params);
    } catch (Exception $err) {
        ArkHostHetznerVPS_Error(__FUNCTION__, $params, $err);
        return 'Received the error: ' . $err->getMessage() . ' Check module debug log for more detailed error.';
    }

    return 'success';
}

function ArkHostHetznerVPS_Stop(array $params) {
    try {
        $params['action'] = 'Stop';
        ArkHostHetznerVPS_API($params);
    } catch (Exception $err) {
        ArkHostHetznerVPS_Error(__FUNCTION__, $params, $err);
        return 'Received the error: ' . $err->getMessage() . ' Check module debug log for more detailed error.';
    }

    return 'success';
}

function ArkHostHetznerVPS_VNC(array $params) {
    try {
        $params['action'] = 'VNC Console';
        $vnc = ArkHostHetznerVPS_API($params);

        // Hetzner returns wss_url and password
        if (isset($vnc['wss_url']) && isset($vnc['password'])) {
            $consoleUrl = $vnc['wss_url'];
            $vncPassword = $vnc['password'];
            
            // Generate a standalone HTML file that can be opened separately
            $html = '<!DOCTYPE html>
<html>
<head>
    <title>VNC Console - ' . htmlspecialchars($params['domain']) . '</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body { margin: 0; background-color: #000; height: 100vh; display: flex; flex-direction: column; font-family: Arial, sans-serif; }
        #top_bar { background-color: #333; color: white; padding: 10px; text-align: center; font-size: 14px; }
        #status { text-align: center; padding: 10px; background: #555; color: white; }
        #screen { flex: 1; display: flex; width: 100%; height: 100%; background: #000; position: relative; }
        #screen canvas { margin: auto; }
        .error { background: #f44336 !important; }
        .warning { background: #ff9800 !important; }
        .success { background: #4CAF50 !important; }
        #noVNC_status_bar { display: none !important; }
    </style>
</head>
<body>
    <div id="top_bar">
        VNC Console - ' . htmlspecialchars($params['domain']) . '
        <div style="font-size: 12px; margin-top: 5px; opacity: 0.8;">
            Password: <span style="font-family: monospace; background: #444; padding: 2px 6px; border-radius: 3px;">' . htmlspecialchars($vncPassword) . '</span>
        </div>
    </div>
    
    <div id="status">Initializing VNC Client...</div>
    <div id="screen"></div>
    
    <script type="module">
        import RFB from "https://cdn.jsdelivr.net/npm/@novnc/novnc@1.4.0/core/rfb.js";
        
        let rfb;
        const url = ' . json_encode($consoleUrl) . ';
        const password = ' . json_encode($vncPassword) . ';
        const statusEl = document.getElementById("status");
        const screenEl = document.getElementById("screen");
        
        function updateStatus(text, type) {
            statusEl.textContent = text;
            statusEl.className = type || "";
            
            if (type === "success") {
                setTimeout(() => {
                    statusEl.style.display = "none";
                }, 3000);
            }
        }
        
        function connect() {
            updateStatus("Connecting to VNC server...", "warning");
            
            try {
                rfb = new RFB(screenEl, url);
                
                rfb.addEventListener("connect", () => {
                    updateStatus("Connected to VNC server", "success");
                    console.log("Connected to VNC server");
                });
                
                rfb.addEventListener("disconnect", (e) => {
                    if (e.detail.clean) {
                        updateStatus("Disconnected from VNC server", "warning");
                    } else {
                        updateStatus("Connection lost - " + (e.detail.reason || "Unknown error"), "error");
                    }
                    console.log("Disconnected:", e.detail);
                });
                
                rfb.addEventListener("credentialsrequired", () => {
                    console.log("Sending credentials...");
                    rfb.sendCredentials({ password: password });
                });
                
                rfb.addEventListener("securityfailure", (e) => {
                    updateStatus("Security failure: " + e.detail.reason, "error");
                    console.error("Security failure:", e.detail);
                });
                
                // Configure RFB settings
                rfb.scaleViewport = true;
                rfb.resizeSession = false;
                rfb.showDotCursor = true;
                rfb.focusOnClick = true;
                
            } catch (exc) {
                updateStatus("Failed to create VNC connection: " + exc.message, "error");
                console.error("Connection error:", exc);
            }
        }
        
        // Start connection when page loads
        window.addEventListener("DOMContentLoaded", () => {
            setTimeout(connect, 100);
        });
    </script>
</body>
</html>';
            
            // Set proper headers to prevent session issues
            header('Content-Type: text/html; charset=utf-8');
            header('Cache-Control: no-cache, no-store, must-revalidate');
            header('Pragma: no-cache');
            header('Expires: 0');
            
            // Output the HTML and exit immediately
            echo $html;
            die();
            
        } else {
            throw new Exception('Console URL not found in response');
        }
    } catch (Exception $err) {
        ArkHostHetznerVPS_Error(__FUNCTION__, $params, $err);
        
        header('Content-Type: text/html; charset=utf-8');
        echo '<!DOCTYPE html>
<html>
<head>
    <title>VNC Console Error</title>
    <style>
        body { margin: 0; font-family: Arial, sans-serif; background: #f5f5f5; display: flex; align-items: center; justify-content: center; height: 100vh; }
        .error-info { background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); text-align: center; max-width: 500px; }
        .error-message { color: #dc3545; margin: 20px 0; }
        .close-btn { display: inline-block; margin-top: 20px; padding: 10px 20px; background: #6c757d; color: white; text-decoration: none; border-radius: 4px; }
        .close-btn:hover { background: #5a6268; color: white; text-decoration: none; }
    </style>
</head>
<body>
    <div class="error-info">
        <h2>VNC Console Error</h2>
        <div class="error-message">' . htmlspecialchars($err->getMessage()) . '</div>
        <p>Unable to open VNC console. Please try again or contact support if the problem persists.</p>
        <a href="javascript:window.close();" class="close-btn">Close Window</a>
    </div>
</body>
</html>';
        die();
    }
}

function ArkHostHetznerVPS_AdminCustomButtonArray() {
    return array(
        'Start' => 'Start',
        'Stop'=> 'Stop',
        'Reboot' => 'Reboot',
        'Shutdown' => 'Shutdown',
        'VNC Console'=> 'VNC',
        'Enable Rescue' => 'EnableRescue',
        'Reset Root Password' => 'ResetRoot',
        'Create Snapshot' => 'CreateSnapshot',
        'Enable Backups' => 'EnableBackups',
        'Disable Backups' => 'DisableBackups',
    );
}

function ArkHostHetznerVPS_AdminLink(array $params) {
    try {
        // Check if we have a VPS ID first
        $vpsId = ArkHostHetznerVPS_GetVPSID($params);
        if (!$vpsId) {
            // This might be called from server configuration page where there's no service
            return '<i class="fa fa-server"></i> Hetzner Cloud Server';
        }
        
        // Get server info to display
        $params['action'] = 'Server Info';
        $serverInfo = ArkHostHetznerVPS_API($params);

        if (isset($serverInfo['server'])) {
            $server = $serverInfo['server'];
            return '<i class="fa fa-server"></i> Status: ' . $server['status'] . '<br><i class="fa fa-network-wired"></i> IP: ' . $server['public_net']['ipv4']['ip'];
        }
        
        return 'Server ID: ' . $vpsId;
    } catch (Exception $err) {
        ArkHostHetznerVPS_Error(__FUNCTION__, $params, $err);
        return 'Unable to retrieve server info';
    }
}

function ArkHostHetznerVPS_ClientAreaAPI(array $params) {
    try {
        $action = App::getFromRequest('api');
        
        $actions = array('Server Info', 'Graphs', 'Reinstall', 'Reboot', 'Stop', 'Shutdown', 'Start', 'IPv4 Addresses', 'Hostname rDNS', 'Create backup', 'Delete backup', 'List backups', 'Restore backup', 'Get Firewall rules', 'Add Firewall rules', 'Delete Firewall rule', 'Commit Firewall rules', 'ISO Images', 'Load ISO', 'Eject ISO', 'Reset root', 'Create Snapshot', 'List Snapshots', 'Server Metrics', 'Rescue Mode', 'Disable Rescue Mode', 'GetFloatingIPStatus', 'AssignFloatingIP', 'UnassignFloatingIP', 'SetFloatingIPReverseDNS');
        $results = array('result' => 'success');

        if (in_array($action, $actions)) {
            foreach ($_POST as $key => $value) {
                $params[$key] = $value;
            }

            // Check backup permissions
            $backupActions = array('Create backup', 'Delete backup', 'Restore backup');
            if (in_array($action, $backupActions)) {
                // Check if backups are enabled in module settings
                $backupsEnabled = (ArkHostHetznerVPS_GetOption($params, 'backups') === 'on');

                if (!$backupsEnabled) {
                    return array('jsonResponse' => array(
                        'result' => 'error',
                        'message' => 'Backups are not enabled for this service. Please upgrade your plan to enable backups.'
                    ));
                }
            }

            // Check floating IP permissions
            $floatingIPActions = array('GetFloatingIPStatus', 'AssignFloatingIP', 'UnassignFloatingIP', 'SetFloatingIPReverseDNS');
            if (in_array($action, $floatingIPActions)) {
                // Check if customer has floating IP via configurable options, module settings, or existing service
                $floatingIPOption = ArkHostHetznerVPS_GetConfigurableOption($params, 'Floating IP');
                $moduleFloatingIP = ArkHostHetznerVPS_GetOption($params, 'create_floating_ip');
                $hasFloatingIPService = $params['model']->serviceProperties->get('ArkHostHetznerVPS|Floating IP ID');
                
                if (!$floatingIPOption && !($moduleFloatingIP && $moduleFloatingIP === 'on') && !$hasFloatingIPService) {
                    return array('jsonResponse' => array(
                        'result' => 'error',
                        'message' => 'Floating IP not available for this service. Please upgrade your plan to add floating IP.'
                    ));
                }
                
                // Handle GetFloatingIPStatus specially (not a real Hetzner API call)
                if ($action === 'GetFloatingIPStatus') {
                    try {
                        // Get current server ID safely
                        $currentServerId = null;
                        try {
                            $currentServerId = ArkHostHetznerVPS_GetVPSID($params);
                        } catch (Exception $vpsIdErr) {
                            // VPS ID retrieval failed - continue without it
                        }
                        
                        // First, check if this service has a specific floating IP stored
                        $serviceFloatingIPId = $params['model']->serviceProperties->get('ArkHostHetznerVPS|Floating IP ID');
                        $customerFloatingIP = null;
                        
                        if ($serviceFloatingIPId) {
                            // Get the specific floating IP for this service
                            try {
                                $floatingIPResult = ArkHostHetznerVPS_API(array_merge($params, array(
                                    'action' => 'Get Floating IP', 
                                    'floating_ip_id' => $serviceFloatingIPId
                                )));
                                if (isset($floatingIPResult['floating_ip'])) {
                                    $customerFloatingIP = $floatingIPResult['floating_ip'];
                                }
                            } catch (Exception $e) {
                                // Floating IP might have been deleted outside WHMCS
                                // Remove invalid ID from service properties
                                $params['model']->serviceProperties->save([
                                    'ArkHostHetznerVPS|Floating IP ID' => '',
                                    'ArkHostHetznerVPS|Floating IP' => ''
                                ]);
                            }
                        }
                        
                        // If no floating IP exists but customer has floating IP access, create one
                        if (!$customerFloatingIP && ($floatingIPOption || ($moduleFloatingIP && $moduleFloatingIP === 'on'))) {
                            try {
                                $createParams = $params;
                                $createParams['action'] = 'Create Floating IP';
                                $createParams['ip_type'] = 'ipv4';
                                $createParams['location'] = ArkHostHetznerVPS_GetOption($params, 'floating_ip_location') ?: 
                                                           ArkHostHetznerVPS_GetOption($params, 'datacenter');
                                $createParams['description'] = 'WHMCS Service ID: ' . $params['serviceid'];
                                $createParams['assign_to_server'] = true;
                                
                                $createResult = ArkHostHetznerVPS_API($createParams);
                                
                                if (isset($createResult['floating_ip']['id'])) {
                                    // Store floating IP information in service properties
                                    $params['model']->serviceProperties->save([
                                        'ArkHostHetznerVPS|Floating IP ID' => $createResult['floating_ip']['id'],
                                        'ArkHostHetznerVPS|Floating IP' => $createResult['floating_ip']['ip'],
                                    ]);
                                    
                                    $customerFloatingIP = $createResult['floating_ip'];
                                }
                            } catch (Exception $createErr) {
                                // Failed to create floating IP - log error but continue
                                logModuleCall(
                                    'ArkHostHetznerVPS',
                                    'CreateFloatingIPOnDemand',
                                    $params,
                                    'Failed to create floating IP: ' . $createErr->getMessage(),
                                    '',
                                    array()
                                );
                            }
                        }
                            
                        if ($customerFloatingIP) {
                            $floatingIPData = array(
                                'hasFloatingIP' => true,
                                'floatingIP' => $customerFloatingIP,
                                'assigned' => $customerFloatingIP['server'] !== null,
                                'server_id' => $customerFloatingIP['server'] ? $customerFloatingIP['server']['id'] : null,
                                'current_server_id' => $currentServerId
                            );
                        } else {
                            // Customer has floating IP access but no floating IP found - this is valid
                            $floatingIPData = array(
                                'hasFloatingIP' => true,
                                'floatingIP' => null,
                                'assigned' => false,
                                'server_id' => null,
                                'current_server_id' => $currentServerId
                            );
                        }
                        
                        return array('jsonResponse' => array(
                            'result' => 'success',
                            'data' => $floatingIPData
                        ));
                    } catch (Exception $statusErr) {
                        return array('jsonResponse' => array(
                            'result' => 'error',
                            'message' => 'Failed to load floating IP status: ' . $statusErr->getMessage()
                        ));
                    }
                }
            }

            $params['action'] = $action;
            $result = ArkHostHetznerVPS_API($params);
            
            // Special handling for specific responses
            if ($action === 'Graphs') {
                // Handle Hetzner metrics response
                if (isset($result['metrics'])) {
                    // Process time series data
                    $processedMetrics = array();
                    
                    // Determine date format based on time period
                    $dateFormat = 'H:i'; // Default for hour/day
                    if (isset($params['time'])) {
                        switch ($params['time']) {
                            case 'hour':
                                $dateFormat = 'H:i';
                                break;
                            case 'day':
                                $dateFormat = 'H:i';
                                break;
                            case 'week':
                                $dateFormat = 'M d';
                                break;
                            case 'month':
                                $dateFormat = 'M d';
                                break;
                            case 'year':
                                $dateFormat = 'M Y';
                                break;
                        }
                    }
                    
                    // Extract CPU usage
                    if (isset($result['metrics']['time_series']['cpu'])) {
                        $cpuData = $result['metrics']['time_series']['cpu']['values'];
                        $processedMetrics['cpu'] = array(
                            'labels' => array(),
                            'data' => array()
                        );
                        foreach ($cpuData as $point) {
                            $processedMetrics['cpu']['labels'][] = date($dateFormat, $point[0]);
                            $processedMetrics['cpu']['data'][] = round($point[1], 2);
                        }
                    }
                    
                    // Extract disk I/O
                    if (isset($result['metrics']['time_series']['disk.0.iops.read'])) {
                        $diskReadData = $result['metrics']['time_series']['disk.0.iops.read']['values'];
                        $diskWriteData = $result['metrics']['time_series']['disk.0.iops.write']['values'];
                        $processedMetrics['disk'] = array(
                            'labels' => array(),
                            'read' => array(),
                            'write' => array()
                        );
                        foreach ($diskReadData as $i => $point) {
                            $processedMetrics['disk']['labels'][] = date($dateFormat, $point[0]);
                            $processedMetrics['disk']['read'][] = round($point[1], 2);
                            $processedMetrics['disk']['write'][] = isset($diskWriteData[$i]) ? round($diskWriteData[$i][1], 2) : 0;
                        }
                    }
                    
                    // Extract network traffic
                    if (isset($result['metrics']['time_series']['network.0.bandwidth.in'])) {
                        $netInData = $result['metrics']['time_series']['network.0.bandwidth.in']['values'];
                        $netOutData = $result['metrics']['time_series']['network.0.bandwidth.out']['values'];
                        $processedMetrics['network'] = array(
                            'labels' => array(),
                            'in' => array(),
                            'out' => array()
                        );
                        foreach ($netInData as $i => $point) {
                            $processedMetrics['network']['labels'][] = date($dateFormat, $point[0]);
                            // Convert bytes/s to Mbps
                            $processedMetrics['network']['in'][] = round(($point[1] * 8) / 1000000, 2);
                            $processedMetrics['network']['out'][] = isset($netOutData[$i]) ? round(($netOutData[$i][1] * 8) / 1000000, 2) : 0;
                        }
                    }
                    
                    $results['graphs'] = array(
                        'type' => 'metrics',
                        'data' => $processedMetrics
                    );
                } else {
                    // No metrics available
                    $results['graphs'] = array(
                        'type' => 'none',
                        'message' => 'Metrics not available for this server'
                    );
                }
            } else if ($action === 'List backups' || $action === 'List Snapshots') {
                // Handle image list response for Hetzner
                if (isset($result['images'])) {
                    // Log the number of images found
                    logModuleCall(
                        'ArkHostHetznerVPS',
                        'ListBackups',
                        array('count' => count($result['images'])),
                        'Found ' . count($result['images']) . ' backup images',
                        '',
                        array()
                    );
                    
                    // Return backups with numeric keys for JavaScript compatibility
                    $backupIndex = 0;
                    foreach ($result['images'] as $image) {
                        $results[$backupIndex] = array(
                            'id' => $image['id'],
                            'name' => $image['description'] ?? $image['name'],
                            'created' => $image['created'],
                            'size' => isset($image['image_size']) ? round($image['image_size'], 2) : 0, // Already in GB from API
                            'type' => $image['type'],
                            'status' => $image['status'] ?? 'available' // Include status from Hetzner API
                        );
                        $backupIndex++;
                    }
                } else {
                    // No backups found
                    $results['message'] = 'No backups found';
                    logModuleCall(
                        'ArkHostHetznerVPS',
                        'ListBackups',
                        array('result' => $result),
                        'No images key in API response',
                        '',
                        array()
                    );
                }
            } else if ($action === 'Server Info') {
                // Handle server info for Hetzner
                if (isset($result['server'])) {
                    $results = array_merge($results, $result['server']);
                }
            } else if ($action === 'ISO Images') {
                // Handle ISO list for Hetzner
                if (isset($result['isos'])) {
                    $results['isos'] = $result['isos'];
                }
            } else if ($action === 'Get Firewall rules') {
                // For Hetzner, we need to check if server has firewalls attached
                // and then fetch the firewall details separately
                $rules = array();
                
                // Check for firewall IDs in the correct location
                $firewallIds = array();
                if (isset($result['server']['public_net']['firewalls']) && !empty($result['server']['public_net']['firewalls'])) {
                    // Extract firewall IDs from the firewalls array
                    foreach ($result['server']['public_net']['firewalls'] as $firewall) {
                        if (isset($firewall['id'])) {
                            $firewallIds[] = $firewall['id'];
                        }
                    }
                }
                
                if (!empty($firewallIds)) {
                    // Server has firewalls attached, fetch the actual firewall rules
                    foreach ($firewallIds as $firewallId) {
                        // Fetch firewall details
                        $firewallParams = $params;
                        $firewallParams['action'] = 'Get Firewall Details';
                        $firewallParams['firewall_id'] = $firewallId;
                        
                        try {
                            $firewallResult = ArkHostHetznerVPS_API($firewallParams);
                            
                            if (isset($firewallResult['firewall']['rules'])) {
                                $inIndex = 0;
                                $outIndex = 0;
                                foreach ($firewallResult['firewall']['rules'] as $rule) {
                                    // Process both inbound and outbound rules
                                    if ($rule['direction'] === 'in' || $rule['direction'] === 'out') {
                                        // Handle IPs based on direction
                                        $ips = '0.0.0.0/0'; // Default when no IPs specified
                                        if ($rule['direction'] === 'out') {
                                            // For outbound rules, use destination_ips
                                            if (isset($rule['destination_ips']) && is_array($rule['destination_ips'])) {
                                                if (!empty($rule['destination_ips'])) {
                                                    $ips = implode(', ', $rule['destination_ips']);
                                                }
                                            }
                                        } else {
                                            // For inbound rules, use source_ips
                                            if (isset($rule['source_ips']) && is_array($rule['source_ips'])) {
                                                if (!empty($rule['source_ips'])) {
                                                    $ips = implode(', ', $rule['source_ips']);
                                                }
                                            }
                                        }
                                        
                                        // Handle port range or single port
                                        $port = '';
                                        if (isset($rule['port'])) {
                                            $port = $rule['port'];
                                        } elseif (isset($rule['port_range'])) {
                                            $port = $rule['port_range'];
                                        } else {
                                            $port = 'Any';
                                        }
                                        
                                        // Generate ID based on direction and index
                                        $ruleId = 'fw_' . $firewallId . '_' . $rule['direction'] . '_';
                                        if ($rule['direction'] === 'in') {
                                            $ruleId .= $inIndex;
                                            $inIndex++;
                                        } else {
                                            $ruleId .= $outIndex;
                                            $outIndex++;
                                        }
                                        
                                        $rules[] = array(
                                            'id' => $ruleId,
                                            'direction' => $rule['direction'],
                                            'action' => 'ACCEPT',
                                            'protocol' => strtoupper($rule['protocol']),
                                            'port' => $port,
                                            'source' => $ips
                                        );
                                    }
                                }
                            }
                        } catch (Exception $e) {
                            // If we can't fetch firewall details, show a message
                            $rules[] = array(
                                'id' => 'error_' . $firewallId,
                                'action' => 'INFO',
                                'protocol' => 'N/A',
                                'port' => 'N/A',
                                'source' => 'N/A',
                                'note' => 'Unable to fetch firewall ' . $firewallId . ' details'
                            );
                        }
                    }
                    
                    if (empty($rules)) {
                        $results['message'] = 'This server has ' . count($firewallIds) . ' firewall(s) attached but no inbound rules configured.';
                    }
                } else {
                    // No firewalls attached - don't show any rules
                    $results['message'] = 'No firewall attached to this server. All traffic is allowed by default. Create a firewall rule to enable protection.';
                    // Return empty rules array
                    $rules = array();
                }
                
                // Return rules with numeric keys for JavaScript compatibility
                foreach ($rules as $index => $rule) {
                    $results[$index] = $rule;
                }
            } else if ($action === 'Reinstall') {
                // Handle rebuild response - save new root password if provided
                if (isset($result['root_password']) && !empty($result['root_password'])) {
                    // Save the new root password
                    Capsule::table('tblhosting')
                        ->where('id', $params['serviceid'])
                        ->update(['password' => encrypt($result['root_password'])]);

                    // Save the timestamp when password was set for expiration tracking (72 hours)
                    $params['model']->serviceProperties->save([
                        'ArkHostHetznerVPS|Password Set Time' => time()
                    ]);

                    $results['root_password'] = $result['root_password'];
                    $results['message'] = 'Server rebuild initiated. New root password has been saved.';
                } else {
                    $results['message'] = 'Server rebuild initiated. No new password generated (SSH keys used).';
                }
                $results = array_merge($results, is_array($result) ? $result : array('data' => $result));
            } else if ($action === 'AssignFloatingIP') {
                // Handle floating IP assignment - only allow assignment of service's own floating IP
                $serviceFloatingIPId = $params['model']->serviceProperties->get('ArkHostHetznerVPS|Floating IP ID');
                if ($serviceFloatingIPId && $serviceFloatingIPId === $params['floating_ip_id']) {
                    $assignResult = ArkHostHetznerVPS_API(array_merge($params, array('action' => 'Assign Floating IP')));
                    $results = array_merge($results, is_array($assignResult) ? $assignResult : array('data' => $assignResult));
                } else {
                    $results['result'] = 'error';
                    $results['message'] = 'Invalid floating IP ID for this service';
                }
            } else if ($action === 'UnassignFloatingIP') {
                // Handle floating IP unassignment - only allow unassignment of service's own floating IP
                $serviceFloatingIPId = $params['model']->serviceProperties->get('ArkHostHetznerVPS|Floating IP ID');
                if ($serviceFloatingIPId && $serviceFloatingIPId === $params['floating_ip_id']) {
                    $unassignResult = ArkHostHetznerVPS_API(array_merge($params, array('action' => 'Unassign Floating IP')));
                    $results = array_merge($results, is_array($unassignResult) ? $unassignResult : array('data' => $unassignResult));
                } else {
                    $results['result'] = 'error';
                    $results['message'] = 'Invalid floating IP ID for this service';
                }
            } else if ($action === 'SetFloatingIPReverseDNS') {
                // Handle floating IP reverse DNS update - only allow for service's own floating IP
                $serviceFloatingIPId = $params['model']->serviceProperties->get('ArkHostHetznerVPS|Floating IP ID');
                if ($serviceFloatingIPId && $serviceFloatingIPId === $params['floating_ip_id']) {
                    $dnsResult = ArkHostHetznerVPS_API(array_merge($params, array('action' => 'Change Floating IP DNS')));
                    $results = array_merge($results, is_array($dnsResult) ? $dnsResult : array('data' => $dnsResult));
                } else {
                    $results['result'] = 'error';
                    $results['message'] = 'Invalid floating IP ID for this service';
                }
            } else if ($action === 'Reset root') {
                // Handle password reset from client area
                $results = array_merge($results, is_array($result) ? $result : array('data' => $result));

                // Store the new root password and timestamp if provided
                if (isset($result['root_password'])) {
                    Capsule::table('tblhosting')->where('id', $params['serviceid'])->update([
                        'password' => encrypt($result['root_password'])
                    ]);

                    // Save the timestamp when password was set for expiration tracking (72 hours)
                    $params['model']->serviceProperties->save([
                        'ArkHostHetznerVPS|Password Set Time' => time()
                    ]);
                }
            } else {
                $results = array_merge($results, is_array($result) ? $result : array('data' => $result));
            }

            return array('jsonResponse' => $results);
        } else {
            throw new Exception('Action not allowed');
        }
    } catch (Exception $e) {
        return array('jsonResponse' => array('result' => 'error', 'message' => $e->getMessage()));
    }
}

function ArkHostHetznerVPS_DeliverFile(array $params) {
    try {
        $dir = __DIR__ . '/template/';
        $file = App::getFromRequest('file');
        $files = array('app.min.css', 'app.min.js');

        if (in_array($file, $files)) {
            $type = '';

			if (function_exists('ob_gzhandler')) {
				ob_start('ob_gzhandler');
			}
            
            if (strpos($file, '.js') !== false) {
                $dir .= 'js/';
                $type = 'application/javascript';
            } else if (strpos($file, '.css') !== false) {
                $dir .= 'css/';
                $type = 'text/css';
            } else {
                $type = 'text/html';
            }

            header('Content-Type: ' . $type . '; charset=utf-8');
            header('Cache-Control: max-age=604800, public');
            
            echo file_get_contents($dir . $file);
            WHMCS\Terminus::getInstance()->doExit();
        } else {
            throw new Exception('File not found');
        }
    } catch (Exception $err) {
        ArkHostHetznerVPS_Error(__FUNCTION__, $params, $err);
        return array('jsonResponse' => array('result' => 'error', 'message' => $err->getMessage()));
    }
}



function ArkHostHetznerVPS_ClientAreaCustomButtonArray() {
    $_LANG = ArkHostHetznerVPS_Translation();

    return array(
        $_LANG['Start'] => 'Start',
        $_LANG['Stop'] => 'Stop',
        $_LANG['Restart'] => 'Reboot',
        $_LANG['Shutdown'] => 'Shutdown',
        $_LANG['VNC'] => 'VNC',
	);
}

function ArkHostHetznerVPS_ClientAreaAllowedFunctions() {
    return array('ClientAreaAPI', 'DeliverFile');
}

function ArkHostHetznerVPS_ClientArea(array $params) {
    if ($params['moduletype'] !== 'ArkHostHetznerVPS') return;

    try {
        // Get clean VPS ID - this handles migration from other modules
        $cleanVpsId = ArkHostHetznerVPS_GetVPSID($params);
        if (empty($cleanVpsId)) {
            throw new Exception('VPS ID not found. Please check service configuration.');
        }
        
        // If we found a VPS ID but it's not stored in our format, store it now for future use
        $storedVpsId = $params['model']->serviceProperties->get('ArkHostHetznerVPS|VPS ID');
        if (empty($storedVpsId) && !empty($cleanVpsId)) {
            // Store the VPS ID for future use (using our format)
            $params['model']->serviceProperties->save([
                'ArkHostHetznerVPS|VPS ID' => $cleanVpsId,
            ]);
        }
        
        
        // Check if password is empty (migration from other modules) and set a dummy password
        if (empty($params['password'])) {
            // Set a dummy password to prevent WHMCS from showing password reset form
            // This is just for display - actual server access is via API
            Capsule::table('tblhosting')
                ->where('id', $params['serviceid'])
                ->update(['password' => encrypt('managed-via-api')]);
            
            // Reload params to get the updated password
            $params['password'] = 'managed-via-api';
        }

        // Get server info and operating systems data
        $params['action'] = 'Server Info';
        $response = ArkHostHetznerVPS_API($params);

        // Check if server info is valid
        if (!is_array($response) || !isset($response['server'])) {
            throw new Exception('Unable to retrieve server information from API');
        }

        // Extract server data from Hetzner response
        $serverInfo = $response['server'];

        $params['action'] = 'Operating Systems - Server';
        $operatingSystemsTemp = ArkHostHetznerVPS_API($params);

        // Check if operating systems data is valid
        if (!is_array($operatingSystemsTemp)) {
            $operatingSystemsTemp = array();
        }

        $dirImages = __DIR__ . '/template/img/';
        $availableImages = glob($dirImages . '*.png');
        $images = array();
        
        foreach ($availableImages as $key => $image) {
            $images[explode('.png', explode($dirImages, $image)[1])[0]] = 'data:image/png;base64,' . base64_encode(file_get_contents($image));
        }

        $dirOS = __DIR__ . '/template/img/os/';
        $availableOS = glob($dirOS . '*.png');
        $operatingSystems = array();
        
        foreach ($availableOS as $key => $os) {
            $availableOS[$key] = explode('.png', explode($dirOS, $os)[1])[0];
        }

        // Process operating systems data from Hetzner API
        if (!empty($operatingSystemsTemp) && isset($operatingSystemsTemp['images'])) {
            // Log the raw OS data for debugging
            logModuleCall(
                'ArkHostHetznerVPS',
                'ProcessOperatingSystems',
                array('image_count' => count($operatingSystemsTemp['images'])),
                'Processing ' . count($operatingSystemsTemp['images']) . ' OS images',
                '',
                array()
            );
            
            foreach ($operatingSystemsTemp['images'] as $operatingSystem) {
                // Skip non-system images
                if ($operatingSystem['type'] !== 'system' || $operatingSystem['status'] !== 'available') {
                    continue;
                }
                
                // Use description for display, fall back to name
                $displayName = $operatingSystem['description'] ?: $operatingSystem['name'];
                $osName = strtolower($displayName);
                
                // Determine the proper group based on OS name
                if (strpos($osName, 'alma') !== false) {
                    $group = 'almalinux';
                    $groupName = 'AlmaLinux';
                } elseif (strpos($osName, 'rocky') !== false) {
                    $group = 'rocky';
                    $groupName = 'Rocky Linux';
                } elseif (strpos($osName, 'centos') !== false) {
                    $group = 'centos';
                    $groupName = 'CentOS';
                } elseif (strpos($osName, 'debian') !== false) {
                    $group = 'debian';
                    $groupName = 'Debian';
                } elseif (strpos($osName, 'ubuntu') !== false) {
                    $group = 'ubuntu';
                    $groupName = 'Ubuntu';
                } elseif (strpos($osName, 'fedora') !== false) {
                    $group = 'fedora';
                    $groupName = 'Fedora';
                } elseif (strpos($osName, 'opensuse') !== false || strpos($osName, 'suse') !== false) {
                    $group = 'opensuse';
                    $groupName = 'openSUSE';
                } elseif (strpos($osName, 'windows') !== false) {
                    $group = 'windows';
                    $groupName = 'Windows';
                } else {
                    // For any other OS, use 'others'
                    $group = 'others';
                    $groupName = 'Other Systems';
                }
                
                if (!isset($operatingSystems[$group])) {
                    // Map group names to correct image filenames
                    $imageFile = $group;
                    if ($group === 'rocky') {
                        $imageFile = 'rockylinux';
                    }
                    
                    $image = file_get_contents($dirOS . (in_array($imageFile, $availableOS) ? $imageFile : 'others') . '.png');
                    
                    $operatingSystems[$group] = array(
                        'name' => $groupName,
                        'image' => 'data:image/png;base64,' . base64_encode($image),
                        'versions' => array(),
                    );
                }
                
                // Check if this version already exists (avoid duplicates)
                // Check both by ID and display name to avoid visual duplicates
                $versionExists = false;
                if (!empty($operatingSystems[$group]['versions'])) {
                    foreach ($operatingSystems[$group]['versions'] as $existingVersion) {
                        // Check if either the ID or display name already exists
                        if ($existingVersion['id'] === $operatingSystem['name'] || 
                            $existingVersion['name'] === $displayName) {
                            $versionExists = true;
                            // Log duplicate found
                            logModuleCall(
                                'ArkHostHetznerVPS',
                                'DuplicateOSFound',
                                array(
                                    'group' => $group,
                                    'existing_id' => $existingVersion['id'],
                                    'existing_name' => $existingVersion['name'],
                                    'new_id' => $operatingSystem['name'],
                                    'new_name' => $displayName
                                ),
                                'Duplicate OS version found',
                                '',
                                array()
                            );
                            break;
                        }
                    }
                }
                
                // Only add if not already present
                if (!$versionExists) {
                    // Store both the API name (for rebuild) and display name
                    $operatingSystems[$group]['versions'][] = array(
                        'id' => $operatingSystem['name'],  // This is what we send to API
                        'name' => $displayName              // This is what we display
                    );
                }
            }
            
            // Sort OS versions within each group for consistent display
            foreach ($operatingSystems as $group => &$osData) {
                if (!empty($osData['versions'])) {
                    usort($osData['versions'], function($a, $b) {
                        return strcmp($a['name'], $b['name']);
                    });
                }
            }
            
            // Process operating system info for Hetzner
            if (isset($serverInfo['image']) && !empty($operatingSystemsTemp['images'])) {
                $osId = $serverInfo['image']['name'];
                $imageType = $serverInfo['image']['type'] ?? 'system';

                // If this is a backup or snapshot image, try to get the actual OS info from os_flavor/os_version
                if (($imageType === 'backup' || $imageType === 'snapshot') && isset($serverInfo['image']['os_flavor'])) {
                    // Use os_flavor and os_version to construct a meaningful OS name
                    $osName = strtolower($serverInfo['image']['os_flavor']);
                    $displayName = ucfirst($serverInfo['image']['os_flavor']);
                    if (isset($serverInfo['image']['os_version']) && !empty($serverInfo['image']['os_version'])) {
                        $displayName .= ' ' . $serverInfo['image']['os_version'];
                    }
                } else {
                    $osName = strtolower($serverInfo['image']['description'] ?? $osId);
                    $displayName = $serverInfo['image']['description'] ?? $osId;
                }

                // Find matching OS in available images (only for system images)
                $currentOS = null;
                if ($imageType === 'system') {
                    foreach ($operatingSystemsTemp['images'] as $os) {
                        if ($os['name'] === $osId) {
                            $currentOS = $os;
                            break;
                        }
                    }
                }

                if ($currentOS) {
                    $displayName = $currentOS['description'] ?? $currentOS['name'];
                    $osName = strtolower($displayName);
                    
                    // Determine the proper group based on current OS name (same logic as above)
                    if (strpos($osName, 'alma') !== false) {
                        $group = 'almalinux';
                    } elseif (strpos($osName, 'rocky') !== false) {
                        $group = 'rocky';
                    } elseif (strpos($osName, 'centos') !== false) {
                        $group = 'centos';
                    } elseif (strpos($osName, 'debian') !== false) {
                        $group = 'debian';
                    } elseif (strpos($osName, 'ubuntu') !== false) {
                        $group = 'ubuntu';
                    } elseif (strpos($osName, 'fedora') !== false) {
                        $group = 'fedora';
                    } elseif (strpos($osName, 'opensuse') !== false || strpos($osName, 'suse') !== false) {
                        $group = 'opensuse';
                    } elseif (strpos($osName, 'windows') !== false) {
                        $group = 'windows';
                    } else {
                        $group = 'others';
                    }
                    
                    // Map group names to correct image filenames
                    $imageFile = $group;
                    if ($group === 'rocky') {
                        $imageFile = 'rockylinux';
                    }
                    
                    // Use the specific OS information
                    $serverInfo['operatingSystem'] = array(
                        'name' => $displayName,
                        'image' => isset($operatingSystems[$group]) ? $operatingSystems[$group]['image'] : 'data:image/png;base64,' . base64_encode(file_get_contents($dirOS . (in_array($imageFile, $availableOS) ? $imageFile : 'others') . '.png'))
                    );
                } else {
                    // Fallback if OS not found - already have $displayName and $osName from above
                    // Just ensure they are set
                    if (!isset($displayName)) {
                        $displayName = $serverInfo['image']['description'] ?? $osId;
                    }
                    if (!isset($osName)) {
                        $osName = strtolower($displayName);
                    }

                    // Try to determine OS type from name
                    if (strpos($osName, 'alma') !== false) {
                        $imageFile = 'almalinux';
                    } elseif (strpos($osName, 'rocky') !== false) {
                        $imageFile = 'rockylinux';
                    } elseif (strpos($osName, 'centos') !== false) {
                        $imageFile = 'centos';
                    } elseif (strpos($osName, 'debian') !== false) {
                        $imageFile = 'debian';
                    } elseif (strpos($osName, 'ubuntu') !== false) {
                        $imageFile = 'ubuntu';
                    } elseif (strpos($osName, 'fedora') !== false) {
                        $imageFile = 'fedora';
                    } elseif (strpos($osName, 'opensuse') !== false || strpos($osName, 'suse') !== false) {
                        $imageFile = 'opensuse';
                    } elseif (strpos($osName, 'windows') !== false) {
                        $imageFile = 'windows';
                    } else {
                        $imageFile = 'others';
                    }
                    
                    $serverInfo['operatingSystem'] = array(
                        'name' => $displayName,
                        'image' => 'data:image/png;base64,' . base64_encode(file_get_contents($dirOS . (in_array($imageFile, $availableOS) ? $imageFile : 'others') . '.png'))
                    );
                }
            }
        }

        // Set default OS info if not available
        if (!isset($serverInfo['operatingSystem']) || !is_array($serverInfo['operatingSystem'])) {
            $serverInfo['operatingSystem'] = array(
                'name' => 'Unknown OS',
                'image' => 'data:image/png;base64,' . base64_encode(file_get_contents($dirOS . 'others.png'))
            );
        }

        // Map Hetzner status to template expectations
        $serverInfo['statusImage'] = isset($images[$serverInfo['status']]) ? $images[$serverInfo['status']] : (isset($images['unknown']) ? $images['unknown'] : '');
        $serverInfo['statusDescription'] = ucfirst($serverInfo['status']);

        // Map Hetzner server data to expected format
        $serverInfo['hostname'] = $serverInfo['name'] ?? 'N/A';
        $serverInfo['ip'] = isset($serverInfo['public_net']['ipv4']['ip']) ? $serverInfo['public_net']['ipv4']['ip'] : 'N/A';
        $serverInfo['ipv6'] = isset($serverInfo['public_net']['ipv6']['ip']) ? $serverInfo['public_net']['ipv6']['ip'] : 'N/A';
        
        // Calculate uptime from created date
        if (isset($serverInfo['created'])) {
            $created = new DateTime($serverInfo['created']);
            $now = new DateTime();
            $diff = $now->diff($created);
            $serverInfo['uptime_text'] = $diff->format('%a days, %h hours');
        } else {
            $serverInfo['uptime_text'] = 'N/A';
        }
        
        // Get server type details
        $serverType = $serverInfo['server_type'] ?? array();
        $serverInfo['cpu'] = $serverType['cores'] ?? 0;
        $serverInfo['ram'] = $serverType['memory'] ?? 0;
        $serverInfo['disk'] = $serverType['disk'] ?? 0;
        
        // Try to fetch current metrics for the overview
        try {
            $metricsParams = $params;
            $metricsParams['action'] = 'Graphs';
            $metricsParams['time'] = 'hour'; // Get last hour for current usage
            
            $metrics = ArkHostHetznerVPS_API($metricsParams);
            
            // Extract latest CPU usage
            if (isset($metrics['metrics']['time_series']['cpu']['values'])) {
                $cpuValues = $metrics['metrics']['time_series']['cpu']['values'];
                if (!empty($cpuValues)) {
                    $latestCpu = end($cpuValues);
                    $serverInfo['cpu_usage'] = round($latestCpu[1], 1);
                }
            }
            
            // For bandwidth, we should use the outgoing_traffic from server info instead of calculating from metrics
            // The metrics only show current bandwidth rate, not total usage
        } catch (Exception $e) {
            // If metrics fail, keep defaults
        }
        
        // Hetzner doesn't provide RAM usage or disk usage via API
        $serverInfo['cpu_usage'] = $serverInfo['cpu_usage'] ?? 0;
        $serverInfo['ram_usage'] = 0;
        $serverInfo['disk_used'] = 0;
        
        // Traffic information - Hetzner includes 20TB with all cloud servers
        // Traffic usage is not available via the server API
        $serverInfo['bandwidth'] = 20480; // 20TB in GB (20 * 1024)
        $serverInfo['bandwidth_used'] = 0; // Not available via API
        
        // Add datacenter info - format as "City, Country"
        $city = isset($serverInfo['datacenter']['location']['city']) ? $serverInfo['datacenter']['location']['city'] : '';
        $country = isset($serverInfo['datacenter']['location']['country']) ? $serverInfo['datacenter']['location']['country'] : '';

        if ($city && $country) {
            $serverInfo['datacenter'] = $city . ', ' . $country;
        } elseif ($city) {
            $serverInfo['datacenter'] = $city;
        } elseif ($country) {
            $serverInfo['datacenter'] = $country;
        } else {
            $serverInfo['datacenter'] = 'N/A';
        }

        $serverInfo['location'] = $city ?: 'N/A';

        // Get root password with expiration check (72 hours)
        $passwordSetTime = $params['model']->serviceProperties->get('ArkHostHetznerVPS|Password Set Time');
        $currentTime = time();
        $expirationPeriod = 72 * 3600; // 72 hours in seconds

        if (!empty($params['password']) && $params['password'] !== 'managed-via-api') {
            // If no timestamp exists, show the password (backward compatibility or initial setup)
            // If timestamp exists, check if it's within the 72-hour window
            if (!$passwordSetTime || ($currentTime - $passwordSetTime) < $expirationPeriod) {
                // Password is still valid - WHMCS already decrypts it for us in $params
                // No need to call decrypt() as $params['password'] is already plain text
                $serverInfo['install_root'] = $params['password'];
            } else {
                // Password has expired (timestamp exists and is older than 72 hours)
                $serverInfo['install_root'] = '';
            }
        } else {
            $serverInfo['install_root'] = '';
        }

        // Check if backups are enabled in module settings
        $backupsEnabled = (ArkHostHetznerVPS_GetOption($params, 'backups') === 'on');

        return array(
            'templatefile' => 'template/clientarea_direct',
            'templateVariables' => array(
                'images' => $images,
                'serverInfo' => $serverInfo,
                'operatingSystems' => $operatingSystems,
                'token' => generate_token('plain'),
                'ADDONLANG' => ArkHostHetznerVPS_Translation(),
                'backupsEnabled' => $backupsEnabled,
                'productName' => $params['productname'] ?? $params['configoption1'] ?? 'VPS',
            )
        );
    } catch (Exception $err) {
        ArkHostHetznerVPS_Error(__FUNCTION__, $params, $err);

        return array(
            'templatefile' => 'template/error',
            'templateVariables' => array(
                'error' => $err->getMessage(),
                'image' => 'data:image/png;base64,' . base64_encode(file_get_contents(__DIR__ . '/template/img/notice.png'))
            )
        );
    }
}

function ArkHostHetznerVPS_Translation() {
    $lang = Setting::getValue('Language');
    $language = Lang::getName();
    $_ADDONLANG = [];

    if ($language === '') {
        $language = $lang;
    }

    if ($language) {
        $addonLangFile = ROOTDIR . '/modules/servers/ArkHostHetznerVPS/lang/' . $language . '.php';
    
        if (file_exists($addonLangFile)) {
            swapLang($language);

            ob_start();
            require $addonLangFile;
            ob_end_clean();
        }
    }

    if (count($_ADDONLANG) === 0) {
        $addonLangFile = ROOTDIR . '/modules/servers/ArkHostHetznerVPS/lang/' . $lang . '.php';

        if (file_exists($addonLangFile)) {
            swapLang($lang);
            
            ob_start();
            require $addonLangFile;
            ob_end_clean();
        }
    }

    if (count($_ADDONLANG) === 0) {
        $addonLangFile = ROOTDIR . '/modules/servers/ArkHostHetznerVPS/lang/english.php';

        if (file_exists($addonLangFile)) {
            ob_start();
            require $addonLangFile;
            ob_end_clean();
        }
    }

    return $_ADDONLANG;
}

function ArkHostHetznerVPS_EnableRescue(array $params) {
    try {
        $params['action'] = 'Rescue Mode';
        ArkHostHetznerVPS_API($params);
    } catch (Exception $err) {
        ArkHostHetznerVPS_Error(__FUNCTION__, $params, $err);
        return 'Received the error: ' . $err->getMessage() . ' Check module debug log for more detailed error.';
    }

    return 'success';
}

function ArkHostHetznerVPS_ResetRoot(array $params) {
    try {
        $params['action'] = 'Reset root';
        $result = ArkHostHetznerVPS_API($params);

        // Store the new root password if provided
        if (isset($result['root_password'])) {
            Capsule::table('tblhosting')->where('id', $params['serviceid'])->update([
                'password' => encrypt($result['root_password'])
            ]);

            // Save the timestamp when password was set for expiration tracking (72 hours)
            $params['model']->serviceProperties->save([
                'ArkHostHetznerVPS|Password Set Time' => time()
            ]);
        }
    } catch (Exception $err) {
        ArkHostHetznerVPS_Error(__FUNCTION__, $params, $err);
        return 'Received the error: ' . $err->getMessage() . ' Check module debug log for more detailed error.';
    }

    return 'success';
}

function ArkHostHetznerVPS_CreateSnapshot(array $params) {
    try {
        $params['action'] = 'Create Snapshot';
        $params['description'] = 'Manual snapshot from WHMCS';
        ArkHostHetznerVPS_API($params);
    } catch (Exception $err) {
        ArkHostHetznerVPS_Error(__FUNCTION__, $params, $err);
        return 'Received the error: ' . $err->getMessage() . ' Check module debug log for more detailed error.';
    }

    return 'success';
}

function ArkHostHetznerVPS_Shutdown(array $params) {
    try {
        $params['action'] = 'Shutdown';
        ArkHostHetznerVPS_API($params);
    } catch (Exception $err) {
        ArkHostHetznerVPS_Error(__FUNCTION__, $params, $err);
        return 'Received the error: ' . $err->getMessage() . ' Check module debug log for more detailed error.';
    }

    return 'success';
}

function ArkHostHetznerVPS_EnableBackups(array $params) {
    try {
        $params['action'] = 'Enable Backups';
        ArkHostHetznerVPS_API($params);
    } catch (Exception $err) {
        ArkHostHetznerVPS_Error(__FUNCTION__, $params, $err);
        return 'Received the error: ' . $err->getMessage() . ' Check module debug log for more detailed error.';
    }

    return 'success';
}

function ArkHostHetznerVPS_DisableBackups(array $params) {
    try {
        $params['action'] = 'Disable Backups';
        ArkHostHetznerVPS_API($params);
    } catch (Exception $err) {
        ArkHostHetznerVPS_Error(__FUNCTION__, $params, $err);
        return 'Received the error: ' . $err->getMessage() . ' Check module debug log for more detailed error.';
    }

    return 'success';
}
