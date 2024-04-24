<?php


$path = dirname(__FILE__) . '/pluginConfig.json';
$jsonString = file_get_contents($path);
$pluginConfig = json_decode($jsonString, true);

$pluginName = $pluginConfig['pluginName'];
$pluginURI = $pluginConfig['pluginURI'];
$pluginAuthor = $pluginConfig['pluginAuthor'];
$pluginVersion = $pluginConfig['pluginVersion'];
$postTypeName = $pluginConfig['postTypeName'];
$postTypePluralName = $pluginConfig['postTypePluralName'];
$postTypeSlug = $pluginConfig['postTypeSlug'];
$postTypeDescription = $pluginConfig['postTypeDescription'];
$postTypeDTOName = $pluginConfig['postTypeDTOName'];
$fields = $pluginConfig['fields'];  // This is an array
$shortcodeName = $pluginConfig['shortcodeName'];
$reactEntryPointId = $pluginConfig['reactEntryPointId'];

/*
Plugin Name: Plugin Name
Plugin URI: Plugin URI
Description: Plugin Description
Author: Plugin Author
Version: 1.0.1
Author URI: Author URI
*/

function register_my_custom_post_type() {
  global $postTypeName, $postTypePluralName, $postTypeSlug, $postTypeDescription;
  $labels = array(
        'name'                  => _x($postTypePluralName, 'Post type general name', 'textdomain'),
        'singular_name'         => _x($postTypeName, 'Post type singular name', 'textdomain'),
        'menu_name'             => _x($postTypePluralName, 'Admin Menu text', 'textdomain'),
        'name_admin_bar'        => _x($postTypeName, 'Add New on Toolbar', 'textdomain'),
        'add_new'               => __('Add New', 'textdomain'),
        'add_new_item'          => __('Add New ' . $postTypeName, 'textdomain'),
        'new_item'              => __('New ' . $postTypeName, 'textdomain'),
        'edit_item'             => __('Edit ' . $postTypeName, 'textdomain'),
        'view_item'             => __('View ' . $postTypeName, 'textdomain'),
        'all_items'             => __('All ' . $postTypePluralName, 'textdomain'),
        'search_items'          => __('Search ' . $postTypePluralName, 'textdomain'),
        'parent_item_colon'     => __('Parent ' . $postTypePluralName . ':', 'textdomain'),
        'not_found'             => __('No ' . $postTypePluralName . ' found.', 'textdomain'),
        'not_found_in_trash'    => __('No ' . $postTypePluralName . ' found in Trash.', 'textdomain'),
        'featured_image'        => _x($postTypeName . ' Cover Image', 'Overrides the “Featured Image” phrase', 'textdomain'),
        'set_featured_image'    => _x('Set cover image', 'Overrides the “Set featured image” phrase', 'textdomain'),
        'remove_featured_image' => _x('Remove cover image', 'Overrides the “Remove featured image” phrase', 'textdomain'),
        'use_featured_image'    => _x('Use as cover image', 'Overrides the “Use as featured image” phrase', 'textdomain'),
        'archives'              => _x($postTypeName . ' Archives', 'The post type archive label used in nav menus', 'textdomain'),
        'insert_into_item'      => _x('Insert into custom post', 'Overrides the “Insert into post” phrase', 'textdomain'),
        'uploaded_to_this_item' => _x('Uploaded to this custom post', 'Overrides the “Uploaded to this post” phrase', 'textdomain'),
        'filter_items_list'     => _x('Filter ' . $postTypePluralName . ' list', 'Screen reader text for the filter links', 'textdomain'),
        'items_list_navigation' => _x($postTypePluralName . ' list navigation', 'Screen reader text for pagination', 'textdomain'),
        'items_list'            => _x($postTypePluralName . ' list', 'Screen reader text for the items list', 'textdomain'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => $postTypeSlug),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments')
    );

    register_post_type($postTypeName, $args);
}
add_action('init', 'register_my_custom_post_type');

// Enqueue JavaScript File
function display_custom_posts_shortcode() {
  global $postTypeName, $shortcodeName, $postTypeDTOName, $reactEntryPointId;
    // Query the custom posts
    $query = new WP_Query(array(
        'post_type' => $postTypeName,
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
