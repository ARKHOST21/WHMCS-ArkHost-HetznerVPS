<?php

# Client Area
## General
$_ADDONLANG['Title'] = 'VPS Informatie';
$_ADDONLANG['IPv4'] = 'IPv4';
$_ADDONLANG['IPv6'] = 'IPv6';
$_ADDONLANG['Start'] = 'Start';
$_ADDONLANG['Stop'] = 'Stop';
$_ADDONLANG['Restart'] = 'Herstart';
$_ADDONLANG['Shutdown'] = 'Afsluiten';
$_ADDONLANG['VNC'] = 'VNC Console';
$_ADDONLANG['Delete'] = 'Verwijderen';
$_ADDONLANG['Close'] = 'Sluiten';
$_ADDONLANG['Restore'] = 'Herstellen';
$_ADDONLANG['SelectISOImage'] = 'Selecteer ISO-image...';
$_ADDONLANG['NoISOImages'] = 'Geen ISO-images beschikbaar';
$_ADDONLANG['LoadingGraphs'] = 'Prestatiediagrammen laden...';
$_ADDONLANG['LoadingBackups'] = 'Back-up gegevens laden...';
$_ADDONLANG['LoadingFirewallRules'] = 'Firewall regels laden...';
$_ADDONLANG['CopyToClipboard'] = 'Kopieer naar klembord';
$_ADDONLANG['PasswordCopied'] = 'Wachtwoord gekopieerd naar klembord!';
$_ADDONLANG['SavePassword'] = 'Zorg ervoor dat u dit wachtwoord opslaat!';
$_ADDONLANG['PasswordSaved'] = 'Het is ook opgeslagen in uw service.';
$_ADDONLANG['RescueModeEnabled'] = 'Reddingsmodus ingeschakeld! Root wachtwoord: ';
$_ADDONLANG['NetworkError'] = 'Netwerkfout';
$_ADDONLANG['ActionFailed'] = 'Actie mislukt!';
$_ADDONLANG['ActionSuccess'] = 'Actie succesvol voltooid';

## Confirmations
$_ADDONLANG['Confirm']['Stop']['Title'] = 'VPS stoppen';
$_ADDONLANG['Confirm']['Stop']['Message'] = 'Wilt u deze VPS stoppen? Dit zal de server afsluiten.';
$_ADDONLANG['Confirm']['Restart']['Title'] = 'VPS herstarten';
$_ADDONLANG['Confirm']['Restart']['Message'] = 'Wilt u deze VPS herstarten? Dit zal de server opnieuw opstarten.';
$_ADDONLANG['Confirm']['Cancel'] = 'Annuleren';
$_ADDONLANG['Confirm']['Confirm'] = 'Bevestigen';
$_ADDONLANG['Confirm']['CreateBackup']['Title'] = 'Back-up maken';
$_ADDONLANG['Confirm']['CreateBackup']['Message'] = 'Wilt u een back-up maken? Dit kan enkele minuten duren.';
$_ADDONLANG['Confirm']['DeleteBackup']['Title'] = 'Back-up verwijderen';
$_ADDONLANG['Confirm']['DeleteBackup']['Message'] = 'Wilt u deze back-up verwijderen? Deze actie kan niet ongedaan worden gemaakt.';
$_ADDONLANG['Confirm']['RestoreBackup']['Title'] = 'Back-up herstellen';
$_ADDONLANG['Confirm']['RestoreBackup']['Message'] = 'Wilt u deze back-up herstellen? Dit zal alle huidige gegevens overschrijven en kan niet ongedaan worden gemaakt.';
$_ADDONLANG['Confirm']['Shutdown']['Title'] = 'VPS afsluiten';
$_ADDONLANG['Confirm']['Shutdown']['Message'] = 'Wilt u deze VPS netjes afsluiten? Dit zal de server schoon afsluiten.';
$_ADDONLANG['Confirm']['EnableRescue']['Title'] = 'Reddingsmodus inschakelen';
$_ADDONLANG['Confirm']['EnableRescue']['Message'] = 'Reddingsmodus inschakelen? De server moet binnen 60 minuten handmatig opnieuw worden opgestart om dit effect te laten hebben.';
$_ADDONLANG['Confirm']['EnableRescueReboot']['Title'] = 'Reddingsmodus inschakelen & Herstart';
$_ADDONLANG['Confirm']['EnableRescueReboot']['Message'] = 'Reddingsmodus inschakelen en de server direct herstarten?';
$_ADDONLANG['Confirm']['DisableRescue']['Title'] = 'Reddingsmodus uitschakelen';
$_ADDONLANG['Confirm']['DisableRescue']['Message'] = 'Dit zal de reddingsmodus uitschakelen. De server zal normaal opstarten bij de volgende herstart. Doorgaan?';
$_ADDONLANG['Confirm']['ResetPassword']['Title'] = 'Root wachtwoord resetten';
$_ADDONLANG['Confirm']['ResetPassword']['Message'] = 'Dit zal het root wachtwoord resetten. Server moet draaien en qemu guest agent geïnstalleerd hebben. Doorgaan?';
$_ADDONLANG['Confirm']['DeleteFirewallRule']['Title'] = 'Firewall regel verwijderen';
$_ADDONLANG['Confirm']['DeleteFirewallRule']['Message'] = 'Weet u zeker dat u deze firewall regel wilt verwijderen?';

## Navbar
$_ADDONLANG['Navbar']['Overview'] = 'Overzicht';
$_ADDONLANG['Navbar']['Graphs'] = 'Grafieken';
$_ADDONLANG['Navbar']['Backups'] = 'Back-ups';
$_ADDONLANG['Navbar']['Settings'] = 'Instellingen';

## Overview
$_ADDONLANG['Overview']['CPU'] = 'CPU Gebruik';
$_ADDONLANG['Overview']['RAM'] = 'RAM Gebruik';
$_ADDONLANG['Overview']['Bandwidth'] = 'Bandbreedte Gebruik';
$_ADDONLANG['Overview']['Disk'] = 'Schijfruimte';
$_ADDONLANG['Overview']['ServerInfo'] = 'Server Informatie';
$_ADDONLANG['Overview']['ResourceAllocation'] = 'Resource Toewijzing';
$_ADDONLANG['Overview']['QuickActions'] = 'Snelle Acties';
$_ADDONLANG['Overview']['Hostname'] = 'Hostnaam';
$_ADDONLANG['Overview']['Status'] = 'Status';
$_ADDONLANG['Overview']['OS'] = 'Besturingssysteem';
$_ADDONLANG['Overview']['Location'] = 'Locatie';
$_ADDONLANG['Overview']['CPU_Cores'] = 'vCPU Cores';
$_ADDONLANG['Overview']['Memory'] = 'Geheugen';
$_ADDONLANG['Overview']['Storage'] = 'SSD Opslag';
$_ADDONLANG['Overview']['Traffic'] = 'Inbegrepen Traffic';
$_ADDONLANG['Overview']['Uptime'] = 'Uptime';
$_ADDONLANG['Overview']['ServerType'] = 'Server Type';
$_ADDONLANG['Overview']['MetricsNote'] = 'Opmerking: API biedt alleen CPU-statistieken. RAM en schijfgebruik statistieken zijn niet beschikbaar.';
$_ADDONLANG['Overview']['Allocated'] = 'Toegewezen';

## Graphs
$_ADDONLANG['Graphs']['Title'] = 'Prestatie Statistieken';
$_ADDONLANG['Graphs']['CPU'] = 'CPU Gebruik';
$_ADDONLANG['Graphs']['RAM'] = 'RAM Gebruik';
$_ADDONLANG['Graphs']['Disk'] = 'Schijf Gebruik';
$_ADDONLANG['Graphs']['Network'] = 'Netwerk Gebruik';
$_ADDONLANG['Graphs']['Hour'] = 'Uur';
$_ADDONLANG['Graphs']['Day'] = 'Dag';
$_ADDONLANG['Graphs']['Week'] = 'Week';
$_ADDONLANG['Graphs']['Month'] = 'Maand';
$_ADDONLANG['Graphs']['Year'] = 'Jaar';
$_ADDONLANG['Graphs']['Loading'] = 'Grafiek laden...';
$_ADDONLANG['Graphs']['SelectPeriod'] = 'Selecteer een tijdsperiode om server prestatie statistieken te bekijken';
$_ADDONLANG['Graphs']['CPUUsage'] = 'CPU Gebruik';
$_ADDONLANG['Graphs']['NetworkTraffic'] = 'Netwerk Traffic';
$_ADDONLANG['Graphs']['DiskIO'] = 'Schijf I/O';
$_ADDONLANG['Graphs']['CPUUnit'] = '%';
$_ADDONLANG['Graphs']['NetworkUnit'] = 'Mbps';
$_ADDONLANG['Graphs']['DiskUnit'] = 'IOPS';
$_ADDONLANG['Graphs']['Current'] = 'Huidig';
$_ADDONLANG['Graphs']['Inbound'] = 'Inkomend';
$_ADDONLANG['Graphs']['Outbound'] = 'Uitgaand';
$_ADDONLANG['Graphs']['Read'] = 'Lezen';
$_ADDONLANG['Graphs']['Write'] = 'Schrijven';

## Backups
$_ADDONLANG['Backups']['Title'] = 'Back-up Beheer';
$_ADDONLANG['Backups']['Description'] = 'De datums waarvoor back-ups van deze VPS beschikbaar zijn, staan hieronder vermeld. U kunt deze dienovereenkomstig herstellen of verwijderen.';
$_ADDONLANG['Backups']['Warning'] = 'Voor elke server zijn er zeven slots voor back-ups. Als alle slots vol zijn, wordt de oudste back-up verwijderd.';
$_ADDONLANG['Backups']['Date'] = 'Datum';
$_ADDONLANG['Backups']['Size'] = 'Grootte';
$_ADDONLANG['Backups']['Type'] = 'Type';
$_ADDONLANG['Backups']['Status'] = 'Status';
$_ADDONLANG['Backups']['Actions'] = 'Acties';
$_ADDONLANG['Backups']['Create'] = 'Nu back-up maken';
$_ADDONLANG['Backups']['Available'] = 'Beschikbaar';
$_ADDONLANG['Backups']['Creating'] = 'Bezig met maken...';
$_ADDONLANG['Backups']['Error'] = 'Fout';
$_ADDONLANG['Backups']['Automatic'] = 'Automatisch';
$_ADDONLANG['Backups']['Manual'] = 'Handmatig';

## Settings
$_ADDONLANG['Settings']['Title'] = 'Instellingen Menu';
### Hostname
$_ADDONLANG['Settings']['Hostname']['Title'] = 'Hostnaam';
$_ADDONLANG['Settings']['Hostname']['Description'] = 'Stelt de hostnaam en het rDNS in. Maak eerst het A-record aan.';
$_ADDONLANG['Settings']['Hostname']['Submit'] = 'Versturen';

### ISO
$_ADDONLANG['Settings']['ISO']['Title'] = 'ISO';
$_ADDONLANG['Settings']['ISO']['Description'] = 'Als u het besturingssysteem via de ISO-image installeert, moet u ook de netwerkinterface statisch configureren. Er draait geen DHCP-server.';
$_ADDONLANG['Settings']['ISO']['Image'] = 'ISO Image';
$_ADDONLANG['Settings']['ISO']['Submit'] = 'ISO laden';
$_ADDONLANG['Settings']['ISO']['Remove'] = 'ISO uitwerpen';

### Password
$_ADDONLANG['Settings']['Password']['Title'] = 'Wachtwoord';
$_ADDONLANG['Settings']['Password']['Description'] = 'Het installatie wachtwoord wordt na 72 uur uit onze systemen verwijderd. Het is verplicht om het wachtwoord bij uw eerste aanmelding te wijzigen!';
$_ADDONLANG['Settings']['Password']['Submit'] = 'Wachtwoord resetten';

### Reinstall
$_ADDONLANG['Settings']['Reinstall']['Title'] = 'Herinstallatie';
$_ADDONLANG['Settings']['Reinstall']['Description'] = 'Begrijp alstublieft dat door herinstallatie alle gegevens van de server worden gewist. Deze actie is onomkeerbaar!';
$_ADDONLANG['Settings']['Reinstall']['OS'] = 'Besturingssysteem';
$_ADDONLANG['Settings']['Reinstall']['Version'] = 'KIES VERSIE';
$_ADDONLANG['Settings']['Reinstall']['Submit'] = 'Herinstalleren';

### Firewall
$_ADDONLANG['Settings']['Firewall']['Title'] = 'Firewall';
$_ADDONLANG['Settings']['Firewall']['Action'] = 'Actie';
$_ADDONLANG['Settings']['Firewall']['Port'] = 'Poort';
$_ADDONLANG['Settings']['Firewall']['Protocol'] = 'Protocol';
$_ADDONLANG['Settings']['Firewall']['Accept'] = 'Accepteren';
$_ADDONLANG['Settings']['Firewall']['Drop'] = 'Weggooien';

### Rescue Mode
$_ADDONLANG['Settings']['Rescue']['Title'] = 'Reddingsmodus';
$_ADDONLANG['Settings']['Rescue']['Description'] = 'Reddingsmodus start uw server in een tijdelijk Linux-systeem waar u toegang heeft tot de schijven van uw server om gegevens te repareren of herstellen.';
$_ADDONLANG['Settings']['Rescue']['Status'] = 'Status';
$_ADDONLANG['Settings']['Rescue']['Active'] = 'Actief';
$_ADDONLANG['Settings']['Rescue']['Inactive'] = 'Inactief';
$_ADDONLANG['Settings']['Rescue']['Enable'] = 'Reddingsmodus inschakelen';
$_ADDONLANG['Settings']['Rescue']['EnableReboot'] = 'Inschakelen en herstarten';
$_ADDONLANG['Settings']['Rescue']['Disable'] = 'Reddingsmodus uitschakelen';
$_ADDONLANG['Settings']['Rescue']['ResetRootPassword'] = 'Root wachtwoord resetten';
$_ADDONLANG['Settings']['Rescue']['Warning'] = 'Na het inschakelen van de reddingsmodus moet u de server binnen 60 minuten herstarten om effect te hebben.';
$_ADDONLANG['Settings']['Rescue']['PasswordNote'] = 'Het root wachtwoord wordt eenmaal weergegeven na het inschakelen van de reddingsmodus. Zorg ervoor dat u het opslaat!';
$_ADDONLANG['Settings']['Rescue']['DisableTitle'] = 'Reddingsmodus uitschakelen';
$_ADDONLANG['Settings']['Rescue']['DisableDescription'] = 'Als de reddingsmodus momenteel actief is, kunt u deze hier uitschakelen. De server zal normaal opstarten bij de volgende herstart.';
$_ADDONLANG['Settings']['Rescue']['NewRootPassword'] = 'Nieuw Root Wachtwoord';
$_ADDONLANG['Settings']['Rescue']['AboutTitle'] = 'Over Reddingsmodus';
$_ADDONLANG['Settings']['Rescue']['AboutDescription'] = 'Het reddingssysteem is een netwerk-gebaseerde omgeving en kan worden gebruikt om problemen op te lossen die een reguliere opstarten verhinderen. Het is ook nuttig voor het installeren van aangepaste Linux-distributies die niet direct door ons worden aangeboden. U kunt de harde schijf van de server mounten binnen het reddingssysteem.';
$_ADDONLANG['Settings']['Rescue']['Important'] = 'Belangrijk';
$_ADDONLANG['Settings']['Rescue']['ImportantNote'] = 'Na het inschakelen van het reddingssysteem moet u de server in de komende 60 minuten herstarten om het te activeren. Na nog een herstart zal uw server weer opstarten vanaf de lokale schijf.';
$_ADDONLANG['Settings']['Rescue']['EnableTitle'] = 'Reddingsmodus inschakelen';
$_ADDONLANG['Settings']['Rescue']['EnableDescription'] = 'Opstarten in een minimaal Linux-systeem voor herstel- en onderhoudstaken.';
$_ADDONLANG['Settings']['Rescue']['EnableRebootTitle'] = 'Inschakelen & Herstarten';
$_ADDONLANG['Settings']['Rescue']['EnableRebootDescription'] = 'Reddingsmodus inschakelen en de server direct herstarten om het te activeren.';
$_ADDONLANG['Settings']['Rescue']['PasswordPrompt'] = 'Uw nieuwe root wachtwoord is:';

### Floating IP
$_ADDONLANG['Settings']['FloatingIP']['Title'] = 'Zwevend IP';
$_ADDONLANG['Settings']['FloatingIP']['Description'] = 'Beheer zwevende IP\'s toegewezen aan deze server. Zwevende IP\'s kunnen tussen servers worden verplaatst.';
$_ADDONLANG['Settings']['FloatingIP']['Status'] = 'Status';
$_ADDONLANG['Settings']['FloatingIP']['IP'] = 'IP-adres';
$_ADDONLANG['Settings']['FloatingIP']['Type'] = 'Type';
$_ADDONLANG['Settings']['FloatingIP']['None'] = 'Geen zwevend IP toegewezen';
$_ADDONLANG['Settings']['FloatingIP']['NotAvailable'] = 'Zwevend IP niet beschikbaar voor deze service';
$_ADDONLANG['Settings']['FloatingIP']['Assigned'] = 'Toegewezen';
$_ADDONLANG['Settings']['FloatingIP']['Unassigned'] = 'Niet toegewezen';
$_ADDONLANG['Settings']['FloatingIP']['Assign'] = 'Toewijzen aan Server';
$_ADDONLANG['Settings']['FloatingIP']['Unassign'] = 'Verwijderen van Server';
$_ADDONLANG['Settings']['FloatingIP']['ReverseDNS'] = 'Reverse DNS';
$_ADDONLANG['Settings']['FloatingIP']['ReverseDNSDescription'] = 'Stel reverse DNS (PTR-record) in voor dit zwevende IP';
$_ADDONLANG['Settings']['FloatingIP']['SetReverseDNS'] = 'Reverse DNS instellen';
$_ADDONLANG['Settings']['FloatingIP']['ReverseDNSPlaceholder'] = 'voorbeeld.nl';

# Additional strings for UI elements
$_ADDONLANG['General']['NoBackupsFound'] = 'Geen back-ups gevonden';
$_ADDONLANG['General']['NoFirewallRules'] = 'Geen firewall regels geconfigureerd';
$_ADDONLANG['General']['NoDataAvailable'] = 'Geen gegevens beschikbaar';
$_ADDONLANG['General']['RefreshAll'] = 'Alles vernieuwen';
$_ADDONLANG['General']['AddRule'] = 'Regel toevoegen';
$_ADDONLANG['General']['Note'] = 'Opmerking';
$_ADDONLANG['General']['GB'] = 'GB';
$_ADDONLANG['General']['TB'] = 'TB';
$_ADDONLANG['General']['Any'] = 'Elke';
$_ADDONLANG['General']['EmptyValue'] = '-';
$_ADDONLANG['General']['Colon'] = ': ';

## Firewall specific
$_ADDONLANG['Firewall']['CurrentRules'] = 'Huidige Firewall Regels';
$_ADDONLANG['Firewall']['ResourcesAttached'] = 'Firewall resources zijn gekoppeld aan servers. Als er geen firewall is gekoppeld, wordt er automatisch een aangemaakt wanneer u uw eerste regel toevoegt.';
$_ADDONLANG['Firewall']['Direction'] = 'Richting';
$_ADDONLANG['Firewall']['Action'] = 'Actie';
$_ADDONLANG['Firewall']['Protocol'] = 'Protocol';
$_ADDONLANG['Firewall']['Port'] = 'Poort';
$_ADDONLANG['Firewall']['IPCIDR'] = 'IP/CIDR';
$_ADDONLANG['Firewall']['Remove'] = 'Verwijderen';
$_ADDONLANG['Firewall']['ChangesImmediate'] = 'Firewall wijzigingen worden onmiddellijk toegepast. Het is niet nodig om wijzigingen door te voeren.';
$_ADDONLANG['Firewall']['AddNewRule'] = 'Nieuwe Firewall Regel toevoegen';
$_ADDONLANG['Firewall']['PortPlaceholder'] = '1-65535';
$_ADDONLANG['Firewall']['SourcePlaceholder'] = '0.0.0.0/0';
$_ADDONLANG['Firewall']['Accept'] = 'ACCEPTEREN';
$_ADDONLANG['Firewall']['Drop'] = 'WEGGOOIEN';
$_ADDONLANG['Firewall']['Info'] = 'INFO';
$_ADDONLANG['Firewall']['Any'] = 'ELKE';
$_ADDONLANG['Firewall']['TCP'] = 'TCP';
$_ADDONLANG['Firewall']['UDP'] = 'UDP';
$_ADDONLANG['Firewall']['ICMP'] = 'ICMP';
$_ADDONLANG['Firewall']['Incoming'] = 'Inkomend';
$_ADDONLANG['Firewall']['Outgoing'] = 'Uitgaand';
$_ADDONLANG['Settings']['Firewall']['Direction'] = 'Richting';

## Reinstall specific
$_ADDONLANG['Reinstall']['DestroyWarning'] = 'Herbouwen zal alle gegevens op de server vernietigen. Een nieuw root wachtwoord wordt gegenereerd en opgeslagen in uw service account.';

## Additional UI messages
$_ADDONLANG['Messages']['PortRequired'] = 'Poort is vereist voor TCP/UDP protocollen';
$_ADDONLANG['Messages']['RefreshingGraphs'] = 'Alle grafieken vernieuwen...';
$_ADDONLANG['Messages']['PasswordSaveNote'] = 'Sla dit wachtwoord op een veilige locatie op';
$_ADDONLANG['Messages']['SelectOSFirst'] = 'Selecteer eerst een besturingssysteem.';

## Server types
$_ADDONLANG['ServerTypes']['Standard'] = 'Standaard';
