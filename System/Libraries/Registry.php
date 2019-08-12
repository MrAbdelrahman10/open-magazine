<?php

class Registry {

    private static $_Instance;
    private $_Data = array();

    private function __construct() {
        
    }

    public static function GetInstance() {
        if (!self::$_Instance instanceof self) {
            self::$_Instance = new Registry();
        }
        return self::$_Instance;
    }

    public function Get($Key) {
        return isset($this->_Data[$Key]) ? $this->_Data[$Key] : null;
    }

    public function Set($Key, $Value) {
        if (!$this->_Data[$Key]) {
            $this->_Data[$Key] = $Value;
        }
    }

}

function &DoRegistry() {
    $Registry = Registry::GetInstance();
    return $Registry;
}
