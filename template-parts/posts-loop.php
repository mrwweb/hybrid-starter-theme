<?php
/**
 * Standard loop for archive pages, blog, etc.
 *
 * @package _mrw
 */

?>
<div class="page-content is-layout-constrained is-root-container flow">
	<?php
	while ( have_posts() ) :
		the_post();

		get_template_part( 'template-parts/summary', get_post_type() );

	endwhile;

	the_posts_navigation();
	?>
</div>
