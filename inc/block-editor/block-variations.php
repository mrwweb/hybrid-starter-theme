<?php
/**
 * Add custom blocks variations to the editor
 *
 * @package _s
 */

namespace _S_NAMESPACE\Theme;

add_filter( 'get_block_type_variations', __NAMESPACE__ . '\block_variations', 10, 2 );

function block_variations( $variations, $block ) {
	var_dump( 'variations' );
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
