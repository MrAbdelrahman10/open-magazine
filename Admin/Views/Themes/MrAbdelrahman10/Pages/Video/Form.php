<?php
$d = &$dRow;
?>
<div class="row-fluid">
    <form method="POST" enctype="multipart/form-data" id="form" class="form-horizontal" role="form">
        <div class="col-md-9">
            <input type="hidden" name="ID" id="ID" value="<?php echo GetValue($d['ID'], 0); ?>" />
            <div class="form-group">
                <?php echo Label('Title', $_Title, 'class="col-sm-2 control-label"'); ?>
                <div class="col-sm-10">
                    <?php echo InputBox('Title', $d['Title'], $_Title); ?>
                    <?php echo ErrorSpan('Title', $errTitle); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo Label('Url', $_Video, 'class="col-sm-2 control-label"'); ?>
                <div class="col-sm-6">
                    <?php echo InputBox('Url', $d['Url'], $_Video, 'maxlength="50"'); ?>
                    <?php echo ErrorSpan('Url', $errUrl); ?>
                </div>
                <div class="col-md-4">
                    <?php echo Img('yt', 'http://img.youtube.com/vi/' . (isset($dUrl) ? $dUrl : null) . '/1.jpg'); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo Label('Description', $_Description, 'class="col-sm-2 control-label"'); ?>
                <div class="col-sm-10">
                    <?php echo TextArea('Description', $d['Description'], $_Description); ?>
                    <?php echo ErrorSpan('Description', $errDescription); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo Label('Keywords', $_Keywords, 'class="col-sm-2 control-label"'); ?>
                <div class="col-sm-10">
                    <?php echo TextArea('Keywords', $d['Keywords'], $_Keywords, 'class="tags"'); ?>
                    <?php echo ErrorSpan('Keywords', $errKeywords); ?>
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
<?php
if ($sAdminForm_Ajax == 1) {
    ?>
            $('#form').submit(function () {
                var _Data = $(this).serialize();
                $.ajax({url: '<?php echo $pUrl; ?>',
                    type: 'post',
                    data: _Data,
                    beforeSend: function () {
                        DoWaiting();
                        $('.Error').fadeOut('slow');
                        $('.Error').html('');
                    }, success: function (json) {
                        alert(json);
                        var _Result = $.parseJSON(json);
                        if (_Result['Redirect']) {
                            DoSuccessed();
                            Redirect(_Result['Redirect']);
                        } else if (_Result['Error']) {
                            DoWarning();
                            var e = _Result['Error'];
                            ShowError(e);
                        }
                    }, complete: function () {
                    }, error: function (xhr, ajaxOptions, thrownError) {
                        DoError();
                    }});
                return false;
            });
    <?php
}
?>
        $('#Url').change(function () {
            var id = $(this).val();
            $('#yt').attr('src', 'https://i.ytimg.com/vi_webp/' + id + '/default.webp');
//            $.ajax({url: 'http://gdata.youtube.com/feeds/api/videos?q='+id+'&max-results=1&v=2&alt=jsonc',
//                type: 'get',
//                beforeSend: function () {
//                }, success: function (json) {
//                    var v = json['data']['items'][0];
//                    $('#Title').val(v['title']);
//                    $('#Description').val(v['description']);
//                    $('#Url').val(v['id']);
//                    $('#yt').attr('src', v['thumbnail']['sqDefault']);
//                }, complete: function () {
//                }, error: function (xhr, ajaxOptions, thrownError) {
//                }});
        });
    });
</script>