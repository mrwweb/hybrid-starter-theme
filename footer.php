<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package _s
 */

?>
	<footer id="colophon" class="site-footer" aria-labelledby="footer-heading">
		<h2 id="footer-heading" class="screen-reader-text">Site Footer</h2>
		<nav class="site-footer__navigation" aria-label="<?php esc_html_e( 'Footer menu', 'csi' ); ?>">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'menu-2',
					'menu_id'        => 'footer-menu',
					'menu_class'	 => 'footer-menu',
					'container'		 => '',
					'fallback_cb'	 => false,
				)
			);
			?>
		</nav>
		<div class="site-info">
			<?php echo get_the_privacy_policy_link('', '<span class="sep"> | </span>'); ?>
			<?php echo bloginfo( 'name' ); ?> © <?php echo date('Y'); ?>
			<span class="sep"> | </span>
				<?php
				/* translators: 1: Theme name, 2: Theme author. */
				printf( esc_html__( 'Site by %1$s.', 'csi' ), '<a href="https://MRWweb.com/" rel="nofollow designer">MRW Web Design</a>' );
				?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
