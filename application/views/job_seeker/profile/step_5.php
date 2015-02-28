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
            <?php echo load_img("fifth-step.png"); ?>
        </p>
        <h3>Practice</h3>
        <div style="min-height: 300px;">
            <fieldset style="float: none; margin: 0 auto; padding: 0; width: 480px;">
                
                <div class="clearfix "></div>
                
                <div id="practice_list">
                    <?php
                    if($practices){
                        foreach ($practices as $row){ 
                            ?>
                        <div class="row well-blue padding_5" data-val="<?php echo $row["id"]; ?>" >
                            <div class="col col-sm-5 text-left">
                                <strong><?php echo $row["hospital_name"]; ?></strong><br>
                                <?php 
                                echo $row["facility_type"].",".$row["job_title"];
                                ?>
                            </div>
                            <div class="col col-sm-5 text-left">
                                <?php echo date("Y-m-d",$row["start_date"])."-".date("Y-m-d",$row["end_date"]); ?><br>
                                <?php 
                                echo $row["city"].",".$row["state"];
                                ?>
                            </div>
                            <div class="col col-sm-2 text-left">
                                <a class="remove_practice btn btn-danger btn-sm">Remove</a>
                            </div>
                        </div>
                        <?php }
                    } ?>
                </div>
                 
                 

                    
                <div id="toolbar" class="col-lg-12 block-toggle" style="padding: 5%;" >
                    <a id="add_practice" class="btn btn-blue btn-sm" >
                        <span class="glyphicon glyphicon-check"></span> Add Practice
                    </a>
                    <br>
                </div>
                
                <div class="clearfix space-row-10"></div>

                <div id="add_practice_block" class="well-blue col-lg-12 block-toggle" style="padding: 5%; display: none;" >
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
                <div class="clearfix space-row-10 "></div>

                 
                
                
            </fieldset>
        </div>


        <div style="text-align: center; margin-top: 20px;">
            <a href="javascript:void(0)" class="profile-back" data-backTo="4" >Back</a>&nbsp;
            <a href="javascript:void(0)" class="btn btn-lg btn-primary profile_steps_continue" data-step="continue-step5" data-stepTo="6" data-formValidate="form_profileStep5">Continue</a>
        </div>
</div>
<script>
    
    var total_practices = '<?php echo $total_practices; ?>';
    
        
     
    $("#start_date").datepicker( {"dateFormat":"yy-mm-dd" } );
    $("#end_date").datepicker( {"dateFormat":"yy-mm-dd" } );
    
     
    $("#add_practice_form").validate({
        errorPlacement: function(error, element) {
        },
        submitHandler: function(form) {
        }
    });
    
    $("#add_practice").click(function(){
        
        $(".block-toggle").hide();
        $("#add_practice_block").show();
        
        $(".practice_text").val("");
        $(this).removeClass("error");
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
                    end_date : $.trim($("#end_date").val())
                }
            }).success(function(rsp){
                if(rsp.status === "ok"){
                    // continue then
                    $("#practice_list").append(rsp.html);
                    
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