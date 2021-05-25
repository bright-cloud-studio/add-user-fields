<?php

namespace CustomTags;
use Contao\DataContainer;

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
			case 'image':

				$objMember = \UserModel::findById($arrTag[1]);
				if($objMember) {
					$strImage = $objMember->image;
					return $strImage;
				}
				return "IMAGE - NO RESULT";
			break;
			case 'bio':
				$objMember = \UserModel::findById($arrTag[1]);
				if($objMember) {
					$strBio = $objMember->bio;
					if ($strBio == '') {
						return "GOT USER BUT NOT BIO";
					}
					return $strBio;
				}
				return "BIO - NO RESULT";
			break;
		}

		// something has gone horribly wrong, let the user know and hope for brighter lights ahead
		return 'something_went_wrong';
	}
}
