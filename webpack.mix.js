const mix = require('laravel-mix');

mix.copy('resources/js/jquery-3.2.1.min.js', './public/js');
mix.copy('resources/css/style.css', './public/css');
mix.copy('resources/css/media.css', './public/css');



mix.js('resources/js/app.js', 'js')
.vue()
.stylus('resources/styl/main.styl', 'css')
.options({
    processCssUrls: false
});