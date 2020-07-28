<?php
const CURRENT_PATH = __DIR__ . DIRECTORY_SEPARATOR;

$configurationFileLocal = CURRENT_PATH . ".env.local";
$configurationFile = CURRENT_PATH . ".env";
$globalConfiguration = [];

if (file_exists($configurationFile)) {
    $globalConfiguration = readConfig($configurationFile, $globalConfiguration);
} else {
    echo ('File not found');
    throw new Error('Configuration file not found. Please check setup!');
}

if (file_exists($configurationFileLocal)) {
    $globalConfiguration = readConfig($configurationFileLocal, $globalConfiguration);   
} 

function readConfig($configurationFile, $config) {
    $configuration = file($configurationFile);
    
    for($i=0; $i < count($configuration); $i++) {
        list($key, $value) = explode("=", $configuration[$i]);
        $config[trim($key)] = trim($value);
    }

    return $config;
}
