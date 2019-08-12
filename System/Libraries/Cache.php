<?php

final class Cache {

    public static function Get($Key) {
        $Files = glob(APP_CACHE . 'Cache.' . preg_replace('/[^A-Z0-9\._-]/i', '', $Key));
        if ($Files) {
            $Cache = file_get_contents($Files[0]);
            return unserialize($Cache);
        }
        return null;
    }

    public static function Set($Key, $Value) {
        $File = APP_CACHE . 'Cache.' . preg_replace('/[^A-Z0-9\._-]/i', '', $Key);
        $Handle = fopen($File, 'w');
        fwrite($Handle, serialize($Value));
        fclose($Handle);
    }

    public static function Delete($Key = null) {
        $Files = $Key ?
                glob(APP_CACHE . 'Cache.*' . preg_replace('/[^A-Z0-9\._-]/i', '', $Key) . '.*') :
                glob(APP_CACHE . 'Cache.*');
        if ($Files) {
            foreach ($Files as $File) {
                if (file_exists($File)) {
                    unlink($File);
                    clearstatcache();
                }
            }
        }
    }

}
