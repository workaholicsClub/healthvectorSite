FROM busybox

RUN mkdir -p /var/www/lib/bitrix/
RUN mkdir -p /var/www/lib/bitrixadapter/
RUN mkdir -p /var/www/var/upload/

COPY data/bitrix /var/www/lib/bitrix
COPY data/bitrixadapter /var/www/lib/bitrixadapter
COPY data/upload /var/www/var/upload

COPY data/p3p.xml /var/www/lib/bitrix/p3p.xml
COPY data/license_key.php /var/www/lib/bitrix/license_key.php
