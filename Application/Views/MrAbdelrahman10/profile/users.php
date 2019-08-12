<!--post-item-->
<div class="post-item">
    <h2>
        <?php echo $_Members; ?>
    </h2>
    <div class="post-meta">
        <em>

        </em>
    </div>
    <div class="entry">
        <table style="width: 95%;">
            <thead>
                <tr>
                    <th><?php echo $_ID ?></th>
                    <th><?php echo $_MemberName ?></th>
                    <th><?php echo $_CreatedDate ?></th>
                    <th><?php echo $_ItemsCount ?></th>
                    <th>تقييم العضو</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($dResults as $i) {
                    ?>                   
                    <tr>
                        <td>
                            <?php echo $i['ID'] ?>
                        </td>
                        <td>
                            <?php echo $i['UserName'] ?>
                        </td>
                        <td>
                            <?php echo $i['CreatedDate'] ?>
                        </td>
                        <td>
                            <?php echo $i['ItemsCount'] ?>
                        </td>
                        <td>
                            <?php echo $i['ItemsCount'] ?>
                        </td>
                        <td>
                            <?php echo Anchor(GetRewriteUrl('Article/User/' . $i['ID']), $_View_Articles) ?>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
        <div class="clear"></div>
    </div>
</div><!--End_post-item-->
<div class="divider"></div>

<div class="pagination">
    <?php echo $dRenderNav; ?>
</div>
<div class="divider"></div>