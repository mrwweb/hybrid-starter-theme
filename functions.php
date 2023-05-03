<?php
/**
 * _s functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package _s
 */

namespace _S_NAMESPACE\Theme;

add_action( 'after_setup_theme', __NAMESPACE__ . '\setup' );
/**
 * Configure theme supports
 */
function setup() {

	add_theme_support( 'automatic-feed-links' );

	add_theme_support( 'title-tag' );

	add_theme_support( 'post-thumbnails' );

	add_editor_style( 'css/classic-editor-styles.css' );

	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', '_s' ),
		)
	);

	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
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
	$GLOBALS['content_width'] = apply_filters( '_s_content_width', 688 );
}

add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\scripts_and_styles' );
/**
 * Enqueue scripts and styles.
 */
function scripts_and_styles() {

	if( \MRW\TEC\is_tribe_view() ) {
		wp_enqueue_style(
			'custom-tec-style',
			get_theme_file_uri( 'css/plugins/the-events-calendar.css' ),
			['theme-style'],
			filemtime( get_theme_file_path( 'css/plugins/the-events-calendar.css' ) )
		);
	}

	wp_enqueue_style(
		'theme-style',
		get_theme_file_uri( 'css/style.css' ),
		[],
		filemtime( get_theme_file_path( 'css/style.css' ) )
	);

	wp_enqueue_script(
		'theme-navigation',
		get_theme_file_uri( 'vendor/clicky-menus/clicky-menus.js' ),
		[],
		filemtime( get_theme_file_path( 'vendor/clicky-menus/clicky-menus.js' ) ),
		true
	);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_default_scripts', __NAMESPACE__ . '\dequeue_jquery_migrate' );
/**
 * Don't enqueue jquery migrate
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
