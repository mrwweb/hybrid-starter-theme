<?php
/**
 * The post thumbnail for a post
 *
 * @package _mrw
 */

if ( ! post_password_required() && has_post_thumbnail() ) {
	?>
	<a class="featured-image" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
		<?php the_post_thumbnail( 'post-thumbnail' ); ?>
	</a>
	<?php
}
