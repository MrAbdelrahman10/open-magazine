<?php
$d = &$dRow;
?>
<div class="row-fluid">
    <form method="POST" enctype="multipart/form-data" id="form" class="form-horizontal" role="form">
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-md-12">
                        <input type="hidden" name="ID" id="ID" value="<?php echo GetValue($d['ID'], 0); ?>" />
                        <input type="hidden" name="UserID" id="UserID" value="<?php echo GetValue($d['UserID'], $pUser['ID']); ?>" />
                        <div class="form-group">
                            <?php echo Label('Title', $_Title, 'class="col-sm-2 control-label"'); ?>
                            <div class="col-sm-10">
                                <?php echo InputBox('Title', $d['Title'], $_Title, 'class="DoAlias" data-alias="Alias" data-toggle="popover" title="Popover title" data-content="And here is some amazing content. It is very engaging. Right?"'); ?>
                                <?php echo ErrorSpan('Title', $errTitle); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <?php echo Label('Alias', $_Alias, 'class="col-sm-2 control-label"'); ?>
                            <div class="col-sm-10">
                                <?php echo InputBox('Alias', $d['Alias'], $_Alias, 'maxlength="50"'); ?>
                                <?php echo ErrorSpan('Alias', $errAlias); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <?php echo Label('Category', $_Category, 'class="col-sm-2 control-label"'); ?>
                            <div class="col-sm-10">
                                <?php echo DropDown('Category', $dCategoriesList, $d['Category']); ?>
                                <?php echo ErrorSpan('Category', $errCategory); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <?php echo Label('Contents', $_Contents, 'class="col-sm-2 control-label"'); ?>
                            <div class="col-sm-10">
                                <?php echo TextArea('Contents', $d['Contents'], $_Contents, 'class="editor"'); ?>
                                <?php echo ErrorSpan('Contents', $errContents); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading"><?php echo $_Gallery; ?></div>
                    <div class="panel-body">
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
                    </div>
                </div>
            </div>

        </div>
        <div class="col-md-3">

            <div class="panel panel-default">
                <div class="panel-heading"><?php echo $_PublishOptions; ?></div>
                <div class="panel-body">
                    <div class="form-group">
                        <?php echo Label('CreatedDate', $_CreatedDate, 'class="col-sm-12 control-label"'); ?>
                        <div class="col-sm-12">
                            <?php
                            $cdate = GetValue($dCreatedDate, date('Y/m/d h:i', time()));
                            echo InputBox('CreatedDate', $cdate, $cdate, 'class="datetime"')
                            ?>
                            <?php echo ErrorSpan('CreatedDate', $errCreatedDate); ?>
                            <br />
                            مثال
                            :
                            "2010/10/28 10:50"
                        </div>
                    </div>
                    <div class="form-group">
                        <?php echo Label('Featured', $_Featured, 'class="col-sm-6 control-label"'); ?>
                        <?php echo CheckBox('Featured', $d['Featured']); ?>
                        <?php echo ErrorSpan('Featured', $errFeatured); ?>
                    </div>
                    <div class="form-group">
                        <?php echo Label('Approved', $_Approved, 'class="col-sm-6 control-label"'); ?>
                        <?php echo CheckBox('Approved', $d['Approved']); ?>
                        <?php echo ErrorSpan('Approved', $errApproved); ?>
                    </div>
                    <div class="form-group">
                        <?php echo Label('State', $_State, 'class="col-sm-6 control-label"'); ?>
                        <?php echo CheckBox('State', $d['State']); ?>
                        <?php echo ErrorSpan('State', $errState); ?>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-large btn-primary btn-submit"><?php echo $_Save; ?></button>
                        <?php echo Anchor('javascript:void(0)', $_Preview, 'id="Preview" target="_blank" class="btn btn-large btn-primary"', false); ?>
                        <?php echo Anchor(ADM_BASE . $pID, $_Back, 'class="btn btn-large btn-danger"'); ?>
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading"><?php echo $_PictureOptions; ?></div>
                <div class="panel-body">
                    <div class="form-group">
                        <?php echo Label('Picture', $_Picture, 'class="col-sm-4 control-label"'); ?>
                        <?php echo ImageAjaxUpload($d['Picture'], ADM_BASE . $pID . '/UploadImage', $errPicture); ?>
                    </div>
                    <div class="form-group">
                        <?php echo Label('PictureDescription', $_PictureDescription, 'class="col-sm-12 control-label"'); ?>
                        <div class="col-sm-12">
                            <?php echo InputBox('PictureDescription', $d['PictureDescription']); ?>
                            <?php echo ErrorSpan('PictureDescription', $errPictureDescription); ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading"><?php echo $_SeoOptions; ?></div>
                <div class="panel-body">
                    <div class="form-group">
                        <?php echo Label('Description', $_Description, 'class="col-sm-12 control-label"'); ?>
                        <div class="col-sm-12">
                            <?php echo TextArea('Description', $d['Description'], $_Description); ?>
                            <?php echo ErrorSpan('Description', $errDescription); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <?php echo Label('Keywords', $_Keywords, 'class="col-sm-12 control-label"'); ?>
                        <div class="col-sm-12">
                            <?php echo TextArea('Keywords', $d['Keywords'], $_Keywords, 'class="tags"'); ?>
                            <?php echo ErrorSpan('Keywords', $errKeywords); ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </form>
</div>

<script type="text/javascript" language="javascript">
    $(document).ready(function () {
<?php
if ($sAdminForm_Ajax == 1) {
    ?>
            $('#form').submit(function (e) {
                ckUpdate();
                var _Data = $(this).serialize();
                $.ajax({
                    url: '<?php echo $pUrl; ?>',
                    type: 'post',
                    data: _Data,
                    beforeSend: function () {
                        DoWaiting();
                        $('.Error').fadeOut('slow');
                        $('.Error').html('');
                    }, success: function (json) {
                        var _Result = $.parseJSON(json);
                        if (_Result['Redirect']) {
                            DoSuccessed();
                            Redirect(_Result['Redirect']);
                        } else if (_Result['Error']) {
                            DoWarning();
                            var e = _Result['Error'];
                            var i = new Array("Title", "Alias", "PictureDescription", "Contents", "Description", "Keywords", "Category", "CreatedDate", "ModifiedDate", "Slider", "State");
                            ShowError(i, e);
                        }
                    }, complete: function () {
                    }, error: function (xhr, ajaxOptions, thrownError) {
                        DoError();
                    }});
                e.preventDefault();
                return false;
            });
    <?php
}
?>

        $('#Preview').click(function () {
            var _Data = $('#form').serialize();
            $.ajax({
                url: '<?php echo ADM_BASE; ?>Article/Preview',
                type: 'post',
                data: _Data,
                beforeSend: function () {
                }, success: function (json) {
                    var url = '<?php echo BASE_URL; ?>news/Preview/' + json;
                    window.open(url, '', 'height=screen.availHeight,width=screen.availWidth,toolbar=no,directories=no,status=no, menubar=no,scrollbars=no,resizable=no');
                }, complete: function () {
                }, error: function (xhr, ajaxOptions, thrownError) {
                    DoError();
                }});
            return false;
        });


    });
<?php ImagePicker(); ?>
</script>