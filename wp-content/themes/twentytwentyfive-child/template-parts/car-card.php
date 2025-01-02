<?php
$id = get_the_ID();
$isOnSale = (bool) get_post_meta($id, 'on_sale', true) ?: false;
$isFeatured = (bool) get_post_meta($id, 'featured_car', true) ?: false;
$isFeatureButNotOnSale = !$isOnSale && $isFeatured;
$originalPrice = number_format(get_post_meta($id, 'original_price', true));
$currentPrice = number_format(get_post_meta($id, 'price', true));
$tagPositionOnFeature = $isFeatureButNotOnSale ? 'right-1' : 'right-16';
$fixedColors = ['white', 'black'];
$color = strtolower(get_post_meta(get_the_ID(), 'color', true));
$color .= in_array($color, $fixedColors) ? '' : '-600';


?>
<div class="flex flex-col justify-between car-card bg-gray-500 dark:bg-gray-700 rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300">
    <div class="relative">
        <?php
        $car_images = get_post_meta(get_the_ID(), '_car_images', true) ?: '53';
        $car_styling = 'w-full h-56 object-cover transform hover:scale-105 transition-transform duration-500';
        if ($car_images) {
            $image_ids = explode(',', $car_images);
            if (!empty($image_ids[0])) {
                echo wp_get_attachment_image($image_ids[0], 'large', false, [
                    'class' => $car_styling
                ]);
            }
        }

        // Featured badge
        if ($isFeatured): ?>
            <div class="gap-2 featured-badge absolute top-4 <?= $tagPositionOnFeature ?> px-3 py-1 rounded-full text-sm font-semibold text-white">
                <span class="inline-flex gap-2 items-center justify-center bg-indigo-600 text-pink-800 text-md font-medium me-2 px-2.5 py-0.5 rounded text-white font-extrabold uppercase">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#F4FF00" stroke="#F4FF00" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-sparkles">
                        <path d="M9.937 15.5A2 2 0 0 0 8.5 14.063l-6.135-1.582a.5.5 0 0 1 0-.962L8.5 9.936A2 2 0 0 0 9.937 8.5l1.582-6.135a.5.5 0 0 1 .963 0L14.063 8.5A2 2 0 0 0 15.5 9.937l6.135 1.581a.5.5 0 0 1 0 .964L15.5 14.063a2 2 0 0 0-1.437 1.437l-1.582 6.135a.5.5 0 0 1-.963 0z" />
                        <path d="M20 3v4" />
                        <path d="M22 5h-4" />
                        <path d="M4 17v2" />
                        <path d="M5 18H3" />
                    </svg>
                    <?= __('featured') ?>
                </span>

            </div>
        <?php endif; ?>

        <?php // Sale badge
        if ($isOnSale): ?>
            <div class="sale-badge absolute top-4 right-1 px-3 py-1 rounded-full text-sm font-semibold text-white">
                <span class="inline-flex bg-red-600 text-pink-800 text-md font-medium me-2 px-2.5 py-1 rounded text-white font-extrabold uppercase">
                    <?= __('sale'); ?>
                </span>
            </div>
        <?php endif; ?>
    </div>

    <div class="p-6">
        <h2 class="cursor-default text-2xl font-bold text-gray-800 dark:text-white mb-2 hover:text-blue-200 transition-colors">
            <?= the_title() ?>
        </h2>

        <div class="flex items-between justify-between gap-4 mb-4 text-sm">
            <div class="flex items-center text-gray-600">
                <div class="inline-flex items-center justify-center">
                    <div class="h-6 w-6 bg-<?= $color ?> mr-2 rounded-full">&nbsp;
                    </div>
                    <span><?= get_post_meta(get_the_ID(), 'model', true); ?></span>
                </div>

            </div>
            <div class="flex items-center text-gray-600">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                </svg>
                <span><?= get_post_meta(get_the_ID(), 'engine_size', true); ?></span>
            </div>

        </div>

        <div class="flex justify-between items-end mt-6">
            <div>
                <?php if ($isOnSale): ?>
                    <p class="text-sm text-gray-500 line-through">
                        £<?= number_format(get_post_meta(get_the_ID(), 'original_price', true)); ?>
                    </p>
                <?php endif; ?>
                <p class="price-tag text-3xl font-bold text-green-600">
                    £<?= number_format(get_post_meta(get_the_ID(), 'price', true)); ?>
                </p>
            </div>
            <button data-modal-target="car-details-<?= $id ?>" data-modal-toggle="car-details-<?= $id ?>" data-href="<?php the_permalink(); ?>"
                class="inline-flex items-center p-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-300"
                title="View Details">
                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search">
                    <circle cx="11" cy="11" r="8" />
                    <path d="m21 21-4.3-4.3" />
                </svg>
            </button>
        </div>
    </div>
</div>
