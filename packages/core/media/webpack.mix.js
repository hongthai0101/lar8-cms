let mix = require('laravel-mix');

const path = require('path');
let directory = path.basename(path.resolve(__dirname));

const source = 'packages/core/' + directory;
const dist = 'public/vendor/core/' + directory;

const jsPath = dist + '/js';
const cssPath = dist + '/css';
//console.log(cssPath, jsPath, directory)

//mix.sass(source + '/resources/assets/sass/media.scss', cssPath);


mix
    .sass(source + '/resources/assets/sass/media.scss', cssPath)
    .js(source + '/resources/assets/js/media.js', jsPath)
    .js(source + '/resources/assets/js/jquery.addMedia.js', jsPath)
    .js(source + '/resources/assets/js/integrate.js', jsPath)
    .copyDirectory(jsPath, source + '/public/js')
    .copyDirectory(cssPath, source + '/public/css');
