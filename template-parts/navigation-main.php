<?php
/**
 * The main site navigation bar with mobile menu toggle
 *
 * @package _mrw
 */

?>
<nav id="site-navigation" class="main-navigation js-toggleWrapper">
	<button class="menu-toggle js-toggleButton" data-aria-controls="menu-container">
		<?php
		echo _mrw_get_svg( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			'menu',
			array(
				'width'  => '16',
				'height' => '16',
			)
		);
		?>
		<?php
		echo _mrw_get_svg( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			'close',
			array(
				'width'  => '16',
				'height' => '16',
			)
		);
		?>
		<?php esc_html_e( 'Menu', '_mrw' ); ?>
	</button>
	<div id="menu-container" class="menu-container">
		<?php
		wp_nav_menu(
			array(
				'theme_location' => 'menu-1',
				'menu_id'        => 'main-menu',
				'menu_class'     => 'main-menu clicky-menu no-js',
				'container'      => '',
				'fallback_cb'    => false,
			)
		);
		?>
		
		<?php get_template_part( 'components/search-with-toggle' ); ?>
	</div>
</nav><!-- #site-navigation -->
