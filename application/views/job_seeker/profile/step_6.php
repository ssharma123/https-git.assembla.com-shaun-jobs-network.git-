<style>
    .space-row-10{
        margin-top: 20px;
        margin-bottom: 20px;
    }
    .padding_5{
        padding: 15px;
    } 
    #search_location_list{
        margin-bottom: 10px;
    }
</style>
 
<?php echo load_js("ajaxfileupload.js"); ?>

<div class="col-sm-10 col-sm-offset-1 text-center" >
        
        <h3>Almost done, Dr <?php echo $jobseeker['last_name']; ?></h3>
        <h2>What kind of job are you looking for</h2>
        <div style="min-height: 300px;">
            <fieldset style="float: none; margin: 0 auto; padding: 0; width: 480px;">
                
                <div class="clearfix "></div>
                
                <form id="form_profileStep6" method="post">
                    <div class="left_col">
                         <select class="ng-pristine ng-valid form-control" id="position_type" name="position_type" required >
                            <option value="" class="">Position Type</option>
                            <?php
                            $selected = (isset($jobseeker['position_type']) && $jobseeker['position_type'] == "full_time" ) ? ' selected="selected" ' : "" ;
                            ?>
                            <option value="full_time" <?php echo $selected; ?> >Full Time</option>
                            <?php
                            $selected = (isset($jobseeker['position_type']) && $jobseeker['position_type'] == "part_time" ) ? ' selected="selected" ' : "" ;
                            ?>
                            <option value="part_time" <?php echo $selected; ?> >Part Time</option>
                            <?php
                            $selected = (isset($jobseeker['position_type']) && $jobseeker['position_type'] == "locum" ) ? ' selected="selected" ' : "" ;
                            ?>
                            <option value="locum" <?php echo $selected; ?> >Locum</option>
                            <?php
                            $selected = (isset($jobseeker['position_type']) && $jobseeker['position_type'] == "temporary" ) ? ' selected="selected" ' : "" ;
                            ?>
                            <option value="temporary" <?php echo $selected; ?> >Temporary</option>
                        </select>
                    </div>
                    <div class="right_col" >
                        <select class="ng-pristine ng-valid form-control" id="service" name="service" required >
                            <option value="" class="">Service</option>
                            <?php
                            $selected = (isset($jobseeker['service']) && $jobseeker['service'] == "inpatient" ) ? ' selected="selected" ' : "" ;
                            ?>
                            <option value="inpatient" <?php echo $selected; ?> >Inpatient</option>
                            <?php
                            $selected = (isset($jobseeker['service']) && $jobseeker['service'] == "outpatient" ) ? ' selected="selected" ' : "" ;
                            ?>
                            <option value="outpatient" <?php echo $selected; ?> >Outpatient</option>

                        </select>
                    </div>

                    <div class="left_col">
                        <select id="institution_type" name="institution_type" class="ng-pristine ng-valid parent_speciality form-control" required>
                            <option value="">Institution Type</option>
                            <?php
                            $selected = (isset($jobseeker['institution_type']) && $jobseeker['institution_type'] == "academic_institution" ) ? ' selected="selected" ' : "" ;
                            ?>
                            <option value="academic_institution" <?php echo $selected; ?> >Academic Institution</option>
                            <?php
                            $selected = (isset($jobseeker['institution_type']) && $jobseeker['institution_type'] == "clinic" ) ? ' selected="selected" ' : "" ;
                            ?>
                            <option value="clinic" <?php echo $selected; ?>>Clinic</option>
                            <?php
                            $selected = (isset($jobseeker['institution_type']) && $jobseeker['institution_type'] == "group_practice" ) ? ' selected="selected" ' : "" ;
                            ?>
                            <option value="group_practice" <?php echo $selected; ?>>Group Practice</option>
                            <?php
                            $selected = (isset($jobseeker['institution_type']) && $jobseeker['institution_type'] == "hospital" ) ? ' selected="selected" ' : "" ;
                            ?>
                            <option value="hospital" <?php echo $selected; ?>>Hospital</option>
                            <?php
                            $selected = (isset($jobseeker['institution_type']) && $jobseeker['institution_type'] == "private_practice" ) ? ' selected="selected" ' : "" ;
                            ?>
                            <option value="private_practice" <?php echo $selected; ?>>Private Practice</option>
                        </select>
                    </div>
                    <div class="right_col">
                        <input required min="1" type="number" name="patient_per_day" id="patient_per_day" value="<?php echo (isset($jobseeker['patient_per_day']) && $jobseeker['patient_per_day'] != 0) ? $jobseeker['patient_per_day'] : "" ; ?>" class="form-control" placeholder="Patient per day" >
                    </div>
                    <div class="left_col">
                        <input required min="1" type="number" name="salary" id="salary" value="<?php echo (isset($jobseeker['salary']) && $jobseeker['salary'] != 0) ? $jobseeker['salary'] : "" ; ?>" class="form-control" placeholder="Ideal Salary" >
                    </div>
                     
                    <div class="right_col">
                        <select class="ng-pristine ng-valid form-control" required id="availability" name="availability" >
                            <option value="">Availability</option>
                            <?php
                            $selected = (isset($jobseeker['availability']) && $jobseeker['availability'] == "asap" ) ? ' selected="selected" ' : "" ;
                            ?>
                            <option value="asap" <?php echo $selected; ?> >ASAP</option>
                            <?php
                            $selected = (isset($jobseeker['availability']) && $jobseeker['availability'] == "1-3" ) ? ' selected="selected" ' : "" ;
                            ?>
                            <option value="1-3" <?php echo $selected; ?> >1-3 Months</option>
                            <?php
                            $selected = (isset($jobseeker['availability']) && $jobseeker['availability'] == "3-6" ) ? ' selected="selected" ' : "" ;
                            ?>
                            <option value="3-6"  <?php echo $selected; ?> >3-6 Months</option>
                            <?php
                            $selected = (isset($jobseeker['availability']) && $jobseeker['availability'] == "6-12" ) ? ' selected="selected" ' : "" ;
                            ?>
                            <option value="6-12" <?php echo $selected; ?> >6-12 Months</option>
                            <?php
                            $selected = (isset($jobseeker['availability']) && $jobseeker['availability'] == "just_looking" ) ? ' selected="selected" ' : "" ;
                            ?>
                            <option value="just_looking" <?php echo $selected; ?> >Just Looking</option>

                        </select>
                    </div>

                </form>
                <br>
                <br>
                <div style="clear: both;"></div>
                <div class="p_line_main">
                    <div class="search">Search Locations</div>
                </div>
                <div style="text-align: center">
                    <span class="greyText">If you don't want to stay in this area, where do you want to go?</span>
                </div>
                <div style="clear: both;"></div>
                
                
                <div id="search_location_list">
                     <?php
                    if($locations){
                        foreach ($locations as $row){ 
                            ?>
                        <div class="well-blue padding_5" data-val="<?php echo $row["id"]; ?>" >
                            <div class="col col-sm-8 text-left">
                                <?php echo $row["name"]; ?>
                            </div>
                            <div class="col col-sm-2 text-right">
                                <a class="remove_location btn btn-danger btn-sm">Remove</a>
                            </div>
                            <div style="clear: both;"></div>
                        </div>
                    <?php }
                    } ?>
                </div>
                
                <div style="clear: both;"></div>
                
                <form id="add_location_form" method="post">
                <div class="left_col">
                    <input required type="text" name="location_name" id="location_name" placeholder="City / Zip" class="form-control" >
                </div>
                </form>
                <div class="right_col">
                    <a id="add_location" class="btn btn-blue btn-sm" >
                        <span class="glyphicon glyphicon-check"></span> Add Location
                    </a>
                </div>
                
                <div style="clear: both;"></div>
                <div class="p_line_main">
                    <div class="search">Additional Documents & Supplements</div>
                </div>
                <div style="clear: both;"></div>
                <div class="left_col">
                    <input type="file" id="file_document" name="file_document[]" >
                </div>
                <div class="right_col">
                     
                </div>
                <div style="clear: both;"></div><br>
                <div style="text-align: center">
                    <span class="greyText">Upload any & all documents that you may want to present with perspective matches. This will only be seen after a mutual match, not everyone. i.e.: research papers, cover letter, supplement to your CV, grant support, publications, certificate images, etc.</span>
                </div>
                <br>
                
            </fieldset>
        </div>


        <div style="text-align: center; margin-top: 20px;">
            <a href="javascript:void(0)" class="profile-back" data-backTo="5" >Back</a>&nbsp;
            <a href="javascript:void(0)" class="btn btn-lg btn-primary profile_steps_continue" data-step="continue-step6" data-stepTo="7" data-formValidate="form_profileStep5">Continue</a>
        </div>
</div>
<script>
    
    $("#form_profileStep6").validate({
//        errorPlacement: function(error, element) {
//        } 
    });
    $("#add_location_form").validate({
//        errorPlacement: function(error, element) {
//        }
    });
    
    $("#add_location").click(function(){
        
        $("#tabContent_rsp").html("").hide();
        $("#tabContent_rsp").removeClass();
        
        var valid = $("#add_location_form").valid();
        if(valid === true){
            $.ajax({
                type: "POST",
                url: SITE_URL+"job_seeker_dashboard/add_search_location",
                dataType: "json",
                data: {
                    name : $.trim($("#location_name").val())
                }
            }).success(function(rsp){
                if(rsp.status === "ok"){
                    // continue then
                    $("#search_location_list").append(rsp.html);
                    $("#location_name").val("");
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
    
    $("#tabContent").on("click",".remove_location",function(e){
        e.stopImmediatePropagation();
        
        $("#tabContent_rsp").html("").hide();
        $("#tabContent_rsp").removeClass();
        var element = $(this).parent().parent();
        var id = $(this).parent().parent().attr("data-val");
        $.ajax({
            type: "POST",
            url: SITE_URL+"job_seeker_dashboard/delete_location",
            dataType: "json",
            data: {
                id : id
            },
        }).success(function(rsp){
            if(rsp.status === "ok"){
                // continue then
                $(element).remove();
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
    
    function upload_file_document() {
            var file_name = "";
            $.ajaxFileUpload({
//            url: SITE_URL + "employee_dashboard/upload_profile_image",
            url: SITE_URL + "job_seeker_dashboard/upload_document",
            secureuri: false,
            fileElementId: 'file_document',
            dataType: 'json',
            async: false,
            data: { jobseeker_id : '<?php echo $jobseeker['id'] ?>' },
            success: function(rsp, status)
            {
                if (rsp.status === "ok") {
                   // everything is ok   
                }
                else{
                    $("#tabContent_rsp").html(rsp.msg).show();
                    $("#tabContent_rsp").addClass("error_rsp");
                }
            }
        });
        return file_name;

    }
</script>