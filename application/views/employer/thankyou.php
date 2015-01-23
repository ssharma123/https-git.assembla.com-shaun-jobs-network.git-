
<div style="padding: 50px; min-height: 400px; background-color: #f7f7f7" class="container ng-scope">
    <div>
        <?php
        $class = '';
        $heading = '';
        if($status == "ok"){
            $class == 'success_rsp';
            $heading = "Thankyou for subscribing";
        }
        else if($status == "error"){
            $class = 'error_rsp';
            $heading = "Error";
        } ?>
        
        <h3><?php echo $heading; ?></h3><br>
        <div class="row">
            
            
            <div class="col col-sm-12 <?php echo $class; ?>" > 
                <p><?php echo $msg; ?></p>
            </div>
            
        </div>
    </div>
</div>

