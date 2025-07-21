<?php

# Client Area
## General
$_ADDONLANG['Title'] = 'Информация VPS';
$_ADDONLANG['IPv4'] = 'IPv4';
$_ADDONLANG['IPv6'] = 'IPv6';
$_ADDONLANG['Start'] = 'Запустить';
$_ADDONLANG['Stop'] = 'Остановить';
$_ADDONLANG['Restart'] = 'Перезапустить';
$_ADDONLANG['Shutdown'] = 'Выключить';
$_ADDONLANG['VNC'] = 'VNC Консоль';
$_ADDONLANG['Delete'] = 'Удалить';
$_ADDONLANG['Close'] = 'Закрыть';
$_ADDONLANG['Restore'] = 'Восстановить';
$_ADDONLANG['SelectISOImage'] = 'Выберите ISO образ...';
$_ADDONLANG['NoISOImages'] = 'ISO образы недоступны';
$_ADDONLANG['LoadingGraphs'] = 'Загрузка графиков производительности...';
$_ADDONLANG['LoadingBackups'] = 'Загрузка данных резервных копий...';
$_ADDONLANG['LoadingFirewallRules'] = 'Загрузка правил файервола...';
$_ADDONLANG['CopyToClipboard'] = 'Копировать в буфер обмена';
$_ADDONLANG['PasswordCopied'] = 'Пароль скопирован в буфер обмена!';
$_ADDONLANG['SavePassword'] = 'Обязательно сохраните этот пароль!';
$_ADDONLANG['PasswordSaved'] = 'Он также был сохранен в вашем сервисе.';
$_ADDONLANG['RescueModeEnabled'] = 'Режим восстановления активирован! Root пароль: ';
$_ADDONLANG['NetworkError'] = 'Сетевая ошибка';
$_ADDONLANG['ActionFailed'] = 'Действие не выполнено!';
$_ADDONLANG['ActionSuccess'] = 'Действие успешно завершено';

## Confirmations
$_ADDONLANG['Confirm']['Stop']['Title'] = 'Остановить VPS';
$_ADDONLANG['Confirm']['Stop']['Message'] = 'Вы хотите остановить этот VPS? Это выключит сервер.';
$_ADDONLANG['Confirm']['Restart']['Title'] = 'Перезапустить VPS';
$_ADDONLANG['Confirm']['Restart']['Message'] = 'Вы хотите перезапустить этот VPS? Это перезагрузит сервер.';
$_ADDONLANG['Confirm']['Cancel'] = 'Отменить';
$_ADDONLANG['Confirm']['Confirm'] = 'Подтвердить';
$_ADDONLANG['Confirm']['CreateBackup']['Title'] = 'Создать резервную копию';
$_ADDONLANG['Confirm']['CreateBackup']['Message'] = 'Вы хотите создать резервную копию? Это может занять несколько минут.';
$_ADDONLANG['Confirm']['DeleteBackup']['Title'] = 'Удалить резервную копию';
$_ADDONLANG['Confirm']['DeleteBackup']['Message'] = 'Вы хотите удалить эту резервную копию? Это действие нельзя отменить.';
$_ADDONLANG['Confirm']['RestoreBackup']['Title'] = 'Восстановить резервную копию';
$_ADDONLANG['Confirm']['RestoreBackup']['Message'] = 'Вы хотите восстановить эту резервную копию? Это перезапишет все текущие данные и не может быть отменено.';
$_ADDONLANG['Confirm']['Shutdown']['Title'] = 'Выключить VPS';
$_ADDONLANG['Confirm']['Shutdown']['Message'] = 'Вы хотите корректно выключить этот VPS? Это выполнит чистое выключение сервера.';
$_ADDONLANG['Confirm']['EnableRescue']['Title'] = 'Включить режим восстановления';
$_ADDONLANG['Confirm']['EnableRescue']['Message'] = 'Включить режим восстановления? Сервер должен быть перезапущен вручную в течение 60 минут, чтобы это вступило в силу.';
$_ADDONLANG['Confirm']['EnableRescueReboot']['Title'] = 'Включить режим восстановления и перезагрузить';
$_ADDONLANG['Confirm']['EnableRescueReboot']['Message'] = 'Включить режим восстановления и немедленно перезагрузить сервер?';
$_ADDONLANG['Confirm']['DisableRescue']['Title'] = 'Отключить режим восстановления';
$_ADDONLANG['Confirm']['DisableRescue']['Message'] = 'Это отключит режим восстановления. Сервер будет загружаться нормально при следующей перезагрузке. Продолжить?';
$_ADDONLANG['Confirm']['ResetPassword']['Title'] = 'Сбросить root пароль';
$_ADDONLANG['Confirm']['ResetPassword']['Message'] = 'Это сбросит root пароль. Сервер должен быть запущен и иметь установленный qemu guest agent. Продолжить?';
$_ADDONLANG['Confirm']['DeleteFirewallRule']['Title'] = 'Удалить правило файервола';
$_ADDONLANG['Confirm']['DeleteFirewallRule']['Message'] = 'Вы уверены, что хотите удалить это правило файервола?';

## Navbar
$_ADDONLANG['Navbar']['Overview'] = 'Обзор';
$_ADDONLANG['Navbar']['Graphs'] = 'Графики';
$_ADDONLANG['Navbar']['Backups'] = 'Резервные копии';
$_ADDONLANG['Navbar']['Settings'] = 'Настройки';

## Overview
$_ADDONLANG['Overview']['CPU'] = 'Использование CPU';
$_ADDONLANG['Overview']['RAM'] = 'Использование RAM';
$_ADDONLANG['Overview']['Bandwidth'] = 'Использование пропускной способности';
$_ADDONLANG['Overview']['Disk'] = 'Дисковое пространство';
$_ADDONLANG['Overview']['ServerInfo'] = 'Информация о сервере';
$_ADDONLANG['Overview']['ResourceAllocation'] = 'Распределение ресурсов';
$_ADDONLANG['Overview']['QuickActions'] = 'Быстрые действия';
$_ADDONLANG['Overview']['Hostname'] = 'Имя хоста';
$_ADDONLANG['Overview']['Status'] = 'Статус';
$_ADDONLANG['Overview']['OS'] = 'Операционная система';
$_ADDONLANG['Overview']['Location'] = 'Местоположение';
$_ADDONLANG['Overview']['CPU_Cores'] = 'Ядра vCPU';
$_ADDONLANG['Overview']['Memory'] = 'Память';
$_ADDONLANG['Overview']['Storage'] = 'SSD хранилище';
$_ADDONLANG['Overview']['Traffic'] = 'Включенный трафик';
$_ADDONLANG['Overview']['Uptime'] = 'Время работы';
$_ADDONLANG['Overview']['ServerType'] = 'Тип сервера';
$_ADDONLANG['Overview']['MetricsNote'] = 'Примечание: API предоставляет только метрики CPU. Метрики использования RAM и диска недоступны.';
$_ADDONLANG['Overview']['Allocated'] = 'Выделено';

## Graphs
$_ADDONLANG['Graphs']['Title'] = 'Метрики производительности';
$_ADDONLANG['Graphs']['CPU'] = 'Использование CPU';
$_ADDONLANG['Graphs']['RAM'] = 'Использование RAM';
$_ADDONLANG['Graphs']['Disk'] = 'Использование диска';
$_ADDONLANG['Graphs']['Network'] = 'Использование сети';
$_ADDONLANG['Graphs']['Hour'] = 'Час';
$_ADDONLANG['Graphs']['Day'] = 'День';
$_ADDONLANG['Graphs']['Week'] = 'Неделя';
$_ADDONLANG['Graphs']['Month'] = 'Месяц';
$_ADDONLANG['Graphs']['Year'] = 'Год';
$_ADDONLANG['Graphs']['Loading'] = 'Загрузка графика...';
$_ADDONLANG['Graphs']['SelectPeriod'] = 'Выберите период времени для просмотра метрик производительности сервера';
$_ADDONLANG['Graphs']['CPUUsage'] = 'Использование CPU';
$_ADDONLANG['Graphs']['NetworkTraffic'] = 'Сетевой трафик';
$_ADDONLANG['Graphs']['DiskIO'] = 'Дисковый ввод/вывод';
$_ADDONLANG['Graphs']['CPUUnit'] = '%';
$_ADDONLANG['Graphs']['NetworkUnit'] = 'Мбит/с';
$_ADDONLANG['Graphs']['DiskUnit'] = 'IOPS';
$_ADDONLANG['Graphs']['Current'] = 'Текущий';
$_ADDONLANG['Graphs']['Inbound'] = 'Входящий';
$_ADDONLANG['Graphs']['Outbound'] = 'Исходящий';
$_ADDONLANG['Graphs']['Read'] = 'Чтение';
$_ADDONLANG['Graphs']['Write'] = 'Запись';

## Backups
$_ADDONLANG['Backups']['Title'] = 'Управление резервными копиями';
$_ADDONLANG['Backups']['Description'] = 'Даты, для которых доступны резервные копии этого VPS, перечислены ниже. Вы можете их восстановить или удалить соответственно.';
$_ADDONLANG['Backups']['Warning'] = '* Пожалуйста, имейте в виду, что новые резервные копии заменят старые.<br/>** Автоматические резервные копии также заменят ваши ручные резервные копии, если автоматические резервные копии не отключены.<br/>*** Автоматические резервные копии создаются 2 раза в неделю и являются частью нашего плана аварийного восстановления. Если вы отключите автоматические резервные копии, вы также отключите любую возможность восстановления в случае катастрофы.<br/>**** Файловая система резервной копии может быть не полностью согласованной, если VPS записывал в файловую систему в момент создания резервной копии. Для полностью согласованных резервных копий сервер должен быть остановлен во время создания резервной копии.';
$_ADDONLANG['Backups']['Date'] = 'Дата';
$_ADDONLANG['Backups']['Size'] = 'Размер';
$_ADDONLANG['Backups']['Type'] = 'Тип';
$_ADDONLANG['Backups']['Status'] = 'Статус';
$_ADDONLANG['Backups']['Actions'] = 'Действия';
$_ADDONLANG['Backups']['Create'] = 'Создать сейчас';
$_ADDONLANG['Backups']['Available'] = 'Доступно';
$_ADDONLANG['Backups']['Creating'] = 'Создается...';
$_ADDONLANG['Backups']['Error'] = 'Ошибка';
$_ADDONLANG['Backups']['Automatic'] = 'Автоматический';
$_ADDONLANG['Backups']['Manual'] = 'Ручной';

## Settings
$_ADDONLANG['Settings']['Title'] = 'Меню настроек';
### Hostname
$_ADDONLANG['Settings']['Hostname']['Title'] = 'Имя хоста';
$_ADDONLANG['Settings']['Hostname']['Description'] = 'Устанавливает имя хоста и обратную DNS запись. Сначала создайте A запись.';
$_ADDONLANG['Settings']['Hostname']['Submit'] = 'Отправить';

### ISO
$_ADDONLANG['Settings']['ISO']['Title'] = 'ISO';
$_ADDONLANG['Settings']['ISO']['Description'] = 'Если вы устанавливаете операционную систему через ISO образ, вы также должны статически настроить сетевой интерфейс. DHCP сервер не запущен.';
$_ADDONLANG['Settings']['ISO']['Image'] = 'ISO образ';
$_ADDONLANG['Settings']['ISO']['Submit'] = 'Загрузить ISO';
$_ADDONLANG['Settings']['ISO']['Remove'] = 'Извлечь ISO';

### Password
$_ADDONLANG['Settings']['Password']['Title'] = 'Пароль';
$_ADDONLANG['Settings']['Password']['Description'] = 'Пароль установки удаляется из наших систем через 72 часа. Обязательно измените пароль при первом входе!';
$_ADDONLANG['Settings']['Password']['Submit'] = 'Сбросить пароль';

### Reinstall
$_ADDONLANG['Settings']['Reinstall']['Title'] = 'Переустановка';
$_ADDONLANG['Settings']['Reinstall']['Description'] = 'Пожалуйста, поймите, что при переустановке все данные будут стерты с сервера. Это действие необратимо!';
$_ADDONLANG['Settings']['Reinstall']['OS'] = 'Операционная система';
$_ADDONLANG['Settings']['Reinstall']['Version'] = 'ВЫБЕРИТЕ ВЕРСИЮ';
$_ADDONLANG['Settings']['Reinstall']['Submit'] = 'Переустановить';

### Firewall
$_ADDONLANG['Settings']['Firewall']['Title'] = 'Файервол';
$_ADDONLANG['Settings']['Firewall']['Description'] = 'Правила оцениваются сверху вниз. По умолчанию все разрешено. Файервол доступен только на публичном интерфейсе. Файервол фильтрует только входящий трафик.';
$_ADDONLANG['Settings']['Firewall']['Action'] = 'Действие';
$_ADDONLANG['Settings']['Firewall']['Port'] = 'Порт';
$_ADDONLANG['Settings']['Firewall']['Protocol'] = 'Протокол';
$_ADDONLANG['Settings']['Firewall']['Source'] = 'Источник';
$_ADDONLANG['Settings']['Firewall']['Note'] = 'Примечание';
$_ADDONLANG['Settings']['Firewall']['Actions'] = 'Действия';
$_ADDONLANG['Settings']['Firewall']['Accept'] = 'Принять';
$_ADDONLANG['Settings']['Firewall']['Drop'] = 'Отбросить';
$_ADDONLANG['Settings']['Firewall']['PortNumber'] = 'Номер порта';
$_ADDONLANG['Settings']['Firewall']['SourceLabel'] = 'Например: x.x.x.x/xx (опционально)';
$_ADDONLANG['Settings']['Firewall']['Notes'] = 'Примечания (опционально)';
$_ADDONLANG['Settings']['Firewall']['Warning'] = 'Правила должны быть применены, чтобы вступить в силу.';
$_ADDONLANG['Settings']['Firewall']['Submit'] = 'Применить файервол';

### Rescue Mode
$_ADDONLANG['Settings']['Rescue']['Title'] = 'Режим восстановления';
$_ADDONLANG['Settings']['Rescue']['Description'] = 'Режим восстановления загружает ваш сервер во временную Linux систему, где вы можете получить доступ к дискам вашего сервера для восстановления или ремонта данных.';
$_ADDONLANG['Settings']['Rescue']['Status'] = 'Статус';
$_ADDONLANG['Settings']['Rescue']['Active'] = 'Активен';
$_ADDONLANG['Settings']['Rescue']['Inactive'] = 'Неактивен';
$_ADDONLANG['Settings']['Rescue']['Enable'] = 'Включить режим восстановления';
$_ADDONLANG['Settings']['Rescue']['EnableReboot'] = 'Включить и перезагрузить';
$_ADDONLANG['Settings']['Rescue']['Disable'] = 'Отключить режим восстановления';
$_ADDONLANG['Settings']['Rescue']['ResetRootPassword'] = 'Сбросить root пароль';
$_ADDONLANG['Settings']['Rescue']['Warning'] = 'После включения режима восстановления вы должны перезагрузить сервер в течение 60 минут, чтобы он вступил в силу.';
$_ADDONLANG['Settings']['Rescue']['PasswordNote'] = 'Root пароль будет показан один раз после включения режима восстановления. Обязательно сохраните его!';
$_ADDONLANG['Settings']['Rescue']['DisableTitle'] = 'Отключить режим восстановления';
$_ADDONLANG['Settings']['Rescue']['DisableDescription'] = 'Если режим восстановления в настоящее время активен, вы можете отключить его здесь. Сервер будет загружаться нормально при следующей перезагрузке.';
$_ADDONLANG['Settings']['Rescue']['NewRootPassword'] = 'Новый root пароль';
$_ADDONLANG['Settings']['Rescue']['AboutTitle'] = 'О режиме восстановления';
$_ADDONLANG['Settings']['Rescue']['AboutDescription'] = 'Система восстановления - это сетевая среда, которая может использоваться для решения проблем, препятствующих нормальной загрузке. Она также полезна для установки пользовательских дистрибутивов Linux, которые мы не предлагаем напрямую. Вы можете смонтировать жесткий диск сервера внутри системы восстановления.';
$_ADDONLANG['Settings']['Rescue']['Important'] = 'Важно';
$_ADDONLANG['Settings']['Rescue']['ImportantNote'] = 'После включения системы восстановления вы должны перезагрузить сервер в течение следующих 60 минут, чтобы активировать её. После ещё одной перезагрузки ваш сервер снова будет загружаться с локального диска.';
$_ADDONLANG['Settings']['Rescue']['EnableTitle'] = 'Включить режим восстановления';
$_ADDONLANG['Settings']['Rescue']['EnableDescription'] = 'Загрузиться в минимальную Linux систему для задач восстановления и обслуживания.';
$_ADDONLANG['Settings']['Rescue']['EnableRebootTitle'] = 'Включить и перезагрузить';
$_ADDONLANG['Settings']['Rescue']['EnableRebootDescription'] = 'Включить режим восстановления и немедленно перезагрузить сервер для его активации.';
$_ADDONLANG['Settings']['Rescue']['PasswordPrompt'] = 'Ваш новый root пароль:';

# Additional strings for UI elements
$_ADDONLANG['General']['NoBackupsFound'] = 'Резервные копии не найдены';
$_ADDONLANG['General']['NoFirewallRules'] = 'Правила файервола не настроены';
$_ADDONLANG['General']['NoDataAvailable'] = 'Данные недоступны';
$_ADDONLANG['General']['RefreshAll'] = 'Обновить всё';
$_ADDONLANG['General']['AddRule'] = 'Добавить правило';
$_ADDONLANG['General']['Note'] = 'Примечание';
$_ADDONLANG['General']['GB'] = 'ГБ';
$_ADDONLANG['General']['TB'] = 'ТБ';
$_ADDONLANG['General']['Any'] = 'Любой';
$_ADDONLANG['General']['EmptyValue'] = '-';
$_ADDONLANG['General']['Colon'] = ': ';

## Firewall specific
$_ADDONLANG['Firewall']['CurrentRules'] = 'Текущие правила файервола';
$_ADDONLANG['Firewall']['ResourcesAttached'] = 'Ресурсы файервола прикреплены к серверам. Если файервол не прикреплен, он будет создан автоматически, когда вы добавите первое правило.';
$_ADDONLANG['Firewall']['ChangesImmediate'] = 'Изменения файервола применяются немедленно. Нет необходимости подтверждать изменения.';
$_ADDONLANG['Firewall']['AddNewRule'] = 'Добавить новое правило файервола';
$_ADDONLANG['Firewall']['PortPlaceholder'] = '1-65535';
$_ADDONLANG['Firewall']['SourcePlaceholder'] = '0.0.0.0/0';
$_ADDONLANG['Firewall']['DescriptionPlaceholder'] = 'Описание правила';
$_ADDONLANG['Firewall']['Accept'] = 'ПРИНЯТЬ';
$_ADDONLANG['Firewall']['Drop'] = 'ОТБРОСИТЬ';
$_ADDONLANG['Firewall']['Info'] = 'ИНФО';
$_ADDONLANG['Firewall']['Any'] = 'ЛЮБОЙ';
$_ADDONLANG['Firewall']['TCP'] = 'TCP';
$_ADDONLANG['Firewall']['UDP'] = 'UDP';
$_ADDONLANG['Firewall']['ICMP'] = 'ICMP';

## Reinstall specific
$_ADDONLANG['Reinstall']['DestroyWarning'] = 'Перестроение уничтожит все данные на сервере. Новый root пароль будет сгенерирован и сохранен в вашей учетной записи службы.';

## Additional UI messages
$_ADDONLANG['Messages']['PortRequired'] = 'Порт обязателен для протоколов TCP/UDP';
$_ADDONLANG['Messages']['RefreshingGraphs'] = 'Обновление всех графиков...';
$_ADDONLANG['Messages']['PasswordSaveNote'] = 'Сохраните этот пароль в безопасном месте';
$_ADDONLANG['Messages']['SelectOSFirst'] = 'Пожалуйста, сначала выберите операционную систему.';

## Server types
$_ADDONLANG['ServerTypes']['Standard'] = 'Стандартный';