<div class="grid_full alpha posts">
    <?php
    if ($d['dResults']) {
        $i = &$d['dResults'];
        ?>

        <div class="single_post mbf clearfix">
            <h3 class="single_title">
                <i class="icon-document-edit mi"></i>
                <?php echo Anchor(GetRewriteUrl($d['psUrl']), $d['dTitle']); ?>
            </h3>
            <div class="meta mb">
                <?php echo Anchor(GetRewriteUrl('news/i/' . $i['Category']), $i['CategoryName']); ?>
                /
                <?php echo $_['_Since'] . GetSinceTiming($i['CreatedDate']); ?>
            </div>

            <img class="mbt center-block" src="<?php echo GetImageOriginal($i['Picture']); ?>" alt="<?php echo $i['PictureDescription']; ?>">
            <div id="contents">
                <?php echo $i['Contents']; ?>
            </div>
        </div><!-- /single post -->

        <div class="share_post mbf clearfix">
            <span> <?php echo $_['_Share']; ?> </span>
            <div class="socials clearfix">
                <?php
                ShareInit();
                ShareIt();
                ?>
            </div><!-- /socials -->
        </div><!-- /share -->

        <!--        <div class="posts_links mbf clearfix">
                    <a class="grid_6 lefter relative" href="#">
                        <i class="icon-chevron-left"></i>
                        <small> Previous: </small>
                        <span> Elit eget tincidunt condimentum </span>
                    </a>

                    <a class="grid_6 righter tar relative" href="#">
                        <i class="icon-chevron-right"></i>
                        <small> Next: </small>
                        <span> Nemo enim ipsam voluptatem </span>
                    </a>
                </div>-->
        <!-- /posts links -->

        <div class="related_posts mbf clearfix">
            <div class="title">
                <h4><?php echo $_['_Related']; ?></h4>
                <a href="<?php echo GetRewriteUrl('news/c/' . $i['Category']); ?>" class="feed toptip" title="More Posts"><i class="icon-forward"></i></a>
            </div>

            <div class="carousel_related">
                <?php
                foreach ($d['dRelated'] as $r) {
                    ?>
                    <div class="item hover-shadow">
                        <?php
                        echo Anchor(GetRewriteUrl('news/i/' . $r['ID']), Img('', GetImageThumbnail($r['Picture'], 280, 200), 'class="toptip"'), 'title="' . $r['Title'] . '"');
                        ?>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div><!-- /related -->

        <div class="disqus_comments">
            <?php DisqusComments($d['psUrl']); ?>
        </div><!-- /comments -->

        <?php
    }
    ?>


</div><!-- end grid8 -->