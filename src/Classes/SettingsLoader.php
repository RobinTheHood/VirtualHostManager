<?php
namespace RobinTheHood\VirtualHostManager;

use RobinTheHood\VirtualHostManager\VirtualHost;

class SettingsLoader
{
    public $settingsPath = __DIR__ . '/../../settings.json';

    public function loadVirtualHosts()
    {
        $json = file_get_contents($this->settingsPath);
        $virtualHostsAsArray = json_decode($json, true);

        $virtualHosts = [];
        foreach($virtualHostsAsArray as $virtualHostAsArray) {
            $virtualHost = new VirtualHost();
            $virtualHost->loadFromArray($virtualHostAsArray);
            $virtualHosts[] = $virtualHost;
        }

        return $virtualHosts;
    }
}
