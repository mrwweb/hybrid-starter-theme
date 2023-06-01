<?php
/**
 * The template for displaying search forms in
 *
 * @package _s
 */

global $search_form_counter;
if ( ! isset( $search_form_counter ) ) {
	$search_form_counter = 0;
}
$search_form_counter++;
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label class="search-form__label screen-reader-text" for="s-<?php echo (int) $search_form_counter; ?>"><?php _ex( 'Search for:', 'label', '_s' ); ?>
	</label>
	<input type="search" class="search-form__input" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" id="s-<?php echo (int) $search_form_counter; ?>" required>
	<button type="submit" class="search-form__submit button button--small">
		🔍
		<span class="screen-reader-text"><?php echo esc_attr_x( 'Search', 'submit button', '_s' ); ?></span>
	</button>
</form>
