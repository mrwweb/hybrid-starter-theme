<?php
/**
 * _mrw functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package _mrw
 */

namespace _MRW\Theme;

add_action( 'after_setup_theme', __NAMESPACE__ . '\setup' );
/**
 * Configure theme supports
 */
function setup() {

	add_theme_support( 'title-tag' );

	add_theme_support( 'post-thumbnails' );

	add_editor_style( 'assets/css/classic-editor-styles.css' );

	register_nav_menus(
		[
			'menu-1' => esc_html__( 'Primary', '_mrw' ),
		]
	);

	add_theme_support(
		'html5',
		[
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		]
	);
}

add_action( 'after_setup_theme', __NAMESPACE__ . '\content_width', 0 );
/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function content_width() {
	$GLOBALS['content_width'] = apply_filters( '_mrw_content_width', 688 );
}

add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\scripts_and_styles' );
/**
 * Enqueue scripts and styles.
 */
function scripts_and_styles() {
	/*
	* Styles
	*/

	wp_enqueue_style(
		'theme-styles',
		get_theme_file_uri( 'assets/css/screen.css' ),
		[],
		filemtime( get_theme_file_path( 'assets/css/screen.css' ) )
	);

	/* Defined in mu-plugins */
	if ( function_exists( '\MRW\TEC\is_tribe_view' ) && \MRW\TEC\is_tribe_view() ) {
		wp_enqueue_style(
			'_mrw-the-events-calendar',
			get_theme_file_uri( 'assets/css/plugins/the-events-calendar.css' ),
			[ 'theme-styles' ],
			filemtime( get_theme_file_path( 'assets/css/plugins/the-events-calendar.css' ) )
		);
	}

	/*
	 * Scripts
	 */
	// usually gets enqueued by a plugin, but we can dream!
	wp_dequeue_script( 'jquery' );

	wp_enqueue_script(
		'theme-navigation',
		get_theme_file_uri( 'assets/vendor/clicky-menus/clicky-menus.js' ),
		[],
		filemtime( get_theme_file_path( 'assets/vendor/clicky-menus/clicky-menus.js' ) ),
		true
	);

	wp_enqueue_script(
		'_mrw-toggler',
		get_theme_file_uri( 'assets/js/toggler.js' ),
		[ 'theme-navigation' ],
		filemtime( get_theme_file_path( 'assets/js/toggler.js' ) ),
		true
	);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'gform_enqueue_scripts', __NAMESPACE__ . '\enqueue_gravity_forms_css' );
/**
 * Only load theme Gravity Form styles when there's a form on the page!
 */
function enqueue_gravity_forms_css() {
	wp_enqueue_style(
		'_mrw-gravity-forms',
		get_theme_file_uri( 'assets/css/plugins/gravity-forms.css' ),
		[ 'theme-styles' ],
		filemtime( get_theme_file_path( 'assets/css/plugins/gravity-forms.css' ) )
	);
}

add_action( 'wp_default_scripts', __NAMESPACE__ . '\dequeue_jquery_migrate' );
/**
 * Don't enqueue jquery migrate
 *
 * @param object $scripts WP_Scripts object
 *
 * @see https://wordpress.stackexchange.com/a/291711/9844
 */
function dequeue_jquery_migrate( $scripts ) {
	if ( ! is_admin() && ! empty( $scripts->registered['jquery'] ) ) {
		$scripts->registered['jquery']->deps = array_diff(
			$scripts->registered['jquery']->deps,
			[ 'jquery-migrate' ]
		);
	}
}

/* Don't load duotone filters in body */
remove_action( 'wp_body_open', 'wp_global_styles_render_svg_filters' );

add_filter( 'replace_editor', __NAMESPACE__ . '\make_blog_editable', 10, 2 );
/**
 * Simulate non-empty content to enable Gutenberg editor
 *
 * @param bool    $replace Whether to replace the editor.
 * @param WP_Post $post    Post object.
 * @return bool
 */
function make_blog_editable( $replace, $post ) {

	if ( ! $replace && absint( get_option( 'page_for_posts' ) ) === $post->ID && empty( $post->post_content ) ) {
		$post->post_content = '<!--non-empty-content-->';
	}

	return $replace;
}

require get_template_directory() . '/inc/block-editor-config.php';

require get_template_directory() . '/inc/template-tags.php';

require get_template_directory() . '/inc/template-functions.php';

require get_template_directory() . '/inc/menu-item-replacements.php';
