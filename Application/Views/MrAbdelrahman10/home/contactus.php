<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <?php
        if (GetValue($dMsg)) {
            ?>
        <div class="alert alert-success"><?php echo $dMsg; ?></div>
        <?php
        }
        ?>
        <div class="well well-sm">
            <form class="form-horizontal" action="" method="post">
                <fieldset>
                    <legend class="text-center"><?php echo $dTitle; ?></legend>

                    <!-- Name input-->
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="mName"><?php echo $_URName; ?></label>
                        <div class="col-md-9">
                            <input id="mName" name="mName" type="text" placeholder="<?php echo $_URName; ?>" class="form-control" required>
                        </div>
                    </div>

                    <!-- Email input-->
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="mEmail"><?php echo $_Email; ?></label>
                        <div class="col-md-9">
                            <input id="email" name="email" type="email" placeholder="<?php echo $_Email; ?>" class="form-control" required>
                        </div>
                    </div>

                    <!-- Message body -->
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="mMessage"><?php echo $_URMsg; ?></label>
                        <div class="col-md-9">
                            <textarea class="form-control" id="mMessage" name="mMessage" placeholder="<?php echo $_URMsg; ?>" rows="5" required></textarea>
                        </div>
                    </div>

                    <!-- Form actions -->
                    <div class="form-group">
                        <div class="col-md-12 text-right">
                            <button type="submit" class="btn btn-primary btn-lg"><?php echo $_Send; ?></button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>