<?php

cLog("save custom global loaded");

function my_acf_render_field( $field ) {
    if($field['save_custom'] && $field['allow_custom']){
        cLog("rendering field with save_custom " . $field['label']);
    }
}

// Apply to all fields.
add_action('acf/render_field', 'my_acf_render_field');

function acf_save_global_custom_choices($post_id) {
    // Prevent function from running during autosave or without proper permissions
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE || !current_user_can('edit_post', $post_id)) {
        return;
    }

    // Ensure ACF data is set
    if (empty($_POST['acf'])) {
        return;
    }

    $acf_data = $_POST['acf'];
    foreach ($acf_data as $field_key => $value) {
        $field_object = get_field_object($field_key);

        if ($field_object && !empty($field_object['allow_custom']) && $field_object['allow_custom']) {
            // Check for existing choices
            $existing_choices = $field_object['choices'];

            // Convert all values to an array if not already (for select, checkbox, etc.)
            if (!is_array($value)) {
                $value = [$value];
            }

            $updated = false;
            foreach ($value as $input_choice) {
                if (!isset($existing_choices[$input_choice])) {
                    // If 'save_custom' is enabled and the choice isn't already saved, save it
                    if (!empty($field_object['save_custom'])) {
                        $existing_choices[$input_choice] = $input_choice;
                        $updated = true;
                    }
                }
            }

            // If new choices were added and need to be saved back to the field's definition
            if ($updated) {
                $field_object['choices'] = $existing_choices;
                acf_update_field($field_object); // Save the updated field with new choices
            }
        }
    }
}

add_action('acf/save_post', 'acf_save_global_custom_choices', 20);

?>
