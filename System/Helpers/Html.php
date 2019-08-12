<?php

function Anchor($uri, $title, $attributes = '', $ajax = true) {
    return '<a href="' . $uri . '" ' . $attributes . (($ajax == true) ? ' data-ajax="true" ' : '') . '>' . $title . '</a>';
}

function CheckBox($Name, &$Selected = false, $Class = '', $HiddenAttributes = '', $enable = true, $ArrayName = null) {
    $Values = array(
        1 => GetLang('_Yes'),
        0 => GetLang('_No')
    );
    return RadioButton($Name, $Values, $Selected, $Class, $HiddenAttributes, $enable, $ArrayName);
}

function RadioButton($Name, $Values, &$Selected = 1, $Class = '', $HiddenAttributes = '', $Enable = true, $ArrayName = null) {
    $radio = '<div class="input-group">
        <div id="radio' . $Name . '" class="radioBtn btn-group">';
    foreach ($Values as $k => $v) {
        $radio .= '<a class="btn ' . $Class . ' btn-sm ' .
                (GetValue($Selected) == $k ? 'btn-primary active' : 'btn-default notActive') .
                '" data-toggle="' . $Name . '" data-id="' . $k . '" ' . ($Enable ? '' : 'disabled') . '>' . $v . '</a>';
    }
    $radio .= '</div>
    	<input type="hidden" name="' . ($ArrayName ? $ArrayName . '[]' : $Name) . '" id="' . $Name . '" value="' . $Selected . '" ' . $HiddenAttributes . '>
    	</div>
        ';

    return $radio;
}

function InputBox($Name, &$Value, $PlaceHolder = '', $Attributes = '', $Default = '') {
    return '<input type="text" name="' . $Name .
            '" id="' . $Name . '" value="' . GetValue($Value, $Default) .
            '" placeholder="' . $PlaceHolder . '" ' . $Attributes . ' />';
}

function AppendBox($Name, &$Value, $PlaceHolder = '', $before = null, $after = null, $type = 'text', $Attributes = '', $Default = '') {
    return '
        <div class="input-group">' .
            ($before ? '<span class="input-group-addon">' . $before . '</span>' : '') .
            '<input type="' . $type . '" class="form-control"
                name="' . $Name .
            '" id="' . $Name . '"
                placeholder="' . $PlaceHolder . '"
                value="' . $Value . '">' .
            ($after ? '<span class="input-group-addon">' . $after . '</span>' : '') .
            '</div>
        ';
}

function InputPassword($Name, &$Value, $PlaceHolder = '', $Attributes = '') {
    return '<input type="password" name="' . $Name .
            '" id="' . $Name . '" value="' . GetValue($Value) .
            '" placeholder="' . $PlaceHolder . '" ' . $Attributes . ' />';
}

function InputHidden($Name, &$Value = '', $Attributes = '', $Default = '') {
    return '<input type="hidden" name="' . $Name .
            '" id="' . $Name . '" value="' . GetValue($Value, $Default) . '" ' . $Attributes . ' />';
}

function TextArea($Name, &$Value, $PlaceHolder = '', $Attributes = '') {
    return '<textarea name="' . $Name .
            '" id="' . $Name . '" placeholder="' . $PlaceHolder .
            '" ' . $Attributes . ' >' . GetValue($Value) . '</textarea>';
}

function DropDown($Name, $Value = '', &$Selected = 0, $Attributes = '') {
    return '<select name="' . $Name . '" id="' . $Name . '" data-select="' . GetValue($Selected, 0) . '" ' . $Attributes . '>' .
            $Value
            . '</select>';
}

function Img($Name, $Value = '', $Attributes = '') {
    return '<img name="' . $Name . '" id="' . $Name . '" src="' . $Value .
            '" ' . $Attributes . ' />';
}

function ImgLazy($Path, $Width, $Height, $Class = '', $Attributes = '') {
    return '<img class="lazy img-thumbnail img-responsive ' . $Class . '" data-src="' . GetImageOriginal($Path) . '" src="' . GetImageThumbnail($Path) . '" width="' . $Width . '" height="' . $Height . '" ' . $Attributes . ' />';
}

function Label($ID, $Value = '', $Attributes = '') {
    return '<label for="' . $ID . '" ' . $Attributes . '>' . $Value . '</label>';
}

function ErrorSpan($ID, &$Value = '', $Attributes = '') {
    return '<span id="err' . $ID . '" class="Error" ' . $Attributes . '>' .
            GetValue($Value) .
            '</span>' . ($Value ? '<script type="text/javascript">
        $(document).ready(function () {
            $("#' . $ID . '").parent("div").parent("div").addClass("has-error");
        });
</script>' : '');
}

function DataChooser($ID, $vValue, $hValue, $DataSource, $PlaceHolder = null) {
    return InputBox('Data-' . $ID, $vValue, $PlaceHolder, 'readonly="readonly"') .
            InputHidden($ID, $hValue) .
            Anchor('#ChooseData', '<i class="icon-zoom-in icon-white"></i>' . GetLang('_Choose'), ' class="btn btn-success DataChoose" data-toggle="modal" data-source="' . $DataSource . '"', false) .
            Anchor('javascript:void(0)', '<i class="icon-trash icon-white"></i>' . GetLang('_Delete'), 'class="btn btn-danger" onclick="$(\'#' . $ID . ', #Data-' . $ID . '\').val(\'\');"', false);
}

function ImageAjaxUpload(&$PictureValue, $Url, &$errPicture, $PictureID = 'Picture', $ImageID = 'Image') {
    return Anchor('#FileManager', Img($ImageID, GetImageThumbnail(GetValue($PictureValue)), 'class="img-polaroid img-up" data-toggle="modal"'), 'data-toggle="modal"', false) . '
                            <iframe src="' . $Url . "?pic_file=$PictureID&img_file=$ImageID" . '" class="uploadImage" scrolling="no" seamless="seamless"></iframe>' .
            ErrorSpan($PictureID, $errPicture) .
            InputHidden($PictureID, $PictureValue);
}

function IncludeStyle($url) {
    echo '<link rel="stylesheet" href="' . $url . '">';
}

function IncludeScript($url) {
    echo '<script src="' . $url . '"></script>';
}
