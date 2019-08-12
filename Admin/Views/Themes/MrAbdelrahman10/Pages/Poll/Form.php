<?php
$d = &$dRow;
?>
<div class="row-fluid">
    <form method="POST" enctype="multipart/form-data" id="form" class="form-horizontal" role="form">
        <div class="col-md-9">
            <input type="hidden" name="ID" id="ID" value="<?php echo GetValue($d['ID'], 0); ?>" />
            <input type="hidden" name="UserID" id="UserID" value="<?php echo GetValue($d['UserID'], $pUser['ID']); ?>" />


            <div class="panel panel-default">
                <div class="panel-heading"><?php echo $_Poll; ?></div>
                <div class="panel-body">
                    <div class="form-group">
                        <?php echo Label('Q', $_Q, 'class="col-sm-2 control-label"'); ?>
                        <div class="col-sm-10">
                            <?php echo InputBox('Q', $d['Q'], $_Q); ?>
                            <?php echo ErrorSpan('Q', $errQ); ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading"><?php echo $_Answers; ?></div>
                <div class="panel-body">
                    <div id="Answers">
                        <?php
                        $arr = GetValue($d['Answers']);
                        $c = count($arr) > 0 ? count($arr) : 2;
                        for ($i = 0; $i < $c; $i++) {
                            $r = GetValue($arr[$i]);
                            $rID = GetValue($r['ID']);
                            ?>
                            <div class="multiple">
                                <div class="col-sm-10 pull-right">
                                    <div class="form-group">
                                        <?php echo Label("A[$rID]", $_A, 'class="col-sm-4 control-label"'); ?>
                                        <div class="col-sm-8">
                                            <?php echo InputBox("A[$rID]", $r['A'], $_A, 'required'); ?>
                                            <?php echo ErrorSpan("A[$rID]", $errA); ?>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                if ($pAction == 'Add') {
                                    ?>
                                    <div class="col-sm-2 pull-left">
                                        <a href="javascript:void(0)" class="btn btn-primary" onclick="addForm('Answers');">
                                            <i class="glyphicon glyphicon-plus"></i>
                                        </a>
                                        <a href="javascript:void(0)" class="btn btn-danger" onclick="var c = $('#Answers > div.multiple').length;
                                                        if (c > 2)
                                                            $(this).closest('div.multiple').remove();">
                                            <i class="glyphicon glyphicon-remove"></i>
                                        </a>
                                    </div>
                                    <hr class="clearfix" />
                                    <?php
                                }
                                ?>
                            </div>
                            <?php
                        }
                        ?>
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

        </div>
    </form>
</div>