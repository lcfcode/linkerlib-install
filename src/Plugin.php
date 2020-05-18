<?php
/**
 * @link https://gitee.com/lcfcode/linker
 * @link https://github.com/lcfcode/linker
 */

namespace linkerlib\install;

use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;

class Plugin implements PluginInterface
{
    public function activate(Composer $composer, IOInterface $io)
    {
        $manager = $composer->getInstallationManager();

        $manager->addInstaller(new TemplateInstaller($io, $composer));
    }
}