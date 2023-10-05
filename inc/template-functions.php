<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package _s
 */

namespace _S_NAMESPACE\Theme;

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', __NAMESPACE__ . '\body_classes' );

add_filter( 'nav_menu_item_title', __NAMESPACE__ . '\add_dropdown_icon', 10, 4 );
/**
 * Add a dropdown indicator icon to menu items with children
 */
function add_dropdown_icon( $item_output, $item, $args, $depth ) {
	
	$has_children = in_array( 'menu-item-has-children', $item->classes, true );

	if( $depth === 0 && $has_children ) {
		$item_output = $item_output . get_svg( 'down-arrow', [ 'width' => '16', 'height' => '11' ], 'images' );
	}
		
	return $item_output;

}

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', __NAMESPACE__ . '\pingback_header' );
