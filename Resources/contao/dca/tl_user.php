<?php

declare(strict_types=1);

// Extend the tl_user palettes
foreach ($GLOBALS['TL_DCA']['tl_user']['palettes'] as $k => $v) {
    $GLOBALS['TL_DCA']['tl_user']['palettes'][$k] = str_replace(
        'email;',
        'email;{add_user_fields_legend},user_image,user_image_size,user_image_meta,user_bio;',
        $v
    );
}

// Field definitions
$GLOBALS['TL_DCA']['tl_user']['fields']['user_image'] = [
    'label'     => &$GLOBALS['TL_LANG']['tl_user']['user_image'],
    'inputType' => 'fileTree',
    'default'   => '',
    'search'    => true,
    'eval'      => [
        'tl_class'  => 'long',
        'fieldType'=> 'radio',
        'filesOnly'=> true
    ],
    'sql'       => ['type' => 'binary', 'length' => 16, 'notnull' => false, 'fixed' => true]
];

$GLOBALS['TL_DCA']['tl_user']['fields']['user_image_size'] = [
    'label'     => &$GLOBALS['TL_LANG']['tl_user']['user_image_size'],
    'exclude'   => true,
    'inputType' => 'imageSize',
    'options'   => \Contao\System::getImageSizes(),
    'reference' => &$GLOBALS['TL_LANG']['MSC'],
    'eval'      => [
        'rgxp'               => 'natural',
        'includeBlankOption' => true,
        'nospace'            => true,
        'helpwizard'         => true,
        'tl_class'           => 'long'
    ],
    'sql'       => ['type' => 'string', 'length' => 64, 'default' => '']
];

$GLOBALS['TL_DCA']['tl_user']['fields']['user_image_meta'] = [
    'label'     => &$GLOBALS['TL_LANG']['tl_user']['user_image_meta'],
    'inputType' => 'metaWizard',
    'options'   => \Contao\System::getImageSizes(),
    'reference' => &$GLOBALS['TL_LANG']['MSC'],
    'eval'      => [
        'allowHtml'  => true,
        'nospace'    => true,
        'metaFields' => [
            'title'   => 'maxlength="255"',
            'alt'     => 'maxlength="255"',
            'link'    => ['attributes' => 'maxlength="255"', 'dcaPicker'=>true],
            'caption' => ['type' => 'textarea']
        ]
    ],
    'sql'       => "blob NULL"
];

$GLOBALS['TL_DCA']['tl_user']['fields']['user_bio'] = [
    'label'     => &$GLOBALS['TL_LANG']['tl_user']['user_bio'],
    'inputType' => 'textarea',
    'eval'      => ['rte' => 'tinyMCE', 'tl_class' => 'long'],
    'sql'       => "mediumtext NOT NULL default ''"
];
