<?php

function my_acf_google_map_api( $api ){
    $api_key = get_field('google_maps_api_key', 'option');

    if (!empty($api_key)) {
        $api['key'] = $api_key;
    }
    return $api;
}

add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');

?>
