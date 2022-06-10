<?php
namespace _S_NAMESPACE\Theme;

/**
 * Remove Block Templates that are automatically enabled by theme.json
 * 
 * @see https://make.wordpress.org/core/2021/06/16/introducing-the-template-editor-in-wordpress-5-8/
 */
add_action( 'after_setup_theme', __NAMESPACE__ . '\disable_template_editor' );
function disable_template_editor() {
	remove_theme_support( 'block-templates' );
}

add_action( 'enqueue_block_editor_assets', __NAMESPACE__ . '\editor_assets' );
function editor_assets() {

	wp_enqueue_style(
		'block-editor',
		get_theme_file_uri( 'css/editor-styles.css' ),
		[],
		filemtime( get_theme_file_path( 'css/editor-styles.css' ) )
	);

	wp_enqueue_script(
		'block-editor',
		get_theme_file_uri( 'js/editor.min.js' ),
		[],
		filemtime( get_theme_file_path( 'js/editor.min.js' ) )
	);

}

//add_filter( 'mrw_hidden_blocks', __NAMESPACE__ . '\show_hide_blocks' );
function show_hide_blocks( $blocks ) {

	$blocks = array_diff( $blocks, array( 'core/spacer', 'core/table' ) );

	return $blocks;

}

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
