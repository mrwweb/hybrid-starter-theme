<?php
/**
 * The main template file
 *
 * This file is used as the default *Archive* template. singular.php is the default single-post template
 *
 * @package _mrw
 */

get_header();
?>

	<main id="content" class="site-main">

		<?php
		if ( have_posts() ) :
			?>
			<header class="page-header is-layout-constrained flow">
				<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->
			<?php
			get_template_part( 'template-parts/posts-loop' );

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main><!-- #main -->

<?php
block_template_part( 'sidebar' );
get_footer();
