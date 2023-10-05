<div class="page-content is-layout-constrained flow">
    <?php
    while ( have_posts() ) :
        the_post();

        get_template_part( 'template-parts/summary', get_post_type() );

    endwhile;

    the_posts_navigation();
    ?>
</div>