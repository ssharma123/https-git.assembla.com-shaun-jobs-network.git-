<script>
var facilities = <?php echo $facilities; ?>;
</script>
<div style="padding: 50px; min-height: 400px; background-color: #f7f7f7" ng-controller="DashboardCtrl" class="container ng-scope">
    <div class="col col-sm-8 col-sm-offset-2 ng-hide" ng-show="state === 'facility'">
    <h2 class="text-center" style="border-bottom: 2px solid black; padding-bottom: 20px">Verify Facility Information</h2>
    <?php 
    $class= "";
    $style = "display: none;";
    if($status == "error"){ 
        $class= "error_rsp";
        $style = "display: block;";
    ?>
    <div id="signupForm2_rsp_2" style="" class="<?php echo $class; ?>"><?php echo $msg; ?></div>
    <?php } ?>
    <div id="signupForm2_rsp" style="display: none;"></div>
    <br>
    
    <form class="form-horizontal ng-pristine ng-valid" role="form" id="signupForm2" action="<?php echo site_url('employer/signup/2'); ?>" method="post">
        <input type="hidden" id="form_process" name="form_process" value="yes">
        <input type="hidden" name="signup_name" id="signup_name" value="<?php echo $signup1_name; ?>">
        <input type="hidden" name="signup_email" id="signup_email" value="<?php echo $signup1_email; ?>">
        
        <input type="hidden" name="signup_facility" id="signup_facility" value="<?php echo $signup1_facility; ?>">
        <input type="hidden" name="signup_facility_id" id="signup_facility_id" value="<?php echo $signup1_facility_id; ?>">
        <?php 
        if(isset($no_password) && $no_password == "yes") { ?>
        <input type="hidden" name="no_password" value="yes">
        <div class="form-group">
          <label class="col-sm-4 control-label" for="name">Password</label>
          <div class="col-sm-8">
              <input type="password" class="form-control ng-pristine ng-valid" name="password" id="password" required placeholder="">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-4 control-label" for="name">Confirm Password</label>
          <div class="col-sm-8">
            <input type="password" class="form-control ng-pristine ng-valid" placeholder="" name="confirm_password" id="confirm_password" required>
          </div>
        </div>
        <br><br>
        <?php 
        }else{ ?>
        <input type="hidden" name="no_password" value="no">
        <input type="hidden" name="password" value="<?php echo $password; ?>">
        <?php } ?>
        <div class="form-group">
          <label class="col-sm-4 control-label" for="name">Name</label>
          <div class="col-sm-8">
              <?php if(isset($social_connect) && $social_connect != ""){ ?>
                    <input style="color:#57718b" type="text" class="form-control ng-pristine ng-valid facilities-auto3" name="facility_name" id="facility_name" value="">
                    <input type="hidden" name="signup1-facility_id_3" id="signup1-facility_id_3" value="">
                    <input type="hidden" name="social_connect" id="social_connect" value="true">
              <?php } 
              else{ ?>
                    <input style="color:#57718b" type="text" class="form-control ng-pristine ng-valid" name="facility_name" id="facility_name" readonly="true" value="<?php echo (isset($signup1_facility)) ? $signup1_facility : ''; ?>">
              <?php } ?>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-4 control-label" for="address">Street Address</label>
          <div class="col-sm-8">
              <input type="text" class="form-control ng-pristine ng-valid" placeholder="" name="facility_address" id="facility_address" required>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-4 control-label" for="zipCode">Zip Code</label>
          <div class="col-sm-8">
              <input type="text" class="form-control ng-pristine ng-valid" name="facility_zipCode" id="facility_zipCode" required placeholder="">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-4 control-label" for="city">City</label>
          <div class="col-sm-8">
              <input type="text" class="form-control ng-pristine ng-valid" name="facility_city" id="facility_city" required placeholder="">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-4 control-label" for="city">State</label>
          <div class="col-sm-8">
                <select id="facility_state" name="facility_state" class="form-control ng-pristine ng-valid" required >
                    <option value="">State</option>
                    <?php 
                    $states = get_states( array("country"=>"US") ); 
                    foreach($states as $state){ ?>
                        <option value="<?php echo $state["code"] ?>" ><?php echo $state["name"]; ?></option>
                    <?php } ?>
                </select>
              <!--<input type="text" class="form-control ng-pristine ng-valid" name="facility_state" id="facility_state" required placeholder="">-->
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-4 control-label" for="numEmployees">Number of Employees</label>
          <div class="col-sm-8">
              <input type="number" min="0" class="form-control ng-pristine ng-valid ng-valid-number" name="facility_num_of_employee" id="facility_num_of_employee" required placeholder="">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-4 control-label" for="numBeds">Number of Beds</label>
          <div class="col-sm-8">
              <input type="number" min="0" class="form-control ng-pristine ng-valid ng-valid-number" name="facility_num_of_bed" id="facility_num_of_bed" required placeholder="">
          </div>
        </div>
        <hr>
        <h4>Billing Personnel</h4>
      <div class="form-group">
          <label class="col-sm-4 control-label" for="billingName">Name</label>
          <div class="col-sm-8">
              <input type="text" class="form-control ng-pristine ng-valid" id="billing_name" name="billing_name" required placeholder="">
          </div>
        </div>
      <div class="form-group">
          <label class="col-sm-4 control-label" for="billingPhone">Phone</label>
          <div class="col-sm-8">
              <input type="text" class="form-control ng-pristine ng-valid is_phone_number" id="billing_phone" name="billing_phone" required placeholder="" value="<?php echo (isset($signup_phone)) ? $signup_phone : '' ; ?>">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-4 control-label" for="billingEmail">Email</label>
          <div class="col-sm-8">
            <input type="email" class="form-control ng-pristine ng-valid ng-valid-email" id="billing_email" name="billing_email" required placeholder="">
          </div>
        </div>

        <div class="text-center" style="padding-top: 20px; border-top: 2px solid black">
            <button type="submit" class="btn btn-primary btn-lg">Finish</button>
        </div>
      </form>
  </div>
</div>
