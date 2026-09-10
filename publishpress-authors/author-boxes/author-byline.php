<?php
/**
 * Custom Author Boxes template
 *
 * This file should be placed in /publishpress-authors/author-boxes/
 * Inside your theme and it will automatically be available for
 * selection in settings layouts and this file slug can be use as layout
 * parameter in shortcode.
 *
 * The layout name will be this file name.
 *
 * $ppma_template_authors is a global variable and an array of authors.
 * $ppma_template_authors_post is a global variable of the author post.
 * This sometimes may be different from global $post as user can get authors
 * for specific post.
 */

global $ppma_template_authors, $ppma_template_authors_post, $post, $ppma_instance_id;

$authors             = $ppma_template_authors;
$author_counts       = count( $authors );
$global_author_index = 0;
$author_post_id      = isset( $ppma_template_authors_post->ID ) ? $ppma_template_authors_post->ID : $post->ID;
// Group author by categories
$author_categories_data = ppma_get_grouped_post_authors( $author_post_id, $authors );

if ( ! $ppma_instance_id ) {
	$ppma_instance_id = 1;
} else {
	++$ppma_instance_id;
}

$instance_id = $ppma_instance_id;
?>

<div class="pp-multiple-authors-boxes-wrapper pp-multiple-authors-wrapper pp-multiple-authors-layout-inline box-post-id-<?php echo esc_attr( $author_post_id ); ?> box-instance-id-<?php echo esc_attr( $instance_id ); ?> ppma_boxes_2181">
	<?php
	$author_category_index = 0;
	foreach ( $author_categories_data as $author_category_data ) :
		?>
		<?php
		if ( ! empty( $author_category_data['authors'] ) ) :
			if ( count( $author_category_data['authors'] ) > 1 ) {
				$category_title_output = $author_category_data['title'];
			} else {
				$category_title_output = $author_category_data['singular_title'];
			}
			?>
			<ul class="pp-multiple-authors-boxes-ul author-ul-<?php echo esc_attr( $author_category_index ); ?>">
				<?php if ( ! empty( $author_category_data['authors'] ) ) : ?>
					<?php foreach ( $author_category_data['authors'] as $index => $author ) : ?>
						<?php if ( $author && is_object( $author ) && isset( $author->term_id ) ) : ?>
							<?php $current_author_category = get_ppma_author_category( $author, $author_categories_data ); ?>
							<li class="pp-multiple-authors-boxes-li author_index_<?php echo esc_attr( $index ); ?> author_<?php echo esc_attr( $author->slug ); ?> has-avatar">
								<div class="pp-author-boxes-avatar">
									<div class="avatar-image">
										<?php if ( $author->get_avatar() ) : ?>
											<?php echo wp_kses_post( $author->get_avatar( '30' ) ); ?>
										<?php else : ?>
											<?php echo get_avatar( $author->user_email, '30' ); ?>
										<?php endif; ?>
									</div>
								</div>
								<div class="pp-author-boxes-avatar-details">
									<div class="pp-author-boxes-name multiple-authors-name">
										<a href="<?php echo esc_url( $author->link ); ?>" rel="author" class="author url fn">
											<?php echo esc_html( $author->display_name ); ?>
											<span class="screen-reader-text"> Author Archives</span>
										</a>
									</div>
								</div>
							<?php endif; ?>
						</li>
						<?php ++$global_author_index; ?>
					<?php endforeach; ?>
				<?php endif; ?>
			</ul>
		<?php endif; ?>
		<?php
		++$author_category_index;
	endforeach;
	?>
</div>
