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
			<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', '_mrw' ); ?></p>
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'menu-404',
					'menu_id'        => 'menu-404',
					'menu_class'     => 'menu-404',
					'container'      => '',
					'fallback_cb'    => false,
				)
			);

			get_search_form();
			?>
		</div><!-- .page-content -->
	</article><!-- .error-404 -->
</main><!-- #main -->
<?php
get_footer();
