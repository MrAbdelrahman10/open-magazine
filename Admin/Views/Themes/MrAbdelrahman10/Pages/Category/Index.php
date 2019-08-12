<div class="collapse in" id="collapseSearch">
    <form method="get" class="form-horizontal" role="form">
        <div class="col-md-4">
            <div class="form-group">
                <?php echo InputBox('search[t.ID]', $_GET['search']['t.ID'], $_ID); ?>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <?php echo InputBox('search[t.Name]', $_GET['search']['t.Name'], $_Category); ?>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <?php echo DropDown('search[Parent]', $dCategoriesList, $_GET['search']['Parent']); ?>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <?php echo InputBox('search[ItemsCount]', $_GET['search']['ItemsCount'], $_ItemsCount); ?>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <?php echo CheckBox('search[t.State]', $_GET['State']); ?>
            </div>
        </div>
        <div class="col-md-4">
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
<?php if ($dResults) { ?>
    <div class="table-responsive">
        <table class="table table-striped table-bordered bootstrap-datatable ">
            <thead>
                <tr>
                    <th class="check"></th>
                    <th>  <?php echo $_ID; ?>   </th>
                    <th>  <?php echo $_Category; ?>   </th>
                    <th>  <?php echo $_ItemsCount; ?>   </th>
                    <th class="bool">  <?php echo $_State; ?>   </th>
                    <th class="tools"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($dResults as $Item) { ?>
                    <tr>
                        <td>
                            <input id="C-<?php echo $Item['ID']; ?>" class="DelCheck" type="checkbox" onclick="MultiCheck('<?php echo $Item['ID']; ?>')" />
                        </td>
                        <td><?php echo $Item['ID']; ?></td>
                        <td><?php echo $Item['Name']; ?></td>
                        <td><?php echo $Item['ItemsCount']; ?></td>
                        <td>
                            <?php echo CheckBox('State-' . $Item['ID'], $Item['State'], 'itemState', 'data-id="' . $Item['ID'] . '"'); ?>
                        </td>
                        <td>
                            <?php
                            echo Anchor('#DetailOperation', '<i class="glyphicon glyphicon-zoom-in glyphicon-white"></i>', 'data-id="' . $Item['ID'] . '" class="Details btn btn-success" data-toggle="modal" title="' . $_Details . '"', false);
                            echo Anchor(ADM_BASE . $pID . '/Add?id=' . $Item['ID'], '<i class="fa fa-copy"></i>', 'class="btn btn-info btn-tools" title="' . $_AddCopy . '"');
                            echo Anchor(ADM_BASE . $pID . '/Edit/' . $Item['ID'], '<i class="glyphicon glyphicon-edit glyphicon-white"></i>', 'class="btn btn-primary btn-tools" title="' . $_Edit . '"');
                            echo Anchor('#DeleteOperation', '<i class="fa fa-trash"></i>', 'data-id="' . $Item['ID'] . '" class="Delete btn btn-danger btn-tools" data-toggle="modal" title="' . $_Delete . '"', false);
                            ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <?php
}