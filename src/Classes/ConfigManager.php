<?php
namespace RobinTheHood\VirtualHostManager;

use RobinTheHood\VirtualHostManager\SettingsLoader;

class ConfigManager
{
    public $startToken = '### VIRTUAL HOST MANAGER - START ###';
    public $endToken = '### VIRTUAL HOST MANAGER - END ###';
    public $includeToken = '### VIRTUAL HOST MANAGER - INCLUDE ###';

    public function createFromVirtualHosts($virtualHosts)
    {
        $str = '';
        foreach($virtualHosts as $virtualHost) {
            $str .= $this->createFromVirtualHost($virtualHost) . "\n";
        }

        return $str;
    }

    public function createConfig()
    {
        $configStr = file_get_contents($this->configFilePath);

        $settingsLoader = new SettingsLoader();
        $virtualHosts = $settingsLoader->loadVirtualHosts();
        $insertConfigStr = $this->createFromVirtualHosts($virtualHosts);

        $configStr = $this->prepareConfig($configStr);
        $configStr = $this->removeManagerConfig($configStr);
        $configStr = $this->insertConfig($configStr, $insertConfigStr);

        return $configStr;
    }

    public function writeConfig($configStr, $password='')
    {
        file_put_contents($this->configFilePath, $configStr);
    }

    public function insertConfig($configStr, $insertConfigStr)
    {
        $insertConfigStr = $this->startToken . "\n" . $insertConfigStr . $this->endToken;
        $configStr = str_replace($this->includeToken, $insertConfigStr, $configStr);
        return $configStr;
    }

    public function removeManagerConfig($configStr)
    {
        if (strpos($configStr, $this->includeToken)) {
            return $configStr;
        }

        $parts = explode($this->startToken, $configStr);
        $beforeStr = $parts[0];
        if(isset($parts[1])) {
            $parts = explode($this->endToken, $parts[1]);
            $afterStr = isset($parts[1]) ? $parts[1] : '';
        } else {
            $afterStr = '';
        }

        return $beforeStr . $this->includeToken . $afterStr;
    }

    public function prepareConfig($configStr)
    {
        if (strpos($configStr, $this->includeToken)) {
            return $configStr;
        }

        if (!strpos($configStr, $this->startToken) || !strpos($configStr, $this->endToken)) {
            $configStr .= "\n";
            $configStr .= $this->startToken . "\n";
            $configStr .= $this->endToken . "\n";
        }

        return $configStr;
    }
}
