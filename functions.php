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
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on _s, use a find and replace
	 * to change '_s' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( '_s', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', '_s' ),
		)
	);

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
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
add_action( 'after_setup_theme', __NAMESPACE__ . 'theme_setup' );

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
add_action( 'after_setup_theme', __NAMESPACE__ . 'content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
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
add_action( 'widgets_init', __NAMESPACE__ . 'widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function enqueue_assets() {
	wp_enqueue_style(
		'_s-style',
		get_theme_file_uri( 'css/screen.css' ),
		[],
		filemtime( get_theme_file_uri( 'css/screen.css' ) )
	);

	wp_enqueue_script(
		'_s-navigation',
		get_theme_file_uri( '/js/navigation.js' ),
		[],
		filemtime( get_theme_file_uri( '/js/navigation.js' ) ),
		true
	);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', __NAMESPACE__ . 'enqueue_assets' );

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

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_theme_file_path( 'inc/jetpack.php' );
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_theme_file_path( 'inc/woocommerce.php' );
}
