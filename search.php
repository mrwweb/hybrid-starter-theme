<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package _mrw
 */

get_header();
?>

	<main id="content" class="site-main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header is-layout-constrained">
				<h1 class="page-title">
					<?php
					/* translators: %s: search query. */
					printf( esc_html__( 'Search Results for: %s', '_mrw' ), '<span>' . get_search_query() . '</span>' );
					?>
				</h1>
			</header><!-- .page-header -->

			<?php
			get_template_part( 'template-parts/posts-loop', 'search' );

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main><!-- #main -->

<?php
block_template_part( 'sidebar' );
get_footer();
