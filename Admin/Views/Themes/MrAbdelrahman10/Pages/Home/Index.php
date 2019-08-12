<div class="row-fluid">
    <?php
    $Pages = array(
        array(
            'Name' => 'Articles',
            'Page' => 'Article',
            'Table' => 'article'
        ),
        array(
            'Name' => 'Categories',
            'Page' => 'Category',
            'Table' => 'category'
        ),
        array(
            'Name' => 'Videos',
            'Page' => 'Video',
            'Table' => 'video'
        ),
        array(
            'Name' => 'Galleries',
            'Page' => 'Gallery',
            'Table' => 'gallery'
        ),
        array(
            'Name' => 'Comics',
            'Page' => 'Comic',
            'Table' => 'comic'
        ),
        array(
            'Name' => 'Menus',
            'Page' => 'Menu',
            'Table' => 'menu'
        ),
    );
    $Color = array('primary', 'success', 'info', 'warning', 'danger');
    foreach ($Pages as $i) {
        ?>
        <div class="col-md-6">
            <div id="infocounts-<?php echo $i['Page']; ?>" class="col-md-12 bg-<?php echo $Color[array_rand($Color)]; ?>">
            </div>
            <hr class="clearfix" />
        </div>
        <?php
    }
    ?>

</div>



<script type="text/javascript">
    $(document).ready(function () {
        $('#Buttons *').hide('slow');
    });
</script>
<style type="text/css"> .row .span3{ margin-bottom: 60px; } </style>
<script type="text/javascript" language="javascript">
    $(document).ready(function () {
<?php
$j = 0;
foreach ($Pages as $i) {
    ?>
            $.ajax({
                url: '<?php echo ADM_BASE . 'Home/GetCounts?pg=' . $i['Table'] . '&lng=' . $i['Name'] . '&pid=' . $i['Page']; ?>',
                type: 'get',
                beforeSend: function () {
                    $('#infocounts-<?php echo $i['Page']; ?>').html('<img src="<?php echo ADM_CURRENT_URL_TEMPLATE ?>img/ajax-loaders/ajax-loader-6.gif" />');
                    DoWaiting();
                }, success: function (json) {
                    $('#infocounts-<?php echo $i['Page']; ?>').html(json);
                }, complete: function () {
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    DoError();
                }
            });
    <?php
    $j++;
}
?>
    });
</script>



<?php
/*

 <p class="pull-right visible-xs">
                        <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
                    </p>
                    <div class="jumbotron">
                        <h1>Hello, world!</h1>
                        <p>This is an example to show the potential of an offcanvas layout pattern in Bootstrap. Try some responsive-range viewport sizes to see it in action.</p>
                    </div>
                    <div class="row">
                        <div class="col-xs-6 col-lg-4">
                            <h2>Heading</h2>
                            <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
                            <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
                        </div><!--/.col-xs-6.col-lg-4-->
                        <div class="col-xs-6 col-lg-4">
                            <h2>Heading</h2>
                            <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
                            <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
                        </div><!--/.col-xs-6.col-lg-4-->
                        <div class="col-xs-6 col-lg-4">
                            <h2>Heading</h2>
                            <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
                            <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
                        </div><!--/.col-xs-6.col-lg-4-->
                        <div class="col-xs-6 col-lg-4">
                            <h2>Heading</h2>
                            <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
                            <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
                        </div><!--/.col-xs-6.col-lg-4-->
                        <div class="col-xs-6 col-lg-4">
                            <h2>Heading</h2>
                            <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
                            <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
                        </div><!--/.col-xs-6.col-lg-4-->
                        <div class="col-xs-6 col-lg-4">
                            <h2>Heading</h2>
                            <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
                            <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
                        </div><!--/.col-xs-6.col-lg-4-->
                    </div><!--/row-->

 */