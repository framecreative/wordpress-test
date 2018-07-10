/* global process */

const fs            = require('fs');
const runSequence   = require('run-sequence');
const gulp          = require('gulp');
const notifier      = require('node-notifier');
const browserSync   = require('browser-sync').create();
const sourcemaps    = require('gulp-sourcemaps');
const sass          = require('gulp-sass');
const gutil         = require('gulp-util');
const postcss       = require('gulp-postcss');
const autoprefixer  = require('autoprefixer');
const cssnano       = require('cssnano');
const webpackStream = require('webpack-stream-fixed');
const webpack       = require('webpack');
const named         = require('vinyl-named-with-path');
const webpackConfig = require('./webpack.config.js');
const npmConfig     = JSON.parse(fs.readFileSync('./package.json')).config;

const dupeFiles     = [
    `${npmConfig.assetSource}**/*`, `!${npmConfig.assetSource}{styles,scripts,icons,vendor,fonts}{,/**/*}`
];


// Output any errors but keep on running
const handleError = function(err) {

    notifier.notify({
        'title': 'Gulp Error',
        'message': err.plugin.toString()
    });

    gutil.log( gutil.colors.red( err.toString() ) );
    this.emit('end');

};


/* DUPE */

gulp.task( 'dupe', function(){

    return gulp.src( dupeFiles, { base: npmConfig.assetSource } )
        .pipe( gulp.dest( npmConfig.assetDist ) );

} );


/* STYLES */

gulp.task( 'styles', function() {

    return gulp.src( `${npmConfig.assetSource}styles/*.scss`, { base: npmConfig.assetSource } )
        .pipe( sourcemaps.init() )
        .pipe( sass({
            includePaths: ['node_modules', 'bower_components']
        }).on('error', handleError) )
        .pipe( postcss([
            autoprefixer({ browsers: ['iOS >= 7', 'ie >= 9'] }),
            cssnano({ safe: true })
        ]) )
        .pipe( gulp.dest( npmConfig.assetDist ) )
        .pipe( browserSync.stream({match: '**/*.css'}) );

});


/* SCRIPTS */

gulp.task( 'scripts', function() {

    return gulp.src( `${npmConfig.assetSource}scripts/*.js`, { base: npmConfig.assetSource } )
        .pipe( named() )
        .pipe( webpackStream( webpackConfig, webpack ).on('error', handleError) )
        .pipe( gulp.dest( npmConfig.assetDist ) )
        .pipe( browserSync.stream({match: '**/*.js'}) );

});


/* Browsersync */

gulp.task( 'browsersync', function() {

    return browserSync.init({
        proxy: npmConfig.siteUrl,
        files: [ `${npmConfig.themeFolder}/**/*.php` ],
        snippetOptions: {
            whitelist: [ '/wordpress/wp-admin/admin-ajax.php', '/**/?wc-ajax=*' ],
            blacklist: [ '/wordpress/**']
        },
        notify: false,
        open: false
    });

});


/* CLEAN */

gulp.task('clean', require('del').bind(null, [npmConfig.assetDist]));


/* BUILD */

gulp.task( 'build', function( cb ) {

    runSequence( 'clean', 'scripts', 'styles', 'dupe', cb );

});



/* WATCHER */

gulp.task( 'watch', ['build'], function(cb){

    webpackConfig.watch = true;
    gulp.start('scripts');

    gulp.watch( [ dupeFiles ], ['dupe'] );
    gulp.watch( [ `${npmConfig.assetSource}/styles/**/*.scss` ], ['styles'] );

    return cb();
});



/* DEFAULT */

gulp.task( 'default', [ 'browsersync', 'watch' ] );
