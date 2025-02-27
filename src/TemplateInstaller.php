<?php
/**
 * @link https://gitee.com/lcfcode/linker
 * @link https://github.com/lcfcode/linker
 */

namespace linkerlib\install;

use Composer\Package\PackageInterface;
use Composer\Installer\LibraryInstaller;
use Composer\Repository\InstalledRepositoryInterface;

class TemplateInstaller extends LibraryInstaller
{
    public function install(InstalledRepositoryInterface $repo, PackageInterface $package)
    {
        parent::install($repo, $package);
    }

    public function getInstallPath(PackageInterface $package): string
    {
        if ('lcfdev/linkerlib' !== $package->getPrettyName()) {
            throw new \InvalidArgumentException('Unable to install this library!');
        }

        return 'swap';
    }

    public function supports($packageType): bool
    {
        return 'linkerlib' === $packageType;
    }

    public function update(InstalledRepositoryInterface $repo, PackageInterface $initial, PackageInterface $target)
    {
        parent::update($repo, $initial, $target);
    }

    public function delDir($dirName)
    {
        if ($handle = opendir($dirName)) {
            while (false !== ($item = readdir($handle))) {
                if ($item != "." && $item != "..") {
                    if (is_dir($dirName . '/' . $item)) {
                        $this->delDir($dirName . '/' . $item);
                    } else {
                        unlink($dirName . '/' . $item);
                    }
                }
            }
            closedir($handle);
            rmdir($dirName);
        }
    }
}