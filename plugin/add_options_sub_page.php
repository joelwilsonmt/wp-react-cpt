<?php
if (function_exists('acf_add_options_sub_page')) {
    global $post_type_config;
    acf_add_options_sub_page(array(
        'page_title' => $post_type_config['title'] . ' Settings',
        'menu_title' => $post_type_config['title'] . ' Settings',
        'parent_slug' => 'edit.php?post_type=' . $post_type_config['post_type'],
        'menu_slug' => $post_type_config['post_type'] . '-options',
    ));
}

function add_options_fields() {
    $options_fields = dirname(__FILE__) . '/json/options-page.json';
    $options_fields_json = file_get_contents($options_fields);
    $options_fields_config = json_decode($options_fields_json, true);

    if (!acf_get_field_group($options_fields_config['key'])) {
        acf_import_field_group($options_fields_config);
    }
}

add_action('acf/init', 'add_options_fields');
?>
