<script>
var facilities = <?php echo $facilities; ?>;
</script>
<?php echo load_js("jquery-1.10.2.min.js"); ?>

<?php 
    echo load_css('jquery.fancybox.css?v=2.1.4','assets/js/fancybox/');
    echo load_css('jquery.fancybox-buttons.css?v=1.0.5','assets/js/fancybox/helpers/');
    echo load_css('jquery.fancybox-thumbs.css?v=1.0.7','assets/js/fancybox/helpers/');
?>
<?php 
    // fancybox JS files
    echo load_js("jquery.fancybox.js?v=2.1.4","assets/js/fancybox/");
    echo load_js("jquery.fancybox-buttons.js?v=1.0.5","assets/js/fancybox/helpers/");
    echo load_js("jquery.fancybox-thumbs.js?v=1.0.7","assets/js/fancybox/helpers/");
    echo load_js("jquery.fancybox-media.js?v=1.0.5","assets/js/fancybox/helpers/");
?>
<?php echo load_js("home.js"); ?>
<section class="header-11-sub bg-midnight-blue">
    <div class="background">&nbsp;</div>
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <h3>Medical Staffing. Redefined.</h3>
                <p>Providing direct-access to top talent–MedMatch is streamlining the application process. Sign up and post your first job. It's free!</p>
                <div class="signup-form">
                    <div id="signupForm1_rsp" style="display: none;"></div>
                    <form action="<?php echo site_url('employer/signup/2'); ?>" method="post" id="signupForm1">
                        
                        <div class="form-group">
                            <input class="form-control" type="text" placeholder="Full Name" id="signup1-name" name="signup1-name" required>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="email" class="form-control" placeholder="Email" required id="signup1-email" name="signup1-email">
                            </div>
                            <div>
                                <input type="text" class="form-control ng-valid ng-dirty facilities-auto" id="signup1-facility" name="signup1-facility" placeholder="Facility" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-embossed btn-block btn-info">Sign Up</button>
                        </div>
                        <input type="hidden" name="signup1-facility_id" id="signup1-facility_id" value="0">
                        <input type="hidden" name="no_password" value="yes">
                    </form>
                </div>
                <div class="additional-links">By signing up you agree to <a href="#">Terms of Use</a> and <a href="#">Privacy</a></div>
            </div>
            <div class="col-sm-7 col-sm-offset-1 player-wrapper"></div>
        </div>
    </div>
    <a class="control-btn fui-arrow-down" href="#"></a>


</section>
<section class="content-32">
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <h3>Introducing a better way to hire.</h3>
                <p class="lead">MedMatch is the first two-sided market place created to match physicians and clinics. As the employer, we provide you with direct access to doctors that match the job you are looking to fill. We believe that you should spend less time job sourcing and more time interviewing and onboading the ideal candidate.</p>
            </div>
        </div>
    </div>

</section>
<section class="content-11 bg-apple">
    <div class="container">
        <div class="popbox">
            <span>Sign up and post your first job today</span>
            <a class="open btn btn-embossed btn-wide btn-success" href="javascript:void(0)" id="employee_siginup_lnk">IT'S FREE</a>	
            <div class="collapse">
                <div class="box">
                    <div class="arrow">
                        <div class="arrow-border"></div>
                        <form action="http://gristmill.createsend.com/t/j/s/zlldr/" method="post" id="subForm">
                            <p><small>Please complete the form to get your personalized matches!</small></p>
                            <div class="input">
                                <input type="text" name="cm-name" id="name" placeholder="Name" /></div>
                            <div class="input">
                                <input type="text" name="cm-zlldr-zlldr" id="zlldr-zlldr" placeholder="Email" /></div>
                            <input type="submit" value="Sign Up" /> <a href="#" class="close">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


</section>
<section class="content-26 bg-white">
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <h3>MedMatch for Employers</h3>
                <p class="lead">We provide direct access to top talent, allow you to conduct virtual interviews, and take the guesswork out of hiring through our varification process.</p>
            </div>
        </div>
        <div class="row features">
            <div class="col-sm-3"> 
                <?php echo load_img("hospital.svg", "", "210", "210"); ?>
                <h6>Match</h6>
                MedMatch provides employers with direct access to the nation's 
                top physicians. </div>
            <div class="col-sm-4 col-sm-offset-1"> 
                <?php echo load_img("phone.svg", "", "210", "210"); ?>
                <h6>Connect</h6>
                Get notified when an applicant applies to a job 
                post. Interviews are conducted virtually, 
                streamlining candidate onboarding.</div>
            <div class="col-sm-3 col-sm-offset-1"> 
                <?php echo load_img("doctor.svg", "", "210", "210"); ?>
                <h6>Verify</h6>
                Our verification process ensures that candidates meet your criteria–we're taking the guesswork out of hiring.</div>
        </div>
    </div>
</section>
<section class="content-36 bg-apple">
    <div class="container">
        <h2>Get Started</h2>
        
        <div id="employer-form1">
            <div id="signupForm_btm1_rsp" style="display: none;"></div>
            
            <form id="home-signup-btm-step1" method="post" action="">
            <div class="col-2">
                <label for="signup2-name">Full Name
                    <input placeholder="Please provide your first and last name." class="ng-pristine ng-valid" id="signup2-name" name="signup2-name" required />
                </label>
            </div>
            <div class="col-2">
                <label for="email">EMAIL
                    <input placeholder="Please enter your email address." type="email" class="ng-pristine ng-valid ng-valid-email" id="signup2-email" name="signup2-email" required />
                </label>
            </div>
            <div class="col-3">
                <label for="password">PASSWORD
                    <input type="password" placeholder="Please choose a password." class="ng-pristine ng-valid" id="signup2-password" name="signup2-password" required />
                </label>
            </div>
            <div class="col-3">
                <label for="confirmpassword">CONFIRM PASSWORD
                    <input placeholder="Please confirm your password." type="password" class="ng-pristine ng-valid" id="signup2_confirm_password" name="signup2_confirm_password" required />
                </label>
            </div>
            <div class="col-3">
                <label class="control-label" >Facility Name
                    <input placeholder="What is the facility's name?" class="ng-valid ng-dirty facilities-auto2" id="signup2-facility" name="signup2-facility" required autocomplete="off">
                    <input type="hidden" id="signup1-facility_id_2" name="signup1-facility_id_2" value="0">
                </label>
            </div>
            </form>
        </div>
            
        <div id="employer-form2" style="display: none;">
            <div id="signupForm_btm2_rsp" style="display: none;"></div>
            
            <form id="home-signup-btm-step2" method="post">
            <div class="col-2">
                <label >Name
                       <input type="text" placeholder="Name" class="form-control ng-pristine ng-valid" id="facility_name" name="facility_name" required >
                </label>
            </div>
            <div class="col-2">
                <label >Street Address
                       <input type="text" placeholder="Street Address" class="form-control ng-pristine ng-valid" id="facility_address" name="facility_address" required>
                </label>
            </div>
            <div class="col-2">
                <label >Zip Code
                       <input type="text" placeholder="Zip Code" class="form-control ng-pristine ng-valid" id="facility_zipCode" name="facility_zipCode" required >
                </label>
            </div>
            <div class="col-2">
                <label >City
                       <input type="text" placeholder="City" class="form-control ng-pristine ng-valid" id="facility_city" name="facility_city" required >
                </label>
            </div>
            <div class="col-2">
                <label >Number of Employees
                    <input type="number" min="0" placeholder="Number of Employees" class="form-control intMask ng-pristine ng-valid" id="facility_num_of_employee" name="facility_num_of_employee" required >
                </label>
            </div>
            <div class="col-2">
                <label >Number of Beds
                    <input type="number" min="0" placeholder="Number of Beds" class="form-control intMask ng-pristine ng-valid" id="facility_num_of_bed" name="facility_num_of_bed" required >
                </label>
            </div>
            <hr>
            <h4>Billing Personnel</h4>

            <div style="box-shadow: none; margin-bottom: 5px;" class="col-3">
                <label >Name
                    <input type="text" placeholder="" class="form-control ng-pristine ng-valid" required name="billing_name" id="billing_name" > 
                </label>
            </div>
            <div style="box-shadow: none; margin-bottom: 5px;" class="col-3">
                <label >Phone
                    <input type="text" placeholder="" class="form-control phoneNumberMask ng-pristine ng-valid" required name="billing_phone" id="billing_phone">
                </label>
            </div>
            <div style="box-shadow: none; margin-bottom: 5px;" class="col-3">
                <label >Email
                    <input type="email" placeholder="" class="form-control ng-pristine ng-valid" required name="billing_email" id="billing_email">
                </label>
            </div>	

            </form>
        </div>
        <div class="col-sm-8 col-sm-offset-2">
            <a class="btn btn-embossed btn-info btn-block" href="<?php echo site_url('employee_dashboard'); ?>" id="form12-btn">Complete your free job post!<span class="fui-arrow-right pull-right"></span></a>
        </div>

    </div>
</section>

    