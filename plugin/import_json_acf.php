<?php

function register_cpts_from_json() {
    $post_type = dirname(__FILE__) . '/json/custom-post-type.json';
    $post_type_json = file_get_contents($post_type);
    $post_type_config = json_decode($post_type_json, true);

    // Check if the decoding was successful
    if ($post_type_config) {
        if (isset($post_type_config['post_type'])) {
            register_post_type($post_type_config['post_type'], $post_type_config);
        }
    } else {
        error_log('Failed to decode JSON for custom post types.');
    }
}

add_action('init', 'register_cpts_from_json');


function add_custom_fields() {
    $custom_fields = dirname(__FILE__) . '/json/custom-post-type-fields.json';
    $custom_fields_json = file_get_contents($custom_fields);
    $custom_fields_config = json_decode($custom_fields_json, true);

    if (!acf_get_field_group($custom_fields_config['key'])) {
        acf_import_field_group($custom_fields_config);
    }
}

add_action('acf/init', 'add_custom_fields');
?>
