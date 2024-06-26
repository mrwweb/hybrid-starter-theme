<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package _mrw
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'flow' ); ?>>
	<?php if ( ! is_front_page() ) : ?>
		<header class="page-header is-layout-constrained">
			<?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
		</header>
	<?php endif; ?>

	<?php get_template_part( 'components/post-featured-image' ); ?>

	<div class="page-content is-root-container is-layout-constrained">
		<?php the_content(); ?>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->
