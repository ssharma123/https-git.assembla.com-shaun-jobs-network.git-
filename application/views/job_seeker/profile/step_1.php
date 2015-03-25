 
<div class="col-sm-10 col-sm-offset-1 text-center" >
    <form id="form_profileStep1" method="post">
        <p>
            <?php echo load_img("first-step.png"); ?>
        </p>
        
        <h3 style="font-size: 22px;">Upload your Resume and Auto Fill your profile fields</h3>
        <div id="rsp_resume" style="display: none;"></div>
        <div style="height: 100px; text-align: center;" class="text-center">
            <input style="display: inline; margin: 20px 0 0 0;" type="file" id="resume" name="resume[]" onchange="upload_resume();">
            <div id="save_file_busy" style="display: none;"><?php echo load_img("busy.gif"); ?></div>
        </div>
        
        <h3>Let's create your Profile</h3>
        <div style="min-height: 300px;">
            <fieldset style="float: none; margin: 0 auto; padding: 0; width: 480px;">

                <div class="left_col">
                    <input type="text" maxlength="50" placeholder="First Name" id="first_name" name="first_name" class="ng-pristine ng-valid form-control" required value="<?php echo isset($jobseeker['first_name']) ? $jobseeker['first_name'] : "" ;  ?>" >
                </div>

                <div class="right_col">
                    <input type="text" maxlength="50" placeholder="Last Name" id="last_name" name="last_name" class="ng-pristine ng-valid form-control" required value="<?php echo isset($jobseeker['last_name']) ? $jobseeker['last_name'] : "" ;  ?>" >
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
                    <input type="text" maxlength="50" placeholder="Address" id="address" name="address" class="ng-pristine ng-valid form-control" required value="<?php echo isset($jobseeker['address']) ? $jobseeker['address'] : "" ;  ?>" >
                </div>
                <div class="right_col">
                    <input type="text" placeholder="Apt / Suite #" style="" id="apt" name="apt" class="ng-pristine ng-valid form-control" required value="<?php echo isset($jobseeker['apt']) ? $jobseeker['apt'] : "" ;  ?>" >
                </div>

                <div class="left_col">
                    <input type="text" maxlength="50" placeholder="City" id="city" name="city" class="ng-pristine ng-valid form-control" required value="<?php echo isset($jobseeker['city']) ? $jobseeker['city'] : "" ;  ?>">
                </div>
                <div class="right_col">
                    <select style="width: 50%; float: left;" type="text" id="state" name="state" class="ng-pristine ng-valid form-control" required >
                        <option value="">State</option>
                        <?php 
                        $states = get_states( array("country"=>"US") ); 
                        foreach($states as $state){ 
                            $selected = (isset($state["code"]) && $state["code"] == $jobseeker['state'] ) ? ' selected="selected" ' : "" ;
                            ?>
                            <option value="<?php echo $state["code"] ?>" <?php echo $selected; ?> ><?php echo $state["code"] ?></option>
                        <?php } ?>
                    </select>
                    <input maxlength="6" type="text" style="width: 35%; padding: 5px; margin: 0px 12px; float: left;" placeholder="Zip" id="zip" name="zip" class="ng-pristine ng-valid form-control" required value="<?php echo isset($jobseeker['zip']) ? $jobseeker['zip'] : "" ;  ?>">
                </div>
                <div class="left_col">
                    <input type="text" class="is_phone_number ng-pristine ng-valid form-control" placeholder="Phone Number" id="phone" name="phone" required value="<?php echo isset($jobseeker['phone']) ? $jobseeker['phone'] : "" ;  ?>">
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
<?php echo load_js("ajaxfileupload.js"); ?>
<script>
    
    
    
    function upload_resume() {
        $("#save_file_busy").show();
        
            $("#rsp_resume").html('').hide();
            $("#rsp_resume").removeClass("error_rsp");
                    
            var file_name = "";
            $.ajaxFileUpload({
                url: SITE_URL + "job_seeker_dashboard/upload_resume_to_sajari",
                secureuri: false,
                fileElementId: 'resume',
                dataType: 'JSON',
                async: false,
                data: { jobseeker_id : '<?php echo $jobseeker['id'] ?>' },
                success: function(rsp)
                {
                    console.log(rsp);
                    rsp_json = $.parseJSON(rsp);
                    console.log(rsp_json);
                    if (rsp_json.status === "ok") {
                       // everything is ok   
                       
                    }
                    else{
                        $("#rsp_resume").html(rsp_json.msg).show();
                        $("#rsp_resume").addClass("error_rsp");
                    }
                    
                    $("#save_file_busy").hide();
                }
            });
        

    }
</script>