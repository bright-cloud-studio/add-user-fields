<?php

declare(strict_types=1);

namespace BrightCloudStudio\AddUserFieldsBundle\EventListener;

use Contao\CoreBundle\Event\ReplaceInsertTagsEvent;
use Contao\UserModel;
use Contao\FilesModel;
use Contao\Frontend;
use Contao\Image;
use Contao\StringUtil;

class ReplaceInsertTagsListener
{
    public function __invoke(ReplaceInsertTagsEvent $event): void
    {
        $insertTag = $event->getInsertTag();

        if (0 !== strpos($insertTag, 'user_')) {
            return;
        }

        $parts = explode('::', $insertTag);

        switch ($parts[0]) {
            case 'user_image':
                $userId = (int) ($parts[1] ?? 0);
                $user = UserModel::findByPk($userId);

                if (null === $user || '' === $user->user_image) {
                    return;
                }

                $imgSize = StringUtil::deserialize($user->user_image_size);
                $arrMeta = Frontend::getMetaData($user->user_image_meta, $GLOBALS['TL_LANGUAGE']);

                $objFile = FilesModel::findByUuid($user->user_image);
                if (null === $objFile) {
                    return;
                }

                $path = $objFile->path;
                if (is_array($imgSize) && count($imgSize) >= 2 && $imgSize[0] !== '') {
                    $src = Image::get(FilesModel::getPath($path), (int) $imgSize[0], (int) $imgSize[1], (bool) ($imgSize[2] ?? false));
                } else {
                    $src = Image::get(FilesModel::getPath($path));
                }

                $imgTag = sprintf(
                    '<img src="%s" %s %s %s class="user_image id_%d"/>',
                    $src,
                    $arrMeta[0] ?? '',
                    $arrMeta[1] ?? '',
                    $arrMeta[2] ?? '',
                    $userId
                );

                $event->setReplacement($imgTag);
                return;

            case 'user_bio':
                $userId = (int) ($parts[1] ?? 0);
                $user = UserModel::findByPk($userId);

                if (null === $user || '' === $user->user_bio) {
                    return;
                }

                $bio = $user->user_bio;
                $event->setReplacement(sprintf(
                    '<div id="user_bio" class="user_bio id_%d">%s</div>',
                    $userId,
                    $bio
                ));
                return;

            default:
                return;
        }
    }
}
