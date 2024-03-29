let mix = require('laravel-mix');
let path = require('path');

mix.setResourceRoot('../');
mix.setPublicPath(path.resolve('./'));

mix.webpackConfig({
  watchOptions: {
    ignored: [
      path.posix.resolve(__dirname, './node_modules'),
      path.posix.resolve(__dirname, './css'),
      path.posix.resolve(__dirname, './js'),
    ],
  },
});

//mix.js('assets/src/js/app.js', 'assets/js');

//mix.postCss('assets/src/css/app.css', 'assets/css');

mix.sass('assets/scss/main.scss', 'assets/css');

mix.browserSync({
  proxy: 'http://motobatt.local',
  host: 'motobatt.local',
  open: 'external',
  port: 8000,
});

if (mix.inProduction()) {
  mix.version();
} else {
  mix.options({ manifest: false });
}
