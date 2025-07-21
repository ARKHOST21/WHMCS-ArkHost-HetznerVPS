<?php

# Client Area
## General
$_ADDONLANG['Title'] = 'VPS Information';
$_ADDONLANG['IPv4'] = 'IPv4';
$_ADDONLANG['IPv6'] = 'IPv6';
$_ADDONLANG['Start'] = 'Start';
$_ADDONLANG['Stop'] = 'Stop';
$_ADDONLANG['Restart'] = 'Restart';
$_ADDONLANG['Shutdown'] = 'Shutdown';
$_ADDONLANG['VNC'] = 'VNC Console';
$_ADDONLANG['Delete'] = 'Delete';
$_ADDONLANG['Close'] = 'Close';
$_ADDONLANG['Restore'] = 'Restore';
$_ADDONLANG['SelectISOImage'] = 'Select ISO Image...';
$_ADDONLANG['NoISOImages'] = 'No ISO images available';
$_ADDONLANG['LoadingGraphs'] = 'Loading performance graphs...';
$_ADDONLANG['LoadingBackups'] = 'Loading backup data...';
$_ADDONLANG['LoadingFirewallRules'] = 'Loading firewall rules...';
$_ADDONLANG['CopyToClipboard'] = 'Copy to clipboard';
$_ADDONLANG['PasswordCopied'] = 'Password copied to clipboard!';
$_ADDONLANG['SavePassword'] = 'Make sure to save this password!';
$_ADDONLANG['PasswordSaved'] = 'It has also been saved to your service.';
$_ADDONLANG['RescueModeEnabled'] = 'Rescue mode enabled! Root password: ';
$_ADDONLANG['NetworkError'] = 'Network error';
$_ADDONLANG['ActionFailed'] = 'Action failed!';
$_ADDONLANG['ActionSuccess'] = 'Action completed successfully';

## Confirmations
$_ADDONLANG['Confirm']['Stop']['Title'] = 'Stop VPS';
$_ADDONLANG['Confirm']['Stop']['Message'] = 'Do you want to stop this VPS? This will shutdown the server.';
$_ADDONLANG['Confirm']['Restart']['Title'] = 'Restart VPS';
$_ADDONLANG['Confirm']['Restart']['Message'] = 'Do you want to restart this VPS? This will reboot the server.';
$_ADDONLANG['Confirm']['Cancel'] = 'Cancel';
$_ADDONLANG['Confirm']['Confirm'] = 'Confirm';
$_ADDONLANG['Confirm']['CreateBackup']['Title'] = 'Create Backup';
$_ADDONLANG['Confirm']['CreateBackup']['Message'] = 'Do you want to create a backup. This may take several minutes.';
$_ADDONLANG['Confirm']['DeleteBackup']['Title'] = 'Delete Backup';
$_ADDONLANG['Confirm']['DeleteBackup']['Message'] = 'Do you want to delete this backup. This action cannot be undone.';
$_ADDONLANG['Confirm']['RestoreBackup']['Title'] = 'Restore Backup';
$_ADDONLANG['Confirm']['RestoreBackup']['Message'] = 'Do you want to restore this backup. This will overwrite all current data and cannot be undone.';
$_ADDONLANG['Confirm']['Shutdown']['Title'] = 'Shutdown VPS';
$_ADDONLANG['Confirm']['Shutdown']['Message'] = 'Do you want to gracefully shutdown this VPS? This will perform a clean shutdown of the server.';
$_ADDONLANG['Confirm']['EnableRescue']['Title'] = 'Enable Rescue Mode';
$_ADDONLANG['Confirm']['EnableRescue']['Message'] = 'Enable rescue mode? The server must be manually rebooted within 60 minutes for this to take effect.';
$_ADDONLANG['Confirm']['EnableRescueReboot']['Title'] = 'Enable Rescue Mode & Reboot';
$_ADDONLANG['Confirm']['EnableRescueReboot']['Message'] = 'Enable rescue mode and reboot the server immediately?';
$_ADDONLANG['Confirm']['DisableRescue']['Title'] = 'Disable Rescue Mode';
$_ADDONLANG['Confirm']['DisableRescue']['Message'] = 'This will disable rescue mode. The server will boot normally on next restart. Continue?';
$_ADDONLANG['Confirm']['ResetPassword']['Title'] = 'Reset Root Password';
$_ADDONLANG['Confirm']['ResetPassword']['Message'] = 'This will reset the root password. Server must be running and have qemu guest agent installed. Continue?';
$_ADDONLANG['Confirm']['DeleteFirewallRule']['Title'] = 'Delete Firewall Rule';
$_ADDONLANG['Confirm']['DeleteFirewallRule']['Message'] = 'Are you sure you want to delete this firewall rule?';

## Navbar
$_ADDONLANG['Navbar']['Overview'] = 'Overview';
$_ADDONLANG['Navbar']['Graphs'] = 'Graphs';
$_ADDONLANG['Navbar']['Backups'] = 'Backups';
$_ADDONLANG['Navbar']['Settings'] = 'Settings';

## Overview
$_ADDONLANG['Overview']['CPU'] = 'CPU Usage';
$_ADDONLANG['Overview']['RAM'] = 'RAM Usage';
$_ADDONLANG['Overview']['Bandwidth'] = 'Bandwidth Usage';
$_ADDONLANG['Overview']['Disk'] = 'Disk Space';
$_ADDONLANG['Overview']['ServerInfo'] = 'Server Information';
$_ADDONLANG['Overview']['ResourceAllocation'] = 'Resource Allocation';
$_ADDONLANG['Overview']['QuickActions'] = 'Quick Actions';
$_ADDONLANG['Overview']['Hostname'] = 'Hostname';
$_ADDONLANG['Overview']['Status'] = 'Status';
$_ADDONLANG['Overview']['OS'] = 'Operating System';
$_ADDONLANG['Overview']['Location'] = 'Location';
$_ADDONLANG['Overview']['CPU_Cores'] = 'vCPU Cores';
$_ADDONLANG['Overview']['Memory'] = 'Memory';
$_ADDONLANG['Overview']['Storage'] = 'SSD Storage';
$_ADDONLANG['Overview']['Traffic'] = 'Traffic Included';
$_ADDONLANG['Overview']['Uptime'] = 'Uptime';
$_ADDONLANG['Overview']['ServerType'] = 'Server Type';
$_ADDONLANG['Overview']['MetricsNote'] = 'Note: API only provides CPU metrics. RAM and disk usage metrics are not available.';
$_ADDONLANG['Overview']['Allocated'] = 'Allocated';

## Graphs
$_ADDONLANG['Graphs']['Title'] = 'Performance Metrics';
$_ADDONLANG['Graphs']['CPU'] = 'CPU Usage';
$_ADDONLANG['Graphs']['RAM'] = 'RAM Usage';
$_ADDONLANG['Graphs']['Disk'] = 'Disk Usage';
$_ADDONLANG['Graphs']['Network'] = 'Network Usage';
$_ADDONLANG['Graphs']['Hour'] = 'Hour';
$_ADDONLANG['Graphs']['Day'] = 'Day';
$_ADDONLANG['Graphs']['Week'] = 'Week';
$_ADDONLANG['Graphs']['Month'] = 'Month';
$_ADDONLANG['Graphs']['Year'] = 'Year';
$_ADDONLANG['Graphs']['Loading'] = 'Loading graph...';
$_ADDONLANG['Graphs']['SelectPeriod'] = 'Select a time period to view server performance metrics';
$_ADDONLANG['Graphs']['CPUUsage'] = 'CPU Usage';
$_ADDONLANG['Graphs']['NetworkTraffic'] = 'Network Traffic';
$_ADDONLANG['Graphs']['DiskIO'] = 'Disk I/O';
$_ADDONLANG['Graphs']['CPUUnit'] = '%';
$_ADDONLANG['Graphs']['NetworkUnit'] = 'Mbps';
$_ADDONLANG['Graphs']['DiskUnit'] = 'IOPS';
$_ADDONLANG['Graphs']['Current'] = 'Current';
$_ADDONLANG['Graphs']['Inbound'] = 'Inbound';
$_ADDONLANG['Graphs']['Outbound'] = 'Outbound';
$_ADDONLANG['Graphs']['Read'] = 'Read';
$_ADDONLANG['Graphs']['Write'] = 'Write';

## Backups
$_ADDONLANG['Backups']['Title'] = 'Backup Management';
$_ADDONLANG['Backups']['Description'] = 'The dates for which backups of this VPS are available are listed below. You can restore or delete them accordingly.';
$_ADDONLANG['Backups']['Warning'] = '* Please keep in mind that the new backups will replace the older ones.<br/>** The automated backups will also replace your manual backups unless the automated backups are disabled.<br/>*** The automated backups are made 2 times a week and are part of our disaster recovery plan. If you disable the automated backups, you also disable any chance of recovery in case of a disaster.<br/>**** The backup\'s file system might not be fully consistent if the VPS was writing to the filesystem at the moment of the backup. For fully consistent backups, the server must be stopped while the backup is being created.';
$_ADDONLANG['Backups']['Date'] = 'Date';
$_ADDONLANG['Backups']['Size'] = 'Size';
$_ADDONLANG['Backups']['Type'] = 'Type';
$_ADDONLANG['Backups']['Status'] = 'Status';
$_ADDONLANG['Backups']['Actions'] = 'Actions';
$_ADDONLANG['Backups']['Create'] = 'Backup Now';
$_ADDONLANG['Backups']['Available'] = 'Available';
$_ADDONLANG['Backups']['Creating'] = 'Creating...';
$_ADDONLANG['Backups']['Error'] = 'Error';
$_ADDONLANG['Backups']['Automatic'] = 'Automatic';
$_ADDONLANG['Backups']['Manual'] = 'Manual';

## Settings
$_ADDONLANG['Settings']['Title'] = 'Settings Menu';
### Hostname
$_ADDONLANG['Settings']['Hostname']['Title'] = 'Hostname';
$_ADDONLANG['Settings']['Hostname']['Description'] = 'Sets the hostname and the rDNS. Please create the A record first.';
$_ADDONLANG['Settings']['Hostname']['Submit'] = 'Submit';

### ISO
$_ADDONLANG['Settings']['ISO']['Title'] = 'ISO';
$_ADDONLANG['Settings']['ISO']['Description'] = 'If you install the operating system via the ISO image, you must also configure the network interface statically. There is no DHCP server running.';
$_ADDONLANG['Settings']['ISO']['Image'] = 'ISO Image';
$_ADDONLANG['Settings']['ISO']['Submit'] = 'Load ISO';
$_ADDONLANG['Settings']['ISO']['Remove'] = 'Eject ISO';

### Password
$_ADDONLANG['Settings']['Password']['Title'] = 'Password';
$_ADDONLANG['Settings']['Password']['Description'] = 'The installation password is removed from our systems after 72 hours. It is mandatory for you to change the password on your first login!';
$_ADDONLANG['Settings']['Password']['Submit'] = 'Reset Password';

### Reinstall
$_ADDONLANG['Settings']['Reinstall']['Title'] = 'Reinstall';
$_ADDONLANG['Settings']['Reinstall']['Description'] = 'Please understand that by reinstalling, all the data will be wiped from the server. This action is irreversible!';
$_ADDONLANG['Settings']['Reinstall']['OS'] = 'Operating System';
$_ADDONLANG['Settings']['Reinstall']['Version'] = 'CHOOSE VERSION';
$_ADDONLANG['Settings']['Reinstall']['Submit'] = 'Reinstall';

### Firewall
$_ADDONLANG['Settings']['Firewall']['Title'] = 'Firewall';
$_ADDONLANG['Settings']['Firewall']['Description'] = 'The rules are evaluated from the top to the bottom. By default, everything is allowed. The firewall is only available on the public interface. Only the inbound traffic will be filtered by the firewall.';
$_ADDONLANG['Settings']['Firewall']['Action'] = 'Action';
$_ADDONLANG['Settings']['Firewall']['Port'] = 'Port';
$_ADDONLANG['Settings']['Firewall']['Protocol'] = 'Protocol';
$_ADDONLANG['Settings']['Firewall']['Source'] = 'Source';
$_ADDONLANG['Settings']['Firewall']['Note'] = 'Note';
$_ADDONLANG['Settings']['Firewall']['Actions'] = 'Actions';
$_ADDONLANG['Settings']['Firewall']['Accept'] = 'Accept';
$_ADDONLANG['Settings']['Firewall']['Drop'] = 'Drop';
$_ADDONLANG['Settings']['Firewall']['PortNumber'] = 'Port Number';
$_ADDONLANG['Settings']['Firewall']['SourceLabel'] = 'Ex: x.x.x.x/xx (optional)';
$_ADDONLANG['Settings']['Firewall']['Notes'] = 'Notes (optional)';
$_ADDONLANG['Settings']['Firewall']['Warning'] = 'The rules must be committed in order to take effect.';
$_ADDONLANG['Settings']['Firewall']['Submit'] = 'Commit Firewall';

### Rescue Mode
$_ADDONLANG['Settings']['Rescue']['Title'] = 'Rescue Mode';
$_ADDONLANG['Settings']['Rescue']['Description'] = 'Rescue mode boots your server into a temporary Linux system where you can access your server\'s disks to repair or recover data.';
$_ADDONLANG['Settings']['Rescue']['Status'] = 'Status';
$_ADDONLANG['Settings']['Rescue']['Active'] = 'Active';
$_ADDONLANG['Settings']['Rescue']['Inactive'] = 'Inactive';
$_ADDONLANG['Settings']['Rescue']['Enable'] = 'Enable Rescue Mode';
$_ADDONLANG['Settings']['Rescue']['EnableReboot'] = 'Enable and Reboot';
$_ADDONLANG['Settings']['Rescue']['Disable'] = 'Disable Rescue Mode';
$_ADDONLANG['Settings']['Rescue']['ResetRootPassword'] = 'Reset Root Password';
$_ADDONLANG['Settings']['Rescue']['Warning'] = 'After enabling rescue mode, you must reboot the server within 60 minutes for it to take effect.';
$_ADDONLANG['Settings']['Rescue']['PasswordNote'] = 'The root password will be displayed once after enabling rescue mode. Make sure to save it!';
$_ADDONLANG['Settings']['Rescue']['DisableTitle'] = 'Disable Rescue Mode';
$_ADDONLANG['Settings']['Rescue']['DisableDescription'] = 'If rescue mode is currently active, you can disable it here. The server will boot normally on next restart.';
$_ADDONLANG['Settings']['Rescue']['NewRootPassword'] = 'New Root Password';
$_ADDONLANG['Settings']['Rescue']['AboutTitle'] = 'About Rescue Mode';
$_ADDONLANG['Settings']['Rescue']['AboutDescription'] = 'The rescue system is a network based environment and can be used to fix issues preventing a regular boot. It is also useful to install custom Linux distributions that are not directly offered by us. You are able to mount the server\'s hard drive inside the rescue system.';
$_ADDONLANG['Settings']['Rescue']['Important'] = 'Important';
$_ADDONLANG['Settings']['Rescue']['ImportantNote'] = 'After enabling the rescue system you need to reboot the server in the next 60 minutes to activate it. After another reboot your server will boot from its local disk again.';
$_ADDONLANG['Settings']['Rescue']['EnableTitle'] = 'Enable Rescue Mode';
$_ADDONLANG['Settings']['Rescue']['EnableDescription'] = 'Boot into a minimal Linux system for recovery and maintenance tasks.';
$_ADDONLANG['Settings']['Rescue']['EnableRebootTitle'] = 'Enable & Reboot';
$_ADDONLANG['Settings']['Rescue']['EnableRebootDescription'] = 'Enable rescue mode and immediately reboot the server to activate it.';
$_ADDONLANG['Settings']['Rescue']['PasswordPrompt'] = 'Your new root password is:';

### Floating IP
$_ADDONLANG['Settings']['FloatingIP']['Title'] = 'Floating IP';
$_ADDONLANG['Settings']['FloatingIP']['Description'] = 'Manage floating IPs assigned to this server. Floating IPs can be moved between servers.';
$_ADDONLANG['Settings']['FloatingIP']['Status'] = 'Status';
$_ADDONLANG['Settings']['FloatingIP']['IP'] = 'IP Address';
$_ADDONLANG['Settings']['FloatingIP']['Type'] = 'Type';
$_ADDONLANG['Settings']['FloatingIP']['None'] = 'No floating IP assigned';
$_ADDONLANG['Settings']['FloatingIP']['NotAvailable'] = 'Floating IP not available for this service';
$_ADDONLANG['Settings']['FloatingIP']['Assigned'] = 'Assigned';
$_ADDONLANG['Settings']['FloatingIP']['Unassigned'] = 'Unassigned';
$_ADDONLANG['Settings']['FloatingIP']['Assign'] = 'Assign to Server';
$_ADDONLANG['Settings']['FloatingIP']['Unassign'] = 'Unassign from Server';
$_ADDONLANG['Settings']['FloatingIP']['ReverseDNS'] = 'Reverse DNS';
$_ADDONLANG['Settings']['FloatingIP']['ReverseDNSDescription'] = 'Set reverse DNS (PTR record) for this floating IP';
$_ADDONLANG['Settings']['FloatingIP']['SetReverseDNS'] = 'Set Reverse DNS';
$_ADDONLANG['Settings']['FloatingIP']['ReverseDNSPlaceholder'] = 'example.com';

# Additional strings for UI elements
$_ADDONLANG['General']['NoBackupsFound'] = 'No backups found';
$_ADDONLANG['General']['NoFirewallRules'] = 'No firewall rules configured';
$_ADDONLANG['General']['NoDataAvailable'] = 'No data available';
$_ADDONLANG['General']['RefreshAll'] = 'Refresh All';
$_ADDONLANG['General']['AddRule'] = 'Add Rule';
$_ADDONLANG['General']['Note'] = 'Note';
$_ADDONLANG['General']['GB'] = 'GB';
$_ADDONLANG['General']['TB'] = 'TB';
$_ADDONLANG['General']['Any'] = 'Any';
$_ADDONLANG['General']['EmptyValue'] = '-';
$_ADDONLANG['General']['Colon'] = ': ';

## Firewall specific
$_ADDONLANG['Firewall']['CurrentRules'] = 'Current Firewall Rules';
$_ADDONLANG['Firewall']['ResourcesAttached'] = 'Firewall resources are attached to servers. If no firewall is attached, one will be created automatically when you add your first rule.';
$_ADDONLANG['Firewall']['ChangesImmediate'] = 'Firewall changes are applied immediately. There is no need to commit changes.';
$_ADDONLANG['Firewall']['AddNewRule'] = 'Add New Firewall Rule';
$_ADDONLANG['Firewall']['PortPlaceholder'] = '1-65535';
$_ADDONLANG['Firewall']['SourcePlaceholder'] = '0.0.0.0/0';
$_ADDONLANG['Firewall']['DescriptionPlaceholder'] = 'Rule description';
$_ADDONLANG['Firewall']['Accept'] = 'ACCEPT';
$_ADDONLANG['Firewall']['Drop'] = 'DROP';
$_ADDONLANG['Firewall']['Info'] = 'INFO';
$_ADDONLANG['Firewall']['Any'] = 'ANY';
$_ADDONLANG['Firewall']['TCP'] = 'TCP';
$_ADDONLANG['Firewall']['UDP'] = 'UDP';
$_ADDONLANG['Firewall']['ICMP'] = 'ICMP';

## Reinstall specific
$_ADDONLANG['Reinstall']['DestroyWarning'] = 'Rebuilding will destroy all data on the server. A new root password will be generated and saved to your service account.';

## Additional UI messages
$_ADDONLANG['Messages']['PortRequired'] = 'Port is required for TCP/UDP protocols';
$_ADDONLANG['Messages']['RefreshingGraphs'] = 'Refreshing all graphs...';
$_ADDONLANG['Messages']['PasswordSaveNote'] = 'Save this password in a secure location';
$_ADDONLANG['Messages']['SelectOSFirst'] = 'Please select an operating system first.';

## Server types
$_ADDONLANG['ServerTypes']['Standard'] = 'Standard';
