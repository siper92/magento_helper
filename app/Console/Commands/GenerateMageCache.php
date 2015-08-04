<?php

namespace MagentoHelpUtility\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use MagentoHelpUtility\Handlers\GenerateMageCache;
use RuntimeException;

class GenerateMageCacheCommand extends Command
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

    }
}