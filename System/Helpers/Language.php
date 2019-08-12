<?php

if (!function_exists('GetLang')) {

    function GetLang($Key) {
        $Lang = Registry::GetInstance();
        return $Lang->_[$Key];
    }

}
