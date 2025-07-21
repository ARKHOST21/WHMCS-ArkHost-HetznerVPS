<?php

# Client Area
## General
$_ADDONLANG['Title'] = 'Informations VPS';
$_ADDONLANG['IPv4'] = 'IPv4';
$_ADDONLANG['IPv6'] = 'IPv6';
$_ADDONLANG['Start'] = 'Démarrer';
$_ADDONLANG['Stop'] = 'Arrêter';
$_ADDONLANG['Restart'] = 'Redémarrer';
$_ADDONLANG['Shutdown'] = 'Éteindre';
$_ADDONLANG['VNC'] = 'Console VNC';
$_ADDONLANG['Delete'] = 'Supprimer';
$_ADDONLANG['Close'] = 'Fermer';
$_ADDONLANG['Restore'] = 'Restaurer';
$_ADDONLANG['SelectISOImage'] = 'Sélectionner une image ISO...';
$_ADDONLANG['NoISOImages'] = 'Aucune image ISO disponible';
$_ADDONLANG['LoadingGraphs'] = 'Chargement des graphiques de performance...';
$_ADDONLANG['LoadingBackups'] = 'Chargement des données de sauvegarde...';
$_ADDONLANG['LoadingFirewallRules'] = 'Chargement des règles du pare-feu...';
$_ADDONLANG['CopyToClipboard'] = 'Copier dans le presse-papiers';
$_ADDONLANG['PasswordCopied'] = 'Mot de passe copié dans le presse-papiers !';
$_ADDONLANG['SavePassword'] = 'Assurez-vous de sauvegarder ce mot de passe !';
$_ADDONLANG['PasswordSaved'] = 'Il a également été sauvegardé dans votre service.';
$_ADDONLANG['RescueModeEnabled'] = 'Mode de secours activé ! Mot de passe root : ';
$_ADDONLANG['NetworkError'] = 'Erreur réseau';
$_ADDONLANG['ActionFailed'] = 'Action échouée !';
$_ADDONLANG['ActionSuccess'] = 'Action terminée avec succès';

## Confirmations
$_ADDONLANG['Confirm']['Stop']['Title'] = 'Arrêter le VPS';
$_ADDONLANG['Confirm']['Stop']['Message'] = 'Voulez-vous arrêter ce VPS ? Cela éteindra le serveur.';
$_ADDONLANG['Confirm']['Restart']['Title'] = 'Redémarrer le VPS';
$_ADDONLANG['Confirm']['Restart']['Message'] = 'Voulez-vous redémarrer ce VPS ? Cela redémarrera le serveur.';
$_ADDONLANG['Confirm']['Cancel'] = 'Annuler';
$_ADDONLANG['Confirm']['Confirm'] = 'Confirmer';
$_ADDONLANG['Confirm']['CreateBackup']['Title'] = 'Créer une Sauvegarde';
$_ADDONLANG['Confirm']['CreateBackup']['Message'] = 'Voulez-vous créer une sauvegarde ? Cela peut prendre plusieurs minutes.';
$_ADDONLANG['Confirm']['DeleteBackup']['Title'] = 'Supprimer la Sauvegarde';
$_ADDONLANG['Confirm']['DeleteBackup']['Message'] = 'Voulez-vous supprimer cette sauvegarde ? Cette action ne peut pas être annulée.';
$_ADDONLANG['Confirm']['RestoreBackup']['Title'] = 'Restaurer la Sauvegarde';
$_ADDONLANG['Confirm']['RestoreBackup']['Message'] = 'Voulez-vous restaurer cette sauvegarde ? Cela écrasera toutes les données actuelles et ne peut pas être annulé.';
$_ADDONLANG['Confirm']['Shutdown']['Title'] = 'Éteindre le VPS';
$_ADDONLANG['Confirm']['Shutdown']['Message'] = 'Voulez-vous éteindre ce VPS en toute sécurité ? Cela effectuera un arrêt propre du serveur.';
$_ADDONLANG['Confirm']['EnableRescue']['Title'] = 'Activer le Mode de Secours';
$_ADDONLANG['Confirm']['EnableRescue']['Message'] = 'Activer le mode de secours ? Le serveur doit être redémarré manuellement dans les 60 minutes pour que cela prenne effet.';
$_ADDONLANG['Confirm']['EnableRescueReboot']['Title'] = 'Activer le Mode de Secours et Redémarrer';
$_ADDONLANG['Confirm']['EnableRescueReboot']['Message'] = 'Activer le mode de secours et redémarrer immédiatement le serveur ?';
$_ADDONLANG['Confirm']['DisableRescue']['Title'] = 'Désactiver le Mode de Secours';
$_ADDONLANG['Confirm']['DisableRescue']['Message'] = 'Cela désactivera le mode de secours. Le serveur démarrera normalement au prochain redémarrage. Continuer ?';
$_ADDONLANG['Confirm']['ResetPassword']['Title'] = 'Réinitialiser le Mot de Passe Root';
$_ADDONLANG['Confirm']['ResetPassword']['Message'] = 'Cela réinitialisera le mot de passe root. Le serveur doit être en cours d\'exécution et avoir qemu guest agent installé. Continuer ?';
$_ADDONLANG['Confirm']['DeleteFirewallRule']['Title'] = 'Supprimer la Règle de Pare-feu';
$_ADDONLANG['Confirm']['DeleteFirewallRule']['Message'] = 'Êtes-vous sûr de vouloir supprimer cette règle de pare-feu ?';

## Navbar
$_ADDONLANG['Navbar']['Overview'] = 'Aperçu';
$_ADDONLANG['Navbar']['Graphs'] = 'Graphiques';
$_ADDONLANG['Navbar']['Backups'] = 'Sauvegardes';
$_ADDONLANG['Navbar']['Settings'] = 'Paramètres';

## Overview
$_ADDONLANG['Overview']['CPU'] = 'Utilisation CPU';
$_ADDONLANG['Overview']['RAM'] = 'Utilisation RAM';
$_ADDONLANG['Overview']['Bandwidth'] = 'Utilisation de la Bande Passante';
$_ADDONLANG['Overview']['Disk'] = 'Espace Disque';
$_ADDONLANG['Overview']['ServerInfo'] = 'Informations du Serveur';
$_ADDONLANG['Overview']['ResourceAllocation'] = 'Allocation des Ressources';
$_ADDONLANG['Overview']['QuickActions'] = 'Actions Rapides';
$_ADDONLANG['Overview']['Hostname'] = 'Nom d\'hôte';
$_ADDONLANG['Overview']['Status'] = 'Statut';
$_ADDONLANG['Overview']['OS'] = 'Système d\'Exploitation';
$_ADDONLANG['Overview']['Location'] = 'Localisation';
$_ADDONLANG['Overview']['CPU_Cores'] = 'Cœurs vCPU';
$_ADDONLANG['Overview']['Memory'] = 'Mémoire';
$_ADDONLANG['Overview']['Storage'] = 'Stockage SSD';
$_ADDONLANG['Overview']['Traffic'] = 'Trafic Inclus';
$_ADDONLANG['Overview']['Uptime'] = 'Temps de Fonctionnement';
$_ADDONLANG['Overview']['ServerType'] = 'Type de Serveur';
$_ADDONLANG['Overview']['MetricsNote'] = 'Note : L\'API ne fournit que les métriques CPU. Les métriques d\'utilisation RAM et disque ne sont pas disponibles.';
$_ADDONLANG['Overview']['Allocated'] = 'Alloué';

## Graphs
$_ADDONLANG['Graphs']['Title'] = 'Métriques de Performance';
$_ADDONLANG['Graphs']['CPU'] = 'Utilisation CPU';
$_ADDONLANG['Graphs']['RAM'] = 'Utilisation RAM';
$_ADDONLANG['Graphs']['Disk'] = 'Utilisation Disque';
$_ADDONLANG['Graphs']['Network'] = 'Utilisation Réseau';
$_ADDONLANG['Graphs']['Hour'] = 'Heure';
$_ADDONLANG['Graphs']['Day'] = 'Jour';
$_ADDONLANG['Graphs']['Week'] = 'Semaine';
$_ADDONLANG['Graphs']['Month'] = 'Mois';
$_ADDONLANG['Graphs']['Year'] = 'Année';
$_ADDONLANG['Graphs']['Loading'] = 'Chargement du graphique...';
$_ADDONLANG['Graphs']['SelectPeriod'] = 'Sélectionnez une période pour voir les métriques de performance du serveur';
$_ADDONLANG['Graphs']['CPUUsage'] = 'Utilisation CPU';
$_ADDONLANG['Graphs']['NetworkTraffic'] = 'Trafic Réseau';
$_ADDONLANG['Graphs']['DiskIO'] = 'E/S Disque';
$_ADDONLANG['Graphs']['CPUUnit'] = '%';
$_ADDONLANG['Graphs']['NetworkUnit'] = 'Mbps';
$_ADDONLANG['Graphs']['DiskUnit'] = 'IOPS';
$_ADDONLANG['Graphs']['Current'] = 'Actuel';
$_ADDONLANG['Graphs']['Inbound'] = 'Entrant';
$_ADDONLANG['Graphs']['Outbound'] = 'Sortant';
$_ADDONLANG['Graphs']['Read'] = 'Lecture';
$_ADDONLANG['Graphs']['Write'] = 'Écriture';

## Backups
$_ADDONLANG['Backups']['Title'] = 'Gestion des Sauvegardes';
$_ADDONLANG['Backups']['Description'] = 'Les dates pour lesquelles des sauvegardes de ce VPS sont disponibles sont listées ci-dessous. Vous pouvez les restaurer ou les supprimer en conséquence.';
$_ADDONLANG['Backups']['Warning'] = '* Veuillez garder à l\'esprit que les nouvelles sauvegardes remplaceront les anciennes.<br/>** Les sauvegardes automatiques remplaceront également vos sauvegardes manuelles à moins que les sauvegardes automatiques ne soient désactivées.<br/>*** Les sauvegardes automatiques sont effectuées 2 fois par semaine et font partie de notre plan de récupération après sinistre. Si vous désactivez les sauvegardes automatiques, vous désactivez également toute chance de récupération en cas de sinistre.<br/>**** Le système de fichiers de la sauvegarde pourrait ne pas être entièrement cohérent si le VPS écrivait sur le système de fichiers au moment de la sauvegarde. Pour des sauvegardes entièrement cohérentes, le serveur doit être arrêté pendant la création de la sauvegarde.';
$_ADDONLANG['Backups']['Date'] = 'Date';
$_ADDONLANG['Backups']['Size'] = 'Taille';
$_ADDONLANG['Backups']['Type'] = 'Type';
$_ADDONLANG['Backups']['Status'] = 'Statut';
$_ADDONLANG['Backups']['Actions'] = 'Actions';
$_ADDONLANG['Backups']['Create'] = 'Sauvegarder Maintenant';
$_ADDONLANG['Backups']['Available'] = 'Disponible';
$_ADDONLANG['Backups']['Creating'] = 'Création...';
$_ADDONLANG['Backups']['Error'] = 'Erreur';
$_ADDONLANG['Backups']['Automatic'] = 'Automatique';
$_ADDONLANG['Backups']['Manual'] = 'Manuel';

## Settings
$_ADDONLANG['Settings']['Title'] = 'Menu des Paramètres';
### Hostname
$_ADDONLANG['Settings']['Hostname']['Title'] = 'Nom d\'hôte';
$_ADDONLANG['Settings']['Hostname']['Description'] = 'Définit le nom d\'hôte et le rDNS. Veuillez d\'abord créer l\'enregistrement A.';
$_ADDONLANG['Settings']['Hostname']['Submit'] = 'Soumettre';

### ISO
$_ADDONLANG['Settings']['ISO']['Title'] = 'ISO';
$_ADDONLANG['Settings']['ISO']['Description'] = 'Si vous installez le système d\'exploitation via l\'image ISO, vous devez également configurer l\'interface réseau de manière statique. Il n\'y a pas de serveur DHCP en cours d\'exécution.';
$_ADDONLANG['Settings']['ISO']['Image'] = 'Image ISO';
$_ADDONLANG['Settings']['ISO']['Submit'] = 'Charger ISO';
$_ADDONLANG['Settings']['ISO']['Remove'] = 'Éjecter ISO';

### Password
$_ADDONLANG['Settings']['Password']['Title'] = 'Mot de Passe';
$_ADDONLANG['Settings']['Password']['Description'] = 'Le mot de passe d\'installation est supprimé de nos systèmes après 72 heures. Il est obligatoire de changer le mot de passe lors de votre première connexion !';
$_ADDONLANG['Settings']['Password']['Submit'] = 'Réinitialiser le Mot de Passe';

### Reinstall
$_ADDONLANG['Settings']['Reinstall']['Title'] = 'Réinstaller';
$_ADDONLANG['Settings']['Reinstall']['Description'] = 'Veuillez comprendre qu\'en réinstallant, toutes les données seront effacées du serveur. Cette action est irréversible !';
$_ADDONLANG['Settings']['Reinstall']['OS'] = 'Système d\'Exploitation';
$_ADDONLANG['Settings']['Reinstall']['Version'] = 'CHOISIR LA VERSION';
$_ADDONLANG['Settings']['Reinstall']['Submit'] = 'Réinstaller';

### Firewall
$_ADDONLANG['Settings']['Firewall']['Title'] = 'Pare-feu';
$_ADDONLANG['Settings']['Firewall']['Description'] = 'Les règles sont évaluées de haut en bas. Par défaut, tout est autorisé. Le pare-feu n\'est disponible que sur l\'interface publique. Seul le trafic entrant sera filtré par le pare-feu.';
$_ADDONLANG['Settings']['Firewall']['Action'] = 'Action';
$_ADDONLANG['Settings']['Firewall']['Port'] = 'Port';
$_ADDONLANG['Settings']['Firewall']['Protocol'] = 'Protocole';
$_ADDONLANG['Settings']['Firewall']['Source'] = 'Source';
$_ADDONLANG['Settings']['Firewall']['Note'] = 'Note';
$_ADDONLANG['Settings']['Firewall']['Actions'] = 'Actions';
$_ADDONLANG['Settings']['Firewall']['Accept'] = 'Accepter';
$_ADDONLANG['Settings']['Firewall']['Drop'] = 'Rejeter';
$_ADDONLANG['Settings']['Firewall']['PortNumber'] = 'Numéro de Port';
$_ADDONLANG['Settings']['Firewall']['SourceLabel'] = 'Ex : x.x.x.x/xx (optionnel)';
$_ADDONLANG['Settings']['Firewall']['Notes'] = 'Notes (optionnel)';
$_ADDONLANG['Settings']['Firewall']['Warning'] = 'Les règles doivent être validées pour prendre effet.';
$_ADDONLANG['Settings']['Firewall']['Submit'] = 'Valider le Pare-feu';

### Rescue Mode
$_ADDONLANG['Settings']['Rescue']['Title'] = 'Mode de Secours';
$_ADDONLANG['Settings']['Rescue']['Description'] = 'Le mode de secours démarre votre serveur dans un système Linux temporaire où vous pouvez accéder aux disques de votre serveur pour réparer ou récupérer des données.';
$_ADDONLANG['Settings']['Rescue']['Status'] = 'Statut';
$_ADDONLANG['Settings']['Rescue']['Active'] = 'Actif';
$_ADDONLANG['Settings']['Rescue']['Inactive'] = 'Inactif';
$_ADDONLANG['Settings']['Rescue']['Enable'] = 'Activer le Mode de Secours';
$_ADDONLANG['Settings']['Rescue']['EnableReboot'] = 'Activer et Redémarrer';
$_ADDONLANG['Settings']['Rescue']['Disable'] = 'Désactiver le Mode de Secours';
$_ADDONLANG['Settings']['Rescue']['ResetRootPassword'] = 'Réinitialiser le Mot de Passe Root';
$_ADDONLANG['Settings']['Rescue']['Warning'] = 'Après avoir activé le mode de secours, vous devez redémarrer le serveur dans les 60 minutes pour qu\'il prenne effet.';
$_ADDONLANG['Settings']['Rescue']['PasswordNote'] = 'Le mot de passe root sera affiché une fois après l\'activation du mode de secours. Assurez-vous de le sauvegarder !';
$_ADDONLANG['Settings']['Rescue']['DisableTitle'] = 'Désactiver le Mode de Secours';
$_ADDONLANG['Settings']['Rescue']['DisableDescription'] = 'Si le mode de secours est actuellement actif, vous pouvez le désactiver ici. Le serveur démarrera normalement au prochain redémarrage.';
$_ADDONLANG['Settings']['Rescue']['NewRootPassword'] = 'Nouveau Mot de Passe Root';
$_ADDONLANG['Settings']['Rescue']['AboutTitle'] = 'À Propos du Mode de Secours';
$_ADDONLANG['Settings']['Rescue']['AboutDescription'] = 'Le système de secours est un environnement basé sur le réseau et peut être utilisé pour résoudre les problèmes empêchant un démarrage normal. Il est également utile pour installer des distributions Linux personnalisées qui ne sont pas directement offertes par nous. Vous pouvez monter le disque dur du serveur à l\'intérieur du système de secours.';
$_ADDONLANG['Settings']['Rescue']['Important'] = 'Important';
$_ADDONLANG['Settings']['Rescue']['ImportantNote'] = 'Après avoir activé le système de secours, vous devez redémarrer le serveur dans les 60 minutes suivantes pour l\'activer. Après un autre redémarrage, votre serveur démarrera à nouveau depuis son disque local.';
$_ADDONLANG['Settings']['Rescue']['EnableTitle'] = 'Activer le Mode de Secours';
$_ADDONLANG['Settings']['Rescue']['EnableDescription'] = 'Démarrer dans un système Linux minimal pour les tâches de récupération et de maintenance.';
$_ADDONLANG['Settings']['Rescue']['EnableRebootTitle'] = 'Activer et Redémarrer';
$_ADDONLANG['Settings']['Rescue']['EnableRebootDescription'] = 'Activer le mode de secours et redémarrer immédiatement le serveur pour l\'activer.';
$_ADDONLANG['Settings']['Rescue']['PasswordPrompt'] = 'Votre nouveau mot de passe root est :';

# Additional strings for UI elements
$_ADDONLANG['General']['NoBackupsFound'] = 'Aucune sauvegarde trouvée';
$_ADDONLANG['General']['NoFirewallRules'] = 'Aucune règle de pare-feu configurée';
$_ADDONLANG['General']['NoDataAvailable'] = 'Aucune donnée disponible';
$_ADDONLANG['General']['RefreshAll'] = 'Actualiser Tout';
$_ADDONLANG['General']['AddRule'] = 'Ajouter une Règle';
$_ADDONLANG['General']['Note'] = 'Note';
$_ADDONLANG['General']['GB'] = 'Go';
$_ADDONLANG['General']['TB'] = 'To';
$_ADDONLANG['General']['Any'] = 'Tout';
$_ADDONLANG['General']['EmptyValue'] = '-';
$_ADDONLANG['General']['Colon'] = ' : ';

## Firewall specific
$_ADDONLANG['Firewall']['CurrentRules'] = 'Règles Actuelles du Pare-feu';
$_ADDONLANG['Firewall']['ResourcesAttached'] = 'Les ressources de pare-feu sont attachées aux serveurs. Si aucun pare-feu n\'est attaché, un sera créé automatiquement lorsque vous ajouterez votre première règle.';
$_ADDONLANG['Firewall']['ChangesImmediate'] = 'Les changements du pare-feu sont appliqués immédiatement. Il n\'y a pas besoin de valider les changements.';
$_ADDONLANG['Firewall']['AddNewRule'] = 'Ajouter une Nouvelle Règle de Pare-feu';
$_ADDONLANG['Firewall']['PortPlaceholder'] = '1-65535';
$_ADDONLANG['Firewall']['SourcePlaceholder'] = '0.0.0.0/0';
$_ADDONLANG['Firewall']['DescriptionPlaceholder'] = 'Description de la règle';
$_ADDONLANG['Firewall']['Accept'] = 'ACCEPTER';
$_ADDONLANG['Firewall']['Drop'] = 'REJETER';
$_ADDONLANG['Firewall']['Info'] = 'INFO';
$_ADDONLANG['Firewall']['Any'] = 'TOUT';
$_ADDONLANG['Firewall']['TCP'] = 'TCP';
$_ADDONLANG['Firewall']['UDP'] = 'UDP';
$_ADDONLANG['Firewall']['ICMP'] = 'ICMP';

## Reinstall specific
$_ADDONLANG['Reinstall']['DestroyWarning'] = 'La reconstruction détruira toutes les données sur le serveur. Un nouveau mot de passe root sera généré et sauvegardé dans votre compte de service.';

## Additional UI messages
$_ADDONLANG['Messages']['PortRequired'] = 'Le port est requis pour les protocoles TCP/UDP';
$_ADDONLANG['Messages']['RefreshingGraphs'] = 'Actualisation de tous les graphiques...';
$_ADDONLANG['Messages']['PasswordSaveNote'] = 'Sauvegardez ce mot de passe dans un endroit sûr';
$_ADDONLANG['Messages']['SelectOSFirst'] = 'Veuillez d\'abord sélectionner un système d\'exploitation.';

## Server types
$_ADDONLANG['ServerTypes']['Standard'] = 'Standard';