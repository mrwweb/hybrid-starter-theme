<?php
namespace _S_NAMESPACE\Theme;

//add_filter( 'after_setup_theme', __NAMESPACE__ . '\register_block_styles', 999 );
function register_block_styles() {

	/* Paragraphs */
	register_block_style(
		'core/paragraph',
		[
			'name' => 'example',
			'label' => __( 'Example', '_s' ),
		]
	);

}