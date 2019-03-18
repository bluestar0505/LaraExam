const elixir = require('laravel-elixir');


elixir(function(mix) {

    mix
        .sass('app.scss', './public/css/app.css')
        .sass('main.scss', './public/css/main.css')

});
