const mix = require('laravel-mix');

//var path = require( 'path' );
mix.webpackConfig({
    stats: {
         children: true
    }
});

mix
    .autoload({
        jquery: ['$', 'window.jQuery', 'jQuery', 'jquery']
      })
   .js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css')
   .copyDirectory('node_modules/@fortawesome/fontawesome-free/webfonts', 'public/webfonts/')
   .options({
      processCssUrls: false,
   })
   .version()
   .browserSync('demoseb.test');
