{*
 *	WHMCS Server Module - Hetzner VPS
 *	@package     WHMCS
 *	@copyright   ArkHost 2025
 *	@link        https://arkhost.com
 *	@author      ArkHost <support@arkhost.com>
 *}



<link rel="stylesheet" type="text/css" href="{$WEB_ROOT}/modules/servers/ArkHostHetznerVPS/template/style.css" />

<script type="text/javascript">
    // Initialize template variables for external script
    var productURL = '{$WEB_ROOT}/clientarea.php?action=productdetails&id={$serviceid}';
    var serverInfoInitial = JSON.parse('{$serverInfo|@json_encode}');
    var serviceId = '{$serviceid}';
    var csrfToken = '{$token}';
    var webRoot = '{$WEB_ROOT}';
    
    // Language strings
    var lang = {
        moduleactionfailed: '{$ADDONLANG.ActionFailed}',
        moduleactionsuccess: '{$ADDONLANG.ActionSuccess}',
        backups: {
            available: '{$ADDONLANG.Backups.Available}',
            creating: '{$ADDONLANG.Backups.Creating}',
            error: '{$ADDONLANG.Backups.Error}',
            automatic: '{$ADDONLANG.Backups.Automatic}',
            manual: '{$ADDONLANG.Backups.Manual}'
        },
        graphs: {
            cpuUsage: '{$ADDONLANG.Graphs.CPUUsage}',
            networkTraffic: '{$ADDONLANG.Graphs.NetworkTraffic}',
            diskIO: '{$ADDONLANG.Graphs.DiskIO}',
            cpuUnit: '{$ADDONLANG.Graphs.CPUUnit}',
            networkUnit: '{$ADDONLANG.Graphs.NetworkUnit}',
            diskUnit: '{$ADDONLANG.Graphs.DiskUnit}',
            current: '{$ADDONLANG.Graphs.Current}',
            inbound: '{$ADDONLANG.Graphs.Inbound}',
            outbound: '{$ADDONLANG.Graphs.Outbound}',
            read: '{$ADDONLANG.Graphs.Read}',
            write: '{$ADDONLANG.Graphs.Write}'
        },
        general: {
            noBackupsFound: '{$ADDONLANG.General.NoBackupsFound}',
            noFirewallRules: '{$ADDONLANG.General.NoFirewallRules}',
            noDataAvailable: '{$ADDONLANG.General.NoDataAvailable}',
            gb: '{$ADDONLANG.General.GB}',
            tb: '{$ADDONLANG.General.TB}',
            any: '{$ADDONLANG.General.Any}',
            emptyValue: '{$ADDONLANG.General.EmptyValue}',
            colon: '{$ADDONLANG.General.Colon}'
        },
        firewall: {
            accept: '{$ADDONLANG.Firewall.Accept}',
            drop: '{$ADDONLANG.Firewall.Drop}',
            info: '{$ADDONLANG.Firewall.Info}',
            any: '{$ADDONLANG.Firewall.Any}'
        },
        messages: {
            portRequired: '{$ADDONLANG.Messages.PortRequired}',
            refreshingGraphs: '{$ADDONLANG.Messages.RefreshingGraphs}',
            selectOSFirst: '{$ADDONLANG.Messages.SelectOSFirst}'
        },
        confirm: {
            stop: {
                title: "{$ADDONLANG.Confirm.Stop.Title|escape:'javascript'|default:'Stop VPS'}",
                message: "{$ADDONLANG.Confirm.Stop.Message|escape:'javascript'|default:'Do you want to stop this VPS. This will shutdown the server.'}"
            },
            restart: {
                title: "{$ADDONLANG.Confirm.Restart.Title|escape:'javascript'|default:'Restart VPS'}",
                message: "{$ADDONLANG.Confirm.Restart.Message|escape:'javascript'|default:'Do you want to restart this VPS. This will reboot the server.'}"
            },
            createBackup: {
                title: "{$ADDONLANG.Confirm.CreateBackup.Title|escape:'javascript'|default:'Create Backup'}",
                message: "{$ADDONLANG.Confirm.CreateBackup.Message|escape:'javascript'|default:'Do you want to create a backup. This may take several minutes.'}"
            },
            deleteBackup: {
                title: "{$ADDONLANG.Confirm.DeleteBackup.Title|escape:'javascript'|default:'Delete Backup'}",
                message: "{$ADDONLANG.Confirm.DeleteBackup.Message|escape:'javascript'|default:'Do you want to delete this backup. This action cannot be undone.'}"
            },
            restoreBackup: {
                title: "{$ADDONLANG.Confirm.RestoreBackup.Title|escape:'javascript'|default:'Restore Backup'}",
                message: "{$ADDONLANG.Confirm.RestoreBackup.Message|escape:'javascript'|default:'Do you want to restore this backup. This will overwrite all current data and cannot be undone.'}"
            }
        }
    };
    
    // VPS control functions
    
    // Additional language string mappings
    lang.confirmShutdownMessage = '{$ADDONLANG.Confirm.Shutdown.Message}';
    lang.confirmShutdownTitle = '{$ADDONLANG.Confirm.Shutdown.Title}';
    lang.confirmEnableRescueMessage = '{$ADDONLANG.Confirm.EnableRescue.Message}';
    lang.confirmEnableRescueTitle = '{$ADDONLANG.Confirm.EnableRescue.Title}';
    lang.rescueModeEnabled = '{$ADDONLANG.RescueModeEnabled}';
    lang.savePassword = '{$ADDONLANG.SavePassword}';
    lang.confirmEnableRescueRebootMessage = '{$ADDONLANG.Confirm.EnableRescueReboot.Message}';
    lang.confirmEnableRescueRebootTitle = '{$ADDONLANG.Confirm.EnableRescueReboot.Title}';
    lang.confirmDisableRescueMessage = '{$ADDONLANG.Confirm.DisableRescue.Message}';
    lang.confirmDisableRescueTitle = '{$ADDONLANG.Confirm.DisableRescue.Title}';
    lang.confirmResetPasswordMessage = '{$ADDONLANG.Confirm.ResetPassword.Message}';
    lang.confirmResetPasswordTitle = '{$ADDONLANG.Confirm.ResetPassword.Title}';
    lang.newRootPassword = '{$ADDONLANG.Settings.Rescue.NewRootPassword}';
    lang.passwordPrompt = '{$ADDONLANG.Settings.Rescue.PasswordPrompt}';
    lang.copyToClipboard = '{$ADDONLANG.CopyToClipboard}';
    lang.passwordSaved = '{$ADDONLANG.PasswordSaved}';
    lang.close = '{$ADDONLANG.Close}';
    lang.passwordCopied = '{$ADDONLANG.PasswordCopied}';
    lang.confirmCancel = '{$ADDONLANG.Confirm.Cancel|escape:'javascript'|default:'Cancel'}';
    lang.confirmConfirm = '{$ADDONLANG.Confirm.Confirm|escape:'javascript'|default:'Confirm'}';
    lang.networkError = '{$ADDONLANG.NetworkError}';
    lang.restore = '{$ADDONLANG.Restore}';
    lang.delete = '{$ADDONLANG.Delete}';
    lang.confirmDeleteFirewallRuleMessage = '{$ADDONLANG.Confirm.DeleteFirewallRule.Message}';
    lang.confirmDeleteFirewallRuleTitle = '{$ADDONLANG.Confirm.DeleteFirewallRule.Title}';
    lang.selectISOImage = '{$ADDONLANG.SelectISOImage}';
    lang.noISOImages = '{$ADDONLANG.NoISOImages}';
    lang.loadingBackups = '{$ADDONLANG.LoadingBackups}';
</script>

<div class="arkhost-vps-container">
    <div id="loading" class="fw-bold" style="display: none;">
        <span class="spinner-border spinner-border-sm" style="width: 3rem; height: 3rem;" id="loading-spinner" role="status" aria-hidden="true"></span>
    </div>

    <div id="ArkHostVPS">
        <div class="dashboard-tab" id="dashboard">
            <ul class="nav nav-tabs mb-4 dash-tabs" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="overview-tab" data-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">
                        <i class="fa fa-signal"></i> {$ADDONLANG.Navbar.Overview}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="graphs-tab" data-toggle="tab" href="#graphs" role="tab" aria-controls="graphs" aria-selected="false" onclick="loadInitialGraphs()">
                        <i class="fa fa-chart-bar"></i> {$ADDONLANG.Navbar.Graphs}
                    </a>
                </li>
                {if $backupsEnabled}
                <li class="nav-item">
                    <a class="nav-link" id="backups-tab" data-toggle="tab" href="#backups" onclick="loadBackups();return false;" role="tab" aria-controls="backups" aria-selected="false">
                        <i class="fa fa-archive"></i> {$ADDONLANG.Navbar.Backups}
                    </a>
                </li>
                {/if}
                <li class="nav-item">
                    <a class="nav-link" id="firewall-tab" data-toggle="tab" href="#firewall" onclick="ArkHostHetznerVPS_API('Get Firewall rules', false);return false;" role="tab" aria-controls="firewall" aria-selected="false">
                        <i class="fa fa-shield-alt"></i> {$ADDONLANG.Settings.Firewall.Title}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="settings-tab" data-toggle="tab" href="#settings" role="tab" aria-controls="settings" aria-selected="false">
                        <i class="fa fa-cog"></i> {$ADDONLANG.Navbar.Settings}
                    </a>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                    <!-- Server Status Card -->
                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0"><i class="fa fa-server mr-2"></i>{$ADDONLANG.Overview.ServerInfo}</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <table class="table table-sm table-borderless mb-0">
                                        <tr>
                                            <td class="text-muted" width="40%">{$ADDONLANG.Overview.Hostname}:</td>
                                            <td><strong>{$serverInfo['hostname']}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">{$ADDONLANG.IPv4} Address:</td>
                                            <td><code>{$serverInfo['ip']}</code></td>
                                        </tr>
                                        {if $serverInfo['ipv6']}
                                        <tr>
                                            <td class="text-muted">{$ADDONLANG.IPv6} Address:</td>
                                            <td><code style="font-size: 11px;">{$serverInfo['ipv6']}</code></td>
                                        </tr>
                                        {/if}
                                        <tr>
                                            <td class="text-muted">{$ADDONLANG.Overview.OS}:</td>
                                            <td>
                                                <img src="{$serverInfo['operatingSystem']['image']}" width="20" height="20" class="mr-1" style="vertical-align: middle;">
                                                {$serverInfo['operatingSystem']['name']}
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <table class="table table-sm table-borderless mb-0">
                                        <tr>
                                            <td class="text-muted" width="40%">{$ADDONLANG.Overview.Status}:</td>
                                            <td>
                                                <img src="{$serverInfo['statusImage']}" height="20" class="mr-1" style="vertical-align: middle;">
                                                <span class="{if $serverInfo['status'] == 'running'}text-success{else}text-danger{/if}">
                                                    <strong>{$serverInfo['statusDescription']}</strong>
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">{$ADDONLANG.Overview.Uptime}:</td>
                                            <td><strong>{$serverInfo['uptime_text']}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">{$ADDONLANG.Overview.Location}:</td>
                                            <td><i class="fa fa-map-marker-alt mr-1"></i>{$serverInfo['datacenter']}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">{$ADDONLANG.Overview.ServerType}:</td>
                                            <td><strong>{$serverInfo['server_type']['description']|default:$ADDONLANG.ServerTypes.Standard}</strong></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Resource Allocation Card -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0"><i class="fa fa-microchip mr-2"></i>{$ADDONLANG.Overview.ResourceAllocation}</h5>
                        </div>
                        <div class="card-body">
                            <div class="row text-center">
                                <div class="col-6 col-md-3 mb-3">
                                    <div class="resource-box">
                                        <i class="fa fa-microchip fa-2x text-primary mb-2"></i>
                                        <h3 class="mb-0">{$serverInfo['cpu']}</h3>
                                        <small class="text-muted">{$ADDONLANG.Overview.CPU_Cores}</small>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3 mb-3">
                                    <div class="resource-box">
                                        <i class="fa fa-memory fa-2x text-success mb-2"></i>
                                        <h3 class="mb-0">{$serverInfo['ram']} {$ADDONLANG.General.GB}</h3>
                                        <small class="text-muted">{$ADDONLANG.Overview.Memory}</small>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3 mb-3">
                                    <div class="resource-box">
                                        <i class="fa fa-hdd fa-2x text-warning mb-2"></i>
                                        <h3 class="mb-0">{$serverInfo['disk']} {$ADDONLANG.General.GB}</h3>
                                        <small class="text-muted">{$ADDONLANG.Overview.Storage}</small>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3 mb-3">
                                    <div class="resource-box">
                                        <i class="fa fa-network-wired fa-2x text-info mb-2"></i>
                                        <h3 class="mb-0">20 {$ADDONLANG.General.TB}</h3>
                                        <small class="text-muted">{$ADDONLANG.Overview.Traffic}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Quick Actions Card -->
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0"><i class="fa fa-bolt mr-2"></i>{$ADDONLANG.Overview.QuickActions}</h5>
                        </div>
                        <div class="card-body text-center">
                            <div class="d-flex justify-content-center flex-wrap" style="gap: 10px;">
                                <button class="btn btn-{if $serverInfo['status'] !== 'running'}success{else}danger{/if}"
                                        style="border-radius: 10px; padding: 8px 20px; font-size: 14px; margin: 5px;"
                                        onclick="{if $serverInfo['status'] !== 'running'}return ArkHostHetznerVPS_API('Start');{else}return confirmStop();{/if}">
                                    <i class="fa fa-{if $serverInfo['status'] !== 'running'}play{else}stop{/if} mr-1"></i>
                                    {if $serverInfo['status'] !== 'running'}{$ADDONLANG.Start}{else}{$ADDONLANG.Stop}{/if}
                                </button>
                                <button class="btn btn-primary"
                                        style="border-radius: 10px; padding: 8px 20px; font-size: 14px; margin: 5px;"
                                        onclick="return confirmRestart();">
                                    <i class="fa fa-sync mr-1"></i> {$ADDONLANG.Restart}
                                </button>
                                {if $serverInfo['status'] == 'running'}
                                <button class="btn btn-secondary"
                                        style="border-radius: 10px; padding: 8px 20px; font-size: 14px; margin: 5px;"
                                        onclick="return confirmShutdown();">
                                    <i class="fa fa-power-off mr-1"></i> {$ADDONLANG.Shutdown}
                                </button>
                                {/if}
                                <a href="{$WEB_ROOT}/clientarea.php?action=productdetails&id={$serviceid}&modop=custom&a=VNC" 
                                   target="_blank" class="btn btn-info"
                                   style="border-radius: 10px; padding: 8px 20px; font-size: 14px; margin: 5px; text-decoration: none;">
                                    <i class="fa fa-desktop mr-1"></i> {$ADDONLANG.VNC}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="tab-pane fade" id="graphs" role="tabpanel" aria-labelledby="graphs-tab">
                    <!-- Time Period Selector Card -->
                    <div class="card mb-4">
                        <div class="card-header bg-light d-flex justify-content-between align-items-center">
                            <h5 class="mb-0"><i class="fa fa-chart-line mr-2"></i>{$ADDONLANG.Graphs.Title}</h5>
                            <button type="button" class="btn btn-sm btn-primary" onclick="refreshAllGraphs()">
                                <i class="fa fa-sync-alt mr-1"></i> {$ADDONLANG.General.RefreshAll}
                            </button>
                        </div>
                        <div class="card-body text-center">
                            <p class="text-muted mb-3">{$ADDONLANG.Graphs.SelectPeriod}</p>
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-sm btn-outline-primary graph-time-btn" onclick="loadGraphs('hour', this)">{$ADDONLANG.Graphs.Hour}</button>
                                <button type="button" class="btn btn-sm btn-outline-primary graph-time-btn active" onclick="loadGraphs('day', this)">{$ADDONLANG.Graphs.Day}</button>
                                <button type="button" class="btn btn-sm btn-outline-primary graph-time-btn" onclick="loadGraphs('week', this)">{$ADDONLANG.Graphs.Week}</button>
                                <button type="button" class="btn btn-sm btn-outline-primary graph-time-btn" onclick="loadGraphs('month', this)">{$ADDONLANG.Graphs.Month}</button>
                                <button type="button" class="btn btn-sm btn-outline-primary graph-time-btn" onclick="loadGraphs('year', this)">{$ADDONLANG.Graphs.Year}</button>
                            </div>
                        </div>
                    </div>

                    <!-- Loading indicator -->
                    <div id="graphs-loading" class="text-center mb-3" style="display: none;">
                        <div class="spinner-border text-primary" role="status">
                            <span class="sr-only">{$ADDONLANG.LoadingGraphs}</span>
                        </div>
                        <p class="mt-2 text-muted">{$ADDONLANG.LoadingGraphs}</p>
                    </div>

                    <!-- Graphs Container -->
                    <div class="row" id="graphs-container">
                        <div class="col-lg-12 mb-4">
                            <div class="card">
                                <div class="card-header bg-primary text-white">
                                    <h5 class="mb-0"><i class="fa fa-microchip mr-2"></i>{$ADDONLANG.Graphs.CPU}</h5>
                                </div>
                                <div class="card-body">
                                    <div id="cpu-graph" class="text-center" style="min-height: 250px;">
                                        <p class="text-muted">{$ADDONLANG.Graphs.Loading}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-12 mb-4">
                            <div class="card">
                                <div class="card-header bg-info text-white">
                                    <h5 class="mb-0"><i class="fa fa-network-wired mr-2"></i>{$ADDONLANG.Graphs.Network}</h5>
                                </div>
                                <div class="card-body">
                                    <div id="network-graph" class="text-center" style="min-height: 250px;">
                                        <p class="text-muted">{$ADDONLANG.Graphs.Loading}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-12 mb-4">
                            <div class="card">
                                <div class="card-header bg-warning text-dark">
                                    <h5 class="mb-0"><i class="fa fa-hdd mr-2"></i>{$ADDONLANG.Graphs.Disk}</h5>
                                </div>
                                <div class="card-body">
                                    <div id="disk-graph" class="text-center" style="min-height: 250px;">
                                        <p class="text-muted">{$ADDONLANG.Graphs.Loading}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                
                {if $backupsEnabled}
                <div class="tab-pane fade" id="backups" role="tabpanel" aria-labelledby="backups-tab">
                    <!-- Backup Management Card -->
                    <div class="card mb-4">
                        <div class="card-header bg-success text-white">
                            <h5 class="mb-0"><i class="fa fa-shield-alt mr-2"></i>{$ADDONLANG.Backups.Title}</h5>
                        </div>
                        <div class="card-body">
                            <p class="text-muted mb-4">{$ADDONLANG.Backups.Description}</p>
                            
                            <div class="text-right mb-3">
                                <button onclick="createBackup();return false;" class="btn btn-success">
                                    <i class="fa fa-plus-circle mr-2"></i>{$ADDONLANG.Backups.Create}
                                </button>
                            </div>
                            
                            <div class="table-responsive">
                                <table id="backupTable" class="table table-hover">
                                    <thead class="thead-light">
                                        <tr>
                                            <th><i class="fa fa-calendar mr-1"></i> {$ADDONLANG.Backups.Date}</th>
                                            <th><i class="fa fa-database mr-1"></i> {$ADDONLANG.Backups.Size}</th>
                                            <th><i class="fa fa-tag mr-1"></i> {$ADDONLANG.Backups.Type}</th>
                                            <th><i class="fa fa-info-circle mr-1"></i> {$ADDONLANG.Backups.Status}</th>
                                            <th width="100" class="text-center"><i class="fa fa-cogs mr-1"></i> {$ADDONLANG.Backups.Actions}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td colspan="5" class="text-center text-muted">
                                                <i class="fa fa-spinner fa-spin mr-2"></i>{$ADDONLANG.LoadingBackups}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Backup Information Alert -->
                    <div class="alert alert-warning">
                        <h5 class="alert-heading"><i class="fa fa-exclamation-triangle mr-2"></i>Important Information</h5>
                        {$ADDONLANG.Backups.Warning|unescape:'html'}
                    </div>
                </div>
                {/if}
                
                <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="settings-tab">
                    <div class="row">
                        <div class="col-lg-3 col-md-4 mb-4">
                            <div class="card">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0"><i class="fa fa-sliders-h mr-2"></i>{$ADDONLANG.Settings.Title}</h6>
                                </div>
                                <div class="card-body p-0">
                                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                        <a class="nav-link active" id="hostname-tab" data-toggle="pill" href="#hostname" role="tab" aria-controls="hostname" aria-selected="true">
                                            <i class="fa fa-globe mr-2"></i>{$ADDONLANG.Settings.Hostname.Title}
                                        </a>
                                        <a class="nav-link" id="iso-tab" data-toggle="pill" href="#iso" onclick="ArkHostHetznerVPS_API('ISO Images', false);" role="tab" aria-controls="iso" aria-selected="false">
                                            <i class="fa fa-compact-disc mr-2"></i>{$ADDONLANG.Settings.ISO.Title}
                                        </a>
                                        <a class="nav-link" id="password-tab" data-toggle="pill" href="#password" role="tab" aria-controls="password" aria-selected="false">
                                            <i class="fa fa-key mr-2"></i>{$ADDONLANG.Settings.Password.Title}
                                        </a>
                                        <a class="nav-link" id="reinstall-tab" data-toggle="pill" href="#reinstall" role="tab" aria-controls="reinstall" aria-selected="false">
                                            <i class="fa fa-redo mr-2"></i>{$ADDONLANG.Settings.Reinstall.Title}
                                        </a>
                                        <a class="nav-link" id="rescue-tab" data-toggle="pill" href="#rescue" role="tab" aria-controls="rescue" aria-selected="false">
                                            <i class="fa fa-life-ring mr-2"></i>{$ADDONLANG.Settings.Rescue.Title}
                                        </a>
                                        <a class="nav-link" id="floating-ip-tab" data-toggle="pill" href="#floating-ip" onclick="loadFloatingIPStatus();" role="tab" aria-controls="floating-ip" aria-selected="false">
                                            <i class="fa fa-globe mr-2"></i>{$ADDONLANG.Settings.FloatingIP.Title}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-9 col-md-8">
                            <div class="tab-content" id="v-pills-tabContent">
                                <div class="tab-pane fade show active" id="hostname" role="tabpanel" aria-labelledby="hostname-tab">
                                    <div class="card">
                                        <div class="card-header bg-primary text-white">
                                            <h5 class="mb-0"><i class="fa fa-globe mr-2"></i>{$ADDONLANG.Settings.Hostname.Title}</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="alert alert-info">
                                                <i class="fa fa-info-circle mr-2"></i>{$ADDONLANG.Settings.Hostname.Description}
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="font-weight-bold">{$ADDONLANG.Settings.Hostname.Title}:</label>
                                                <input class="form-control" id="hostnameRDNS" type="text" maxlength="128" value="{$serverInfo['hostname']}">
                                            </div>
                                            
                                            <div class="text-center">
                                                <button onclick="ArkHostHetznerVPS_API('Hostname rDNS', true, { hostname: document.getElementById('hostnameRDNS').value });return false;" class="btn btn-primary">
                                                    <i class="fa fa-save mr-2"></i>{$ADDONLANG.Settings.Hostname.Submit}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="tab-pane fade" id="iso" role="tabpanel" aria-labelledby="iso-tab">
                                    <div class="card">
                                        <div class="card-header bg-info text-white">
                                            <h5 class="mb-0"><i class="fa fa-compact-disc mr-2"></i>{$ADDONLANG.Settings.ISO.Title}</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="alert alert-info">
                                                <i class="fa fa-info-circle mr-2"></i>{$ADDONLANG.Settings.ISO.Description}
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="font-weight-bold">{$ADDONLANG.Settings.ISO.Image}:</label>
                                                <select class="form-control" id="isoID">
                                                    <option value="">Select ISO Image...</option>
                                                </select>
                                            </div>
                                            
                                            <div class="text-center">
                                                <button onclick="ArkHostHetznerVPS_API('Load ISO', true, { iso_id: document.getElementById('isoID').value });return false;" class="btn btn-info">
                                                    <i class="fa fa-upload mr-2"></i>{$ADDONLANG.Settings.ISO.Submit}
                                                </button>
                                                
                                                {if $serverInfo['iso'] !== ''}
                                                    <button onclick="ArkHostHetznerVPS_API('Eject ISO', true);return false;" class="btn btn-danger ml-2">
                                                        <i class="fa fa-eject mr-2"></i>{$ADDONLANG.Settings.ISO.Remove}
                                                    </button>
                                                {/if}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="tab-pane fade" id="password" role="tabpanel" aria-labelledby="password-tab">
                                    <div class="card">
                                        <div class="card-header bg-warning text-dark">
                                            <h5 class="mb-0"><i class="fa fa-key mr-2"></i>{$ADDONLANG.Settings.Password.Title}</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="alert alert-warning">
                                                <i class="fa fa-exclamation-triangle mr-2"></i>{$ADDONLANG.Settings.Password.Description}
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="font-weight-bold">{$ADDONLANG.Settings.Password.Title}:</label>
                                                <div class="input-group">
                                                    <input class="form-control" id="vpsPassword" type="password" disabled value="{if $serverInfo['install_root'] != ''}{$serverInfo['install_root']}{else}Expired{/if}">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-outline-secondary" type="button" onclick="ArkHostVPS_ShowPassword();return false;">
                                                            <i class="fa fa-eye" id="showPasswordIcon"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="text-center">
                                                <button onclick="ArkHostHetznerVPS_API('Reset root');return false;" class="btn btn-danger text-white">
                                                    <i class="fa fa-sync mr-2"></i>{$ADDONLANG.Settings.Password.Submit}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="tab-pane fade" id="reinstall" role="tabpanel" aria-labelledby="reinstall-tab">
                                    <div class="card">
                                        <div class="card-header bg-danger text-white">
                                            <h5 class="mb-0"><i class="fa fa-redo mr-2"></i>{$ADDONLANG.Settings.Reinstall.Title}</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="alert alert-danger">
                                                <i class="fa fa-exclamation-circle mr-2"></i>{$ADDONLANG.Settings.Reinstall.Description}
                                            </div>

                                            <h6 class="font-weight-bold mb-3">{$ADDONLANG.Settings.Reinstall.OS}:</h6>
                                            
                                            <div id="os_list" class="row mb-4">
                                                {foreach from=$operatingSystems key=$group item=$operatingSystemsGroup}
                                                <div class="col-12 col-md-6 col-lg-4 mb-3">
                                                    <div id="{$group}-os" class="os_badge media dropdown">
                                                        <button class="btn dropdown-toggle btn-outline-secondary w-100 p-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <div class="media-left p-1 float-left">
                                                                <img class="distro_img media-object" src="{$operatingSystemsGroup['image']}">
                                                            </div>

                                                            <div class="media-body float-left text-left p-2">
                                                                <h6 class="distro_name media-heading">{$operatingSystemsGroup['name']}</h6>
                                                                <span id="{$group}-version" class="version small">{$ADDONLANG.Settings.Reinstall.Version}</span>
                                                            </div>
                                                        </button>

                                                        <div class="os_badge_list dropdown-menu w-100">
                                                            {foreach from=$operatingSystemsGroup['versions'] item=$operatingSystem}
                                                            <a class="dropdown-item" href="#" data-os="{$operatingSystem['id']}" data-group="{$group}" onclick="ArkHostVPS_ChooseOS(this);return false;">{$operatingSystem['name']}</a>
                                                            {/foreach}
                                                        </div>
                                                    </div>
                                                </div>
                                                {/foreach}
                                            </div>

                                            <div class="alert alert-info">
                                                <i class="fa fa-info-circle mr-2"></i><strong>{$ADDONLANG.General.Note}:</strong> {$ADDONLANG.Reinstall.DestroyWarning}
                                            </div>

                                            <input type="hidden" id="newOS" value="0"/>
                                            
                                            <div class="text-center">
                                                <button onclick="reinstallWithAdvancedOptions();" class="btn btn-danger">
                                                    <i class="fa fa-exclamation-triangle mr-2"></i>{$ADDONLANG.Settings.Reinstall.Submit}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="tab-pane fade" id="rescue" role="tabpanel" aria-labelledby="rescue-tab">
                                    <div class="card">
                                        <div class="card-header bg-warning text-dark">
                                            <h5 class="mb-0"><i class="fa fa-life-ring mr-2"></i>{$ADDONLANG.Settings.Rescue.Title}</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="alert alert-info mb-4">
                                                <h6 class="alert-heading"><i class="fa fa-info-circle mr-2"></i>{$ADDONLANG.Settings.Rescue.AboutTitle}</h6>
                                                <p>{$ADDONLANG.Settings.Rescue.AboutDescription}</p>
                                                <hr>
                                                <p class="mb-0"><strong>{$ADDONLANG.Settings.Rescue.Important}:</strong> {$ADDONLANG.Settings.Rescue.ImportantNote}</p>
                                            </div>
                                            
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <div class="card h-100">
                                                        <div class="card-body text-center">
                                                            <i class="fa fa-play-circle fa-3x text-success mb-3"></i>
                                                            <h5 class="card-title">{$ADDONLANG.Settings.Rescue.EnableTitle}</h5>
                                                            <p class="card-text">{$ADDONLANG.Settings.Rescue.EnableDescription}</p>
                                                            <button onclick="enableRescueMode();" class="btn btn-success">
                                                                <i class="fa fa-life-ring mr-2"></i>{$ADDONLANG.Settings.Rescue.Enable}
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <div class="card h-100">
                                                        <div class="card-body text-center">
                                                            <i class="fa fa-power-off fa-3x text-danger mb-3"></i>
                                                            <h5 class="card-title">{$ADDONLANG.Settings.Rescue.EnableRebootTitle}</h5>
                                                            <p class="card-text">{$ADDONLANG.Settings.Rescue.EnableRebootDescription}</p>
                                                            <button onclick="enableRescueAndReboot();" class="btn btn-danger">
                                                                <i class="fa fa-sync mr-2"></i>{$ADDONLANG.Settings.Rescue.EnableReboot}
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="card mt-3 border-secondary">
                                                <div class="card-body">
                                                    <h6 class="card-title"><i class="fa fa-stop-circle mr-2"></i>{$ADDONLANG.Settings.Rescue.DisableTitle}</h6>
                                                    <p class="card-text">{$ADDONLANG.Settings.Rescue.DisableDescription}</p>
                                                    <button onclick="disableRescueMode();" class="btn btn-secondary">
                                                        <i class="fa fa-times mr-2"></i>{$ADDONLANG.Settings.Rescue.Disable}
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="tab-pane fade" id="floating-ip" role="tabpanel" aria-labelledby="floating-ip-tab">
                                    <div class="card">
                                        <div class="card-header bg-info text-white">
                                            <h5 class="mb-0"><i class="fa fa-globe mr-2"></i>{$ADDONLANG.Settings.FloatingIP.Title}</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="alert alert-info mb-4">
                                                <i class="fa fa-info-circle mr-2"></i>{$ADDONLANG.Settings.FloatingIP.Description}
                                            </div>
                                            
                                            <div id="floating-ip-content">
                                                <div class="text-center">
                                                    <i class="fas fa-spinner fa-spin fa-2x"></i>
                                                    <p class="mt-2">Loading floating IP information...</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="tab-pane fade" id="firewall" role="tabpanel" aria-labelledby="firewall-tab">
                    <div class="alert alert-info mb-4">
                        <i class="fa fa-info-circle mr-2"></i><strong>{$ADDONLANG.General.Note}:</strong> {$ADDONLANG.Firewall.ResourcesAttached}
                    </div>
                    
                    <!-- Add New Rule Card -->
                    <div class="card mb-4 border-primary">
                        <div class="card-header bg-light">
                            <h6 class="mb-0"><i class="fa fa-plus-circle mr-2"></i>{$ADDONLANG.Firewall.AddNewRule}</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-2">
                                    <label class="small text-muted">{$ADDONLANG.Settings.Firewall.Direction}</label>
                                    <select class="form-control" id="firewallDirection">
                                        <option value="in" selected>{$ADDONLANG.Firewall.Incoming}</option>
                                        <option value="out">{$ADDONLANG.Firewall.Outgoing}</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label class="small text-muted">{$ADDONLANG.Settings.Firewall.Action}</label>
                                    <select class="form-control" id="firewallAction">
                                        <option value="ACCEPT" class="text-success">✓ {$ADDONLANG.Settings.Firewall.Accept}</option>
                                        <option value="DROP" class="text-danger">✗ {$ADDONLANG.Settings.Firewall.Drop}</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label class="small text-muted">{$ADDONLANG.Settings.Firewall.Protocol}</label>
                                    <select class="form-control" id="firewallProtocol">
                                        <option value="TCP">{$ADDONLANG.Firewall.TCP}</option>
                                        <option value="UDP">{$ADDONLANG.Firewall.UDP}</option>
                                        <option value="ICMP">{$ADDONLANG.Firewall.ICMP}</option>
                                        <option value="ANY">{$ADDONLANG.Firewall.Any}</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="small text-muted">{$ADDONLANG.Settings.Firewall.Port}</label>
                                    <input class="form-control" id="firewallPort" type="text" placeholder="{$ADDONLANG.Firewall.PortPlaceholder}">
                                </div>
                                <div class="col-md-3">
                                    <label class="small text-muted">IP/CIDR</label>
                                    <input class="form-control" id="firewallSource" type="text" placeholder="{$ADDONLANG.Firewall.SourcePlaceholder}">
                                </div>
                            </div>
                            <div class="text-right mt-3">
                                <button class="btn btn-success" onclick="addFirewallRule();return false;">
                                    <i class="fa fa-plus mr-2"></i>{$ADDONLANG.General.AddRule}
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Current Rules -->
                    <div class="card">
                        <div class="card-header bg-light">
                            <h6 class="mb-0"><i class="fa fa-list mr-2"></i>{$ADDONLANG.Firewall.CurrentRules}</h6>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table id="firewallTable" class="table table-hover mb-0">
                                    <thead class="thead-light">
                                        <tr>
                                            <th width="80">{$ADDONLANG.Firewall.Direction}</th>
                                            <th width="100">{$ADDONLANG.Firewall.Action}</th>
                                            <th width="100">{$ADDONLANG.Firewall.Protocol}</th>
                                            <th width="100">{$ADDONLANG.Firewall.Port}</th>
                                            <th>{$ADDONLANG.Firewall.IPCIDR}</th>
                                            <th width="80" class="text-center">{$ADDONLANG.Firewall.Remove}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td colspan="6" class="text-center text-muted py-4">
                                                <i class="fa fa-spinner fa-spin mr-2"></i>{$ADDONLANG.LoadingFirewallRules}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Commit button not needed - changes are immediate -->
                    <div class="alert alert-success mt-4 mb-4">
                        <i class="fa fa-check-circle mr-2"></i><strong>{$ADDONLANG.General.Note}:</strong> {$ADDONLANG.Firewall.ChangesImmediate}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{$WEB_ROOT}/modules/servers/ArkHostHetznerVPS/template/script.js"></script>
