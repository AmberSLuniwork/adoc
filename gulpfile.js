var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.sass('app.scss');
    mix.scripts(['../../../vendor/bower_components/modernizr/modernizr.js',
                 '../../../vendor/bower_components/fastclick/lib/fastclick.js',
                 '../../../vendor/bower_components/jquery/dist/jquery.js',
                 '../../../vendor/bower_components/jquery-placeholder/jquery.placeholder.js',
                 '../../../vendor/bower_components/jquery.cookie/jquery.cookie.js',
                 '../../../vendor/bower_components/foundation/js/foundation.js',
                 'jquery_autocomplete.js',
                 'post_link.js',
                 'confirm_form.js']);
});
