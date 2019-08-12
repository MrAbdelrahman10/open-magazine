<?php
$d = &$dRow;
?>
<div class="row-fluid">
    <form method="POST" enctype="multipart/form-data" id="form" class="form-horizontal" role="form">
        <div class="col-md-9">
            <input type="hidden" name="ID" id="ID" value="<?php echo GetValue($d['ID'], 0); ?>" />
            <input type="hidden" name="UserID" id="UserID" value="<?php echo GetValue($d['UserID'], $pUser['ID']); ?>" />
            <div class="form-group">
                <?php echo Label('Title', $_Title, 'class="col-sm-2 control-label"'); ?>
                <div class="col-sm-10">
                    <?php echo InputBox('Title', $d['Title'], $_Title); ?>
                    <?php echo ErrorSpan('Title', $errTitle); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo Label('Parent', $_ParentMenu, 'class="col-sm-2 control-label"'); ?>
                <div class="col-sm-10">
                    <?php echo DropDown('Parent', $dMenus, $d['Parent']); ?>
                    <?php echo ErrorSpan('Parent', $errParent); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo Label('SortingOrder', $_SortingOrder, 'class="col-sm-2 control-label"'); ?>
                <div class="col-sm-10">
                    <?php echo InputBox('SortingOrder', $d['SortingOrder'], $_SortingOrder, '', 0); ?>
                    <?php echo ErrorSpan('SortingOrder', $errSortingOrder); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo Label('MenuItemType', $_MenuItemType, 'class="col-sm-2 control-label"'); ?>
                <div class="col-sm-8">
                    <?php echo DropDown('MenuItemType', $dMenuItemTypes, $d['MenuItemType']); ?>
                    <?php echo ErrorSpan('MenuItemType', $errMenuItemType); ?>
                </div>
                <div class="col-sm-2">
                    <?php echo Anchor('#TypeOfMenu', '<i class="icon-zoom-in icon-white"></i>' . $_Choose, 'name="Choose" id="Choose" class="btn btn-success" data-toggle="modal"', false); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo Label('Link', $_Link, 'class="col-sm-2 control-label"'); ?>
                <div class="col-sm-10">
                    <?php echo InputBox('Link', $d['Link'], $_Link, 'dir="ltr"'); ?>
                    <?php echo ErrorSpan('Link', $errLink); ?>
                    <?php echo InputHidden('LinkFormat', $dLinkFormat); ?>
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


<div class="modal fade" id="TypeOfMenu">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><?php echo $_Details ?></h4>
            </div>
            <div class="modal-body">
                <p id="TypeDetails">
                </p>
            </div>
            <div class="modal-footer">
                <button class="btn col-md-3" data-dismiss="modal" aria-hidden="true">
                    <?php echo $_Cancel ?>
                </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<script type="text/javascript" language="javascript">  $(document).ready(function () {
<?php
if ($sAdminForm_Ajax == 1) {
    ?>
            $('#form').submit(function () {
                var _Data = $(this).serialize();
                $.ajax({url: '<?php echo $pUrl; ?>', type: 'post', data: _Data, beforeSend: function () {
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
                            var i = new Array("Title", "Description", "Parent", "MenuItemType", "Target", "Link", "SortingOrder", "State");
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
        $('#MenuItemType').change(function () {
            var l = document.getElementById('Link');
            var d = $('option:selected', this).attr('data-format');
            var e = $('option:selected', this).attr('data-editable');
            var s = $('option:selected', $("#MenuItemType")).attr('data-load');
            l.value = d;
            if (s) {
                $('#Choose').show();
            } else {
                $('#Choose').hide();
            }
            SetReadOnly(e);
        });
        $('#Choose').click(function () {
            var l = document.getElementById('Link');
            var d = $('option:selected', $("#MenuItemType")).attr('data-format');
            var s = $('option:selected', $("#MenuItemType")).attr('data-load');
            if (s) {
                $.ajax({url: '<?php echo ADM_BASE ?>Show/' + s, type: 'get', beforeSend: function () {
                        $("#TypeDetails").html('<img src="<?php echo ADM_CURRENT_URL_TEMPLATE ?>img/ajax-loaders/ajax-loader-6.gif" />');
                        DoWaiting();
                    }, success: function (json) {
                        $("#TypeDetails").html(json);
                    }, complete: function () {
                        $('#Waiting').fadeOut();
                    }, error: function (xhr, ajaxOptions, thrownError) {
                        DoError();
                    }});
            }
        });
        function SetReadOnly(state) {
            var t = document.getElementById('Link');
            if (state == true) {
                t.setAttribute('readOnly', 'readonly');
            } else {
                t.removeAttribute('readOnly')
            }
        }
    });
</script>