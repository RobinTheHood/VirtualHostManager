<?php
namespace RobinTheHood\VirtualHostManager;

use RobinTheHood\VirtualHostManager\SettingsLoader;
use RobinTheHood\VirtualHostManager\VirtualHost;
use RobinTheHood\VirtualHostManager\SettingsWriter;
use RobinTheHood\VirtualHostManager\Redirect;

class Controller
{
    public function invoke()
    {
        $method = isset($_GET['method']) ? $_GET['method'] : '';

        switch ($method) {
            case 'show':
                $this->invokeShow();
                break;

            case 'addLocalHost':
                $this->invokeAddLocalHost();
                break;

            case 'editLocalHost':
                $this->invokeEditLocalHost();
                break;

            case 'deleteEntry':
                $this->invokeDeleteEntry();
                break;

            case 'reconfigure':
                $this->invokeReconfigure();
                break;

            default:
                $this->invokeIndex();
                break;
        }
    }

    public function invokeIndex()
    {
        $settingsLoader = new SettingsLoader();
        $virtualHosts = $settingsLoader->loadVirtualHosts();

        include __DIR__ . '/../templates/Index.tmpl.php';
    }

    public function invokeAddLocalHost()
    {
        $settingsLoader = new SettingsLoader();
        $virtualHosts = $settingsLoader->loadVirtualHosts();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $virtualHost = new VirtualHost();
            $virtualHost->setId(uniqid());
            $virtualHost->setLocalHost($_POST['localHost']);
            $virtualHost->setRemoteHost($_POST['remoteHost']);
            $virtualHost->setDescription($_POST['description']);
            $virtualHost->setDocumentsRootPath($_POST['documentsRootPath']);
            $virtualHosts[] = $virtualHost;

            $settingsWirter = new SettingsWriter();
            $settingsWirter->writeVirtualHosts($virtualHosts);

            Redirect::redirect('/');
        }

        $selectedVirtualHost = new VirtualHost();
        include __DIR__ . '/../templates/LocalHostForm.tmpl.php';
    }

    public function invokeEditLocalHost()
    {
        $settingsLoader = new SettingsLoader();
        $virtualHosts = $settingsLoader->loadVirtualHosts();

        $selectedVirtualHost = new VirtualHost();
        foreach ($virtualHosts as &$virtualHost) {
            if ($virtualHost->getId() == $_GET['id']) {
                $selectedVirtualHost = $virtualHost;
                break;
            }
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $virtualHost->setLocalHost($_POST['localHost']);
            $virtualHost->setRemoteHost($_POST['remoteHost']);
            $virtualHost->setDescription($_POST['description']);
            $virtualHost->setDocumentsRootPath($_POST['documentsRootPath']);

            $settingsWirter = new SettingsWriter();
            $settingsWirter->writeVirtualHosts($virtualHosts);

            Redirect::redirect('/');
        }

        include __DIR__ . '/../templates/LocalHostForm.tmpl.php';
    }

    public function invokeReconfigure()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $password = $_POST['password'];

            if ($password) {
                $apacheConfigManager = new ApacheConfigManager();
                $configStr = $apacheConfigManager->createConfig();
                $apacheConfigManager->writeConfig($configStr);

                $hostConfigManager = new HostConfigManager();
                $configStr = $hostConfigManager->createConfig();
                $hostConfigManager->writeConfig($configStr, $password);

                Shell::sudo('/Applications/MAMP/Library/bin/apachectl -k graceful', $password);
                Redirect::redirect('/');
            }
        }

        include __DIR__ . '/../templates/EnterPassword.tmpl.php';
    }

    public function invokeDeleteEntry()
    {
        $id = $_GET['id'];
        $settingsLoader = new SettingsLoader();
        $virtualHosts = $settingsLoader->loadVirtualHosts();

        $save = false;
        foreach ($virtualHosts as $index => $virtualHost) {
            if ($virtualHost->getId() == $id) {
                unset($virtualHosts[$index]);
                $save = true;
                break;
            }
        }

        if ($save) {
            $settingsWirter = new SettingsWriter();
            $settingsWirter->writeVirtualHosts($virtualHosts);
        }

        Redirect::redirect('/');
    }
}
