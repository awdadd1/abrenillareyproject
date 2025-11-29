<?php

if (!function_exists('getUserNetworkInfo')) {
    function getUserNetworkInfo()
    {
        $ipAddress = $_SERVER['REMOTE_ADDR'] ?? 'UNKNOWN';

        // MAC address can only be obtained server-side in LAN environment
        // Works only if server is on same LAN and ARP table is accessible
        $macAddress = null;
        if (strtoupper(substr(PHP_OS, 0, 3)) !== 'WIN') {
            $macAddress = shell_exec("arp -n $ipAddress | awk '/$ipAddress/ {print $3}'");
        } else {
            $macAddress = shell_exec("arp -a $ipAddress | find \"$ipAddress\"");
        }

        return [
            'ip' => $ipAddress,
            'mac' => trim($macAddress) ?: 'UNKNOWN'
        ];
    }
}
