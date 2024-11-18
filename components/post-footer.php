<?php
/**
 * The footer for a post body
 *
 * @package _mrw
 */

if ( is_user_logged_in() ) :
	?>
	<footer class="<?php echo esc_attr( $args['class'] ); ?>">
		<div>
			<?php
			edit_post_link(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Edit <span class="screen-reader-text">%s</span>', 'trec' ),
						[
							'span' => [
								'class' => [],
							],
						]
					),
					wp_kses_post( get_the_title() )
				),
				'<span class="edit-link">',
				'</span>'
			);
			?>
		</div>
	<footer>
	<?php
endif;
