# Установка и запуск виртуалки на Docker

`composer install`  
`sudo apt-get docker.io install`  
`docker-compose up` - в интерактивном режиме  
`docker-compose up -d` - в фоновом режиме

Также нужно запросить `.env` файл, в котором указаны основные настройки для Docker'а.

[Установка для Windows и MacOS](https://docs.docker.com/compose/install/#install-compose) (см. вкладки Windows/MacOS на странице по ссылке)   

# БД
Дамп базы данных лежит в папке `etc/database/dump.sql`, автоматически разворачивается внутри docker-контейнера (`docker-compose build`).

# Структура папок
Сделана такой, чтобы сохранить совместимость с docker-образа с боевым сервером.

Используются следующие сопоставления:
 - `app/templates -> www/bitrix/templates`
 - `app/components -> www/bitrix/components/interlabs`
 - `app/php_interface -> www/public/bitrix/php_interface`

На все страницы проекта используется единый шаблон `default`: `app/templates/default` (`bitrix/templates/default)`.

В проекте используется специализированная библиотека для работы с API Bitrix, которая находится внутри Docker-образа (`www/birixadapter` на боевом), она вынесена за пределы git (спорное решение).  
Для следования стандартам, для вспомогательных классов была сделана PSR-4 папка src, а так же подключен composer (см. `composer.json`).

Внутри docker-образа производятся следующие сопоставления конфигурационных файлов:
 - `etc/bitrix/dbconn.php -> bitrix/php_interface/dbconn.php`
 - `etc/bitrix/after_connect.php -> bitrix/php_interface/after_connect.php`
 - `etc/bitrix/after_connect_d7.php -> bitrix/php_interface/after_connect_d7.php`
 - `etc/bitrix/.settings.php -> bitrix/.settings.php`
 
На боевом сервере эти файлы заменены symlink-ами. Они находятся вне git'а, поэтому при выливке на боевой остаются неизменными.  
TODO: поменять цели symlink-ов на боевом, чтобы соответствовали docker-у, при этом нужно будет добавить переменные окружения в конфигурацию nginx боевого сервера, т.к. новые конфигурационные файлы берут данные из переменных окружения.