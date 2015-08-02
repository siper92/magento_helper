<?php

namespace MagentoHelpUtility\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use RuntimeException;

class GenerateMageCache extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:mage-config-cache
                            {mage_store_path=default}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate config file cache for a Magento app';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $fileManager = new Filesystem();
        $pathToMageStore = $this->argument('mage_store_path');
        if($pathToMageStore == "default") {
            $pathToMageStore = getcwd();
        }

        $mageRootFile = $pathToMageStore . DIRECTORY_SEPARATOR . 'app/Mage.php';

        if(!$fileManager->isFile($mageRootFile)) {
            throw new RuntimeException("No magento project found in path:{$pathToMageStore}");
        } else {
            $configFileManager = new GenerateMageCache\ConfigCache($pathToMageStore);
            $files = $configFileManager->getConfigFiles();
            echo microtime(true) . PHP_EOL;
            print_r($files);
            echo microtime(true) . PHP_EOL;
        }
    }
}