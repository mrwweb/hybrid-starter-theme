<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package _s
 */

get_header();
?>

	<main id="content" class="site-main">

		<article class="error-404 not-found is-layout-constrained">
			<header class="page-header">
				<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', '_s' ); ?></h1>
			</header><!-- .page-header -->

			<div class="page-content flow">
				<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', '_s' ); ?></p>

				<?php get_search_form(); ?>

			</div><!-- .page-content -->
		</article><!-- .error-404 -->

	</main><!-- #main -->

<?php
get_footer();
