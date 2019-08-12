<?php
$d = &$dRow;
?>
<div class="row-fluid">
    <form method="POST" enctype="multipart/form-data" id="form" class="form-horizontal" role="form">

        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading"><?php echo $_Save; ?></div>
                <div class="panel-body">

                    <div class="form-actions">
                        <button type="submit" class="btn btn-large btn-primary btn-submit col-md-6"><?php echo $_Save; ?></button>
                        <?php echo Anchor(ADM_BASE, $_Back, 'class="btn btn-large btn-danger col-md-6"'); ?>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading"><?php echo ''; ?></div>
                <div class="panel-body">
                    <div class="form-group">
                        <?php echo Label('Site_Theme', $_Site_Theme, 'class="col-sm-5 control-label"'); ?>
                        <div class="col-sm-7">
                            <?php echo DropDown('Site_Theme', $dSite_Themes); ?>
                            <?php echo ErrorSpan('Site_Theme', $errSite_Theme); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <?php echo Label('Administrator_Theme', $_Administrator_Theme, 'class="col-sm-5 control-label"'); ?>
                        <div class="col-sm-7">
                            <?php echo DropDown('Administrator_Theme', $dAdministrator_Themes); ?>
                            <?php echo ErrorSpan('Administrator_Theme', $errAdministrator_Theme); ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading"><?php echo ''; ?></div>
                <div class="panel-body">

                    <div class="form-group">
                        <?php echo Label('Twitter', $_Twitter, 'class="col-sm-5 control-label"'); ?>
                        <div class="col-sm-7">
                            <?php echo InputBox('Twitter', $d['Twitter'], $_Twitter); ?>
                            <?php echo ErrorSpan('Twitter', $errTwitter); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <?php echo Label('Facebook', $_Facebook, 'class="col-sm-5 control-label"'); ?>
                        <div class="col-sm-7">
                            <?php echo InputBox('Facebook', $d['Facebook'], $_Facebook); ?>
                            <?php echo ErrorSpan('Facebook', $errFacebook); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <?php echo Label('Google_Plus', $_Google_Plus, 'class="col-sm-5 control-label"'); ?>
                        <div class="col-sm-7">
                            <?php echo InputBox('Google_Plus', $d['Google_Plus'], $_Google_Plus); ?>
                            <?php echo ErrorSpan('Google_Plus', $errGoogle_Plus); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <?php echo Label('Youtube', $_Youtube, 'class="col-sm-5 control-label"'); ?>
                        <div class="col-sm-7">
                            <?php echo InputBox('Youtube', $d['Youtube'], $_Youtube); ?>
                            <?php echo ErrorSpan('Youtube', $errYoutube); ?>
                        </div>
                    </div>


                </div>
            </div>


        </div>
        <div class="col-md-8">

            <div class="panel panel-default">
                <div class="panel-heading"><?php echo ''; ?></div>
                <div class="panel-body">

                    <div class="form-group">
                        <?php echo Label('Site_Name', $_Site_Name, 'class="col-sm-4 control-label"'); ?>
                        <div class="col-sm-8">
                            <?php echo InputBox('Site_Name', $d['Site_Name'], $_Site_Name); ?>
                            <?php echo ErrorSpan('Site_Name', $errSite_Name); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <?php echo Label('Email', $_Email, 'class="col-sm-4 control-label"'); ?>
                        <div class="col-sm-8">
                            <?php echo InputBox('Email', $d['Email'], $_Email); ?>
                            <?php echo ErrorSpan('Email', $errEmail); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <?php echo Label('Phone', $_Phone, 'class="col-sm-4 control-label"'); ?>
                        <div class="col-sm-8">
                            <?php echo InputBox('Phone', $d['Phone'], $_Phone); ?>
                            <?php echo ErrorSpan('Phone', $errPhone); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <?php echo Label('Description', $_Description, 'class="col-sm-4 control-label"'); ?>
                        <div class="col-sm-8">
                            <?php echo TextArea('Description', $d['Description'], $_Description); ?>
                            <?php echo ErrorSpan('Description', $errDescription); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <?php echo Label('Keywords', $_Keywords, 'class="col-sm-4 control-label"'); ?>
                        <div class="col-sm-8">
                            <?php echo TextArea('Keywords', $d['Keywords'], $_Keywords); ?>
                            <?php echo ErrorSpan('Keywords', $errKeywords); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <?php /*echo Label('ExtraScripts', $_ExtraScripts, 'class="col-sm-4 control-label"'); ?>
                        <div class="col-sm-8">
                            <?php echo TextArea('ExtraScripts', $d['ExtraScripts'], $_ExtraScripts, 'dir="ltr"'); ?>
                            <?php echo ErrorSpan('ExtraScripts', $errExtraScripts);*/ ?>
                        </div>
                    </div>

                    <div class="form-group hide">
                        <?php echo Label('Watermark', $_Watermark, 'class="col-sm-4 control-label"'); ?>
                        <div class="col-sm-8">
                            <?php echo InputBox('Watermark', $d['Watermark'], $_Watermark); ?>
                            <?php echo ErrorSpan('Watermark', $errWatermark); ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </form>
</div>