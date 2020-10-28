const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .copy('resources/sass/images', 'public/images');

//admin
mix.js('resources/js/admin/admin.js', 'public/admin')
mix.js('resources/js/admin/student.js', 'public/admin')
    .js('resources/js/admin/lophoc.js', 'public/admin')
    .js('resources/js/admin/bomon.js', 'public/admin')
    .js('resources/js/admin/monhoc.js', 'public/admin')
    .js('resources/js/admin/giaovien.js', 'public/admin')
    .js('resources/js/admin/chucvu.js', 'public/admin')
    .js('resources/js/admin/hephai.js', 'public/admin')
    .js('resources/js/admin/phong.js', 'public/admin')
    .js('resources/js/admin/hanhkiem.js', 'public/admin')
    .js('resources/js/admin/kyluat.js', 'public/admin')
    .js('resources/js/admin/khamsuckhoe.js', 'public/admin')
    .js('resources/js/admin/tinhtrangnghien.js', 'public/admin')
    .js('resources/js/admin/diengiai-taichinh.js', 'public/admin')
    .js('resources/js/admin/thoikhoabieu.js', 'public/admin')
    .js('resources/js/admin/lydo.js', 'public/admin')
    .js('resources/js/admin/nhom.js', 'public/admin')
    .js('resources/js/admin/nhomcha.js', 'public/admin')
    .js('resources/js/admin/sukien.js', 'public/admin')
    .js('resources/js/admin/vephep.js', 'public/admin')
    .js('resources/js/admin/huongnghiep.js', 'public/admin')
    .js('resources/js/admin/manage.js', 'public/admin')
    .js('resources/js/admin/report.js', 'public/admin')
    .js('resources/js/nguoibaoho/diemdanh.js', 'public/client_assets/js')