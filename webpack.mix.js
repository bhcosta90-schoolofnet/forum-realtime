const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.version()
    .js('resources/js/bootstrap.js', 'public/js/bootstrap.js')
    .js('resources/js/threads/app.js', 'public/js/threads.js')
    .js('resources/js/replies/app.js', 'public/js/replies.js')
    .sass('resources/sass/app.scss', 'public/css')
    .extract(['vue']);
