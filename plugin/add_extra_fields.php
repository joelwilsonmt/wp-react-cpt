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


$fields = [
    [
        'key' => 'field_1',
        'label' => 'Text Field',
        'name' => 'text_field',
        'type' => 'text',
        'instructions' => 'Enter some text.',
        'required' => 1,
    ],
    [
        'key' => 'field_2',
        'label' => 'Number Field',
        'name' => 'number_field',
        'type' => 'number',
        'instructions' => 'Enter a number.',
        'required' => 0,
    ],
    [
        'key' => 'field_3',
        'label' => 'Date Picker',
        'name' => 'date_picker',
        'type' => 'date_picker',
        'instructions' => 'Select a date.',
        'required' => 0,
        'display_format' => 'd/m/Y',
        'return_format' => 'd/m/Y',
    ],
];



function create_acf_field_groups() {
  global $postTypeSlug, $fieldGroups;

  if( function_exists('acf_add_local_field_group') ):

    cLog("field groups" . $fieldGroups);

  // Iterate through each field group definition
  foreach ($fieldGroups as $group) {

    $group = create_acf_field_group($group['key'], $group['title'], $group['fields'], $postTypeSlug);

    acf_add_local_field_group($group);
  }



  // // $field_group = create_acf_field_group('testaabbssdsdkj', 'Test Group', $fields, $postTypeSlug);

  // // acf_add_local_field_group($field_group);

  // cLog("Custom post field added for value => " . $postTypeSlug);

  else:
      cLog("Failed to create ACF field groups: ACF is not active.");

  endif;

}

add_action('acf/init', 'create_acf_field_groups');

?>
