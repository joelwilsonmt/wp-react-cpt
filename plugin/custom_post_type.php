<?php

cLog("Registering custom post type");

function register_my_custom_post_type() {
  global $postTypeSingularName, $postTypePluralName, $postTypeSlug, $postTypeDescription;
  $labels = array(
        'name'                  => _x($postTypePluralName, 'Post type general name', 'textdomain'),
        'singular_name'         => _x($postTypeSingularName, 'Post type singular name', 'textdomain'),
        'menu_name'             => _x($postTypePluralName, 'Admin Menu text', 'textdomain'),
        'name_admin_bar'        => _x($postTypeSingularName, 'Add New on Toolbar', 'textdomain'),
        'add_new'               => __('Add New', 'textdomain'),
        'add_new_item'          => __('Add New ' . $postTypeSingularName, 'textdomain'),
        'new_item'              => __('New ' . $postTypeSingularName, 'textdomain'),
        'edit_item'             => __('Edit ' . $postTypeSingularName, 'textdomain'),
        'view_item'             => __('View ' . $postTypeSingularName, 'textdomain'),
        'all_items'             => __('All ' . $postTypePluralName, 'textdomain'),
        'search_items'          => __('Search ' . $postTypePluralName, 'textdomain'),
        'parent_item_colon'     => __('Parent ' . $postTypePluralName . ':', 'textdomain'),
        'not_found'             => __('No ' . $postTypePluralName . ' found.', 'textdomain'),
        'not_found_in_trash'    => __('No ' . $postTypePluralName . ' found in Trash.', 'textdomain'),
        'featured_image'        => _x($postTypeSingularName . ' Cover Image', 'Overrides the “Featured Image” phrase', 'textdomain'),
        'set_featured_image'    => _x('Set cover image', 'Overrides the “Set featured image” phrase', 'textdomain'),
        'remove_featured_image' => _x('Remove cover image', 'Overrides the “Remove featured image” phrase', 'textdomain'),
        'use_featured_image'    => _x('Use as cover image', 'Overrides the “Use as featured image” phrase', 'textdomain'),
        'archives'              => _x($postTypeSingularName . ' Archives', 'The post type archive label used in nav menus', 'textdomain'),
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
        'exclude_from_search' => false,
        'can_export'         => true,
        // can support: ‘title’ ‘editor’ (content) ‘author’ ‘thumbnail’ (featured image), ‘excerpt’, ‘trackbacks’, ‘custom-fields’, ‘comments’,
        // ‘revisions’ (will store revisions), ‘page-attributes’ (template and menu order) (hierarchical must be true) ‘post-formats’
        'supports'           => array('title', 'editor', 'thumbnail', 'author'),
        'taxonomies'         => array('category', 'post_tag'),
    );

    register_post_type($postTypeSlug, $args);
}
add_action('init', 'register_my_custom_post_type');

?>
