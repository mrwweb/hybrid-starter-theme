<?php
/**
 * The main site navigation bar with mobile menu toggle
 *
 * @package _mrw
 */

?>
<nav id="main-navigation" class="main-navigation">
	<button id="main-menu-open" class="menu-toggle" commandfor="menu-drawer" command="show-modal">
		<?php
		echo _mrw_get_svg( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			'menu',
			[
				'width'  => '24',
				'height' => '24',
			]
		);
		?>
		<?php esc_html_e( 'Menu', '_mrw' ); ?>
	</button>
	<dialog id="menu-drawer" class="main-navigation__dialog">
		<button id="main-menu-close" class="menu-toggle" commandfor="menu-drawer" command="close">
			<?php
			echo _mrw_get_svg( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				'close',
				[
					'width'  => '24',
					'height' => '24',
				]
			);
			?>
			<span class="screen-reader-text"><?php esc_html_e( 'Close Menu', '_mrw' ); ?></span>
		</button>
		<?php
		wp_nav_menu(
			[
				'theme_location' => 'menu-1',
				'container'      => '',
				'menu_id'        => 'main-menu-1',
				'menu_class'     => 'main-menu clicky-menu no-js',
				'items_wrap'     => '<ul id="%1$s-1" class="%2$s" data-clicky-submenu-selector=".clicky-menu > li > ul">%3$s</ul>',
				'fallback_cb'    => false,
			]
		);
		?>
	</dialog>
	<div id="menu-bar" class="main-navigation__bar">
		<?php
		wp_nav_menu(
			[
				'theme_location' => 'menu-1',
				'container'      => '',
				'menu_id'        => 'main-menu-2',
				'menu_class'     => 'main-menu clicky-menu no-js',
				'items_wrap'     => '<ul id="%1$s-2" class="%2$s" data-clicky-submenu-selector=".clicky-menu > li > ul">%3$s</ul>',
				'fallback_cb'    => false,
			]
		);
		?>
	</div>
</nav><!-- #site-navigation -->
