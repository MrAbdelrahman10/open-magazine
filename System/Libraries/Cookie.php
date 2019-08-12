<?php

class Cookie {

    public static function Set($Key, $Value, $Expire) {
        @setcookie($Key, $Value, $Expire);
    }

    public static function Get($Key) {
        if (isset($_COOKIE[$Key])) {
            return $_COOKIE[$Key];
        }
    }

}
