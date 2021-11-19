const { src, dest, watch, parallel } = require('gulp'),
	sass = require('gulp-sass'),
	postcss = require('gulp-postcss'),
	sourcemaps = require('gulp-sourcemaps'),
	autoprefixer = require('autoprefixer'),
	babel = require('gulp-babel'),
	concat = require('gulp-concat'),
	uglify = require('gulp-uglify'),
	livereload = require('gulp-livereload');

function css() {
	return src('src/scss/**/*.scss')
		.pipe(sourcemaps.init())
		.pipe(sass({outputStyle:'compressed'}).on('error', sass.logError))
		.pipe(postcss([autoprefixer()]))
		.pipe(sourcemaps.write('/maps'))
		.pipe(dest('css'))
		.pipe(livereload());
}

function js() {
	return src(['src/js/*.js'])
		.pipe(sourcemaps.init())
		.pipe(babel({
			presets: ['@babel/env']
		}))
		.pipe(concat('client-scripts.min.js'))
		.pipe(uglify())
		.pipe(sourcemaps.write('/maps'))
		.pipe(dest('js'));
}

function editorJs() {
	return src(['src/js/editor/*.js'])
		.pipe(sourcemaps.init())
		.pipe(babel({
			presets: ['@babel/env','@babel/preset-react']
		}))
		.pipe(concat('client-editor.min.js'))
		.pipe(uglify())
		.pipe(sourcemaps.write('/maps'))
		.pipe(dest('js'));
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
exports.default = parallel( css, js, editorJs, gulpWatch );
