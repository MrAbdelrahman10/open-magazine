<?php
if ($d['dResults']) {
    foreach ($d['dResults'] as $i) {
        ?>
        <!-- post -->
        <div class="post_day mbf clearfix">
            <div class="grid_4 alpha relative">
                <a class="hover-shadow" href="<?php echo GetRewriteUrl('news/i/' . $i['ID'], $i['Alias']); ?>">
                    <img src="<?php echo GetImageThumbnail($i['Picture'], 210, 210); ?>" alt="">
                </a>
            </div><!-- /grid4 alpha -->
            <div class="grid_8 omega">
                <div class="post_day_content">
                    <h3> <?php echo Anchor(GetRewriteUrl('news/i/' . $i['ID'], $i['Alias']), $i['Title']); ?> </h3>
                    <div class="meta mb">
                        <?php echo $_['_Since'] . GetSinceTiming($i['CreatedDate']); ?>
                        /
                        <?php
                        echo Anchor(GetRewriteUrl('news/c/' . $i['Category']), $i['CategoryName']);
                        ?>
                    </div>
                    <p>
                        <?php echo $i['Description']; ?>
                        ...
                    </p>
                </div><!-- /post content -->
            </div><!-- /grid8 omega -->
        </div><!-- /post day -->
        <!-- /post -->

        <?php
    }
    ?>

    <div class="pagination-tt clearfix">
        <?php echo $d['dRenderNav']; ?>
    </div><!-- /pagination -->
    <?php
}
