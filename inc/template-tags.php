<?php
/**
* Custom template tags for this theme
*
* Eventually, some of the functionality here could be replaced by core features.
*
* @package _s
*/

/**
 * Get an SVG file from the imgs/ folder in the theme, update its attributes if necessary and return it as a string.
 *
 * @author Aurooba Ahmed
 * @see https://aurooba.com/inline-svgs-in-your-wordpress-code-with-this-helper-function/
 *
 * @param string $filename The name of the SVG file to get.
 * @param array $attributes (optional) An array of attributes to add/modify to the SVG file.
 * @param string $directory (optional) The directory to look for the SVG file in, defaults to 'imgs'.
 * @return string|WP_Error The SVG file as a string or a WP_Error object if there was an error.
 */
function get_svg( $filename, $attributes = array(), $directory = 'images/svg' ) {
	// Get the SVG file.
	$svg = file_get_contents( get_stylesheet_directory() . '/' . $directory . '/' . $filename . '.svg' );

	$errors = new WP_Error();

	// If there was an error retrieving the SVG file, return a WP_Error object.
	if ( ! $svg ) {
		$svg_error_message = sprintf(
			/* translators: %1$s: SVG file name, %2$s: SVG directory */
			__( 'There was an error retrieving the SVG file "%1$s" from the "%2$s" directory.', 'yourdomain' ),
			$filename . '.svg',
			$directory
		);

		$errors->add(
			'svg_file_not_found',
			$svg_error_message,
			array(
				'svg_file' => $filename . '.svg',
				'svg_directory' => $directory,
			)
		);
		return $errors;

	}

	// Initialize the SVG tag processor.
	$update_svg = new WP_HTML_Tag_Processor( $svg );
	$update_svg->next_tag( 'svg' );

	// If there are attributes to add, add them.
	if ( ! empty( $attributes ) ) {
		foreach ( $attributes as $attribute => $value ) {
			// If the attribute is 'class', add the class to the SVG file without overwriting the existing classes.
			if ( 'class' === $attribute ) {
				$update_svg->add_class( $value );
				continue;
			}
			// Otherwise, set/update the attribute with the new value
			$update_svg->set_attribute( $attribute, $value );
		}
	}

	// Return the SVG string.
	return $update_svg->get_updated_html();
}

/**
 * Prints HTML with meta information for the current post-date/time.
 */
function _s_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf(
		$time_string,
		esc_attr( get_the_date( DATE_W3C ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( DATE_W3C ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		/* translators: %s: post date. */
		esc_html_x( 'Posted on %s', 'post date', '_s' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

}

/**
 * Prints HTML with meta information for the current author.
 */
function _s_posted_by() {
	$byline = sprintf(
		/* translators: %s: post author. */
		esc_html_x( 'by %s', 'post author', '_s' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="byline"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

}

/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function _s_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', '_s' ) );
		if ( $categories_list ) {
			/* translators: 1: list of categories. */
			printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', '_s' ) . '</span>', $categories_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', '_s' ) );
		if ( $tags_list ) {
			/* translators: 1: list of tags. */
			printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', '_s' ) . '</span>', $tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link(
			sprintf(
				wp_kses(
					/* translators: %s: post title */
					__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', '_s' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
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
				__( 'Edit <span class="screen-reader-text">%s</span>', '_s' ),
				array(
					'span' => array(
						'class' => array(),
					),
				)
			),
			wp_kses_post( get_the_title() )
		),
		'<span class="edit-link">',
		'</span>'
	);
}

/**
 * Displays an optional post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index views, or a div
 * element when on single views.
 */
function _s_post_thumbnail() {
	if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
		return;
	}

	if ( is_singular() ) :
		?>

		<div class="post-thumbnail">
			<?php the_post_thumbnail(); ?>
		</div><!-- .post-thumbnail -->

	<?php else : ?>

		<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
			<?php
				the_post_thumbnail(
					'post-thumbnail',
					array(
						'alt' => the_title_attribute(
							array(
								'echo' => false,
							)
						),
					)
				);
			?>
		</a>

		<?php
	endif; // End is_singular().
}
