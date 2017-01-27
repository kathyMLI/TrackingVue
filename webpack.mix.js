const { mix } = require('laravel-mix');

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

mix.js('resources/assets/js/admin/app.js', 'public/js/admin.js')
   .sass('resources/assets/sass/admin.scss', 'public/css/admin.css');

mix.js('resources/assets/js/public/app.js', 'public/js/public.js')
    .sass('resources/assets/sass/public.scss', 'public/css/public.css');
