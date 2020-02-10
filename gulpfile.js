var gulp = require('gulp'),
settings = require('./settings'),
webpack = require('webpack'),
browserSync = require('browser-sync').create(),
postcss = require('gulp-postcss'),
rgba = require('postcss-hexrgba'),
autoprefixer = require('autoprefixer'),
cssvars = require('postcss-simple-vars'),
nested = require('postcss-nested'),
cssImport = require('postcss-import'),
mixins = require('postcss-mixins'),
colorFunctions = require('postcss-color-function');
const sass = require('gulp-sass');
const del = require('del');
var GulpSSHDeploy = require('gulp-ssh-deploy');

/*gulp.task('styles', function() {
  return gulp.src(settings.themeLocation + 'css/style.css')
    .pipe(postcss([cssImport, mixins, cssvars, nested, rgba, colorFunctions, autoprefixer]))
    .on('error', (error) => console.log(error.toString()))
    .pipe(gulp.dest(settings.themeLocation));
});*/

gulp.task('scripts', function(callback) {
  webpack(require('./webpack.config.js'), function(err, stats) {
    if (err) {
      console.log(err.toString());
    }

    console.log(stats.toString());
    callback();
  });
});


/*gulp.task('connect', function(callback) {
  connect.server({
    name: 'Dev App',
    //root: ['app', 'tmp'],
    port: 8080,
    livereload: true
  });
});
*/

gulp.task('styles', () => {
    return gulp.src(settings.themeLocation + 'sass/**/*.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(gulp.dest(settings.themeLocation + 'css/'));
});

gulp.task('clean', () => {
    return del([
        settings.themeLocation + 'css/main.css',
    ]);
});

gulp.task('watch', function() {	
	
  browserSync.init({
    notify: false,
    proxy: settings.urlToPreview,
    ghostMode: false,
	/*server: {
            baseDir: "./wordpress"
        }*/
	//server: './wordpress'
  });

  gulp.watch('./**/*.php', function() {
    browserSync.reload();
  });
  gulp.watch(settings.themeLocation + 'sass/**/*.scss', (done) => {
        gulp.series(['clean', 'styles'])(done);
    });
  //gulp.watch(settings.themeLocation + 'css/**/*.css', gulp.parallel('waitForStyles'));
  //gulp.watch(settings.themeLocation + 'css/**/*.css', gulp.parallel('waitForStyles'));
  gulp.watch([settings.themeLocation + 'js/modules/*.js', settings.themeLocation + 'js/scripts.js'], gulp.parallel('waitForScripts'));
});

gulp.task('waitForStyles', gulp.series('styles', function() {
  return gulp.src(settings.themeLocation + 'style.css')
    .pipe(browserSync.stream());
}))

gulp.task('waitForScripts', gulp.series('scripts', function(cb) {
  browserSync.reload();
  cb()
}))