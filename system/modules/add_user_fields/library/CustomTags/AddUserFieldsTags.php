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

namespace CustomTags;
use Contao\DataContainer;
use Contao\ContentElement;

class AddUserFieldsTags extends \System
{
	public function onReplaceTag (string $insertTag)
	{
		// if this tag doesnt contain :: it doesn't have an id, so we can stop right here
		if (stristr($insertTag, "::") === FALSE) {
			return 'no_id';
		}

		// break our tag into an array
		$arrTag = explode("::", $insertTag);

		// lets make decisions based on the beginning of the tag
		switch($arrTag[0]) {
			// if the tag is what we want, {{simple_inventory::id}}, then lets go
			case 'user_image':
				$objMember = \UserModel::findById($arrTag[1]);
				
				$imgSize = deserialize($objMember->user_image_size);
				$arrMeta = \Frontend::getMetaData($objMember->user_image_meta, $GLOBALS['TL_LANGUAGE']);
				
				if($objMember) {
					$strImage = $objMember->user_image;
					if($strImage == '') {
						return "GOT USER BUT NOT IMAGE";
					}
					$objFile = \FilesModel::findByUuid($strImage);
					$strPath = $objFile->path;
					
					if($arrMeta['link'] != '')
						return "<a href='".$arrMeta['link']."'><img alt='".$arrMeta['alt']."' title='".$arrMeta['alt']."' width='".$imgSize[0]."' height='".$imgSize[1]."' class='user_image' id='user_image id_" . $arrTag[1] . "' src='" . $strPath . "'></a>";
					else
						return "<img alt='".$arrMeta['alt']."' title='".$arrMeta['alt']."' width='".$imgSize[0]."' height='".$imgSize[1]."' class='user_image' id='user_image id_" . $arrTag[1] . "' src='" . $strPath . "'>";
				}
				return "user_image - NO RESULT";
			break;
			case 'user_bio':
				$objMember = \UserModel::findById($arrTag[1]);
				if($objMember) {
					$strBio = $objMember->user_bio;
					if ($strBio == '') {
						return "GOT USER BUT NOT BIO";
					}
					return "<div id='user_bio' class='user_bio id_" . $arrTag[1] . "'>" . $strBio . "</div>";
				}
				return "user_bio - NO RESULT";
			break;
		}

		// something has gone horribly wrong, let the user know and hope for brighter lights ahead
		return 'something_went_wrong';
	}
}
