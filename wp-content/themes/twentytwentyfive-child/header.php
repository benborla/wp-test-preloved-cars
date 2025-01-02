<?php

/**
 * The header template
 *
 * @package Twenty_Twenty_Five_Child
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>

    <header class="bg-white shadow">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <!-- Left side: Page Title -->
                <div class="flex-shrink-0">
                    <h1 class="cursor-pointer text-2xl font-semibold text-gray-800">
                        <?= __('Preloved Cars'); ?>
                    </h1>
                </div>

                <!-- Right side: Navigation -->
                <nav class="hidden md:flex space-x-8">
                    <a href="<?php echo home_url(); ?>" class="text-gray-600 hover:text-gray-900">Home</a>
                    <a href="#" class="text-gray-600 hover:text-gray-900">Posts</a>
                    <a href="#" class="text-gray-600 hover:text-gray-900">About</a>
                </nav>

                <!-- Mobile menu button -->
                <div class="md:hidden">
                    <button type="button" class="mobile-menu-button text-gray-600 hover:text-gray-900" aria-label="Toggle menu">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile menu -->
            <div class="md:hidden hidden mobile-menu">
                <div class="px-2 pt-2 pb-3 space-y-1">
                    <a href="<?php echo home_url(); ?>" class="block px-3 py-2 text-gray-600 hover:text-gray-900">Home</a>
                    <a href="#" class="block px-3 py-2 text-gray-600 hover:text-gray-900">Posts</a>
                    <a href="#" class="block px-3 py-2 text-gray-600 hover:text-gray-900">About</a>
                </div>
            </div>
        </div>
    </header>
