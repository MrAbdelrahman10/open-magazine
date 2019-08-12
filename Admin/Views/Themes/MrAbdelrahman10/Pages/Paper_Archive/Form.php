<?php
$d = &$dRow;
?>
<div class="row-fluid">
    <form method="POST" enctype="multipart/form-data" id="form" class="form-horizontal" role="form">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <?php echo $_Paper_Archive; ?>
                </div>
                <div class="panel-body">
                    <div class="col-md-12">
                        <input type="hidden" name="ID" id="ID" value="<?php echo GetValue($d['ID'], 0); ?>" />
                        <div class="form-group">
                            <?php echo Label('Title', $_Title, 'class="col-sm-2 control-label"'); ?>
                            <div class="col-sm-10">
                                <?php echo InputBox('Title', $d['Title'], $_Title, 'class="DoAlias" data-alias="Alias"'); ?>
                                <?php echo ErrorSpan('Title', $errTitle); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="panel panel-default">
                <div class="panel-heading"><?php echo $_SeoOptions; ?></div>
                <div class="panel-body">
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php echo Label('Description', $_Description, 'class="col-sm-12 control-label"'); ?>
                            <div class="col-sm-12">
                                <?php echo TextArea('Description', $d['Description'], $_Description); ?>
                                <?php echo ErrorSpan('Description', $errDescription); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php echo Label('Keywords', $_Keywords, 'class="col-sm-12 control-label"'); ?>
                            <div class="col-sm-12">
                                <?php echo InputBox('Keywords', $d['Keywords'], $_Keywords, 'class="tags"'); ?>
                                <?php echo ErrorSpan('Keywords', $errKeywords); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="panel panel-default">
                <div class="panel-heading"><?php echo $_PictureOptions; ?></div>
                <div class="panel-body">
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php echo Label('Picture', $_Picture, 'class="col-sm-4 control-label"'); ?>
                            <?php echo ImageAjaxUpload($d['Picture'], ADM_BASE . $pID . '/UploadImage', $errPicture); ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading"><?php echo $_Gallery; ?></div>
                <div class="panel-body">
                    <div class="col-sm-10 col-sm-offset-1">
                        <?php require_once ADM_CURRENT_DIR_PAGES . 'General/UploadAlbum.php'; ?>
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading"><?php echo $_PublishOptions; ?></div>
                <div class="panel-body">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <?php echo Label('State', $_State, 'class="col-sm-6 control-label"'); ?>
                            <?php echo CheckBox('State', $d['State']); ?>
                            <?php echo ErrorSpan('State', $errState); ?>
                        </div>
                    </div>

                    <hr class="clearfix" />

                    <div class="panel-footer">
                        <div class="form-actions">
                            <button type="submit" class="btn btn-large btn-primary btn-submit"><?php echo $_Save; ?></button>
                            <?php echo Anchor(ADM_BASE . $pID, $_Back, 'class="btn btn-large btn-danger"'); ?>
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
                        BeforeSubmit();
                    }, success: function (json) {
                        var _Result = json;
                        if (_Result['Redirect']) {
                            DoSuccessed();
                            Redirect(_Result['Redirect']);
                        } else if (_Result['Error']) {
                            DoWarning();
                            var e = _Result['Error'];
                            ShowError(e);
                        }
                    }, complete: function () {
                        AfterSubmit();
                    }, error: function (xhr, ajaxOptions, thrownError) {
                        DoError();
                    }});
                e.preventDefault();
                return false;
            });
    <?php
}
?>
    });
<?php ImagePicker(); ?>
</script>