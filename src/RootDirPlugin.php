<?php

namespace cmf\composer;

use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;

class RootDirPlugin implements PluginInterface
{
    public function activate(Composer $composer, IOInterface $io)
    {
        $vendorDir  = $composer->getConfig()->get('vendor-dir');
        $cmfRootDir = dirname($vendorDir) . DIRECTORY_SEPARATOR;
        $rootDir    = $vendorDir . DIRECTORY_SEPARATOR . 'thinkcmf' . DIRECTORY_SEPARATOR . 'cmf-root' . DIRECTORY_SEPARATOR . 'root' . DIRECTORY_SEPARATOR;
        if (is_dir($rootDir)) {
            $this->copyDir($rootDir, $cmfRootDir);
            echo "copy done\n";
            $this->deleteDir($rootDir);
            echo "delete done\n";
        }
    }

    private function copyDir($strSrcDir, $strDstDir)
    {
        $dir = opendir($strSrcDir);
        if (!$dir) {
            return false;
        }
        if (!is_dir($strDstDir)) {
            if (!mkdir($strDstDir)) {
                return false;
            }
        }
        while (false !== ($file = readdir($dir))) {
            if (($file != '.') && ($file != '..')) {
                if (is_dir($strSrcDir . DIRECTORY_SEPARATOR . $file)) {
                    if (!$this->copyDir($strSrcDir . DIRECTORY_SEPARATOR . $file, $strDstDir . DIRECTORY_SEPARATOR . $file)) {
                        return false;
                    }
                } else {
                    if (!copy($strSrcDir . DIRECTORY_SEPARATOR . $file, $strDstDir . DIRECTORY_SEPARATOR . $file)) {
                        return false;
                    }
                }
            }
        }
        closedir($dir);
        return true;
    }

    private function deleteDir($dir)
    {
        if (is_dir($dir)) {
            if ($dp = opendir($dir)) {
                while (($file = readdir($dp)) != false) {
                    echo $file."\n";
                    if (is_dir($file)) {
                        if ($file != '.' && $file != '..') {
                            $this->deleteDir($file);
                        }
                    } else {
                        unlink($file);
                    }
                }
                closedir($dp);
            } else {
                echo 'Not permission' . "\n";
            }

        }
    }

    public function deactivate(Composer $composer, IOInterface $io)
    {

    }

    public function uninstall(Composer $composer, IOInterface $io)
    {

    }
}
