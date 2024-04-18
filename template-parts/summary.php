<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package _mrw
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'is-layout-constrained post-summary' ); ?>>
	<header class="post-summary__header flow">
		<?php
		the_title( '<h2 class="post-summary__title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		get_template_part( 'components/post-meta', get_post_type() );
		?>
	</header>

	<?php get_template_part( 'components/post-featured-image', 'summary' ); ?>

	<div class="post-summary__content">
		<?php the_excerpt(); ?>
	</div>

	<?php get_template_part( 'components/post-footer', '', array( 'class' => 'post-summary__footer entry-meta' ) ); ?>
</article><!-- #post-<?php the_ID(); ?> -->
