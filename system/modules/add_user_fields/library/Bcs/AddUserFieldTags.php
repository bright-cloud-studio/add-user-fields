<?php

namespace Bcs\AddUserFieldTags;

use Contao\CoreBundle\ServiceAnnotation\Hook;

/**
 * @Hook("replaceInsertTags")
 */
class AddUserFieldTags
{
    public const TAG = 'user_image';
    
    public function __invoke(string $tag)
    {
        $chunks = explode('::', $tag);

        if (self::TAG !== $chunks[0]) {
            return false;
        }
        
	    return "bingbongnoise";
	    
    }
}
