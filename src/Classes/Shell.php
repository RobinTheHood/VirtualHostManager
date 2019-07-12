<?php
namespace RobinTheHood\VirtualHostManager;

class Shell
{
    public static function sudo($cmd, $password)
    {
        $sudoCmd = 'echo "' . $password . '" | sudo -S bash -c "'. $cmd .'"';
        shell_exec($sudoCmd);
    }
}
