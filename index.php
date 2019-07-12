<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'vendor/autoload.php';

use RobinTheHood\ExceptionMonitor\ExceptionMonitor;
use RobinTheHood\Debug\Debug;

use RobinTheHood\VirtualHostManager\Controller;

ExceptionMonitor::register([
    'ip' => '127.0.0.1'
]);

function debugOut($value)
{
    Debug::out($value);
}

function debugDie($value)
{
    Debug::out($value);
    die();
}

$controller = new Controller();
$controller->invoke();
