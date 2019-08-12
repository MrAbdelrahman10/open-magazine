<script type="text/javascript">
    $(document).ready(function () {
        $("a[rel^='prettyPhoto']").prettyPhoto();
        $("a[data-ajax='true']").unbind('click').click(function () {
            var pageurl = $(this).attr('href');
            LoadPageContent(pageurl);
            FB.XFBML.parse();
            return false;
        });
        document.title = '<?php echo $d['dTitle']; ?>';
        if (window.stButtons) {
            stButtons.locateElements();
        }
    });
</script>
<?php
FBInit();
echo $s['sExtraScripts'];
?>