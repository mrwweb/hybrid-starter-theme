<?php
/**
 * Configuring what the block editor supports and enqueuing assets for the block editor and blocks
 *
 * @package _mrw
 */

namespace _MRW\Theme;

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

add_filter( 'default_wp_template_part_areas', __NAMESPACE__ . '\template_part_areas' );
/**
 * Add Sidebar and Special Pages template part areas
 *
 * @param array $areas array of template part areas. must have all params defined to avoid fatal error
 * @return array $areas
 */
function template_part_areas( $areas ) {
	$areas[] = [
		'area'        => 'sidebar',
		'area_tag'    => 'aside',
		'label'       => __( 'Sidebar', '_mrw' ),
		'icon'        => 'sidebar',
		'description' => __( 'Manage sidebar content on pages with a sidebar.', '_mrw' ),
	];
	$areas[] = [
		'area'        => 'special-pages',
		'area_tag'    => 'div',
		'label'       => __( 'Special Pages', '_mrw' ),
		'description' => __( 'Edit your 404 page, etc.', '_mrw' ),
		'icon'        => 'layout',
	];

	return $areas;
}

/*
 * Load separate stylesheets for blocks with their own styles
 *
 * add_filter( 'should_load_separate_core_block_assets', '__return_true' );
 *
 * Until FOUC/CLS issues are resolved with this, I'm turning it off
 *
 * @see https://github.com/WordPress/gutenberg/issues/57395
 */


add_action( 'enqueue_block_editor_assets', __NAMESPACE__ . '\editor_assets' );
/**
 * Enqueue the styles and scripts that customize the block editor
 */
function editor_assets() {

	wp_enqueue_style(
		'_mrw-block-editor',
		get_theme_file_uri( 'assets/css/editor-styles.css' ),
		[],
		filemtime( get_theme_file_path( 'assets/css/editor-styles.css' ) )
	);

	if ( get_post_type() === 'tribe_events' ) {
		wp_enqueue_style(
			'_mrw-tec-block-editor',
			get_theme_file_uri( 'assets/css/plugins/the-events-calendar-editor.css' ),
			[],
			filemtime( get_theme_file_path( 'assets/css/plugins/the-events-calendar-editor.css' ) )
		);
	}

	$asset_file = include get_theme_file_path( 'assets/js/editor/editor.asset.php' );
	wp_enqueue_script(
		'_mrw-block-editor',
		get_theme_file_uri( 'assets/js/editor/editor.min.js' ),
		$asset_file['dependencies'],
		$asset_file['version'],
		true
	);
}

/**
 * Enqueue block-specific styles
 *
 * Only doing this for blocks that aren't used on almost every page, so we get greater benefits from caching
 *
 * @see https://developer.wordpress.org/reference/functions/wp_enqueue_block_style/
 */
/* Format: 'prefix' => [ 'block-slug', 'block-slug-2' ] */
$_mrw_styled_blocks = [
	'core' => [ 'columns', 'media-text'],
];
foreach ( $_mrw_styled_blocks as $_mrw_prefix => $_mrw_blocks ) {
	foreach( $_mrw_blocks as $_mrw_block_name ) {
		$_mrw_block_style_args = [
			'handle' => "_mrw-$_mrw_block_name",
			'src'    => get_theme_file_uri( "assets/css/blocks/$_mrw_block_name.css" ),
		];
		wp_enqueue_block_style( "$_mrw_prefix/$_mrw_block_name", $_mrw_block_style_args );
	}
}

add_filter( 'mrw_hidden_blocks', __NAMESPACE__ . '\show_hide_blocks' );
/**
 * Adjust what block are available in the editor via MRW Simplified Editor hook
 *
 * @param array $blocks All the blocks are that are currently hidden (add entries to hide more blocks, remove entries to show them)
 */
function show_hide_blocks( $blocks ) {

	$blocks = array_diff( $blocks, [] );

	$blocks[] = 'core/latest-posts';

	return $blocks;
}

add_filter( 'mrw_hidden_block_editor_settings', __NAMESPACE__ . '\show_block_settings' );
/**
 * Unhide hidden-by-default block editor features in MRW Simplified Editor
 *
 * @param array $features array of hidden features
 * @return array modified list of features to hide
 */
function show_block_settings( $features ) {
	return array_diff( $features, [ 'spacing' ] );
}


/* Adjust default Core block markup */
require 'block-editor/default-block-markup.php';

/* Register custom block styles */
require 'block-editor/block-styles.php';

/* Register custom block variations in PHP as much as possible */
require 'block-editor/block-variations.php';
