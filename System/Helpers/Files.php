<?php

function IncludeFile($File, $Require = false) {
    if (file_exists($File)) {
        include $File;
        return true;
    } elseif ($Require == true) {
        exit('Required File is not Exists');
    }
    return false;
}

function IncludeFileOnce($File, $Require = false) {
    if (file_exists($File)) {
        include_once $File;
        return true;
    } elseif ($Require == true) {
        exit('Required File is not Exists');
    }
    return false;
}
