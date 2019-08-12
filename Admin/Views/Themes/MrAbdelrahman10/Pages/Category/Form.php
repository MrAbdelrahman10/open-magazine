<?php
$d = &$dRow;
?>
<div class="row-fluid">
    <form method="POST" enctype="multipart/form-data" id="form" class="form-horizontal" role="form">
        <div class="col-md-9">
            <input type="hidden" name="ID" id="ID" value="<?php echo GetValue($d['ID'], 0); ?>" />
            <input type="hidden" name="UserID" id="UserID" value="<?php echo GetValue($d['UserID'], $pUser['ID']); ?>" />
            <div class="form-group">
                <?php echo Label('Name', $_Category, 'class="col-sm-2 control-label"'); ?>
                <div class="col-sm-10">
                    <?php echo InputBox('Name', $d['Name'], $_Category, 'class="DoAlias" data-alias="Alias"'); ?>
                    <?php echo ErrorSpan('Name', $errName); ?>
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
                <?php echo Label('Parent', $_ParentCategory, 'class="col-sm-2 control-label"'); ?>
                <div class="col-sm-10">
                    <?php echo DropDown('Parent', $dCategories); ?>
                    <?php echo ErrorSpan('Parent', $errCategory); ?>
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
                <?php echo Label('HPSO', $_HPSO, 'class="col-sm-2 control-label"'); ?>
                <div class="col-sm-10">
                    <?php echo InputBox('HPSO', $d['HPSO'], $_HPSO, '', 0); ?>
                    <?php echo ErrorSpan('HPSO', $errHPSO); ?>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading"><?php echo $_PictureOptions; ?></div>
                <div class="panel-body">
                    <div class="form-group">
                        <?php echo Label('Picture', $_Picture, 'class="col-sm-4 control-label"'); ?>
                        <?php
                        echo
                        Anchor('#FileManager', Img('Image', GetImageThumbnail(GetValue($d['Picture'])), 'class="img-polaroid pull-right" data-toggle="modal"'), 'data-toggle="modal"', false);
                        ?>
                        <iframe src="<?php echo ADM_BASE . $pID; ?>/UploadImage" class="col-sm-12 uploadImage" scrolling="no" seamless="seamless"></iframe>
                        <?php echo ErrorSpan('Picture', $errPicture); ?>
                        <?php echo InputHidden('Picture', $d['Picture']); ?>
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