<?php

function str_format() {
    $args = func_get_args();
    $str = mb_ereg_replace('{([0-9]+)}', '%\\1$s', array_shift($args));
    return vsprintf($str, array_values($args));
}

function Encrypt($Key) {
    return md5($Key);
}

function GetValue(&$Var, $return = null) {
    return isset($Var) ? $Var : $return;
}

function SerializeIfData(&$Var) {
    return $Var ? serialize($Var) : null;
}

function SetDBNULLValue($Var) {
    return empty($Var) ? DB_NULL : $Var;
}

function GetTextFromHTML($HTML) {
    return strip_tags(html_entity_decode(htmlspecialchars_decode(preg_replace("/&#?[a-z0-9]+;/i", "", $HTML))));
}

function CleanUrl($_url) {
    $clean = '';
    $chrs = array(
        '"', '<', '>', '#', '%', '{', '}', '|', '\\', '^', '~', '[', ']', '`', "'", ' ', '--'
    );
    $url = urldecode($_url);
    foreach ($chrs as $i) {
        $clean = str_replace($i, '-', $url);
    }
    return $clean;
}

function EchoJson($json) {
    header('Content-type: application/json');
    echo json_encode($json);
    exit();
}

function EchoExit($text) {
    $d = array();
    $d['IsResult'] = $text;
    EchoJson($d);
}

function EchoError($text) {
    $d = array();
    $d['IsError'] = $text;
    EchoJson($d);
}

function SubText($str, $start, $length) {
    return mb_substr($str, $start, $length, 'utf-8');
}

function ReplaceText($search, $replace, $subject, $count = 1) {
    return str_replace($search, $replace, $subject, $count);
}

function GetLength($Str) {
    return mb_strlen(trim($Str));
}

function GetDateValue($Date = null, $Format = "Y-m-d H:i") {
    return $Date ? date($Format, strtotime($Date)) : date($Format, time());
}

function GetSinceTiming($_Time) {
    $Time = time() - strtotime($_Time);
    $Tokens = array(
        31536000 => 'سنة',
        2592000 => 'شهر',
        604800 => 'إسبوع',
        86400 => 'يوم',
        3600 => 'ساعة',
        60 => 'دقيقة',
        1 => 'ثانية'
    );
    foreach ($Tokens as $Unit => $Text) {
        if ($Time < $Unit)
            continue;
        $numberOfUnits = floor($Time / $Unit);
        return $numberOfUnits . ' ' . $Text;
    }
}

function ShareIt() {
    echo "<div id='shareit'>
        <span class='st_sharethis_hcount' displayText='ShareThis'></span>
<span class='st_twitter_hcount' displayText='Tweet'></span>
<span class='st_plusone_hcount' displayText='Google +1'></span>
<span class='st_facebook_hcount' displayText='Facebook'></span>
<span class='st_fblike_hcount' displayText='Facebook Like'></span>
<span class='st_email_hcount' displayText='Email'></span>
<style>
#shareit span {
-webkit-box-sizing: content-box;
-moz-box-sizing: content-box;
box-sizing: content-box;
}
</style>
</div>";
}

function ShareCustom($Url, $Image) {
    echo "
        <span class='st_sharethis' st_url='$Url'></span>
        <span class='st_facebook' st_url='$Url' st_image='$Image'></span>
        <span class='st_twitter' st_url='$Url' st_image='$Image'></span>
        <span class='st_pinterest' st_url='$Url' st_image='$Image'></span>
        ";
}

function ShareInit() {
    echo '<script type="text/javascript">var switchTo5x=true;</script>
<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">stLight.options({publisher: "bd2451de-ad29-4162-83a4-7fbc30204b40", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>';
}

function FBInit() {
    echo '<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/ar_AR/sdk.js#xfbml=1&version=v2.3&appId=829079453869554";
  fjs.parentNode.insertBefore(js, fjs);
}(document, \'script\', \'facebook-jssdk\'));</script>
        ';
}

function FBLikeBox($PageId, $PageName, $Width = 280) {
    echo '
        <div class="fb-page" data-href="https://www.facebook.com/' . $PageId . '" data-width="' . $Width . '" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true" data-show-posts="true"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/' . $PageId . '"><a href="https://www.facebook.com/' . $PageId . '">‏
            ' . $PageName . '
            ‏</a></blockquote></div></div>
        ';
}

function FBComments($Url, $Width = 620) {
    echo '<div class="fb-comments" data-href="' . $Url . '" data-width="' . $Width . '" data-num-posts="10"></div>';
}

function DisqusComments($Url = null) {
    ?>
    <div id="disqus_thread"></div>
    <script type="text/javascript">
        /* * * CONFIGURATION VARIABLES * * */
        var disqus_shortname = 'sethanem';
    <?php
    if ($Url) {
        echo "var disqus_url = '" . BASE_URL . $Url . "';";
    }
    ?>
        /* * * DON'T EDIT BELOW THIS LINE * * */
        (function () {
            var dsq = document.createElement('script');
            dsq.type = 'text/javascript';
            dsq.async = true;
            dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
            (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
        })();
    </script>
    <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript" rel="nofollow">comments powered by Disqus.</a></noscript>
    <?php
}

function GetBanner($dBanners, $ID) {
    if (GetValue($dBanners[$ID]))
        echo $dBanners[$ID][array_rand($dBanners[$ID])];
}

function GenerateWord($Len = 6) {
    $Chrs = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'J', 'K', 'L', 'M',
        'N', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
    $Word = '';
    for ($idx = 0; $idx < $Len; $idx++) {
        $Word .= $Chrs[rand(0, count($Chrs) - 1)];
    }
    return $Word;
}
