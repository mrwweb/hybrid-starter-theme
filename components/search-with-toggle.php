<div class="search-container js-toggleWrapper">
	<div class="is-visible-with-mobile-menu">
		<?php get_search_form(); ?>
	</div>
	<div class="is-visible-with-desktop-menu">
		<button class="search-toggle js-toggleButton" data-aria-controls="search-toggle-container">
			<?php
			echo get_svg( //phpcs:ignore
				'search',
				array(
					'width'  => '16',
					'height' => '16',
				)
			);
			?>
			<span class="screen-reader-text">
				<?php esc_html_e( 'search', '_s' ); ?>
			</span>
		</button>
		<div id="search-toggle-container" class="search-toggle-container">
			<?php get_search_form(); ?>
		</div>
	</div>
</div>