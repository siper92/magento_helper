<?php

namespace MagentoHelpUtility\Console\Commands\GenerateMageCache;

use Illuminate\Filesystem\Filesystem;
use RuntimeException;

class ConfigCache
{
    protected $_configFiles = null;

    /**
     * Get list of magneto config.xml files
     *
     * @return array
     * @throws RuntimeException when no config files were found
     */
    public function getConfigFiles()
    {
        if($this->_configFiles === null) {

        }

        if(is_array($this->_configFiles) && empty($this->_configFiles)) {
            throw new RuntimeException("There were not config files found in this mage project");
        }

        return $this->_configFiles;
    }
}