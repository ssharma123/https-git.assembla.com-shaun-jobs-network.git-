<style>
    .space-row-10{
        margin-top: 20px;
        margin-bottom: 20px;
    }
    .padding_5{
        padding: 15px;
    }
    #license_list{
        margin-bottom: 10px;
    }
    #certification_list{
        margin-bottom: 10px;
    }
    #degree_list,#residency_list{
        margin-bottom:10px;
    }
</style>
<?php 
    
    echo load_css('jquery-ui.css','assets/js/jquery_ui/');
    echo load_js("jquery-ui.js","assets/js/jquery_ui/");
            
?>
<div class="col-sm-10 col-sm-offset-1 text-center" >
        <p>
            <?php echo load_img("fourth-step.png"); ?>
        </p>
        <h3>Education</h3>
        <div style="min-height: 300px;">
            <fieldset style="float: none; margin: 0 auto; padding: 0; width: 480px;">
                
                <div class="clearfix "></div>
                
                <div id="degree_list">
                    <?php
                    if($degrees){
                        foreach ($degrees as $row){ 
                            ?>
                        <div class="row well-blue padding_5" data-val="<?php echo $row["id"]; ?>" >
                            <div class="col col-sm-5 text-left">
                                <strong><?php echo $row["degree"]; ?></strong><br>
                                <?php 
                                $med_school = (isset($row["med_school"]) && $row["med_school"] == "yes" ) ? "(Med School)" : ""; 
                                echo $row["school"].$med_school;
                                ?>
                            </div>
                            <div class="col col-sm-5 text-left">
                                <?php echo date("Y",$row["year"]); ?><br>
                                <?php echo $row["city"].",".$row["state"].",".$row["country"]; ?>
                            </div>
                            <div class="col col-sm-2 text-left">
                                <a class="remove_degree btn btn-danger btn-sm">Remove</a>
                            </div>
                        </div>
                        <?php }
                    } ?>
                </div>
                <div id="residency_list">
                    <?php
                    if($residencys){
                        foreach ($residencys as $row){ 
                            ?>
                        <div class="row well-purple padding_5" data-val="<?php echo $row["id"]; ?>" >
                            <div class="col col-sm-5 text-left">
                                <strong><?php echo $row["institution"]; ?></strong><br>
                                <?php echo $row["city"].",".$row["state"].",".$row["country"]; ?>
                            </div>
                            <div class="col col-sm-5 text-left">
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
                        </div>
                        <?php }
                    } ?>
                </div>
                <div id="fellowship_list">
                    <?php
                    if($fellowships){
                        foreach ($fellowships as $row){ 
                            ?>
                        <div class="row well-yellow padding_5" data-val="<?php echo $row["id"]; ?>" >
                            <div class="col col-sm-5 text-left">
                                <strong><?php echo $row["institution"]; ?></strong><br>
                                <?php echo $row["city"].",".$row["state"].",".$row["country"]; ?>
                            </div>
                            <div class="col col-sm-5 text-left">
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
                        </div>
                        <?php }
                    } ?>
                </div>
                 

                    
                <div id="toolbar" class="col-lg-12 block-toggle" style="padding: 5%;" >
                    <a id="add_degree" class="btn btn-blue btn-sm" >
                        <span class="glyphicon glyphicon-check"></span> Add Degree
                    </a>
                    <a id="add_residency" class="btn btn-purple btn-sm" >
                        <span class="glyphicon glyphicon-check"></span> Add Residency
                    </a>
                    <a id="add_fellowship" class="btn btn-warning btn-sm" >
                        <span class="glyphicon glyphicon-check"></span> Add Fellowship
                    </a>
                    <br>
                    <sup>*</sup> Must add at least one of each
                </div>
                
                <div class="clearfix space-row-10"></div>

                <div id="add_degree_block" class="well-blue col-lg-12 block-toggle" style="padding: 5%; display: none;" >
                    <form id="add_degree_form"> 
                        
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
                <div class="clearfix space-row-10 "></div>

                <div id="add_residency_block" class="well-purple col-lg-12 block-toggle" style="padding: 5%; display: none;" >
                    <form id="add_residency_form">
                    
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
                            <option value="">Field</option>
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
                            <option value="">Concentration</option>
                        </select>
                    </div>
                    
                    <div class="col col-sm-12 text-center" style="margin-top: 15px; padding-left: 15px; clear: both;">
                        <a class="btn btn-primary btn-sm" id="add_residency_btn" >Add</a>
                        <a class="btn btn-primary btn-sm" id="cancel_residency_btn" >Cancel</a>
                    </div>
                    </form>
                </div>
                <div class="clearfix space-row-10"></div>
                
                <div id="add_fellowship_block" class="well-yellow col-lg-12 block-toggle" style="padding: 5%; display: none;" >
                    <form id="add_fellowship_form">
                    
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
                            <option value="">Field</option>
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
                            <option value="">Concentration</option>
                        </select>
                    </div>
                    
                    <div class="col col-sm-12 text-center" style="margin-top: 15px; padding-left: 15px; clear: both;">
                        <a class="btn btn-primary btn-sm" id="add_fellowship_btn" >Add</a>
                        <a class="btn btn-primary btn-sm" id="cancel_fellowship_btn" >Cancel</a>
                    </div>
                    </form>
                </div>
                <div class="clearfix space-row-10"></div>
            
            
                
            </fieldset>
        </div>


        <div style="text-align: center; margin-top: 20px;">
            <a href="javascript:void(0)" class="profile-back" data-backTo="3" >Back</a>&nbsp;
            <a href="javascript:void(0)" class="btn btn-lg btn-primary profile_steps_continue" data-step="continue-step4" data-stepTo="5" data-formValidate="form_profileStep4">Continue</a>
        </div>
</div>
<script>
    
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
    
     
    $("#add_degree_form").validate({
        errorPlacement: function(error, element) {
        },
        submitHandler: function(form) {
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
                    med_school: $("#med_school").is(":checked")
                }
            }).success(function(rsp){
                if(rsp.status === "ok"){
                    // continue then
                    $("#degree_list").append(rsp.html);
                    
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
    
    
    
    $("#add_residency_form").validate({
        errorPlacement: function(error, element) {
        },
        submitHandler: function(form) {
        }
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
                    sub_specialty: $.trim($("#res_sub_specialty").val())
                }
            }).success(function(rsp){
                if(rsp.status === "ok"){
                    // continue then
                    $("#residency_list").append(rsp.html);
                    
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
        else{
            $("#res_sub_specialty").html("<option value='' selected>Concentration</option>");
        }
        
    }
    
    
    $("#add_fellowship_form").validate({
        errorPlacement: function(error, element) {
        },
        submitHandler: function(form) {
        }
    });
    
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
                    sub_specialty: $.trim($("#fac_sub_specialty").val())
                }
            }).success(function(rsp){
                if(rsp.status === "ok"){
                    // continue then
                    $("#fellowship_list").append(rsp.html);
                    
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
        else{
            $("#fac_sub_specialty").html("<option value='' selected>Concentration</option>");
        }
    }
    
</script>