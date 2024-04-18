<?php
/**
 * The post meta for a post
 *
 * @package _s
*/

if ( 'post' === get_post_type() ) :
    ?>
    <div class="entry-meta">
        <?php
        get_template_part( 'components/post-date.php' );
        get_template_part( 'components/post-author.php' );
        ?>
    </div><!-- .entry-meta -->
<?php endif; ?>