<!-- Le styles -->
<link href="<?php echo ADM_CURRENT_URL_TEMPLATE; ?>css/bootstrap.min.css" rel="stylesheet" />
<link href="<?php echo ADM_CURRENT_URL_TEMPLATE; ?>css/font-awesome.min.css" rel="stylesheet" />
<link href="<?php echo ADM_CURRENT_URL_TEMPLATE; ?>css/color.css" rel="stylesheet" />
<link href="<?php echo ADM_CURRENT_URL_TEMPLATE; ?>css/bootstrap-tagsinput.css" rel="stylesheet" />
<link href="<?php echo APP_PUBLIC; ?>bootstrap/third-party/bootstrap-daterangepicker-master/daterangepicker.css" rel="stylesheet" />
<?php
if ($_Direction == 'rtl') {
    ?>
    <link href="<?php echo ADM_CURRENT_URL_TEMPLATE; ?>css/rtl.css" rel="stylesheet" />
    <?php
}
?>
<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]> <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script> <![endif]-->
<link rel="stylesheet" type="text/css" href="<?php echo ADM_CURRENT_URL_TEMPLATE; ?>css/jquery-ui.css" />
<link rel="stylesheet" type="text/css" href="<?php echo ADM_CURRENT_URL_TEMPLATE; ?>css/style.css" />
<script type="text/javascript">var _admUrl = '<?php echo ADM_BASE; ?>';</script>
<script src="<?php echo ADM_CURRENT_URL_TEMPLATE; ?>js/jquery.min.js" type="text/javascript"></script>
<script src="<?php echo ADM_CURRENT_URL_TEMPLATE; ?>js/jquery-migrate.min.js" type="text/javascript"></script>
<script src="<?php echo ADM_CURRENT_URL_TEMPLATE; ?>js/jquery.ui.min.js" type="text/javascript"></script>
<script src="<?php echo ADM_CURRENT_URL_TEMPLATE; ?>js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo ADM_CURRENT_URL_TEMPLATE; ?>js/jquery.lazyload.min.js" type="text/javascript"></script>
<script src="<?php echo ADM_CURRENT_URL_TEMPLATE; ?>js/ajax_file_upload.js" type="text/javascript"></script>
<script src="<?php echo ADM_CURRENT_URL_TEMPLATE; ?>js/bootstrap-tagsinput.min.js" type="text/javascript"></script>
<script src="<?php echo APP_PUBLIC; ?>bootstrap/third-party/bootstrap-daterangepicker-master/date.js" type="text/javascript"></script>
<script src="<?php echo APP_PUBLIC; ?>Scripts/jquery.sheepItPlugin.min.js" type="text/javascript"></script>
<script src="<?php echo APP_PUBLIC; ?>Scripts/jquery.maskedinput.min.js" type="text/javascript"></script>
<script src="<?php echo APP_PLUGINS; ?>ckeditor/ckeditor.js"></script>
<!-- elFinder CSS (REQUIRED) -->
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo APP_PLUGINS; ?>elfinder/css/elfinder.min.css">
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo APP_PLUGINS; ?>elfinder/css/theme.css">
<!-- elFinder JS (REQUIRED) -->
<script type="text/javascript" src="<?php echo APP_PLUGINS; ?>elfinder/js/elfinder.min.js"></script>
<!-- elFinder translation (OPTIONAL) -->
<!--<script type="text/javascript" src="<?php echo APP_PLUGINS; ?>elfinder/js/i18n/elfinder.ar.js"></script>-->
<script type="text/javascript">
    function DoError() {
        $('#Waiting').fadeOut();
    }
    function DoWarning() {
        $('#Waiting, .msg').fadeOut();
        $('#WarningInner').fadeIn().delay(5000).fadeOut('slow');
    }
    function DoWaiting() {
        $('.Error').html('');
        $('#Waiting').show();
    }
    function DoSuccessed() {
        $('#Waiting').fadeOut();
        $('#SuccessMessage').fadeIn('slow').delay(3000).fadeOut('slow');
    }
    function BeforeSubmit() {
        DoWaiting();
        $('.btn-submit').attr('disabled', 'disabled');
    }
    function AfterSubmit() {
        $('.btn-submit').removeAttr('disabled');
    }
    function DoCompleted() {
    }
    function ShowError(e) {
        $('.Error').parent('div').removeClass('has-error error').addClass('has-success');
        if (true) {
            var msg = '';
            for (var k in e) {
                if (e.hasOwnProperty(k)) {
                    $('#' + k).parent('div').addClass('has-error error');
                    $('#err' + k).html(e[k]);
                    msg += '* '+e[k] + '.<br />';
                    $('#err' + k).fadeIn('slow');
                }
            }
            $('#WarningMessage').html(msg).show();
        }
        return;
    }
    function DoAlias(Title, Alias) {
        var t = document.getElementById(Title);
        var a = document.getElementById(Alias);
        var als = t.value.trim().replace(new RegExp(' ', 'g'), '-');
        a.value = als.substring(0, 50);
    }

    function DoDescription(ID) {
        var editor = CKEDITOR.instances[ID];
        var desc = $('#' + ID).data('description');
        if (editor) {
            editor.on('blur', function (event) {
                ckUpdate();
                var inputText = $('#' + ID).val();
                inputText = $(inputText)[0].textContent;
                $('#' + desc).val(inputText);
            });
        }
    }
    function LoadTabs(ID) {
        $('#' + ID + ' a:first').tab('show');
    }
    function Delete(rID) {
        var Row = document.getElementById("R-" + rID);
        var dID = document.getElementById("dID");
        dID.value = rID;
        var dMsgs = document.getElementById("dMsg");
        dMsgs.innerHTML = String.format(dMsg, Row.innerHTML);
    }
    function MultiCheck(rID) {
        var dID = document.getElementById("C-" + rID);
        var dIDs = document.getElementById("dIDs");
        if (dID.checked === true) {
            dIDs.value += rID + ",";
            SeteID(rID, true);
        } else if (dID.checked === false) {
            dIDs.value = dIDs.value.replace(rID + ",", "");
            SeteID(rID, false);
        }
    }
    function ReplaceSpace(C) {
        var e = window.event || e;
        var k = e.keyCode || e.charCode;
        if (k === 32) {
            document.getElementById(C).value += ",";
            return false;
        }
        return true;
    }
    function SetIndex(ID, ComboBox) {
        var cmb = document.getElementById(ComboBox);
        if (cmb !== null) {
            $('#' + ComboBox).val(ID);
        }
    }
    function LoadPageContent(pageurl) {
        var rel = pageurl.indexOf('?') > -1 ? '&rel=ajax' : '?rel=ajax';
        $.ajax({url: pageurl + rel, beforeSend: function () {
                $('#Buttons *').hide('slow');
                $('#PageContents').fadeOut().fadeIn().html('<center><img src="<?php echo ADM_CURRENT_URL_TEMPLATE ?>img/ajax-loader.gif" /></center>');
                $("html, body").animate({scrollTop: 0}, "slow");
            }, success: function (data) {
                if (data['RedirectError']) {
                    window.location = data['RedirectError'];
                    return;
                } else {
                    $('#PageContents').html(data).fadeIn('medium');
                }
            }, complete: function () {
                DoCompleted();
            }, error: function (xhr, ajaxOptions, thrownError) {
                DoError();
            }});
        if (pageurl != window.location) {
            window.history.pushState({path: pageurl}, '', pageurl);
        }
        return false;
    }
    String.format = function () {
        var s = arguments[0];
        for (var i = 0; i < arguments.length - 1; i++) {
            var reg = new RegExp("\\{" + i + "\\}", "gm");
            s = s.replace(reg, arguments[i + 1]);
        }
        return s;
    }
    function getDateString(value)
    {
        var d = new Date(value);
        return d.getMonth() + 1 + "/" + d.getDate() + "/" + d.getFullYear();
    }

    function ckUpdate() {
        for (instance in CKEDITOR.instances)
        {
            CKEDITOR.instances[instance].updateElement();
        }
    }
    $(document).ready(function () {
        $('.navbar .dropdown').hover(function () {
            $(this).find('.dropdown-menu').first().stop(true, true).slideDown(150);
        }, function () {
            $(this).find('.dropdown-menu').first().stop(true, true).slideUp(105);
        });
        $('#btnSelectAll').click(function () {
            var chks = document.getElementsByTagName('input');
            var IDs = document.getElementById('dIDs');
            IDs.value = '';
            if ($('#btnSelectAll').hasClass('btn-success')) {
                for (i = 0; i < chks.length; i++) {
                    var chk = chks[i];
                    if (chk.type === 'checkbox') {
                        var a = chk.id.substring(chk.id.indexOf('-') + 1, chk.id.length);
                        chk.setAttribute('checked', 'checked');
                        IDs.value += a + ',';
                    }
                }
                $('#btnSelectAll').removeClass('btn-success').addClass('btn-inverse').html('<i class="glyphicon glyphicon-remove icon-white"></i><?php echo $_DeSelectAll ?>');
            } else {
                for (i = 0; i < chks.length; i++) {
                    var chk = chks[i];
                    if (chk.type == 'checkbox') {
                        var a = chk.id.substring(chk.id.indexOf('-') + 1, chk.id.length);
                        chk.removeAttribute('checked');
                    }
                }
                $('#btnSelectAll').removeClass('btn-inverse').addClass('btn-success').html('<i class="glyphicon glyphicon-ok icon-white"></i><?php echo $_SelectAll ?>');
            }
        });
    });

    function addForm(id) {
        var emd = '<div class="multiple">' + $("#" + id + " div:first").clone().html() + '</div>';
        $("#" + id).append(emd);
    }
</script>