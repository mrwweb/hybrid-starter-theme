<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package _s
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'is-layout-constrained post-summary' ); ?>>
	<header class="post-summary__header flow">
		<?php
		the_title( '<h2 class="post-summary__title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		if ( 'post' === get_post_type() ) :
			?>
			<div class="entry-meta">
				<?php
				_s_posted_on();
				_s_posted_by();
				?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</header>

	<?php _s_post_thumbnail(); ?>

	<div class="post-summary__content">
		<?php
		the_excerpt();
		?>
	</div>

	<footer class="post-summary__footer entry-menu">
		<?php _s_entry_footer(); ?>
	</footer>
</article><!-- #post-<?php the_ID(); ?> -->
