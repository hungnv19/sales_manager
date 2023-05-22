const mix = require('laravel-mix');



mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .vue({
        version: 3,
    })
    .postCss('resources/css/app.css', 'public/css', [
        //
    ]);
