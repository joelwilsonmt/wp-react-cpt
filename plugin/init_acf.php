<?php

if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/** Start: Include ACF */
include_once( plugin_dir_path( __FILE__ ) . 'includes/acf/acf.php' );
require_once( plugin_dir_path( __FILE__ ) . 'includes/acf/pro/acf-pro.php' );

// uncomment to hide ACF admin panel:
// add_filter('acf/settings/show_admin', '__return_false');

/** Start: Stop ACF upgrade notifications */
add_filter( 'site_transient_update_plugins', 'stop_acf_update_notifications', 11 );
function stop_acf_update_notifications( $value ) {
  unset( $value->response[ plugin_dir_path( __FILE__ ) . 'includes/acf/acf.php' ] );
  return $value;
}

?>
