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
                <?php echo Anchor(GetRewriteUrl('video'), $_['_Videos']); ?>
                /
                <?php echo $_['_Since'] . GetSinceTiming($i['CreatedDate']); ?>
            </div>

            <iframe width="640" height="360" src="https://www.youtube.com/embed/<?php echo $i['Url']; ?>" class="center-block" frameborder="0" allowfullscreen></iframe>

            <p>
                <?php echo $i['Description']; ?>
            </p>
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
                <a href="<?php echo GetRewriteUrl('video/c/' . $i['Category']); ?>" class="feed toptip" title="More Posts"><i class="icon-forward"></i></a>
            </div>

            <div class="carousel_related">
                <?php
                foreach ($d['dRelated'] as $r) {
                    ?>
                    <div class="item related-posts hover-shadow">
                        <?php
                        echo Anchor(GetRewriteUrl('video/i/' . $r['ID']), Img('', 'http://i.ytimg.com/vi/' . $r['Url'] . '/hqdefault.jpg', 'class="toptip"'), 'title="' . $r['Title'] . '"');
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