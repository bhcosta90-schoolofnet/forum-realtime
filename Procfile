release: php artisan migrate
web: vendor/bin/heroku-php-nginx -C /app/heroku/nginx.heroku.conf /public
supervisor: supervisord -c /app/heroku/supervisor.conf -n