<?php
/**
 *
 */
class Session {
/**
 * Start new or resume existing session
 */
    public static function Init() {
        @session_start();
    }
/**
 *
 * @param string $Key
 * @param string $Value
 */
    public static function Set($Key, $Value) {
        @$_SESSION[$Key] = $Value;
    }
/**
 *
 * @param string $Key
 * @return string value of input $Key
 */
    public static function Get($Key) {
        if (isset($_SESSION[$Key])) {
            return @$_SESSION[$Key];
        }
        return null;
    }
/*
 * Clear User Session
 */
    public static function Destroy() {
        @session_destroy();
    }

}
