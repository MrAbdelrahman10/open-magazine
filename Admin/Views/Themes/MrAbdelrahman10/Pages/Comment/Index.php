<div class="breadcrumb">
    عدد التعليقات اللتي بإنتظار الموافقة
    <label class="badge badge-warning" style="width: 8px;"><?php echo $dCommentOff; ?></label>
</div>
<?php if ($dResults) { ?>
    <table class="table table-bordered bootstrap-datatable ">
        <thead>
            <tr>
                <th class="check"></th>
                <th class="ID">
                    <?php echo Anchor(SetSortingOrderLink('ID'), $_ID); ?>
                </th>
                <th style="width: 300px;">
                    <?php echo Anchor(SetSortingOrderLink('ArticleTitle'), $_ArticleTitle); ?>
                </th>
                <th>
                    <?php echo Anchor(SetSortingOrderLink('UserName'), $_Author); ?>
                </th>
                <th>
                    <?php echo Anchor(SetSortingOrderLink('Email'), $_Email); ?>
                </th>
                <th>
                    <?php echo Anchor(SetSortingOrderLink('CreatedDate'), $_CreatedDate); ?>
                </th>
                <th>
                    <?php echo Anchor(SetSortingOrderLink('State'), $_State); ?>
                </th>
                <th><?php //echo $_Tools;   ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($dResults as $Item) { ?>
                <tr<?php echo ($Item['State'] == 1 ? '' : ' class="alert alert-error"'); ?>>
                    <td>
                        <input id="C-<?php echo $Item['ID']; ?>" class="DelCheck" type="checkbox" onclick="MultiCheck('<?php echo $Item['ID']; ?>')" />
                    </td>
                    <td>
                        <?php echo $Item['ID']; ?>
                    </td>
                    <td>
                        <h6><?php echo Anchor(GetRewriteUrl(BASE_URL . 'news/i/' . $Item['ArticleID']), $Item['ArticleTitle'], 'target="_blank"', false); ?></h6>
                        <b>|-</b>
                        <?php echo $Item['Title']; ?><br />
                        <b>|-</b>
                        <?php echo $Item['Contents']; ?>
                    </td>
                    <td>
                        <?php
                        echo $Item['VisitorName'] ? $Item['VisitorName'] :
                                Anchor(SetSortingOrderLink(null, 'UserName', $Item['UserName']), $Item['UserName']);
                        ?>
                    </td>
                    <td>
                        <?php echo $Item['vEmail'] ? $Item['vEmail'] : $Item['Email']; ?>
                    </td>
                    <td>
                        <time><?php echo $Item['CreatedDate']; ?></time>
                    </td>
                    <td>
                        <?php echo CheckBox('s-' . $Item['ID'], $Item['State'], 'onclick="ChangeState(this.id);" id="s-' . $Item['ID'] . '-' . $Item['State'] . '"') ?>
                    </td>
                    <td>
                        <?php echo Anchor(ADM_BASE . $pID . '/Edit/' . $Item['ID'], '<i class="icon-edit icon-white"></i>' . $_Edit, 'class="btn btn-primary"') ?>
                        <?php echo Anchor('#DetailOperation', '<i class="icon-zoom-in icon-white"></i>' . $_Details, 'id="d-' . $Item['ID'] . '" class="Details btn btn-success" data-toggle="modal"', false); ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <div class="dataTables_paginate paging_bootstrap pagination">
        <?php echo $dRenderNav; ?>
    </div>
<?php
}