 
<div class="col-sm-10 col-sm-offset-1 text-center" >
    <form id="form_profileStep1" method="post">
        <p>
            <?php echo load_img("first-step.png"); ?>
        </p>
        <?php /*
        <h3 style="font-size: 22px;">Upload your Resume and Auto Fill your profile fields</h3>
        <div id="rsp_resume" style="display: none;"></div>
        <div style="height: 100px; text-align: center;" class="text-center">
            <input style="display: inline; margin: 20px 0 0 0;" type="file" id="resume" name="resume[]" onchange="upload_resume();">
            <div id="save_file_busy" style="display: none;"><?php echo load_img("busy.gif"); ?></div>
        </div>
        */ ?>
        <h3>Let's create your Profile</h3>
        <div style="min-height: 300px;">
            <fieldset style="float: none; margin: 0 auto; padding: 0; width: 480px;">

                <div class="left_col">
                    <?php
                    
                    $first_name_val = "" ;
                    if(isset($resume['firstname']) && $resume['firstname'] != ""){
                        $first_name_val = $resume['firstname'];
                    }
                    else if(isset($jobseeker['first_name']) && $jobseeker['first_name'] != "" ){
                        $first_name_val = $jobseeker['first_name'];
                    }
                    
                    ?>
                    <input type="text" maxlength="50" placeholder="First Name" id="first_name" name="first_name" class="ng-pristine ng-valid form-control" required value="<?php echo $first_name_val;  ?>" >
                </div>

                <div class="right_col">
                    <?php
                    
                    $last_name_val = "" ;
                    if(isset($resume['lastname']) && $resume['lastname'] != ""){
                        $last_name_val = $resume['lastname'];
                    }
                    else if(isset($jobseeker['first_name']) && $jobseeker['first_name'] != "" ){
                        $last_name_val = $jobseeker['first_name'];
                    }
                    
                    ?>
                    <input type="text" maxlength="50" placeholder="Last Name" id="last_name" name="last_name" class="ng-pristine ng-valid form-control" required value="<?php echo $last_name_val;  ?>" >
                </div>

                <div class="left_col">
                    <input type="text" maxlength="50" placeholder="Middle Name" id="mid_name" name="mid_name"  class="ng-pristine ng-valid form-control" value="<?php echo isset($jobseeker['mid_name']) ? $jobseeker['mid_name'] : "" ;  ?>" >
                </div>
                <div class="right_col">
                    <select class="ng-pristine ng-valid form-control" id="prefix" name="prefix" >
                        <option value="" class="">Prefix</option>
                        <?php
                        $selected = (isset($jobseeker['prefix']) && $jobseeker['prefix'] == "Dr" ) ? ' selected="selected" ' : "" ;
                        ?>
                        <option value="Dr" <?php echo $selected; ?> >Dr.</option>
                        <?php
                        $selected = (isset($jobseeker['prefix']) && $jobseeker['prefix'] == "Mr" ) ? ' selected="selected" ' : "" ;
                        ?>
                        <option value="Mr" <?php echo $selected; ?> >Mr.</option>
                        <?php
                        $selected = (isset($jobseeker['prefix']) && $jobseeker['prefix'] == "Mrs" ) ? ' selected="selected" ' : "" ;
                        ?>
                        <option value="Mrs" <?php echo $selected; ?> >Mrs.</option>
                        <?php
                        $selected = (isset($jobseeker['prefix']) && $jobseeker['prefix'] == "Ms" ) ? ' selected="selected" ' : "" ;
                        ?>
                        <option value="Ms" <?php echo $selected; ?> >Ms.</option>
                    </select>
                </div>

                <div class="left_col">
                    <input type="text" placeholder="Suffix" class="ng-pristine ng-valid form-control" id="suffix" name="suffix" value="<?php echo isset($jobseeker['suffix']) ? $jobseeker['suffix'] : "" ;  ?>" >
                </div>
                <div class="right_col">
                    <input type="text" placeholder="Prof. Suffix" id="prof_suffix" name="prof_suffix" class="ng-pristine ng-valid form-control" required value="<?php echo isset($jobseeker['prof_suffix']) ? $jobseeker['prof_suffix'] : "" ;  ?>" >
                </div>

                <div class="left_col">
                    <?php
                    $address_val = "" ;
                    if(isset($resume['address']) && $resume['address'] != ""){
                        $address_val = $resume['address'];
                    }
                    else if(isset($jobseeker['address']) && $jobseeker['address'] != "" ){
                        $address_val = $jobseeker['address'];
                    }
                    ?>
                    <input type="text" maxlength="50" placeholder="Address" id="address" name="address" class="ng-pristine ng-valid form-control" required value="<?php echo $address_val;  ?>" >
                </div>
                <div class="right_col">
                    <input type="text" placeholder="Apt / Suite #" style="" id="apt" name="apt" class="ng-pristine ng-valid form-control" required value="<?php echo isset($jobseeker['apt']) ? $jobseeker['apt'] : "" ;  ?>" >
                </div>

                <div class="left_col">
                    <?php
                    $city_val = "" ;
                    if(isset($resume['city']) && $resume['city'] != ""){
                        $city_val = $resume['city'];
                    }
                    else if(isset($jobseeker['city']) && $jobseeker['city'] != "" ){
                        $city_val = $jobseeker['city'];
                    }
                    ?>
                    <input type="text" maxlength="50" placeholder="City" id="city" name="city" class="ng-pristine ng-valid form-control" required value="<?php echo $city_val;  ?>">
                </div>
                <div class="right_col">
                    <select style="width: 50%; float: left;" type="text" id="state" name="state" class="ng-pristine ng-valid form-control" required >
                        <option value="">State</option>
                        <?php 
                        $states = get_states( array("country"=>"US") ); 
                        foreach($states as $state){ 
                            
                            $state_val = "" ;
                            if(isset($resume['state']) && $resume['state'] != ""){
                                $state_val = $resume['state'];
                            }
                            else if(isset($jobseeker['state']) && $jobseeker['state'] != "" ){
                                $state_val = $jobseeker['state'];
                            }
                            $selected = (isset($state["code"]) && $state["code"] == $state_val ) ? ' selected="selected" ' : "" ;
                            ?>
                            <option value="<?php echo $state["code"] ?>" <?php echo $selected; ?> ><?php echo $state["code"] ?></option>
                        <?php } ?>
                    </select>
                    <?php
                    $zip_val = "" ;
                    if(isset($resume['zip_code']) && $resume['zip_code'] != ""){
                        $zip_val = $resume['zip_code'];
                    }
                    else if(isset($jobseeker['zip']) && $jobseeker['zip'] != "" ){
                        $zip_val = $jobseeker['zip'];
                    }
                    ?>
                    <input maxlength="6" type="text" style="width: 35%; padding: 5px; margin: 0px 12px; float: left;" placeholder="Zip" id="zip" name="zip" class="ng-pristine ng-valid form-control" required value="<?php echo $zip_val;  ?>">
                </div>
                <div class="left_col">
                    <?php
                    $phone_val = "" ;
                    if(isset($resume['exPhone']) && $resume['exPhone'] != ""){
                        $phone_val = $resume['exPhone'];
                    }
                    else if(isset($jobseeker['phone']) && $jobseeker['phone'] != "" ){
                        $phone_val = $jobseeker['phone'];
                    }
                    ?>
                    <input type="text" class="is_phone_number ng-pristine ng-valid form-control" placeholder="Phone Number" id="phone" name="phone" required value="<?php echo $phone_val;  ?>">
                </div>
                <div class="right_col">
                    <input type="text" class="is_phone_number ng-pristine ng-valid form-control" placeholder="Alt. Phone Number" id="alt_phone" name="alt_phone" value="<?php echo isset($jobseeker['alt_phone']) ? $jobseeker['alt_phone'] : "" ;  ?>">
                </div>
            </fieldset>
        </div>
        <div style="text-align: center; margin-top: 20px;">
            <a href="javascript:void(0)" class="btn btn-lg btn-primary profile_steps_continue" data-step="continue-step1" data-stepTo="2" data-formValidate="form_profileStep1">Continue</a>
        </div>
    </form>
</div>
<script>
    $(".is_phone_number").keyup();
</script>