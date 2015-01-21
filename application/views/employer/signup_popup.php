<style>
        
    .typeahead{
        z-index: 999999 !important;
    }
</style>
<div style="padding: 50px; min-height: 400px; background-color: #f7f7f7; width: 500px;" ng-controller="DashboardCtrl" class="container ng-scope">
    <div class="col col-sm-12 " >
    <h2 class="text-center" style="border-bottom: 2px solid black; padding-bottom: 20px">New Employer Account</h2>
    <div id="signup_popup_form_rsp" style="display: none;"></div>
    <br>
    <form class="form-horizontal ng-pristine ng-valid" id="signup_popup_form" method="post" action="<?php echo site_url('employer/signup/2'); ?>">
        <div class="form-group">
          <label class="col-sm-4 control-label">Name</label>
          <div class="col-sm-8">
              <input type="text" class="form-control ng-pristine ng-valid" placeholder="" required id="popup_signup_name" name="signup_name">
          </div>
        </div>
        
        <div class="form-group">
          <label class="col-sm-4 control-label" for="phone">Phone</label>
          <div class="col-sm-8">
            <input type="text" class="form-control ng-pristine ng-valid is_phone_number" placeholder="" required id="popup_signup_phone" name="signup_phone" >
          </div>
        </div>
        
        <div class="form-group">
          <label class="col-sm-4 control-label" for="email">Email</label>
          <div class="col-sm-8">
              <input type="email" class="form-control ng-pristine ng-valid ng-valid-email" placeholder="" required id="popup_signup_email" name="signup_email" >
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-4 control-label" for="password">Choose a Password</label>
          <div class="col-sm-8">
            <input type="password" class="form-control ng-pristine ng-valid" placeholder="Password" required id="popup_password" name="password" >
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-4 control-label" for="confirmpassword">Confirm Password</label>
          <div class="col-sm-8">
            <input type="password" class="form-control ng-pristine ng-valid" placeholder="One More Time Please!" required id="popup_confirm_password" name="confirm_password" >
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-4 control-label" for="facilityName">Facility Name</label>
          <div class="col-sm-8">
            <input type="text" class="form-control ng-pristine ng-valid facilities-auto-popup" required id="popup_signup_facility" name="signup_facility" autocomplete="off">
            <input type="hidden" name="signup_facility_id" id="signup1-facility_id_popup" value="0">
          </div>
        </div>


        <div class="text-center" style="padding-top: 20px; border-top: 2px solid black">
            <button type="submit" class="btn btn-primary btn-lg">Complete your Free job post</button>
          <br>
          <p>Already a member? <a href="<?php echo site_url('employer/signin'); ?>">Log In</a> option</p>
        </div>
      </form>
  </div>
</div>
<script>
    $(".facilities-auto-popup").typeahead({
        source: facilities,
        display: 'name',
        val: 'id',
        itemSelected:function(data,value,text){
            $("#signup1-facility_id_popup").val(value);
        }
    });
    $(".facilities-auto-popup").keyup(function(){
        $("#signup1-facility_id_popup").val('0');
    });
    $("#signup_popup_form").validate({
        rules: {
            popup_confirm_password: {
                equalTo: "#popup_password"
            }
        },
        errorPlacement: function(error, element) {
            element.attr("placeholder",error.text());
        },
        submitHandler: function(form) {
            $("#signup_popup_form_rsp").hide();
            $("#signup_popup_form_rsp").removeClass("error_rsp");
            var email = $("#popup_signup_email").val();
            if( employer_email_exist(email) === true){
                $("#signup_popup_form_rsp").addClass("error_rsp");
                $("#signup_popup_form_rsp").html("Email already Exist").show();
            }
            else{
                form.submit();    
            }
            
            return false;
        }
        
    });
</script>