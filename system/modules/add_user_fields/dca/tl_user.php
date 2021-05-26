<?php

/**
 * Add User Fields - Adds custom fields to Contao Users
 *
 * Copyright (C) 2021 Bright Cloud Studio
 *
 * @package    BrightCloudStudio/LamvinRepFinder
 * @link       https://www.brightcloudstudio.com/
 * @license    http://opensource.org/licenses/lgpl-3.0.html
 */

 /* Extend the tl_user palettes */
foreach ($GLOBALS['TL_DCA']['tl_user']['palettes'] as $k => $v) {
    $GLOBALS['TL_DCA']['tl_user']['palettes'][$k] = str_replace('email;', 'email;{add_user_fields_legend},user_image,,user_image_meta,user_bio;', $v);
}

/* Add fields to tl_user */
$GLOBALS['TL_DCA']['tl_user']['fields']['user_image'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_user']['user_image'],
	'inputType'               => 'fileTree',
	'default'		  => '',
	'search'                  => true,
	'eval' => [
		'tl_class' => 'long',
		'mandatory' => true, 
		'fieldType' => 'radio', 
		'filesOnly' => true, 
		'mandatory' => true
	],
	'sql'                    => ['type' => 'binary', 'length' => 16, 'notnull' => false, 'fixed' => true]
);

$GLOBALS['TL_DCA']['tl_user']['fields']['user_image_size'] = array
(
	'label'                 => &$GLOBALS['TL_LANG']['tl_user']['user_image_size'],
	'exclude'               => true,
	'inputType'             => 'imageSize',
	'options'               => \Contao\System::getImageSizes(),
	'reference'             => &$GLOBALS['TL_LANG']['MSC'],
	'eval'                  => [
		'rgxp'=>'natural',
		'includeBlankOption'=>true,
		'nospace'=>true,
		'helpwizard'=>true,
		'tl_class'=>'long'
	],
	'sql'                   => ['type' => 'string', 'length' => 64, 'default' => '']
);

$GLOBALS['TL_DCA']['tl_user']['fields']['user_image_meta'] = array
(
	'label'                 => &$GLOBALS['TL_LANG']['tl_user']['user_image_size'],
	'inputType'             => 'metaWizard',
	'options'               => \Contao\System::getImageSizes(),
	'reference'             => &$GLOBALS['TL_LANG']['MSC'],
	'eval'                  => [
		'allowHtml'=>true,
		'nospace'=>true,
		'metaFields'=>array('alt', 'title', 'link', 'caption'),
		'helpwizard'=>true,
		'tl_class'=>'long',
		'dcaPicker'=>true
	],
	'sql'                   => "blob NULL"
);

$GLOBALS['TL_DCA']['tl_user']['fields']['user_bio'] = array
(
	'label'			=> &$GLOBALS['TL_LANG']['tl_user']['user_bio'],
	'inputType'		=> 'textarea',
	'eval'                	=> [
		'mandatory'=>true,
		'rte'=>'tinyMCE',
		'tl_class'=>'long'
	],
	'sql'                   => "mediumtext NOT NULL default ''"
);
