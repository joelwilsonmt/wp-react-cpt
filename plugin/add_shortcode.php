<?php
cLog("adding shortcode");
// Enqueue JavaScript File
function display_custom_posts_shortcode() {
  global $postTypeSingularName, $shortcodeName, $postTypeDTOName, $reactEntryPointId;
    // Query the custom posts
    $query = new WP_Query(array(
        'post_type' => $postTypeSingularName,
        'posts_per_page' => -1  // Retrieve all posts; adjust as needed or use a setting
    ));

    // Prepare data for JavaScript
    $posts = array();
    while ($query->have_posts()) {
        $query->the_post();
        $posts[] = array(
            'id' => get_the_ID(),
            'title' => get_the_title(),
            'content' => get_the_content()
        );
    }

    // Enqueue a JavaScript file (if needed for further manipulation)
    wp_enqueue_script('custom-post-display', plugins_url('includes/js/main.js', __FILE__), array(), null, true);

    // Pass data to JavaScript
    wp_add_inline_script('custom-post-display', 'window.' . $postTypeDTOName . ' = ' . json_encode($posts) . ';', 'before');

    return '<div id="' . $reactEntryPointId .'"></div>';
}
add_shortcode($shortcodeName, 'display_custom_posts_shortcode');
?>
