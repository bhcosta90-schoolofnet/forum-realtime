#/bin/bash

composer install;
vendor/bin/phpunit
composer install --no-dev;
php artisan migrate:fresh