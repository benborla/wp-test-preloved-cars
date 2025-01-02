<?php get_header(); ?>

<div class="container mx-auto px-4">
    <?php get_template_part('template-parts/featured-cars'); ?>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
        <?php
        while (have_posts()) : the_post();
            get_template_part('template-parts/car-card');
        endwhile;
        ?>
    </div>

    <?php the_posts_pagination(); ?>
</div>

<?php get_footer(); ?>
