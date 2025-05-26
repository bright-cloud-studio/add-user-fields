<?php

declare(strict_types=1);

namespace BrightCloudStudio\AddUserFieldsBundle\ContaoManager;

use BrightCloudStudio\AddUserFieldsBundle\AddUserFieldsBundle;
use Contao\CoreBundle\ContaoCoreBundle;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Plugin;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;

class Plugin extends Plugin implements BundlePluginInterface
{
    public function getBundles(ParserInterface $parser): array
    {
        return [
            BundleConfig::create(AddUserFieldsBundle::class)
                ->setLoadAfter([ContaoCoreBundle::class]),
        ];
    }
}
