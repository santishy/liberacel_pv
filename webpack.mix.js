const mix = require('laravel-mix');
const tailwindcss = require('tailwindcss');
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


mix.js('resources/js/app.js', 'public/js').vue()
    .postCss('resources/css/app.css', 'public/css', [
        require('tailwindcss'),
        tailwindcss('./tailwind.config.js')
    ]).version()
    mix.browserSync('bazar.test');// uso esta configuración para que funcione con herd

    //uso esta configuración para que funcione con laravel sail
// mix.browserSync({
//     proxy: 'localhost',
//     host: '127.0.0.1',
//     port: 8083,
//     open: false,
//     browser: 'Google chrome',
//     ghostMode: false,
//     online: true,
//     watch: true,
// });
