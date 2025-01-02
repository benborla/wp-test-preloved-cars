<?php

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
}
