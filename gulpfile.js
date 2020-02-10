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

var options = {
  "host": "54.91.145.149",
  "port": 22,
  //"package_json_file_path": "package.json",
  "source_files": ".",
  "remote_directory": "/home/ec2-user/wp_sync",
  "username": "ec2-user",
  "ssh_key_file": "d:/Sudip_AWS_New.ppk",
  /*"releases_to_keep": 3,
  "group": "remote-group",
  "permissions": "ugo+rX",
  "package_task": "someTask"*/
};

// prompt for SSH credentials
gulp.task('login:production', deploy.login('54.91.145.149'))

// deploy files to SSH host
// IMPORTANT: Don't forget to add login task as dependency
gulp.task('deploy:production', ['login:production'], function () {
    return gulp.src('d:/wordpress/**/*').pipe(deploy['54.91.145.149'].dest('/home/ec2-user/wp_sync'))
})

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