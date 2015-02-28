 
<div class="col-sm-10 col-sm-offset-1 text-center" >
    <form id="form_profileStep2" method="post">
        <p>
            <?php echo load_img("second-step.png"); ?>
        </p>
        <h3>Tell us about your profession</h3>
        <div style="min-height: 300px;">
            <fieldset style="float: none; margin: 0 auto; padding: 0; width: 480px;">

                 

                <div class="left_col">
                    <select class="ng-pristine ng-valid form-control" id="" name="" disabled >
                        <option value=""></option>
                    </select>
                </div>
                <div class="right_col" >
                    <select class="ng-pristine ng-valid form-control" id="experince_level" name="experince_level" required >
                        <option class="" value="">Experience Level</option>
                        <?php
                        $selected = (isset($jobseeker['experince_level']) && $jobseeker['experince_level'] == "medical_school" ) ? ' selected="selected" ' : "" ;
                        ?>
                        <option value="medical_school" <?php echo $selected; ?> >Medical School</option>
                        <?php
                        $selected = (isset($jobseeker['experince_level']) && $jobseeker['experince_level'] == "residency" ) ? ' selected="selected" ' : "" ;
                        ?>
                        <option value="residency" <?php echo $selected; ?> >Residency</option>
                        <?php
                        $selected = (isset($jobseeker['experince_level']) && $jobseeker['experince_level'] == "fellowship" ) ? ' selected="selected" ' : "" ;
                        ?>
                        <option value="fellowship" <?php echo $selected; ?> >Fellowship</option>
                        <?php
                        $selected = (isset($jobseeker['experince_level']) && $jobseeker['experince_level'] == "practicing" ) ? ' selected="selected" ' : "" ;
                        ?>
                        <option value="practicing" <?php echo $selected; ?> >Practicing</option>
                    </select>
                </div>
                
                <div class="left_col">
                    <select id="specialty" name="specialty" class="ng-pristine ng-valid parent_speciality form-control" required>
                        <option value="">Categories</option>
                        <?php 
                        foreach($specialties as $val){ 
                            $selected = (isset($jobseeker['specialty']) && $jobseeker['specialty'] == $val['id'] ) ? ' selected="selected" ' : "" ;
                            ?>
                            <option value="<?php echo $val['id']; ?>" <?php echo $selected; ?> ><?php echo strip_slashes($val['name']); ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="right_col">
                    <select id="sub_specialty" name="sub_specialty" class="ng-pristine ng-valid form-control sub_speciality" required>
                        <option value="">Sub Categories</option>
                        <?php 
                        if(isset($sub_specialty) && is_array($sub_specialty) && (isset($jobseeker["specialty"]) && $jobseeker["specialty"] != 0) ){ 
                            foreach($sub_specialty as $sub_spec) { 
                            $selected = (isset($jobseeker['sub_specialty']) && $jobseeker['sub_specialty'] == $sub_spec['id'] ) ? ' selected="selected" ' : "" ;
                            ?>
                            <option value="<?php echo $sub_spec['id']; ?>" <?php echo $selected; ?> ><?php echo strip_slashes($sub_spec['name']); ?></option>    
                            <?php } 
                        }
                        else{
                        ?>
<!--                        <option value=""></option>-->
                        <?php } ?>
                    </select>
                </div>
                <div class="left_col">
                    <select class="ng-pristine ng-valid form-control" id="board_status" name="board_status" required >
                        <option value="" class="">Board Status</option>
                        <?php
                        $selected = (isset($jobseeker['board_status']) && $jobseeker['board_status'] == "eligible" ) ? ' selected="selected" ' : "" ;
                        ?>
                        <option value="eligible" <?php echo $selected; ?> >Eligible</option>
                        <?php
                        $selected = (isset($jobseeker['board_status']) && $jobseeker['board_status'] == "active" ) ? ' selected="selected" ' : "" ;
                        ?>
                        <option value="active" <?php echo $selected; ?> >Active</option>
                    </select>
                </div>
                <div class="right_col">
                    <select class="ng-pristine ng-valid form-control" required id="degree" name="degree" >
                        <option value="" class="">Degree</option>
                        <?php
                        $selected = (isset($jobseeker['degree']) && $jobseeker['degree'] == "D.O" ) ? ' selected="selected" ' : "" ;
                        ?>
                        <option <?php echo $selected; ?> value="D.O">D.O.</option>
                        <?php
                        $selected = (isset($jobseeker['degree']) && $jobseeker['degree'] == "M.D" ) ? ' selected="selected" ' : "" ;
                        ?>
                        <option <?php echo $selected; ?> value="M.D">M.D.</option>
                    </select>
                </div>
                <div class="left_col">
                    <select class="ng-pristine ng-valid form-control" id="resident_status" name="resident_status" required >
                        <option class="" value="">Resident Status</option>
                        <?php
                        $selected = (isset($jobseeker['resident_status']) && $jobseeker['resident_status'] == "citizen" ) ? ' selected="selected" ' : "" ;
                        ?>
                        <option value="citizen" <?php echo $selected; ?> >US Citizen</option>
                        <?php
                        $selected = (isset($jobseeker['resident_status']) && $jobseeker['resident_status'] == "permanent_resident" ) ? ' selected="selected" ' : "" ;
                        ?>
                        <option value="permanent_resident" <?php echo $selected; ?> >Permanent Resident</option>
                        <?php
                        $selected = (isset($jobseeker['resident_status']) && $jobseeker['resident_status'] == "h1_visa" ) ? ' selected="selected" ' : "" ;
                        ?>
                        <option value="h1_visa" <?php echo $selected; ?> >H1 Visa</option>
                        <?php
                        $selected = (isset($jobseeker['resident_status']) && $jobseeker['resident_status'] == "j1_visa" ) ? ' selected="selected" ' : "" ;
                        ?>
                        <option value="j1_visa" <?php echo $selected; ?> >J1 Visa</option>
                    </select>
                </div>
                <div class="right_col">
                    
                </div>
                <br>
                <br>
                <div style="clear: both;"></div>
                <div class="p_line_main">
                    <div class="search">National Physician Identifier</div>
                </div>
                <div style="text-align: center">
                    <span class="greyText">You will not have access to directly engage with perspective matches without this information</span>
                </div>
                <div style="clear: both;"></div>
                <br>
                <br>
                <div class="left_col">
                     <input type="text" class="ng-pristine ng-valid form-control" placeholder="NPI #" id="npi_number" name="npi_number" required value="<?php echo isset($jobseeker['npi_number']) ? $jobseeker['npi_number'] : "" ;  ?>">
                </div>
                <div class="right_col">
                    <span style="width: 40%; font-size: 11px; vertical-align: -10px; display: inline-block;">
                        <sup>*</sup> Please provide this so we can verify that you are a real physician.
                    </span>
                </div>

                 
            </fieldset>
            
            
        </div>
        <div style="text-align: center; margin-top: 20px;">
            <a href="javascript:void(0)" class="profile-back" data-backTo="1" >Back</a>&nbsp;
            <a href="javascript:void(0)" class="btn btn-lg btn-primary profile_steps_continue" data-step="continue-step2" data-stepTo="3" data-formValidate="form_profileStep2">Continue</a>
        </div>
    </form>
</div>