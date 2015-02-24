<style>
    .ng-hide,.hidden{
        display: none;
    }
    .form_btn_bar{
        margin: 20px;
        text-align: right;
    }
    .edit_link{
        cursor: pointer;
        float: right;
    }
    .profile_heading1{
        text-align: left; font-size: 40px; padding-left: 20px; padding-top: 2px; margin-top: 5px; margin-bottom: 2px;
    }
    .contact_info_text{
        padding-left: 20px; font-size: 16px;
    }
    .contact_info_text span{
        color: #2A802A;
    }
    .profile_heading2{
        text-align: left; padding-left: 20px;
    }
    .space-row-10{
        margin-top: 20px;
        margin-bottom: 20px;
    }
    .padding_5{
        padding: 15px;
    }
    #license_list,#license_list_edit{
        margin-bottom: 10px;
    }
    #certification_list,certification_list_edit{
        margin-bottom: 10px;
    }
</style>
<div class="row-wrapper">
    <div class="col col-sm-7">
        <!--Contact Section-->
        <div id="contactC">
            <div id="contact_info_block">
                <div style="float: left; width: 85%; padding-left: 10px;">
                    <h1  class="profile_heading1"><?php echo $jobseeker['first_name']." ".$jobseeker['last_name']; ?></h1>
                    <div class="contact_info_text">
                        <span ><?php echo $jobseeker['address']; ?></span> <?php echo $jobseeker['city'].",".$jobseeker['state']; ?>
                    </div>
                </div>
                <div>
                    <a id="contact_info_edit_link" class="edit_link"><span class="glyphicon glyphicon-pencil"></span> Edit</a>
                </div>
                <div class="clearfix"></div>	
            </div>
            <div id="contact_info_edit" style="display: none;">
                <div>
                    <form method="post" id="contact_info_form">
                    <fieldset>
                        <div class="left_col">
                            <input type="text" maxlength="50" placeholder="First Name" id="first_name" name="first_name" class=" form-control" required value="<?php echo isset($jobseeker['first_name']) ? $jobseeker['first_name'] : "" ;  ?>" >
                        </div>

                        <div class="right_col">
                            <input type="text" maxlength="50" placeholder="Last Name" id="last_name" name="last_name" class=" form-control" required value="<?php echo isset($jobseeker['last_name']) ? $jobseeker['last_name'] : "" ;  ?>" >
                        </div>

                        <div class="left_col">
                            <input type="text" maxlength="50" placeholder="Address" id="address" name="address" class=" form-control" required value="<?php echo isset($jobseeker['address']) ? $jobseeker['address'] : "" ;  ?>" >
                        </div>
                        <div class="right_col">
                            <input type="text" placeholder="Apt / Suite #" style="" id="apt" name="apt" class=" form-control" required value="<?php echo isset($jobseeker['apt']) ? $jobseeker['apt'] : "" ;  ?>" >
                        </div>

                        <div class="left_col">
                            <input type="text" maxlength="50" placeholder="City" id="city" name="city" class=" form-control" required value="<?php echo isset($jobseeker['city']) ? $jobseeker['city'] : "" ;  ?>">
                        </div>
                        <div class="right_col">
                            <select style="width: 50%; float: left;" type="text" id="state" name="state" class=" form-control" required >
                                <option value="">State</option>
                                <?php 
                                $states = get_states( array("country"=>"US") ); 
                                foreach($states as $state){ 
                                    $selected = (isset($state["code"]) && $state["code"] == $jobseeker['state'] ) ? ' selected="selected" ' : "" ;
                                    ?>
                                    <option value="<?php echo $state["code"] ?>" <?php echo $selected; ?> ><?php echo $state["code"] ?></option>
                                <?php } ?>
                            </select>
                            <input type="text" style="width: 35%; padding: 5px; margin: 0px 12px; float: left;" maxlength="50" placeholder="Zip" id="zip" name="zip" class=" form-control" required value="<?php echo isset($jobseeker['zip']) ? $jobseeker['zip'] : "" ;  ?>">
                        </div>
                        <div class="left_col">
                            <input type="text" class="is_phone_number  form-control" placeholder="Phone Number" id="phone" name="phone" required value="<?php echo isset($jobseeker['phone']) ? $jobseeker['phone'] : "" ;  ?>">
                        </div>
                        <div class="right_col">
                            <input type="text" class="is_phone_number  form-control" placeholder="Alt. Phone Number" id="alt_phone" name="alt_phone" required  value="<?php echo isset($jobseeker['alt_phone']) ? $jobseeker['alt_phone'] : "" ;  ?>">
                        </div>
                    </fieldset>
                    </form>
                </div>
                <div class="form_btn_bar">
                    <a id="contact_info_cancel" href="javascript:void(0)" class="btn btn-warning">Cancel</a>
                    <a id="contact_info_save" href="javascript:void(0)" class="btn btn-primary">Save</a>
                </div>
                <div class="clearfix"></div>	
            </div>
        </div>
        <!--Profession Section-->
        <div id="professionC">
            <div id="profession_block">
                <div style="float: left; width: 85%; padding-left: 10px; font-size: 15px;">
                    <h3 class="profile_heading2">Profession (#<?php echo $jobseeker["npi_number"]; ?>)</h3>
                    <div style="padding-left: 25px;">
                        <?php
                        $spec_name = get_specialties($jobseeker["specialty"]);
                        $spec_name = $spec_name['name'];
                        $sub_spec_name = get_specialties($jobseeker["sub_specialty"]);
                        $sub_spec_name = $sub_spec_name['name'];
                        ?>
                        <ul>
                            <li class="ng-binding">
                                Profession: Physician
                            </li>
                            <li class="ng-binding">
                                Specialty: <?php echo (isset($spec_name)) ? $spec_name: ""; ?> 
                            </li>
                            <li class="ng-binding">
                                Sub Specialty: <?php echo (isset($sub_spec_name)) ? $sub_spec_name: ""; ?>
                            </li>
                            <li class="ng-binding">
                                Experience Level: <?php echo isset($jobseeker["experince_level"]) ? str_replace("_"," ",ucfirst($jobseeker["experince_level"]) )  : "" ;?>
                            </li>
                        </ul>
                    </div>
                </div>
                <div>
                    <a id="profession_edit_link" class="edit_link"><span class="glyphicon glyphicon-pencil"></span> Edit</a>
                </div>
                <div class="clearfix"></div>
            </div>
            <div id="profession_edit" style="display: none;">
                <div style="float: left; width: 85%; padding-left: 10px;">
                    <h3 style="text-align: left; padding-left: 20px;">Profession</h3>
                    <form method="post" id="profession_form">
                    <fieldset>
                        
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
                                <option value="">Specialty</option>
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
                                <option value="">Sub Specialty</option>
                                <?php 
                                if(isset($sub_specialty) && is_array($sub_specialty)){ 
                                    foreach($sub_specialty as $sub_spec) { 
                                    $selected = (isset($jobseeker['sub_specialty']) && $jobseeker['sub_specialty'] == $sub_spec['id'] ) ? ' selected="selected" ' : "" ;
                                    ?>
                                    <option value="<?php echo $sub_spec['id']; ?>" <?php echo $selected; ?> ><?php echo strip_slashes($sub_spec['name']); ?></option>    
                                    <?php } 
                                }
                                else{
                                ?>
                                <option value=""></option>
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
                                <option value="" class="">Select</option>
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
                            <input type="text" class="ng-pristine ng-valid form-control" placeholder="NPI #" id="npi_number" name="npi_number" required value="<?php echo isset($jobseeker['npi_number']) ? $jobseeker['npi_number'] : "" ;  ?>">
                        </div>
                        

                    </fieldset>
                    </form>
                </div>
                <div class="clearfix"></div>
                <div class="form_btn_bar">
                    <a id="profession_cancel" href="javascript:void(0)" class="btn btn-warning">Cancel</a>
                    <a id="profession_save" href="javascript:void(0)" class="btn btn-primary">Save</a>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        
        <!--License & Certification Section-->
        <div id="licenseC">
            <div id="certification_block">
                <div style="float: left; width: 85%; padding-left: 10px; font-size: 15px;">
                    <h3 class="profile_heading2">Licenses &amp; Certifications</h3>
                    
                    <div id="license_list">
                        <?php
                        if($licences){
                            foreach ($licences as $row){ 
                                ?>
                            <div class="row-wrapper well-blue padding_5" data-val="<?php echo $row["id"]; ?>" >
                                <div class="col col-sm-5 text-left">
                                    <strong><?php echo $row["licence_type"]; ?></strong><br>
                                    <?php echo $row["licence_number"]; ?>
                                </div>
                                <div class="col col-sm-4 text-left">
                                    <?php echo date("Y-m-d",$row["issued_on"]); ?><br>
                                    <?php echo $row["state"]; ?>
                                </div>
                                <div class="col col-sm-2 text-left">
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <?php }
                        } ?>
                    </div>
                    <div id="certification_list">
                        <?php
                        if($certifications){
                            foreach ($certifications as $row){ ?>
                        <div class="row-wrapper well-purple padding_5" data-val="<?php echo $row["id"]; ?>" >
                            <div class="col col-sm-5 text-left">
                                <strong><?php echo $row["name"]; ?></strong><br>
                            </div>
                            <div class="col col-sm-4 text-left">
                                <?php echo date("Y-m-d",$row["issued_on"]); ?>
                            </div>
                            <div class="col col-sm-2 text-left">
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <?php }
                        } ?>
                    </div>
                    
                    
                </div>
                <div>
                    <a id="certification_edit_link" class="edit_link"><span class="glyphicon glyphicon-pencil"></span> Edit</a>
                </div>
                
                

            </div>
            <div id="certification_edit" style="display: none;">
                <div style="float: left; width: 85%; padding-left: 10px; font-size: 15px;">
                <h3 class="profile_heading2">Licenses &amp; Certifications</h3>
                <div id="license_list_edit">
                    <?php
                    if($licences){
                        foreach ($licences as $row){ 
                            ?>
                        <div class="row-wrapper well-blue padding_5" data-val="<?php echo $row["id"]; ?>" >
                            <div class="col col-sm-5 text-left">
                                <strong><?php echo $row["licence_type"]; ?></strong><br>
                                <?php echo $row["licence_number"]; ?>
                            </div>
                            <div class="col col-sm-4 text-left">
                                <?php echo date("Y-m-d",$row["issued_on"]); ?><br>
                                <?php echo $row["state"]; ?>
                            </div>
                            <div class="col col-sm-2 text-left">
                                <a class="remove_license btn btn-danger btn-sm">Remove</a>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <?php }
                    } ?>
                </div>
                <div id="certification_list_edit">
                    <?php
                    if($certifications){
                        foreach ($certifications as $row){ ?>
                    <div class="row-wrapper well-purple padding_5" data-val="<?php echo $row["id"]; ?>" >
                        <div class="col col-sm-5 text-left">
                            <strong><?php echo $row["name"]; ?></strong><br>
                        </div>
                        <div class="col col-sm-4 text-left">
                            <?php echo date("Y-m-d",$row["issued_on"]); ?>
                        </div>
                        <div class="col col-sm-2 text-left">
                            <a class="remove_certification btn btn-danger btn-sm">Remove</a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <?php }
                    } ?>
                </div>
                </div>
                <div class="clearfix"></div>
                <div class="form_btn_bar">
                    <a id="certification_cancel" href="javascript:void(0)" class="btn btn-warning">Cancel</a>
                    <a id="certification_save" href="javascript:void(0)" class="btn btn-primary">Save</a>
                </div>
                <div class="clearfix"></div>
            </div>

        </div>
        
        <!--Education Section-->
        <div id="educationC">
            <div class="" ng-show="educationSection == 'list'">
                <div style="float: left; width: 85%; padding-left: 10px; font-size: 15px;">
                    <h3 style="text-align: left; padding-left: 20px;">Education</h3>
                    <div style="padding-left: 25px;">
                        <!-- ngRepeat: residency in fellowships --><div class="ng-scope" ng-repeat="residency in fellowships">
                            <!-- Summary of each school with option to remove. -->
                            <div class="well well-sm well-yellow">
                                <div class="col-sm-5 text-left">
                                    <p style="margin-bottom: 0px"><strong class="ng-binding">asdasd</strong></p>
                                    <p class="ng-binding">123123, AK, 121</p>
                                </div>
                                <div class="col-sm-5 text-left">
                                    <p class="ng-binding" style="margin-bottom: 0px">Critical Care Medicine</p>
                                    <p class="ng-binding">12/31/2313 - 12/31/2312</p>
                                </div>
                                <div class="col-sm-2">
                                    &nbsp;
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div><!-- end ngRepeat: residency in fellowships -->
                        <!-- ngRepeat: residency in residencies --><div class="ng-scope" ng-repeat="residency in residencies">

                            <!-- Summary of each school with option to remove. -->
                            <div class="well well-sm well-blue">
                                <div class="col-sm-5 text-left">
                                    <p style="margin-bottom: 0px"><strong class="ng-binding">asdasd</strong></p>
                                    <p class="ng-binding">zxczc, AK, pk</p>
                                </div>
                                <div class="col-sm-5 text-left">
                                    <p class="ng-binding" style="margin-bottom: 0px">Hospice and Palliative Medicine</p>
                                    <p class="ng-binding">12/31/2312 - 12/31/2313</p>
                                </div>
                                <div class="col-sm-2">
                                    &nbsp;
                                </div>
                                <div class="clearfix"></div>
                            </div>

                        </div><!-- end ngRepeat: residency in residencies -->
                        <!-- ngRepeat: school in schools --><div class="ng-scope" ng-repeat="school in schools">
                            <!-- Summary of each school with option to remove. -->
                            <div class="well well-sm well-purple">
                                <div class="col-sm-5 text-left">
                                    <p style="margin-bottom: 0px"><strong class="ng-binding">asdads (Med School)</strong></p>
                                    <p class="ng-binding">3, AS, 123</p>
                                </div>
                                <div class="col-sm-5 text-left">
                                    <p class="ng-binding" style="margin-bottom: 0px">1231231</p>
                                    <p class="ng-binding">Year Graduated: 3121</p>
                                </div>
                                <div class="col-sm-2">
                                    &nbsp;
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div><!-- end ngRepeat: school in schools -->
                    </div>
                </div>
                <div style="float: left; width: 15%; text-align: right; padding-right: 15px; padding-top: 15px;"><a ng-click="editEducationInfo()"><i class="fa fa-pencil">&nbsp;</i>Edit</a></div>
                <div class="clearfix"></div>
            </div>
            <div class="ng-hide" ng-show="educationSection == 'edit'" style="position: relative;">											
                <div id="educationW" style="position: absolute; top: 10; width: 100%; height: 100%; background: #ccc; opacity: 0.3; z-index: 9999; display: none;">&nbsp;</div>
                <div style="float: left; width: 85%; padding-left: 10px; font-size: 15px;">
                    <h3 style="text-align: left; padding-left: 20px;">Education</h3>
                    <div class="alert alert-danger" id="educationE" style="display: none;">You have to add at least one School and Residency.</div>
                    <fieldset style="float: none; margin: 0 auto; padding: 0 0 0 25px;">
                        <div class="filter">
                            <!-- ngRepeat: residency in fellowships --><div class="ng-scope" ng-repeat="residency in fellowships">
                                <!-- Summary of each school with option to remove. -->
                                <div class="well well-sm well-yellow">
                                    <div class="col-sm-5 text-left">
                                        <p style="margin-bottom: 0px"><strong class="ng-binding">asdasd</strong></p>
                                        <p class="ng-binding">123123, AK, 121</p>
                                    </div>
                                    <div class="col-sm-5 text-left">
                                        <p class="ng-binding" style="margin-bottom: 0px">Critical Care Medicine</p>
                                        <p class="ng-binding">12/31/2313 - 12/31/2312</p>
                                    </div>
                                    <div class="col-sm-2">
                                        <a class="btn btn-danger btn-xs" ng-click="fellowships.splice($index, 1)">Remove</a>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div><!-- end ngRepeat: residency in fellowships -->
                            <!-- ngRepeat: residency in residencies --><div class="ng-scope" ng-repeat="residency in residencies">

                                <!-- Summary of each school with option to remove. -->
                                <div class="well well-sm well-blue">
                                    <div class="col-sm-5 text-left">
                                        <p style="margin-bottom: 0px"><strong class="ng-binding">asdasd</strong></p>
                                        <p class="ng-binding">zxczc, AK, pk</p>
                                    </div>
                                    <div class="col-sm-5 text-left">
                                        <p class="ng-binding" style="margin-bottom: 0px">Hospice and Palliative Medicine</p>
                                        <p class="ng-binding">12/31/2312 - 12/31/2313</p>
                                    </div>
                                    <div class="col-sm-2">
                                        <a class="btn btn-danger btn-xs" ng-click="residencies.splice($index, 1)">Remove</a>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>

                            </div><!-- end ngRepeat: residency in residencies -->
                            <!-- ngRepeat: school in schools --><div class="ng-scope" ng-repeat="school in schools">
                                <!-- Summary of each school with option to remove. -->
                                <div class="well well-sm well-purple">
                                    <div class="col-sm-5 text-left">
                                        <p style="margin-bottom: 0px"><strong class="ng-binding">asdads (Med School)</strong></p>
                                        <p class="ng-binding">3, AS, 123</p>
                                    </div>
                                    <div class="col-sm-5 text-left">
                                        <p class="ng-binding" style="margin-bottom: 0px">1231231</p>
                                        <p class="ng-binding">Year Graduated: 3121</p>
                                    </div>
                                    <div class="col-sm-2">
                                        <a class="btn btn-danger btn-xs" ng-click="schools.splice($index, 1)">Remove</a>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div><!-- end ngRepeat: school in schools -->
                        </div>
                        <div style="text-align: center;" class="filter" ng-show="stage4SubState == 'normal'">
                            <a class="btn btn-light-blue btn-sm" ng-click="stage4SubState = 'addEducation'"><i class="fa fa-check-circle">&nbsp;</i> Add Degree</a>
                            <a class="btn btn-light-red btn-sm" ng-click="stage4SubState = 'addResidency'"><i class="fa fa-check-circle">&nbsp;</i> Add Residency</a>
                            <a class="btn btn-light-yellow btn-sm" ng-click="stage4SubState = 'addFellowship'"><i class="fa fa-check-circle">&nbsp;</i> Add Fellowship</a>
                        </div>
                        <div class="ng-hide" ng-show="stage4SubState == 'addEducation'">
                            <div class="filter">
                                <input class="ng-pristine ng-valid" id="schoolName" ng-model="newSchool.name" placeholder="School" type="text">
                                <input class="ng-pristine ng-valid" id="schoolDegree" ng-model="newSchool.degree" placeholder="Degree" type="text">
                            </div>
                            <div class="filter">
                                <input class="ng-pristine ng-valid" id="schoolCity" ng-model="newSchool.city" placeholder="City" type="text">
                                <select class="ng-pristine ng-valid" id="schoolState" ng-model="newSchool.state" style="width: 15%;" ng-options="option for option in states"><option class="" value="">State</option><option value="0">AL</option><option value="1">AK</option><option value="2">AS</option><option value="3">AZ</option><option value="4">AR</option><option value="5">CA</option><option value="6">CO</option><option value="7">CT</option><option value="8">DE</option><option value="9">DC</option><option value="10">FM</option><option value="11">FL</option><option value="12">GA</option><option value="13">GU</option><option value="14">HI</option><option value="15">ID</option><option value="16">IL</option><option value="17">IN</option><option value="18">IA</option><option value="19">KS</option><option value="20">KY</option><option value="21">LA</option><option value="22">ME</option><option value="23">MH</option><option value="24">MD</option><option value="25">MA</option><option value="26">MI</option><option value="27">MN</option><option value="28">MS</option><option value="29">MO</option><option value="30">MT</option><option value="31">NE</option><option value="32">NV</option><option value="33">NH</option><option value="34">NJ</option><option value="35">NM</option><option value="36">NY</option><option value="37">NC</option><option value="38">ND</option><option value="39">MP</option><option value="40">OH</option><option value="41">OK</option><option value="42">OR</option><option value="43">PW</option><option value="44">PA</option><option value="45">PR</option><option value="46">RI</option><option value="47">SC</option><option value="48">SD</option><option value="49">TN</option><option value="50">TX</option><option value="51">UT</option><option value="52">VT</option><option value="53">VI</option><option value="54">VA</option><option value="55">WA</option><option value="56">WV</option><option value="57">WI</option><option value="58">WY</option></select>
                                <input class="ng-pristine ng-valid" id="schoolCountry" ng-model="newSchool.country" placeholder="Country" style="width: 25%" type="text">
                            </div>
                            <div class="filter">
                                <input id="schoolYear" class="yearMask ng-pristine ng-valid" ng-model="newSchool.gradYear" placeholder="Year" type="text">
                                <span style="margin: 5px; padding: 7px;">Med School &nbsp;<input class="ng-pristine ng-valid" ng-model="newSchool.isMedSchool" type="checkbox"></span>
                            </div>
                            <div class="text-left" style="padding: 10px;">
                                <a class="btn btn-primary btn-sm" ng-click="addEducation()">Add</a>
                                <a class="btn btn-primary btn-sm" ng-click="stage4SubState = 'normal';
                                                                                                                            resetError();">Cancel</a>
                            </div>
                        </div>
                        <div class="ng-hide" ng-show="stage4SubState == 'addResidency'">
                            <div class="filter">
                                <input class="ng-pristine ng-valid" id="rInstitution" ng-model="newResidency.name" placeholder="Institution" type="text">
                            </div>
                            <div class="filter">
                                <input id="rFrom" ng-model="newResidency.fromDate" class="dateMask ng-pristine ng-valid" placeholder="From" type="text">
                                <input id="rTo" ng-model="newResidency.toDate" class="dateMask ng-pristine ng-valid" placeholder="To" type="text">
                            </div>
                            <div class="filter">
                                <input class="ng-pristine ng-valid" id="rCity" ng-model="newResidency.city" placeholder="City" type="text">
                                <select class="ng-pristine ng-valid" id="rState" ng-model="newResidency.state" style="width: 15%;" ng-options="option for option in states"><option class="" value="">State</option><option value="0">AL</option><option value="1">AK</option><option value="2">AS</option><option value="3">AZ</option><option value="4">AR</option><option value="5">CA</option><option value="6">CO</option><option value="7">CT</option><option value="8">DE</option><option value="9">DC</option><option value="10">FM</option><option value="11">FL</option><option value="12">GA</option><option value="13">GU</option><option value="14">HI</option><option value="15">ID</option><option value="16">IL</option><option value="17">IN</option><option value="18">IA</option><option value="19">KS</option><option value="20">KY</option><option value="21">LA</option><option value="22">ME</option><option value="23">MH</option><option value="24">MD</option><option value="25">MA</option><option value="26">MI</option><option value="27">MN</option><option value="28">MS</option><option value="29">MO</option><option value="30">MT</option><option value="31">NE</option><option value="32">NV</option><option value="33">NH</option><option value="34">NJ</option><option value="35">NM</option><option value="36">NY</option><option value="37">NC</option><option value="38">ND</option><option value="39">MP</option><option value="40">OH</option><option value="41">OK</option><option value="42">OR</option><option value="43">PW</option><option value="44">PA</option><option value="45">PR</option><option value="46">RI</option><option value="47">SC</option><option value="48">SD</option><option value="49">TN</option><option value="50">TX</option><option value="51">UT</option><option value="52">VT</option><option value="53">VI</option><option value="54">VA</option><option value="55">WA</option><option value="56">WV</option><option value="57">WI</option><option value="58">WY</option></select>
                                <input class="ng-pristine ng-valid" id="rCountry" ng-model="newResidency.country" placeholder="Country" style="width: 25%" type="text">
                            </div>
                            <div class="filter">
                                <select class="ng-pristine ng-valid" id="rField" ng-model="newResidency.field" ng-options="option as option.get('name') for option in specialties"><option class="" value="">Field</option><option value="0">Allergy and Immunology</option><option value="1">Anesthesiology</option><option value="2">Colon and Rectal Surgery</option><option value="3">Dermatology</option><option value="4">Emergency Medicine</option><option value="5">Family Medicine</option><option value="6">Internal Medicine</option><option value="7">Medical Genetics</option><option value="8">Neurological Surgery</option><option value="9">Neurology</option><option value="10">Nuclear Medicine</option><option value="11">Obstetrics and Gynecology</option><option value="12">Opthalmology</option><option value="13">Orthopaedic Surgery</option><option value="14">Otolaryngology</option><option value="15">Pathology</option><option value="16">Pediatrics</option><option value="17">Physical Medicine and Rehabilitation</option><option value="18">Plastic Surgery</option><option value="19">Preventive Medicine</option><option value="20">Psychiatry</option><option value="21">Radiology</option><option value="22">Surgery - General</option><option value="23">Thoracic and Cardiac Surgery</option><option value="24">Urology</option></select>
                                <select class="ng-pristine ng-valid" id="rConcentration" ng-model="newResidency.concentration" ng-options="option for option in newResidency.field.get('subspecialties')"><option class="" value="">Concentration</option></select>
                            </div>
                            <div class="text-left" style="padding: 10px;">
                                <a class="btn btn-primary btn-sm" ng-click="addResidency()">Add</a>
                                <a class="btn btn-primary btn-sm" ng-click="stage4SubState = 'normal';
                                                                                                                            resetError();">Cancel</a>
                            </div>
                        </div>
                        <div class="ng-hide" ng-show="stage4SubState == 'addFellowship'">

                            <div class="filter">
                                <input class="ng-pristine ng-valid" id="fInstitution" ng-model="newFellowship.name" placeholder="Institution" type="text">
                            </div>
                            <div class="filter">
                                <input id="fFrom" ng-model="newFellowship.fromDate" class="dateMask ng-pristine ng-valid" placeholder="From" type="text">
                                <input id="fTo" ng-model="newFellowship.toDate" class="dateMask ng-pristine ng-valid" placeholder="To" type="text">
                            </div>
                            <div class="filter">
                                <input class="ng-pristine ng-valid" id="fCity" ng-model="newFellowship.city" placeholder="City" type="text">
                                <select class="ng-pristine ng-valid" id="fState" ng-model="newFellowship.state" style="width: 15%;" ng-options="option for option in states"><option class="" value="">State</option><option value="0">AL</option><option value="1">AK</option><option value="2">AS</option><option value="3">AZ</option><option value="4">AR</option><option value="5">CA</option><option value="6">CO</option><option value="7">CT</option><option value="8">DE</option><option value="9">DC</option><option value="10">FM</option><option value="11">FL</option><option value="12">GA</option><option value="13">GU</option><option value="14">HI</option><option value="15">ID</option><option value="16">IL</option><option value="17">IN</option><option value="18">IA</option><option value="19">KS</option><option value="20">KY</option><option value="21">LA</option><option value="22">ME</option><option value="23">MH</option><option value="24">MD</option><option value="25">MA</option><option value="26">MI</option><option value="27">MN</option><option value="28">MS</option><option value="29">MO</option><option value="30">MT</option><option value="31">NE</option><option value="32">NV</option><option value="33">NH</option><option value="34">NJ</option><option value="35">NM</option><option value="36">NY</option><option value="37">NC</option><option value="38">ND</option><option value="39">MP</option><option value="40">OH</option><option value="41">OK</option><option value="42">OR</option><option value="43">PW</option><option value="44">PA</option><option value="45">PR</option><option value="46">RI</option><option value="47">SC</option><option value="48">SD</option><option value="49">TN</option><option value="50">TX</option><option value="51">UT</option><option value="52">VT</option><option value="53">VI</option><option value="54">VA</option><option value="55">WA</option><option value="56">WV</option><option value="57">WI</option><option value="58">WY</option></select>
                                <input class="ng-pristine ng-valid" id="fCountry" ng-model="newFellowship.country" placeholder="Country" style="width: 25%" type="text">
                            </div>
                            <div class="filter">
                                <select class="ng-pristine ng-valid" id="fField" ng-model="newFellowship.field" ng-options="option as option.get('name') for option in specialties"><option class="" value="">Field</option><option value="0">Allergy and Immunology</option><option value="1">Anesthesiology</option><option value="2">Colon and Rectal Surgery</option><option value="3">Dermatology</option><option value="4">Emergency Medicine</option><option value="5">Family Medicine</option><option value="6">Internal Medicine</option><option value="7">Medical Genetics</option><option value="8">Neurological Surgery</option><option value="9">Neurology</option><option value="10">Nuclear Medicine</option><option value="11">Obstetrics and Gynecology</option><option value="12">Opthalmology</option><option value="13">Orthopaedic Surgery</option><option value="14">Otolaryngology</option><option value="15">Pathology</option><option value="16">Pediatrics</option><option value="17">Physical Medicine and Rehabilitation</option><option value="18">Plastic Surgery</option><option value="19">Preventive Medicine</option><option value="20">Psychiatry</option><option value="21">Radiology</option><option value="22">Surgery - General</option><option value="23">Thoracic and Cardiac Surgery</option><option value="24">Urology</option></select>
                                <select class="ng-pristine ng-valid" id="fConcentration" ng-model="newFellowship.concentration" ng-options="option for option in newFellowship.field.get('subspecialties')"><option class="" value="">Concentration</option></select>
                            </div>
                            <div class="text-left" style="padding: 10px;">
                                <a class="btn btn-primary btn-sm" ng-click="addFellowship()">Add</a>
                                <a class="btn btn-primary btn-sm" ng-click="stage4SubState = 'normal';
                                                                                                                            resetError();">Cancel</a>
                            </div>

                        </div>
                    </fieldset>
                </div>
                <div style="float: left; width: 15%; text-align: right; padding-right: 15px; padding-top: 15px;"><a ng-click="cancelEducationInfo()">Cancel</a></div>
                <div class="clearfix"></div>
            </div>

        </div>
        
        <!--Practice Section-->
        <div id="practiceC">
            <div class="" ng-show="practiceSection == 'list'">
                <div style="float: left; width: 85%; padding-left: 10px; font-size: 15px;">
                    <h3 style="text-align: left; padding-left: 20px;">Practices</h3>
                    <div style="padding-left: 25px;">
                        <!-- ngRepeat: practice in practices --><div class="ng-scope" ng-repeat="practice in practices">

                            <div class="well well-sm well-blue">
                                <div class="col-sm-5 text-left">
                                    <p style="margin-bottom: 0px"><strong class="ng-binding">zasdasd</strong></p>
                                    <p class="ng-binding">adsd asdasd</p>
                                </div>
                                <div class="col-sm-5 text-left">
                                    <p class="ng-binding" style="margin-bottom: 0px">12/31/2313 - 12/31/2312</p>
                                    <p class="ng-binding">zxc, AL, US</p>
                                </div>
                                <div class="col-sm-2">
                                    &nbsp;
                                </div>
                                <div class="clearfix"></div>
                            </div>

                        </div><!-- end ngRepeat: practice in practices -->
                    </div>
                </div>
                <div style="float: left; width: 15%; text-align: right; padding-right: 15px; padding-top: 15px;"><a ng-click="editPracticeInfo()"><i class="fa fa-pencil">&nbsp;</i>Edit</a></div>
                <div class="clearfix"></div>	
            </div>
            <div class="ng-hide" ng-show="practiceSection == 'edit'">
                <div style="float: left; width: 85%; padding-left: 10px; font-size: 15px;">
                    <h3 style="text-align: left; padding-left: 20px;">Practices</h3>
                    <fieldset style="float: none; margin: 0 auto; padding: 15px 0 0 25px;">
                        <div class="filter">
                            <!-- ngRepeat: practice in practices --><div class="ng-scope" ng-repeat="practice in practices">

                                <div class="well well-sm well-blue">
                                    <div class="col-sm-5 text-left">
                                        <p style="margin-bottom: 0px"><strong class="ng-binding">zasdasd</strong></p>
                                        <p class="ng-binding">adsd asdasd</p>
                                    </div>
                                    <div class="col-sm-5 text-left">
                                        <p class="ng-binding" style="margin-bottom: 0px">12/31/2313 - 12/31/2312</p>
                                        <p class="ng-binding">zxc, AL, US</p>
                                    </div>
                                    <div class="col-sm-2">
                                        <a class="btn btn-danger btn-xs" ng-click="deletePracticeInfo($index)">Remove</a>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>

                            </div><!-- end ngRepeat: practice in practices -->
                        </div>
                        <div class="filter">
                            <input class="ng-pristine ng-valid" id="jobTitle" ng-model="newPractice.job" placeholder="Job Title" type="text">
                            <input class="ng-pristine ng-valid" id="workCity" placeholder="City" maxlength="50" ng-model="newPractice.city" style="width: 25%" type="text">
                            <select class="ng-pristine ng-valid" id="workState" type="text" style="width: 15%;" ng-model="newPractice.state" ng-options="option for option in states"><option class="" value="" selected="">State</option><option value="0">AL</option><option value="1">AK</option><option value="2">AS</option><option value="3">AZ</option><option value="4">AR</option><option value="5">CA</option><option value="6">CO</option><option value="7">CT</option><option value="8">DE</option><option value="9">DC</option><option value="10">FM</option><option value="11">FL</option><option value="12">GA</option><option value="13">GU</option><option value="14">HI</option><option value="15">ID</option><option value="16">IL</option><option value="17">IN</option><option value="18">IA</option><option value="19">KS</option><option value="20">KY</option><option value="21">LA</option><option value="22">ME</option><option value="23">MH</option><option value="24">MD</option><option value="25">MA</option><option value="26">MI</option><option value="27">MN</option><option value="28">MS</option><option value="29">MO</option><option value="30">MT</option><option value="31">NE</option><option value="32">NV</option><option value="33">NH</option><option value="34">NJ</option><option value="35">NM</option><option value="36">NY</option><option value="37">NC</option><option value="38">ND</option><option value="39">MP</option><option value="40">OH</option><option value="41">OK</option><option value="42">OR</option><option value="43">PW</option><option value="44">PA</option><option value="45">PR</option><option value="46">RI</option><option value="47">SC</option><option value="48">SD</option><option value="49">TN</option><option value="50">TX</option><option value="51">UT</option><option value="52">VT</option><option value="53">VI</option><option value="54">VA</option><option value="55">WA</option><option value="56">WV</option><option value="57">WI</option><option value="58">WY</option></select>
                        </div>
                        <div class="filter">
                            <input class="ng-pristine ng-valid" id="hospitalName" ng-model="newPractice.name" placeholder="Hospital Name" type="text">
                            <input id="workStartDate" ng-model="newPractice.fromDate" class="dateMask ng-pristine ng-valid" placeholder="Start Date" type="text">
                        </div>
                        <div class="filter">
                            <input class="ng-pristine ng-valid" id="facilityType" ng-model="newPractice.type" placeholder="Facility Type" type="text">
                            <input id="workEndDate" ng-model="newPractice.toDate" class="dateMask ng-pristine ng-valid" placeholder="End Date" type="text">
                        </div>
                        <div class="filter" style="margin-top: 5px;">
                            <a ng-click="addProfessionInfo()" class="btn btn-sm btn-green">Add</a>
                        </div>



                    </fieldset>
                </div>
                <div style="float: left; width: 15%; text-align: right; padding-right: 15px; padding-top: 15px;"><a ng-click="cancelPracticeInfo()">Cancel</a></div>
                <div class="clearfix"></div>
            </div>

        </div>
        <br>
    </div>
    <div class="col col-sm-5">
        <div style="width: 90%; margin: 0 auto;">
            <br>
            <?php echo load_img("profile_ad_1.png") ?>
            <br><br>
            <?php echo load_img("profile_ad_2.png") ?>
            <br><br>
            <?php echo load_img("profile_ad_3.png") ?>
        </div>
    </div>
    <div class="clearfix"></div>
</div>

