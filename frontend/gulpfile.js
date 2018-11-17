const gulp = require('gulp'),
      sass = require('gulp-sass'),
      autoprefixer = require('gulp-autoprefixer')
      wait = require('gulp-wait')
      stripCssComments = require('gulp-strip-css-comments')
      cssmin = require('gulp-cssmin')
      rename = require('gulp-rename')
      imagemin = require('gulp-imagemin');


gulp.task('sass', () => {
    gulp.src('./scss/*.scss')
        .pipe(autoprefixer({
            browsers: ['last 2 versions'],
            cascade: false
        }))
        //.pipe(wait(500))
        .pipe(sass({
            includePaths: [
              './scss'
            ]
        }).on('err', sass.logError))
        .pipe(cssmin())
        //.pipe(rename({ suffix: '.min' }))
        .pipe(stripCssComments())
        .pipe(gulp.dest('C:/wamp/www/playsport/public/css'));
        //.pipe(gulp.dest('./css'));
});

gulp.task('opt', ()=>{
    gulp.src('./img/*')
        .pipe(imagemin())
        .pipe(gulp.dest('img/home/'));
});

gulp.task('watch', ['sass'], () => {
    gulp.watch(["./scss/**/*.scss"], ['sass']);
});