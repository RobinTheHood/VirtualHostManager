<?php
namespace RobinTheHood\VirtualHostManager;

class SettingsWriter
{
    public $settingsPath = __DIR__ . '/../../settings.json';

    public function writeVirtualHosts($virtualHosts)
    {
        $virtualHostsAsArray = [];
        foreach ($virtualHosts as $virtualHost) {
            $virtualHostsAsArray[] = $virtualHost->toArray();
        }

        $json = json_encode($virtualHostsAsArray, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
        file_put_contents($this->settingsPath, $json);
    }
}
