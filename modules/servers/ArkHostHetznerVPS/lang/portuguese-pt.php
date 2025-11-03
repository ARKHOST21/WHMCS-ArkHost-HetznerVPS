<?php

# Client Area
## General
$_ADDONLANG['Title'] = 'Informações VPS';
$_ADDONLANG['IPv4'] = 'IPv4';
$_ADDONLANG['IPv6'] = 'IPv6';
$_ADDONLANG['Start'] = 'Iniciar';
$_ADDONLANG['Stop'] = 'Parar';
$_ADDONLANG['Restart'] = 'Reiniciar';
$_ADDONLANG['Shutdown'] = 'Desligar';
$_ADDONLANG['VNC'] = 'Consola VNC';
$_ADDONLANG['Delete'] = 'Eliminar';
$_ADDONLANG['Close'] = 'Fechar';
$_ADDONLANG['Restore'] = 'Restaurar';
$_ADDONLANG['SelectISOImage'] = 'Seleccionar Imagem ISO...';
$_ADDONLANG['NoISOImages'] = 'Nenhuma imagem ISO disponível';
$_ADDONLANG['LoadingGraphs'] = 'A carregar gráficos de performance...';
$_ADDONLANG['LoadingBackups'] = 'A carregar dados de cópias de segurança...';
$_ADDONLANG['LoadingFirewallRules'] = 'A carregar regras de firewall...';
$_ADDONLANG['CopyToClipboard'] = 'Copiar para área de transferência';
$_ADDONLANG['PasswordCopied'] = 'Palavra-passe copiada para área de transferência!';
$_ADDONLANG['SavePassword'] = 'Certifique-se de guardar esta palavra-passe!';
$_ADDONLANG['PasswordSaved'] = 'Também foi guardada no seu serviço.';
$_ADDONLANG['RescueModeEnabled'] = 'Modo de recuperação activado! Palavra-passe root: ';
$_ADDONLANG['NetworkError'] = 'Erro de rede';
$_ADDONLANG['ActionFailed'] = 'Acção falhada!';
$_ADDONLANG['ActionSuccess'] = 'Acção concluída com sucesso';

## Confirmations
$_ADDONLANG['Confirm']['Stop']['Title'] = 'Parar VPS';
$_ADDONLANG['Confirm']['Stop']['Message'] = 'Deseja parar este VPS? Isto irá desligar o servidor.';
$_ADDONLANG['Confirm']['Restart']['Title'] = 'Reiniciar VPS';
$_ADDONLANG['Confirm']['Restart']['Message'] = 'Deseja reiniciar este VPS? Isto irá reiniciar o servidor.';
$_ADDONLANG['Confirm']['Cancel'] = 'Cancelar';
$_ADDONLANG['Confirm']['Confirm'] = 'Confirmar';
$_ADDONLANG['Confirm']['CreateBackup']['Title'] = 'Criar Cópia de Segurança';
$_ADDONLANG['Confirm']['CreateBackup']['Message'] = 'Deseja criar uma cópia de segurança? Isto pode demorar vários minutos.';
$_ADDONLANG['Confirm']['DeleteBackup']['Title'] = 'Eliminar Cópia de Segurança';
$_ADDONLANG['Confirm']['DeleteBackup']['Message'] = 'Deseja eliminar esta cópia de segurança? Esta acção não pode ser anulada.';
$_ADDONLANG['Confirm']['RestoreBackup']['Title'] = 'Restaurar Cópia de Segurança';
$_ADDONLANG['Confirm']['RestoreBackup']['Message'] = 'Deseja restaurar esta cópia de segurança? Isto irá sobrescrever todos os dados actuais e não pode ser anulado.';
$_ADDONLANG['Confirm']['Shutdown']['Title'] = 'Desligar VPS';
$_ADDONLANG['Confirm']['Shutdown']['Message'] = 'Deseja desligar graciosamente este VPS? Isto irá realizar um encerramento limpo do servidor.';
$_ADDONLANG['Confirm']['EnableRescue']['Title'] = 'Activar Modo de Recuperação';
$_ADDONLANG['Confirm']['EnableRescue']['Message'] = 'Activar modo de recuperação? O servidor deve ser reiniciado manualmente dentro de 60 minutos para que isto faça efeito.';
$_ADDONLANG['Confirm']['EnableRescueReboot']['Title'] = 'Activar Modo de Recuperação e Reiniciar';
$_ADDONLANG['Confirm']['EnableRescueReboot']['Message'] = 'Activar modo de recuperação e reiniciar o servidor imediatamente?';
$_ADDONLANG['Confirm']['DisableRescue']['Title'] = 'Desactivar Modo de Recuperação';
$_ADDONLANG['Confirm']['DisableRescue']['Message'] = 'Isto irá desactivar o modo de recuperação. O servidor irá iniciar normalmente no próximo reinício. Continuar?';
$_ADDONLANG['Confirm']['ResetPassword']['Title'] = 'Redefinir Palavra-passe Root';
$_ADDONLANG['Confirm']['ResetPassword']['Message'] = 'Isto irá redefinir a palavra-passe root. O servidor deve estar em execução e ter o agente convidado qemu instalado. Continuar?';
$_ADDONLANG['Confirm']['DeleteFirewallRule']['Title'] = 'Eliminar Regra de Firewall';
$_ADDONLANG['Confirm']['DeleteFirewallRule']['Message'] = 'Tem a certeza de que deseja eliminar esta regra de firewall?';

## Navbar
$_ADDONLANG['Navbar']['Overview'] = 'Visão Geral';
$_ADDONLANG['Navbar']['Graphs'] = 'Gráficos';
$_ADDONLANG['Navbar']['Backups'] = 'Cópias de Segurança';
$_ADDONLANG['Navbar']['Settings'] = 'Definições';

## Overview
$_ADDONLANG['Overview']['CPU'] = 'Uso CPU';
$_ADDONLANG['Overview']['RAM'] = 'Uso RAM';
$_ADDONLANG['Overview']['Bandwidth'] = 'Uso Largura de Banda';
$_ADDONLANG['Overview']['Disk'] = 'Espaço em Disco';
$_ADDONLANG['Overview']['ServerInfo'] = 'Informações do Servidor';
$_ADDONLANG['Overview']['ResourceAllocation'] = 'Alocação de Recursos';
$_ADDONLANG['Overview']['QuickActions'] = 'Acções Rápidas';
$_ADDONLANG['Overview']['Hostname'] = 'Nome do Host';
$_ADDONLANG['Overview']['Status'] = 'Estado';
$_ADDONLANG['Overview']['OS'] = 'Sistema Operativo';
$_ADDONLANG['Overview']['Location'] = 'Localização';
$_ADDONLANG['Overview']['CPU_Cores'] = 'Núcleos vCPU';
$_ADDONLANG['Overview']['Memory'] = 'Memória';
$_ADDONLANG['Overview']['Storage'] = 'Armazenamento SSD';
$_ADDONLANG['Overview']['Traffic'] = 'Tráfego Incluído';
$_ADDONLANG['Overview']['Uptime'] = 'Tempo de Actividade';
$_ADDONLANG['Overview']['ServerType'] = 'Tipo de Servidor';
$_ADDONLANG['Overview']['MetricsNote'] = 'Nota: A API fornece apenas métricas CPU. Métricas de uso RAM e disco não estão disponíveis.';
$_ADDONLANG['Overview']['Allocated'] = 'Alocado';

## Graphs
$_ADDONLANG['Graphs']['Title'] = 'Métricas de Performance';
$_ADDONLANG['Graphs']['CPU'] = 'Uso CPU';
$_ADDONLANG['Graphs']['RAM'] = 'Uso RAM';
$_ADDONLANG['Graphs']['Disk'] = 'Uso Disco';
$_ADDONLANG['Graphs']['Network'] = 'Uso Rede';
$_ADDONLANG['Graphs']['Hour'] = 'Hora';
$_ADDONLANG['Graphs']['Day'] = 'Dia';
$_ADDONLANG['Graphs']['Week'] = 'Semana';
$_ADDONLANG['Graphs']['Month'] = 'Mês';
$_ADDONLANG['Graphs']['Year'] = 'Ano';
$_ADDONLANG['Graphs']['Loading'] = 'A carregar gráfico...';
$_ADDONLANG['Graphs']['SelectPeriod'] = 'Seleccione um período de tempo para ver as métricas de performance do servidor';
$_ADDONLANG['Graphs']['CPUUsage'] = 'Uso CPU';
$_ADDONLANG['Graphs']['NetworkTraffic'] = 'Tráfego de Rede';
$_ADDONLANG['Graphs']['DiskIO'] = 'E/S Disco';
$_ADDONLANG['Graphs']['CPUUnit'] = '%';
$_ADDONLANG['Graphs']['NetworkUnit'] = 'Mbps';
$_ADDONLANG['Graphs']['DiskUnit'] = 'IOPS';
$_ADDONLANG['Graphs']['Current'] = 'Actual';
$_ADDONLANG['Graphs']['Inbound'] = 'Entrada';
$_ADDONLANG['Graphs']['Outbound'] = 'Saída';
$_ADDONLANG['Graphs']['Read'] = 'Leitura';
$_ADDONLANG['Graphs']['Write'] = 'Escrita';

## Backups
$_ADDONLANG['Backups']['Title'] = 'Gestão de Cópias de Segurança';
$_ADDONLANG['Backups']['Description'] = 'As datas para as quais estão disponíveis cópias de segurança deste VPS estão listadas abaixo. Pode restaurá-las ou eliminá-las em conformidade.';
$_ADDONLANG['Backups']['Warning'] = 'Para cada servidor, existem sete slots para Cópias de Segurança. Se todos os slots estiverem cheios, a Cópia de Segurança mais antiga será eliminada.';
$_ADDONLANG['Backups']['Date'] = 'Data';
$_ADDONLANG['Backups']['Size'] = 'Tamanho';
$_ADDONLANG['Backups']['Type'] = 'Tipo';
$_ADDONLANG['Backups']['Status'] = 'Estado';
$_ADDONLANG['Backups']['Actions'] = 'Acções';
$_ADDONLANG['Backups']['Create'] = 'Cópia Agora';
$_ADDONLANG['Backups']['Available'] = 'Disponível';
$_ADDONLANG['Backups']['Creating'] = 'A criar...';
$_ADDONLANG['Backups']['Error'] = 'Erro';
$_ADDONLANG['Backups']['Automatic'] = 'Automático';
$_ADDONLANG['Backups']['Manual'] = 'Manual';

## Settings
$_ADDONLANG['Settings']['Title'] = 'Menu Definições';
### Hostname
$_ADDONLANG['Settings']['Hostname']['Title'] = 'Nome do Host';
$_ADDONLANG['Settings']['Hostname']['Description'] = 'Define o nome do host e o rDNS. Crie primeiro o registo A.';
$_ADDONLANG['Settings']['Hostname']['Submit'] = 'Submeter';

### ISO
$_ADDONLANG['Settings']['ISO']['Title'] = 'ISO';
$_ADDONLANG['Settings']['ISO']['Description'] = 'Se instalar o sistema operativo através da imagem ISO, deve também configurar a interface de rede estaticamente. Não há servidor DHCP em execução.';
$_ADDONLANG['Settings']['ISO']['Image'] = 'Imagem ISO';
$_ADDONLANG['Settings']['ISO']['Submit'] = 'Carregar ISO';
$_ADDONLANG['Settings']['ISO']['Remove'] = 'Ejectar ISO';

### Password
$_ADDONLANG['Settings']['Password']['Title'] = 'Palavra-passe';
$_ADDONLANG['Settings']['Password']['Description'] = 'A palavra-passe de instalação é removida dos nossos sistemas após 72 horas. É obrigatório alterar a palavra-passe no seu primeiro login!';
$_ADDONLANG['Settings']['Password']['Submit'] = 'Redefinir Palavra-passe';

### Reinstall
$_ADDONLANG['Settings']['Reinstall']['Title'] = 'Reinstalar';
$_ADDONLANG['Settings']['Reinstall']['Description'] = 'Por favor, entenda que ao reinstalar, todos os dados serão apagados do servidor. Esta acção é irreversível!';
$_ADDONLANG['Settings']['Reinstall']['OS'] = 'Sistema Operativo';
$_ADDONLANG['Settings']['Reinstall']['Version'] = 'ESCOLHER VERSÃO';
$_ADDONLANG['Settings']['Reinstall']['Submit'] = 'Reinstalar';

### Firewall
$_ADDONLANG['Settings']['Firewall']['Title'] = 'Firewall';
$_ADDONLANG['Settings']['Firewall']['Action'] = 'Acção';
$_ADDONLANG['Settings']['Firewall']['Port'] = 'Porto';
$_ADDONLANG['Settings']['Firewall']['Protocol'] = 'Protocolo';
$_ADDONLANG['Settings']['Firewall']['Accept'] = 'Aceitar';
$_ADDONLANG['Settings']['Firewall']['Drop'] = 'Descartar';

### Rescue Mode
$_ADDONLANG['Settings']['Rescue']['Title'] = 'Modo de Recuperação';
$_ADDONLANG['Settings']['Rescue']['Description'] = 'O modo de recuperação inicia o seu servidor num sistema Linux temporário onde pode aceder aos discos do seu servidor para reparar ou recuperar dados.';
$_ADDONLANG['Settings']['Rescue']['Status'] = 'Estado';
$_ADDONLANG['Settings']['Rescue']['Active'] = 'Activo';
$_ADDONLANG['Settings']['Rescue']['Inactive'] = 'Inactivo';
$_ADDONLANG['Settings']['Rescue']['Enable'] = 'Activar Modo de Recuperação';
$_ADDONLANG['Settings']['Rescue']['EnableReboot'] = 'Activar e Reiniciar';
$_ADDONLANG['Settings']['Rescue']['Disable'] = 'Desactivar Modo de Recuperação';
$_ADDONLANG['Settings']['Rescue']['ResetRootPassword'] = 'Redefinir Palavra-passe Root';
$_ADDONLANG['Settings']['Rescue']['Warning'] = 'Após activar o modo de recuperação, deve reiniciar o servidor dentro de 60 minutos para que faça efeito.';
$_ADDONLANG['Settings']['Rescue']['PasswordNote'] = 'A palavra-passe root será exibida uma vez após activar o modo de recuperação. Certifique-se de a guardar!';
$_ADDONLANG['Settings']['Rescue']['DisableTitle'] = 'Desactivar Modo de Recuperação';
$_ADDONLANG['Settings']['Rescue']['DisableDescription'] = 'Se o modo de recuperação estiver actualmente activo, pode desactivá-lo aqui. O servidor inicializará normalmente no próximo reinício.';
$_ADDONLANG['Settings']['Rescue']['NewRootPassword'] = 'Nova Palavra-passe Root';
$_ADDONLANG['Settings']['Rescue']['AboutTitle'] = 'Acerca do Modo de Recuperação';
$_ADDONLANG['Settings']['Rescue']['AboutDescription'] = 'O sistema de recuperação é um ambiente baseado em rede e pode ser usado para corrigir problemas que impedem um arranque regular. Também é útil para instalar distribuições Linux personalizadas que não são oferecidas directamente por nós. Pode montar o disco rígido do servidor dentro do sistema de recuperação.';
$_ADDONLANG['Settings']['Rescue']['Important'] = 'Importante';
$_ADDONLANG['Settings']['Rescue']['ImportantNote'] = 'Após activar o sistema de recuperação, deve reiniciar o servidor nos próximos 60 minutos para o activar. Após outro reinício, o seu servidor inicializará novamente a partir do seu disco local.';
$_ADDONLANG['Settings']['Rescue']['EnableTitle'] = 'Activar Modo de Recuperação';
$_ADDONLANG['Settings']['Rescue']['EnableDescription'] = 'Inicializar num sistema Linux minimal para tarefas de recuperação e manutenção.';
$_ADDONLANG['Settings']['Rescue']['EnableRebootTitle'] = 'Activar e Reiniciar';
$_ADDONLANG['Settings']['Rescue']['EnableRebootDescription'] = 'Activar modo de recuperação e reiniciar imediatamente o servidor para o activar.';
$_ADDONLANG['Settings']['Rescue']['PasswordPrompt'] = 'A sua nova palavra-passe root é:';

### Floating IP
$_ADDONLANG['Settings']['FloatingIP']['Title'] = 'IP Flutuante';
$_ADDONLANG['Settings']['FloatingIP']['Description'] = 'Gerir IPs flutuantes atribuídos a este servidor. Os IPs flutuantes podem ser movidos entre servidores.';
$_ADDONLANG['Settings']['FloatingIP']['Status'] = 'Estado';
$_ADDONLANG['Settings']['FloatingIP']['IP'] = 'Endereço IP';
$_ADDONLANG['Settings']['FloatingIP']['Type'] = 'Tipo';
$_ADDONLANG['Settings']['FloatingIP']['None'] = 'Nenhum IP flutuante atribuído';
$_ADDONLANG['Settings']['FloatingIP']['NotAvailable'] = 'IP flutuante não disponível para este serviço';
$_ADDONLANG['Settings']['FloatingIP']['Assigned'] = 'Atribuído';
$_ADDONLANG['Settings']['FloatingIP']['Unassigned'] = 'Não atribuído';
$_ADDONLANG['Settings']['FloatingIP']['Assign'] = 'Atribuir ao Servidor';
$_ADDONLANG['Settings']['FloatingIP']['Unassign'] = 'Desatribuir do Servidor';
$_ADDONLANG['Settings']['FloatingIP']['ReverseDNS'] = 'DNS Reverso';
$_ADDONLANG['Settings']['FloatingIP']['ReverseDNSDescription'] = 'Definir DNS reverso (registo PTR) para este IP flutuante';
$_ADDONLANG['Settings']['FloatingIP']['SetReverseDNS'] = 'Definir DNS Reverso';
$_ADDONLANG['Settings']['FloatingIP']['ReverseDNSPlaceholder'] = 'exemplo.com';

# Additional strings for UI elements
$_ADDONLANG['General']['NoBackupsFound'] = 'Nenhuma cópia de segurança encontrada';
$_ADDONLANG['General']['NoFirewallRules'] = 'Nenhuma regra de firewall configurada';
$_ADDONLANG['General']['NoDataAvailable'] = 'Nenhum dado disponível';
$_ADDONLANG['General']['RefreshAll'] = 'Actualizar Tudo';
$_ADDONLANG['General']['AddRule'] = 'Adicionar Regra';
$_ADDONLANG['General']['Note'] = 'Nota';
$_ADDONLANG['General']['GB'] = 'GB';
$_ADDONLANG['General']['TB'] = 'TB';
$_ADDONLANG['General']['Any'] = 'Qualquer';
$_ADDONLANG['General']['EmptyValue'] = '-';
$_ADDONLANG['General']['Colon'] = ': ';

## Firewall specific
$_ADDONLANG['Firewall']['CurrentRules'] = 'Regras de Firewall Actuais';
$_ADDONLANG['Firewall']['ResourcesAttached'] = 'Os recursos de firewall estão anexados aos servidores. Se nenhuma firewall estiver anexada, uma será criada automaticamente quando adicionar a sua primeira regra.';
$_ADDONLANG['Firewall']['Direction'] = 'Direção';
$_ADDONLANG['Firewall']['Action'] = 'Ação';
$_ADDONLANG['Firewall']['Protocol'] = 'Protocolo';
$_ADDONLANG['Firewall']['Port'] = 'Porta';
$_ADDONLANG['Firewall']['IPCIDR'] = 'IP/CIDR';
$_ADDONLANG['Firewall']['Remove'] = 'Remover';
$_ADDONLANG['Firewall']['ChangesImmediate'] = 'As alterações da firewall são aplicadas imediatamente. Não há necessidade de confirmar alterações.';
$_ADDONLANG['Firewall']['AddNewRule'] = 'Adicionar Nova Regra de Firewall';
$_ADDONLANG['Firewall']['PortPlaceholder'] = '1-65535';
$_ADDONLANG['Firewall']['SourcePlaceholder'] = '0.0.0.0/0';
$_ADDONLANG['Firewall']['Accept'] = 'ACEITAR';
$_ADDONLANG['Firewall']['Drop'] = 'DESCARTAR';
$_ADDONLANG['Firewall']['Info'] = 'INFO';
$_ADDONLANG['Firewall']['Any'] = 'QUALQUER';
$_ADDONLANG['Firewall']['TCP'] = 'TCP';
$_ADDONLANG['Firewall']['UDP'] = 'UDP';
$_ADDONLANG['Firewall']['ICMP'] = 'ICMP';
$_ADDONLANG['Firewall']['Incoming'] = 'Entrada';
$_ADDONLANG['Firewall']['Outgoing'] = 'Saída';
$_ADDONLANG['Settings']['Firewall']['Direction'] = 'Direção';

## Reinstall specific
$_ADDONLANG['Reinstall']['DestroyWarning'] = 'A reconstrução irá destruir todos os dados no servidor. Uma nova palavra-passe root será gerada e guardada na sua conta de serviço.';

## Additional UI messages
$_ADDONLANG['Messages']['PortRequired'] = 'Porto é obrigatório para protocolos TCP/UDP';
$_ADDONLANG['Messages']['RefreshingGraphs'] = 'A actualizar todos os gráficos...';
$_ADDONLANG['Messages']['PasswordSaveNote'] = 'Guarde esta palavra-passe num local seguro';
$_ADDONLANG['Messages']['SelectOSFirst'] = 'Por favor, seleccione primeiro um sistema operativo.';

## Server types
$_ADDONLANG['ServerTypes']['Standard'] = 'Padrão';
