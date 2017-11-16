const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

var assetsPath = 'public/assets/';

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application as well as publishing vendor resources.
 |
 */

elixir(function (mix) {
    // Sass files
    mix.sass('frontend/frontend.scss', assetsPath + 'css/');
    mix.sass('backend/backend.scss', assetsPath + 'css/');
    mix.sass('../talvbansal/media-manager/css/media-manager.css', assetsPath + 'css/');

});
