<?php
/**
 * The main site navigation bar with mobile menu toggle
 *
 * @package _mrw
 */

?>
<nav id="site-navigation" class="main-navigation js-toggleWrapper">
	<button id="main-menu-toggle" class="menu-toggle js-toggleButton" data-aria-controls="menu-container">
		<?php
		echo _mrw_get_svg( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			'menu',
			array(
				'width'  => '24',
				'height' => '24',
			)
		);
		?>
		<?php
		echo _mrw_get_svg( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			'close',
			array(
				'width'  => '24',
				'height' => '24',
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
				'container'      => '',
				'menu_id'        => 'main-menu',
				'menu_class'     => 'main-menu clicky-menu no-js',
				'items_wrap'	 => '<ul id="%1$s" class="%2$s" data-clicky-submenu-selector=".clicky-menu > li > ul">%3$s</ul>',
				'fallback_cb'    => false,
			)
		);
		?>
	</div>
</nav><!-- #site-navigation -->
