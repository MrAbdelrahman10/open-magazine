<?php

class Request {

    public static function IsAjax() {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ? true : false;
    }

    public static function IsPost() {
        return $_SERVER['REQUEST_METHOD'] === 'POST' ? true : false;
    }

    public static function IsGet() {
        return $_SERVER['REQUEST_METHOD'] === 'GET' ? true : false;
    }

    public static function IsAPI() {
        return isset($_GET['api']) ? true : false;
    }

}