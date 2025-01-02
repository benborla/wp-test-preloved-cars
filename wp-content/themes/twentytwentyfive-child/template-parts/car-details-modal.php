<?php
$id = get_the_ID();
$isOnSale = (bool) get_post_meta($id, 'on_sale', true) ?: false;
$fixedColors = ['white', 'black'];
$color = strtolower(get_post_meta($id, 'color', true));
$color .= in_array($color, $fixedColors) ? '' : '-600';

?>

<!-- Main modal -->
<div id="car-details-<?= $id ?>" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    <?= the_title() ?>
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="car-details-<?= $id ?>">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <div class="p-4 md:p-5 space-y-4">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                    <!-- @INFO: Image Gallery -->
                    <div class="space-y-4">
                        <?php
                        $car_images = get_post_meta($id, '_car_images', true);
                        $image_ids = explode(',', $car_images);
                        $image = current($image_ids) ?: '53';
                        echo wp_get_attachment_image($image, 'large', false, array(
                            'class' => 'w-full rounded-lg shadow-md'
                        ));
                        ?>

                    </div>

                    <!-- @INFO: Car Details -->
                    <div>

                        <div class="text-[1rem] space-y-4 text-gray-600 dark:text-white mb-8">
                            <div class="flex items-center pb-2">
                                <span class="font-semibold w-32">Model:</span>
                                <span><?= get_post_meta($id, 'model', true); ?></span>
                            </div>
                            <div class="flex items-center border-b pb-2">
                                <span class="font-semibold w-32">Engine Size:</span>
                                <span><?= get_post_meta($id, 'engine_size', true); ?></span>
                            </div>
                            <div class="flex items-center border-b pb-2">
                                <span class="font-semibold w-32">Year:</span>
                                <span><?= get_post_meta($id, 'year_of_manufacture', true); ?></span>
                            </div>
                            <div class="flex items-center border-b pb-2">
                                <span class="font-semibold w-32">Color:</span>
                                <div class="h-6 w-6 bg-<?= $color ?> mr-2 rounded-full">&nbsp;
                                </div>

                                <span><?= get_post_meta($id, 'color', true); ?></span>
                            </div>

                        </div>

                        <div class="mb-8 text-center">
                            <div>
                                <?php if ($isOnSale): ?>
                                    <p class="text-sm text-gray-500 line-through">
                                        £<?= number_format(get_post_meta($id, 'original_price', true)); ?>
                                    </p>
                                <?php endif; ?>
                                <p class="price-tag text-3xl font-bold text-green-600 dark:text-green-500">
                                    £<?= number_format(get_post_meta($id, 'price', true)); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="prose max-w-none dark:text-white">
                    <?= the_content() ?>
                </div>


            </div>
            <div class="flex items-center justify-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                <button data-modal-hide="static-modal" class="inline-block bg-blue-600 text-white px-8 py-3 rounded-lg text-lg hover:bg-blue-700 transition-colors duration-300">Contact Seller</button>
            </div>
        </div>
    </div>
</div>