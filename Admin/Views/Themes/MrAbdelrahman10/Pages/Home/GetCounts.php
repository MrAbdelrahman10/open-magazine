<h2><?php echo $d_Page ?></h2>
<p>
    <span class="col-md-8"><?php echo $d_On ?></span>
    <span class="badge badge-success count<?php echo $dpID; ?>"><?php echo $dOn; ?></span>
</p>
<p>
    <span class="col-md-8"><?php echo $d_Off ?></span>
    <span class="badge badge-warning count<?php echo $dpID; ?>"><?php echo $dOff; ?></span>
</p>
<p>
    <span class="col-md-8"><?php echo $d_All ?></span>
    <span class="badge badge-info count<?php echo $dpID; ?>"><?php echo $dAll; ?></span>
</p>
<p>
    <?php echo Anchor(ADM_BASE . $dpID, '<i class="icon-film icon-white"></i> ' . $d_View, 'class="btn btn-primary"') ?>
</p>

<script type="text/javascript">
    $('.count<?php echo $dpID; ?>').each(function () {
        var $this = $(this);
        jQuery({Counter: 0}).animate({Counter: $this.text()}, {
            duration: 3000,
            easing: 'swing',
            step: function () {
                $this.text(Math.ceil(this.Counter));
            }
        });
    });
</script>