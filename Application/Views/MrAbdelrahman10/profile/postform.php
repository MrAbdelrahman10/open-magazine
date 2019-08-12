<div id="wraper_all">
    <div id="wraper-internal">
        <div id="register">
            <h3><?php echo $dTitle; ?></h3>
            <?php
            $dbool = '<option value="0">' . $_No . '</option>' . '<option value="1">' . $_Yes . '</option>';
            ?>
            <div class="form">
                <form id="form" action="<?php echo GetRewriteUrl('profile/home') ?>" method="post">

                    <p class="contact"><label for="sTitle"><?php echo $_sTitle ?></label></p>
                    <input id="sTitle" name="sTitle" placeholder="<?php echo $_sTitle ?>" type="text" value="<?php echo GetValue($dsTitle); ?>">
                    <p><span class="error" id="err-sTitle"></span></p>

                    <p class="contact"><label for="Title"><?php echo $_Title ?></label></p>
                    <input id="Title" name="Title" placeholder="<?php echo $_Title ?>" type="text" value="<?php echo GetValue($daTitle); ?>">
                    <?php echo InputHidden('Alias', $dAlias); ?>
                    <p><span class="error" id="err-Title"></span></p>

                    <p class="contact"><label for="Contents"><?php echo $_Contents ?></label></p>
                    <textarea id="Contents" name="Contents" placeholder="<?php echo $_Contents ?>" class="editor"><?php echo GetValue($dContents); ?></textarea>
                    <p><span class="error" id="err-Contents"></span></p>

                    <p class="contact"><label for="Keywords"><?php echo $_Tags ?></label></p>
                    <input id="Keywords" name="Keywords" placeholder="<?php echo $_Tags ?>" type="text" value="<?php echo GetValue($dTags); ?>">
                    <p><span class="error" id="err-Keywords"></span></p>

                    <p class="contact"><label for="Category"><?php echo $_Category ?></label></p>
                    <select name="Category" id="Category">
                        <?php echo $dPostCategories; ?>
                    </select>
                    <p><span class="error" id="err-Category"></span></p>

                    <?php echo Label('Picture', $_Picture) ?>
                    <?php
                    echo
                    Img('Image', GetImageThumbnail(GetValue($dPicture)), 'class="img-polaroid pull-left" data-toggle="modal" style="width: 100px;"');
                    ?>
                    <iframe src="<?php echo GetRewriteUrl('general/uploadimage'); ?>" class="pull-left"></iframe>
                    <?php echo InputHidden('Picture', ($dPicture)) ?>

                    <p class="contact"><label for="State"><?php echo $_State ?></label></p>
                    <select name="State" id="State">
                        <?php echo $dbool; ?>
                    </select>
                    <p><span class="error" id="err-State"></span></p>

                    <br>
                    <?php echo Anchor('javascript:void(0)', $_Save, 'onclick="$(\'#form\').submit();" class="buttom" id="submit"', false) ?>
                </form>
            </div>
        </div>
    </div><!-----------internal-------------->
</div>



<script type="text/javascript">
    $(document).ready(function () {
//        $('.editor').each(function () {
//            if (this.id)
//                CKEDITOR.replace(this.id, {toolbar: 'Basic'});
//        });
        SetIndex(<?php echo (isset($dCategoryID) ? $dCategoryID : 0); ?>, 'Category');
        $('#postform').submit(function () {
//            for (instance in CKEDITOR.instances)
//            {
//                CKEDITOR.instances[instance].updateElement();
//            }
            var _Data = $(this).serialize();
            $.ajax({
                url: '<?php echo GetRewriteUrl($psUrl); ?>',
                type: 'post',
                data: _Data,
                beforeSend: function () {
                    DoWaiting();
                    $('.Error').fadeOut('slow');
                    $('.Error').html('');
                }, success: function (json) {
                    alert(json);
                    var _Result = $.parseJSON(json);
                    if (_Result['Redirect']) {
                        DoSuccessed();
                        Redirect(_Result['Redirect']);
                    } else if (_Result['Error']) {
                        DoWarning();
                        var e = _Result['Error'];
                        var i = new Array("Title", "Alias", "PictureDescription", "Contents", "Description", "Keywords", "Category", "CreatedDate", "ModifiedDate", "Slider", "State");
                        ShowError(i, e);
                    }
                }, complete: function () {
                }, error: function (xhr, ajaxOptions, thrownError) {
                    DoError();
                }});
            return false;
        });
        $('#Title').blur(function () {
            DoAlias('Title', 'Alias');
        });






    });
</script>