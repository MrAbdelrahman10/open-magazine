<?php
$d = &$dRow;
?>
<div class="row-fluid">
    <form method="POST" enctype="multipart/form-data" id="form" class="form-horizontal" role="form">
        <div class="col-md-9">
            <input type="hidden" name="ID" id="ID" value="<?php echo GetValue($d['ID'], 0); ?>" />
            <input type="hidden" name="UserID" id="UserID" value="<?php echo GetValue($d['UserID'], $pUser['ID']); ?>" />
            <div class="form-group">
                <?php echo Label('FullName', $_FullName, 'class="col-sm-2 control-label"'); ?>
                <div class="col-sm-10">
                    <?php echo InputBox('FullName', $d['FullName']); ?>
                    <?php echo ErrorSpan('FullName', $errFullName); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo Label('Email', $_Email, 'class="col-sm-2 control-label"'); ?>
                <div class="col-sm-10">
                    <?php echo InputBox('Email', $d['Email']); ?>
                    <?php echo ErrorSpan('Email', $errEmail); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo Label('UserName', $_UserName, 'class="col-sm-2 control-label"'); ?>
                <div class="col-sm-10">
                    <?php echo InputBox('UserName', $d['UserName']); ?>
                    <?php echo ErrorSpan('UserName', $errUserName); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo Label('Password', $_Password, 'class="col-sm-2 control-label"'); ?>
                <div class="col-sm-10">
                    <?php echo InputPassword('Password', $__); ?>
                    <?php echo ErrorSpan('Password', $errPassword); ?>
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
                    <?php
                    if (GetValue($d['IsActive']) != 1 || $pAction == 'Add') {
                        ?>
                        <div class="form-group">
                            <?php echo Label('IsActive', $_IsActive, 'class="col-sm-5 control-label"'); ?>
                            <?php echo CheckBox('IsActive', $d['IsActive']); ?>
                            <?php echo ErrorSpan('IsActive', $errIsActive); ?>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-large btn-primary btn-submit"><?php echo $_Save; ?></button>
                        <?php echo Anchor(ADM_BASE . $pID, $_Back, 'class="btn btn-large btn-danger"'); ?>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script type="text/javascript" language="javascript"> $(document).ready(function () {
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
</script>