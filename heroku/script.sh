#/bin/bash

if [ "$APP_ENV" != "production" ]
then
    composer install;
    php artisan test;
    composer install --no-dev;
fi
php artisan migrate:fresh --seed