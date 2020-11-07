#/bin/bash

composer install;
php artisan test;
composer install --no-dev;
php artisan migrate:fresh