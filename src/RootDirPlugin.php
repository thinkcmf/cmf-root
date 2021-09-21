<?php

namespace cmf\composer;

use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;

class RootDirPlugin implements PluginInterface
{
    public function activate(Composer $composer, IOInterface $io)
    {
        print_r($composer->getPackage());
        echo "\n";
        $vendorDir = $composer->getConfig()->get('vendor-dir');

        $cmfRootDir = dirname($vendorDir) . DIRECTORY_SEPARATOR;

        $rootDir = $vendorDir . DIRECTORY_SEPARATOR . 'thinkcmf' . DIRECTORY_SEPARATOR . 'cmf-root' . DIRECTORY_SEPARATOR . 'root' . DIRECTORY_SEPARATOR;

        $content = file_get_contents("{$rootDir}test.txt");

        file_put_contents("{$cmfRootDir}test.txt", $content);

        echo "\nRootDirPlugin activate 1\n";
    }

    public function deactivate(Composer $composer, IOInterface $io)
    {

    }

    public function uninstall(Composer $composer, IOInterface $io)
    {

    }
}
