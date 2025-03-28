<?php

/**
 * Bright Cloud Studio's Add User Fields
 *
 * Copyright (C) 2021 Bright Cloud Studio
 *
 * @package    bright-cloud-studio/add-user-fields
 * @link       https://www.brightcloudstudio.com/
 * @license    http://opensource.org/licenses/lgpl-3.0.html
**/

use Contao\CoreBundle\DataContainer\PaletteManipulator;

 /* Extend the tl_user palettes */
// foreach ($GLOBALS['TL_DCA']['tl_user']['palettes'] as $k => $v) {
//     $GLOBALS['TL_DCA']['tl_user']['palettes'][$k] = str_replace('email;', 'email;{add_user_fields_legend},user_image,user_image_size,user_image_meta,user_bio,user_credentials;', $v);
// }

PaletteManipulator::create()
    ->addLegend('add_user_fields_legend', 'email_legend', PaletteManipulator::POSITION_AFTER)
    ->addField(['user_image', 'user_image_size', 'user_image_meta', 'user_bio', 'user_credentials'], 'add_user_fields_legend', PaletteManipulator::POSITION_APPEND)
    ->applyToPalette('default', 'tl_user');



/* Add fields to tl_user */
$GLOBALS['TL_DCA']['tl_user']['fields']['user_image'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_user']['user_image'],
	'inputType'               => 'fileTree',
	'default'		  => '',
	'search'                  => true,
	'eval' => [
		'tl_class' => 'long',
		'fieldType' => 'radio', 
		'filesOnly' => true
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
	'label'                 => &$GLOBALS['TL_LANG']['tl_user']['user_image_meta'],
	'inputType'             => 'metaWizard',
	'options'               => \Contao\System::getImageSizes(),
	'reference'             => &$GLOBALS['TL_LANG']['MSC'],
	'eval'                  => [
		'allowHtml'=>true,
		'nospace'=>true,
		'metaFields'    => array
		(
			'title'           => 'maxlength="255"',
			'alt'             => 'maxlength="255"',
			'link'            => array('attributes'=>'maxlength="255"', 'dcaPicker'=>true),
			'caption'         => array('type'=>'textarea')
		),
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
		'rte'=>'tinyMCE',
		'tl_class'=>'long'
	],
	'sql'                   => "mediumtext NULL"
);

$GLOBALS['TL_DCA']['tl_user']['fields']['user_credentials'] = array
(
	'label'			=> &$GLOBALS['TL_LANG']['tl_user']['user_credentials'],
	'inputType'		=> 'text',
	'eval'                	=> [
		'mandatory'=>false,
		'tl_class'=>'w50'
	],
	'sql'                   => "varchar(255) NOT NULL default ''"
);
