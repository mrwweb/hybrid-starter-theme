<?php
/**
 * Add custom blocks variations to the editor
 *
 * @package _mrw
 */

namespace _MRW_NAMESPACE\Theme;

add_filter( 'get_block_type_variations', __NAMESPACE__ . '\block_variations', 10, 2 );
/**
 * Register block variations in PHP for the block editor
 *
 * @param array $variations array of arrays for each block's variations
 * @param array $block block meta for each block, useful for checking $block->name to target a specific block
 * @return array $variations updated array containing variations to register
 */
function block_variations( $variations, $block ) {
	$block_name = $block->name;
	switch ( $block_name ) {
		case 'core/media-text':
			$variations[] = array(
				'name'       => 'media-text',
				'isDefault'  => true,
				'attributes' => array(
					'mediaPosition' => 'right',
					'imageFill'     => true,
				),
			);
			break;

		case 'core/latest-posts':
			$variations[] = array(
				'name'       => 'latest-posts',
				'isDefault'  => true,
				'attributes' => array(
					'displayPostContent'     => true,
					'excerptLength'          => 50,
					'displayPostDate'        => true,
					'displayFeaturedImage'   => true,
					'featuredImageSizeSlug'  => 'medium',
					'addLinkToFeaturedImage' => true,
				),
			);
			break;
	}

	return $variations;
}
