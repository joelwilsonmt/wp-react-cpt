<?php

cLog("Add extra fields running...");

function create_acf_field_group($key, $title, array $fields, $postTypeSlug, $menu_order = 0, $description = '') {
    return [
        'key' => $key,
        'title' => $title,
        'fields' => $fields,
        'location' => [
            [
                ['param' => 'post_type', 'operator' => '==', 'value' => $postTypeSlug],
            ],
        ],
        'menu_order' => $menu_order,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => [],
        'active' => true,
        'description' => $description,
    ];
}



function create_acf_field_groups() {
  global $postTypeSlug, $fieldGroups;

  if( function_exists('acf_add_local_field_group') ):

  // Iterate through each field group definition
  foreach ($fieldGroups as $group) {

    $group = create_acf_field_group($group['key'], $group['title'], $group['fields'], $postTypeSlug);

    // TODO: possible redundancy here if multiple groups contain google maps fields
    // if group contains google maps field, add google maps API key:
    foreach ($group['fields'] as $field) {
      if ($field['type'] == 'google_map') {
        add_filter('acf/fields/google_map/api', function($api) use ($field) {
          $api['key'] = $field['googleMapsAPIKey'];
          cLog("Adding Google Maps API key to ACF field group " . $field['googleMapsAPIKey'] . " <- should have value here");
          return $api;
        });
      }
    }

    acf_add_local_field_group($group);
  }

  else:
      cLog("Failed to create ACF field groups: ACF is not active.");

  endif;

}

add_action('acf/init', 'create_acf_field_groups');

?>
