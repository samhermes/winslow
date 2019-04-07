'use strict';

var gulp = require('gulp'),
  sass = require('gulp-sass'),
  sourcemaps = require('gulp-sourcemaps'),
  livereload = require('gulp-livereload'),
  merge = require('merge-stream');

gulp.task('sass', function () {
  var styleSass = gulp.src('./sass/style.scss')
    .pipe(sourcemaps.init())
    .pipe(sass({ outputStyle: 'compressed' }).on('error', sass.logError))
    .pipe(sourcemaps.write('./'))
    .pipe(gulp.dest('./'))
    .pipe(livereload());
  var editorSass = gulp.src('./sass/editor-style.scss')
    .pipe(sourcemaps.init())
    .pipe(sass({ outputStyle: 'compressed' }).on('error', sass.logError))
    .pipe(sourcemaps.write('./'))
    .pipe(gulp.dest('./'))
    .pipe(livereload());
  var blockEditorSass = gulp.src('./sass/block-editor-style.scss')
    .pipe(sourcemaps.init())
    .pipe(sass({ outputStyle: 'compressed' }).on('error', sass.logError))
    .pipe(sourcemaps.write('./'))
    .pipe(gulp.dest('./'))
    .pipe(livereload());
  return merge(styleSass, editorSass, blockEditorSass);
});

gulp.task('watch', function () {
  livereload.listen();
  gulp.watch('./sass/**/*.scss', ['sass']);
  gulp.watch('**/*.php', livereload.reload);
});

gulp.task('default', ['sass', 'watch']);