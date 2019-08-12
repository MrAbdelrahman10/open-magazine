<?php if ($dResults) { ?>  
    <table class="table table-striped table-bordered bootstrap-datatable"> 
        <thead> 
            <tr> 
                <th class="ID"> 
                    <?php echo $_ID; ?> 
                </th> 
                <th> 
                    <?php echo $_Banner; ?> 
                </th> 
            </tr> 
        </thead> 
        <tbody> 
            <?php foreach ($dResults as $Item) { ?> 
                <tr onclick="ChoosIt('<?php echo $Item['ID']; ?>', '<?php echo $Item['Name']; ?>');"> <td>
                        <?php echo $Item['ID']; ?></td> <td>
                        <?php echo $Item['Name']; ?></td> <td>
                </tr> 
            <?php } ?> 
        </tbody> 
    </table> 
<?php } ?>  