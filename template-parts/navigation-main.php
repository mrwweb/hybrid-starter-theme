<nav id="site-navigation" class="main-navigation js-toggleWrapper">
	<button class="menu-toggle js-toggleButton" data-aria-controls="menu-container">
		<?php
		echo get_svg( //phpcs:ignore
			'menu',
			array(
				'width'  => '16',
				'height' => '16',
			)
		);
		?>
		<?php
		echo get_svg( //phpcs:ignore
			'close',
			array(
				'width'  => '16',
				'height' => '16',
			)
		);
		?>
		<?php esc_html_e( 'Menu', '_s' ); ?>
	</button>
	<div id="menu-container" class="menu-container">
		<?php
		wp_nav_menu(
			array(
				'theme_location' => 'menu-1',
				'menu_id'        => 'main-menu',
				'menu_class'	 => 'main-menu clicky-menu no-js',
				'container'		 => '',
				'fallback_cb'	 => false,
			)
		);
		?>
		
		<?php get_template_part( 'components/search-toggle' ); ?>
	</div>
</nav><!-- #site-navigation -->