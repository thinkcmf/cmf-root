<?php

namespace cmf\composer;

use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;

class RootDirPlugin implements PluginInterface
{
    public function activate(Composer $composer, IOInterface $io)
    {
        print_r($composer);

        print_r($composer->getInstallationManager()->getInstallPath($composer->getPackage()));

        echo "RootDirPlugin activate\n";
    }

    public function deactivate(Composer $composer, IOInterface $io)
    {

    }

    public function uninstall(Composer $composer, IOInterface $io)
    {

    }
}
