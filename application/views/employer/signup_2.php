<script>
    var facilities = <?php echo $facilities; ?>;
</script>
<div style="padding: 50px; min-height: 400px; background-color: #f7f7f7" ng-controller="DashboardCtrl" class="container ng-scope">
    <div class="col col-sm-8 col-sm-offset-2 ng-hide" ng-show="state === 'facility'">
        <h2 class="text-center" style="border-bottom: 2px solid black; padding-bottom: 20px">Verify Facility Information</h2>
        <?php
        $class = "";
        $style = "display: none;";
        if ($status == "error") {
            $class = "error_rsp";
            $style = "display: block;";
            ?>
            <div id="signupForm2_rsp_2" style="" class="<?php echo $class; ?>"><?php echo $msg; ?></div>
        <?php } ?>
        <div id="signupForm2_rsp" style="display: none;"></div>
        <br>

        <form class="form-horizontal ng-pristine ng-valid" role="form" id="signupForm2" action="<?php echo site_url('employer/signup/2'); ?>" method="post">
            <input type="hidden" id="form_process" name="form_process" value="yes">
            <input type="hidden" name="signup_name" id="signup_name" value="<?php echo $signup1_name; ?>">
            <?php /*
            <input type="hidden" name="signup_email" id="signup_email" value="<?php echo $signup1_email; ?>">
            */ ?>
            <input type="hidden" name="signup_facility" id="signup_facility" value="<?php echo $signup1_facility; ?>">
            <input type="hidden" name="signup_facility_id" id="signup_facility_id" value="<?php echo $signup1_facility_id; ?>">

            <input type="hidden" name="facebook_id" id="facebook_id" value="<?php echo (isset($facebook_id) && $facebook_id != "") ? $facebook_id : ""; ?>" >
            <input type="hidden" name="linkedin_id" id="linkedin_id" value="<?php echo (isset($linkedin_id) && $linkedin_id != "") ? $linkedin_id : ""; ?>" >

            
            <div class="form-group b-form">
                <div class="col-sm-4"></div>
                <div class="col-sm-8">
                    <label class="col-sm-4 control-label" for="name">Name</label>
                    <?php if (isset($social_connect) && $social_connect != "") { ?>
                        <input style="color:#57718b" type="text" class="form-control ng-pristine ng-valid facilities-auto3" name="facility_name" id="facility_name" value="" required>
                        <input type="hidden" name="signup1-facility_id_3" id="signup1-facility_id_3" value="">
                        <input type="hidden" name="social_connect" id="social_connect" value="true">
                    <?php } else {
                        ?>
                        <input style="color:#57718b" type="text" class="form-control ng-pristine ng-valid" name="facility_name" id="facility_name" readonly="true" value="<?php echo (isset($signup1_facility)) ? $signup1_facility : ''; ?>">
                    <?php } ?>
                </div>
            </div>
            <div class="form-group b-form b-street">
                <div class="col-sm-4"></div>

                <div class="col-sm-8">
                    <label class="col-sm-12 control-label" for="address"><a href="#">Facility &nbsp;</a>Street Address</label>
                    <input type="text" class="form-control ng-pristine ng-valid" placeholder="Address 1" name="facility_address" id="facility_address" required>
                    <input type="text" class="form-control ng-pristine ng-valid" placeholder="Address 2" name="facility_address_2" id="facility_address_2" >
                </div>
            </div>
            <div class="form-group b-form">
                <div class="col-sm-4"></div>
                <div class="col-sm-4">
                    <label class="col-sm-8 control-label" for="facility_zipCode">Zip Code</label>
                    <input type="number" class="form-control ng-pristine ng-valid" name="facility_zipCode" id="facility_zipCode" required min="1" max="99999"  placeholder="">
                </div>
                
                <!--state new input tag-->
                 <div class="col-sm-4">
                    <label class="col-sm-4 control-label" for="city">State</label>
                    <input type="text" class="form-control ng-pristine ng-valid" name="facility_state" id="facility_state" required placeholder="">
                </div>
               
            </div>
            <div class="form-group b-form">
                <div class="col-sm-4"></div>
                <div class="col-sm-4">
                    <label class="col-sm-8 control-label" for="city">City</label>
                    <input type="text" class="form-control ng-pristine ng-valid" name="facility_city" id="facility_city" required placeholder="">
                </div>
                 <div class="col-sm-4">
                    <label class="col-sm-12 control-label" for="closest_city">Closest Metropolitan City</label>
                    <input type="text" class="form-control ng-pristine ng-valid" name="closest_city" id="closest_city" required placeholder="">
                </div>
               
            </div>
            <div class="form-group b-form">
                <div class="col-sm-4"></div>
                
            </div>
            <div class="form-group b-form">
                <div class="col-sm-4"></div>
                <div class="col-sm-4">
                    <label class="col-sm-12 control-label" for="numEmployees">Number of Employees</label>
                    <input type="number" min="0" class="form-control ng-pristine ng-valid ng-valid-number" name="facility_num_of_employee" id="facility_num_of_employee" required placeholder="">
                </div>
                <div class="col-sm-4">
                    <label class="col-sm-12 control-label" for="numBeds">Number of Beds</label>
                    <input type="number" min="0" class="form-control ng-pristine ng-valid ng-valid-number" name="facility_num_of_bed" id="facility_num_of_bed" required placeholder="">
                </div>
            </div>
            <!--        <div class="form-group b-form">
                         <div class="col-sm-4"></div>
                      
                      <div class="col-sm-4">
                          <label class="col-sm-4 control-label" for="numBeds">Number of Beds</label>
                          <input type="number" min="0" class="form-control ng-pristine ng-valid ng-valid-number" name="facility_num_of_bed" id="facility_num_of_bed" required placeholder="">
                      </div>
                    </div>-->
            <hr>
            <h4>Management or Billing Contact</h4>
            <div class="form-group b-form">
                <?php
                $f_name = "";
                $l_name = "";
                if(isset($signup1_name) && $signup1_name != ""){
                    $name = explode(" ", $signup1_name);
                    $f_name = $name[0];
                    $l_name = isset($name[1]) ? $name[1] : "" ;
                }
                ?>
                <div class="col-sm-4"></div>
                <label class="col-sm-8 control-label" for="billingName">Name</label>
                <div class="col-sm-4"></div>
                <div class="col-sm-4">
                    
                    <input type="text" placeholder="First" class="form-control ng-pristine ng-valid" id="billing_name" name="billing_name_first" required placeholder="" value="<?php echo $f_name; ?>">

                </div>
                <div class="col-sm-4">
                    <!--<label class="col-sm-4 control-label" for="billingName"></label>-->
                    <input type="text" placeholder="Last" class="form-control ng-pristine ng-valid" id="billing_name" name="billing_name_last" required placeholder="" value="<?php echo $l_name; ?>">
                </div>

            </div>
            <div class="form-group b-form">
                <div class="col-sm-4"></div>
                <div class="col-sm-4">
                    <label class="col-sm-8 control-label" for="billingPhone">Phone</label>
                    <input type="text" class="form-control ng-pristine ng-valid is_phone_number" id="billing_phone" name="billing_phone" required placeholder="" value="<?php echo (isset($signup_phone)) ? $signup_phone : ''; ?>">
                </div>
                <div class="col-sm-4">
                    <label class="col-sm-4 control-label" for="billingEmail">Email</label>
                    <input type="email" class="form-control ng-pristine ng-valid ng-valid-email" id="billing_email" name="billing_email" required placeholder="">
                </div>
            </div>
             <hr>
            <h4>Create Free Contact</h4>
            <div class="form-group b-form">
                <div class="col-sm-4"></div>
                <div class="col-sm-4">
                    <label class="col-sm-12 control-label" for="billingPhone">E-mail address(work)</label>
                    <input type="email" class="form-control ng-pristine ng-valid ng-valid-email" id="signup_email" name="signup_email" required placeholder="" value="<?php echo (isset($signup1_email) && $signup1_email != "" ) ? $signup1_email : ""; ?>" >
                </div>
                <div class="col-sm-4">
                    <label class="col-sm-12 control-label" for="billingEmail">Verify Email</label>
                    <input type="email" class="form-control ng-pristine ng-valid ng-valid-email" id="signup_email_verify" name="signup_email_verify" required placeholder="">
                </div>
            </div>
            
            <?php if (isset($no_password) && $no_password == "yes") { ?>
                <input type="hidden" name="no_password" value="yes">
                <div class="form-group b-form b-last">
                    <div class="col-sm-4"></div>
                    <div class="col-sm-4">
                        <label class="col-sm-12 control-label" for="billingPhone">Create Password</label>
                        <input type="password" class="form-control ng-pristine ng-valid ng-valid-email" id="password" name="password" required placeholder="">
                    </div>

                    <div class="col-sm-4">
                        <label class="col-sm-12 control-label" for="billingEmail">Reenter Password</label>
                        <input type="password" class="form-control ng-pristine ng-valid ng-valid-email" id="confirm_password" name="confirm_password" required placeholder="">
                    </div>
                </div>
            <?php } else {
                ?>
                <input type="hidden" name="no_password" value="no">
                <input type="hidden" name="password" value="<?php echo $password; ?>">
                <br>
                <br>
            <?php } ?>
            
                
                
            <div class="col-sm-5"></div>
            <div class="text-center btn-group b-btn col-sm-7" >
                <button type="submit" class="btn btn-primary btn-lg ">Complete Your free job post</button>
                <a href="#" class="glyphicon btn btn-primary glyphicon-chevron-right"></a> 
            </div>
        </form>
    </div>
</div>
<script>
    $("#facility_zipCode").keyup(function() {
        var val = $("#facility_zipCode").val();
        var length = $("#facility_zipCode").val().length;
        if (length > 5) {
            $("#facility_zipCode").val(val.substring(0, 5));
        }
    });
    
    $('#facility_address').keydown(function (e) {
        if (e.which == 13 ) {
            return false;
        }
    });
</script>
<script>
    function initialize(){
        var address = /** @type {HTMLInputElement} */(
                document.getElementById('facility_address'));
        var my_address = new google.maps.places.Autocomplete(address);
        
        google.maps.event.addListener(my_address, 'place_changed', function() {
            var place = my_address.getPlace();
            
            // if no location is found
            if (!place.geometry) {
                return;
            }
            $("#city").val("");
            $("#State").val("");
            $("#txtZip").val("");
            
            var $closest_city = $("#closest_city");
            var $city = $("#facility_city");
            var $state = $("#facility_state");
            var $zipcode = $("#facility_zipCode");
            var country_long_name = '';
            var country_short_name = '';
            
            for(var i=0; i<place.address_components.length; i++){
                var address_component = place.address_components[i];
                var ty = address_component.types;

                for (var k = 0; k < ty.length; k++) {
                    if (ty[k] === 'locality') {
                        $closest_city.val(address_component.long_name)
                    } 
                    if (ty[k] === 'administrative_area_level_2') {
                        $city.val(address_component.long_name)
                    } 
                    else if (ty[k] === 'postal_town' || ty[k] === "administrative_area_level_1") {
                        $state.val(address_component.short_name);
                    } else if (ty[k] === 'postal_code') {
                        $zipcode.val(address_component.short_name);
                    } else if(ty[k] === 'country'){
                        country_long_name = address_component.long_name;
                        country_short_name = address_component.short_name;
                    }
                }
            }
            
            var address = $("#Address").val();
            var city = $("#city").val();
            var state = $("#State").val();
//            var new_address = address.replace(city,"");
//            new_address = new_address.replace(state,"");
//            
//            new_address = new_address.replace(country_long_name,"");
//            new_address = new_address.replace(country_short_name,"");
//            new_address = $.trim(new_address);
//            
//            
//            new_address = new_address.replace(/,/g, '');
//            new_address = new_address.replace(/ +/g," ");
//            $("#Address").val(new_address);
            
             
        
         });
    }
    google.maps.event.addDomListener(window, 'load', initialize);
</script>