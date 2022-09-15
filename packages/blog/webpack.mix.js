let mix = require('laravel-mix');

const path = require('path');
let directory = path.basename(path.resolve(__dirname));

const source = 'packages/' + directory;
const dist = 'public/vendor/' + directory;
const cssPath = dist + '/css';

mix
    .sass(source + '/resources/assets/sass/blog.scss', cssPath)
    .copyDirectory(cssPath, source + '/public/css');
