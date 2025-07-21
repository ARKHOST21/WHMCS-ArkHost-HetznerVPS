<?php

# Client Area
## General
$_ADDONLANG['Title'] = 'Informazioni VPS';
$_ADDONLANG['IPv4'] = 'IPv4';
$_ADDONLANG['IPv6'] = 'IPv6';
$_ADDONLANG['Start'] = 'Avvia';
$_ADDONLANG['Stop'] = 'Ferma';
$_ADDONLANG['Restart'] = 'Riavvia';
$_ADDONLANG['Shutdown'] = 'Spegni';
$_ADDONLANG['VNC'] = 'Console VNC';
$_ADDONLANG['Delete'] = 'Elimina';
$_ADDONLANG['Close'] = 'Chiudi';
$_ADDONLANG['Restore'] = 'Ripristina';
$_ADDONLANG['SelectISOImage'] = 'Seleziona immagine ISO...';
$_ADDONLANG['NoISOImages'] = 'Nessuna immagine ISO disponibile';
$_ADDONLANG['LoadingGraphs'] = 'Caricamento grafici delle prestazioni...';
$_ADDONLANG['LoadingBackups'] = 'Caricamento dati backup...';
$_ADDONLANG['LoadingFirewallRules'] = 'Caricamento regole firewall...';
$_ADDONLANG['CopyToClipboard'] = 'Copia negli appunti';
$_ADDONLANG['PasswordCopied'] = 'Password copiata negli appunti!';
$_ADDONLANG['SavePassword'] = 'Assicurati di salvare questa password!';
$_ADDONLANG['PasswordSaved'] = 'È stata salvata anche nel tuo servizio.';
$_ADDONLANG['RescueModeEnabled'] = 'Modalità di recupero attivata! Password root: ';
$_ADDONLANG['NetworkError'] = 'Errore di rete';
$_ADDONLANG['ActionFailed'] = 'Azione fallita!';
$_ADDONLANG['ActionSuccess'] = 'Azione completata con successo';

## Confirmations
$_ADDONLANG['Confirm']['Stop']['Title'] = 'Ferma VPS';
$_ADDONLANG['Confirm']['Stop']['Message'] = 'Vuoi fermare questo VPS? Questo spegnerà il server.';
$_ADDONLANG['Confirm']['Restart']['Title'] = 'Riavvia VPS';
$_ADDONLANG['Confirm']['Restart']['Message'] = 'Vuoi riavviare questo VPS? Questo riavvierà il server.';
$_ADDONLANG['Confirm']['Cancel'] = 'Annulla';
$_ADDONLANG['Confirm']['Confirm'] = 'Conferma';
$_ADDONLANG['Confirm']['CreateBackup']['Title'] = 'Crea Backup';
$_ADDONLANG['Confirm']['CreateBackup']['Message'] = 'Vuoi creare un backup? Questo può richiedere diversi minuti.';
$_ADDONLANG['Confirm']['DeleteBackup']['Title'] = 'Elimina Backup';
$_ADDONLANG['Confirm']['DeleteBackup']['Message'] = 'Vuoi eliminare questo backup? Questa azione non può essere annullata.';
$_ADDONLANG['Confirm']['RestoreBackup']['Title'] = 'Ripristina Backup';
$_ADDONLANG['Confirm']['RestoreBackup']['Message'] = 'Vuoi ripristinare questo backup? Questo sovrascriverà tutti i dati attuali e non può essere annullato.';
$_ADDONLANG['Confirm']['Shutdown']['Title'] = 'Spegni VPS';
$_ADDONLANG['Confirm']['Shutdown']['Message'] = 'Vuoi spegnere correttamente questo VPS? Questo eseguirà uno spegnimento pulito del server.';
$_ADDONLANG['Confirm']['EnableRescue']['Title'] = 'Attiva Modalità di Recupero';
$_ADDONLANG['Confirm']['EnableRescue']['Message'] = 'Attivare la modalità di recupero? Il server deve essere riavviato manualmente entro 60 minuti perché questo abbia effetto.';
$_ADDONLANG['Confirm']['EnableRescueReboot']['Title'] = 'Attiva Modalità di Recupero & Riavvia';
$_ADDONLANG['Confirm']['EnableRescueReboot']['Message'] = 'Attivare la modalità di recupero e riavviare immediatamente il server?';
$_ADDONLANG['Confirm']['DisableRescue']['Title'] = 'Disattiva Modalità di Recupero';
$_ADDONLANG['Confirm']['DisableRescue']['Message'] = 'Questo disattiverà la modalità di recupero. Il server si avvierà normalmente al prossimo riavvio. Continuare?';
$_ADDONLANG['Confirm']['ResetPassword']['Title'] = 'Reimposta Password Root';
$_ADDONLANG['Confirm']['ResetPassword']['Message'] = 'Questo resetterà la password root. Il server deve essere in funzione e avere installato qemu guest agent. Continuare?';
$_ADDONLANG['Confirm']['DeleteFirewallRule']['Title'] = 'Elimina Regola Firewall';
$_ADDONLANG['Confirm']['DeleteFirewallRule']['Message'] = 'Sei sicuro di voler eliminare questa regola del firewall?';

## Navbar
$_ADDONLANG['Navbar']['Overview'] = 'Panoramica';
$_ADDONLANG['Navbar']['Graphs'] = 'Grafici';
$_ADDONLANG['Navbar']['Backups'] = 'Backup';
$_ADDONLANG['Navbar']['Settings'] = 'Impostazioni';

## Overview
$_ADDONLANG['Overview']['CPU'] = 'Uso CPU';
$_ADDONLANG['Overview']['RAM'] = 'Uso RAM';
$_ADDONLANG['Overview']['Bandwidth'] = 'Uso Larghezza di Banda';
$_ADDONLANG['Overview']['Disk'] = 'Spazio Disco';
$_ADDONLANG['Overview']['ServerInfo'] = 'Informazioni Server';
$_ADDONLANG['Overview']['ResourceAllocation'] = 'Allocazione Risorse';
$_ADDONLANG['Overview']['QuickActions'] = 'Azioni Rapide';
$_ADDONLANG['Overview']['Hostname'] = 'Nome Host';
$_ADDONLANG['Overview']['Status'] = 'Stato';
$_ADDONLANG['Overview']['OS'] = 'Sistema Operativo';
$_ADDONLANG['Overview']['Location'] = 'Posizione';
$_ADDONLANG['Overview']['CPU_Cores'] = 'Core vCPU';
$_ADDONLANG['Overview']['Memory'] = 'Memoria';
$_ADDONLANG['Overview']['Storage'] = 'Archiviazione SSD';
$_ADDONLANG['Overview']['Traffic'] = 'Traffico Incluso';
$_ADDONLANG['Overview']['Uptime'] = 'Tempo di Attività';
$_ADDONLANG['Overview']['ServerType'] = 'Tipo Server';
$_ADDONLANG['Overview']['MetricsNote'] = 'Nota: L\'API fornisce solo metriche CPU. Le metriche di utilizzo RAM e disco non sono disponibili.';
$_ADDONLANG['Overview']['Allocated'] = 'Allocato';

## Graphs
$_ADDONLANG['Graphs']['Title'] = 'Metriche delle Prestazioni';
$_ADDONLANG['Graphs']['CPU'] = 'Uso CPU';
$_ADDONLANG['Graphs']['RAM'] = 'Uso RAM';
$_ADDONLANG['Graphs']['Disk'] = 'Uso Disco';
$_ADDONLANG['Graphs']['Network'] = 'Uso Rete';
$_ADDONLANG['Graphs']['Hour'] = 'Ora';
$_ADDONLANG['Graphs']['Day'] = 'Giorno';
$_ADDONLANG['Graphs']['Week'] = 'Settimana';
$_ADDONLANG['Graphs']['Month'] = 'Mese';
$_ADDONLANG['Graphs']['Year'] = 'Anno';
$_ADDONLANG['Graphs']['Loading'] = 'Caricamento grafico...';
$_ADDONLANG['Graphs']['SelectPeriod'] = 'Seleziona un periodo di tempo per visualizzare le metriche delle prestazioni del server';
$_ADDONLANG['Graphs']['CPUUsage'] = 'Uso CPU';
$_ADDONLANG['Graphs']['NetworkTraffic'] = 'Traffico di Rete';
$_ADDONLANG['Graphs']['DiskIO'] = 'I/O Disco';
$_ADDONLANG['Graphs']['CPUUnit'] = '%';
$_ADDONLANG['Graphs']['NetworkUnit'] = 'Mbps';
$_ADDONLANG['Graphs']['DiskUnit'] = 'IOPS';
$_ADDONLANG['Graphs']['Current'] = 'Corrente';
$_ADDONLANG['Graphs']['Inbound'] = 'In Entrata';
$_ADDONLANG['Graphs']['Outbound'] = 'In Uscita';
$_ADDONLANG['Graphs']['Read'] = 'Lettura';
$_ADDONLANG['Graphs']['Write'] = 'Scrittura';

## Backups
$_ADDONLANG['Backups']['Title'] = 'Gestione Backup';
$_ADDONLANG['Backups']['Description'] = 'Le date per le quali sono disponibili backup di questo VPS sono elencate di seguito. Puoi ripristinarli o eliminarli di conseguenza.';
$_ADDONLANG['Backups']['Warning'] = 'Per ogni server, ci sono sette slot per i backup. Se tutti gli slot sono pieni, il backup più vecchio verrà eliminato.';
$_ADDONLANG['Backups']['Date'] = 'Data';
$_ADDONLANG['Backups']['Size'] = 'Dimensione';
$_ADDONLANG['Backups']['Type'] = 'Tipo';
$_ADDONLANG['Backups']['Status'] = 'Stato';
$_ADDONLANG['Backups']['Actions'] = 'Azioni';
$_ADDONLANG['Backups']['Create'] = 'Backup Ora';
$_ADDONLANG['Backups']['Available'] = 'Disponibile';
$_ADDONLANG['Backups']['Creating'] = 'Creazione in corso...';
$_ADDONLANG['Backups']['Error'] = 'Errore';
$_ADDONLANG['Backups']['Automatic'] = 'Automatico';
$_ADDONLANG['Backups']['Manual'] = 'Manuale';

## Settings
$_ADDONLANG['Settings']['Title'] = 'Menu Impostazioni';
### Hostname
$_ADDONLANG['Settings']['Hostname']['Title'] = 'Nome Host';
$_ADDONLANG['Settings']['Hostname']['Description'] = 'Imposta il nome host e il rDNS. Crea prima il record A.';
$_ADDONLANG['Settings']['Hostname']['Submit'] = 'Invia';

### ISO
$_ADDONLANG['Settings']['ISO']['Title'] = 'ISO';
$_ADDONLANG['Settings']['ISO']['Description'] = 'Se installi il sistema operativo tramite l\'immagine ISO, devi anche configurare staticamente l\'interfaccia di rete. Non c\'è un server DHCP in funzione.';
$_ADDONLANG['Settings']['ISO']['Image'] = 'Immagine ISO';
$_ADDONLANG['Settings']['ISO']['Submit'] = 'Carica ISO';
$_ADDONLANG['Settings']['ISO']['Remove'] = 'Espelli ISO';

### Password
$_ADDONLANG['Settings']['Password']['Title'] = 'Password';
$_ADDONLANG['Settings']['Password']['Description'] = 'La password di installazione viene rimossa dai nostri sistemi dopo 72 ore. È obbligatorio cambiare la password al primo accesso!';
$_ADDONLANG['Settings']['Password']['Submit'] = 'Reimposta Password';

### Reinstall
$_ADDONLANG['Settings']['Reinstall']['Title'] = 'Reinstallazione';
$_ADDONLANG['Settings']['Reinstall']['Description'] = 'Ti preghiamo di capire che reinstallando, tutti i dati verranno cancellati dal server. Questa azione è irreversibile!';
$_ADDONLANG['Settings']['Reinstall']['OS'] = 'Sistema Operativo';
$_ADDONLANG['Settings']['Reinstall']['Version'] = 'SCEGLI VERSIONE';
$_ADDONLANG['Settings']['Reinstall']['Submit'] = 'Reinstalla';

### Firewall
$_ADDONLANG['Settings']['Firewall']['Title'] = 'Firewall';
$_ADDONLANG['Settings']['Firewall']['Description'] = 'Le regole vengono valutate dall\'alto verso il basso. Per impostazione predefinita, tutto è consentito. Il firewall è disponibile solo sull\'interfaccia pubblica. Solo il traffico in entrata verrà filtrato dal firewall.';
$_ADDONLANG['Settings']['Firewall']['Action'] = 'Azione';
$_ADDONLANG['Settings']['Firewall']['Port'] = 'Porta';
$_ADDONLANG['Settings']['Firewall']['Protocol'] = 'Protocollo';
$_ADDONLANG['Settings']['Firewall']['Source'] = 'Sorgente';
$_ADDONLANG['Settings']['Firewall']['Note'] = 'Nota';
$_ADDONLANG['Settings']['Firewall']['Actions'] = 'Azioni';
$_ADDONLANG['Settings']['Firewall']['Accept'] = 'Accetta';
$_ADDONLANG['Settings']['Firewall']['Drop'] = 'Rilascia';
$_ADDONLANG['Settings']['Firewall']['PortNumber'] = 'Numero Porta';
$_ADDONLANG['Settings']['Firewall']['SourceLabel'] = 'Es: x.x.x.x/xx (opzionale)';
$_ADDONLANG['Settings']['Firewall']['Notes'] = 'Note (opzionale)';
$_ADDONLANG['Settings']['Firewall']['Warning'] = 'Le regole devono essere confermate per avere effetto.';
$_ADDONLANG['Settings']['Firewall']['Submit'] = 'Conferma Firewall';

### Rescue Mode
$_ADDONLANG['Settings']['Rescue']['Title'] = 'Modalità di Recupero';
$_ADDONLANG['Settings']['Rescue']['Description'] = 'La modalità di recupero avvia il tuo server in un sistema Linux temporaneo dove puoi accedere ai dischi del tuo server per riparare o recuperare dati.';
$_ADDONLANG['Settings']['Rescue']['Status'] = 'Stato';
$_ADDONLANG['Settings']['Rescue']['Active'] = 'Attivo';
$_ADDONLANG['Settings']['Rescue']['Inactive'] = 'Inattivo';
$_ADDONLANG['Settings']['Rescue']['Enable'] = 'Attiva Modalità di Recupero';
$_ADDONLANG['Settings']['Rescue']['EnableReboot'] = 'Attiva e Riavvia';
$_ADDONLANG['Settings']['Rescue']['Disable'] = 'Disattiva Modalità di Recupero';
$_ADDONLANG['Settings']['Rescue']['ResetRootPassword'] = 'Reimposta Password Root';
$_ADDONLANG['Settings']['Rescue']['Warning'] = 'Dopo aver attivato la modalità di recupero, devi riavviare il server entro 60 minuti perché abbia effetto.';
$_ADDONLANG['Settings']['Rescue']['PasswordNote'] = 'La password root verrà visualizzata una volta dopo aver attivato la modalità di recupero. Assicurati di salvarla!';
$_ADDONLANG['Settings']['Rescue']['DisableTitle'] = 'Disattiva Modalità di Recupero';
$_ADDONLANG['Settings']['Rescue']['DisableDescription'] = 'Se la modalità di recupero è attualmente attiva, puoi disattivarla qui. Il server si avvierà normalmente al prossimo riavvio.';
$_ADDONLANG['Settings']['Rescue']['NewRootPassword'] = 'Nuova Password Root';
$_ADDONLANG['Settings']['Rescue']['AboutTitle'] = 'Informazioni sulla Modalità di Recupero';
$_ADDONLANG['Settings']['Rescue']['AboutDescription'] = 'Il sistema di recupero è un ambiente basato su rete e può essere utilizzato per risolvere problemi che impediscono un avvio regolare. È anche utile per installare distribuzioni Linux personalizzate che non sono offerte direttamente da noi. Puoi montare il disco rigido del server all\'interno del sistema di recupero.';
$_ADDONLANG['Settings']['Rescue']['Important'] = 'Importante';
$_ADDONLANG['Settings']['Rescue']['ImportantNote'] = 'Dopo aver attivato il sistema di recupero devi riavviare il server nei prossimi 60 minuti per attivarlo. Dopo un altro riavvio il tuo server si avvierà di nuovo dal suo disco locale.';
$_ADDONLANG['Settings']['Rescue']['EnableTitle'] = 'Attiva Modalità di Recupero';
$_ADDONLANG['Settings']['Rescue']['EnableDescription'] = 'Avvia in un sistema Linux minimale per attività di recupero e manutenzione.';
$_ADDONLANG['Settings']['Rescue']['EnableRebootTitle'] = 'Attiva e Riavvia';
$_ADDONLANG['Settings']['Rescue']['EnableRebootDescription'] = 'Attiva la modalità di recupero e riavvia immediatamente il server per attivarla.';
$_ADDONLANG['Settings']['Rescue']['PasswordPrompt'] = 'La tua nuova password root è:';

### Floating IP
$_ADDONLANG['Settings']['FloatingIP']['Title'] = 'IP Flottante';
$_ADDONLANG['Settings']['FloatingIP']['Description'] = 'Gestisci gli IP flottanti assegnati a questo server. Gli IP flottanti possono essere spostati tra server.';
$_ADDONLANG['Settings']['FloatingIP']['Status'] = 'Stato';
$_ADDONLANG['Settings']['FloatingIP']['IP'] = 'Indirizzo IP';
$_ADDONLANG['Settings']['FloatingIP']['Type'] = 'Tipo';
$_ADDONLANG['Settings']['FloatingIP']['None'] = 'Nessun IP flottante assegnato';
$_ADDONLANG['Settings']['FloatingIP']['NotAvailable'] = 'IP flottante non disponibile per questo servizio';
$_ADDONLANG['Settings']['FloatingIP']['Assigned'] = 'Assegnato';
$_ADDONLANG['Settings']['FloatingIP']['Unassigned'] = 'Non assegnato';
$_ADDONLANG['Settings']['FloatingIP']['Assign'] = 'Assegna al Server';
$_ADDONLANG['Settings']['FloatingIP']['Unassign'] = 'Rimuovi dal Server';
$_ADDONLANG['Settings']['FloatingIP']['ReverseDNS'] = 'DNS Inverso';
$_ADDONLANG['Settings']['FloatingIP']['ReverseDNSDescription'] = 'Imposta DNS inverso (record PTR) per questo IP flottante';
$_ADDONLANG['Settings']['FloatingIP']['SetReverseDNS'] = 'Imposta DNS Inverso';
$_ADDONLANG['Settings']['FloatingIP']['ReverseDNSPlaceholder'] = 'esempio.it';

# Additional strings for UI elements
$_ADDONLANG['General']['NoBackupsFound'] = 'Nessun backup trovato';
$_ADDONLANG['General']['NoFirewallRules'] = 'Nessuna regola firewall configurata';
$_ADDONLANG['General']['NoDataAvailable'] = 'Nessun dato disponibile';
$_ADDONLANG['General']['RefreshAll'] = 'Aggiorna Tutto';
$_ADDONLANG['General']['AddRule'] = 'Aggiungi Regola';
$_ADDONLANG['General']['Note'] = 'Nota';
$_ADDONLANG['General']['GB'] = 'GB';
$_ADDONLANG['General']['TB'] = 'TB';
$_ADDONLANG['General']['Any'] = 'Qualsiasi';
$_ADDONLANG['General']['EmptyValue'] = '-';
$_ADDONLANG['General']['Colon'] = ': ';

## Firewall specific
$_ADDONLANG['Firewall']['CurrentRules'] = 'Regole Firewall Attuali';
$_ADDONLANG['Firewall']['ResourcesAttached'] = 'Le risorse del firewall sono collegate ai server. Se nessun firewall è collegato, ne verrà creato automaticamente uno quando aggiungi la tua prima regola.';
$_ADDONLANG['Firewall']['ChangesImmediate'] = 'Le modifiche al firewall vengono applicate immediatamente. Non è necessario confermare le modifiche.';
$_ADDONLANG['Firewall']['AddNewRule'] = 'Aggiungi Nuova Regola Firewall';
$_ADDONLANG['Firewall']['PortPlaceholder'] = '1-65535';
$_ADDONLANG['Firewall']['SourcePlaceholder'] = '0.0.0.0/0';
$_ADDONLANG['Firewall']['DescriptionPlaceholder'] = 'Descrizione regola';
$_ADDONLANG['Firewall']['Accept'] = 'ACCETTA';
$_ADDONLANG['Firewall']['Drop'] = 'RILASCIA';
$_ADDONLANG['Firewall']['Info'] = 'INFO';
$_ADDONLANG['Firewall']['Any'] = 'QUALSIASI';
$_ADDONLANG['Firewall']['TCP'] = 'TCP';
$_ADDONLANG['Firewall']['UDP'] = 'UDP';
$_ADDONLANG['Firewall']['ICMP'] = 'ICMP';

## Reinstall specific
$_ADDONLANG['Reinstall']['DestroyWarning'] = 'La ricostruzione distruggerà tutti i dati sul server. Una nuova password root verrà generata e salvata nel tuo account di servizio.';

## Additional UI messages
$_ADDONLANG['Messages']['PortRequired'] = 'La porta è richiesta per i protocolli TCP/UDP';
$_ADDONLANG['Messages']['RefreshingGraphs'] = 'Aggiornamento di tutti i grafici...';
$_ADDONLANG['Messages']['PasswordSaveNote'] = 'Salva questa password in un luogo sicuro';
$_ADDONLANG['Messages']['SelectOSFirst'] = 'Seleziona prima un sistema operativo.';

## Server types
$_ADDONLANG['ServerTypes']['Standard'] = 'Standard';
