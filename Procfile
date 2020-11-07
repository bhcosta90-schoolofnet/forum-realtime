release: ./heroku/script.sh
web: vendor/bin/heroku-php-nginx -C heroku/nginx.heroku.conf /public
supervisor: supervisord -c heroku/supervisor.conf -n