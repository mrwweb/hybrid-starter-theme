<?php
/**
 * A template part where the search form is contained within a toggle container
 * 
 * I'm considering a different approach to this that involves swapping out a menu item so this can be a full-class part of the navigation menu
 *
 * @package _mrw
 */

?>
<div class="search-container js-toggleWrapper">
	<div class="is-visible-with-mobile-menu">
		<?php get_search_form(); ?>
	</div>
	<div class="is-visible-with-desktop-menu">
		<button class="search-toggle js-toggleButton" data-aria-controls="search-toggle-container">
			<?php
			echo _mrw_get_svg( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				'search',
				array(
					'width'  => '16',
					'height' => '16',
				)
			);
			?>
			<span class="screen-reader-text">
				<?php esc_html_e( 'search', '_mrw' ); ?>
			</span>
		</button>
		<div id="search-toggle-container" class="search-toggle-container">
			<?php get_search_form(); ?>
		</div>
	</div>
</div>
