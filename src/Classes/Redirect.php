<?php
namespace RobinTheHood\VirtualHostManager;

class Redirect
{
    public static function redirect($url, $domain = '')
    {
        self::status302($url, $domain);
        exit();
    }

    public static function status302($url, $domain = '')
    {
        $host  = $_SERVER['HTTP_HOST'];
        if ($domain) {
            $host = $domain;
        }

        $protocoll = self::getProtocoll();
        $path   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

        header('Location: ' . $protocoll . '://' . $host . $path . $url);
        exit();
    }

    public static function status404($url)
    {
        $host  = $_SERVER['HTTP_HOST'];

        $protocoll = self::getProtocoll();

        $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        header("HTTP/1.0 404 Not Found");
        header("Location: $protocoll://$host$uri$url");
        exit();
    }

    public static function getProtocoll()
    {
        if (empty($_SERVER['HTTPS'])) {
            return 'http';
        } else {
            return 'https';
        }
    }
}
