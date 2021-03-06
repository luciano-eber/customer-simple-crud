const mix = require('laravel-mix');

const path = require('path');

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

mix.js('resources/js/app.js', 'public/js')
    .vue({
        extractStyles: true,
        globalStyles: path.resolve('resources/scss/globals.scss')
    })
    .alias({
        '@': 'resources/js',
    });

mix.sass('resources/scss/app.scss', 'public/css');

mix.browserSync({
    proxy: 'http://127.0.0.1:8000/',
    open: false,
});

if (mix.inProduction()) {
    mix.version();
}