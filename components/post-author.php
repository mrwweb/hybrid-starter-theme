<?php
/**
 * The Author of a post
 *
 * Supports the PublishPress Authors plugin and falls back to default WP
 *
 * @package _mrw
 */

if (
	in_array(
		'publishpress-authors/publishpress-authors.php',
		apply_filters( 'active_plugins', get_option( 'active_plugins' ) ),
		true
	)
) {
	echo '<span class="byline"> by';
	do_action( 'pp_multiple_authors_show_author_box', false, 'inline', false, true );
	echo '</span>';
} else {
	$byline = sprintf(
		/* translators: %s: post author. */
		esc_html_x( 'by %s', 'post author', '_mrw' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="byline"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}
