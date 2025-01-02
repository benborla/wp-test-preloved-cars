<?php
/* Template Name: Preloved Cars Homepage */
get_header();

$paged = get_query_var('page') ? get_query_var('page') : 1;
$cars_query_args = [
    'post_type' => 'car',
    'posts_per_page' => 6,
    'paged' => $paged,
    'no_found_rows' => false,
    'update_post_meta_cache' => true,
    'update_post_term_cache' => true,
    'orderby' => 'post_date',
    'order' => 'DESC',
];

$cars_query = new WP_Query($cars_query_args);
?>

<div class="bg-gray-100 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <h2 class="text-3xl font-bold text-gray-900 text-center mb-12">Featured Cars</h2>

        <div class="owl-carousel owl-theme">
            <?php
            $args = [
                'post_type' => 'car',
                'posts_per_page' => 6
            ];

            $carousel_query = new WP_Query($args);

            if ($carousel_query->have_posts()) :
                while ($carousel_query->have_posts()) : $carousel_query->the_post();
            ?>
                    <div class="item bg-white rounded-lg shadow-lg overflow-hidden transform transition duration-300 hover:scale-105">
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="aspect-w-16 aspect-h-9">
                                <?php the_post_thumbnail('medium', ['class' => 'w-full h-64 object-cover']); ?>
                            </div>
                        <?php else: ?>
                            <div class="aspect-w-16 aspect-h-5">
                                <img width="284" height="177" src="/wp-content/uploads/2025/01/no-image.jpg" class="w-full h-[14.3rem] object-cover wp-post-image" alt="no available image" decoding="async" fetchpriority="high">
                            </div>
                        <?php endif; ?>

                        <div class="p-6">
                            <h4 class="text-xl font-semibold text-gray-900 mb-2"><?php the_title(); ?></h4>

                            <div class="flex items-center space-x-4 text-sm text-gray-500 mb-4">
                                <?php
                                $year = get_post_meta(get_the_ID(), 'car_year', true);
                                $mileage = get_post_meta(get_the_ID(), 'car_mileage', true);
                                if ($year) echo '<span>Year: ' . esc_html($year) . '</span>';
                                if ($mileage) echo '<span>Mileage: ' . number_format($mileage) . ' km</span>';
                                ?>
                            </div>

                            <div class="flex justify-between items-center">
                                <?php
                                $price = get_post_meta(get_the_ID(), 'car_price', true);
                                if ($price) : ?>
                                    <span class="text-2xl font-bold text-blue-600">$<?php echo number_format($price); ?></span>
                                <?php endif; ?>

                                <a href="<?php the_permalink(); ?>" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
            <?php
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </div>
    </div>
</div>
<div class="bg-gray-100 min-h-screen py-12">
    <div class="container mx-auto px-4">
        <?php
        // Featured Section
        get_template_part('template-parts/featured-cars');
        ?>

        <div class="mt-16">
            <h2 id="available_cars" class="text-2xl font-bold text-gray-800 mb-8">Available Cars</h2>
            <?php if ($cars_query->have_posts()) : ?>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <?php
                    while ($cars_query->have_posts()) : $cars_query->the_post();
                        get_template_part('template-parts/car-card');
                    endwhile;

                    preloved_cars_pagination($cars_query);
                    wp_reset_postdata();
                else:
                    ?>
                    <div class="flex items-center justify-center">
                        <p class="text-1xl font-bold text-gray-600">No cars available</p>
                    </div>
                <?php
                endif;
                ?>
                </div>
        </div>
    </div>
</div>

<?php

/**
 * Custom pagination function
 */
function preloved_cars_pagination($query)
{
    if ($query->max_num_pages <= 1) return;

    $button_classes = [
        'current' => 'flex items-center justify-center px-4 h-10 text-blue-600 border border-gray-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white',
        'prev' => 'flex items-center justify-center px-4 h-10 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white',
        'next' => 'flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white',
        'dots' => 'flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white',
        'default' => 'flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white'
    ];

    $paginate_links = paginate_links([
        'base' => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999) . '#available_cars')),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('page')),
        'total' => $query->max_num_pages,
        'prev_text' => esc_html__('« Previous', ''),
        'next_text' => esc_html__('Next »', ''),
        'type' => 'array',
        'end_size' => 2,
        'mid_size' => 2
    ]);

    if (!empty($paginate_links)) : ?>
        <div class="col-span-full mt-12">
            <nav aria-label="<?php esc_attr_e('Page navigation', 'your-theme-text-domain'); ?>" class="flex justify-center">
                <ul class="inline-flex -space-x-px text-base h-10">
                    <?php

                    foreach ($paginate_links as $link) {
                        $class_key = 'default';
                        if (strpos($link, 'current') !== false) $class_key = 'current';
                        elseif (strpos($link, 'prev') !== false) $class_key = 'prev';
                        elseif (strpos($link, 'next') !== false) $class_key = 'next';
                        elseif (strpos($link, 'dots') !== false) $class_key = 'dots';

                        echo '<li>' . str_replace(
                            ['class="page-numbers"', 'class="page-numbers current"', 'class="prev page-numbers"', 'class="next page-numbers"', 'class="page-numbers dots"'],
                            sprintf('class="%s"', $button_classes[$class_key]),
                            $link
                        ) . '</li>';
                    }
                    ?>
                </ul>
            </nav>
        </div>
<?php endif;
}
?>

<?php get_footer(); ?>
