<div class="collapse in" id="collapseSearch">
    <form method="get" class="form-horizontal" role="form">
        <div class="col-md-6">
            <div class="form-group">
                <?php echo Label('search[t.ID]', $_ID, 'class="col-sm-4 control-label"'); ?>
                <div class="col-sm-8">
                    <?php echo InputBox('search[t.ID]', $_GET['search']['t.ID'], $_ID); ?>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <?php echo Label('search[t.Title]', $_Title, 'class="col-sm-4 control-label"'); ?>
                <div class="col-sm-8">
                    <?php echo InputBox('search[t.Title]', $_GET['search']['t.Title'], $_Title); ?>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <?php echo Label('search[UserName]', $_UserName, 'class="col-sm-4 control-label"'); ?>
                <div class="col-sm-8">
                    <?php echo InputBox('search[UserName]', $_GET['search']['UserName'], $_UserName); ?>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <?php echo Label('search[t.Viewed]', $_Viewed, 'class="col-sm-4 control-label"'); ?>
                <div class="col-sm-8">
                    <?php echo InputBox('search[t.Viewed]', $_GET['search']['t.Viewed'], $_Viewed); ?>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <?php echo Label('search[t.CreatedDate]', $_CreatedDate, 'class="col-sm-4 control-label"'); ?>
                <div class="col-sm-8">
                    <?php echo InputBox('search[t.CreatedDate]', $_GET['search']['t.CreatedDate'], $_CreatedDate); ?>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <?php echo Label('search[t.State]', $_State, 'class="col-sm-4 control-label"'); ?>
                <div class="col-sm-8">
                    <?php echo CheckBox('search[t.State]', $_GET['search']['t.State']); ?>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="col-md-6 no-padding">
                <button type="submit" class="btn btn-success btn-block">
                    <i class="glyphicon glyphicon-search"></i>
                    <?php echo $_Search; ?>
                </button>
            </div>
            <div class="col-md-6 no-padding">
                <a class="btn btn-danger btn-block" href="<?php echo $pUrl; ?>">
                    <i class="glyphicon glyphicon-repeat"></i>
                    <?php echo $_Reset; ?>
                </a>
            </div>
        </div>
    </form>
</div>
<?php
if ($dResults) {
    ?>
    <div class="table-responsive">
        <table class="table table-striped table-bordered bootstrap-datatable ">
            <thead>
                <tr>
                    <th class="check"></th>
                    <th class="ID"><?php echo Anchor(SetSortingOrderLink('ID'), $_ID); ?></th>
                    <th><?php echo Anchor(SetSortingOrderLink('Title'), $_Title); ?></th>
                    <th><?php echo Anchor(SetSortingOrderLink('UserName'), $_Author); ?></th>
                    <th><?php echo Anchor(SetSortingOrderLink('Viewed'), $_Viewed); ?></th>
                    <th><?php echo Anchor(SetSortingOrderLink('CreatedDate'), $_CreatedDate); ?></th>
                    <th class="bool"><?php echo Anchor(SetSortingOrderLink('State'), $_State); ?></th>
                    <th class="tools"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($dResults as $Item) {
                    $HasPerm = $pUser['IsAdmin'] || $pUser['ID'] == $Item['UserID'] ? true : false;
                    ?>
                    <tr>
                        <td>
                            <?php
                            if ($HasPerm) {
                                ?>
                                <input id="C-<?php echo $Item['ID']; ?>" class="DelCheck" type="checkbox" onclick="MultiCheck('<?php echo $Item['ID']; ?>')" />
                                <?php
                            }
                            ?>
                        </td>
                        <td><?php echo $Item['ID']; ?></td>
                        <td><?php echo $Item['Title']; ?></td>
                        <td><?php echo $Item['UserName']; ?></td>
                        <td><span class="count"><?php echo $Item['Viewed']; ?></span></td>
                        <td><time><?php echo $Item['CreatedDate']; ?></time></td>
                        <td>
                            <?php
                            echo
                            CheckBox('State-' . $Item['ID'], $Item['State'], 'itemState', 'data-id="' . $Item['ID'] . '"');
                            ?>
                        </td>
                        <td>
                            <?php
                            echo Anchor('#DetailOperation', '<i class="glyphicon glyphicon-zoom-in glyphicon-white"></i>', 'data-id="' . $Item['ID'] . '" class="Details btn btn-success" data-toggle="modal" title="' . $_Details . '"', false);
                            echo Anchor(ADM_BASE . $pID . '/Add?id=' . $Item['ID'], '<i class="fa fa-copy"></i>', 'class="btn btn-info btn-tools" title="' . $_AddCopy . '"');
                            if ($HasPerm) {
                                echo Anchor(ADM_BASE . $pID . '/Edit/' . $Item['ID'], '<i class="glyphicon glyphicon-edit glyphicon-white"></i>', 'class="btn btn-primary btn-tools" title="' . $_Edit . '"');
                                echo Anchor('#DeleteOperation', '<i class="fa fa-trash"></i>', 'data-id="' . $Item['ID'] . '" class="Delete btn btn-danger btn-tools" data-toggle="modal" title="' . $_Delete . '"', false);
                            }
                            ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <div class="dataTables_paginate">
        <?php echo $dRenderNav; ?>
    </div>
<?php
}