/* ArkHost Hetzner VPS Module JavaScript */

// Floating IP Management Functions
function loadFloatingIPStatus() {
    var content = document.getElementById('floating-ip-content');
    if (!content) return;
    
    content.innerHTML = '<div class="text-center"><i class="fas fa-spinner fa-spin fa-2x"></i><p class="mt-2">Loading floating IP information...</p></div>';
    
    // Check if floating IP configurable option is enabled
    ArkHostHetznerVPS_API('GetFloatingIPStatus', false, {}, function(response) {
        if (response.result === 'success') {
            displayFloatingIPStatus(response.data);
        } else {
            // Server returned a structured error (like permission denied)
            content.innerHTML = '<div class="alert alert-warning"><i class="fa fa-exclamation-triangle mr-2"></i>' + 
                               (response.message || 'Floating IP not available for this service') + '</div>';
        }
    }, function(error) {
        // Network/JavaScript error callback
        var errorMsg = 'Failed to load floating IP information. Please try again later.';
        if (error && error.message) {
            errorMsg = error.message;
        }
        content.innerHTML = '<div class="alert alert-danger"><i class="fa fa-exclamation-triangle mr-2"></i>' + errorMsg + '</div>';
    });
}

function displayFloatingIPStatus(data) {
    var content = document.getElementById('floating-ip-content');
    if (!content) return;
    
    var html = '';
    
    if (!data.hasFloatingIP) {
        html = '<div class="alert alert-warning"><i class="fa fa-info-circle mr-2"></i>' + 
               (lang.settings.floatingIP.notAvailable || 'Floating IP not available for this service') + '</div>';
    } else if (!data.floatingIP) {
        html = '<div class="alert alert-info"><i class="fa fa-info-circle mr-2"></i>' + 
               (lang.settings.floatingIP.none || 'No floating IP assigned') + '</div>';
        
        // Add option to create floating IP if needed (for configurable option customers)
        html += '<div class="text-center mt-3">';
        html += '<p class="text-muted small">If you need a floating IP, please contact support to provision one for your service.</p>';
        html += '</div>';
    } else {
        var ip = data.floatingIP;
        var isAssigned = ip.server && ip.server.id;
        
        html += '<div class="card border-' + (isAssigned ? 'success' : 'warning') + '">';
        html += '<div class="card-header bg-' + (isAssigned ? 'success' : 'warning') + ' text-white">';
        html += '<h6 class="mb-0"><i class="fa fa-globe mr-2"></i>Floating IP Details</h6>';
        html += '</div>';
        html += '<div class="card-body">';
        html += '<div class="row">';
        html += '<div class="col-md-6">';
        html += '<strong>IP Address:</strong> <code>' + ip.ip + '</code><br>';
        html += '<strong>Type:</strong> ' + ip.type.toUpperCase() + '<br>';
        html += '<strong>Status:</strong> <span class="badge badge-' + (isAssigned ? 'success' : 'warning') + '">' + 
                (isAssigned ? lang.settings.floatingIP.assigned || 'Assigned' : lang.settings.floatingIP.unassigned || 'Unassigned') + '</span>';
        html += '</div>';
        html += '<div class="col-md-6">';
        
        if (isAssigned) {
            html += '<button class="btn btn-warning btn-sm mb-2" onclick="unassignFloatingIP(\'' + ip.id + '\');">';
            html += '<i class="fa fa-unlink mr-1"></i>' + (lang.settings.floatingIP.unassign || 'Unassign from Server') + '</button><br>';
        } else {
            html += '<button class="btn btn-success btn-sm mb-2" onclick="assignFloatingIP(\'' + ip.id + '\');">';
            html += '<i class="fa fa-link mr-1"></i>' + (lang.settings.floatingIP.assign || 'Assign to Server') + '</button><br>';
        }
        
        // Reverse DNS section
        html += '<div class="mt-3">';
        html += '<label class="small font-weight-bold">' + (lang.settings.floatingIP.reverseDNS || 'Reverse DNS (PTR)') + ':</label>';
        html += '<div class="input-group">';
        html += '<input type="text" class="form-control form-control-sm" id="reverse-dns-' + ip.id + '" ';
        html += 'value="' + (ip.dns_ptr && ip.dns_ptr.length > 0 ? ip.dns_ptr[0].dns_ptr : '') + '" ';
        html += 'placeholder="' + (lang.settings.floatingIP.reverseDNSPlaceholder || 'example.com') + '">';
        html += '<div class="input-group-append">';
        html += '<button class="btn btn-outline-primary btn-sm" onclick="setReverseDNS(\'' + ip.id + '\', \'' + ip.ip + '\');">';
        html += '<i class="fa fa-save"></i></button>';
        html += '</div>';
        html += '</div>';
        html += '</div>';
        
        html += '</div>';
        html += '</div>';
        html += '</div>';
        html += '</div>';
    }
    
    content.innerHTML = html;
}

function assignFloatingIP(floatingIPId) {
    showConfirm(
        'Assign this floating IP to the server?',
        'Assign Floating IP',
        function() {
            ArkHostHetznerVPS_API('AssignFloatingIP', false, {floating_ip_id: floatingIPId}, function(response) {
                if (response.result === 'success') {
                    showNotification('Floating IP assigned successfully', 'success');
                    setTimeout(loadFloatingIPStatus, 2000);
                } else {
                    showNotification(response.message || 'Failed to assign floating IP', 'error');
                }
            });
        }
    );
}

function unassignFloatingIP(floatingIPId) {
    showConfirm(
        'Unassign this floating IP from the server?',
        'Unassign Floating IP', 
        function() {
            ArkHostHetznerVPS_API('UnassignFloatingIP', false, {floating_ip_id: floatingIPId}, function(response) {
                if (response.result === 'success') {
                    showNotification('Floating IP unassigned successfully', 'success');
                    setTimeout(loadFloatingIPStatus, 2000);
                } else {
                    showNotification(response.message || 'Failed to unassign floating IP', 'error');
                }
            });
        }
    );
}

function setReverseDNS(floatingIPId, ip) {
    var input = document.getElementById('reverse-dns-' + floatingIPId);
    if (!input) return;
    
    var hostname = input.value.trim();
    
    ArkHostHetznerVPS_API('SetFloatingIPReverseDNS', false, {
        floating_ip_id: floatingIPId,
        ip: ip,
        dns_ptr: hostname
    }, function(response) {
        if (response.result === 'success') {
            showNotification('Reverse DNS updated successfully', 'success');
        } else {
            showNotification(response.message || 'Failed to update reverse DNS', 'error');
        }
    });
}

// Initialize module variables from template
var productURL = productURL || '';
var serverInfoInitial = serverInfoInitial || {};
var lang = lang || {};

function confirmStop() {
    showConfirm(lang.confirm.stop.message, lang.confirm.stop.title, function() {
        ArkHostHetznerVPS_API('Stop', true);
    });
    return false;
}

function confirmRestart() {
    showConfirm(lang.confirm.restart.message, lang.confirm.restart.title, function() {
        ArkHostHetznerVPS_API('Reboot', true);
    });
    return false;
}

function confirmShutdown() {
    showConfirm(lang.confirmShutdownMessage || 'Are you sure you want to shutdown this VPS?', lang.confirmShutdownTitle || 'Shutdown VPS', function() {
        ArkHostHetznerVPS_API('Shutdown', true);
    });
    return false;
}

// Rescue Mode functions
function enableRescueMode() {
    showConfirm(
        lang.confirmEnableRescueMessage || 'Enable rescue mode?',
        lang.confirmEnableRescueTitle || 'Enable Rescue Mode',
        function() {
            ArkHostHetznerVPS_API('Rescue Mode', true, {}, function(data) {
                if (data.root_password) {
                    showNotification(lang.rescueModeEnabled + data.root_password + ' (' + lang.savePassword + ')', 'success', 10000);
                }
            });
        }
    );
    return false;
}

function enableRescueAndReboot() {
    showConfirm(
        lang.confirmEnableRescueRebootMessage || 'Enable rescue mode and reboot?',
        lang.confirmEnableRescueRebootTitle || 'Enable & Reboot',
        function() {
            ArkHostHetznerVPS_API('Rescue Mode', true, {}, function(data) {
                if (data.root_password) {
                    showNotification(lang.rescueModeEnabled + data.root_password + ' (' + lang.savePassword + ')', 'success', 10000);
                    // Wait a moment then reboot
                    setTimeout(function() {
                        ArkHostHetznerVPS_API('Reboot', true);
                    }, 2000);
                }
            });
        }
    );
    return false;
}

function disableRescueMode() {
    showConfirm(
        lang.confirmDisableRescueMessage || 'Disable rescue mode?',
        lang.confirmDisableRescueTitle || 'Disable Rescue Mode',
        function() {
            ArkHostHetznerVPS_API('Disable Rescue Mode', true);
        }
    );
    return false;
}

function resetRootPassword() {
    showConfirm(
        lang.confirmResetPasswordMessage || 'Reset root password?',
        lang.confirmResetPasswordTitle || 'Reset Root Password',
        function() {
            ArkHostHetznerVPS_API('Reset root', true, {}, function(data) {
                if (data.root_password) {
                    // Update the password field on the page
                    var passwordField = document.getElementById('vpsPassword');
                    if (passwordField) {
                        passwordField.value = data.root_password;
                    }

                    // Show password in a special modal or notification
                    var passwordHtml = '<div class="alert alert-success">' +
                        '<h5>' + lang.newRootPassword + '</h5>' +
                        '<p>' + lang.passwordPrompt + '</p>' +
                        '<div class="input-group">' +
                        '<input type="text" class="form-control" value="' + data.root_password + '" id="newRootPass" readonly>' +
                        '<div class="input-group-append">' +
                        '<button class="btn btn-primary" onclick="copyToClipboard(\'newRootPass\')"><i class="fa fa-copy"></i> ' + lang.copyToClipboard + '</button>' +
                        '</div>' +
                        '</div>' +
                        '<p class="mt-2 mb-0"><small>' + lang.savePassword + ' ' + lang.passwordSaved + '</small></p>' +
                        '</div>';

                    // Create a modal to show the password
                    var modal = document.createElement('div');
                    modal.className = 'arkhost-confirm-overlay show';
                    modal.innerHTML = '<div class="arkhost-confirm-dialog" style="max-width: 500px;">' +
                        '<div class="arkhost-confirm-title"><i class="fa fa-key text-success"></i> ' + lang.confirmResetPasswordTitle + '</div>' +
                        '<div class="arkhost-confirm-message">' + passwordHtml + '</div>' +
                        '<div class="arkhost-confirm-buttons">' +
                        '<button class="arkhost-confirm-btn confirm" onclick="this.closest(\'.arkhost-confirm-overlay\').remove()">' + lang.close + '</button>' +
                        '</div>' +
                        '</div>';
                    document.body.appendChild(modal);
                }
            });
        }
    );
    return false;
}

function copyToClipboard(elementId) {
    var copyText = document.getElementById(elementId);
    copyText.select();
    copyText.setSelectionRange(0, 99999);
    document.execCommand("copy");
    showNotification(lang.passwordCopied || 'Password copied!', 'success');
}


// Custom notification functions
function showNotification(message, type, duration) {
    type = type || 'success';
    duration = duration || 4000;
    
    // Remove existing notifications
    var existing = document.querySelectorAll('.arkhost-notification');
    for (var i = 0; i < existing.length; i++) {
        existing[i].remove();
    }
    
    // Create notification element
    var notification = document.createElement('div');
    notification.className = 'arkhost-notification ' + type;
    
    // Set icon based on type
    var icon = 'fa-check-circle';
    if (type === 'error') icon = 'fa-exclamation-circle';
    else if (type === 'warning') icon = 'fa-exclamation-triangle';
    else if (type === 'info') icon = 'fa-info-circle';
    
    notification.innerHTML = '<i class="fa ' + icon + '"></i><span>' + message + '</span><button class="close-btn" onclick="this.parentElement.remove()"><i class="fa fa-times"></i></button>';
    
    // Add to document
    document.body.appendChild(notification);
    
    // Trigger animation
    setTimeout(function() {
        notification.classList.add('show');
    }, 100);
    
    // Auto remove
    setTimeout(function() {
        notification.classList.remove('show');
        setTimeout(function() {
            if (notification.parentElement) {
                notification.remove();
            }
        }, 300);
    }, duration);
}

function showConfirm(message, title, onConfirm) {
    title = title || 'Confirm Action';
    
    // Remove existing confirms
    var existing = document.querySelectorAll('.arkhost-confirm-overlay');
    for (var i = 0; i < existing.length; i++) {
        existing[i].remove();
    }
    
    // Create confirm dialog
    var overlay = document.createElement('div');
    overlay.className = 'arkhost-confirm-overlay';
    
    overlay.innerHTML = '<div class="arkhost-confirm-dialog"><div class="arkhost-confirm-title"><i class="fa fa-exclamation-triangle" style="color: #ffc107;"></i>' + title + '</div><div class="arkhost-confirm-message">' + message + '</div><div class="arkhost-confirm-buttons"><button class="arkhost-confirm-btn cancel">' + (lang.confirmCancel || 'Cancel') + '</button><button class="arkhost-confirm-btn confirm">' + (lang.confirmConfirm || 'Confirm') + '</button></div></div>';
    
    // Add event listeners
    var cancelBtn = overlay.querySelector('.cancel');
    var confirmBtn = overlay.querySelector('.confirm');
    
    cancelBtn.onclick = function() {
        overlay.classList.remove('show');
        setTimeout(function() {
            if (overlay.parentElement) {
                overlay.remove();
            }
        }, 300);
    };
    
    confirmBtn.onclick = function() {
        overlay.classList.remove('show');
        setTimeout(function() {
            if (overlay.parentElement) {
                overlay.remove();
            }
        }, 300);
        if (onConfirm) {
            onConfirm();
        }
    };
    
    // Close on backdrop click
    overlay.onclick = function(e) {
        if (e.target === overlay) {
            overlay.classList.remove('show');
            setTimeout(function() {
                if (overlay.parentElement) {
                    overlay.remove();
                }
            }, 300);
        }
    };
    
    // Add to document and show
    document.body.appendChild(overlay);
    setTimeout(function() {
        overlay.classList.add('show');
    }, 100);
}

// Helper functions for API calls via WHMCS (use existing jQuery)
function ArkHostHetznerVPS_API(action, showAlert, params, callback, errorCallback) {
    if (showAlert === undefined) showAlert = true;
    if (params === undefined) params = {};
    if (typeof params === 'function') {
        callback = params;
        params = {};
    }
    
    var postData = Object.assign({ 
        action: 'productdetails',
        id: window.serviceId || '',
        modop: 'custom',
        a: 'ClientAreaAPI',
        api: action,
        token: window.csrfToken || '' // Add CSRF token to prevent session timeouts
    }, params);
    
    // Use existing WHMCS jQuery with proper headers
    if (typeof jQuery !== 'undefined') {
        jQuery.post({
            url: window.webRoot + '/clientarea.php',
            data: postData,
            dataType: 'json',
            beforeSend: function(xhr) {
                // Add CSRF token header for additional security
                xhr.setRequestHeader('X-CSRF-Token', window.csrfToken || '');
            },
            success: function(data) {
                // Check for success - WHMCS might return different success indicators
                var isSuccess = (data.result === 'success') || 
                               (data && typeof data === 'object' && !data.error && !data.message) ||
                               (Array.isArray(data)) ||
                               (data && Object.keys(data).some(key => !isNaN(key))); // Has numeric keys
                
                if (isSuccess) {
                    if (showAlert) showNotification(lang.moduleactionsuccess, 'success');
                    
                    // Call callback if provided
                    if (callback && typeof callback === 'function') {
                        callback(data);
                    }
                    
                    // Handle specific responses
                    if (action === 'List backups') {
                        updateBackupTable(data);
                    }
                    if (action === 'Create backup') {
                        // Refresh backup list after creation
                        setTimeout(function() {
                            ArkHostHetznerVPS_API('List backups', false);
                        }, 1000);
                    }
                    if (action === 'Delete backup') {
                        // Refresh backup list after deletion
                        setTimeout(function() {
                            ArkHostHetznerVPS_API('List backups', false);
                        }, 1000);
                    }
                    if (action === 'Add Firewall rules') {
                        // Clear the form
                        document.getElementById('firewallDirection').value = 'in';
                        document.getElementById('firewallAction').value = 'ACCEPT';
                        document.getElementById('firewallPort').value = '';
                        document.getElementById('firewallProtocol').value = 'ANY';
                        document.getElementById('firewallSource').value = '';
                        
                        // Refresh firewall rules after adding
                        setTimeout(function() {
                            ArkHostHetznerVPS_API('Get Firewall rules', false);
                        }, 1000);
                    }
                    if (action === 'Delete Firewall rule') {
                        // Refresh firewall rules after deletion
                        setTimeout(function() {
                            ArkHostHetznerVPS_API('Get Firewall rules', false);
                        }, 1000);
                    }
                    if (action === 'Get Firewall rules') updateFirewallTable(data);
                    if (action === 'ISO Images') updateISOSelect(data.isos || data);
                    if (action === 'List SSH Keys' && callback) callback(data);
                    if (action === 'Graphs') updateGraphsDisplay(data);

                    // Refresh page for server state changes
                    if (['Start', 'Stop', 'Reboot', 'Reinstall'].indexOf(action) !== -1) {
                        setTimeout(function() { location.reload(); }, 2000);
                    }
                } else {
                    if (showAlert) showNotification(lang.moduleactionfailed + ': ' + (data.message || 'Unknown error'), 'error');
                    // Hide loading for graphs
                    if (action === 'Graphs') {
                        document.getElementById('graphs-loading').style.display = 'none';
                        document.getElementById('graphs-container').style.opacity = '1';
                    }
                    if (errorCallback) errorCallback(data);
                }
            },
            error: function(xhr, status, error) {
                if (showAlert) showNotification(lang.moduleactionfailed + ': ' + (lang.networkError || 'Network error'), 'error');
                // Hide loading for graphs
                if (action === 'Graphs') {
                    document.getElementById('graphs-loading').style.display = 'none';
                    document.getElementById('graphs-container').style.opacity = '1';
                }
                if (errorCallback) errorCallback({error: 'Network error'});
            }
        });
    }
    
    return false;
}

function updateBackupTable(data) {
    var tableBody = document.querySelector('#backupTable tbody');
    tableBody.innerHTML = '';
    
    // Handle the Hetzner API response format
    var backupList = [];
    
    // Handle different response formats
    if (Array.isArray(data)) {
        // Direct array response
        backupList = data;
    } else if (data && typeof data === 'object') {
        // Check if there are numeric keys (0, 1, 2, etc.) indicating backup array
        var keys = Object.keys(data);
        var numericKeys = keys.filter(function(key) { return !isNaN(key); });
        if (numericKeys.length > 0) {
            backupList = numericKeys.map(function(key) { return data[key]; });
        } else if (data.result === 'success') {
            // WHMCS wrapper with result='success' - look for numeric keys excluding 'result'
            var filteredKeys = keys.filter(function(key) { return !isNaN(key) && key !== 'result'; });
            if (filteredKeys.length > 0) {
                backupList = filteredKeys.map(function(key) { return data[key]; });
            }
        }
    }
    
    if (backupList.length > 0) {
        backupList.forEach(function(backup) {
            if (backup && (backup.id || backup.file)) {
                var row = document.createElement('tr');
                
                // Use created date for Hetzner backups
                var backupDate = backup.created || backup.date || 'N/A';
                if (backupDate !== 'N/A' && backupDate.includes('T')) {
                    // Format ISO date to YYYY-MM-DD
                    backupDate = backupDate.split('T')[0];
                }
                
                // Determine backup type based on description
                // Manual backups have descriptions starting with "Manual backup -"
                var backupName = backup.name || '';
                var backupType = backupName.indexOf('Manual backup -') === 0 ? lang.backups.manual : lang.backups.automatic;
                
                // Format size (already in GB from API)
                var sizeStr = 'N/A';
                if (backup.size) {
                    sizeStr = backup.size + ' ' + lang.general.gb;
                }
                
                // Determine status badge based on size first (more reliable than API status)
                var statusBadge;
                if (!backup.size || backup.size === 0 || backup.size === '0') {
                    // Backup is still being created (size not available yet)
                    statusBadge = '<span class="badge badge-warning">' + lang.backups.creating + '</span>';
                } else if (backup.status === 'available' || backup.size > 0) {
                    // Backup is ready (has a size)
                    statusBadge = '<span class="badge badge-success">' + lang.backups.available + '</span>';
                } else if (backup.status === 'creating') {
                    // Status says creating but has size (unlikely but possible)
                    statusBadge = '<span class="badge badge-warning">' + lang.backups.creating + '</span>';
                } else {
                    // Other statuses (error, etc)
                    statusBadge = '<span class="badge badge-danger">' + (backup.status || lang.backups.error) + '</span>';
                }
                
                // Use backup ID for Hetzner
                var backupId = backup.id || backup.file;

                // Disable buttons if backup is still being created (size not available)
                var isCreating = (!backup.size || backup.size === 0 || backup.size === '0');
                var disabledAttr = isCreating ? ' disabled' : '';
                var disabledClass = isCreating ? ' disabled' : '';

                row.innerHTML =
                    '<td>' + backupDate + '</td>' +
                    '<td>' + sizeStr + '</td>' +
                    '<td>' + backupType + '</td>' +
                    '<td>' + statusBadge + '</td>' +
                    '<td style="white-space: nowrap;">' +
                        '<button class="btn btn-xs btn-primary mr-1' + disabledClass + '" style="padding: 4px 8px; font-size: 12px;" onclick="restoreBackup(\'' + backupId + '\'); return false;" title="' + lang.restore + '"' + disabledAttr + '>' +
                            '<i class="fa fa-undo"></i>' +
                        '</button>' +
                        '<button class="btn btn-xs btn-danger' + disabledClass + '" style="padding: 4px 8px; font-size: 12px;" onclick="deleteBackup(\'' + backupId + '\'); return false;" title="' + lang.delete + '"' + disabledAttr + '>' +
                            '<i class="fa fa-trash"></i>' +
                        '</button>' +
                    '</td>';
                tableBody.appendChild(row);
            }
        });
    } else {
        tableBody.innerHTML = '<tr><td colspan="5" class="text-center text-muted">' + lang.general.noBackupsFound + '</td></tr>';
    }
}

function createBackup() {
    showConfirm(
        lang.confirm.createBackup.message,
        lang.confirm.createBackup.title,
        function() {
            ArkHostHetznerVPS_API('Create backup', true);
        }
    );
    return false;
}

function deleteBackup(backupId) {
    showConfirm(
        lang.confirm.deleteBackup.message,
        lang.confirm.deleteBackup.title,
        function() {
            ArkHostHetznerVPS_API('Delete backup', true, { image_id: backupId });
        }
    );
    return false;
}

function restoreBackup(backupId) {
    showConfirm(
        lang.confirm.restoreBackup.message,
        lang.confirm.restoreBackup.title,
        function() {
            ArkHostHetznerVPS_API('Restore backup', true, { image_id: backupId });
        }
    );
    return false;
}

function updateFirewallTable(data) {
    var tableBody = document.querySelector('#firewallTable tbody');
    if (!tableBody) return;
    
    // Clear all rows
    tableBody.innerHTML = '';
    
    // Handle the API response format
    var rulesList = [];
    
    // Handle different response formats
    if (Array.isArray(data)) {
        rulesList = data;
    } else if (data && typeof data === 'object') {
        var keys = Object.keys(data);
        var numericKeys = keys.filter(function(key) { return !isNaN(key); });
        if (numericKeys.length > 0) {
            rulesList = numericKeys.map(function(key) { return data[key]; });
        } else if (data.rules && Array.isArray(data.rules)) {
            rulesList = data.rules;
        } else if (data.result === 'success') {
            var filteredKeys = keys.filter(function(key) { return !isNaN(key) && key !== 'result'; });
            if (filteredKeys.length > 0) {
                rulesList = filteredKeys.map(function(key) { return data[key]; });
            }
        }
    }
    
    // Add firewall rules if any exist
    if (rulesList.length > 0) {
        rulesList.forEach(function(rule) {
            if (rule && rule.id) {
                var actionBadge;
                if (rule.action === 'ACCEPT') {
                    actionBadge = '<span class="badge badge-success"><i class="fa fa-check mr-1"></i>' + lang.firewall.accept + '</span>';
                } else if (rule.action === 'DROP') {
                    actionBadge = '<span class="badge badge-danger"><i class="fa fa-times mr-1"></i>' + lang.firewall.drop + '</span>';
                } else if (rule.action === 'INFO') {
                    actionBadge = '<span class="badge badge-info"><i class="fa fa-info-circle mr-1"></i>' + lang.firewall.info + '</span>';
                } else {
                    actionBadge = '<span class="badge badge-secondary">' + rule.action + '</span>';
                }
                
                var protocolBadge = '<span class="badge badge-secondary">' + (rule.protocol || lang.firewall.any) + '</span>';
                
                // Direction badge
                var directionBadge = '';
                if (rule.direction === 'out') {
                    directionBadge = '<span class="badge badge-warning"><i class="fa fa-arrow-up mr-1"></i>' + (lang.firewall.outgoing || 'OUT') + '</span>';
                } else {
                    directionBadge = '<span class="badge badge-info"><i class="fa fa-arrow-down mr-1"></i>' + (lang.firewall.incoming || 'IN') + '</span>';
                }
                
                var row = document.createElement('tr');
                row.innerHTML = 
                    '<td>' + directionBadge + '</td>' +
                    '<td>' + actionBadge + '</td>' +
                    '<td>' + protocolBadge + '</td>' +
                    '<td>' + (rule.port || '<span class="text-muted">' + lang.general.any + '</span>') + '</td>' +
                    '<td><code>' + (rule.source || '0.0.0.0/0') + '</code></td>' +
                    '<td class="text-center">' +
                        (rule.id !== 'info' ? 
                            '<button class="btn btn-sm btn-danger" onclick="deleteFirewallRule(\'' + rule.id + '\'); return false;" title="' + lang.delete + '">' +
                                '<i class="fa fa-trash"></i>' +
                            '</button>' 
                            : '<span class="text-muted">' + lang.general.emptyValue + '</span>') +
                    '</td>';
                tableBody.appendChild(row);
            }
        });
    } else {
        tableBody.innerHTML = '<tr><td colspan="6" class="text-center text-muted py-4">' + lang.general.noFirewallRules + '</td></tr>';
    }
}

function addFirewallRule() {
    var direction = document.getElementById('firewallDirection').value;
    var action = document.getElementById('firewallAction').value;
    var protocol = document.getElementById('firewallProtocol').value;
    var port = document.getElementById('firewallPort').value;
    var source = document.getElementById('firewallSource').value || '0.0.0.0/0';
    
    // Validate port for TCP/UDP
    if ((protocol === 'TCP' || protocol === 'UDP' || protocol === 'ANY') && !port) {
        showNotification(lang.messages.portRequired, 'error');
        document.getElementById('firewallPort').focus();
        return false;
    }
    
    // Validate port format (single port or range)
    if (port) {
        // Check if it's a range (e.g., "8080-8090")
        if (port.includes('-')) {
            var parts = port.split('-');
            if (parts.length !== 2) {
                showNotification('Invalid port range format. Use format: 8080-8090', 'error');
                document.getElementById('firewallPort').focus();
                return false;
            }
            var startPort = parseInt(parts[0]);
            var endPort = parseInt(parts[1]);
            if (isNaN(startPort) || isNaN(endPort) || startPort < 1 || startPort > 65535 || endPort < 1 || endPort > 65535) {
                showNotification('Port range values must be between 1 and 65535', 'error');
                document.getElementById('firewallPort').focus();
                return false;
            }
            if (startPort >= endPort) {
                showNotification('Start port must be less than end port', 'error');
                document.getElementById('firewallPort').focus();
                return false;
            }
        } else {
            // Single port
            var portNum = parseInt(port);
            if (isNaN(portNum) || portNum < 1 || portNum > 65535) {
                showNotification('Port must be between 1 and 65535', 'error');
                document.getElementById('firewallPort').focus();
                return false;
            }
        }
    }
    
    ArkHostHetznerVPS_API('Add Firewall rules', true, { 
        direction: direction,
        firewallAction: action, 
        protocol: protocol, 
        source: source, 
        port: port 
    });
    
    return false;
}

function deleteFirewallRule(ruleId) {
    showConfirm(
        lang.confirmDeleteFirewallRuleMessage || 'Delete this firewall rule?',
        lang.confirmDeleteFirewallRuleTitle || 'Delete Firewall Rule',
        function() {
            ArkHostHetznerVPS_API('Delete Firewall rule', true, { rule_id: ruleId });
        }
    );
    return false;
}

function updateISOSelect(data) {
    var select = document.getElementById('isoID');
    if (!select) return;
    
    // Clear existing options except the first one
    select.innerHTML = '<option value="">' + (lang.selectISOImage || 'Select ISO Image...') + '</option>';
    
    // Function to check if a value looks like a valid ISO
    function isValidISO(value, name) {
        if (!value || !name) return false;
        
        // Convert to strings for comparison
        var valueStr = String(value).toLowerCase();
        var nameStr = String(name).toLowerCase();
        
        // Filter out common non-ISO values
        var invalidValues = ['success', 'error', 'status', 'result', 'message', 'data'];
        if (invalidValues.includes(valueStr) || invalidValues.includes(nameStr)) {
            return false;
        }
        
        // For Hetzner, if it has an ID and name, it's valid
        return true;
    }
    
    // Handle different possible response formats from Hetzner API
    if (data) {
        // Format 1: Array of ISO objects (Hetzner format)
        if (Array.isArray(data)) {
            data.forEach(function(iso) {
                if (iso && (iso.id || iso.name)) {
                    // For Hetzner, ISOs are identified by name, not ID
                    var isoValue = iso.name || iso.id;
                    var isoName = iso.description || iso.name || 'ISO ' + iso.id;
                    
                    // Add architecture info if available
                    if (iso.architecture) {
                        isoName += ' (' + iso.architecture.toUpperCase() + ')';
                    }
                    
                    if (isValidISO(isoValue, isoName)) {
                        var option = document.createElement('option');
                        option.value = isoValue;
                        option.textContent = isoName;
                        select.appendChild(option);
                    }
                }
            });
        }
        // Format 2: Object with ISO IDs as keys
        else if (typeof data === 'object') {
            Object.keys(data).forEach(function(key) {
                var iso = data[key];
                if (iso && typeof iso === 'object') {
                    var isoValue = iso.id || iso.iso_id || iso.filename || key;
                    var isoName = iso.name || iso.filename || iso.label || key;
                    
                    if (isValidISO(isoValue, isoName)) {
                        var option = document.createElement('option');
                        option.value = isoValue;
                        option.textContent = isoName;
                        select.appendChild(option);
                    }
                } else if (typeof iso === 'string') {
                    // Simple key-value format
                    if (isValidISO(key, iso)) {
                        var option = document.createElement('option');
                        option.value = key;
                        option.textContent = iso;
                        select.appendChild(option);
                    }
                }
            });
        }
    }
    
    // If no ISOs were added, show a message
    if (select.options.length === 1) {
        var option = document.createElement('option');
        option.value = '';
        option.textContent = lang.noISOImages || 'No ISO images available';
        option.disabled = true;
        select.appendChild(option);
    }
}

// Helper function to resize graph images
function resizeGraphImage(htmlContent) {
    if (htmlContent.includes('<img')) {
        // If it's HTML with img tag, modify the img tag to add our styling
        return htmlContent.replace(/<img([^>]*?)>/g, '<img$1 style="max-width: 96%; height: auto;">');
    }
    return htmlContent;
}

// Simple chart creation functions
function createSimpleLineChart(data, labels, title, color) {
    if (!data || data.length === 0) {
        return '<p class="text-muted">' + (lang.general.noDataAvailable || 'No data available') + '</p>';
    }
    
    var max = Math.max(...data);
    // Ensure max is at least 100 for CPU percentage
    if (title.includes('CPU') && max < 100) max = 100;
    if (max < 1) max = 1;
    
    var html = '<div class="simple-chart">';
    html += '<h6 class="text-muted mb-3">' + title + '</h6>';
    html += '<div class="chart-container" style="position: relative; height: 250px;">';
    
    // Add Y-axis labels container
    html += '<div style="position: absolute; left: 0; top: 0; bottom: 40px; width: 50px; display: flex; flex-direction: column; justify-content: space-between; text-align: right; padding-right: 10px;">';
    for (var i = 4; i >= 0; i--) {
        var value = (max / 4) * i;
        html += '<small style="color: #666; font-size: 11px;">' + Math.round(value) + '%</small>';
    }
    html += '</div>';
    
    // Chart area with left margin for labels
    html += '<div style="margin-left: 55px; height: 210px; border: 1px solid #e0e0e0; background: #fafafa; position: relative; overflow: hidden;">';
    html += '<svg viewBox="0 0 500 200" preserveAspectRatio="none" style="width: 100%; height: 100%;">';
    
    // Grid lines
    for (var i = 0; i <= 4; i++) {
        var y = i * 50;
        html += '<line x1="0" y1="' + y + '" x2="500" y2="' + y + '" stroke="#e0e0e0" stroke-width="1"/>';
    }
    
    // Add some vertical grid lines for time reference
    for (var i = 0; i <= 5; i++) {
        var x = i * 100;
        html += '<line x1="' + x + '" y1="0" x2="' + x + '" y2="200" stroke="#f5f5f5" stroke-width="1"/>';
    }
    
    // Draw line
    var points = '';
    for (var i = 0; i < data.length; i++) {
        var x = (i / (data.length - 1)) * 500;
        var y = 200 - (data[i] / max) * 190;
        points += x + ',' + y + ' ';
    }
    html += '<polyline points="' + points + '" fill="none" stroke="' + color + '" stroke-width="2"/>';
    
    // Add dots on data points for better visibility
    for (var i = 0; i < data.length; i++) {
        var x = (i / (data.length - 1)) * 500;
        var y = 200 - (data[i] / max) * 190;
        html += '<circle cx="' + x + '" cy="' + y + '" r="2" fill="' + color + '"/>';
    }
    
    html += '</svg>';
    html += '</div>';
    
    // Time labels at bottom
    html += '<div style="margin-left: 55px; margin-top: 5px; display: flex; justify-content: space-between; font-size: 11px; color: #666;">';
    if (labels && labels.length > 0) {
        var step = Math.ceil(labels.length / 6);
        for (var i = 0; i < labels.length; i += step) {
            html += '<small>' + labels[i] + '</small>';
        }
        html += '<small>' + labels[labels.length - 1] + '</small>';
    }
    html += '</div>';
    
    // Current value
    html += '<div class="text-center mt-3">';
    html += '<span class="badge" style="background: ' + color + '">' + (lang.graphs.current || 'Current') + lang.general.colon + Math.round(data[data.length - 1]) + lang.graphs.cpuUnit + '</span>';
    html += '</div></div></div>';
    
    return html;
}

function createDoubleLineChart(data1, data2, labels, title, label1, label2, color1, color2) {
    if (!data1 || data1.length === 0) {
        return '<p class="text-muted">' + (lang.general.noDataAvailable || 'No data available') + '</p>';
    }
    
    var max = Math.max(...data1, ...data2);
    // Ensure minimum scale for better visibility
    if (max < 1) max = 1;
    
    // Format function for values based on title
    var formatValue = function(val) {
        if (title.includes(lang.graphs.networkUnit)) {
            return val.toFixed(2) + ' ' + lang.graphs.networkUnit;
        } else if (title.includes(lang.graphs.diskUnit)) {
            return Math.round(val) + ' ' + lang.graphs.diskUnit;
        }
        return val.toFixed(1);
    };
    
    var html = '<div class="simple-chart">';
    html += '<h6 class="text-muted mb-3">' + title + '</h6>';
    html += '<div class="chart-container" style="position: relative; height: 250px;">';
    
    // Add Y-axis labels container
    html += '<div style="position: absolute; left: 0; top: 0; bottom: 40px; width: 60px; display: flex; flex-direction: column; justify-content: space-between; text-align: right; padding-right: 10px;">';
    for (var i = 4; i >= 0; i--) {
        var value = (max / 4) * i;
        html += '<small style="color: #666; font-size: 11px;">' + (value >= 1 ? Math.round(value) : value.toFixed(2)) + '</small>';
    }
    html += '</div>';
    
    // Chart area with left margin for labels
    html += '<div style="margin-left: 65px; height: 210px; border: 1px solid #e0e0e0; background: #fafafa; position: relative; overflow: hidden;">';
    html += '<svg viewBox="0 0 500 200" preserveAspectRatio="none" style="width: 100%; height: 100%;">';
    
    // Grid lines
    for (var i = 0; i <= 4; i++) {
        var y = i * 50;
        html += '<line x1="0" y1="' + y + '" x2="500" y2="' + y + '" stroke="#e0e0e0" stroke-width="1"/>';
    }
    
    // Add some vertical grid lines for time reference
    for (var i = 0; i <= 5; i++) {
        var x = i * 100;
        html += '<line x1="' + x + '" y1="0" x2="' + x + '" y2="200" stroke="#f5f5f5" stroke-width="1"/>';
    }
    
    // Line 1
    var points1 = '';
    for (var i = 0; i < data1.length; i++) {
        var x = (i / (data1.length - 1)) * 500;
        var y = 200 - (data1[i] / max) * 190;
        points1 += x + ',' + y + ' ';
    }
    html += '<polyline points="' + points1 + '" fill="none" stroke="' + color1 + '" stroke-width="2"/>';
    
    // Line 2
    var points2 = '';
    for (var i = 0; i < data2.length; i++) {
        var x = (i / (data2.length - 1)) * 500;
        var y = 200 - (data2[i] / max) * 190;
        points2 += x + ',' + y + ' ';
    }
    html += '<polyline points="' + points2 + '" fill="none" stroke="' + color2 + '" stroke-width="2"/>';
    
    html += '</svg>';
    html += '</div>';
    
    // Time labels at bottom
    html += '<div style="margin-left: 65px; margin-top: 5px; display: flex; justify-content: space-between; font-size: 11px; color: #666;">';
    if (labels && labels.length > 0) {
        var step = Math.ceil(labels.length / 6);
        for (var i = 0; i < labels.length; i += step) {
            html += '<small>' + labels[i] + '</small>';
        }
        html += '<small>' + labels[labels.length - 1] + '</small>';
    }
    html += '</div>';
    
    // Legend with current values
    html += '<div class="text-center mt-3">';
    html += '<span class="badge" style="background: ' + color1 + '; margin-right: 10px;">' + label1 + lang.general.colon + formatValue(data1[data1.length - 1]) + '</span>';
    html += '<span class="badge" style="background: ' + color2 + '">' + label2 + lang.general.colon + formatValue(data2[data2.length - 1]) + '</span>';
    html += '</div></div></div>';
    
    return html;
}

function updateGraphsDisplay(data) {
    // Hide loading indicator
    document.getElementById('graphs-loading').style.display = 'none';
    document.getElementById('graphs-container').style.opacity = '1';
    
    // Update graphs if data is available
    if (data.graphs && data.graphs.type === 'metrics' && data.graphs.data) {
        var metricsData = data.graphs.data;
        
        // Display CPU graph
        if (metricsData.cpu) {
            var cpuHtml = createSimpleLineChart(metricsData.cpu.data, metricsData.cpu.labels, lang.graphs.cpuUsage + ' (' + lang.graphs.cpuUnit + ')', '#e74c3c');
            document.getElementById('cpu-graph').innerHTML = cpuHtml;
        }
        
        // Display Disk I/O graph
        if (metricsData.disk) {
            var diskHtml = createDoubleLineChart(
                metricsData.disk.read, 
                metricsData.disk.write, 
                metricsData.disk.labels, 
                lang.graphs.diskIO + ' (' + lang.graphs.diskUnit + ')', 
                lang.graphs.read || 'Read', 
                lang.graphs.write || 'Write',
                '#f39c12',
                '#e67e22'
            );
            document.getElementById('disk-graph').innerHTML = diskHtml;
        }
        
        // Display Network graph
        if (metricsData.network) {
            var networkHtml = createDoubleLineChart(
                metricsData.network.in, 
                metricsData.network.out, 
                metricsData.network.labels, 
                lang.graphs.networkTraffic + ' (' + lang.graphs.networkUnit + ')', 
                lang.graphs.inbound || 'Inbound', 
                lang.graphs.outbound || 'Outbound',
                '#3498db',
                '#2980b9'
            );
            document.getElementById('network-graph').innerHTML = networkHtml;
        }
        
    } else if (data.graphs && data.graphs.type === 'none') {
        // No metrics available
        var noMetricsMessage = '<p class="text-muted">' + (data.graphs.message || 'Metrics not available') + '</p>';
        document.getElementById('cpu-graph').innerHTML = noMetricsMessage;
        document.getElementById('network-graph').innerHTML = noMetricsMessage;
        document.getElementById('disk-graph').innerHTML = noMetricsMessage;
    } else {
        // Fallback
        document.getElementById('cpu-graph').innerHTML = '<p class="text-muted">Metrics data format not recognized</p>';
        document.getElementById('network-graph').innerHTML = '<p class="text-muted">Metrics data format not recognized</p>';
        document.getElementById('disk-graph').innerHTML = '<p class="text-muted">Metrics data format not recognized</p>';
    }
}
        
// Load initial graphs when tab is first opened
var graphsLoaded = false;
function loadInitialGraphs() {
    if (!graphsLoaded) {
        setTimeout(function() {
            loadGraphs('day', document.querySelector('.graph-time-btn.active'));
            graphsLoaded = true;
        }, 100);
    }
}

// Load backups when tab is first opened
var backupsLoaded = false;
function loadBackups() {
    if (!backupsLoaded) {
        // Show loading state
        var tableBody = document.querySelector('#backupTable tbody');
        if (tableBody) {
            tableBody.innerHTML = '<tr><td colspan="5" class="text-center"><i class="fa fa-spinner fa-spin"></i> ' + (lang.loadingBackups || 'Loading backups...') + '</td></tr>';
        }
        
        setTimeout(function() {
            ArkHostHetznerVPS_API('List backups', false);
            backupsLoaded = true;
        }, 100);
    }
}

// Function to load graphs for different time periods
function loadGraphs(timePeriod, buttonElement) {
    // Update active button
    document.querySelectorAll('.graph-time-btn').forEach(btn => btn.classList.remove('active'));
    buttonElement.classList.add('active');
    
    // Show loading indicator
    document.getElementById('graphs-loading').style.display = 'block';
    document.getElementById('graphs-container').style.opacity = '0.5';
    
    // Use the existing ArkHostHetznerVPS_API function which now handles sessions properly
    ArkHostHetznerVPS_API('Graphs', false, { time: timePeriod });
}

// Function to refresh all graphs with current time period
function refreshAllGraphs() {
    // Find the currently active time period button
    var activeButton = document.querySelector('.graph-time-btn.active');
    if (activeButton) {
        // Show notification
        showNotification(lang.messages.refreshingGraphs, 'info');
        // Reload graphs with current time period
        activeButton.click();
    }
}

function ArkHostVPS_ChooseOS(element) {
    if (typeof jQuery !== 'undefined') {
        var osId = jQuery(element).data('os');
        var group = jQuery(element).data('group');
        jQuery('#newOS').val(osId);
        
        // FIRST: Reset ALL OS selections (clear all groups)
        jQuery('.os_badge .dropdown-toggle').removeClass('btn-success').addClass('btn-outline-secondary');
        jQuery('.os_badge .dropdown-item').removeClass('active bg-primary text-white');
        jQuery('.os_badge .version .fa-check').remove();
        jQuery('.os_badge .version').each(function() {
            var originalText = jQuery(this).text().replace(' ✓', '').replace(/\s*<i[^>]*><\/i>\s*/g, '');
            jQuery(this).text(originalText);
        });
        
        // THEN: Set the selected OS
        // Update the version text with the selected OS
        jQuery('#' + group + '-version').text(jQuery(element).text());
        
        // Add active class to the selected item
        jQuery(element).addClass('active bg-primary text-white');
        
        // Update the main button to show selected state
        var mainButton = jQuery('#' + group + '-os .dropdown-toggle');
        mainButton.removeClass('btn-outline-secondary').addClass('btn-success');
        
        // Add checkmark to show selection
        var versionSpan = jQuery('#' + group + '-version');
        versionSpan.append(' <i class="fa fa-check text-success"></i>');
        
        // No advanced options needed for Hetzner rebuild
    }
    return false;
}

function ArkHostVPS_ShowPassword() {
    if (typeof jQuery !== 'undefined') {
        var input = jQuery('#vpsPassword');
        var icon = jQuery('#showPasswordIcon');
        if (input.attr('type') === 'password') {
            input.attr('type', 'text');
            icon.removeClass('fa-eye').addClass('fa-eye-slash');
        } else {
            input.attr('type', 'password');
            icon.removeClass('fa-eye-slash').addClass('fa-eye');
        }
    }
    return false;
}

function reinstallWithAdvancedOptions() {
    var osId = document.getElementById('newOS').value;
    if (!osId || osId === '0') {
        showNotification(lang.messages.selectOSFirst, 'warning');
        return false;
    }
    
    // Hetzner rebuild only needs the image parameter
    var params = { os: osId };
    
    // Call the API
    ArkHostHetznerVPS_API('Reinstall', true, params);
    return false;
}