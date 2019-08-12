<?php
$d = &$dRow;
?>
<div class="row-fluid">
    <form method="POST" enctype="multipart/form-data" id="form" class="form-horizontal" role="form">
        <div class="col-md-9">
            <input type="hidden" name="ID" id="ID" value="<?php echo GetValue($d['ID'], 0); ?>" />
            <input type="hidden" name="UserID" id="UserID" value="<?php echo GetValue($d['UserID'], $pUser['ID']); ?>" />
            <div class="form-group">
                <?php echo Label('FullName', $_FullName, 'class="col-sm-2 control-label"'); ?>
                <div class="col-sm-10">
                    <?php echo InputBox('FullName', $d['FullName']); ?>
                    <?php echo ErrorSpan('FullName', $errFullName); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo Label('Email', $_Email, 'class="col-sm-2 control-label"'); ?>
                <div class="col-sm-10">
                    <?php echo InputBox('Email', $d['Email']); ?>
                    <?php echo ErrorSpan('Email', $errEmail); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo Label('UserName', $_UserName, 'class="col-sm-2 control-label"'); ?>
                <div class="col-sm-10">
                    <?php echo InputBox('UserName', $d['UserName']); ?>
                    <?php echo ErrorSpan('UserName', $errUserName); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo Label('Password', $_Password, 'class="col-sm-2 control-label"'); ?>
                <div class="col-sm-10">
                    <?php echo InputPassword('Password', $__); ?>
                    <?php echo ErrorSpan('Password', $errPassword); ?>
                </div>
            </div>
            <div class="form-group hide">
                <?php echo Label('IsEditor', $_IsEditor, 'class="col-sm-5 control-label"'); ?>
                <?php echo CheckBox('IsEditor', $d['IsEditor']); ?>
                <?php echo ErrorSpan('IsEditor', $errIsEditor); ?>
            </div>
            <div class="form-group">
                <?php echo Label('Permission', $_Categories, 'class="col-sm-2 control-label"'); ?>
                <div class="col-sm-10">
                    <?php
                    $dPermissions = explode(',', $d['Permission']);
                    foreach ($dPages as $p) {
                        ?>
                        <div class="perm">
                            <?php
                            echo Label($p['ID'], $p['Name']);
                            ?>
                            <input type="checkbox" name="C-<?php echo $p['ID']; ?>" id="C-<?php echo $p['ID']; ?>" onclick="mCheck('<?php echo $p['ID']; ?>')"
                            <?php echo ((is_array(GetValue($dPermissions)) && in_array($p['ID'], GetValue($dPermissions))) ? 'checked' : '');
                            ?> />
                            <div class="col-md-offset-3">
                                <?php
                                if (GetValue($p['Cats'])) {
                                    $cs = $p['Cats'];
                                    foreach ($cs as $c) {
                                        ?>
                                        <div class="cat">
                                            <?php
                                            echo Label($c['ID'], $c['Name']);
                                            ?>
                                            <input type="checkbox" name="C-<?php echo $c['ID']; ?>" id="C-Category-<?php echo $c['ID']; ?>" onclick="mCheck('Category-<?php echo $c['ID']; ?>')"
                                            <?php echo ((is_array(GetValue($dPermissions)) && in_array('Category-' . $c['ID'], GetValue($dPermissions))) ? 'checked' : '');
                                            ?> />
                                        </div>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>
                        <?php
                    }
                    echo InputHidden('Permission', $d['Permission']);
                    ?>
                </div>
            </div>
        </div>
        <div class="col-md-3">

            <div class="panel panel-default">
                <div class="panel-heading"><?php echo $_PublishOptions; ?></div>
                <div class="panel-body">
                    <div class="form-actions">
                        <button type="submit" class="btn btn-large btn-primary btn-submit"><?php echo $_Save; ?></button>
                        <?php echo Anchor(ADM_BASE . $pID, $_Back, 'class="btn btn-large btn-danger"'); ?>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>