<?php echo load_js("employee_dashboard.js"); ?>

<div class="container ng-scope" style="padding: 50px; min-height: 400px; background-color: #f7f7f7">
    <div>
        
        <div class="row">
            
            <?php 
            $class= "";
            $style = "display: none;";
            if($status == "error"){ 
                $class= "error_rsp";
                $style = "display: block;";
            ?>
            <div id="signin_rsp" style="" class="<?php echo $class; ?>"><?php echo $msg; ?></div>
            <?php } ?>
            
            <div class="col col-sm-4 col-sm-offset-4">
                <form class="well well-lg text-center ng-valid ng-dirty validate_form" action="<?php echo site_url('employer/signin'); ?>" method="post">
                    <input type="email" placeholder="Your Email" class="form-control ng-valid ng-dirty" required id="signin_email" name="signin_email">
                    <br>
                    <input type="password" placeholder="Your Password" class="form-control ng-valid ng-dirty" required id="signin_password" name="signin_password">
                    <br>

                    <button type="submit" class="btn btn-primary btn-block">Sign In</button>

                </form>
            </div>
        </div>
    </div>

</div>