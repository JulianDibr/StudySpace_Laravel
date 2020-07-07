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
mix.copy('node_modules/@fortawesome/fontawesome-free/webfonts', 'public/webfonts');

mix.js([
    'resources/js/app.js',
    'resources/js/common.js',
    'resources/js/posting.js',
    'resources/js/profile.js',
    'resources/js/friendlist.js',
    'resources/js/courses.js',
    'resources/js/group.js',
    'resources/js/project.js',
    'resources/js/messages.js',
], 'public/js').sourceMaps();

mix.sass('resources/sass/app.scss', 'public/css');
mix.sass('resources/sass/dashboard.scss', 'public/css')

mix.browserSync('localhost');
