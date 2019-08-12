<script type="text/javascript">
    $(document).ready(function () {
        window.onerror = null;
        $('#Waiting').hide();
        $('#Loading').hide();
        $('.msg').hide();
        $('#eID').val('');
        $('textarea').attr('rows', 4);
        $('textarea').attr('style', 'font-size: 16px;');
        $('textarea, input, select').addClass('form-control');
        $('textarea, input, select').addClass('col-md-12');
        $('#details .formRow').addClass('clearfix');
        $('#details .formRow label').addClass('col-sm-4');
        $(".date").datepicker();
        $('[data-toggle="popover"]').popover();
        $(".datetime").mask("9999-99-99 99:99");
        $(".tags").tagsinput();
//        $("img").lazyload();
        $(".collapse").collapse();
        $('.nav-tabs').each(function () {
            if (this.id)
                LoadTabs(this.id);
        });

        $('select').each(function () {
            var selectid = $(this).attr('data-select');
            var cmbid = this.id;
            if (selectid && cmbid) {
                SetIndex(selectid, cmbid);
            }
        });

        $('.editor').each(function () {
            if (this.id) {
                CKEDITOR.replace(this.id, {
                    filebrowserBrowseUrl: '<?php echo ADM_BASE . "FileManager/Only"; ?>'
                });
            }
        });

        $('.msg').click(function () {
            $(this).fadeOut('slow');
        });

$('.count').each(function () {
        var $this = $(this);
        $({Counter: 0}).animate({Counter: $this.text()}, {
            duration: 3000,
            easing: 'swing',
            step: function () {
                $this.text(Math.ceil(this.Counter));
            }
        });
    });

<?php
if ($sAdminBrowsing_Ajax == 1) {
    ?>
            $("a[rel='ajax']").unbind('click').click(function () {
                var pageurl = $(this).attr('href');
                LoadPageContent(pageurl);
                return false;
            });
    <?php
}
?>
<?php if (($pAction === 'Index' || $pAction === 'Details') && ($dButtons === true)) { ?>
            $('#Buttons *').show('slow');
            $('#btnAdd').attr('href', '<?php echo ADM_BASE . $pID ?>/Add');
            $('#Deleting').attr('action', '<?php echo ADM_BASE . $pID ?>/Delete');
            $('#btnSelectAll').removeClass('btn-inverse').addClass('btn-success').html('<i class="icon-ok icon-white"></i><?php echo $_SelectAll ?>');
            $('#dIDs').val('');
<?php } else { ?>
            $('#Buttons *').hide('slow');
<?php } ?>
        $(".Delete").unbind('click').click(function () {
            $('#dIDs').val($(this).data('id'));
        });
        $(".Details").unbind('click').click(function () {
            var ID = $(this).data('id');
            var _Data = "dID=" + ID;
            $.ajax({url: '<?php echo ADM_BASE . $pID ?>/Details', type: 'get', data: _Data, beforeSend: function () {
                    DoWaiting();
                    $("#ItemDetails").html('<img src="<?php echo ADM_CURRENT_URL_TEMPLATE ?>img/ajax-loaders/ajax-loader-6.gif" />');
                    $("#lnkEdit").attr('href', '<?php echo ADM_BASE . $pID ?>/Edit/' + ID);
                }, success: function (json) {
                    $("#ItemDetails").html(json);
                }, complete: function () {
                    $('#Waiting').fadeOut();
                }, error: function (xhr, ajaxOptions, thrownError) {
                    DoError();
                }});
        }
        );
        $('#lnkEdit').unbind('click').click(function () {
            $('#DetailOperation').modal('hide');
        });
        $('#lnkDelete').unbind('click').click(function () {
            $('#Deleting').submit();
        });
        $('.nav-tabs a').unbind('click').click(function (e) {
            e.preventDefault();
            $(this).tab('show');
        });
        $('.DoAlias').unbind('blur').blur(function (e) {
            var Name = this.id;
            var Alias = $(this).data('alias');
            DoAlias(Name, Alias);
        });

        $('.itemState').click(function () {
            var _ID = $('#' + $(this).data('toggle')).data('id');
            var _State = $(this).data('id');
            $.ajax({
                url: '<?php echo ADM_BASE . $pID ?>/ChangeState',
                type: 'post',
                data: {
                    ID: _ID,
                    State: _State
                },
                beforeSend: function () {
                    DoWaiting();
                }, success: function (json) {
                    if (json['IsResult']) {
                        DoSuccessed();
                    } else if (json['IsError']) {
                        DoWarning();
                    } else if (json['Redirect']) {
                        Redirect(json['Redirect']);
                    }
                }, complete: function () {
                }, error: function (xhr, ajaxOptions, thrownError) {
                    DoError();
                }});
        });

        $('.radioBtn a').click(function () {
            var sel = $(this).data('id');
            var tog = $(this).data('toggle');
            $('#' + tog).prop('value', sel);
            $('a[data-toggle="' + tog + '"]').not('[data-id="' + sel + '"]').removeClass('active btn-primary').addClass('notActive btn-default');
            $('a[data-toggle="' + tog + '"][data-id="' + sel + '"]').removeClass('notActive btn-default').addClass('active btn-primary');
        });
        $('.DataChoose').unbind('click').click(function () {
            $.ajax({
                url: '<?php echo ADM_BASE ?>Show/' + $(this).attr('data-source'),
                type: 'get',
                beforeSend: function () {
                    $("#DataDetails").html('<img src="<?php echo ADM_CURRENT_URL_TEMPLATE ?>img/ajax-loaders/ajax-loader-6.gif" />');
                    DoWaiting();
                }, success: function (json) {
                    $("#DataDetails").html(json);
                }, complete: function () {
                    $('#Waiting').fadeOut();
                }, error: function (xhr, ajaxOptions, thrownError) {
                    DoError();
                }
            });
        });
    });

    function SeteID(ID, state) {
        if (state == true) {
            $('#btnEdit').attr('href', '<?php echo ADM_BASE . $pID ?>/Edit/' + ID);
            $('#eID').val(ID);
        } else {
            $('#btnEdit').attr('href', 'javascript:void(0)');
            $('#eID').val('');
        }
    }
    function Redirect(Url) {
        //LoadPageContent(Url);
        window.location = Url;
    }
</script>