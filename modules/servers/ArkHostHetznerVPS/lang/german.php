<?php

# Client Area
## General
$_ADDONLANG['Title'] = 'VPS Informationen';
$_ADDONLANG['IPv4'] = 'IPv4';
$_ADDONLANG['IPv6'] = 'IPv6';
$_ADDONLANG['Start'] = 'Starten';
$_ADDONLANG['Stop'] = 'Stoppen';
$_ADDONLANG['Restart'] = 'Neustart';
$_ADDONLANG['Shutdown'] = 'Herunterfahren';
$_ADDONLANG['VNC'] = 'VNC Konsole';
$_ADDONLANG['Delete'] = 'Löschen';
$_ADDONLANG['Close'] = 'Schließen';
$_ADDONLANG['Restore'] = 'Wiederherstellen';
$_ADDONLANG['SelectISOImage'] = 'ISO-Image auswählen...';
$_ADDONLANG['NoISOImages'] = 'Keine ISO-Images verfügbar';
$_ADDONLANG['LoadingGraphs'] = 'Lade Performance-Diagramme...';
$_ADDONLANG['LoadingBackups'] = 'Lade Backup-Daten...';
$_ADDONLANG['LoadingFirewallRules'] = 'Lade Firewall-Regeln...';
$_ADDONLANG['CopyToClipboard'] = 'In Zwischenablage kopieren';
$_ADDONLANG['PasswordCopied'] = 'Passwort in Zwischenablage kopiert!';
$_ADDONLANG['SavePassword'] = 'Stellen Sie sicher, dass Sie dieses Passwort speichern!';
$_ADDONLANG['PasswordSaved'] = 'Es wurde auch in Ihrem Service gespeichert.';
$_ADDONLANG['RescueModeEnabled'] = 'Rettungsmodus aktiviert! Root-Passwort: ';
$_ADDONLANG['NetworkError'] = 'Netzwerkfehler';
$_ADDONLANG['ActionFailed'] = 'Aktion fehlgeschlagen!';
$_ADDONLANG['ActionSuccess'] = 'Aktion erfolgreich abgeschlossen';

## Confirmations
$_ADDONLANG['Confirm']['Stop']['Title'] = 'VPS stoppen';
$_ADDONLANG['Confirm']['Stop']['Message'] = 'Möchten Sie diesen VPS stoppen? Dies wird den Server herunterfahren.';
$_ADDONLANG['Confirm']['Restart']['Title'] = 'VPS neustarten';
$_ADDONLANG['Confirm']['Restart']['Message'] = 'Möchten Sie diesen VPS neustarten? Dies wird den Server neu starten.';
$_ADDONLANG['Confirm']['Cancel'] = 'Abbrechen';
$_ADDONLANG['Confirm']['Confirm'] = 'Bestätigen';
$_ADDONLANG['Confirm']['CreateBackup']['Title'] = 'Backup erstellen';
$_ADDONLANG['Confirm']['CreateBackup']['Message'] = 'Möchten Sie ein Backup erstellen? Dies kann mehrere Minuten dauern.';
$_ADDONLANG['Confirm']['DeleteBackup']['Title'] = 'Backup löschen';
$_ADDONLANG['Confirm']['DeleteBackup']['Message'] = 'Möchten Sie dieses Backup löschen? Diese Aktion kann nicht rückgängig gemacht werden.';
$_ADDONLANG['Confirm']['RestoreBackup']['Title'] = 'Backup wiederherstellen';
$_ADDONLANG['Confirm']['RestoreBackup']['Message'] = 'Möchten Sie dieses Backup wiederherstellen? Dies wird alle aktuellen Daten überschreiben und kann nicht rückgängig gemacht werden.';
$_ADDONLANG['Confirm']['Shutdown']['Title'] = 'VPS herunterfahren';
$_ADDONLANG['Confirm']['Shutdown']['Message'] = 'Möchten Sie diesen VPS ordnungsgemäß herunterfahren? Dies wird den Server sauber herunterfahren.';
$_ADDONLANG['Confirm']['EnableRescue']['Title'] = 'Rettungsmodus aktivieren';
$_ADDONLANG['Confirm']['EnableRescue']['Message'] = 'Rettungsmodus aktivieren? Der Server muss innerhalb von 60 Minuten manuell neu gestartet werden, damit dies wirksam wird.';
$_ADDONLANG['Confirm']['EnableRescueReboot']['Title'] = 'Rettungsmodus aktivieren & Neustart';
$_ADDONLANG['Confirm']['EnableRescueReboot']['Message'] = 'Rettungsmodus aktivieren und den Server sofort neu starten?';
$_ADDONLANG['Confirm']['DisableRescue']['Title'] = 'Rettungsmodus deaktivieren';
$_ADDONLANG['Confirm']['DisableRescue']['Message'] = 'Dies wird den Rettungsmodus deaktivieren. Der Server wird beim nächsten Neustart normal starten. Fortfahren?';
$_ADDONLANG['Confirm']['ResetPassword']['Title'] = 'Root-Passwort zurücksetzen';
$_ADDONLANG['Confirm']['ResetPassword']['Message'] = 'Dies wird das Root-Passwort zurücksetzen. Der Server muss laufen und qemu guest agent installiert haben. Fortfahren?';
$_ADDONLANG['Confirm']['DeleteFirewallRule']['Title'] = 'Firewall-Regel löschen';
$_ADDONLANG['Confirm']['DeleteFirewallRule']['Message'] = 'Sind Sie sicher, dass Sie diese Firewall-Regel löschen möchten?';

## Navbar
$_ADDONLANG['Navbar']['Overview'] = 'Übersicht';
$_ADDONLANG['Navbar']['Graphs'] = 'Diagramme';
$_ADDONLANG['Navbar']['Backups'] = 'Backups';
$_ADDONLANG['Navbar']['Settings'] = 'Einstellungen';

## Overview
$_ADDONLANG['Overview']['CPU'] = 'CPU-Auslastung';
$_ADDONLANG['Overview']['RAM'] = 'RAM-Auslastung';
$_ADDONLANG['Overview']['Bandwidth'] = 'Bandbreiten-Nutzung';
$_ADDONLANG['Overview']['Disk'] = 'Festplattenspeicher';
$_ADDONLANG['Overview']['ServerInfo'] = 'Server-Informationen';
$_ADDONLANG['Overview']['ResourceAllocation'] = 'Ressourcenzuteilung';
$_ADDONLANG['Overview']['QuickActions'] = 'Schnellaktionen';
$_ADDONLANG['Overview']['Hostname'] = 'Hostname';
$_ADDONLANG['Overview']['Status'] = 'Status';
$_ADDONLANG['Overview']['OS'] = 'Betriebssystem';
$_ADDONLANG['Overview']['Location'] = 'Standort';
$_ADDONLANG['Overview']['CPU_Cores'] = 'vCPU Kerne';
$_ADDONLANG['Overview']['Memory'] = 'Arbeitsspeicher';
$_ADDONLANG['Overview']['Storage'] = 'SSD-Speicher';
$_ADDONLANG['Overview']['Traffic'] = 'Inklusiv-Traffic';
$_ADDONLANG['Overview']['Uptime'] = 'Betriebszeit';
$_ADDONLANG['Overview']['ServerType'] = 'Server-Typ';
$_ADDONLANG['Overview']['MetricsNote'] = 'Hinweis: API bietet nur CPU-Metriken. RAM- und Festplatten-Nutzungsmetriken sind nicht verfügbar.';
$_ADDONLANG['Overview']['Allocated'] = 'Zugewiesen';

## Graphs
$_ADDONLANG['Graphs']['Title'] = 'Performance-Metriken';
$_ADDONLANG['Graphs']['CPU'] = 'CPU-Auslastung';
$_ADDONLANG['Graphs']['RAM'] = 'RAM-Auslastung';
$_ADDONLANG['Graphs']['Disk'] = 'Festplatten-Nutzung';
$_ADDONLANG['Graphs']['Network'] = 'Netzwerk-Nutzung';
$_ADDONLANG['Graphs']['Hour'] = 'Stunde';
$_ADDONLANG['Graphs']['Day'] = 'Tag';
$_ADDONLANG['Graphs']['Week'] = 'Woche';
$_ADDONLANG['Graphs']['Month'] = 'Monat';
$_ADDONLANG['Graphs']['Year'] = 'Jahr';
$_ADDONLANG['Graphs']['Loading'] = 'Diagramm wird geladen...';
$_ADDONLANG['Graphs']['SelectPeriod'] = 'Wählen Sie einen Zeitraum aus, um Server-Performance-Metriken anzuzeigen';
$_ADDONLANG['Graphs']['CPUUsage'] = 'CPU-Auslastung';
$_ADDONLANG['Graphs']['NetworkTraffic'] = 'Netzwerk-Traffic';
$_ADDONLANG['Graphs']['DiskIO'] = 'Festplatten-E/A';
$_ADDONLANG['Graphs']['CPUUnit'] = '%';
$_ADDONLANG['Graphs']['NetworkUnit'] = 'Mbps';
$_ADDONLANG['Graphs']['DiskUnit'] = 'IOPS';
$_ADDONLANG['Graphs']['Current'] = 'Aktuell';
$_ADDONLANG['Graphs']['Inbound'] = 'Eingehend';
$_ADDONLANG['Graphs']['Outbound'] = 'Ausgehend';
$_ADDONLANG['Graphs']['Read'] = 'Lesen';
$_ADDONLANG['Graphs']['Write'] = 'Schreiben';

## Backups
$_ADDONLANG['Backups']['Title'] = 'Backup-Verwaltung';
$_ADDONLANG['Backups']['Description'] = 'Die Daten für die Backups dieses VPS sind unten aufgelistet. Sie können diese entsprechend wiederherstellen oder löschen.';
$_ADDONLANG['Backups']['Warning'] = 'Für jeden Server gibt es sieben Speicherplätze für Backups. Wenn alle Speicherplätze belegt sind, wird das älteste Backup gelöscht.';
$_ADDONLANG['Backups']['Date'] = 'Datum';
$_ADDONLANG['Backups']['Size'] = 'Größe';
$_ADDONLANG['Backups']['Type'] = 'Typ';
$_ADDONLANG['Backups']['Status'] = 'Status';
$_ADDONLANG['Backups']['Actions'] = 'Aktionen';
$_ADDONLANG['Backups']['Create'] = 'Jetzt sichern';
$_ADDONLANG['Backups']['Available'] = 'Verfügbar';
$_ADDONLANG['Backups']['Creating'] = 'Wird erstellt...';
$_ADDONLANG['Backups']['Error'] = 'Fehler';
$_ADDONLANG['Backups']['Automatic'] = 'Automatisch';
$_ADDONLANG['Backups']['Manual'] = 'Manuell';

## Settings
$_ADDONLANG['Settings']['Title'] = 'Einstellungsmenü';
### Hostname
$_ADDONLANG['Settings']['Hostname']['Title'] = 'Hostname';
$_ADDONLANG['Settings']['Hostname']['Description'] = 'Setzt den Hostname und das rDNS. Bitte erstellen Sie zuerst den A-Record.';
$_ADDONLANG['Settings']['Hostname']['Submit'] = 'Absenden';

### ISO
$_ADDONLANG['Settings']['ISO']['Title'] = 'ISO';
$_ADDONLANG['Settings']['ISO']['Description'] = 'Wenn Sie das Betriebssystem über das ISO-Image installieren, müssen Sie auch die Netzwerkschnittstelle statisch konfigurieren. Es läuft kein DHCP-Server.';
$_ADDONLANG['Settings']['ISO']['Image'] = 'ISO-Image';
$_ADDONLANG['Settings']['ISO']['Submit'] = 'ISO laden';
$_ADDONLANG['Settings']['ISO']['Remove'] = 'ISO auswerfen';

### Password
$_ADDONLANG['Settings']['Password']['Title'] = 'Passwort';
$_ADDONLANG['Settings']['Password']['Description'] = 'Das Installationspasswort wird nach 72 Stunden aus unseren Systemen entfernt. Es ist obligatorisch, dass Sie das Passwort bei Ihrem ersten Login ändern!';
$_ADDONLANG['Settings']['Password']['Submit'] = 'Passwort zurücksetzen';

### Reinstall
$_ADDONLANG['Settings']['Reinstall']['Title'] = 'Neuinstallation';
$_ADDONLANG['Settings']['Reinstall']['Description'] = 'Bitte beachten Sie, dass bei einer Neuinstallation alle Daten vom Server gelöscht werden. Diese Aktion ist irreversibel!';
$_ADDONLANG['Settings']['Reinstall']['OS'] = 'Betriebssystem';
$_ADDONLANG['Settings']['Reinstall']['Version'] = 'VERSION WÄHLEN';
$_ADDONLANG['Settings']['Reinstall']['Submit'] = 'Neuinstallieren';

### Firewall
$_ADDONLANG['Settings']['Firewall']['Title'] = 'Firewall';
$_ADDONLANG['Settings']['Firewall']['Description'] = 'Die Regeln werden von oben nach unten ausgewertet. Standardmäßig ist alles erlaubt. Die Firewall ist nur auf der öffentlichen Schnittstelle verfügbar. Nur der eingehende Traffic wird von der Firewall gefiltert.';
$_ADDONLANG['Settings']['Firewall']['Action'] = 'Aktion';
$_ADDONLANG['Settings']['Firewall']['Port'] = 'Port';
$_ADDONLANG['Settings']['Firewall']['Protocol'] = 'Protokoll';
$_ADDONLANG['Settings']['Firewall']['Source'] = 'Quelle';
$_ADDONLANG['Settings']['Firewall']['Note'] = 'Hinweis';
$_ADDONLANG['Settings']['Firewall']['Actions'] = 'Aktionen';
$_ADDONLANG['Settings']['Firewall']['Accept'] = 'Akzeptieren';
$_ADDONLANG['Settings']['Firewall']['Drop'] = 'Verwerfen';
$_ADDONLANG['Settings']['Firewall']['PortNumber'] = 'Port-Nummer';
$_ADDONLANG['Settings']['Firewall']['SourceLabel'] = 'z.B.: x.x.x.x/xx (optional)';
$_ADDONLANG['Settings']['Firewall']['Notes'] = 'Hinweise (optional)';
$_ADDONLANG['Settings']['Firewall']['Warning'] = 'Die Regeln müssen übernommen werden, um wirksam zu werden.';
$_ADDONLANG['Settings']['Firewall']['Submit'] = 'Firewall übernehmen';

### Rescue Mode
$_ADDONLANG['Settings']['Rescue']['Title'] = 'Rettungsmodus';
$_ADDONLANG['Settings']['Rescue']['Description'] = 'Der Rettungsmodus startet Ihren Server in ein temporäres Linux-System, von dem aus Sie auf die Festplatten Ihres Servers zugreifen können, um Daten zu reparieren oder wiederherzustellen.';
$_ADDONLANG['Settings']['Rescue']['Status'] = 'Status';
$_ADDONLANG['Settings']['Rescue']['Active'] = 'Aktiv';
$_ADDONLANG['Settings']['Rescue']['Inactive'] = 'Inaktiv';
$_ADDONLANG['Settings']['Rescue']['Enable'] = 'Rettungsmodus aktivieren';
$_ADDONLANG['Settings']['Rescue']['EnableReboot'] = 'Aktivieren und neustarten';
$_ADDONLANG['Settings']['Rescue']['Disable'] = 'Rettungsmodus deaktivieren';
$_ADDONLANG['Settings']['Rescue']['ResetRootPassword'] = 'Root-Passwort zurücksetzen';
$_ADDONLANG['Settings']['Rescue']['Warning'] = 'Nach dem Aktivieren des Rettungsmodus müssen Sie den Server innerhalb von 60 Minuten neu starten, damit er wirksam wird.';
$_ADDONLANG['Settings']['Rescue']['PasswordNote'] = 'Das Root-Passwort wird nach dem Aktivieren des Rettungsmodus einmal angezeigt. Stellen Sie sicher, dass Sie es speichern!';
$_ADDONLANG['Settings']['Rescue']['DisableTitle'] = 'Rettungsmodus deaktivieren';
$_ADDONLANG['Settings']['Rescue']['DisableDescription'] = 'Wenn der Rettungsmodus derzeit aktiv ist, können Sie ihn hier deaktivieren. Der Server wird beim nächsten Neustart normal starten.';
$_ADDONLANG['Settings']['Rescue']['NewRootPassword'] = 'Neues Root-Passwort';
$_ADDONLANG['Settings']['Rescue']['AboutTitle'] = 'Über den Rettungsmodus';
$_ADDONLANG['Settings']['Rescue']['AboutDescription'] = 'Das Rettungssystem ist eine netzwerkbasierte Umgebung und kann verwendet werden, um Probleme zu beheben, die einen regulären Start verhindern. Es ist auch nützlich für die Installation benutzerdefinierter Linux-Distributionen, die nicht direkt von uns angeboten werden. Sie können die Festplatte des Servers im Rettungssystem mounten.';
$_ADDONLANG['Settings']['Rescue']['Important'] = 'Wichtig';
$_ADDONLANG['Settings']['Rescue']['ImportantNote'] = 'Nach dem Aktivieren des Rettungssystems müssen Sie den Server in den nächsten 60 Minuten neu starten, um es zu aktivieren. Nach einem weiteren Neustart startet Ihr Server wieder von seiner lokalen Festplatte.';
$_ADDONLANG['Settings']['Rescue']['EnableTitle'] = 'Rettungsmodus aktivieren';
$_ADDONLANG['Settings']['Rescue']['EnableDescription'] = 'In ein minimales Linux-System für Wiederherstellungs- und Wartungsaufgaben starten.';
$_ADDONLANG['Settings']['Rescue']['EnableRebootTitle'] = 'Aktivieren & Neustarten';
$_ADDONLANG['Settings']['Rescue']['EnableRebootDescription'] = 'Rettungsmodus aktivieren und den Server sofort neu starten, um ihn zu aktivieren.';
$_ADDONLANG['Settings']['Rescue']['PasswordPrompt'] = 'Ihr neues Root-Passwort lautet:';

### Floating IP
$_ADDONLANG['Settings']['FloatingIP']['Title'] = 'Floating IP';
$_ADDONLANG['Settings']['FloatingIP']['Description'] = 'Floating IPs verwalten, die diesem Server zugewiesen sind. Floating IPs können zwischen Servern verschoben werden.';
$_ADDONLANG['Settings']['FloatingIP']['Status'] = 'Status';
$_ADDONLANG['Settings']['FloatingIP']['IP'] = 'IP-Adresse';
$_ADDONLANG['Settings']['FloatingIP']['Type'] = 'Typ';
$_ADDONLANG['Settings']['FloatingIP']['None'] = 'Keine Floating IP zugewiesen';
$_ADDONLANG['Settings']['FloatingIP']['NotAvailable'] = 'Floating IP für diesen Dienst nicht verfügbar';
$_ADDONLANG['Settings']['FloatingIP']['Assigned'] = 'Zugewiesen';
$_ADDONLANG['Settings']['FloatingIP']['Unassigned'] = 'Nicht zugewiesen';
$_ADDONLANG['Settings']['FloatingIP']['Assign'] = 'Dem Server zuweisen';
$_ADDONLANG['Settings']['FloatingIP']['Unassign'] = 'Vom Server entfernen';
$_ADDONLANG['Settings']['FloatingIP']['ReverseDNS'] = 'Reverse DNS';
$_ADDONLANG['Settings']['FloatingIP']['ReverseDNSDescription'] = 'Reverse DNS (PTR-Eintrag) für diese Floating IP festlegen';
$_ADDONLANG['Settings']['FloatingIP']['SetReverseDNS'] = 'Reverse DNS festlegen';
$_ADDONLANG['Settings']['FloatingIP']['ReverseDNSPlaceholder'] = 'beispiel.de';

# Additional strings for UI elements
$_ADDONLANG['General']['NoBackupsFound'] = 'Keine Backups gefunden';
$_ADDONLANG['General']['NoFirewallRules'] = 'Keine Firewall-Regeln konfiguriert';
$_ADDONLANG['General']['NoDataAvailable'] = 'Keine Daten verfügbar';
$_ADDONLANG['General']['RefreshAll'] = 'Alle aktualisieren';
$_ADDONLANG['General']['AddRule'] = 'Regel hinzufügen';
$_ADDONLANG['General']['Note'] = 'Hinweis';
$_ADDONLANG['General']['GB'] = 'GB';
$_ADDONLANG['General']['TB'] = 'TB';
$_ADDONLANG['General']['Any'] = 'Alle';
$_ADDONLANG['General']['EmptyValue'] = '-';
$_ADDONLANG['General']['Colon'] = ': ';

## Firewall specific
$_ADDONLANG['Firewall']['CurrentRules'] = 'Aktuelle Firewall-Regeln';
$_ADDONLANG['Firewall']['ResourcesAttached'] = 'Firewall-Ressourcen sind an Server angehängt. Wenn keine Firewall angehängt ist, wird automatisch eine erstellt, wenn Sie Ihre erste Regel hinzufügen.';
$_ADDONLANG['Firewall']['ChangesImmediate'] = 'Firewall-Änderungen werden sofort angewendet. Es ist nicht notwendig, Änderungen zu übernehmen.';
$_ADDONLANG['Firewall']['AddNewRule'] = 'Neue Firewall-Regel hinzufügen';
$_ADDONLANG['Firewall']['PortPlaceholder'] = '1-65535';
$_ADDONLANG['Firewall']['SourcePlaceholder'] = '0.0.0.0/0';
$_ADDONLANG['Firewall']['DescriptionPlaceholder'] = 'Regelbeschreibung';
$_ADDONLANG['Firewall']['Accept'] = 'AKZEPTIEREN';
$_ADDONLANG['Firewall']['Drop'] = 'VERWERFEN';
$_ADDONLANG['Firewall']['Info'] = 'INFO';
$_ADDONLANG['Firewall']['Any'] = 'ALLE';
$_ADDONLANG['Firewall']['TCP'] = 'TCP';
$_ADDONLANG['Firewall']['UDP'] = 'UDP';
$_ADDONLANG['Firewall']['ICMP'] = 'ICMP';

## Reinstall specific
$_ADDONLANG['Reinstall']['DestroyWarning'] = 'Die Neuinstallation wird alle Daten auf dem Server zerstören. Ein neues Root-Passwort wird generiert und in Ihrem Service-Konto gespeichert.';

## Additional UI messages
$_ADDONLANG['Messages']['PortRequired'] = 'Port ist für TCP/UDP-Protokolle erforderlich';
$_ADDONLANG['Messages']['RefreshingGraphs'] = 'Alle Diagramme werden aktualisiert...';
$_ADDONLANG['Messages']['PasswordSaveNote'] = 'Speichern Sie dieses Passwort an einem sicheren Ort';
$_ADDONLANG['Messages']['SelectOSFirst'] = 'Bitte wählen Sie zuerst ein Betriebssystem aus.';

## Server types
$_ADDONLANG['ServerTypes']['Standard'] = 'Standard';
