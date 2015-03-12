<style>
    .recover_opt{
        height: 200px;
        display: block;
        margin: 20px;
        padding: 20px;
        background: #f5f5f5;
        border: 1px solid #e3e3e3;
        text-align: center;
        cursor: pointer;
    }
    .recover_opt:hover{
        background: #EFEFEF;
        border: 1px solid #000;
    }
    .selected{
        background: #e3e3e3;
        border: 1px solid #000;
    }
    .selected:hover{
        background: #e3e3e3;
        border: 1px solid #000;
    }
    .highLight{
        color: #2dcb71;
    }
</style>
<div class="container ng-scope" style="padding: 50px; min-height: 400px; background-color: #f7f7f7">
    <div>
        <div class="row">
            <div class="col col-sm-4">
                <div class="recover_opt" data-value="forget_password_email_form_div">
                    <h4>Get a Email</h4>
                    <span class="glyphicon glyphicon-envelope" style="font-size: 40px;"></span>
                    <br>
                    <span>
                        We'll send an email with login information <br>
                        <span class="highLight">example@example.com</span>
                    </span>
                    <div class="clear"></div>
                </div>
            </div>    
            <div class="col col-sm-4">
                <div class="recover_opt" data-value="forget_password_sms_form_div">
                    <h4>Get a Text</h4>
                    <span class="glyphicon glyphicon-comment" style="font-size: 40px;"></span>
                    <br>
                    <span>
                        We'll send a text message with login information <br>
                        <span class="highLight">xxx-xxx-xxxx</span>
                    </span>
                    <div class="clear"></div>
                </div>
            </div>
            <div class="col col-sm-4">
                <div class="recover_opt" data-value="forget_password_call_form_div">
                    <h4>Get a Call</h4>
                    <span class="glyphicon glyphicon-headphones" style="font-size: 40px;"></span>
                    <br>
                    <span>
                        We'll call you at <br>
                        <span class="highLight">xxx-xxx-xxxx</span>
                    </span>
                    <div class="clear"></div>
                </div>
            </div>
        </div>
        <div class="row">

            <?php
            $class = "";
            $style = "display: none;";
            if ($status == "error") {
                $class = "error_rsp";
                $style = "display: block;";
            }
            else if ($status == "ok") {
                $class = "success_rsp";
                $style = "display: block;";
            }
            ?>
            <div id="signin_rsp" style="<?php echo $style; ?>" class="<?php echo $class; ?>"><?php echo $msg; ?></div>
            <div class="col col-sm-3"></div>
            
            <?php 
            $display = ( isset($type_form) && $type_form == 'email') ? "display: block;" : "display: none;" ;
            ?>
            <div class="col col-sm-6 recover_opt_forms" id="forget_password_email_form_div" style="<?php echo $display; ?>" >
                <h4>Get a Email</h4>
                <form id="forget_password_email_form" class="well well-lg text-center ng-valid ng-dirty validate_form" action="<?php echo site_url('job_seeker/forget_password_process/email/'); ?>" method="post">
                    <label style="float: left; clear: left;">Your Email:</label>
                    <input type="email" placeholder="Your Email" class="form-control ng-valid ng-dirty" required id="forgot_email" name="forgot_email" value="<?php echo isset($forgot_email) ? $forgot_email : '' ; ?>">
                    <br>
                    <div style="text-align: left;">
                    <button type="submit" class="btn btn-primary btn-wide ">Submit</button>
                    </div>
                    <br>
                </form>
            </div>
            <?php 
            $display = ( isset($type_form) && $type_form == 'sms') ? "display: block;" : "display: none;" ;
            ?>
            <div class="col col-sm-6 recover_opt_forms" id="forget_password_sms_form_div" style="<?php echo $display; ?>">
                <h4>Get a Text</h4>
                <form id="forget_password_sms_form" class="well well-lg text-center ng-valid ng-dirty validate_form" action="<?php echo site_url('employer/forget_password_process/sms'); ?>" method="post">
                    <label style="float: left; clear: left;">Your Email:</label>
                    <input type="email" placeholder="Your Email" class="form-control ng-valid ng-dirty" required id="forgot_email" name="forgot_email" value="<?php echo isset($forgot_email) ? $forgot_email : '' ; ?>">
                    <label style="float: left; clear: left;">Your Phone Number:</label>
                    <input type="text" placeholder="Your Phone Number" class="form-control ng-valid ng-dirty" required id="sms_phone" name="sms_phone" value="<?php echo isset($sms_phone) ? $sms_phone : '' ; ?>">
                    <br>
                    <div style="text-align: left;">
                    <button type="submit" class="btn btn-primary btn-wide ">Submit</button>
                    </div>
                    <br>
                </form>
            </div>
            <?php 
            $display = ( isset($type_form) && $type_form == 'call') ? "display: block;" : "display: none;" ;
            ?>
            <div class="col col-sm-6 recover_opt_forms" id="forget_password_call_form_div" style="<?php echo $display; ?>">
                <h4>Get a Call</h4>
                <form id="forget_password_call_form" class="well well-lg text-center ng-valid ng-dirty validate_form" action="<?php echo site_url('employer/forget_password_process/call'); ?>" method="post">
                    <label style="float: left; clear: left;">Your Email:</label>
                    <input type="email" placeholder="Your Email" class="form-control ng-valid ng-dirty" required id="forgot_email" name="forgot_email" value="<?php echo isset($forgot_email) ? $forgot_email : '' ; ?>">
                    <label style="float: left; clear: left;">Your Phone Number:</label>
                    <input type="text" placeholder="Your Phone Number" class="form-control ng-valid ng-dirty" required id="call_phone" name="call_phone" value="<?php echo isset($call_phone) ? $call_phone : '' ; ?>">
                    <br>
                    <div style="text-align: left;">
                    <button type="submit" class="btn btn-primary btn-wide ">Submit</button>
                    </div>
                    <br>
                </form>
            </div>
            <div class="col col-sm-3"></div>
            
        </div>
    </div>

</div>