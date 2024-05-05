<?php
cLog("Loading Config ");
$path = dirname(__FILE__) . '/pluginConfig.json';
$jsonString = file_get_contents($path);
$pluginConfig = json_decode($jsonString, true);

// Extracting config to variables for global access
$pluginName = $pluginConfig['pluginName'];
$pluginURI = $pluginConfig['pluginURI'];
$pluginAuthor = $pluginConfig['pluginAuthor'];
$pluginVersion = $pluginConfig['pluginVersion'];
$postTypeSingularName = $pluginConfig['postTypeSingularName'];
$postTypePluralName = $pluginConfig['postTypePluralName'];
$postTypeSlug = $pluginConfig['postTypeSlug'];
$postTypeDescription = $pluginConfig['postTypeDescription'];
$postTypeDTOName = $pluginConfig['postTypeDTOName'];
$fieldGroups = $pluginConfig['fieldGroups'];  // This is an array
$shortcodeName = $pluginConfig['shortcodeName'];
$reactEntryPointId = $pluginConfig['reactEntryPointId'];
?>
