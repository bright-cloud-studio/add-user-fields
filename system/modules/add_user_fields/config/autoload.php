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


/* Register Classes */
ClassLoader::addClasses(array
(
	'CustomTags\AddUserFieldsTags' 		=> 'system/modules/add_user_fields/library/CustomTags/AddUserFieldsTags.php'
));
