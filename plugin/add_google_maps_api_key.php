<?php

cLog("Add google maps api key running...");

add_filter('acf/fields/google_map/api', function($api) {
  $api['key'] = $googleMapsAPIKey;
  cLog("Adding Google Maps API key to ACF field group " . $googleMapsAPIKey . " <- should have value here");
  return $api;
});

?>
