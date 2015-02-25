<?php 
    
    echo load_css('jquery-ui.css','assets/js/jquery_ui/');
    echo load_js("jquery-ui.js","assets/js/jquery_ui/");
            
?>
<style>
    .ng-hide,.hidden{
        display: none;
    }
    .form_btn_bar{
        margin: 20px;
        text-align: right;
    }
    .form_btn_bar_2{
        float: left; width: 85%; padding-left: 10px;
        text-align: center;
        margin: 10px 0 10px 0;
    }
    .edit_link{
        cursor: pointer;
        float: right;
    }
    .profile_heading1{
        text-align: left; 
        font-size: 40px; 
/*        padding-left: 20px; 
        padding-top: 2px; 
        margin-top: 5px; 
        margin-bottom: 2px;*/
        
        padding: 0px; 
        margin: 10px 0px; 
        text-align: left;
    }
    .contact_info_text{
        padding-left: 20px; font-size: 16px;
    }
    .contact_info_text span{
        color: #2A802A;
    }
    .profile_heading2{
        text-align: left; 
        padding: 0px; 
        margin: 10px 0px; 
        text-align: left;
        font-size: 30px; 
    }
    #profession_block ul{
        padding-left: 0px;
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
    
    #degree_list,#degree_list_edit{
        margin-bottom: 10px;
    }
    #residency_list,#residency_list_edit{
        margin-bottom: 10px;
    }
    #fellowship_list,#fellowship_list_edit{
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
                <div id="certification_rsp" class="" style="display: none;"></div>
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
                <div>
                    <a id="certification_cancel" class="edit_link"><span class="glyphicon glyphicon-ok"></span> Done</a>
                </div>
                
                <div class="clearfix"></div>
                <div id="toolbar_certification" class="form_btn_bar_2">
                    <a id="add_license" class="btn btn-blue btn-sm" >
                        <span class="glyphicon glyphicon-check"></span> Add License
                    </a>
                    <a id="add_certification" class="btn btn-purple btn-sm" >
                        <span class="glyphicon glyphicon-check"></span> Add Certification
                    </a>
                </div>
                
                <div id="add_license_block" class="well-blue col-lg-12 block-toggle" style="padding: 5%; display: none; width: 85%;" >
                    <form id="add_license_form" method="post">  
                        <div class="left_col">
                            <input class="ng-valid ng-dirty form-control license_text" id="licenseType"  name="licenseType" placeholder="License Type" type="text" required >
                        </div>
                        <div class="right_col">
                            <input class="ng-valid ng-dirty form-control license_text" id="licenseNumber" name="licenseNumber" placeholder="License Number" type="text" required >
                        </div>
                        <div class="left_col">
                            <input class="dateMask ng-valid ng-dirty form-control license_text" id="licenseIssued" name="licenseIssued" placeholder="Issued On" type="text" required >
                        </div>
                        <div class="right_col">
                            <select class="form-control license_text" name="state" id="state" required>
                                <option value="">State</option>
                                <?php 
                                $states = get_states( array("country"=>"US") ); 
                                foreach($states as $state){ ?>
                                    <option value="<?php echo $state["code"] ?>"><?php echo $state["code"] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="clearfix"></div>
                        <div class="">
                            <strong>Federal</strong>&nbsp;&nbsp;&nbsp;&nbsp;
                            Yes&nbsp;&nbsp;
                            <input required class="" name="federal" id="federal-yes" value="yes" type="radio">&nbsp;&nbsp;
                            No&nbsp;&nbsp;
                            <input required  name="federal" id="federal-no" value="no" class="" type="radio">
                        </div>


                        <div class="col col-sm-12 text-center" style="margin-top: 15px; padding-left: 15px; clear: both;">
                            <a class="btn btn-primary btn-sm" id="add_license_btn" >Add</a>
                            <a class="btn btn-primary btn-sm" id="cancel_license_btn" >Cancel</a>
                        </div>
                    </form>
                </div>
                <div id="add_certification_block" class="well-purple col-lg-12 block-toggle" style="padding: 5%; display: none; width: 85%;" >
                    <form id="add_certification_form" method="post">
                    <div class="left_col">
                        <input class="ng-valid ng-dirty form-control cert_text" id="cert_name" name="cert_name" placeholder="Certificate Name" type="text" required >
                    </div>
                    <div class="right_col">
                        <input class="dateMask ng-valid ng-dirty form-control cert_text" id="cert_issued_on" name="cert_issued_on" placeholder="Issued On" type="text" required >
                    </div>
                    
                    <div class="col col-sm-12 text-center" style="margin-top: 15px; padding-left: 15px; clear: both;">
                        <a class="btn btn-primary btn-sm" id="add_certification_btn" >Add</a>
                        <a class="btn btn-primary btn-sm" id="cancel_certification_btn" >Cancel</a>
                    </div>
                    </form>
                </div>
                
                <div class="clearfix"></div>
            </div>

        </div>
        
        <!--Education Section-->
        <div id="educationC">
            <div id="education_block">
                <div style="float: left; width: 85%; padding-left: 10px; font-size: 15px;">
                    <h3 class="profile_heading2">Educations</h3>
                    
                    <div id="degree_list">
                        <?php
                        if($degrees){
                            foreach ($degrees as $row){ 
                                ?>
                            <div class="row-wrapper well-blue padding_5" data-val="<?php echo $row["id"]; ?>" >
                                <div class="col col-sm-5 text-left">
                                    <strong><?php echo $row["degree"]; ?></strong><br>
                                    <?php 
                                    $med_school = (isset($row["med_school"]) && $row["med_school"] == "yes" ) ? "(Med School)" : ""; 
                                    echo $row["school"].$med_school;
                                    ?>
                                </div>
                                <div class="col col-sm-4 text-left">
                                    <?php echo date("Y",$row["year"]); ?><br>
                                    <?php echo $row["city"].",".$row["state"].",".$row["country"]; ?>
                                </div>
                                <div class="col col-sm-2 text-left">
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <?php }
                        } ?>
                    </div>
                    <div id="residency_list">
                        <?php
                        if($residencys){
                            foreach ($residencys as $row){ 
                                ?>
                            <div class="row-wrapper well-purple padding_5" data-val="<?php echo $row["id"]; ?>" >
                                <div class="col col-sm-5 text-left">
                                    <strong><?php echo $row["institution"]; ?></strong><br>
                                    <?php echo $row["city"].",".$row["state"].",".$row["country"]; ?>
                                </div>
                                <div class="col col-sm-4 text-left">
                                    <?php 
                                    $speciality =  get_specialties($row["speciality"]); 
                                    $sub_speciality =  get_specialties($row["sub_speciality"]); 
                                    echo ( isset($speciality['name']) ) ? $speciality['name'] : "";
                                    echo ( isset($sub_speciality['name']) ) ? ", ".$sub_speciality['name'] : "";
                                    ?>
                                    <br>
                                    <?php echo date("Y-m-d",$row["date_from"])." - ".date("Y-m-d",$row["date_to"]); ?>
                                </div>
                                <div class="col col-sm-2 text-left">
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <?php }
                        } ?>
                    </div>
                    <div id="fellowship_list">
                        <?php
                        if($fellowships){
                            foreach ($fellowships as $row){ 
                                ?>
                            <div class="row-wrapper well-yellow padding_5" data-val="<?php echo $row["id"]; ?>" >
                                <div class="col col-sm-5 text-left">
                                    <strong><?php echo $row["institution"]; ?></strong><br>
                                    <?php echo $row["city"].",".$row["state"].",".$row["country"]; ?>
                                </div>
                                <div class="col col-sm-4 text-left">
                                    <?php 
                                    $speciality =  get_specialties($row["speciality"]); 
                                    $sub_speciality =  get_specialties($row["sub_speciality"]); 
                                    echo ( isset($speciality['name']) ) ? $speciality['name'] : "";
                                    echo ( isset($sub_speciality['name']) ) ? ", ".$sub_speciality['name'] : "";
                                    ?>
                                    <br>
                                    <?php echo date("Y-m-d",$row["date_from"])." - ".date("Y-m-d",$row["date_to"]); ?>
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
                    <a id="education_edit_link" class="edit_link"><span class="glyphicon glyphicon-pencil"></span> Edit</a>
                </div>
                
                

            </div>
            <div id="education_edit" style="display: none;">
                <div style="float: left; width: 85%; padding-left: 10px; font-size: 15px;">
                    <h3 class="profile_heading2">Educations</h3>
                    <div id="education_rsp" class="" style="display: none;"></div>
                    
                    <div id="degree_list_edit">
                        <?php
                        if($degrees){
                            foreach ($degrees as $row){ 
                                ?>
                            <div class="row-wrapper well-blue padding_5" data-val="<?php echo $row["id"]; ?>" >
                                <div class="col col-sm-5 text-left">
                                    <strong><?php echo $row["degree"]; ?></strong><br>
                                    <?php 
                                    $med_school = (isset($row["med_school"]) && $row["med_school"] == "yes" ) ? "(Med School)" : ""; 
                                    echo $row["school"].$med_school;
                                    ?>
                                </div>
                                <div class="col col-sm-4 text-left">
                                    <?php echo date("Y",$row["year"]); ?><br>
                                    <?php echo $row["city"].",".$row["state"].",".$row["country"]; ?>
                                </div>
                                <div class="col col-sm-2 text-left">
                                    <a class="remove_degree btn btn-danger btn-sm">Remove</a>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <?php }
                        } ?>
                    </div>
                    <div id="residency_list_edit">
                        <?php
                        if($residencys){
                            foreach ($residencys as $row){ 
                                ?>
                            <div class="row-wrapper well-purple padding_5" data-val="<?php echo $row["id"]; ?>" >
                                <div class="col col-sm-5 text-left">
                                    <strong><?php echo $row["institution"]; ?></strong><br>
                                    <?php echo $row["city"].",".$row["state"].",".$row["country"]; ?>
                                </div>
                                <div class="col col-sm-4 text-left">
                                    <?php 
                                    $speciality =  get_specialties($row["speciality"]); 
                                    $sub_speciality =  get_specialties($row["sub_speciality"]); 
                                    echo ( isset($speciality['name']) ) ? $speciality['name'] : "";
                                    echo ( isset($sub_speciality['name']) ) ? ", ".$sub_speciality['name'] : "";
                                    ?>
                                    <br>
                                    <?php echo date("Y-m-d",$row["date_from"])." - ".date("Y-m-d",$row["date_to"]); ?>
                                </div>
                                <div class="col col-sm-2 text-left">
                                    <a class="remove_residency btn btn-danger btn-sm">Remove</a>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <?php }
                        } ?>
                    </div>
                    <div id="fellowship_list_edit">
                        <?php
                        if($fellowships){
                            foreach ($fellowships as $row){ 
                                ?>
                            <div class="row-wrapper well-yellow padding_5" data-val="<?php echo $row["id"]; ?>" >
                                <div class="col col-sm-5 text-left">
                                    <strong><?php echo $row["institution"]; ?></strong><br>
                                    <?php echo $row["city"].",".$row["state"].",".$row["country"]; ?>
                                </div>
                                <div class="col col-sm-4 text-left">
                                    <?php 
                                    $speciality =  get_specialties($row["speciality"]); 
                                    $sub_speciality =  get_specialties($row["sub_speciality"]); 
                                    echo ( isset($speciality['name']) ) ? $speciality['name'] : "";
                                    echo ( isset($sub_speciality['name']) ) ? ", ".$sub_speciality['name'] : "";
                                    ?>
                                    <br>
                                    <?php echo date("Y-m-d",$row["date_from"])." - ".date("Y-m-d",$row["date_to"]); ?>
                                </div>
                                <div class="col col-sm-2 text-left">
                                    <a class="remove_fellowship btn btn-danger btn-sm">Remove</a>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <?php }
                        } ?>
                    </div>
                
                </div>
                <div>
                    <a id="education_cancel" class="edit_link"><span class="glyphicon glyphicon-ok"></span> Done</a>
                </div>
                
                <div class="clearfix"></div>
                <div id="toolbar_education" class="form_btn_bar_2">
                    <a id="add_degree" class="btn btn-blue btn-sm" >
                        <span class="glyphicon glyphicon-check"></span> Add Degree
                    </a>
                    <a id="add_residency" class="btn btn-purple btn-sm" >
                        <span class="glyphicon glyphicon-check"></span> Add Residency
                    </a>
                    <a id="add_fellowship" class="btn btn-warning btn-sm" >
                        <span class="glyphicon glyphicon-check"></span> Add Fellowship
                    </a>
                </div>
                
                <div id="add_degree_block" class="well-blue col-lg-12 block-toggle" style="padding: 5%; display: none; width: 85%;" >
                    <form id="add_degree_form" method="post"> 
                        
                        <div class="left_col">
                            <input class="ng-valid ng-dirty form-control degree_text" id="degree_school"  name="degree_school" placeholder="School" type="text" required >
                        </div>
                        <div class="right_col">
                            <input class="ng-valid ng-dirty form-control degree_text" id="degree_name" name="degree_name" placeholder="Degree" type="text" required >
                        </div>
                        <div class="left_col">
                            <input class="dateMask ng-valid ng-dirty form-control degree_text" id="degree_city" name="degree_city" placeholder="City" type="text" required >
                        </div>
                        <div class="right_col">
                            <select class="form-control degree_text" name="degree_state" id="degree_state" required style="width: 40%; float: left; margin-right: 7px;">
                                <option value="">State</option>
                                <?php 
                                $states = get_states( array("country"=>"US") ); 
                                foreach($states as $state){ ?>
                                    <option value="<?php echo $state["code"] ?>"><?php echo $state["code"] ?></option>
                                <?php } ?>
                            </select>
                            
                            <input style="float: left; width: 55%;" class="ng-valid ng-dirty form-control degree_text" id="degree_country" name="degree_country" placeholder="Country" type="text" required >
                        </div>
                        
                        <div class="left_col">
                            <input class="ng-valid ng-dirty form-control degree_text" id="degree_year"  name="degree_year" placeholder="Year" type="text" required >
                        </div>
                        <div class="right_col">
                            <div style="text-align: left; margin-top:10px;">
                            <lable for="med_school"> Med School&nbsp;&nbsp;</lable>
                            <input class="" name="med_school" id="med_school" value="yes" type="checkbox">
                            </div>
                        </div>
                            
                             
                        <div class="col col-sm-12 text-center" style="margin-top: 15px; padding-left: 15px; clear: both;">
                            <a class="btn btn-primary btn-sm" id="add_degree_btn" >Add</a>
                            <a class="btn btn-primary btn-sm" id="cancel_degree_btn" >Cancel</a>
                        </div>
                    </form>
                </div>
                <div id="add_residency_block" class="well-purple col-lg-12 block-toggle" style="padding: 5%; display: none; width: 85%; " >
                    <form id="add_residency_form" method="post">
                    
                    <div class="left_col">
                        <input class="ng-valid ng-dirty form-control degree_text" id="res_institution"  name="res_institution" placeholder="Institution" type="text" required >
                    </div>
                    <div class="right_col">
                        
                    </div>
                    <div class="left_col">
                        <input class="ng-valid ng-dirty form-control degree_text" id="res_date_from"  name="res_date_from" placeholder="From" type="text" required >
                    </div>
                    <div class="right_col">
                        <input class="ng-valid ng-dirty form-control degree_text" id="res_date_to" name="res_date_to" placeholder="To" type="text" required >
                    </div>
                    <div class="left_col">
                        <input class="dateMask ng-valid ng-dirty form-control degree_text" id="res_city" name="res_city" placeholder="City" type="text" required >
                    </div>
                    <div class="right_col">
                        <select class="form-control degree_text" name="res_state" id="res_state" required style="width: 40%; float: left; margin-right: 7px;">
                            <option value="">State</option>
                            <?php 
                            $states = get_states( array("country"=>"US") ); 
                            foreach($states as $state){ ?>
                                <option value="<?php echo $state["code"] ?>"><?php echo $state["code"] ?></option>
                            <?php } ?>
                        </select>

                        <input style="float: left; width: 55%;" class="ng-valid ng-dirty form-control degree_text" id="res_country" name="res_country" placeholder="Country" type="text" required >
                    </div>
                        
                    <div class="left_col">
                        <select id="res_specialty" name="res_specialty" class="ng-pristine ng-valid form-control" required>
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
                        <select id="res_sub_specialty" name="res_sub_specialty" class="ng-pristine ng-valid form-control sub_speciality" required>
                            <option value="">Sub Specialty</option>
                        </select>
                    </div>
                    
                    <div class="col col-sm-12 text-center" style="margin-top: 15px; padding-left: 15px; clear: both;">
                        <a class="btn btn-primary btn-sm" id="add_residency_btn" >Add</a>
                        <a class="btn btn-primary btn-sm" id="cancel_residency_btn" >Cancel</a>
                    </div>
                    </form>
                </div>
                <div id="add_fellowship_block" class="well-yellow col-lg-12 block-toggle" style="padding: 5%; display: none; width: 85%; " >
                    <form id="add_fellowship_form" method="post">
                    
                    <div class="left_col">
                        <input class="ng-valid ng-dirty form-control degree_text" id="fac_institution"  name="fac_institution" placeholder="Institution" type="text" required >
                    </div>
                    <div class="right_col">
                        
                    </div>
                    <div class="left_col">
                        <input class="ng-valid ng-dirty form-control degree_text" id="fac_date_from"  name="fac_date_from" placeholder="From" type="text" required >
                    </div>
                    <div class="right_col">
                        <input class="ng-valid ng-dirty form-control degree_text" id="fac_date_to" name="fac_date_to" placeholder="To" type="text" required >
                    </div>
                    <div class="left_col">
                        <input class="dateMask ng-valid ng-dirty form-control degree_text" id="fac_city" name="fac_city" placeholder="City" type="text" required >
                    </div>
                    <div class="right_col">
                        <select class="form-control degree_text" name="fac_state" id="fac_state" required style="width: 40%; float: left; margin-right: 7px;">
                            <option value="">State</option>
                            <?php 
                            $states = get_states( array("country"=>"US") ); 
                            foreach($states as $state){ ?>
                                <option value="<?php echo $state["code"] ?>"><?php echo $state["code"] ?></option>
                            <?php } ?>
                        </select>

                        <input style="float: left; width: 55%;" class="ng-valid ng-dirty form-control degree_text" id="fac_country" name="fac_country" placeholder="Country" type="text" required >
                    </div>
                        
                    <div class="left_col">
                        <select id="fac_specialty" name="fac_specialty" class="ng-pristine ng-valid form-control" required>
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
                        <select id="fac_sub_specialty" name="fac_sub_specialty" class="ng-pristine ng-valid form-control sub_speciality" required>
                            <option value="">Sub Specialty</option>
                        </select>
                    </div>
                    
                    <div class="col col-sm-12 text-center" style="margin-top: 15px; padding-left: 15px; clear: both;">
                        <a class="btn btn-primary btn-sm" id="add_fellowship_btn" >Add</a>
                        <a class="btn btn-primary btn-sm" id="cancel_fellowship_btn" >Cancel</a>
                    </div>
                    </form>
                </div>
                
                <div class="clearfix"></div>
            </div>
        </div>
        
        <!--Practice Section-->
        <div id="practiceC">
            <div id="practice_block">
                <div style="float: left; width: 85%; padding-left: 10px; font-size: 15px;">
                    <h3 class="profile_heading2">Practices</h3>
                    
                    <div id="practice_list">
                        <?php
                        if($practices){
                            foreach ($practices as $row){ 
                                ?>
                                <div class="row-wrapper well-blue padding_5" data-val="<?php echo $row["id"]; ?>" >
                                    <div class="col col-sm-5 text-left">
                                        <strong><?php echo $row["hospital_name"]; ?></strong><br>
                                        <?php 
                                        echo $row["facility_type"].",".$row["job_title"];
                                        ?>
                                    </div>
                                    <div class="col col-sm-4 text-left">
                                        <?php echo date("Y-m-d",$row["start_date"])." - ".date("Y-m-d",$row["end_date"]); ?><br>
                                        <?php 
                                        echo $row["city"].",".$row["state"];
                                        ?>
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
                    <a id="practice_edit_link" class="edit_link"><span class="glyphicon glyphicon-pencil"></span> Edit</a>
                </div>

            </div>
            <div id="practice_edit" style="display: none;">
                <div style="float: left; width: 85%; padding-left: 10px; font-size: 15px;">
                <h3 class="profile_heading2">Practices</h3>
                <div id="practice_rsp" class="" style="display: none;"></div>
                    <div id="practice_list_edit">
                        <?php
                        if($practices){
                            foreach ($practices as $row){ 
                                ?>
                                <div class="row-wrapper well-blue padding_5" data-val="<?php echo $row["id"]; ?>" >
                                    <div class="col col-sm-5 text-left">
                                        <strong><?php echo $row["hospital_name"]; ?></strong><br>
                                        <?php 
                                        echo $row["facility_type"].",".$row["job_title"];
                                        ?>
                                    </div>
                                    <div class="col col-sm-4 text-left">
                                        <?php echo date("Y-m-d",$row["start_date"])." - ".date("Y-m-d",$row["end_date"]); ?><br>
                                        <?php 
                                        echo $row["city"].",".$row["state"];
                                        ?>
                                    </div>
                                    <div class="col col-sm-2 text-left">
                                        <a class="remove_practice btn btn-danger btn-sm">Remove</a>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            <?php }
                        } ?>
                    </div>
                </div>
                <div>
                    <a id="practice_cancel" class="edit_link"><span class="glyphicon glyphicon-ok"></span> Done</a>
                </div>
                
                <div class="clearfix"></div>
                <div id="toolbar_practice" class="form_btn_bar_2">
                    <a id="add_practice" class="btn btn-blue btn-sm" >
                        <span class="glyphicon glyphicon-check"></span> Add Practice
                    </a>
                </div>
                
                <div id="add_practice_block" class="well-blue col-lg-12 block-toggle" style="padding: 5%; display: none; width: 85%;" >
                    <form id="add_practice_form"> 
                        
                        <div class="left_col">
                            <input class="dateMask ng-valid ng-dirty form-control practice_text" id="job_title" name="job_title" placeholder="Job Title" type="text" required >
                        </div>
                        <div class="right_col">
                            
                            <input style="float: left; width: 55%;" class="ng-valid ng-dirty form-control practice_text" id="city" name="city" placeholder="City" type="text" required >
                            
                            <select class="form-control practice_text" name="state" id="state" required style="width: 40%; float: left; margin-right: 7px;">
                                <option value="">State</option>
                                <?php 
                                $states = get_states( array("country"=>"US") ); 
                                foreach($states as $state){ ?>
                                    <option value="<?php echo $state["code"] ?>"><?php echo $state["code"] ?></option>
                                <?php } ?>
                            </select>
                            
                        </div>
                        
                        <div class="left_col">
                            <input class="ng-valid ng-dirty form-control practice_text" id="hospital_name"  name="hospital_name" placeholder="Hospital Name" type="text" required >
                        </div>
                        <div class="right_col">
                            <input class="ng-valid ng-dirty form-control practice_text" id="start_date" name="start_date" placeholder="Start Date" type="text" required >
                        </div>
                        
                        <div class="left_col">
                            <input class="ng-valid ng-dirty form-control practice_text" id="facility_type"  name="facility_type" placeholder="Facility Type" type="text" required >
                        </div>
                        <div class="right_col">
                            <input class="ng-valid ng-dirty form-control practice_text" id="end_date"  name="end_date" placeholder="End date" type="text" required >
                        </div>
                            
                             
                        <div class="col col-sm-12 text-center" style="margin-top: 15px; padding-left: 15px; clear: both;">
                            <a class="btn btn-primary btn-sm" id="add_practice_btn" >Add</a>
                            <a class="btn btn-primary btn-sm" id="cancel_practice_btn" >Cancel</a>
                        </div>
                    </form>
                </div>
                
                <div class="clearfix"></div>
            </div>
        </div>
        
        <br>
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

<script>
    // certification script
    
    var total_license = '<?php echo $total_license; ?>';
    var total_cert = '<?php echo $total_cert; ?>';
    $("#cert_issued_on").datepicker( {"dateFormat":"yy-mm-dd" } );
    $("#licenseIssued").datepicker( {"dateFormat":"yy-mm-dd" } );
    
    $("#tabContent").on("click","#certification_cancel",function(){
        if(total_license <= 0 || total_cert <= 0){
            $("#certification_rsp").html("Must add at least one of each");
            $("#certification_rsp").addClass("error_rsp").show();
        }
        else{
            $("#certification_block").show();
            $("#certification_edit").hide();
        }
    });
    
    $("#add_license").click(function(){
        
        $(".block-toggle").hide();
        $("#add_license_block").show();
        
        $(".license_text").val("");
        $(this).removeClass("error");
    });
    $("#add_certification").click(function(){
        $(".block-toggle").hide();
        $("#add_certification_block").show();
        
        $(".cert_text").val("");
        $(this).removeClass("error");
    });
    $("#cancel_certification_btn").click(function(){
        $("#add_certification_block").hide();
        $("#toolbar").show();
        
        $(".license_text").val("");
    });
    $("#cancel_license_btn").click(function(){
        $("#add_license_block").hide();
        $("#toolbar").show();
        
        $(".cert_text").val("");
    });
    
    $("#add_license_btn").click(function(){
        
        $("#tabContent_rsp").html("").hide();
        $("#tabContent_rsp").removeClass();
        
        var valid = $("#add_license_form").valid();
        if(valid === true){
            $.ajax({
                type: "POST",
                url: SITE_URL+"job_seeker_dashboard/add_license_process",
                dataType: "json",
                data: {
                    licence_type : $.trim($("#licenseType").val()),
                    licence_number : $.trim($("#licenseNumber").val()),
                    issued_on : $.trim($("#licenseIssued").val()),
                    state : $.trim($("#state").val()),
                    federal: $("input[name='federal']:checked").val(),
                    is_profile: 'true'
                },
            }).success(function(rsp){
                if(rsp.status === "ok"){
                    // continue then
                    $("#license_list").append(rsp.html2);
                    $("#license_list_edit").append(rsp.html);
                    
                    $("#add_license_block").hide();
                    $("#toolbar").show();
                    
                    $(".license_text").val("");
                    total_license++;
                }
                else{
                    $("#tabContent_rsp").html(rsp.msg).show();
                    $("#tabContent_rsp").addClass("error_rsp");
                }
            })
            .always(function(){
                FBox.fancybox.hideLoading();
            });
        }
    });
    $("#add_certification_btn").click(function(){
        
        $("#tabContent_rsp").html("").hide();
        $("#tabContent_rsp").removeClass();
        
        var valid = $("#add_certification_form").valid();
        if(valid === true){
            $.ajax({
                type: "POST",
                url: SITE_URL+"job_seeker_dashboard/add_certification_process",
                dataType: "json",
                data: {
                    name : $.trim($("#cert_name").val()),
                    issued_on : $.trim($("#cert_issued_on").val()),
                    is_profile: 'true'
                }
            }).success(function(rsp){
                if(rsp.status === "ok"){
                    // continue then
                    $("#certification_list").append(rsp.html2);
                    $("#certification_list_edit").append(rsp.html);
                    
                    $("#add_certification_block").hide();
                    $("#toolbar").show();
                    
                    $(".cert_text").val("");
                    total_cert++;
                }
                else{
                    $("#tabContent_rsp").html(rsp.msg).show();
                    $("#tabContent_rsp").addClass("error_rsp");
                }
            })
            .always(function(){
                FBox.fancybox.hideLoading();
            });
        }
    });
    
    $("#tabContent").on("click",".remove_license",function(e){
        
        e.stopImmediatePropagation();
        
        $("#tabContent_rsp").html("").hide();
        $("#tabContent_rsp").removeClass();
        var element = $(this).parent().parent();
        var id = $(this).parent().parent().attr("data-val");
        $.ajax({
            type: "POST",
            url: SITE_URL+"job_seeker_dashboard/delete_license",
            dataType: "json",
            data: {
                id : id
            },
        }).success(function(rsp){
            if(rsp.status === "ok"){
                // continue then
                var data_val = element.attr("data-val");
                $("#license_list div[data-val='"+data_val+"']").remove();
                $(element).remove();
                
                total_license--;
            }
            else{
                $("#tabContent_rsp").html(rsp.msg).show();
                $("#tabContent_rsp").addClass("error_rsp");
            }
        })
        .always(function(){
            FBox.fancybox.hideLoading();
        });
        
    });
    
    $("#tabContent").on("click",".remove_certification",function(e){
        e.stopImmediatePropagation();
    
        $("#tabContent_rsp").html("").hide();
        $("#tabContent_rsp").removeClass();
        var element = $(this).parent().parent();
        var id = $(this).parent().parent().attr("data-val");
        $.ajax({
            type: "POST",
            url: SITE_URL+"job_seeker_dashboard/delete_certification",
            dataType: "json",
            data: {
                id : id
            },
        }).success(function(rsp){
            if(rsp.status === "ok"){
                // continue then
                var data_val = element.attr("data-val");
                $("#certification_list div[data-val='"+data_val+"']").remove();
                $(element).remove();
                total_cert--;
            }
            else{
                $("#tabContent_rsp").html(rsp.msg).show();
                $("#tabContent_rsp").addClass("error_rsp");
            }
        })
        .always(function(){
            FBox.fancybox.hideLoading();
        });
        
    });
    
    // education script
    var total_degrees = '<?php echo $total_degrees; ?>';
    var total_residencys = '<?php echo $total_residencys; ?>';
    var total_fellowships = '<?php echo $total_fellowships; ?>';
    
    $("#degree_year").datepicker(
        {
            "dateFormat":"yy",
            changeYear: true,
            showButtonPanel: true
        }
    );
    
     
    $("#res_date_from").datepicker( {"dateFormat":"yy-mm-dd" } );
    $("#res_date_to").datepicker( {"dateFormat":"yy-mm-dd" } );
    $("#fac_date_from").datepicker( {"dateFormat":"yy-mm-dd" } );
    $("#fac_date_to").datepicker( {"dateFormat":"yy-mm-dd" } );
    
    $("#tabContent").on("click","#education_cancel",function(){
        if(total_degrees <= 0 || total_residencys <= 0 || total_fellowships <= 0 ){
            $("#education_rsp").html("Must add at least one of each");
            $("#education_rsp").addClass("error_rsp").show();
        }
        else{
            $("#education_block").show();
            $("#education_edit").hide();
        }
    });
     
    
    $("#add_degree").click(function(){
        
        $(".block-toggle").hide();
        $("#add_degree_block").show();
        
        $(".degree_text").val("");
        $(this).removeClass("error");
    });
     
    $("#cancel_degree_btn").click(function(){
        $("#add_degree_block").hide();
        $("#toolbar").show();
        
        $(".degree_text").val("");
    });
    
    $("#add_degree_btn").click(function(){
        
        $("#tabContent_rsp").html("").hide();
        $("#tabContent_rsp").removeClass();
        
        var valid = $("#add_degree_form").valid();
        if(valid === true){
            $.ajax({
                type: "POST",
                url: SITE_URL+"job_seeker_dashboard/add_degree_process",
                dataType: "json",
                data: {
                    school : $.trim($("#degree_school").val()),
                    degree : $.trim($("#degree_name").val()),
                    city : $.trim($("#degree_city").val()),
                    state : $.trim($("#degree_state").val()),
                    country : $.trim($("#degree_country").val()),
                    year : $.trim($("#degree_year").val()),
                    med_school: $("#med_school").is(":checked"),
                    is_profile: 'true'
                }
            }).success(function(rsp){
                if(rsp.status === "ok"){
                    // continue then
                    $("#degree_list").append(rsp.html2);
                    $("#degree_list_edit").append(rsp.html);
                    
                    $("#add_degree_block").hide();
                    $("#toolbar").show();
                    
                    $(".degree_text").val("");
                    total_degrees++;
                }
                else{
                    $("#tabContent_rsp").html(rsp.msg).show();
                    $("#tabContent_rsp").addClass("error_rsp");
                }
            })
            .always(function(){
                FBox.fancybox.hideLoading();
            });
        }
    });
    
    $("#tabContent").on("click",".remove_degree",function(e){
        e.stopImmediatePropagation();
        
        $("#tabContent_rsp").html("").hide();
        $("#tabContent_rsp").removeClass();
        var element = $(this).parent().parent();
        var id = $(this).parent().parent().attr("data-val");
        $.ajax({
            type: "POST",
            url: SITE_URL+"job_seeker_dashboard/delete_degree",
            dataType: "json",
            data: {
                id : id
            },
        }).success(function(rsp){
            if(rsp.status === "ok"){
                // continue then
                var data_val = element.attr("data-val");
                $("#degree_list div[data-val='"+data_val+"']").remove();
                $(element).remove();
                total_degrees--;
            }
            else{
                $("#tabContent_rsp").html(rsp.msg).show();
                $("#tabContent_rsp").addClass("error_rsp");
            }
        })
        .always(function(){
            FBox.fancybox.hideLoading();
        });
        
    });
    
    
    $("#add_residency").click(function(){
        
        $(".block-toggle").hide();
        $("#add_residency_block").show();
        
        $(".residency_text").val("");
        $(this).removeClass("error");
    });
     
    $("#cancel_residency_btn").click(function(){
        $("#add_residency_block").hide();
        $("#toolbar").show();
        
        $(".residency_text").val("");
    });
    
    $("#add_residency_btn").click(function(){
        
        $("#tabContent_rsp").html("").hide();
        $("#tabContent_rsp").removeClass();
        
        var valid = $("#add_residency_form").valid();
        if(valid === true){
            $.ajax({
                type: "POST",
                url: SITE_URL+"job_seeker_dashboard/add_residency_process",
                dataType: "json",
                data: {
                    institution : $.trim($("#res_institution").val()),
                    date_from : $.trim($("#res_date_from").val()),
                    date_to : $.trim($("#res_date_to").val()),
                    city : $.trim($("#res_city").val()),
                    state : $.trim($("#res_state").val()),
                    country : $.trim($("#res_country").val()),
                    specialty: $.trim($("#res_specialty").val()),
                    sub_specialty: $.trim($("#res_sub_specialty").val()),
                    is_profile: 'true'
                }
            }).success(function(rsp){
                if(rsp.status === "ok"){
                    // continue then
                    $("#residency_list").append(rsp.html2);
                    $("#residency_list_edit").append(rsp.html);
                    
                    $("#add_residency_block").hide();
                    $("#toolbar").show();
                    
                    $(".residency_text").val("");
                    total_residencys++;
                }
                else{
                    $("#tabContent_rsp").html(rsp.msg).show();
                    $("#tabContent_rsp").addClass("error_rsp");
                }
            })
            .always(function(){
                FBox.fancybox.hideLoading();
            });
        }
    });
    
        
    
    $("#tabContent").on("click",".remove_residency",function(e){
        e.stopImmediatePropagation();
        
        $("#tabContent_rsp").html("").hide();
        $("#tabContent_rsp").removeClass();
        var element = $(this).parent().parent();
        var id = $(this).parent().parent().attr("data-val");
        $.ajax({
            type: "POST",
            url: SITE_URL+"job_seeker_dashboard/delete_residency",
            dataType: "json",
            data: {
                id : id
            },
        }).success(function(rsp){
            if(rsp.status === "ok"){
                // continue then
                var data_val = element.attr("data-val");
                $("#residency_list div[data-val='"+data_val+"']").remove();
                $(element).remove();
                total_residencys--;
            }
            else{
                $("#tabContent_rsp").html(rsp.msg).show();
                $("#tabContent_rsp").addClass("error_rsp");
            }
        })
        .always(function(){
            FBox.fancybox.hideLoading();
        });
        return false;
    });
     
     
     $(document).on("change","#res_specialty",function(){
        parent_speciality_change_residence(); 
     });
     function parent_speciality_change_residence(){
        if($("#res_specialty").val() !== ""){
            $.ajax({
                type: "POST",
                url: SITE_URL+"job_seeker/get_specialties/sub",
                data: {
                    parent_id : $.trim($("#res_specialty").val()),
                    options: 'true'
                },
                dataType: "json",
            }).success(function(rsp){
                $("#res_sub_specialty").html(rsp.html); 
            });
        }
    }
    
    
    $("#add_fellowship").click(function(){
        
        $(".block-toggle").hide();
        $("#add_fellowship_block").show();
        
        $(".fellowship_text").val("");
        $(this).removeClass("error");
    });
     
    $("#cancel_fellowship_btn").click(function(){
        $("#add_fellowship_block").hide();
        $("#toolbar").show();
        
        $(".fellowship_text").val("");
    });
    
    $("#add_fellowship_btn").click(function(){
        
        $("#tabContent_rsp").html("").hide();
        $("#tabContent_rsp").removeClass();
        
        var valid = $("#add_fellowship_form").valid();
        if(valid === true){
            $.ajax({
                type: "POST",
                url: SITE_URL+"job_seeker_dashboard/add_fellowship_process",
                dataType: "json",
                data: {
                    institution : $.trim($("#fac_institution").val()),
                    date_from : $.trim($("#fac_date_from").val()),
                    date_to : $.trim($("#fac_date_to").val()),
                    city : $.trim($("#fac_city").val()),
                    state : $.trim($("#fac_state").val()),
                    country : $.trim($("#fac_country").val()),
                    specialty: $.trim($("#fac_specialty").val()),
                    sub_specialty: $.trim($("#fac_sub_specialty").val()),
                    is_profile: 'true'
                }
            }).success(function(rsp){
                if(rsp.status === "ok"){
                    // continue then
                    $("#fellowship_list").append(rsp.html2);
                    $("#fellowship_list_edit").append(rsp.html);
                    
                    $("#add_fellowship_block").hide();
                    $("#toolbar").show();
                    
                    $(".fellowship_text").val("");
                    total_fellowships++;
                }
                else{
                    $("#tabContent_rsp").html(rsp.msg).show();
                    $("#tabContent_rsp").addClass("error_rsp");
                }
            })
            .always(function(){
                FBox.fancybox.hideLoading();
            });
        }
    });
    
        
    
    $("#tabContent").on("click",".remove_fellowship",function(e){
        e.stopImmediatePropagation();
        
        $("#tabContent_rsp").html("").hide();
        $("#tabContent_rsp").removeClass();
        var element = $(this).parent().parent();
        var id = $(this).parent().parent().attr("data-val");
        $.ajax({
            type: "POST",
            url: SITE_URL+"job_seeker_dashboard/delete_fellowship",
            dataType: "json",
            data: {
                id : id
            },
        }).success(function(rsp){
            if(rsp.status === "ok"){
                // continue then
                var data_val = element.attr("data-val");
                $("#fellowship_list div[data-val='"+data_val+"']").remove();
                $(element).remove();
                total_fellowships--;
            }
            else{
                $("#tabContent_rsp").html(rsp.msg).show();
                $("#tabContent_rsp").addClass("error_rsp");
            }
        })
        .always(function(){
            FBox.fancybox.hideLoading();
        });
        return false;
    });
     
     
     $(document).on("change","#fac_specialty",function(){
        parent_speciality_change_faculty(); 
     });
     function parent_speciality_change_faculty(){
        if($("#fac_specialty").val() !== ""){
            $.ajax({
                type: "POST",
                url: SITE_URL+"job_seeker/get_specialties/sub",
                data: {
                    parent_id : $.trim($("#fac_specialty").val()),
                    options: 'true'
                },
                dataType: "json",
            }).success(function(rsp){
                $("#fac_sub_specialty").html(rsp.html); 
            });
        }
    }
    
    // practice script
    
    var total_practices = '<?php echo $total_practices; ?>';
     
    $("#start_date").datepicker( {"dateFormat":"yy-mm-dd" } );
    $("#end_date").datepicker( {"dateFormat":"yy-mm-dd" } );
    
    $("#add_practice").click(function(){
        
        $(".block-toggle").hide();
        $("#add_practice_block").show();
        
        $(".practice_text").val("");
        $(this).removeClass("error");
    });
    
    $("#tabContent").on("click","#practice_cancel",function(){
        $("#practice_block").show();
        $("#practice_edit").hide();
    });
    
    $("#cancel_practice_btn").click(function(){
        $("#add_practice_block").hide();
        $("#toolbar").show();
        
        $(".practice_text").val("");
    });
    
    $("#add_practice_btn").click(function(){
        
        $("#tabContent_rsp").html("").hide();
        $("#tabContent_rsp").removeClass();
        
        var valid = $("#add_practice_form").valid();
        if(valid === true){
            $.ajax({
                type: "POST",
                url: SITE_URL+"job_seeker_dashboard/add_practice_process",
                dataType: "json",
                data: {
                    job_title : $.trim($("#job_title").val()),
                    city : $.trim($("#city").val()),
                    state : $.trim($("#state").val()),
                    hospital_name : $.trim($("#hospital_name").val()),
                    facility_type : $.trim($("#facility_type").val()),
                    start_date : $.trim($("#start_date").val()),
                    end_date : $.trim($("#end_date").val()),
                    is_profile: 'true'
                }
            }).success(function(rsp){
                if(rsp.status === "ok"){
                    // continue then
                    $("#practice_list").append(rsp.html2);
                    $("#practice_list_edit").append(rsp.html);
                    
                    $("#add_practice_block").hide();
                    $("#toolbar").show();
                    
                    $(".practice_text").val("");
                    total_practices++;
                }
                else{
                    $("#tabContent_rsp").html(rsp.msg).show();
                    $("#tabContent_rsp").addClass("error_rsp");
                }
            })
            .always(function(){
                FBox.fancybox.hideLoading();
            });
        }
    });
    
    $("#tabContent").on("click",".remove_practice",function(e){
        e.stopImmediatePropagation();
        
        $("#tabContent_rsp").html("").hide();
        $("#tabContent_rsp").removeClass();
        var element = $(this).parent().parent();
        var id = $(this).parent().parent().attr("data-val");
        $.ajax({
            type: "POST",
            url: SITE_URL+"job_seeker_dashboard/delete_practice",
            dataType: "json",
            data: {
                id : id
            },
        }).success(function(rsp){
            if(rsp.status === "ok"){
                // continue then
                var data_val = element.attr("data-val");
                $("#practice_list div[data-val='"+data_val+"']").remove();
                
                $(element).remove();
                total_practices--;
            }
            else{
                $("#tabContent_rsp").html(rsp.msg).show();
                $("#tabContent_rsp").addClass("error_rsp");
            }
        })
        .always(function(){
            FBox.fancybox.hideLoading();
        });
        
    });
    
</script>

