<?php
/**
 * Add custom style variations to blocks
 *
 * @package _mrw
 */

namespace _MRW_NAMESPACE\Theme;

add_filter( 'after_setup_theme', __NAMESPACE__ . '\register_block_styles', 999 );
/**
 * Register all styles for blocks that I'll apply with custom CSS
 *
 * @return void
 */
function register_block_styles() {

	/* Paragraphs */
	register_block_style(
		'core/paragraph',
		[
			'name'  => 'example',
			'label' => __( 'Example', '_mrw' ),
		]
	);
}
