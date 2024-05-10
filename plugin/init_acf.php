<?php

if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/** Start: Include ACF */
include_once( plugin_dir_path( __FILE__ ) . 'includes/acf/acf.php' );
require_once( plugin_dir_path( __FILE__ ) . 'includes/acf/pro/acf-pro.php' );

/** Start: Customize ACF path */
// add_filter('acf/settings/path', 'acf_settings_path');
// function acf_settings_path( $path ) {
//   $path = plugin_dir_path( __FILE__ ) . 'includes/acf/';
//   return $path;
// }
// /** End: Customize ACF path */
// /** Start: Customize ACF dir */
// add_filter('acf/settings/url', 'acf_settings_url');
// function acf_settings_url( $path ) {
//   $dir = plugin_dir_url( __FILE__ ) . 'includes/acf/';
//   return $dir;
// }
/** End: Customize ACF path */
/** Start: Hide ACF field group menu item */
// add_filter('acf/settings/show_admin', '__return_false');
/** End: Hide ACF field group menu item */

/** Start: Create JSON save point */
add_filter('acf/settings/save_json', 'acf_json_save_point');
function acf_json_save_point( $path ) {
  $path = plugin_dir_path( __FILE__ ) . 'acf-json';
  return $path;
}
/** End: Create JSON save point */
/** Start: Create JSON load point */
add_filter('acf/settings/load_json', 'acf_json_load_point');
function acf_json_load_point( $paths ) {
  unset($paths[0]);
  $paths[] = plugin_dir_path( __FILE__ ) . 'acf-json-load';
  return $paths;
}
/** End: Create JSON load point */
/** Start: Stop ACF upgrade notifications */
add_filter( 'site_transient_update_plugins', 'stop_acf_update_notifications', 11 );
function stop_acf_update_notifications( $value ) {
  unset( $value->response[ plugin_dir_path( __FILE__ ) . 'includes/acf/acf.php' ] );
  return $value;
}

?>
