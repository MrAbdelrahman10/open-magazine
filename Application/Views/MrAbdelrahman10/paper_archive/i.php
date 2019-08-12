<html>
    <head>

        <base href="<?php echo SITE_URL; ?>" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo $dTitle ?></title>
        <meta name="description" content="<?php echo $dDescription ?>" />
        <meta name="keywords" content="<?php echo $dKeywords ?>" />
        <meta name="author" content="mrabdelrahman10.blogspot.com" />
        <meta property="og:title" content="<?php echo $dTitle ?>" />
        <meta property="og:url" content="<?php echo $pUrl ?>" />
        <meta property="og:image" content="<?php echo $pImage ?>" />
        <meta property="og:site_name" content="<?php echo $sSite_Name ?>" />
        <!-- viewport -->
        <meta content="width=device-width,initial-scale=1" name="viewport">

        <link rel="dns-prefetch" href="//connect.facebook.net" />
        <link rel="dns-prefetch" href="//s-static.ak.facebook.com" />
        <link rel="dns-prefetch" href="//ssl.google-analytics.com" />
        <link rel="dns-prefetch" href="//cm.g.doubleclick.net" />
        <link rel="dns-prefetch" href="//stats.g.doubleclick.net" />
        <link rel="dns-prefetch" href="//www.facebook.com" />

        <!-- add css -->
        <link type="text/css" href="<?php echo APP_CURRENT_URL_TEMPLATE; ?>Classy-FlipBook-jQuery/css/style.css" rel="stylesheet">
        <link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Play:400,700">
        <link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Nunito:400,300">

        <!-- add js -->
        <script src="<?php echo APP_CURRENT_URL_TEMPLATE; ?>Classy-FlipBook-jQuery/js/jquery.js"></script>
        <script src="<?php echo APP_CURRENT_URL_TEMPLATE; ?>Classy-FlipBook-jQuery/js/turn.js"></script>
        <script src="<?php echo APP_CURRENT_URL_TEMPLATE; ?>Classy-FlipBook-jQuery/js/jquery.fullscreen.js"></script>
        <script src="<?php echo APP_CURRENT_URL_TEMPLATE; ?>Classy-FlipBook-jQuery/js/jquery.address-1.6.min.js"></script>
        <script src="<?php echo APP_CURRENT_URL_TEMPLATE; ?>Classy-FlipBook-jQuery/js/onload.js"></script>


        <style>
            html, body {
                margin: 0;
                padding: 0;
                overflow:auto !important;
            }
        </style>

    </head>

    <body>
        <?php
        if ($dResults) {
            $i = &$dResults;
            $Slides = unserialize($i['SliderPictures']);
            $cs = count($Slides);
            $fSlide = $Slides[0];
            $iSlides = array_slice($Slides, 0, $cs);
            $lSlide = $Slides[$cs - 1];
            ?>
            <!-- DIV YOUR WEBSITE -->
            <div style="width:100%;margin:0 auto">

                <!-- BEGIN FLIPBOOK STRUCTURE -->
                <div data-template="false" data-cat="book7" id="fb7-ajax">


                    <!-- BEGIN HTML BOOK -->
                    <div data-current="book7" class="fb7" id="fb7">

                        <!-- preloader -->
                        <div class="fb7-preloader">
                            <div id="wBall_1" class="wBall">
                                <div class="wInnerBall">
                                </div>
                            </div>
                            <div id="wBall_2" class="wBall">
                                <div class="wInnerBall">
                                </div>
                            </div>
                            <div id="wBall_3" class="wBall">
                                <div class="wInnerBall">
                                </div>
                            </div>
                            <div id="wBall_4" class="wBall">
                                <div class="wInnerBall">
                                </div>
                            </div>
                            <div id="wBall_5" class="wBall">
                                <div class="wInnerBall">
                                </div>
                            </div>
                        </div>

                        <!-- back button -->
                        <a href="<?php echo GetRewriteUrl('paper_archive'); ?>" id="fb7-button-back">&lt; <?php echo $_Back; ?></a>

                        <!-- background for book -->
                        <div class="fb7-bcg-book"></div>

                        <!-- BEGIN CONTAINER BOOK -->
                        <div id="fb7-container-book">

                            <!-- BEGIN deep linking -->
                            <section id="fb7-deeplinking">
                                <ul>
                                    <li data-address="Start" data-page="1"></li>
                                    <?php
                                    $j = 1;
                                    $k = 1;
                                    foreach ($iSlides as $i) {
                                        $hhh = fmod($k, 2);
                                        if (fmod($k, 2) == 0) {
                                            $k++;
                                            continue;
                                        }
                                        $pr = $j + 1;
                                        $pl = $j + 2;
                                        echo '<li data-address="Page' . $pr . '-Page' . $pl . '" data-page="' . $pr . '"></li>';
                                        echo '<li data-address="Page' . $pr . '-Page' . $pl . '" data-page="' . $pl . '"></li>';
                                        $j += 2;
                                        $k++;
                                    }
                                    ?>
                                    <li data-address="End" data-page="<?php echo $cs; ?>"></li>
                                </ul>
                            </section>
                            <!-- END deep linking -->


                            <!-- BEGIN PAGES -->
                            <div id="fb7-book">


                                <!-- BEGIN PAGE 1 -->
                                <div style="background-image:url()" class="fb7-noshadow">

                                    <!-- begin container page book -->
                                    <div class="fb7-cont-page-book">

                                        <!-- description for page -->
                                        <div class="fb7-page-book">

                                        </div>


                                    </div>
                                    <!-- end container page book -->

                                </div>


                                <div style="background-image:url()">

                                    <!-- begin container page book -->
                                    <div class="fb7-cont-page-book">
                                        <!-- description for page-->
                                        <div class="fb7-page-book">
                                            <p>&nbsp;</p>
                                            <p>&nbsp;</p>
                                            <p>&nbsp;</p>
                                            <p>&nbsp;</p>
                                            <p>&nbsp;</p>
                                            <p>&nbsp;</p>
                                            <p>&nbsp;</p>
                                            <p>&nbsp;</p>
                                            <p>&nbsp;</p>
                                            <p>&nbsp;</p>
                                            <h1 style="padding-left: 150px;">&nbsp;&nbsp;</h1>
                                        </div>
                                    </div>
                                    <!-- end container page book -->
                                </div>

                                <!-- END PAGE 1 -->

                                <?php
                                $j = 1;
                                foreach ($Slides as $i) {
                                    ?>
                                    <!-- BEGIN PAGE  -->
                                    <div style="background-image:url(<?php echo GetImageThumbnail($i, 640, 920); ?>)" class="bg-full fb7-double fb7-<?php echo fmod($j, 2) == 1 ? 'first' : 'second'; ?>">
                                        <!-- begin container page book -->
                                        <div class="fb7-cont-page-book">
                                            <!-- description for page -->
                                            <div class="fb7-page-book">
                                            </div>
                                            <!-- begin number page  -->
                                            <div class="fb7-meta">
                                                <span class="fb7-num"><?php echo $j++; ?></span>
                                            </div>
                                            <!-- end number page  -->
                                        </div>
                                        <!-- end container page book -->
                                    </div>
                                    <!-- END PAGE  -->
                                    <?php
                                }
                                ?>
                                <!-- BEGIN END PAGES -->
                                <div style="background-image:url()">

                                    <!-- begin container page book -->
                                    <div class="fb7-cont-page-book">

                                        <!-- description for page-->
                                        <div class="fb7-page-book">
                                            <p>&nbsp;</p>
                                            <p>&nbsp;</p>
                                            <p>&nbsp;</p>
                                            <p>&nbsp;</p>
                                            <p>&nbsp;</p>
                                            <p>&nbsp;</p>
                                            <p>&nbsp;</p>
                                            <p>&nbsp;</p>
                                            <p>&nbsp;</p>
                                            <p>&nbsp;</p>
                                            <h1 style="padding-left: 150px;">&nbsp;&nbsp;</h1>
                                        </div>

                                    </div>
                                    <!-- end container page book -->

                                </div>
                                <div style="background-image:url()">

                                    <!-- begin container page book -->
                                    <div class="fb7-cont-page-book">

                                        <!-- description for page-->
                                        <div class="fb7-page-book">
                                            <p>&nbsp;</p>
                                            <p>&nbsp;</p>
                                            <p>&nbsp;</p>
                                            <p>&nbsp;</p>
                                            <p>&nbsp;</p>
                                            <p>&nbsp;</p>
                                            <p>&nbsp;</p>
                                            <p>&nbsp;</p>
                                            <p>&nbsp;</p>
                                            <p>&nbsp;</p>
                                            <h1 style="padding-left: 150px;">&nbsp;&nbsp;</h1>
                                        </div>

                                    </div>
                                    <!-- end container page book -->

                                </div>
                                <!-- END PAGES -->



                            </div>
                            <!-- END PAGES -->


                            <!-- arrows -->
                            <a class="fb7-nav-arrow prev"></a>
                            <a class="fb7-nav-arrow next"></a>

                            <!-- shadow -->
                            <div class="fb7-shadow"></div>

                        </div>
                        <!-- END CONTAINER BOOK -->

                        <!-- BEGIN FOOTER -->
                        <div id="fb7-footer">

                            <div class="fb7-bcg-tools"></div>

                            <a id="fb7-logo" target="_blank" href="<?php echo SITE_URL; ?>">
                                <img alt="" src="<?php echo APP_CURRENT_URL_TEMPLATE; ?>img/logo.png">
                            </a>

                            <div class="fb7-menu" id="fb7-center">
                                <ul>

                                    <!-- margin left -->
                                    <li></li>


                                    <!-- icon_zoom_in -->
                                    <li>
                                        <a title="<?php echo $_ZoomIn; ?>" class="fb7-zoom-in"></a>
                                    </li>


                                    <!-- icon_zoom_out -->
                                    <li>
                                        <a title="<?php echo $_ZoomOut; ?>" class="fb7-zoom-out"></a>
                                    </li>


                                    <!-- icon_zoom_auto -->
                                    <li>
                                        <a title="<?php echo $_ZoomAuto; ?>" class="fb7-zoom-auto"></a>
                                    </li>


                                    <!-- icon_zoom_original -->
                                    <li>
                                        <a title="<?php echo $_ZoomAutoScale; ?>" class="fb7-zoom-original"></a>
                                    </li>


                                    <!-- icon_allpages -->
                                    <li>
                                        <a title="<?php echo $_Show_All_Pages; ?>" class="fb7-show-all"></a>
                                    </li>


                                    <!-- icon_home -->
                                    <li>
                                        <a title="<?php echo $_Show_Home_Page; ?>" class="fb7-home"></a>
                                    </li>

                                    <!-- icon fullscreen -->
                                    <li>
                                        <a title="<?php echo $_Full_Normal_Screen; ?>" class="fb7-fullscreen"></a>
                                    </li>

                                    <!-- margin right -->
                                    <li></li>

                                </ul>
                            </div>

                            <div class="fb7-menu" id="fb7-right">
                                <ul>
                                    <!-- icon page manager -->
                                    <li class="fb7-goto">
                                        <label for="fb7-page-number" id="fb7-label-page-number"></label>
                                        <input type="text" id="fb7-page-number">
                                        <button type="button"><?php echo $_Go; ?></button>
                                    </li>

                                </ul>
                            </div>

                        </div>
                        <!-- END FOOTER -->

                        <!-- BEGIN THUMBS -->
                        <div id="fb7-all-pages" class="fb7-overlay">

                            <section class="fb7-container-pages">

                                <div id="fb7-menu-holder">

                                    <ul id="fb7-slider">
                                        <?php
                                        $j = 1;
                                        foreach ($Slides as $i) {
                                            ?>
                                            <!-- PAGE - THUMB -->
                                            <li class="<?php echo $j; ?>">
                                                <img alt="" src="<?php echo GetImageThumbnail($i); ?>">
                                            </li>
                                            <?php
                                            $j++;
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </section>
                        </div>
                        <!-- END THUMBS -->
                    </div>
                    <!-- END HTML BOOK -->
                </div>
                <!-- END FLIPBOOK STRUCTURE -->
                <div id="copyright"><?php echo $_Powered; ?></div>
            </div>
            <!-- END DIV YOUR WEBSITE -->

            <!-- CONFIGURATION FLIPBOOK -->
            <script>
                jQuery('#fb7-ajax').data('config',
                        {
                            "page_width": "640",
                            "page_height": "920",
                            "go_to_page": "Page",
                            "gotopage_width": "45",
                            "zoom_double_click": "1",
                            "zoom_step": "0.06",
                            "tooltip_visible": "true",
                            "toolbar_visible": "true",
                            "deeplinking_enabled": "true",
                            "double_click_enabled": "true",
                            "rtl": "true"
                        })
            </script>

            <?php
        }
        ?>
    </body>

</html>