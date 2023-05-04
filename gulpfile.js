/* ESLINT config: */
/* global require exports */
const { src, dest, watch, parallel } = require( 'gulp' ),
	sass = require( 'gulp-sass' )( require( 'sass' ) ),
	postcss = require( 'gulp-postcss' ),
	cssnano = require( 'cssnano' ),
	sourcemaps = require( 'gulp-sourcemaps' ),
	autoprefixer = require( 'autoprefixer' ),
	babel = require( 'gulp-babel' ),
	concat = require( 'gulp-concat' ),
	uglify = require( 'gulp-uglify' ),
	livereload = require( 'gulp-livereload' );

const postcssPlugins = [
	autoprefixer(),
	cssnano('default')
];

function css() {
	return src( 'src/scss/**/*.scss' )
		.pipe( sourcemaps.init() )
		.pipe( sass( { outputStyle: 'compressed' } ).on( 'error', sass.logError ) )
		.pipe( postcss( postcssPlugins ) )
		.pipe( sourcemaps.write( '/maps' ) )
		.pipe( dest( 'css/' ) )
		.pipe( livereload() );
}

function js() {
	return src( [ 'src/js/*.js' ] )
		.pipe( sourcemaps.init() )
		.pipe( babel( {
			presets: [ '@babel/env' ],
		} ) )
		.pipe( concat( 'scripts.min.js' ) )
		.pipe( uglify() )
		.pipe( sourcemaps.write( '/maps' ) )
		.pipe( dest( 'js' ) );
}

function editorJs() {
	return src( [ 'src/js/editor/*.js' ] )
		.pipe( sourcemaps.init() )
		.pipe( babel( {
			presets: [ '@babel/env' ],
		} ) )
		.pipe( concat( 'editor.min.js' ) )
		.pipe( uglify() )
		.pipe( sourcemaps.write( '/maps' ) )
		.pipe( dest( 'js' ) );
}

function gulpWatch() {
	livereload.listen();
	watch( 'src/scss/**/*.scss', css );
	watch( 'src/js/*.js', js );
	watch( 'src/js/editor/*.js', editorJs );
}

exports.js = js;
exports.editorJs = editorJs;
exports.css = css;
exports.gulpWatch = gulpWatch;
exports.compile = parallel( css, js, editorJs );
exports.default = parallel( css, js, editorJs, gulpWatch );
