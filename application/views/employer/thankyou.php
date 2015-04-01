
<div style="padding: 50px; min-height: 400px; background-color: #f7f7f7" class="container ng-scope">
    <div>
        <?php
        $class = '';
        $heading = '';
        if($status == "ok"){
            $class == 'success_rsp';
            $heading = "Thank you ";
        }
        else if($status == "error"){
            $class = 'error_rsp';
            $heading = "Error";
        } ?>
        
        <h3><?php echo $heading; ?></h3><br>
        <div class="row">
            
            
            <div class="col col-sm-12 <?php echo $class; ?>" > 
                <?php 
                if( isset($status) && $status == "ok"){ ?>
                <p>Your order have been placed</p>
                <p>A confirmation email will be sent to : info@medmatchjobs.com once the order has been processed </p>
                
                <a class="btn btn-primary btn-lg" href="<?php echo site_url("employee_dashboard"); ?>">Continue</a>
                <?php } ?>
            </div>
            
        </div>
    </div>
</div>

