#!/bin/sh

cd /var/www
doppler secrets download --no-file --format env > .env

php artisan migrate -n
php artisan cache:clear -n
php artisan route:cache -n
php artisan db:seed -n

/usr/bin/supervisord -c /etc/supervisord.conf
