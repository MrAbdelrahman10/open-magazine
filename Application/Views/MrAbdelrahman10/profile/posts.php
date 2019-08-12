<div id="wraper_all">
    <div id="wraper-internal">
        <div id="register">
            <h3><?php echo$dTitle; ?></h3>
            <?php
            if ($dResults) {
                ?>
                <table style="width: 100%;direction: rtl;" id="userposts">
                    <thead>
                        <tr>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($dResults as $Item) { ?>
                            <tr> 	
                                <td>
                                    <h3><?php echo $Item['Title']; ?></h3>
                                    <br />
                                    |-
                                    <?php echo $_CreatedDate; ?> : <time><?php echo $Item['CreatedDate']; ?></time>
                                    <br />
                                    |-
                                    <?php echo $_Category; ?> : <?php echo $Item['CategoryName']; ?>
                                    <br />
                                    |-
                                    <?php echo $_Viewed; ?> : <?php echo $Item['Viewed']; ?>
                                    <br />
                                    |-
                                    <?php echo $_State; ?> : <?php echo $Item['State'] == 1 ? $_Yes : $_No ?>
                                    <hr />
                                    <p style="margin-bottom: 10px;"></p>
                                </td> 
                                <td>
                                    <?php echo Anchor(GetRewriteUrl($pID . '/editpost/' . $Item['ID']), $_Edit, 'class="button"') ?>
                                    /
                                    <?php echo Anchor('javascript:void(0)', $_Delete, 'class="button delete" data-id="d' . $Item['ID'] . '" onclick="$(\'#d' . $Item['ID'] . '\').show();"', false) ?>
                                    <div id="d<?php echo $Item['ID'] ?>" class="hide">
                                        <p>
                                            <?php echo $_Del_Msg; ?>
                                        </p>
                                        <p>
                                            <?php echo Anchor(GetRewriteUrl($pID . '/deletepost?dID=' . $Item['ID']), $_Delete, 'class="button"', false) ?>        
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
            <?php } ?>
        </div>
    </div><!-----------internal-------------->
</div>
