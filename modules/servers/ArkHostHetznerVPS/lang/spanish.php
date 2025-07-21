<?php

# Client Area
## General
$_ADDONLANG['Title'] = 'Información del VPS';
$_ADDONLANG['IPv4'] = 'IPv4';
$_ADDONLANG['IPv6'] = 'IPv6';
$_ADDONLANG['Start'] = 'Iniciar';
$_ADDONLANG['Stop'] = 'Detener';
$_ADDONLANG['Restart'] = 'Reiniciar';
$_ADDONLANG['Shutdown'] = 'Apagar';
$_ADDONLANG['VNC'] = 'Consola VNC';
$_ADDONLANG['Delete'] = 'Eliminar';
$_ADDONLANG['Close'] = 'Cerrar';
$_ADDONLANG['Restore'] = 'Restaurar';
$_ADDONLANG['SelectISOImage'] = 'Seleccionar imagen ISO...';
$_ADDONLANG['NoISOImages'] = 'No hay imágenes ISO disponibles';
$_ADDONLANG['LoadingGraphs'] = 'Cargando gráficos de rendimiento...';
$_ADDONLANG['LoadingBackups'] = 'Cargando datos de respaldo...';
$_ADDONLANG['LoadingFirewallRules'] = 'Cargando reglas del firewall...';
$_ADDONLANG['CopyToClipboard'] = 'Copiar al portapapeles';
$_ADDONLANG['PasswordCopied'] = '¡Contraseña copiada al portapapeles!';
$_ADDONLANG['SavePassword'] = '¡Asegúrate de guardar esta contraseña!';
$_ADDONLANG['PasswordSaved'] = 'También se ha guardado en tu servicio.';
$_ADDONLANG['RescueModeEnabled'] = '¡Modo de rescate activado! Contraseña root: ';
$_ADDONLANG['NetworkError'] = 'Error de red';
$_ADDONLANG['ActionFailed'] = '¡Acción fallida!';
$_ADDONLANG['ActionSuccess'] = 'Acción completada exitosamente';

## Confirmations
$_ADDONLANG['Confirm']['Stop']['Title'] = 'Detener VPS';
$_ADDONLANG['Confirm']['Stop']['Message'] = '¿Deseas detener este VPS? Esto apagará el servidor.';
$_ADDONLANG['Confirm']['Restart']['Title'] = 'Reiniciar VPS';
$_ADDONLANG['Confirm']['Restart']['Message'] = '¿Deseas reiniciar este VPS? Esto reiniciará el servidor.';
$_ADDONLANG['Confirm']['Cancel'] = 'Cancelar';
$_ADDONLANG['Confirm']['Confirm'] = 'Confirmar';
$_ADDONLANG['Confirm']['CreateBackup']['Title'] = 'Crear Respaldo';
$_ADDONLANG['Confirm']['CreateBackup']['Message'] = '¿Deseas crear un respaldo? Esto puede tomar varios minutos.';
$_ADDONLANG['Confirm']['DeleteBackup']['Title'] = 'Eliminar Respaldo';
$_ADDONLANG['Confirm']['DeleteBackup']['Message'] = '¿Deseas eliminar este respaldo? Esta acción no se puede deshacer.';
$_ADDONLANG['Confirm']['RestoreBackup']['Title'] = 'Restaurar Respaldo';
$_ADDONLANG['Confirm']['RestoreBackup']['Message'] = '¿Deseas restaurar este respaldo? Esto sobrescribirá todos los datos actuales y no se puede deshacer.';
$_ADDONLANG['Confirm']['Shutdown']['Title'] = 'Apagar VPS';
$_ADDONLANG['Confirm']['Shutdown']['Message'] = '¿Deseas apagar este VPS de forma segura? Esto realizará un apagado limpio del servidor.';
$_ADDONLANG['Confirm']['EnableRescue']['Title'] = 'Activar Modo de Rescate';
$_ADDONLANG['Confirm']['EnableRescue']['Message'] = '¿Activar modo de rescate? El servidor debe reiniciarse manualmente dentro de 60 minutos para que esto tome efecto.';
$_ADDONLANG['Confirm']['EnableRescueReboot']['Title'] = 'Activar Modo de Rescate y Reiniciar';
$_ADDONLANG['Confirm']['EnableRescueReboot']['Message'] = '¿Activar modo de rescate y reiniciar el servidor inmediatamente?';
$_ADDONLANG['Confirm']['DisableRescue']['Title'] = 'Desactivar Modo de Rescate';
$_ADDONLANG['Confirm']['DisableRescue']['Message'] = 'Esto desactivará el modo de rescate. El servidor arrancará normalmente en el próximo reinicio. ¿Continuar?';
$_ADDONLANG['Confirm']['ResetPassword']['Title'] = 'Restablecer Contraseña Root';
$_ADDONLANG['Confirm']['ResetPassword']['Message'] = 'Esto restablecerá la contraseña root. El servidor debe estar ejecutándose y tener qemu guest agent instalado. ¿Continuar?';
$_ADDONLANG['Confirm']['DeleteFirewallRule']['Title'] = 'Eliminar Regla del Firewall';
$_ADDONLANG['Confirm']['DeleteFirewallRule']['Message'] = '¿Estás seguro de que quieres eliminar esta regla del firewall?';

## Navbar
$_ADDONLANG['Navbar']['Overview'] = 'Resumen';
$_ADDONLANG['Navbar']['Graphs'] = 'Gráficos';
$_ADDONLANG['Navbar']['Backups'] = 'Respaldos';
$_ADDONLANG['Navbar']['Settings'] = 'Configuración';

## Overview
$_ADDONLANG['Overview']['CPU'] = 'Uso de CPU';
$_ADDONLANG['Overview']['RAM'] = 'Uso de RAM';
$_ADDONLANG['Overview']['Bandwidth'] = 'Uso de Ancho de Banda';
$_ADDONLANG['Overview']['Disk'] = 'Espacio en Disco';
$_ADDONLANG['Overview']['ServerInfo'] = 'Información del Servidor';
$_ADDONLANG['Overview']['ResourceAllocation'] = 'Asignación de Recursos';
$_ADDONLANG['Overview']['QuickActions'] = 'Acciones Rápidas';
$_ADDONLANG['Overview']['Hostname'] = 'Nombre del Host';
$_ADDONLANG['Overview']['Status'] = 'Estado';
$_ADDONLANG['Overview']['OS'] = 'Sistema Operativo';
$_ADDONLANG['Overview']['Location'] = 'Ubicación';
$_ADDONLANG['Overview']['CPU_Cores'] = 'Núcleos vCPU';
$_ADDONLANG['Overview']['Memory'] = 'Memoria';
$_ADDONLANG['Overview']['Storage'] = 'Almacenamiento SSD';
$_ADDONLANG['Overview']['Traffic'] = 'Tráfico Incluido';
$_ADDONLANG['Overview']['Uptime'] = 'Tiempo de Actividad';
$_ADDONLANG['Overview']['ServerType'] = 'Tipo de Servidor';
$_ADDONLANG['Overview']['MetricsNote'] = 'Nota: La API solo proporciona métricas de CPU. Las métricas de uso de RAM y disco no están disponibles.';
$_ADDONLANG['Overview']['Allocated'] = 'Asignado';

## Graphs
$_ADDONLANG['Graphs']['Title'] = 'Métricas de Rendimiento';
$_ADDONLANG['Graphs']['CPU'] = 'Uso de CPU';
$_ADDONLANG['Graphs']['RAM'] = 'Uso de RAM';
$_ADDONLANG['Graphs']['Disk'] = 'Uso de Disco';
$_ADDONLANG['Graphs']['Network'] = 'Uso de Red';
$_ADDONLANG['Graphs']['Hour'] = 'Hora';
$_ADDONLANG['Graphs']['Day'] = 'Día';
$_ADDONLANG['Graphs']['Week'] = 'Semana';
$_ADDONLANG['Graphs']['Month'] = 'Mes';
$_ADDONLANG['Graphs']['Year'] = 'Año';
$_ADDONLANG['Graphs']['Loading'] = 'Cargando gráfico...';
$_ADDONLANG['Graphs']['SelectPeriod'] = 'Selecciona un período de tiempo para ver las métricas de rendimiento del servidor';
$_ADDONLANG['Graphs']['CPUUsage'] = 'Uso de CPU';
$_ADDONLANG['Graphs']['NetworkTraffic'] = 'Tráfico de Red';
$_ADDONLANG['Graphs']['DiskIO'] = 'E/S de Disco';
$_ADDONLANG['Graphs']['CPUUnit'] = '%';
$_ADDONLANG['Graphs']['NetworkUnit'] = 'Mbps';
$_ADDONLANG['Graphs']['DiskUnit'] = 'IOPS';
$_ADDONLANG['Graphs']['Current'] = 'Actual';
$_ADDONLANG['Graphs']['Inbound'] = 'Entrante';
$_ADDONLANG['Graphs']['Outbound'] = 'Saliente';
$_ADDONLANG['Graphs']['Read'] = 'Lectura';
$_ADDONLANG['Graphs']['Write'] = 'Escritura';

## Backups
$_ADDONLANG['Backups']['Title'] = 'Gestión de Respaldos';
$_ADDONLANG['Backups']['Description'] = 'Las fechas para las cuales hay respaldos disponibles de este VPS se listan a continuación. Puedes restaurarlos o eliminarlos según corresponda.';
$_ADDONLANG['Backups']['Warning'] = '* Ten en cuenta que los nuevos respaldos reemplazarán a los anteriores.<br/>** Los respaldos automáticos también reemplazarán tus respaldos manuales a menos que los respaldos automáticos estén desactivados.<br/>*** Los respaldos automáticos se realizan 2 veces por semana y son parte de nuestro plan de recuperación ante desastres. Si desactivas los respaldos automáticos, también desactivas cualquier posibilidad de recuperación en caso de desastre.<br/>**** El sistema de archivos del respaldo podría no estar completamente consistente si el VPS estaba escribiendo al sistema de archivos en el momento del respaldo. Para respaldos completamente consistentes, el servidor debe estar detenido mientras se crea el respaldo.';
$_ADDONLANG['Backups']['Date'] = 'Fecha';
$_ADDONLANG['Backups']['Size'] = 'Tamaño';
$_ADDONLANG['Backups']['Type'] = 'Tipo';
$_ADDONLANG['Backups']['Status'] = 'Estado';
$_ADDONLANG['Backups']['Actions'] = 'Acciones';
$_ADDONLANG['Backups']['Create'] = 'Respaldar Ahora';
$_ADDONLANG['Backups']['Available'] = 'Disponible';
$_ADDONLANG['Backups']['Creating'] = 'Creando...';
$_ADDONLANG['Backups']['Error'] = 'Error';
$_ADDONLANG['Backups']['Automatic'] = 'Automático';
$_ADDONLANG['Backups']['Manual'] = 'Manual';

## Settings
$_ADDONLANG['Settings']['Title'] = 'Menú de Configuración';
### Hostname
$_ADDONLANG['Settings']['Hostname']['Title'] = 'Nombre del Host';
$_ADDONLANG['Settings']['Hostname']['Description'] = 'Establece el nombre del host y el rDNS. Por favor, crea primero el registro A.';
$_ADDONLANG['Settings']['Hostname']['Submit'] = 'Enviar';

### ISO
$_ADDONLANG['Settings']['ISO']['Title'] = 'ISO';
$_ADDONLANG['Settings']['ISO']['Description'] = 'Si instalas el sistema operativo a través de la imagen ISO, también debes configurar la interfaz de red de forma estática. No hay servidor DHCP ejecutándose.';
$_ADDONLANG['Settings']['ISO']['Image'] = 'Imagen ISO';
$_ADDONLANG['Settings']['ISO']['Submit'] = 'Cargar ISO';
$_ADDONLANG['Settings']['ISO']['Remove'] = 'Expulsar ISO';

### Password
$_ADDONLANG['Settings']['Password']['Title'] = 'Contraseña';
$_ADDONLANG['Settings']['Password']['Description'] = 'La contraseña de instalación se elimina de nuestros sistemas después de 72 horas. ¡Es obligatorio cambiar la contraseña en tu primer inicio de sesión!';
$_ADDONLANG['Settings']['Password']['Submit'] = 'Restablecer Contraseña';

### Reinstall
$_ADDONLANG['Settings']['Reinstall']['Title'] = 'Reinstalar';
$_ADDONLANG['Settings']['Reinstall']['Description'] = '¡Por favor entiende que al reinstalar, todos los datos serán eliminados del servidor. Esta acción es irreversible!';
$_ADDONLANG['Settings']['Reinstall']['OS'] = 'Sistema Operativo';
$_ADDONLANG['Settings']['Reinstall']['Version'] = 'ELEGIR VERSIÓN';
$_ADDONLANG['Settings']['Reinstall']['Submit'] = 'Reinstalar';

### Firewall
$_ADDONLANG['Settings']['Firewall']['Title'] = 'Firewall';
$_ADDONLANG['Settings']['Firewall']['Description'] = 'Las reglas se evalúan de arriba hacia abajo. Por defecto, todo está permitido. El firewall solo está disponible en la interfaz pública. Solo el tráfico entrante será filtrado por el firewall.';
$_ADDONLANG['Settings']['Firewall']['Action'] = 'Acción';
$_ADDONLANG['Settings']['Firewall']['Port'] = 'Puerto';
$_ADDONLANG['Settings']['Firewall']['Protocol'] = 'Protocolo';
$_ADDONLANG['Settings']['Firewall']['Source'] = 'Origen';
$_ADDONLANG['Settings']['Firewall']['Note'] = 'Nota';
$_ADDONLANG['Settings']['Firewall']['Actions'] = 'Acciones';
$_ADDONLANG['Settings']['Firewall']['Accept'] = 'Aceptar';
$_ADDONLANG['Settings']['Firewall']['Drop'] = 'Descartar';
$_ADDONLANG['Settings']['Firewall']['PortNumber'] = 'Número de Puerto';
$_ADDONLANG['Settings']['Firewall']['SourceLabel'] = 'Ej: x.x.x.x/xx (opcional)';
$_ADDONLANG['Settings']['Firewall']['Notes'] = 'Notas (opcional)';
$_ADDONLANG['Settings']['Firewall']['Warning'] = 'Las reglas deben ser confirmadas para tomar efecto.';
$_ADDONLANG['Settings']['Firewall']['Submit'] = 'Confirmar Firewall';

### Rescue Mode
$_ADDONLANG['Settings']['Rescue']['Title'] = 'Modo de Rescate';
$_ADDONLANG['Settings']['Rescue']['Description'] = 'El modo de rescate arranca tu servidor en un sistema Linux temporal donde puedes acceder a los discos de tu servidor para reparar o recuperar datos.';
$_ADDONLANG['Settings']['Rescue']['Status'] = 'Estado';
$_ADDONLANG['Settings']['Rescue']['Active'] = 'Activo';
$_ADDONLANG['Settings']['Rescue']['Inactive'] = 'Inactivo';
$_ADDONLANG['Settings']['Rescue']['Enable'] = 'Activar Modo de Rescate';
$_ADDONLANG['Settings']['Rescue']['EnableReboot'] = 'Activar y Reiniciar';
$_ADDONLANG['Settings']['Rescue']['Disable'] = 'Desactivar Modo de Rescate';
$_ADDONLANG['Settings']['Rescue']['ResetRootPassword'] = 'Restablecer Contraseña Root';
$_ADDONLANG['Settings']['Rescue']['Warning'] = 'Después de activar el modo de rescate, debes reiniciar el servidor dentro de 60 minutos para que tome efecto.';
$_ADDONLANG['Settings']['Rescue']['PasswordNote'] = 'La contraseña root se mostrará una vez después de activar el modo de rescate. ¡Asegúrate de guardarla!';
$_ADDONLANG['Settings']['Rescue']['DisableTitle'] = 'Desactivar Modo de Rescate';
$_ADDONLANG['Settings']['Rescue']['DisableDescription'] = 'Si el modo de rescate está actualmente activo, puedes desactivarlo aquí. El servidor arrancará normalmente en el próximo reinicio.';
$_ADDONLANG['Settings']['Rescue']['NewRootPassword'] = 'Nueva Contraseña Root';
$_ADDONLANG['Settings']['Rescue']['AboutTitle'] = 'Acerca del Modo de Rescate';
$_ADDONLANG['Settings']['Rescue']['AboutDescription'] = 'El sistema de rescate es un entorno basado en red y puede ser usado para solucionar problemas que impiden un arranque normal. También es útil para instalar distribuciones Linux personalizadas que no ofrecemos directamente. Puedes montar el disco duro del servidor dentro del sistema de rescate.';
$_ADDONLANG['Settings']['Rescue']['Important'] = 'Importante';
$_ADDONLANG['Settings']['Rescue']['ImportantNote'] = 'Después de activar el sistema de rescate necesitas reiniciar el servidor en los próximos 60 minutos para activarlo. Después de otro reinicio tu servidor arrancará desde su disco local nuevamente.';
$_ADDONLANG['Settings']['Rescue']['EnableTitle'] = 'Activar Modo de Rescate';
$_ADDONLANG['Settings']['Rescue']['EnableDescription'] = 'Arrancar en un sistema Linux mínimo para tareas de recuperación y mantenimiento.';
$_ADDONLANG['Settings']['Rescue']['EnableRebootTitle'] = 'Activar y Reiniciar';
$_ADDONLANG['Settings']['Rescue']['EnableRebootDescription'] = 'Activar modo de rescate e inmediatamente reiniciar el servidor para activarlo.';
$_ADDONLANG['Settings']['Rescue']['PasswordPrompt'] = 'Tu nueva contraseña root es:';

# Additional strings for UI elements
$_ADDONLANG['General']['NoBackupsFound'] = 'No se encontraron respaldos';
$_ADDONLANG['General']['NoFirewallRules'] = 'No hay reglas de firewall configuradas';
$_ADDONLANG['General']['NoDataAvailable'] = 'No hay datos disponibles';
$_ADDONLANG['General']['RefreshAll'] = 'Actualizar Todo';
$_ADDONLANG['General']['AddRule'] = 'Agregar Regla';
$_ADDONLANG['General']['Note'] = 'Nota';
$_ADDONLANG['General']['GB'] = 'GB';
$_ADDONLANG['General']['TB'] = 'TB';
$_ADDONLANG['General']['Any'] = 'Cualquiera';
$_ADDONLANG['General']['EmptyValue'] = '-';
$_ADDONLANG['General']['Colon'] = ': ';

## Firewall specific
$_ADDONLANG['Firewall']['CurrentRules'] = 'Reglas Actuales del Firewall';
$_ADDONLANG['Firewall']['ResourcesAttached'] = 'Los recursos del firewall están adjuntos a los servidores. Si no hay firewall adjunto, se creará uno automáticamente cuando agregues tu primera regla.';
$_ADDONLANG['Firewall']['ChangesImmediate'] = 'Los cambios del firewall se aplican inmediatamente. No es necesario confirmar cambios.';
$_ADDONLANG['Firewall']['AddNewRule'] = 'Agregar Nueva Regla del Firewall';
$_ADDONLANG['Firewall']['PortPlaceholder'] = '1-65535';
$_ADDONLANG['Firewall']['SourcePlaceholder'] = '0.0.0.0/0';
$_ADDONLANG['Firewall']['DescriptionPlaceholder'] = 'Descripción de la regla';
$_ADDONLANG['Firewall']['Accept'] = 'ACEPTAR';
$_ADDONLANG['Firewall']['Drop'] = 'DESCARTAR';
$_ADDONLANG['Firewall']['Info'] = 'INFO';
$_ADDONLANG['Firewall']['Any'] = 'CUALQUIERA';
$_ADDONLANG['Firewall']['TCP'] = 'TCP';
$_ADDONLANG['Firewall']['UDP'] = 'UDP';
$_ADDONLANG['Firewall']['ICMP'] = 'ICMP';

## Reinstall specific
$_ADDONLANG['Reinstall']['DestroyWarning'] = 'La reinstalación destruirá todos los datos en el servidor. Se generará una nueva contraseña root y se guardará en tu cuenta de servicio.';

## Additional UI messages
$_ADDONLANG['Messages']['PortRequired'] = 'El puerto es requerido para protocolos TCP/UDP';
$_ADDONLANG['Messages']['RefreshingGraphs'] = 'Actualizando todos los gráficos...';
$_ADDONLANG['Messages']['PasswordSaveNote'] = 'Guarda esta contraseña en un lugar seguro';
$_ADDONLANG['Messages']['SelectOSFirst'] = 'Por favor selecciona primero un sistema operativo.';

## Server types
$_ADDONLANG['ServerTypes']['Standard'] = 'Estándar';