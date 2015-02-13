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
</style>
<?php 
    
    echo load_css('jquery-ui.css','assets/js/jquery_ui/');
    echo load_js("jquery-ui.js","assets/js/jquery_ui/");
            
?>
<div class="col-sm-10 col-sm-offset-1 text-center" >
        <p>
            <?php echo load_img("third-step.png"); ?>
        </p>
        <h3>Licenses and Certifications</h3>
        <div style="min-height: 300px;">
            <fieldset style="float: none; margin: 0 auto; padding: 0; width: 480px;">
                
                <div class="clearfix "></div>
                
                <div id="license_list">
                    <div class="row well-blue padding_5" data-val="1" >
                        <div class="col col-sm-5 text-left">
                            <strong>asdsad</strong><br>
                            asdasda
                        </div>
                        <div class="col col-sm-5 text-left">
                            zx<br>
                            cxzxzc
                        </div>
                        <div class="col col-sm-2 text-left">
                            <a class="remove_license btn btn-danger btn-sm">Remove</a>
                        </div>
                    </div>
                </div>
                <div id="certification_list">
                    <div class="row well-purple padding_5" >
                        <div class="col col-sm-5 text-left">
                            <strong>asdsad</strong><br>
                        </div>
                        <div class="col col-sm-5 text-left">
                            zx 
                        </div>
                        <div class="col col-sm-2 text-left">
                            <a class="remove_license btn btn-danger btn-sm">Remove</a>
                        </div>
                    </div>
                </div>

                    
                <div id="toolbar" class="col-lg-12 block-toggle" style="padding: 5%;" >
                    <a id="add_license" class="btn btn-blue btn-sm" >
                        <span class="glyphicon glyphicon-check"></span> Add License
                    </a>
                    <a id="add_certification" class="btn btn-purple btn-sm" >
                        <span class="glyphicon glyphicon-check"></span> Add Certification
                    </a>
                    <br>
                    <sup>*</sup> Must add at least one of each
                </div>
                
                <div class="clearfix space-row-10"></div>

                <div id="add_license_block" class="well-blue col-lg-12 block-toggle" style="padding: 5%; display: none;" >
                    <form id="add_license_form">  
                        <div class="left_col">
                            <input class="ng-valid ng-dirty form-control" id="licenseType"  name="licenseType" placeholder="License Type" type="text" required >
                        </div>
                        <div class="right_col">
                            <input class="ng-valid ng-dirty form-control" id="licenseNumber" name="licenseNumber" placeholder="License Number" type="text" required >
                        </div>
                        <div class="left_col">
                            <input id="licenseIssued" name="licenseIssued" class="dateMask ng-valid ng-dirty form-control" placeholder="Issued On" type="text" required >
                        </div>
                        <div class="right_col">
                            <select class="form-control" name="state" id="state" required>
                                <option value="">State</option>
                                <?php 
                                $states = get_states( array("country"=>"US") ); 
                                foreach($states as $state){ ?>
                                    <option value="<?php echo $state["code"] ?>"><?php echo $state["code"] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        
                        <div class="left_col">
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
                <div class="clearfix space-row-10 "></div>

                <div id="add_certification_block" class="well-purple col-lg-12 block-toggle" style="padding: 5%; display: none;" >
                    <form id="add_certification_form">
                    <div class="left_col">
                        <input class="ng-valid ng-dirty form-control" id="certName" name="certName" placeholder="Certificate Name" type="text" required >
                    </div>
                    <div class="right_col">
                        <input id="certIssued" name="certIssued" class="dateMask ng-valid ng-dirty form-control" placeholder="Issued On" type="text" required >
                    </div>
                    
                    <div class="col col-sm-12 text-center" style="margin-top: 15px; padding-left: 15px; clear: both;">
                        <a class="btn btn-primary btn-sm" id="add_certification_btn" >Add</a>
                        <a class="btn btn-primary btn-sm" id="cancel_certification_btn" >Cancel</a>
                    </div>
                    </form>
                </div>
                <div class="clearfix space-row-10"></div>
            
            
                
            </fieldset>
        </div>


        <div style="text-align: center; margin-top: 20px;">
            <a href="javascript:void(0)" class="btn btn-lg btn-primary profile_steps_continue" data-step="continue-step2" data-stepTo="3" data-formValidate="form_profileStep2">Continue</a>
        </div>
</div>
<script>
    
    
    
    $("#certIssued").datepicker( {"dateFormat":"yy-mm-dd" } );
    $("#licenseIssued").datepicker( {"dateFormat":"yy-mm-dd" } );
    
    $("#add_certification_form").validate({
        errorPlacement: function(error, element) {
        },
        submitHandler: function(form) {
        }
    });
    $("#add_license_form").validate({
        errorPlacement: function(error, element) {
        },
        submitHandler: function(form) {
        }
    });
    
    
    $("#add_license").click(function(){
        
        $(".block-toggle").hide();
        $("#add_license_block").show();
        
    });
    $("#add_certification").click(function(){
        $(".block-toggle").hide();
        $("#add_certification_block").show();
        
    });
    $("#cancel_certification_btn").click(function(){
        $("#add_certification_block").hide();
        $("#toolbar").show();
    });
    $("#cancel_license_btn").click(function(){
        $("#add_license_block").hide();
        $("#toolbar").show();
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
                    federal: $("input[name='federal']:checked").val()
                },
            }).success(function(rsp){
                if(rsp.status === "ok"){
                    // continue then
                    $("#license_list").append(rsp.html);
                    
                    $("#add_license_block").hide();
                    $("#toolbar").show();
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
    
    
    
</script>