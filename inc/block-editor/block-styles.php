<?php
/**
 * Add custom style variations to blocks
 *
 * @package _mrw
 */

namespace _MRW\Theme;

add_filter( 'after_setup_theme', __NAMESPACE__ . '\register_block_styles', 999 );
/**
 * Register all styles for blocks that I'll apply with custom CSS
 *
 * @return void
 */
function register_block_styles() {
	/* Headings */
	register_block_style(
		'core/heading',
		[
			'name'  => 'screen-reader-text',
			'label' => __( 'Screen Reader', '_mrw' ),
			'inline_style' => '.is-style-logos .wp-block-image{max-width:12rem!important;margin:auto!important;padding:var(--wp--preset--spacing--30)!important;}',
		]
	);

	/* Lists */
	register_block_style( 
		'core/list',
		[
			'name'  => 'no-markers',
			'label' => __( 'No Markers', '_mrw' ),
		]
	);

	register_block_style( 
		'core/list',
		[
			'name'  => 'two-col',
			'label' => __( 'Two Col', '_mrw' ),
		]
	);

	register_block_style( 
		'core/list',
		[
			'name'  => 'two-col-no-markers',
			'label' => __( 'Two Col No Markers', '_mrw' ),
		]
	);

	register_block_style( 
		'core/list',
		[
			'name'  => 'multicol',
			'label' => __( 'Multicol', '_mrw' ),
		]
	);

	register_block_style( 
		'core/list',
		[
			'name'  => 'multicol-no-markers',
			'label' => __( 'Multicol No Markers', '_mrw' ),
		]
	);

	/* Gallery */
	register_block_style(
		'core/gallery',
		[
			'name'  => 'not-stretched',
			'label' => __( 'Not Stretched', '_mrw' ),
			'inline_style' => 'is-style-not-stretched .wp-block-image{flex-grow:0!important; margin:auto!important;}',
		]
	);
	register_block_style(
		'core/gallery',
		[
			'name'  => 'logos',
			'label' => __( 'Logos', '_mrw' ),
			'inline_style' => '.is-style-logos .wp-block-image{max-width:12rem!important;margin:auto!important;padding:var(--wp--preset--spacing--30)!important;}',
		]
	);
	register_block_style(
		'core/gallery',
		[
			'name'  => 'logos-grayscale',
			'label' => __( 'Logos Grayscale', '_mrw' ),
			'inline_style' => '.is-style-logos-grayscale .wp-block-image{max-width:12rem!important;margin:auto!important;padding:var(--wp--preset--spacing--30)!important;img{filter:grayscale(1) contrast(1.2);transition:filter 0.25s;}a:hover img,.is-style-logos-grayscale a:focus img{filter:grayscale(0) contrast(1);}',
		]
	);
}
