'use strict';

const gulp    = require('gulp')
const less    = require('gulp-less')
const util    = require('gulp-util')
const watch   = require('gulp-watch')
const minify  = require('gulp-minify-css')
const rename  = require('gulp-rename')
const srcmaps = require('gulp-sourcemaps')

function compileLess () {
  gulp.src('./src/less/index.less')
    .pipe(less())
    .pipe(gulp.dest('./assets/css'));

  gulp.src('./src/less/index.less')
    .pipe(srcmaps.init())
    .pipe(less())
    .pipe(minify())
    .pipe(rename({ extname: '.min.css' }))
    .pipe(srcmaps.write('.'))
    .pipe(gulp.dest('./assets/css'));
}

function watchLess () {
  gulp.watch('./src/less/**/*.less', ['compile-less'])
}

gulp.task('compile-less', compileLess);
gulp.task('watch-less', watchLess);
gulp.task('default', ['compile-less', 'watch-less']);
