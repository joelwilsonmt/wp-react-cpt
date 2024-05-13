<?php
// Enqueue JavaScript File
function display_custom_posts_shortcode() {
  global $postTypeSlug, $shortcodeName, $postTypeDTOName, $reactEntryPointId;
    // Query the custom posts
   $args = array(
        'numberposts' => -1, // Adjust as needed
        'post_type'   => $postTypeSlug, // Replace with your custom post type
        'post_status' => 'publish' // Only retrieve published posts
    );

    $posts = get_posts($args);
    $prepared_posts = array();
    if($posts){
         foreach ($posts as $post) {
        // Standard post data
            $post_data = array(
                'ID' => $post->ID,
                'title' => get_the_title($post->ID),
                // Add any other post properties you want to include
            );

            $custom_fields = get_fields($post->ID);

            $custom_fields_with_names = [];
            if ($custom_fields) {
                foreach ($custom_fields as $field_key => $field_value) {
                    // Retrieve field object to ensure the name is used as a key
                    $field_object = get_field_object($field_key, $post->ID);
                    if ($field_object) {
                        // Use the field name from the field object as the key
                        $custom_fields_with_names[$field_object['label']] = $field_object;
                    }
                }
            }
            $prepared_post = array_merge($post_data, $custom_fields_with_names);

            // Append to the prepared posts array
            $prepared_posts[] = $prepared_post;
        }
    }

    $options_data = get_fields('options');

    $options_fields = dirname(__FILE__) . '/json/options-page.json';
    $options_fields_contents = file_get_contents($options_fields);
    $options_fields_json = json_decode($options_fields_contents , true);

    if ($options_data) {
        // Optionally, process options data if needed or just add to output directly
        $prepared_options = [];
        foreach ($options_data as $key => $value) {
            $field_object = get_field_object($key, 'option');
            if($field_object['name'] == "google_maps_api_key"){
                // do not include in array
            }
            else {
                $prepared_options[$key] = $field_object;
            }
        }
    }

    $data = array(
        'posts'   => $prepared_posts,
        'options' => $prepared_options
    );


    // Enqueue the built React Javascript file
    wp_enqueue_script('custom-post-display', plugins_url('includes/js/main.js', __FILE__), array(), null, true);

    // Pass data to JavaScript
    wp_add_inline_script('custom-post-display', 'window.' . $postTypeDTOName . ' = ' . json_encode($data) . ';', 'before');

    return '<div id="' . $reactEntryPointId .'"></div>';
}
add_shortcode($shortcodeName, 'display_custom_posts_shortcode');
?>
