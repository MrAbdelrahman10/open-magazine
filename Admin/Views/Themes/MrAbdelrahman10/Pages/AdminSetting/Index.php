<?php if ($dResults) { ?>
    <table class="table table-striped table-bordered bootstrap-datatable ">
        <thead>
            <tr>
                <th class="check"></th>
                <th class="ID">
                    <?php echo $_ID; ?>
                </th>
                <th>
                    <?php echo $_UserName; ?>
                </th>
                <th>
                    <?php echo $_CreatedDate; ?>
                </th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($dResults as $Item) { ?>
                <tr>
                    <td>
                        <input id="C-<?php echo $Item['UserID']; ?>" class="DelCheck" type="checkbox" onclick="MultiCheck('<?php echo $Item['UserID']; ?>')" />
                    </td>
                    <td>
                        <?php echo $Item['UserID']; ?>
                    </td>
                    <td>
                        <?php echo $Item['UserName']; ?>
                    </td>
                    <td>
                        <time><?php echo $Item['CreatedDate']; ?></time>
                    </td>
                    <td>
                         <?php echo Anchor(ADM_BASE . $pID . '/Edit/' . $Item['UserID'], '<i class="glyphicon glyphicon-edit glyphicon-white"></i>' . $_Edit, 'class="btn btn-primary"') ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <div class="dataTables_paginate">
        <?php echo $dRenderNav; ?>
    </div>
<?php } ?>