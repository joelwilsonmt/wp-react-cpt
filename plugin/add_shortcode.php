<?php
cLog("adding shortcode");
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

    foreach ($posts as $post) {
        // Standard post data
        $post_data = array(
            'ID' => $post->ID,
            'title' => get_the_title($post->ID),
            // Add any other post properties you want to include
        );

        // Retrieve ACF fields for the current post
        $custom_fields = get_fields($post->ID);

        // Merge standard post data with custom fields
        $prepared_post = array_merge($post_data, $custom_fields);

        // Append to the prepared posts array
        $prepared_posts[] = $prepared_post;
    }

    // Enqueue the built React Javascript file
    wp_enqueue_script('custom-post-display', plugins_url('includes/js/main.js', __FILE__), array(), null, true);

    // Pass data to JavaScript
    wp_add_inline_script('custom-post-display', 'window.' . $postTypeDTOName . ' = ' . json_encode($prepared_posts) . ';', 'before');

    return '<div id="' . $reactEntryPointId .'"></div>';
}
add_shortcode($shortcodeName, 'display_custom_posts_shortcode');
?>
