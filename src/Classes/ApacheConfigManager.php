<?php
namespace RobinTheHood\VirtualHostManager;

use RobinTheHood\VirtualHostManager\ConfigManager;

class ApacheConfigManager extends ConfigManager
{
    public $configFilePath = '/Applications/MAMP/conf/apache/extra/httpd-vhosts.conf';

    public function createFromVirtualHost($virtualHost)
    {
        if (!file_exists($virtualHost->documentsRootPath)) {
            return '';
        }

        $config = [
            'serverAdmin' => 'webmaster@virtualhostmanager.local',
            'documentRoot' => $virtualHost->documentsRootPath,
            'serverName' => $virtualHost->localHost,
            'serverAlias' => 'www.' . $virtualHost->localHost,
            'errorLog' => 'logs/localhost.com-error_log',
            'customLog' => 'logs/localhost.com-access_log'
        ];

        $str = '<VirtualHost *:80>' . "\n";
        $str .= '    ServerAdmin ' . $config['serverAdmin'] . "\n";
        $str .= '    DocumentRoot "' . $config['documentRoot'] . '"' . "\n";
        $str .= '    ServerName ' . $config['serverName'] . "\n";
        $str .= '    ServerAlias ' . $config['serverAlias'] . "\n";
        $str .= '    ErrorLog "' . $config['errorLog'] . '"' . "\n";
        $str .= '    CustomLog "' . $config['customLog'] . '" common' . "\n";
        $str .= '    <Directory />' . "\n";
        $str .= '        AllowOverride All' . "\n";
        $str .= '    </Directory>' . "\n";
        $str .= '</VirtualHost>' . "\n";

        return $str;
    }
}
