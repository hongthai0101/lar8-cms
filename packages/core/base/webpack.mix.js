let mix = require('laravel-mix');

const path = require('path');
let directory = path.basename(path.resolve(__dirname));

const source = 'packages/core/' + directory;
const dist = 'public/vendor/core/' + directory;
const cssPath = dist + '/css';

mix
    .sass(source + '/resources/assets/sass/app.scss', cssPath)
    .sass(source + '/resources/assets/sass/style/gallery.scss', cssPath)
    .js(source + '/resources/assets/js/app.js', dist + '/js/app.js')
    .js(source + '/resources/assets/js/auth.js', dist + '/js/auth.js')
    .js(source + '/resources/assets/js/editor.js', dist + '/js/editor.js')
    .js(source + '/resources/assets/js//admin/gallery.js', dist + '/js/gallery.js')
    .copyDirectory(dist + '/js', source + '/public/js')
    .copyDirectory(cssPath, source + '/public/css');
