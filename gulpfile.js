// プラグインのロード
var gulp   = require( 'gulp' );
var watch  = require( 'gulp-watch' );
var sass   = require( 'gulp-ruby-sass' );
var autoprefixer = require('gulp-autoprefixer');
var cmq    = require( 'gulp-combine-media-queries' );
var cssmin = require( 'gulp-minify-css' );
var shell  = require( 'gulp-shell' );
var rename = require('gulp-rename');
var browserSync = require('browser-sync');
 
// 各ディレクトリパスの設定
var dir     = {};
dir.root    = '.';
dir.wordpress = dir.root + '/www/wordpress';
dir.theme   = dir.wordpress + '/wp-content/themes/thesixthlie';
dir.mysql   = './mysql';
 
// WordPressデータベースの設定
var mysql      = {};
mysql.database = 'wordpress';
mysql.user     = 'wordpress';
mysql.password = 'wordpress';
 
// Sass の設定
// Sass で /scss/*.scss のファイルをコンパイル > Media Query の記述をまとる > minify
gulp.task( 'sass', function() {
    sass(dir.theme + '/library/scss/')
        .pipe(cmq())
        .pipe(autoprefixer(["last 2 version", "ie 8", "ie 7"]))
        .pipe(cssmin())
        .pipe(rename({suffix: '.min'}))
        .pipe(gulp.dest(dir.theme + '/library/css'))
        .pipe(browserSync.reload({stream: true}));
});

gulp.task('cssmin', function () {
    gulp.src(dir.theme + '/library/css/style.css')
        .pipe(cssmin())
        .pipe(rename({
            suffix: '.min'
        }))
        .pipe(gulp.dest(dir.theme + '/library/css/'));
});
 
// WordPress データベースのエクスポート
gulp.task( 'wp_export', shell.task(
    [
        'rm -rf ' + dir.mysql,
        'mkdir ' + dir.mysql,
        'wp db export "' + dir.mysql + '/' + mysql.database + '.sql' + '"'
    ],
    {
        cwd : dir.wordpress
    }
) );

// browserSyncでvagrantの仮想サーバ経由するためプロキシ設定
gulp.task('browser-sync', function () {
    browserSync({
        proxy: "thesixthlie.dev"
    });
});

// php用にreload明示
gulp.task('bs-reload', function () {
    browserSync.reload();
});

// /scss/*.scss を監視し、変更があったら Sass タスクを実行
gulp.task('watch', ['browser-sync', 'sass'], function () {
    gulp.watch(dir.theme + '/library/scss/**/*.scss', ['sass']);
    gulp.watch(dir.theme + '/library/js/*.js', ['bs-reload']);
    gulp.watch(dir.theme + '/*.php', ['bs-reload']);
});

gulp.task('watch-sass', ['sass'], function () {
    gulp.watch(dir.theme + '/library/scss/**/*.scss', ['sass', 'cssmin']);
});
