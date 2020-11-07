release: php vendor/bin/phpunit
web: vendor/bin/heroku-php-nginx -C nginx.heroku.conf /public
worker: php artisan queue:listen --tries=10 --delay=20