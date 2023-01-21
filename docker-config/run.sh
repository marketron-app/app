#!/bin/sh

cd /var/www

php artisan migrate -n --force
php artisan cache:clear -n
php artisan route:cache -n
php artisan db:seed -n

/usr/bin/supervisord -c /etc/supervisord.conf
