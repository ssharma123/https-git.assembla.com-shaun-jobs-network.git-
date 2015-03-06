<script>
var facilities = <?php echo $facilities; ?>;
</script>
<?php echo load_js("job_seeker.js"); ?>

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
                <form class="well well-lg text-center ng-valid ng-dirty validate_form" action="<?php echo site_url('job_seeker/signin'); ?>" method="post">
                    
                    <input type="email" placeholder="Your Email" class="form-control ng-valid ng-dirty" required id="signin_email" name="signin_email" value="<?php echo isset($signin_email) ? $signin_email : '' ; ?>">
                    <br>
                    <input type="password" placeholder="Your Password" class="form-control ng-valid ng-dirty" required id="signin_password" name="signin_password" value="<?php echo isset($signin_password) ? $signin_password : '' ; ?>">
                    <a style="float:left;clear:left; margin:5px 0 10px 5px;" href="<?php echo site_url("job_seeker/forget_password"); ?>">Forget password</a>
                    <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                    <br>
                    <div class="row">
                        <div class="col col-sm-6"><a id="facebookLogin_jobseeker" href="javascript:void(0)" type="submit" class="btn btn-info btn-block">Facebook</a></div>
                        <div class="col col-sm-6"><a id="linkedinLogin_jobseeker" href="javascript:void(0)" type="submit" class="btn btn-info btn-block">LinkedIn</a></div>
                    </div>

                </form>
            </div>
            
            <div class="col col-sm-4" id="signin_email_form_div" style="display: none;">
                <p>Add your email address below to get started</p>
                <form class="well well-lg text-center ng-valid ng-dirty validate_form" method="post" id="save_email_siginin_form_jobseeker">
                    <input type="hidden" name="facebook_id" id="facebook_id" >
                    <input type="hidden" name="first_name" id="first_name" >
                    <input type="hidden" name="last_name" id="last_name" >
                    <input type="email" placeholder="Your Email" class="form-control" required id="email" name="email" id="email" value="">
                    <br>
                    <a href="javascript:void(0)" id="complete_sigin_facebook_jobseeker" class="btn btn-primary btn-block">Complete Sign In</a>
                    <br>
                </form>
            </div>
            
            <div class="col col-sm-2"></div>
            <div class="col col-sm-6">
                 
                <h2 style="color: #555; margin-bottom: 20px">Not a member?</h2>
                <p style="color: #777; font-size: 14px;">MedMatch is the best way for physicians to find their next job.</p>
                <p style="color: #777; font-size: 14px;">Our matching system finds you exciting new opportunities and saves you a lot of effort during your job search.</p>
                <p style="font-size: 1.2em">The best part about it? It's <strong><em>free</em></strong>!</p>
                <h3>Sign up <a href="<?php echo site_url("job_seeker/signup/"); ?>">now</a></h3>
                
            </div>
        </div>
    </div>

</div>
<script>
    
    
    
    
</script>