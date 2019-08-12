<?php

function SetSortingOrderLink($OrderKey = null) {
    $Registry = &DoRegistry();
    $psUrl = $Registry->FullUrl;
    $NewSort = "";
    $cSort = urldecode(GetValue($_GET["sort"][$OrderKey]));
    if ($cSort) {
        $psUrl = str_replace("sort[$OrderKey]=$cSort", '', $psUrl);
        $NewSort = (strtolower($cSort) == 'asc' ? "sort[$OrderKey]=desc" : '');
    } else {
        $NewSort = "sort[$OrderKey]=asc";
    }
    $psUrl = trim($psUrl, '&');
    $psUrl = trim($psUrl, '?');
    return $psUrl . ($NewSort ? (strpos($psUrl, '?') > 0 ? '&' : '?') . $NewSort : '');
}

function GetRewriteUrl($Url, $Alias = '') {
    if (REWRITE_URL_STYLE == RewriteUrl::HtmlNoAlias) {
        return BASE_URL . rtrim($Url, "/") . '.html';
    } elseif (REWRITE_URL_STYLE == RewriteUrl::HtmlAlias) {
        return BASE_URL . rtrim($Url . ($Alias ? '/' . $Alias : ''), "/") . '.html';
    } elseif (REWRITE_URL_STYLE == RewriteUrl::NoHtmlAlias) {
        return BASE_URL . rtrim($Url . ($Alias ? '/' . $Alias : ''), "/");
    }
    return BASE_URL . $Url;
}

function CurrentUrl() {
    $Registry = &DoRegistry();
    return $Registry->CurrentUrl;
}

function FullCurrentUrl() {
    $cUrl = CurrentUrl();
    return $cUrl . '?' . RemoveFromUrlGet('page');
}

function RemoveFromUrlGet($key) {
    $str = '';
    foreach ($_GET as $k => $v/* Page */) {
        if (is_array($_GET[$k])) {
            foreach ($_GET[$k] as $ki => $vi) {
                if ($ki != $key) {
                    $str .= $k . '[' . $ki . ']=' . urldecode($vi) . '&';
                }
            }
        } else {
            if ($k != $key && $v) {
                $str .= "$k=".  urldecode($v);
            }
        }
    }
    return trim($str, '&');
}

function Redirect($Url) {
    exit(header('Location: ' . $Url));
}
