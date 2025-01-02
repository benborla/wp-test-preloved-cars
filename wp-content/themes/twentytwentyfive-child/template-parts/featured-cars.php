<?php
$featured_cars = new WP_Query([
    'post_type' => 'car',
    'posts_per_page' => 3,
    'meta_key' => 'featured_car',
    'meta_value' => '1'
]);

if ($featured_cars->have_posts()): ?>
    <div class="featured-cars">
        <h2 class="text-2xl font-bold text-gray-800 mb-8">Featured Cars</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <?php while ($featured_cars->have_posts()): $featured_cars->the_post(); ?>
                <div class="relative bg-white rounded-lg shadow-lg overflow-hidden">
                    <?php
                    $car_images = get_post_meta(get_the_ID(), '_car_images', true) ?: Theme_Helper::no_image_placeholder();
                    if ($car_images) {
                        $image_ids = explode(',', $car_images);
                        if (!empty($image_ids[0])) {
                            echo wp_get_attachment_image($image_ids[0], 'large', false, array(
                                'class' => 'w-full h-64 object-cover'
                            ));
                        }
                    }
                    ?>
                    <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black to-transparent p-6">
                        <h3 class="text-xl font-bold text-white"><?php the_title(); ?></h3>
                    </div>
                    <p class="text-white text-lg">£<?php echo number_format(get_post_meta(get_the_ID(), 'price', true)); ?></p>
                </div>
            <?php endwhile;
            wp_reset_postdata(); ?>
        </div>
    </div>
<?php endif; ?>
