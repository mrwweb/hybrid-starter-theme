<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package _mrw
 */

get_header();
$_mrw_posts_page = get_option( 'page_for_posts' );
?>

	<main id="content" class="site-main">

		<?php
		if ( have_posts() ) :
			$_mrw_page_for_posts = get_option( 'page_for_posts' );
			$_mrw_blog_content   = get_the_content( null, false, (int) $_mrw_page_for_posts );
			?>
			<header class="page-header is-layout-constrained">
				<h1 class="page-title"><?php echo wp_kses_post( get_the_title( (int) $_mrw_page_for_posts ) ); ?></h1>
				<?php
				if ( $_mrw_blog_content ) {
					echo '<div class="archive-description">' . wp_kses_post( apply_filters( 'the_content', $_mrw_blog_content ) ) . '</div>'; //phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound
				}
				?>
			</header>
			<?php

			/* Start the Loop */
			get_template_part( 'template-parts/posts-loop' );

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main><!-- #main -->

<?php
block_template_part( 'sidebar' );
get_footer();
