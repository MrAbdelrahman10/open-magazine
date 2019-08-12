<form id="upload" enctype="multipart/form-data" action="<?php echo $pUrl; ?>" method="post">
    <input type="file" name="Image" id="Image" value="" onchange="submit();" />
</form>

<?php if (isset($dImage)) { ?>
    <script type="text/javascript">
        var i = '<?php echo $dImage; ?>';
        var img = parent.document.getElementById('Image');
        var Pic = parent.document.getElementById('Picture');
        img.src = i = Pic.value = i;
    </script>
<?php } ?>

<!--    <script>
document.forms[0].addEventListener('submit', function( evt ) {
    var file = document.getElementById('file').files[0];

    if(file && file.size < 1048576) { // 10 MB (this size is in bytes)
        //Submit form
    } else {
        //Prevent default and display error
        evt.preventDefault();
    }
}, false);
</script>-->