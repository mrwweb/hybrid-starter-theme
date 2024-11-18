<?php
/**
 * Allow replacement of menu items via classes and show menu description on items
 *
 * @package _mrw
 */

namespace _MRW\Theme;

add_filter( 'walker_nav_menu_start_el', __NAMESPACE__ . '\main_menu_walker', 10, 4 );
/**
 * Allow replacement of menu items via classes and show menu description on items
 *
 * @param string  $item_output html of the menu item
 * @param WP_Post $item post object of menu item
 * @param int     $depth depth in the menu
 * @param object  $args wp_nav_menu arguments
 * @return string modified $item_output
 */
function main_menu_walker( $item_output, $item, $depth, $args ) {

	if ( 'menu-1' === $args->theme_location ) {

		if ( $depth > 0 && $item->description ) {
			$item_output .= '<span class="menu-description">' . esc_html( $item->description ) . '</span>';
		}

		if ( in_array( 'menu-replace-search-button', $item->classes, true ) ) {
			$item_output = '<a href="' . site_url( '?s=' ) . '">' . _mrw_get_svg(
				'search',
				[
					'width'  => '24',
					'height' => '24',
				]
			) . '<span>' . esc_html__( 'Search', '_mrw' ) . '</span></a>';
		}

		if ( in_array( 'menu-replace-search-form', $item->classes, true ) ) {
			$item_output = get_search_form( [ 'echo' => false ] );
		}
	}

	return $item_output;
}
