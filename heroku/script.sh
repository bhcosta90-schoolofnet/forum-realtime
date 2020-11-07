#/bin/bash

if [ "$APP_ENV" != "production" ]
then
    composer install;
    php artisan test;
fi

php artisan migrate