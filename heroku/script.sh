#/bin/bash

if [ "$APP_ENV" != "production" ]
then
    composer install;
    php artisan test;
    php artisan migrate:fresh --seed
    composer install --no-dev;
fi