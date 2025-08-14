<?php
/**
 * Filter the markup of default WordPress blocks in order to make them easier to use or more semantic
 *
 * @package _mrw
 */

namespace _MRW\Theme;

add_filter( 'render_block', __NAMESPACE__ . '\default_block_markup', 10, 2 );
/**
 * Polyfill wp-block-list class on list blocks
 *
 * Should not be necessary in future version of WP
 *
 * @param string $block_content the HTML of the block
 * @param array  $block all properties of the block
 *
 * @see https://github.com/WordPress/gutenberg/issues/12420
 * @see https://github.com/WordPress/gutenberg/pull/42269
 */
function default_block_markup( $block_content, $block ) {

	switch ( $block['blockName'] ) {
		case 'core/file':
			$size = wp_get_attachment_metadata( $block['attrs']['id'] );
			$block_content = str_replace( '</a></div>', "</a><div class=\"wp-block-file__size\">" . __( 'File Size: ', '_mrw' ) . size_format( $size['filesize'], 1 ) . "</div></div>", $block_content );
			break;
	}

	return $block_content;
}
