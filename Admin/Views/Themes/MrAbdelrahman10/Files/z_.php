<!DOCTYPE html>
<html lang="<?php echo $_Lang ?>" dir="<?php echo $_Direction ?>">
    <head>
        <base href="<?php echo SITE_URL; ?>" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>
            <?php echo $_ControlPanel ?>
        </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <!-- Fav and touch icons -->
        <link rel="shortcut icon" href="<?php echo APP_PUBLIC; ?>ico/favicon.ico">
    </head>
    <body>
        <!-- Fixed navbar -->
        <div class="navbar navbar-fixed-top navbar-inverse" id="nav" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="glyphicon glyphicon-bar"></span>
                        <span class="glyphicon glyphicon-bar"></span>
                        <span class="glyphicon glyphicon-bar"></span>
                    </button>
                    <?php echo Anchor(ADM_BASE, '<i class="glyphicon glyphicon-home"></i>', 'class="navbar-brand"', false); ?>
                </div>
                <div class="navbar-collapse collapse pull-right visible-md">
                    <ul class="nav navbar-nav">
                        <li>
                            <?php echo Anchor(SITE_URL, $_BrowseSite, 'target="_blank"', false); ?>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $_Articles; ?> <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li class="dropdown-header"><?php echo $_Articles; ?></li>
                                <li>
                                    <?php echo Anchor(ADM_BASE . 'Article/Add', '<i class="glyphicon glyphicon-plus"></i> ' . $_Articles_Add); ?>
                                </li>
                                <li>
                                    <?php echo Anchor(ADM_BASE . 'Article', '<i class="glyphicon glyphicon-eye-open"></i> ' . $_Articles_View); ?>
                                </li>
                                <li class="divider"></li>
                                <li class="dropdown-header"><?php echo $_Articles_tmp; ?></li>
                                <li>
                                    <?php echo Anchor(ADM_BASE . 'Article_tmp/Add', '<i class="glyphicon glyphicon-plus"></i> ' . $_Articles_tmp_Add); ?>
                                </li>
                                <li>
                                    <?php echo Anchor(ADM_BASE . 'Article_tmp', '<i class="glyphicon glyphicon-eye-open"></i> ' . $_Articles_tmp_View); ?>
                                </li>
                                <li class="divider"></li>
                                <li class="dropdown-header"><?php echo $_Comments; ?></li>
                                <li>
                                    <?php echo Anchor(ADM_BASE . 'Comment', '<i class="glyphicon glyphicon-eye-open"></i> ' . $_Comments_View); ?>
                                </li>
                                <li class="divider"></li>
                                <li class="dropdown-header"><?php echo $_Categories; ?></li>
                                <li>
                                    <?php echo Anchor(ADM_BASE . 'Category/Add', '<i class="glyphicon glyphicon-plus"></i> ' . $_Categories_Add); ?>
                                </li>
                                <li>
                                    <?php echo Anchor(ADM_BASE . 'Category', '<i class="glyphicon glyphicon-eye-open"></i> ' . $_Categories_View); ?>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $_Multimedia; ?> <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li class="dropdown-header"><?php echo $_Galleries; ?></li>
                                <li>
                                    <?php echo Anchor(ADM_BASE . 'Gallery/Add', '<i class="icon-plus"></i> ' . $_Galleries_Add) ?>
                                </li>
                                <li>
                                    <?php echo Anchor(ADM_BASE . 'Gallery', '<i class="icon-eye-open"></i> ' . $_Galleries_View) ?>
                                </li>
                                <li class="divider"><span></span></li>
                                <li class="dropdown-header"><?php echo $_Videos; ?></li>
                                <li>
                                    <?php echo Anchor(ADM_BASE . 'Video/Add', '<i class="icon-plus"></i> ' . $_Videos_Add) ?>
                                </li>
                                <li>
                                    <?php echo Anchor(ADM_BASE . 'Video', '<i class="icon-eye-open"></i> ' . $_Videos_View) ?>
                                </li>
                                <li class="divider"><span></span></li>
                                <li class="dropdown-header"><?php echo $_Comics; ?></li>
                                <li>
                                    <?php echo Anchor(ADM_BASE . 'Comic/Add', '<i class="icon-plus"></i> ' . $_Comics_Add) ?>
                                </li>
                                <li>
                                    <?php echo Anchor(ADM_BASE . 'Comic', '<i class="icon-eye-open"></i> ' . $_Comics_View) ?>
                                </li>
                                <li class="divider"><span></span></li>
                                <li class="dropdown-header"><?php echo $_Paper_Archives; ?></li>
                                <li>
                                    <?php echo Anchor(ADM_BASE . 'Paper_Archive/Add', '<i class="icon-plus"></i> ' . $_Paper_Archives_Add) ?>
                                </li>
                                <li>
                                    <?php echo Anchor(ADM_BASE . 'Paper_Archive', '<i class="icon-eye-open"></i> ' . $_Paper_Archives_View) ?>
                                </li>
                                <li class="divider"><span></span></li>
                                <li class="dropdown-header"><?php echo $_DayPicture; ?></li>
                                <li>
                                    <?php echo Anchor(ADM_BASE . 'DayPicture/Add', '<i class="icon-plus"></i> ' . $_DayPictures_Add) ?>
                                </li>
                                <li>
                                    <?php echo Anchor(ADM_BASE . 'DayPicture', '<i class="icon-eye-open"></i> ' . $_DayPictures_View) ?>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $_Polls; ?> <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li class="dropdown-header"><?php echo $_Polls; ?></li>
                                <li>
                                    <?php echo Anchor(ADM_BASE . 'Poll/Add', '<i class="glyphicon glyphicon-plus"></i> ' . $_Polls_Add); ?>
                                </li>
                                <li>
                                    <?php echo Anchor(ADM_BASE . 'Poll', '<i class="glyphicon glyphicon-eye-open"></i> ' . $_Polls_View); ?>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $_Pages; ?> <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li class="dropdown-header"><?php echo $_Pages; ?></li>
                                <li>
                                    <?php echo Anchor(ADM_BASE . 'Page/Add', '<i class="glyphicon glyphicon-plus"></i> ' . $_Pages_Add); ?>
                                </li>
                                <li>
                                    <?php echo Anchor(ADM_BASE . 'Page', '<i class="glyphicon glyphicon-eye-open"></i> ' . $_Pages_View); ?>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $_Menus; ?> <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li class="dropdown-header"><?php echo $_Menus; ?></li>
                                <li>
                                    <?php echo Anchor(ADM_BASE . 'Menu/Add', '<i class="glyphicon glyphicon-plus"></i> ' . $_Menus_Add); ?>
                                </li>
                                <li>
                                    <?php echo Anchor(ADM_BASE . 'Menu', '<i class="glyphicon glyphicon-eye-open"></i> ' . $_Menus_View); ?>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $_Banners; ?> <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li class="dropdown-header"><?php echo $_Banners; ?></li>
                                <li>
                                    <?php echo Anchor(ADM_BASE . 'Banner/Add', '<i class="glyphicon glyphicon-plus"></i> ' . $_Banners_Add); ?>
                                </li>
                                <li>
                                    <?php echo Anchor(ADM_BASE . 'Banner', '<i class="glyphicon glyphicon-eye-open"></i> ' . $_Banners_View); ?>
                                </li>
                            </ul>
                        </li>
                        <!--                        <li class="dropdown">
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $_Users; ?> <b class="caret"></b></a>
                                                    <ul class="dropdown-menu">
                                                        <li class="dropdown-header"><?php echo $_Users; ?></li>
                                                        <li>
                        <?php echo Anchor(ADM_BASE . 'User/Add', '<i class="glyphicon glyphicon-plus"></i> ' . $_Users_Add); ?>
                                                        </li>
                                                        <li>
                        <?php echo Anchor(ADM_BASE . 'User', '<i class="glyphicon glyphicon-eye-open"></i> ' . $_Users_View); ?>
                                                        </li>
                                                    </ul>
                                                </li>-->
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $_Settings; ?> <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li class="dropdown-header"><?php echo $_Settings; ?></li>
                                <li>
                                    <?php echo Anchor(ADM_BASE . 'Setting', '<i class="glyphicon glyphicon-plus"></i> ' . $_SiteSettings); ?>
                                </li>
                                <li>
                                    <?php echo Anchor(ADM_BASE . 'AdminSetting', '<i class="glyphicon glyphicon-eye-open"></i> ' . $_AdminSettings); ?>
                                </li>
                                <li>
                                    <?php echo Anchor(ADM_BASE . 'FileManager', '<i class="glyphicon glyphicon-eye-open"></i> ' . $_FileManager); ?>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <?php echo Anchor(ADM_BASE . 'Home/SignOut', $_SignOut, null, false); ?>
                        </li>
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2">
                    <ul class="list-group">
                        <li class="list-group-item">Cras justo odio</li>
                        <li class="list-group-item">Dapibus ac facilisis in</li>
                        <li class="list-group-item">Morbi leo risus</li>
                        <li class="list-group-item">Porta ac consectetur ac</li>
                        <li class="list-group-item">Vestibulum at eros</li>
                    </ul>
                </div>
                <div class="col-md-10">
                    <ul class="breadcrumb" id="Buttons">
                        <li>
                            <?php echo Anchor('javascript:void(0)', '<i class="glyphicon glyphicon-plus-sign"></i> ' . $_Add, 'class="btn btn-primary" id="btnAdd"') ?>
                        </li>
                        <li>
                            <?php echo Anchor('javascript:void(0)', '<i class="glyphicon glyphicon-edit"></i> ' . $_Edit, 'class="btn  btn-primary" id="btnEdit"') ?>
                            <?php echo InputHidden('eID') ?>
                        </li>
                        <li>
                            <?php echo Anchor('javascript:void(0)', '<i class="glyphicon glyphicon-ok"></i> ' . $_SelectAll, 'class="btn btn-success" id="btnSelectAll"', false) ?>
                        </li>
                        <li>
                            <?php echo Anchor('#collapseSearch', '<i class="glyphicon glyphicon-search"></i> ' . $_Search, 'class="btn btn-primary" data-toggle="collapse" aria-expanded="false" aria-controls="collapseSearch"', false) ?>
                        </li>
                        <li>
                            <?php echo Anchor('#DeleteOperation', '<i class="glyphicon glyphicon-trash"></i> ' . $_Delete, 'class="btn btn-danger" id="btnDelete" data-toggle="modal"', false) ?>
                        </li>
                    </ul>
                    <?php
                    require_once ADM_TEMPLATE_SHARED . 'Head.php';
                    ?>
                    <div id="PageContents">
                        <?php include $this->PageContents; ?>
                    </div>
                    <?php
                    require_once $this->SharedScript;
                    ?>
                    <div id="Modals">
                        <!-- Modal -->
                        <div class="modal fade" id="DetailOperation">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title"><?php echo $_Details ?></h4>
                                    </div>
                                    <div class="modal-body">
                                        <p id="ItemDetails"></p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $_Cancel ?></button>
                                        <?php echo Anchor('#', $_Edit, 'class="btn btn-primary" id="lnkEdit" onclick="$(\'#DetailOperation\').modal(\'hide\');"') ?>
                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->
                        <div class="modal fade" id="ChooseData">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title"><?php echo $_Choose ?></h4>
                                    </div>
                                    <div class="modal-body">
                                        <p id="DataDetails"></p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $_Cancel ?></button>
                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->
                        <div class="modal fade" id="DeleteOperation">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title"><?php echo $_Delete ?></h4>
                                    </div>
                                    <div class="modal-body">
                                        <p id="DeleteDetails"><?php echo $_ConfirmDelete ?></p>
                                    </div>
                                    <div class="modal-footer">
                                        <form method="POST" id="Deleting">
                                            <input type="submit" value="<?php echo $_Delete; ?>" class="btn btn-danger col-md-4" />
                                            <?php echo Anchor('javascript:void(0)', $_Cancel, 'class="btn" data-dismiss="modal"', false) ?>
                                            <?php echo InputHidden('dIDs') ?>
                                        </form>
                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->
                        <div class="modal fade" id="FileManager">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title"><?php echo $_FileManager ?></h4>
                                    </div>
                                    <div class="modal-body">
                                        <p id="FileManagerDetails"></p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $_Cancel ?></button>
                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->
                        <div id="Alerts" class="navbar-fixed-bottom">
                            <div id="SuccessMessage" class="msg alert alert-success hide">
                                <button type="button" class="close" data-dismiss="alert">×
                                </button><strong>
                                    <?php echo $_Message ?></strong>
                                <?php echo $_SavedDone ?>
                            </div>
                            <div class="alert-error msg message hide">
                                <button type="button" class="close" data-dismiss="alert">×
                                </button><strong>
                                    <?php echo $_Error ?></strong>
                                <?php echo $_Unexpected_Error ?>
                            </div>
                            <div id="WarningMessage" class="msg alert alert-danger hide">
                                <button type="button" class="close" data-dismiss="alert">×
                                </button><strong>
                                    <?php echo $_Warning ?></strong>
                                <?php echo $_Warning_Message ?>
                            </div>
                        </div>
                    </div>

                    <div id="copyright" class="clearfix container">
                        <?php echo $_Copyright; ?>
                    </div>
                </div>
            </div>
        </div> <!-- /container -->
    </body>
</html>