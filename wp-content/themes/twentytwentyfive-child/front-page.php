<?php
/* Template Name: Preloved Cars Homepage */
get_header();

$paged = get_query_var('page') ?: 1;
$on_sale  = (bool) sanitize_text_field($_GET['on_sale'] ?? '0') ?: false;
$color = sanitize_text_field($_GET['color'] ?? '') ?: null;

$cars_query_args = Theme_Helper::get_cars_query_with_filters($on_sale, $color);
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
                                <?php the_post_thumbnail('medium', ['class' => 'w-full h-[14.3rem] object-cover']); ?>
                            </div>
                        <?php else: ?>
                            <div class="aspect-w-16 aspect-h-9">
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

        <div class="mt-16 mb-10">
            <div class="flex items-center justify-between">
                <h2 id="available_cars" class="text-2xl font-bold text-gray-800">Available Cars</h2>

                <div class="flex items-center gap-4">
                    <form action="/#available_cars" method="GET" class="flex items-center gap-4">
                        <div>
                            <select id="color" name="color" class="bg-gray-50 border border-gray-301 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <option value="" selected>Choose a color</option>
                                <?php foreach (Theme_Helper::get_field_values('color') as $selection_color): ?>
                                    <option value="<?= $selection_color ?>" <?= $selection_color === $color ? 'selected' : '' ?>><?= $selection_color ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <label class="inline-flex items-center cursor-pointer">
                            <input type="checkbox" value="1" class="sr-only peer" name="on_sale" <?= !$on_sale ?: 'checked' ?>>
                            <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600">
                            </div>
                            <span class="ms-3 text-sm font-medium text-gray-900">On Sale</span>
                        </label>

                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300">
                            Apply
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <?php if ($cars_query->have_posts()) : ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php
                while ($cars_query->have_posts()) : $cars_query->the_post();
                    get_template_part('template-parts/car-card');
                    get_template_part('template-parts/car-details-modal');
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

    $paginate_links = paginate_links(Theme_Helper::pagination_links($query));

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
                            sprintf('class="%s"', Theme_Helper::pagination_button_classes()[$class_key]),
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
