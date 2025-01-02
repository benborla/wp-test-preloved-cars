<?php

/**
 * The template for displaying the footer
 *
 * @package twentytwentyfive-child
 */
?>

<footer class="bg-gray-800 text-white py-8">
    <div class="container mx-auto px-4">
        <div class="text-center">
            <!-- Logo or Site Name -->
            <div class="mb-4">
                <?php bloginfo('name'); ?>
            </div>

            <!-- Simple Menu -->
            <?php
            wp_nav_menu(array(
                'theme_location' => 'footer-menu',
                'menu_class'     => 'flex justify-center space-x-6 mb-4',
                'fallback_cb'    => false,
                'depth'          => 1,
            ));
            ?>

            <!-- Copyright -->
            <div class="text-sm">
                &copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All rights reserved.
            </div>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>

</html>
