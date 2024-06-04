<?php
/**
 * The post meta for a post
 *
 * @package _mrw
 */

if ( 'post' === get_post_type() ) :
	?>
	<div class="entry-meta">
		<?php
		get_template_part( 'components/post-date' );
		get_template_part( 'components/post-author' );
		?>
	</div><!-- .entry-meta -->
<?php endif; ?>
