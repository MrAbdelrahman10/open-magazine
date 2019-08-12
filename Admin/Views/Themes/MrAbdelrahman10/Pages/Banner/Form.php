<?php
$d = &$dRow;
?>
<div class="row-fluid">
    <form method="POST" enctype="multipart/form-data" id="form" class="form-horizontal" role="form">
        <div class="col-md-9">
            <input type="hidden" name="ID" id="ID" value="<?php echo GetValue($d['ID'], 0); ?>" />
            <div class="form-group">
                <?php echo Label('Name', $_BannerName, 'class="col-sm-3 control-label"'); ?>
                <div class="col-sm-9">
                    <?php echo InputBox('Name', $d['Name'], $_BannerName); ?>
                    <?php echo ErrorSpan('Name', $errName); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo Label('BannerPosition', $_BannerPosition, 'class="col-sm-3 control-label"'); ?>
                <div class="col-sm-9">
                    <?php echo DropDown('BannerPosition', $dBannerPositions, $d['BannerPosition']); ?>
                    <?php echo ErrorSpan('BannerPosition', $errBannerPosition); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo Label('BannerType', $_BannerType, 'class="col-sm-3 control-label"'); ?>
                <div class="col-sm-9">
                    <?php echo DropDown('BannerType', $dBannerTypesList, $d['BannerType']); ?>
                    <?php echo ErrorSpan('BannerType', $errBannerType); ?>
                </div>
            </div>

            <div id="ImageBanner">
                <div class="form-group">
                    <?php echo Label('Picture', $_Picture, 'class="col-sm-4 control-label"'); ?>
                    <?php echo ImageAjaxUpload($d['Picture'], ADM_BASE . $pID . '/UploadImage', $errPicture); ?>
                </div>
                <div class="form-group">
                    <?php echo Label('Url', $_Url, 'class="col-sm-3 control-label"'); ?>
                    <div class="col-sm-9">
                        <?php echo InputBox('Url', $d['Url'], $_Url); ?>
                        <?php echo ErrorSpan('Url', $errUrl); ?>
                    </div>
                </div>
            </div>
            <div id="CodeBanner">
                <div class="form-group">
                    <?php echo Label('BannerCode', $_Code, 'class="col-sm-3 control-label"'); ?>
                    <div class="col-sm-9">
                        <?php echo TextArea('BannerCode', $d['BannerCode'], $_Code, 'class="editor1"'); ?>
                        <?php echo ErrorSpan('BannerCode', $errBannerCode); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">

            <div class="panel panel-default">
                <div class="panel-heading"><?php echo $_PublishOptions; ?></div>
                <div class="panel-body">
                    <div class="form-group">
                        <?php echo Label('State', $_State, 'class="col-sm-5 control-label"'); ?>
                        <?php echo CheckBox('State', $d['State']); ?>
                        <?php echo ErrorSpan('State', $errState); ?>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-large btn-primary btn-submit"><?php echo $_Save; ?></button>
                        <?php echo Anchor(ADM_BASE . $pID, $_Back, 'class="btn btn-large btn-danger"'); ?>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script type="text/javascript" language="javascript">
    $(document).ready(function () {
        LoadType();
<?php
if ($sAdminForm_Ajax == 1) {
    ?>
            $('#form').submit(function () {
                var _Data = $(this).serialize();
                $.ajax({
                    url: '<?php echo $pUrl; ?>',
                    type: 'post', data: _Data,
                    beforeSend: function () {
                        DoWaiting();
                        $('.Error').fadeOut('slow');
                        $('.Error').html('');
                    }, success: function (json) {
                        var _Result = $.parseJSON(json);
                        if (_Result['Redirect']) {
                            DoSuccessed();
                            Redirect(_Result['Redirect']);
                        }
                        else if (_Result['Error']) {
                            DoWarning();
                            var e = _Result['Error'];
                            ShowError(e);
                        }
                    }, complete: function () {
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        DoError();
                    }
                });
                e.preventDefault();
                return false;
            });
    <?php
}
?>
        $('#BannerType').change(function () {
            LoadType();
        });

    });

    function LoadType() {
        var t = $('#BannerType').val();
        if (t == <?php echo BannerType::Image; ?>) {
            $('#CodeBanner').hide();
            $('#ImageBanner').show();
        } else {
            $('#ImageBanner').hide();
            $('#CodeBanner').show();
        }
    }
<?php ImagePicker(); ?>
</script>