<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package _s
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'flow' ); ?>>
	<header class="page-header is-layout-constrained">
		<?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
	</header>

	<?php _s_post_thumbnail(); ?>

	<div class="page-content is-layout-constrained flow">
		<?php
		the_content();

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', '_s' ),
				'after'  => '</div>',
			)
		);
		?>
	</div>

</article><!-- #post-<?php the_ID(); ?> -->
