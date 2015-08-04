<?php

namespace MagentoHelpUtility\Handlers\GenerateMageCache;

use Illuminate\Filesystem\Filesystem;
use MagentoHelpUtility\Handlers\GenerateMageCache;
use RuntimeException;

class GenerateMageCacheHandler
{
    private $_arguments = array();

    public function run($arguments)
    {
        $this->_arguments = $arguments;

        $fileManager = new Filesystem();
        $pathToMageStore = '';

        foreach() {
            $pathToMageStore = $this->argument('mage_store_path');
        }

        if($pathToMageStore == "default") {
            $pathToMageStore = getcwd();
        }

        $mageRootFile = $pathToMageStore . DIRECTORY_SEPARATOR . 'app/Mage.php';

        if(!$fileManager->isFile($mageRootFile)) {
            throw new RuntimeException("No magento project found in path:{$pathToMageStore}");
        } else {
            $configFileManager = new ConfigCache($pathToMageStore);
            $files = $configFileManager->getConfigFiles();
            echo microtime(true) . PHP_EOL;
            print_r($files);
            echo microtime(true) . PHP_EOL;
        }
    }
}