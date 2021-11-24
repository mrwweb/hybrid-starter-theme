<?php
/**
 * _s functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package _s
 */

namespace _S_NAMESPACE\Theme;

function theme_setup() {

	add_theme_support( 'automatic-feed-links' );

	add_theme_support( 'title-tag' );

	add_theme_support( 'post-thumbnails' );

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

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

}
add_action( 'after_setup_theme', __NAMESPACE__ . '\theme_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function content_width() {
	$GLOBALS['content_width'] = apply_filters( '_s_content_width', 640 );
}
add_action( 'after_setup_theme', __NAMESPACE__ . '\content_width', 0 );

/**
 * Register widget area.
 */
function widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', '_s' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', '_s' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', __NAMESPACE__ . '\widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function enqueue_assets() {
	wp_enqueue_style(
		'_s-style',
		get_theme_file_uri( 'css/style.css' ),
		[],
		filemtime( get_theme_file_path( 'css/style.css' ) )
	);

	wp_enqueue_script(
		'_s-navigation',
		get_theme_file_uri( 'vendor/clicky-menus/clicky-menus.js' ),
		[],
		filemtime( get_theme_file_path( 'vendor/clicky-menus/clicky-menus.js' ) ),
		true
	);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\enqueue_assets' );

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

/**
 * Configure the Block Editor
 */
require get_theme_file_path( 'inc/block-editor-config.php' );

/**
 * Custom template tags for this theme.
 */
require get_theme_file_path( 'inc/template-tags.php' );

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_theme_file_path( 'inc/template-functions.php' );

/**
 * Customizer additions.
 */
require get_theme_file_path( 'inc/customizer.php' );
