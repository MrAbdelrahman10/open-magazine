<div id="login">
    <div class="twelve columns center">
        <h1><?php echo $dTitle; ?></h1>

        <aside id="accordion" class="widget widget_accordion">
            <div class="widget-container">
                <ul class="accordion">
                    <li>
                        <h4 class="accordion-title"><span class="accordion-icon"></span><?php echo $_ChangeEmail; ?></h4>
                        <div class="accordion-content">
                            <form method="post" action="<?php echo GetRewriteUrl('profile/changeemail'); ?>" id="emailform" class="form">
                                <div class="form-line">
                                    <i class="fa fa-envelope"></i>
                                    <input type="email" size="20" value="<?php echo $pUser['Email']; ?>" placeholder="<?php echo $_Email; ?>"  class="input" id="user_mail" name="cEmail">
                                </div>
                                <a href="javascript:void(0)" class="btn bgred" onclick="$('#emailform').submit();"><?php echo $_Save; ?></a>
                            </form>

                        </div>
                    </li>
                    <li>
                        <h4 class="accordion-title"><span class="accordion-icon"></span><?php echo $_ChangePassword; ?></h4>
                        <div class="accordion-content">

                            <form method="post" action="<?php echo GetRewriteUrl('profile/changepassword'); ?>" id="passform" class="form">
                                <div class="form-line">
                                    <i class="fa fa-lock"></i>
                                    <input type="password" size="20" value="" placeholder="<?php echo $_OldPassword ?>"  class="input" id="cOldPassword" name="cOldPassword">
                                    <span class="error" id="err-cOldPassword"></span>
                                </div>
                                <div class="form-line">
                                    <i class="fa fa-lock"></i>
                                    <input type="password" size="20" value="" placeholder="<?php echo $_NewPassword ?>"  class="input" id="cPassword" name="cPassword">
                                    <span class="error" id="err-cPassword"></span>
                                </div>
                                <a href="javascript:void(0)" class="btn bgred" onclick="$('#passform').submit();"><?php echo $_Save; ?></a>
                            </form>
                        </div>
                    </li>
                    <li>
                        <h4 class="accordion-title"><span class="accordion-icon"></span>إضافة مقال</h4>
                        <div class="accordion-content">
                            <?php
                            $dbool = '<option value="0">' . $_No . '</option>' . '<option value="1">' . $_Yes . '</option>';
                            ?>
                            <form method="post" action="<?php echo GetRewriteUrl(BASE_URL); ?>" id="postform">
                                <div class="form-line">
                                    <input id="sTitle" name="sTitle" placeholder="<?php echo $_sTitle ?>" type="text" value="">
                                    <span class="error" id="err-sTitle"></span>
                                </div>
                                <div class="form-line">
                                    <input id="Title" name="Title" placeholder="<?php echo $_Title ?>" type="text" value="">
                                    <span class="error" id="err-Title"></span>
                                </div>
                                <div><h3><?php echo $_Contents; ?></h3></div>
                                <div class="form-line">
                                    <textarea id="Contents" name="Contents" placeholder="<?php echo $_Contents ?>" class="editor"><?php echo GetValue($dContents); ?></textarea>
                                    <span class="error" id="err-Contents"></span>
                                </div>
                                <div class="form-line">
                                    <textarea id="Keywords" name="Keywords" placeholder="<?php echo $_Keywords ?>" class="editor"><?php echo GetValue($dKeywords); ?></textarea>
                                    <span class="error" id="err-Keywords"></span>
                                </div>

                                <div class="form-line list_input">

                                    <select name="Category" id="Category">
                                        <?php echo $dPostCategories; ?>
                                    </select>
                                </div>
                                <div class="form-line">
                                    <?php echo Label('Picture', $_Picture) ?>
                                    <?php
                                    echo
                                    Img('Image', GetImageThumbnail(GetValue($dPicture)), 'class="img-polaroid pull-left" data-toggle="modal" style="width: 100px;"');
                                    ?>
                                    <iframe src="<?php echo GetRewriteUrl('general/uploadimage'); ?>" class="pull-left"></iframe>
                                    <?php echo InputHidden('Picture', GetValue($dPicture)) ?>
                                </div>
                                <a href="javascript:void(0)" class="btn bgred" onclick="$('#passform').submit();"><?php echo $_Save; ?></a>
                            </form>

                        </div>
                    </li>
                </ul>
            </div>
        </aside>
        <aside class="my_articles">
            <a href="<?php echo GetRewriteUrl('profile/posts'); ?>"><i class="fa fa-pencil"></i><?php echo $_MyPosts; ?></a>
        </aside>
    </div>
</div>



<script type="text/javascript">
    $(document).ready(function () {
        $('#emailform').submit(function () {
            var _Data = $(this).serialize();
            $.ajax({
                url: '<?php echo GetRewriteUrl('profile/changeemail'); ?>',
                type: 'post',
                data: _Data,
                beforeSend: function () {
                    $('.Error').html('').fadeOut('slow');
                }, success: function (json) {
                    var _Result = $.parseJSON(json);
                    if (_Result['Redirect']) {
                        Redirect(_Result['Redirect']);
                    } else if (_Result['Msg']) {
                        alert(_Result['Msg']);
                    }
                }, complete: function () {
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    //DoError();
                }
            });
            return false;
        });

        $('#passform').submit(function () {
            var _Data = $(this).serialize();
            $.ajax({
                url: '<?php echo GetRewriteUrl('profile/changepassword'); ?>',
                type: 'post',
                data: _Data,
                beforeSend: function () {
                    //DoWaiting();
                    $('span.error').html('').fadeOut('slow');
                }, success: function (json) {
                    var _Result = $.parseJSON(json);
                    if (_Result['Redirect']) {
                        //DoSuccessed();
                        Redirect(_Result['Redirect']);
                    } else if (_Result['Msg']) {
                        //DoSuccessed();
                        alert(_Result['Msg']);
                    } else if (_Result['Error']) {
                        //DoWarning();
                        var e = _Result['Error'];
                        var i = new Array("cPassword", "cOldPassword");
                        ShowError(i, e);
                    }
                }, complete: function () {
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    //DoError();
                }
            });
            return false;
        });


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