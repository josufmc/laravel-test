let mix = require('laravel-mix');

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

mix.js('resources/assets/js/app.js', 
    'node_modules/bootstrap-sass/assets/javascripts/bootstrap.js',
    'node_modules/jquery/dist/jquery.js',
    'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css').options({
    processCssUrls: false
 });

 mix.browserSync({
     proxy: 'http://localhost/blog/public'
 });
