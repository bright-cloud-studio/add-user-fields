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
    $GLOBALS['TL_DCA']['tl_user']['palettes'][$k] = str_replace('email;', 'email;{add_user_fields_legend},image,bio;', $v);
}

/* Add fields to tl_user */
$GLOBALS['TL_DCA']['tl_user']['fields']['image'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_user']['image'],
	'inputType'               => 'fileTree',
	'default'				  => '',
	'search'                  => true,
	'eval' => [
		'tl_class' => 'clr',
		'mandatory' => true, 
		'fieldType' => 'radio', 
		'filesOnly' => true, 
		'mandatory' => true
	],
	'sql'                    => ['type' => 'binary', 'length' => 16, 'notnull' => false, 'fixed' => true]
);

$GLOBALS['TL_DCA']['tl_user']['fields']['bio'] = array
(
	'label'					=> &$GLOBALS['TL_LANG']['tl_user']['bio'],
	'inputType'				=> 'textarea',
	'eval'                	=> array('mandatory'=>true, 'rte'=>'tinyMCE','tl_class'=>'long')
);
