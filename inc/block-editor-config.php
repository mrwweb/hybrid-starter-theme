<?php
/**
 * Configuring what the block editor supports and enqueuing assets for the block editor and blocks
 *
 * @package _mrw
 */

namespace _MRW_NAMESPACE\Theme;

/**
 * Remove Block Templates that are automatically enabled by theme.json
 */
add_action( 'after_setup_theme', __NAMESPACE__ . '\configure_template_editors' );
/**
 * Add support for template parts and remove ability to create custom templates from the post editor
 */
function configure_template_editors() {
	/*
	 * Support the block template part editor for the footer
	 * @see https://make.wordpress.org/core/2022/10/04/block-based-template-parts-in-traditional-themes/
	 */
	add_theme_support( 'block-template-parts' );

	/*
	 * Remove Block Templates that are automatically enabled by theme.json
	 * @see https://make.wordpress.org/core/2021/06/16/introducing-the-template-editor-in-wordpress-5-8/
	 */
	remove_theme_support( 'block-templates' );
}

/**
 * Load separate stylesheets for blocks with their own styles
 */
add_filter( 'should_load_separate_core_block_assets', '__return_true' );

add_action( 'enqueue_block_editor_assets', __NAMESPACE__ . '\editor_assets' );
/**
 * Enqueue the styles and scripts that customize the block editor
 */
function editor_assets() {

	wp_enqueue_style(
		'_mrw-block-editor',
		get_theme_file_uri( 'assets/css/editor-styles.css' ),
		array(),
		filemtime( get_theme_file_path( 'assets/css/editor-styles.css' ) )
	);

	if ( get_post_type() === 'tribe_events' ) {
		wp_enqueue_style(
			'_mrw-tec-block-editor',
			get_theme_file_uri( 'assets/css/plugins/the-events-calendar-editor.css' ),
			array(),
			filemtime( get_theme_file_path( 'assets/css/plugins/the-events-calendar-editor.css' ) )
		);
	}

	/* wp_enqueue_script(
		'_mrw-block-editor',
		get_theme_file_uri( 'assets/js/editor.js' ),
		array(),
		filemtime( get_theme_file_path( 'js/editor.js' ) ),
		true
	); */
}

/**
 * Enqueue block-specific styles
 *
 * Only doing this for blocks that aren't used on almost every page, so we get greater benefits from caching
 *
 * @see https://developer.wordpress.org/reference/functions/wp_enqueue_block_style/
 */
$styled_blocks = array( 'columns', 'media-text', 'latest-posts' );
foreach ( $styled_blocks as $block_name ) {
	$args = array(
		'handle' => "_mrw-$block_name",
		'src'    => get_theme_file_uri( "assets/css/components/blocks/$block_name.css" ),
	);
	wp_enqueue_block_style( "core/$block_name", $args );
}

// add_filter( 'mrw_hidden_blocks', __NAMESPACE__ . '\show_hide_blocks' );
/**
 * Adjust what block are available in the editor via MRW Simplified Editor hook
 *
 * @param array $blocks All the blocks are that are currently hidden (add entries to hide more blocks, remove entries to show them)
 */
function show_hide_blocks( $blocks ) {

	$blocks = array_diff( $blocks, array( 'core/spacer', 'core/table' ) );

	return $blocks;
}

/* Adjust default Core block markup */
require 'block-editor/default-block-markup.php';

/* Register custom block styles */
require 'block-editor/block-styles.php';

/* Register custom block variations in PHP as much as possible */
require 'block-editor/block-variations.php';
