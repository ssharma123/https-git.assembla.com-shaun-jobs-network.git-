<div id="" class="ng-scope">
    <div class="bg_section-11">
        <div class="section-one">
            <hr size="1" width="20%" text-align="center" color="#000000">
            <h1>Top Matches</h1>

            <div class="clear"></div>

        </div>
    </div>
    <div class="wrap">
        <div class="main">
            <div class="content" style="position: relative;">

            </div>
        </div>
    </div>
</div>

<div class="col col-sm-8 col-sm-offset-2 ng-hide" style="margin-top: 25px;">

    
    <h2 class="text-center">Sign up for a new account</h2>
    <hr>
    <?php 
    $class= "";
    $style = "display: none;";
    if($status == "error"){ 
        $class= "error_rsp";
        $style = "display: block;";
    ?>
    <?php } ?>
    <div id="jobseeker_signup_rsp" style="<?php echo $class; ?>" class="<?php echo $class; ?>"><?php echo $msg; ?></div>
    <br>
    <!-- Signup -->
    <form class="form-horizontal" id="job_seeker_signup" autocomplete="off" method="post" action="<?php echo site_url("job_seeker/signup/"); ?>">
        
        
        <div class="form-group">
            <label class="col-sm-4 control-label" for="first_name">First Name</label>
            <div class="col-sm-8">
                <input type="text" class="form-control " id="first_name" name="first_name" placeholder="First Name" required value="<?php echo isset($first_name) ? $first_name : '' ; ?>" >
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label" for="last_name">Last Name</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name" required value="<?php echo isset($last_name) ? $last_name : '' ; ?>" >
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-4 control-label" for="email">Email</label>
            <div class="col-sm-8">
                <input type="email" class="form-control" id="email" name="email" placeholder="Email" required value="<?php echo isset($email) ? $email : '' ; ?>" >
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-4 control-label" for="phone">Phone</label>
            <div class="col-sm-8">
                <input type="text" class="form-control is_phone_number" id="phone" name="phone" placeholder="Phone" value="<?php echo isset($phone) ? $phone : '' ; ?>" required>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-4 control-label" for="password">Choose a Password</label>
            <div class="col-sm-8">
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="<?php echo isset($password) ? $password : '' ; ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label" for="confirm_password">Confirm Password</label>
            <div class="col-sm-8">
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="One More Time Please!" value="<?php echo isset($confirm_password) ? $confirm_password : '' ; ?>">
            </div>
        </div>
        <hr>
        <div class="text-center">
            <input type="submit" class="btn btn-primary btn-lg" style="width: 200px" value="Continue">
            <br><br>
        </div>
    </form>
    
    
</div>
<div style="clear: both;"></div>