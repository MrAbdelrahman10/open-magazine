<script type="text/javascript">
    $(document).ready(function () {
        $("#demo1").AjaxFileUpload({
            onComplete: function (filename, response) {
                var _divID = 'd' + Math.floor(Date.now() / 1000) + Math.floor((Math.random() * 10000) + 1);
                var _Pic = response['name'];
                $("#uploads").append('<div id="' + _divID + '" class="col-md-4"></div>');
                $('#' + _divID).append('<input type="hidden" class="valSliderPictures" name="SliderPictures[]" value="' + _Pic + '" />').
                        append('<img src="' + _Pic + '" class="img-responsive" />').
                        append('<br />').
                        append('<a href="javascript:void(0)" class="btn btn-danger btn-block text-center" onclick="removeImg(\'' + _divID + '\');"><?php echo $_Delete; ?></a>');
            }
        });

        $("#uploads").sortable();
        $("#uploads").disableSelection();

    });
    function removeImg(_id) {
        $('#' + _id).fadeOut('slow').remove();
    }
</script>

<div class="form-group">
    <input type="file" name="imagealbum" id="demo1" class="form-control" />
</div>
<?php
$Pictures = '';
$_Pics = is_array(GetValue($d['SliderPictures'])) ? $d['SliderPictures'] : unserialize(GetValue($d['SliderPictures']));
?>
<ul id="uploads">
    <?php
    if ($_Pics) {
        foreach ($_Pics as $pi) {
            $___id = uniqid();
            echo '<li id="' . $___id . '" class="col-md-3 ui-state-default">';
            echo InputHidden('SliderPictures[]', $pi);
            echo Img('imgSliderPictures[]', GetImageThumbnail($pi, 150, 150), 'class="img-responsive"');
            echo '<br />';
            echo '<a href="javascript:void(0)" class="btn btn-danger btn-block text-center" onclick="removeImg(\'' . $___id . '\');">' . $_Delete . '</a>';
            echo '</li>';
        }
    }
    ?>
</ul>