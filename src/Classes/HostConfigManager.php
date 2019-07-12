<?php
namespace RobinTheHood\VirtualHostManager;

use RobinTheHood\VirtualHostManager\ConfigManager;
use RobinTheHood\VirtualHostManager\Shell;

class HostConfigManager extends ConfigManager
{
    public $configFilePath = '/etc/hosts';
    public $configTempFilePath = 'hosts_temp.txt';

    public function createFromVirtualHost($virtualHost)
    {
        $str = '127.0.0.1 ' . $virtualHost->localHost . "\n";
        $str .= '127.0.0.1 www.' . $virtualHost->localHost . "\n";
        return $str;
    }

    public function writeConfig($configStr, $password = '')
    {
        file_put_contents($this->configTempFilePath, $configStr);
        $cmd = 'cat ' . $this->configTempFilePath . ' > ' . $this->configFilePath;
        Shell::sudo($cmd, $password);
    }
}
