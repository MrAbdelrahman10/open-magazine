<?php if ($dResults) { ?>
    <div class="table-responsive">
        <div class="table table-striped table-bordered bootstrap-datatable ">
            <div class="col-md-12">
                <div class="col-xs-1"></div>
                <div class="col-xs-1"> <?php echo $_ID ?> </div>
                <div class="col-xs-4"> <?php echo $_Title ?> </div>
                <div class="col-xs-3"> <?php echo $_State ?> </div>
                <div class="col-xs-3"></div>
            </div>
            <ul id="data" class="col-md-12">
                <?php foreach ($dResults as $Item) { ?>
                    <li class="col-xs-12 ui-state-default sortable" id="item-<?php echo $Item['ID']; ?>" data-id="<?php echo $Item['ID']; ?>">
                        <?php
                        if ($Item['IsParent']) {
                            echo '<ul>';
                        }
                        ?>
                        <div class="">
                            <div class="col-xs-1">
                                <input id="C-<?php echo $Item['ID']; ?>" class="DelCheck" type="checkbox" onclick="MultiCheck('<?php echo $Item['ID']; ?>')" />
                            </div>
                            <div class="col-xs-1"><?php echo $Item['ID']; ?></div>
                            <div class="col-xs-4"><?php echo $Item['Title']; ?></div>
                            <div class="col-xs-3">
        <?php echo CheckBox('State-' . $Item['ID'], $Item['State'], 'itemState', 'data-id="' . $Item['ID'] . '"'); ?>
                            </div>
                            <div class="col-xs-3">
        <?php echo Anchor(ADM_BASE . $pID . '/Edit/' . $Item['ID'], '<i class="glyphicon glyphicon-edit glyphicon-white"></i>' . $_Edit, 'class="btn btn-primary"') ?><?php echo Anchor('#DetailOperation', '<i class="glyphicon glyphicon-zoom-in glyphicon-white"></i>' . $_Details, 'id="d-' . $Item['ID'] . '" class="Details btn btn-success" data-toggle="modal"', false); ?>
                            </div>
                            <hr  class="clearfix" />
                        </div>
                        <?php
                        if ($Item['IsParent']) {
                            echo '</ul>';
                        }
                        ?>
                    </li>
    <?php } ?>
            </ul>
        </div>
    </div>
    <hr  class="clearfix" />
    <div class="col-md-4 col-md-offset-4" id="updateMenuDiv">
        <a href="javascript:void(0)" id="updateMenu" class="btn btn-primary btn-block"><?php echo $_UpdateMenu; ?></a>
    </div>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#updateMenu').hide();
            var _SortingItems;
            $("#data").sortable({
                stop: function (e, ui) {
                    $('#updateMenu').show();
                    _SortingItems = $.map($(this).find('li'), function (el) {
                        return $(el).attr('data-id') + '=' + $(el).index();
                    });
                }
            });
            $("#data").disableSelection();
            $('#updateMenu').click(function () {
                $.ajax({
                    url: '<?php echo ADM_BASE . $pID; ?>/UpdateMenu',
                    type: 'post',
                    data: {Sort: _SortingItems},
                    beforeSend: function () {
                        $("#updateMenuDiv").html('<img src="<?php echo ADM_CURRENT_URL_TEMPLATE ?>img/ajax-loaders/ajax-loader-6.gif" />');
                    }, success: function (json) {
                        alert(json['IsResult']);
                        Redirect('<?php echo $pUrl; ?>');
                    }, complete: function () {
                    }, error: function (xhr, ajaxOptions, thrownError) {
                    }});
            });
        });
    </script>

    <?php
}