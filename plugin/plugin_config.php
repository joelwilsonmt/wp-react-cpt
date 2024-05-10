<?php
$path = dirname(__FILE__) . '/pluginConfig.json';
$jsonString = file_get_contents($path);
$pluginConfig = json_decode($jsonString, true);

$post_type = dirname(__FILE__) . '/acf-json-load/custom-post-type.json';
$post_type_json = file_get_contents($post_type);
$post_type_config = json_decode($post_type_json, true);

// Extracting config to variables for global access
$postTypeSlug = $post_type_config['post_type'];
$pluginName = $pluginConfig['pluginName'];
$pluginURI = $pluginConfig['pluginURI'];
$pluginAuthor = $pluginConfig['pluginAuthor'];
$pluginVersion = $pluginConfig['pluginVersion'];
$postTypeDTOName = $pluginConfig['postTypeDTOName'];
$fieldGroups = $pluginConfig['fieldGroups'];
$shortcodeName = $pluginConfig['shortcodeName'];
$reactEntryPointId = $pluginConfig['reactEntryPointId'];

?>
