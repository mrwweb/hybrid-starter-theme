<?php
/**
 * The post thumbnail for a post
 *
 * @package _s
*/

if ( ! post_password_required() && has_post_thumbnail() ) {
    ?>
    <div class="featured-image">
        <?php the_post_thumbnail(); ?>
    </div><!-- .post-thumbnail -->
<?php
}