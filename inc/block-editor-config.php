<?php
namespace _S_NAMESPACE\Theme;

use WP_HTML_Tag_Processor;

/**
 * Remove Block Templates that are automatically enabled by theme.json
 * 
 * @see https://make.wordpress.org/core/2021/06/16/introducing-the-template-editor-in-wordpress-5-8/
 */
add_action( 'after_setup_theme', __NAMESPACE__ . '\configure_template_editors' );
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
 * Add registered "Sidebar" area for template parts
 * 
 * @see https://developer.wordpress.org/news/2023/06/upgrading-the-site-editing-experience-with-custom-template-part-areas/
 */
function template_part_areas( array $areas ) {
	$areas[] = array(
		'area'        => 'sidebar',
		'area_tag'    => 'aside',
		'label'       => __( 'Sidebar', '_s' ),
		'icon'        => 'sidebar'
	);

	return $areas;
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

/**
 * Enqueue block-specific styles
 * 
 * Only doing this for blocks that aren't used on almost every page, so we get greater benefits from caching
 * 
 * @see https://developer.wordpress.org/reference/functions/wp_enqueue_block_style/
 */
$styled_blocks = [ 'columns', 'media-text', 'latest-posts' ];
foreach ( $styled_blocks as $block_name ) {
	$args = array(
		'handle' => "mrw-$block_name",
		'src'    => get_theme_file_uri( "css/components/blocks/$block_name.css" ),
	);
	wp_enqueue_block_style( "core/$block_name", $args );
}

add_filter( 'render_block', __NAMESPACE__ . '\add_class_to_list_block', 10, 2 );
/**
 * Polyfill wp-block-list class on list blocks
 *
 * Should not be necessary in future version of WP
 *
 * @see https://github.com/WordPress/gutenberg/issues/12420
 * @see https://github.com/WordPress/gutenberg/pull/42269
 */
function add_class_to_list_block( $block_content, $block ) {

	if ( 'core/list' === $block['blockName'] ) {
		$block_content = new WP_HTML_Tag_Processor( $block_content );
		$block_content->next_tag(); /* first tag should always be ul or ol */
		$block_content->add_class( 'wp-block-list' );
		$block_content->get_updated_html();
	}

	return $block_content;
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
