<?php
/**
 * ConfigurationHandler
 * Reads a local .env or .env.local file with the neded configuration for the different modules.
 */
class ConfigurationHandler {
    private const CURRENT_PATH = __DIR__ . DIRECTORY_SEPARATOR;

    private $configurationFileLocalPath = self::CURRENT_PATH . ".env.local";
    private $configurationFilePath = self::CURRENT_PATH . ".env";
    private $globalConfiguration = [];

    public function __construct() {
        if (file_exists($this->configurationFilePath)) {
            $this->readConfig($this->configurationFilePath, $this->globalConfiguration);
        } else {
            echo ('File not found');
            throw new Error('Configuration file not found. Please check setup!');
        }
    
        if (file_exists($this->configurationFileLocalPath)) {
            $this->readConfig($this->configurationFileLocalPath, $this->globalConfiguration);   
        } 
    }

    /**
     * Reads a configration file and writes the content to the global configuration Array
     *
     * @param String $configurationFilePath
     */
    private function readConfig(String $configurationFilePath) {
        $configurationFileContent = file($configurationFilePath);
        
        for($i = 0; $i < count($configurationFileContent); $i++) {
            list($key, $value) = explode("=", $configurationFileContent[$i]);
            $this->globalConfiguration[trim($key)] = trim($value);
        }
    }

    /**
     * Get the value of globalConfiguration
     */ 
    public function getGlobalConfiguration(String $key = "") {
        if (!empty($key)) {
            if (isset($this->globalConfiguration[$key])) {
                return $this->globalConfiguration[$key];
            }
            echo ("Key: $key not found");
            throw new Error("Key: $key not found");
        }
        return $this->globalConfiguration;
    }
}
