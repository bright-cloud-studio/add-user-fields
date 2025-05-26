<?php

declare(strict_types=1);

namespace BrightCloudStudio\AddUserFieldsBundle\ContaoManager;

use Contao\CoreBundle\ContaoCoreBundle;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Plugin;

class Plugin extends Plugin implements BundlePluginInterface
{
    public function getBundles(ParserInterface $parser): array
    {
        return [
            BundleConfig::create(\BrightCloudStudio\AddUserFieldsBundle::class)
                ->setLoadAfter([ContaoCoreBundle::class]),
        ];
    }
}
