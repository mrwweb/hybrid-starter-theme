<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package _mrw
 */

namespace _MRW_NAMESPACE\Theme;

add_filter( 'body_class', __NAMESPACE__ . '\body_classes' );
/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function body_classes( $classes ) {
	return $classes;
}

add_filter( 'nav_menu_item_title', __NAMESPACE__ . '\add_dropdown_icon', 10, 4 );
/**
 * Add a dropdown icon to menu items with children
 *
 * @param string $item_output html output of the item
 * @param array  $item all properties of the item
 * @param array  $args arguments for that menu item
 * @param int    $depth depth of the menu item
 * @return string the updated $item_output
 */
function add_dropdown_icon( $item_output, $item, $args, $depth ) {

	$has_children = in_array( 'menu-item-has-children', $item->classes, true );

	if ( $depth === 0 && $has_children ) {
		$item_output = $item_output . _mrw_get_svg(
			'chevron',
			array(
				'width'  => '16',
				'height' => '16',
			)
		);
	}

	return $item_output;
}
