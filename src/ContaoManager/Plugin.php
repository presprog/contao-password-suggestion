<?php declare(strict_types=1);

namespace PresProg\PasswordSuggestion\ContaoManager;

use Contao\CoreBundle\ContaoCoreBundle;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use PresProg\PasswordSuggestion\PasswordSuggestionBundle;

class Plugin implements BundlePluginInterface
{
    public function getBundles(ParserInterface $parser): array
    {
        return [
            BundleConfig::create(PasswordSuggestionBundle::class)
                ->setLoadAfter([ContaoCoreBundle::class]),
        ];
    }
}
