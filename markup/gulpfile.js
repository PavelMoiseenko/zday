'use strict';

var gulp = require('gulp'),
    watch = require('gulp-watch'),
    prefixer = require('gulp-autoprefixer'),
    uglify = require('gulp-uglify'),
    concat = require('gulp-concat'), // Concatenate files 
    sass = require('gulp-sass'),
    sourcemaps = require('gulp-sourcemaps'),
    gcmq = require('gulp-group-css-media-queries'),
    rimraf = require('rimraf'),
    plumber = require('gulp-plumber');

var path = {
    build: {
        jquery: '../wp-content/themes/z-days/assets/js/',
        js: '../wp-content/themes/z-days/assets/js/',
        css: '../wp-content/themes/z-days/assets/css/',
        img: '../wp-content/themes/z-days/assets/images/',
        fonts: '../wp-content/themes/z-days/assets/fonts/'
    },
    src: {
        jquery: 'src/js/*.js',
        js: 'src/js/partials/*.js',
        style: 'src/css/all.scss',
        img: 'src/images/**/*.*',
        fonts: 'src/fonts/**/*.*'
    },
    watch: {
        jquery: 'src/js/*.js',
        js: 'src/js/**/*.js',
        style: 'src/css/**/*.scss',
        img: 'src/images/**/*.*',
        fonts: 'src/fonts/**/*.*'
    },
    clean: './build'
};

var config = {
    server: {
        baseDir: "./build"
    },
    tunnel: true,
    host: 'localhost',
    port: 9000,
    logPrefix: "Frontend"
};

gulp.task('clean', function (cb) {
    rimraf(path.clean, cb);
});

gulp.task('jquery:build', function () {
    gulp.src([path.src.jquery])
        .pipe(gulp.dest(path.build.jquery));
});

gulp.task('js:build', function () {
    gulp.src([path.src.js])
        .pipe(plumber())
        .pipe(concat('scripts.js'))
        .pipe(uglify())
        .pipe(gulp.dest(path.build.js));
});

gulp.task('style:build', function () {
    gulp.src(path.src.style) 
        .pipe(plumber())
        .pipe(sourcemaps.init())
        .pipe(sass({
            includePaths: ['src/css/'],
            sourcemaps: true,
            errLogToConsole: true
        }))
        .pipe(prefixer({
            browsers: ['last 2 versions', 'ie 9'],
            cascade: false
        }))
        .pipe(gcmq())
        .pipe(sourcemaps.write())
        .pipe(gulp.dest(path.build.css));
});

gulp.task('image:build', function () {
    gulp.src(path.src.img) 
        .pipe(plumber())
        .pipe(gulp.dest(path.build.img));
});

gulp.task('fonts:build', function () {
    gulp.src(path.src.fonts) 
        .pipe(gulp.dest(path.build.fonts));
});

gulp.task('build', [
    'jquery:build',
    'js:build',
    'style:build',
    'image:build',
    'fonts:build'
]);

gulp.task('watch', function(){
    
    gulp.watch(path.watch.style, ['style:build']);
    gulp.watch(path.watch.img, ['image:build']);
    gulp.watch(path.watch.fonts, ['fonts:build']);
    gulp.watch(path.watch.js, ['jquery:build']); 
    gulp.watch(path.watch.js, ['js:build']);    
});

gulp.task('default', ['build', 'watch']);