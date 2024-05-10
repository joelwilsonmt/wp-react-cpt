<?php
/*
Plugin Name: Plugin Name
Plugin URI: Plugin URI
Description: Plugin Description
Author: Plugin Author
Version: 1.0.11
Author URI: Author URI
*/

require_once dirname(__FILE__) . '/easy_log.php';
require_once dirname(__FILE__) . '/init_acf.php';
require_once dirname(__FILE__) . '/plugin_config.php';
require_once dirname(__FILE__) . '/import_json_acf.php';
require_once dirname(__FILE__) . '/add_shortcode.php';

cLog("All require functions complete");

?>
