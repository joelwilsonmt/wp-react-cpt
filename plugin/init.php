<?php
/*
Plugin Name: Plugin Name
Plugin URI: Plugin URI
Description: Plugin Description
Author: Plugin Author
Version: 1.0.9
Author URI: Author URI
*/

require_once dirname(__FILE__) . '/easy_log.php';
require_once dirname(__FILE__) . '/includes/acf/acf.php';
require_once dirname(__FILE__) . '/includes/acf/pro/acf-pro.php';
// Include the configuration and other functionalities
require_once dirname(__FILE__) . '/plugin_config.php';
require_once dirname(__FILE__) . '/custom_post_type.php';
require_once dirname(__FILE__) . '/add_extra_fields.php';
require_once dirname(__FILE__) . '/add_shortcode.php';
require_once dirname(__FILE__) . '/save_custom_global.php';

cLog("All require functions complete");

?>
