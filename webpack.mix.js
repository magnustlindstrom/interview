const mix = require('laravel-mix');
require('laravel-mix-tailwind');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */
const path = require('path');
require('laravel-vue-i18n/mix');

mix.alias(
    {
        '@': 'resources/js/',
    }
)
    .sass('resources/css/app.scss', 'public/css')
    .sass('resources/css/teacher-content.scss', 'public/css')
    .js('resources/js/app.js', 'public/js')
    .js('resources/js/app-global.js', 'public/js')
    .js('resources/js/teacher-content.js', 'public/js')
    .js('resources/js/front.js', 'public/js')
    .vue()
    .i18n('resources/lang')
    .tailwind()
    .version()
    .sourceMaps(
        !mix.inProduction()
    );
