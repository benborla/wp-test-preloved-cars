<?php get_header(); ?>

<div class="bg-gray-100 min-h-screen py-12">
    <div class="container mx-auto px-4">
        <div class="bg-white rounded-lg shadow-lg p-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <!-- @INFO: Image Gallery -->
                <div class="space-y-4">
                    <?php
                    $car_images = get_post_meta(get_the_ID(), '_car_images', true);
                    if ($car_images) {
                        $image_ids = explode(',', $car_images);
                        foreach ($image_ids as $image_id) {
                            echo wp_get_attachment_image($image_id, 'large', false, array(
                                'class' => 'w-full rounded-lg shadow-md'
                            ));
                        }
                    }
                    ?>
                </div>

                <!-- @INFO: Car Details -->
                <div>
                    <h1 class="text-4xl font-bold text-gray-800 mb-6"><?php the_title(); ?></h1>

                    <div class="space-y-4 text-gray-600 mb-8">
                        <div class="flex items-center border-b pb-2">
                            <span class="font-semibold w-32">Model:</span>
                            <span><?php echo get_post_meta(get_the_ID(), 'model', true); ?></span>
                        </div>
                        <div class="flex items-center border-b pb-2">
                            <span class="font-semibold w-32">Engine Size:</span>
                            <span><?php echo get_post_meta(get_the_ID(), 'engine_size', true); ?></span>
                        </div>
                        <div class="flex items-center border-b pb-2">
                            <span class="font-semibold w-32">Year:</span>
                            <span><?php echo get_post_meta(get_the_ID(), 'year_of_manufacture', true); ?></span>
                        </div>
                    </div>

                    <div class="mb-8">
                        <p class="text-5xl font-bold text-green-600">£<?php echo number_format(get_post_meta(get_the_ID(), 'price', true)); ?></p>
                    </div>

                    <div class="prose max-w-none">
                        <?php the_content(); ?>
                    </div>

                    <div class="mt-8">
                        <a href="#" class="inline-block bg-blue-600 text-white px-8 py-3 rounded-lg text-lg hover:bg-blue-700 transition-colors duration-300">Contact Seller</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>