<?php
/**
 * The template for displaying search forms in
 *
 * @package _mrw
 */

global $_mrw_search_form_counter;
if ( ! isset( $_mrw_search_form_counter ) ) {
	$_mrw_search_form_counter = 0;
}
++$_mrw_search_form_counter;
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label class="search-form__label screen-reader-text" for="s-<?php echo (int) $_mrw_search_form_counter; ?>"><?php esc_html_e( 'Search for:', '_mrw' ); ?>
	</label>
	<input type="search" class="search-form__input" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" id="s-<?php echo (int) $_mrw_search_form_counter; ?>" required>
	<button type="submit" class="search-form__submit button">
		<?php
		echo _mrw_get_svg( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			'search',
			[
				'width'  => '24',
				'height' => '24',
			]
		);
		?>
		<span class="screen-reader-text"><?php echo esc_attr_x( 'Search', 'submit button', '_mrw' ); ?></span>
	</button>
</form>
