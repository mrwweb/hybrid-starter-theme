<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package _mrw
 */

get_header();
?>
<main id="content" class="site-main">
	<article class="error-404 not-found flow">
		<header class="page-header is-layout-constrained">
			<h1 class="page-title"><?php esc_html_e( 'Page not found', '_mrw' ); ?></h1>
		</header><!-- .page-header -->

		<div class="page-content is-root-container is-layout-constrained">
			<?php block_template_part( '404' ); ?>
		</div><!-- .page-content -->
	</article><!-- .error-404 -->
</main><!-- #main -->
<?php
get_footer();
