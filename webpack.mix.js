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

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/custom.scss', 'public/css')
    .sass('resources/sass/exportPDF.scss', 'public/css')
    .sass('resources/sass/bootstrapmin.scss', 'public/css');

mix.js('resources/js/users.js', 'public/js');
mix.js('resources/js/jquery.min.js', 'public/js');