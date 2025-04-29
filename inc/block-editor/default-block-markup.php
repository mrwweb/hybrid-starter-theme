<?php
/**
 * Filter the markup of default WordPress blocks in order to make them easier to use or more semantic
 *
 * @package _mrw
 */

namespace _MRW\Theme;

use WP_HTML_Tag_Processor;

add_filter( 'render_block', __NAMESPACE__ . '\add_class_to_list_block', 10, 2 );
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
function add_class_to_list_block( $block_content, $block ) {

	switch ( $block['blockName'] ) {
		case 'file':
			$size = wp_get_attachment_metadata( $block['attrs']['id'] );
			$block_content = str_replace( '</a></div>', "</a><div class=\"wp-block-file__size\">" . __( 'File Size: ', 'ile-kimoyo' ) . size_format( $size['filesize'], 1 ) . "</div></div>", $block_content );
			break;
	}

	return $block_content;
}
