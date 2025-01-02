<?php

require_once get_stylesheet_directory() . '/car-post-type.php';

function cars_enqueue_assets()
{
    // Tailwind
    wp_enqueue_script('tailwind', 'https://cdn.tailwindcss.com');
    wp_enqueue_style('twentytwentyfive-child', get_stylesheet_uri());
    wp_enqueue_style('twentytwentyfive', get_template_directory_uri() . '/style.css');

    // Enqueue Owl Carousel CSS
    wp_enqueue_style('owl-carousel', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css');
    wp_enqueue_style('owl-theme', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css');
    wp_enqueue_script('owl-carousel', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js', ['jquery'], null, true);
    wp_enqueue_script('custom-carousel', get_stylesheet_directory_uri() . '/js/carousel.js', ['jquery', 'owl-carousel'], null, true);

    // Theme JS
    wp_enqueue_script('cars-js', get_stylesheet_directory_uri() . '/js/cars.js', ['cars'], '1.0', true);
}


function add_car_images_meta_box()
{
    add_meta_box(
        'car_images_meta_box',
        'Car Images',
        'display_car_images_meta_box',
        'car',
        'normal',
        'high',
    );
}

// Display Meta Box content
function display_car_images_meta_box($post)
{
    wp_nonce_field('car_images_meta_box', 'car_images_meta_box_nonce');

    // Get existing images if any
    $car_images = get_post_meta($post->ID, '_car_images', true);
?>
    <div id="car_images_container">
        <input type="hidden" id="car_images" name="car_images" value="<?php echo esc_attr($car_images); ?>">
        <button type="button" class="button" id="upload_car_images_button">Upload Images</button>
        <div id="car_images_preview" class="car-images-preview">
            <?php
            if ($car_images) {
                $image_ids = explode(',', $car_images);
                foreach ($image_ids as $image_id) {
                    echo wp_get_attachment_image($image_id, 'thumbnail');
                }
            }
            ?>
        </div>
    </div>

    <script>
        jQuery(document).ready(function($) {
            var mediaUploader;

            $('#upload_car_images_button').click(function(e) {
                e.preventDefault();

                if (mediaUploader) {
                    mediaUploader.open();
                    return;
                }

                mediaUploader = wp.media({
                    title: 'Select Car Images',
                    button: {
                        text: 'Use these images'
                    },
                    multiple: true
                });

                mediaUploader.on('select', function() {
                    var attachments = mediaUploader.state().get('selection').map(function(attachment) {
                        attachment = attachment.toJSON();
                        return attachment.id;
                    });

                    $('#car_images').val(attachments.join(','));

                    // Update preview
                    var previewHtml = '';
                    attachments.forEach(function(id) {
                        previewHtml += '<img src="' + wp.media.attachment(id).get('url') + '" width="150" height="150" style="margin:5px">';
                    });
                    $('#car_images_preview').html(previewHtml);
                });

                mediaUploader.open();
            });
        });
    </script>

    <style>
        .car-images-preview {
            margin-top: 10px;
        }

        .car-images-preview img {
            margin: 5px;
            max-width: 150px;
            height: auto;
        }
    </style>
<?php
}

function save_car_images_meta_box($post_id)
{
    if (!isset($_POST['car_images_meta_box_nonce'])) {
        return;
    }

    if (!wp_verify_nonce($_POST['car_images_meta_box_nonce'], 'car_images_meta_box')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (isset($_POST['car_images'])) {
        update_post_meta($post_id, '_car_images', sanitize_text_field($_POST['car_images']));
    }
}

function register_footer_menu()
{
    register_nav_menus(array(
        'footer-menu' => 'Footer Menu'
    ));
}

add_action('add_meta_boxes', 'add_car_images_meta_box');
add_action('wp_enqueue_scripts', 'cars_enqueue_assets');
add_action('save_post_car', 'save_car_images_meta_box');
add_action('after_setup_theme', 'register_footer_menu');
