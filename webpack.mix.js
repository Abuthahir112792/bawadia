const mix = require('laravel-mix');

mix.webpackConfig({
   watchOptions: {
     ignored: /node_modules/
   }
 })

mix.js('resources/js/app.js', 'public/js')
   .extract(['vue','vuetify','vue-moment','vue-json-csv','vue2-google-maps','vue-i18n'])
   //  .sourceMaps()
   .version();
   // .sass('resources/sass/app.scss', 'public/css');
