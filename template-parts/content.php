<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package _s
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'flow' ); ?>>
	<?php if( ! is_front_page() ) : ?>
		
		<header class="page-header flow is-layout-constrained">
			<?php
			the_title( '<h1 class="page-title">', '</h1>' );

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

	<?php endif; ?>

	<div class="page-content page-content flow is-layout-constrained">
		<?php
		the_content(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', '_s' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			)
		);

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', '_s' ),
				'after'  => '</div>',
			)
		);
		?>
	</div>

	<footer class="page-footer is-layout-constrained">
		<div>
			<?php _s_entry_footer(); ?>
		</div>
	</footer>
</article><!-- #post-<?php the_ID(); ?> -->
