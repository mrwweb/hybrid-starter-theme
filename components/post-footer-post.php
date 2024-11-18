<?php
/**
 * The footer for post content
 *
 * @package _mrw
 */

?>
<footer class="<?php echo esc_attr( $args['class'] ); ?>">
	<div>
		<?php
		/* translators: used between list items, there is a space after the comma */
		$mrw_categories_list = get_the_category_list( esc_html__( ', ', '_mrw' ) );
		if ( $mrw_categories_list ) {
			/* translators: 1: list of categories. */
			printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', '_mrw' ) . '</span>', $mrw_categories_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}

		/* translators: used between list items, there is a space after the comma */
		$mrw_tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', '_mrw' ) );
		if ( $mrw_tags_list ) {
			/* translators: 1: list of tags. */
			printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', '_mrw' ) . '</span>', $mrw_tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}

		if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', '_mrw' ),
						[
							'span' => [
								'class' => [],
							],
						]
					),
					wp_kses_post( get_the_title() )
				)
			);
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', '_mrw' ),
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
</footer>
