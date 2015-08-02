<?php

namespace MagentoHelpUtility\Console\Commands\GenerateMageCache;

use Illuminate\Filesystem\Filesystem;
use RuntimeException;

class ConfigCache
{
    /**
     * @var string
     */
    private $_configFileName = "config.xml";

    /**
     * @var Filesystem
     */
    private $_fileManger = null;

    private $_rootDirectory = '';

    /**
     * @var array
     */
    protected $_configFiles = null;

    /**
     * Directories which should be skipped when looking for config files
     *
     * @var array
     */
    public $directoriesToSkip = array(
        "Model",
        "Block",
        "Controllers",
        "controllers",
        'Helper',
        "sql"
    );

    public function __construct($rootDirectory)
    {
        $this->_fileManger = new Filesystem();
        $this->_rootDirectory = $rootDirectory;
    }

    /**
     * Get list of magneto config.xml files
     *
     * @return array
     * @throws RuntimeException when no config files were found
     */
    public function getConfigFiles()
    {
        if($this->_configFiles === null) {
            $this->_configFiles = $this->checkDirForConfig($this->_rootDirectory);
        }

        if(is_array($this->_configFiles) && empty($this->_configFiles)) {
            throw new RuntimeException("There were not config files found in this mage project");
        }

        return $this->_configFiles;
    }

    /**
     * Check for config files in directory
     *
     * @param string $dir - directory in which to check for config files
     * @return array
     */
    public function checkDirForConfig($dir)
    {
        $configFiles = array();
        $files = $this->_fileManger->files($dir);
        echo "---------------------" . PHP_EOL;
        foreach($files as $file) {
            if($file == $this->_configFileName) {
                $configFiles[] = $file;
            }
            echo $file . PHP_EOL;

        }
        echo "---------------------" . PHP_EOL;
        $directories = $this->_fileManger->directories($dir);
        foreach($directories as $directory) {
            if(in_array($directory, $this->directoriesToSkip)) {
                continue;
            }
            echo $directory . PHP_EOL;
            $configFiles = array_merge($this->checkDirForConfig($directory), $configFiles);
        }
        return $configFiles;
    }
}