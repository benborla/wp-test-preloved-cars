<?php

use WP_Query;

class Theme_Helper
{
    /**
     * @return string
     */
    public static function version()
    {
        dump('v0.0.1');
    }

    /**
     * @var string $field_name
     *
     * @return string[]
     */
    public static function get_field_values($field_name): array
    {
        global $wpdb;
        $meta_key = $field_name;
        $values = $wpdb->get_col(
            $wpdb->prepare(
                "SELECT DISTINCT meta_value FROM {$wpdb->postmeta} WHERE meta_key = %s",
                $meta_key
            )
        );
        return array_filter($values);
    }

    /**
     * @var ?bool $on_sale
     * @var ?string $color
     *
     * @return string[]
     */
    public static function get_cars_query_with_filters(string $on_sale = null, string $color = null): array
    {
        $paged = get_query_var('page') ?: 1;
        $on_sale = (bool) sanitize_text_field($on_sale) ?: null;
        $color = sanitize_text_field($color) ?: null;

        $meta_conditions = [];

        if ($color || $on_sale !== null) {
            $meta_conditions['relation'] = 'AND';
        }

        if ($color) {
            $meta_conditions['color'] = [
                'key' => 'color',
                'value' => $color,
                'compare' => '='
            ];
        }

        if ($on_sale !== null) {
            $meta_conditions['on_sale'] = [
                'key' => 'on_sale',
                'value' => (bool) $on_sale,
                'compare' => '='
            ];
        }

        return [
            'post_type' => 'car',
            'posts_per_page' => 6,
            'paged' => $paged,
            'no_found_rows' => false,
            'update_post_meta_cahe' => true,
            'update_post_term_cache' => true,
            'orderby' => 'post_date',
            'order' => 'DESC',
            'meta_query' => $meta_conditions
        ];
    }

    /**
     * @return string[]
     */
    public static function pagination_button_classes(): array
    {
        return [
            'current' => 'flex items-center justify-center px-4 h-10 text-blue-600 border border-gray-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white',
            'prev' => 'flex items-center justify-center px-4 h-10 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white',
            'next' => 'flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white',
            'dots' => 'flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white',
            'default' => 'flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white'
        ];
    }

    /**
     * @var \WP_Query $query
     * @return string[]
     */
    public static function pagination_links(WP_Query $query): array
    {
        return [
            'base' => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999) . '#available_cars')),
            'format' => '?paged=%#%',
            'current' => max(1, get_query_var('page')),
            'total' => $query->max_num_pages,
            'prev_text' => esc_html__('« Previous', ''),
            'next_text' => esc_html__('Next »', ''),
            'type' => 'array',
            'end_size' => 2,
            'mid_size' => 2
        ];
    }
}
