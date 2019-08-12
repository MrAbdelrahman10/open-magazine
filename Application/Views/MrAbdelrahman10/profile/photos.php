<?php
echo '<h1>' . $_MyPhotos . '</h1>';
if ($dResults) {
    ?>

    <table style="width: 100%" id="userposts">
        <thead>
            <tr>
                <th><?php echo $_Title; ?></th>
                <th><?php echo $_Picture; ?></th>
                <th><?php echo $_CreatedDate; ?></th>
                <th><?php echo $_State; ?></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($dResults as $Item) { ?>
                <tr> 	
                    <td><?php echo $Item['Title']; ?></td> 
                    <td><img src="<?php echo GetImageThumbnail($Item['Picture']); ?>" /></td>
                    <td><time><?php echo $Item['CreatedDate']; ?></time></td> 	
                    <td><?php echo $Item['State'] == 1 ? $_Yes : $_No ?></td>
                    <td><?php echo '' ?></td>
                    <td>
                        <?php echo Anchor(GetRewriteUrl($pID . '/EditPhoto/' . $Item['ID']), $_Edit, 'class="button"') ?>
                        /
                        <?php echo Anchor('javascript:void(0)', $_Delete, 'class="button delete" data-id="d' . $Item['ID'] . '" onclick="$(\'#d' . $Item['ID'] . '\').show();"', false) ?>
                        <div id="d<?php echo $Item['ID'] ?>" class="hide">
                            <p>
                                <?php echo $_Del_Msg; ?>
                            </p>
                            <p>
                                <?php echo Anchor(GetRewriteUrl($pID . '/DeletePhoto?dID=' . $Item['ID']), $_Delete, 'class="button"', false) ?>        
                                <?php echo Anchor('javascript:void(0)', $_Cancel, 'class="button" onclick="$(\'#d' . $Item['ID'] . '\').hide();"', false)
                                ?>        
                            </p>
                        </div>
                    </td> 		
                </tr> 	
            <?php } ?>
        </tbody>
    </table>

    <div class="pagination">
        <?php echo $dRenderNav; ?>
    </div>
<?php }