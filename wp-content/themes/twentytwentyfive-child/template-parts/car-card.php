<div class="flex flex-col justify-between car-card bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300">
    <div class="relative">
        <?php
        $car_images = get_post_meta(get_the_ID(), '_car_images', true) ?: '53';
        $car_styling = 'w-full h-56 object-cover transform hover:scale-105 transition-transform duration-500';
        if ($car_images) {
            $image_ids = explode(',', $car_images);
            if (!empty($image_ids[0])) {
                echo wp_get_attachment_image($image_ids[0], 'large', false, array(
                    'class' => $car_styling
                ));
            }
        }

        // Featured badge
        if (get_post_meta(get_the_ID(), 'featured_car', true)): ?>
            <div class="featured-badge absolute top-4 left-4 px-3 py-1 rounded-full text-sm font-semibold text-white">
                Featured
            </div>
        <?php endif; ?>

        <?php // Sale badge
        if (get_post_meta(get_the_ID(), 'on_sale', true)): ?>
            <div class="sale-badge absolute top-4 right-4 px-3 py-1 rounded-full text-sm font-semibold text-white">
                Sale
            </div>
        <?php endif; ?>
    </div>

    <div class="p-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-2 hover:text-blue-600 transition-colors">
            <?php the_title(); ?>
        </h2>

        <div class="grid grid-cols-3 gap-4 mb-4 text-sm">
            <div class="flex items-center text-gray-600">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
                <span><?php echo get_post_meta(get_the_ID(), 'model', true); ?></span>
            </div>
            <div class="flex items-center text-gray-600">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                </svg>
                <span><?php echo get_post_meta(get_the_ID(), 'engine_size', true); ?></span>
            </div>
            <div class="flex items-center text-gray-600">
                <svg class="w-5 h-5 mr-2" xmlns=" http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-palette">
                    <circle cx="13.5" cy="6.5" r=".5" fill="currentColor" />
                    <circle cx="17.5" cy="10.5" r=".5" fill="currentColor" />
                    <circle cx="8.5" cy="7.5" r=".5" fill="currentColor" />
                    <circle cx="6.5" cy="12.5" r=".5" fill="currentColor" />
                    <path d="M12 2C6.5 2 2 6.5 2 12s4.5 10 10 10c.926 0 1.648-.746 1.648-1.688 0-.437-.18-.835-.437-1.125-.29-.289-.438-.652-.438-1.125a1.64 1.64 0 0 1 1.668-1.668h1.996c3.051 0 5.555-2.503 5.555-5.554C21.965 6.012 17.461 2 12 2z" />
                </svg>
                <span><?php echo get_post_meta(get_the_ID(), 'engine_size', true); ?></span>
            </div>

        </div>

        <div class="flex justify-between items-end mt-6">
            <div>
                <?php if (get_post_meta(get_the_ID(), 'on_sale', true)): ?>
                    <p class="text-sm text-gray-500 line-through">
                        £<?php echo number_format(get_post_meta(get_the_ID(), 'original_price', true)); ?>
                    </p>
                <?php endif; ?>
                <p class="price-tag text-3xl font-bold text-green-600">
                    £<?php echo number_format(get_post_meta(get_the_ID(), 'price', true)); ?>
                </p>
            </div>
            <a href="<?php the_permalink(); ?>"
                class="inline-flex items-center p-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-300"
                title="View Details">
                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search">
                    <circle cx="11" cy="11" r="8" />
                    <path d="m21 21-4.3-4.3" />
                </svg>
            </a>
        </div>
    </div>
</div>
