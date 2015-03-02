<script>
var facilities = <?php echo $facilities; ?>;
</script>
<?php echo load_js("employee_dashboard.js"); ?>

<div class="container ng-scope" style="padding: 50px; min-height: 400px; background-color: #f7f7f7">
    <div>

        <div class="row">

            <?php
            $class = "";
            $style = "display: none;";
            if ($status == "error") {
                $class = "error_rsp";
                $style = "display: block;";
                ?>
                <div id="signin_rsp" style="" class="<?php echo $class; ?>"><?php echo $msg; ?></div>
            <?php } ?>
                <div id="signup_signin_form_rsp" style="display: none;"></div>
                <div id="fb_error_msg" style="display: none;"></div>
                
            <div class="col col-sm-4" id="sigin_form_div">
                <form class="well well-lg text-center ng-valid ng-dirty validate_form" action="<?php echo site_url('employer/signin'); ?>" method="post">
                    
                    <input type="email" placeholder="Your Email" class="form-control ng-valid ng-dirty" required id="signin_email" name="signin_email" value="<?php echo isset($signin_email) ? $signin_email : '' ; ?>">
                    <br>
                    <input type="password" placeholder="Your Password" class="form-control ng-valid ng-dirty" required id="signin_password" name="signin_password" value="<?php echo isset($signin_password) ? $signin_password : '' ; ?>">
                    <a style="float:left;clear:left; margin:5px 0 10px 5px;" href="<?php echo site_url("employer/forget_password"); ?>">Forget password</a>
                    <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                    <br>
                    <div class="row">
                        <div class="col col-sm-6"><a id="facebookLogin" href="javascript:void(0)" type="submit" class="btn btn-info btn-block">Facebook</a></div>
                        <div class="col col-sm-6"><a id="linkedinLogin" href="javascript:void(0)" type="submit" class="btn btn-info btn-block">LinkedIn</a></div>
                    </div>

                </form>
            </div>
            
            <div class="col col-sm-4" id="signin_email_form_div" style="display: none;">
                <p>Please enter email to complete the process</p>
                <form class="well well-lg text-center ng-valid ng-dirty validate_form" method="post" id="save_email_siginin_form">
                    <input type="hidden" name="facebook_id" id="facebook_id" >
                    <input type="hidden" name="first_name" id="first_name" >
                    <input type="hidden" name="last_name" id="last_name" >
                    <input type="email" placeholder="Your Email" class="form-control" required id="email" name="email" id="email" value="">
                    <br>
                    <a href="javascript:void(0)" id="complete_sigin_facebook" class="btn btn-primary btn-block">Complete Signin</a>
                    <br>
                </form>
            </div>
                
            <div class="col col-sm-2"></div>
            <div class="col col-sm-6">
                <form class="form-horizontal ng-pristine ng-valid" id="signup_sigin_form" method="post" action="<?php echo site_url('employer/signup/2'); ?>">
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Name</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control ng-pristine ng-valid" placeholder="" required id="signin_signup_name" name="signup_name">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="phone">Phone</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control ng-pristine ng-valid is_phone_number" placeholder="" required id="signin_signup_phone" name="signup_phone" >
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="email">Email</label>
                        <div class="col-sm-8">
                            <input type="email" class="form-control ng-pristine ng-valid ng-valid-email" placeholder="" required id="signin_signup_email" name="signup_email" >
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="password">Choose a Password</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control ng-pristine ng-valid" placeholder="Password" required id="signin_password_2" name="password" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="confirmpassword">Confirm Password</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control ng-pristine ng-valid" placeholder="One More Time Please!" required id="signin_confirm_password" name="confirm_password" >
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="facilityName">Facility Name</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control ng-pristine ng-valid facilities-auto" required id="signin_signup_facility" name="signup_facility" autocomplete="off">
                            <input type="hidden" name="signup_facility_id" id="signup1-facility_id" value="0">
                        </div>
                    </div>


                    <div class="text-center" style="padding-top: 20px;">
                        <label class="col-sm-4 control-label"></label>
                        <div class="col-sm-8">
                            <button type="submit" class="btn btn-primary btn-block">Sign Up </button>
                        </div>
                        
                        <br>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>