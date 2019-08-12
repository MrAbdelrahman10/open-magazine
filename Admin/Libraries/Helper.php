<?php

if (!function_exists('ImagePicker')) {

    function ImagePicker($Image = 'Image', $Picture = 'Picture') {
        echo "$('#$Image').click(function() {
    var elf = $('#FileManagerDetails').elfinder({url: '" . APP_PLUGINS . "elfinder/php/connector.php', height: 490, width: 600, docked: false, dialog: {width: 700, modal: true}, getFileCallback: function(file) {
            var a = file.lastIndexOf('Media');
            var b = file.length;
            var img = file.substring(a, b);
            document.getElementById('$Picture').value =
            document.getElementById('$Image').src = img;
            $('#FileManagerDetails').modal('hide');
    }});
    });";
    }

}

function SerializeExplode($string, $delimiter = ',') {
    if ($string) {
        return serialize(explode($delimiter, $string));
    }
    return null;
}

function ImplodeUnSerialize($string, $delimiter = ',') {
    if ($string) {
        return implode(unserialize($string), $delimiter);
    }
    return null;
}
