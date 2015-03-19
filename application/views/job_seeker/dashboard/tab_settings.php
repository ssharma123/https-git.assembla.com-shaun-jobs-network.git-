<div class="row-wrapper">

    <form id="update_settings_form" method="post" action="">
        <div class="sec_row">
            <div class="sec1"><strong>Notifications</strong></div>
            <div class="sec2"><i class="fa fa-envelope"></i> <strong>Email</strong></div>
            <div class="sec3"><i class="fa fa-mobile-phone"></i> <strong>Phone</strong></div>
            <div class="clearfix"></div>
        </div>
        <div class="sec_row">
            <div class="sec1">When there is a match</div>
            <div class="sec2"><input type="checkbox" id="when_match_email" name="when_match_email" <?php echo ( (isset($setting['when_match_email']) && $setting['when_match_email'] == 1) || ($is_default == TRUE) ) ? ' checked="checked" ' : ""; ?> ></div>
            <div class="sec3"><input type="checkbox" id="when_match_phone" name="when_match_phone" <?php echo ( (isset($setting['when_match_phone']) && $setting['when_match_phone'] == 1) || ($is_default == TRUE) ) ? ' checked="checked" ' : ""; ?> ></div>
            <div class="clearfix"></div>
        </div>
        <div class="sec_row">
            <div class="sec1">When I have an interview offer</div>
            <div class="sec2"><input type="checkbox" id="when_interview_offer_email" name="when_interview_offer_email" <?php echo ( (isset($setting['when_interview_offer_email']) && $setting['when_interview_offer_email'] == 1) || ($is_default == TRUE) ) ? ' checked="checked" ' : ""; ?> ></div>
            <div class="sec3"><input type="checkbox" id="when_interview_offer_phone" name="when_interview_offer_phone" <?php echo ( (isset($setting['when_interview_offer_phone']) && $setting['when_interview_offer_phone'] == 1) || ($is_default == TRUE) ) ? ' checked="checked" ' : ""; ?> ></div>
            <div class="clearfix"></div>
        </div>
        <div class="sec_row">
            <div class="sec1">When I am offered a face to face interview</div>
            <div class="sec2"><input type="checkbox" id="when_face_2_face_offer_email" name="when_face_2_face_offer_email" <?php echo ( (isset($setting['when_face_2_face_offer_email']) && $setting['when_face_2_face_offer_email'] == 1) || ($is_default == TRUE) ) ? ' checked="checked" ' : ""; ?> ></div>
            <div class="sec3"><input type="checkbox" id="when_face_2_face_offer_phone" name="when_face_2_face_offer_phone" <?php echo ( (isset($setting['when_face_2_face_offer_phone']) && $setting['when_face_2_face_offer_phone'] == 1) || ($is_default == TRUE) ) ? ' checked="checked" ' : ""; ?> ></div>
            <div class="clearfix"></div>
        </div>
        <div class="sec_row">
            <div class="sec1">When a job offer is made</div>
            <div class="sec2"><input type="checkbox" id="when_job_offer_email" name="when_job_offer_email" <?php echo ( (isset($setting['when_job_offer_email']) && $setting['when_job_offer_email'] == 1) || ($is_default == TRUE) ) ? ' checked="checked" ' : ""; ?> ></div>
            <div class="sec3"><input type="checkbox" id="when_job_offer_phone" name="when_job_offer_phone" <?php echo ( (isset($setting['when_job_offer_phone']) && $setting['when_job_offer_phone'] == 1) || ($is_default == TRUE) ) ? ' checked="checked" ' : ""; ?> ></div>
            <div class="clearfix"></div>
        </div>
        <div class="sec_row">
            <div class="sec1">All other status updates</div>
            <div class="sec2"><input type="checkbox" id="when_status_update_email" name="when_status_update_email" <?php echo ( (isset($setting['when_status_update_email']) && $setting['when_status_update_email'] == 1) || ($is_default == TRUE) ) ? ' checked="checked" ' : ""; ?> ></div>
            <div class="sec3"><input type="checkbox" id="when_status_update_phone" name="when_status_update_phone" <?php echo ( (isset($setting['when_status_update_phone']) && $setting['when_status_update_phone'] == 1) || ($is_default == TRUE) ) ? ' checked="checked" ' : ""; ?> ></div>
            <div class="clearfix"></div>
        </div>
    </form>
    <div>
        <br><br>
        <div class="ng-binding">
            <strong>Email:</strong> <span id="changed_email_txt"><?php echo ( isset($jobseeker['email']) ) ? $jobseeker['email'] : "" ; ?> </span> <a href="javascript:void(0);" id="change_email_link">Change Email</a>
            <br>
            <div id="change_email_div" style="display: none;">
                <form id="change_email_form" method="post" action="">
                    <input type="email" name="change_email" id="change_email" required style="border: 1px solid #9a9b9f;border-radius: 5px;display: inline-block;margin: 10px;padding: 5px;width: 25%;" >
                    <a href="javascript:void(0)" id="save_email_change" class="btn btn-sm btn-info">Change</a>
                    <div id="save_email_change_busy" style="display: none;"><?php echo load_img("busy.gif"); ?></div>
                </form>
            </div>
        </div>
        <br>

        <div class="">
            <strong>Password:</strong> <a href="javascript:void(0);" id="change_pass_link">Change Password</a>
        </div>
        <div id="change_passwrod_div" style="display: none;">
            <form id="change_password_form" method="post" action="">
                <input type="password" placeholder="Password" id="change_password" name="change_password" style="width: 25%;" > 
                <input type="password" placeholder="Confirm Password" id="confirm_change_password" name="confirm_change_password" style="width: 25%;"> 
                <a href="javascript:void(0)" id="save_password_change" class="btn btn-sm btn-info">Change</a>
                <div id="save_password_change_busy" style="display: none;"><?php echo load_img("busy.gif"); ?></div>
            </form>
        </div>
    </div>
    <div>
        <br>
        <div class="text-right">
            <a id="update_settings" class="btn btn-embossed btn-info">Update</a>
            <div id="update_settings_busy" style="display: none;"><?php echo load_img("busy.gif"); ?></div>
        </div>
        <div class="clearfix"></div>
    </div>

    <div class="clearfix"></div>
</div>
<script>
    
    $("#change_email_form").validate({
        errorPlacement: function(error, element) {
            element.attr("placeholder",error.text());
        }
    });
    $("#change_password_form").validate({
        rules: {
            'confirm_change_password': {
                equalTo: "#change_password"
            },
            'change_password': {
                minlength: 6,
                required: true
            }
        },
        errorPlacement: function(error, element) {
            element.attr("placeholder",error.text());
        }
    });
    
    $("#update_settings").click(function(){
        $("#tabContent_rsp").removeClass();
        $("#tabContent_rsp").hide();
        
        $(this).hide();
        $("#update_settings_busy").show();
        
        $.ajax({
            type: "POST",
            url: SITE_URL+"job_seeker_dashboard/update_settings",
            dataType: "json",
            data: {
                when_match_email : $("#when_match_email").is(":checked"),
                when_match_phone : $("#when_match_phone").is(":checked"),
                when_interview_offer_email : $("#when_interview_offer_email").is(":checked"),
                when_interview_offer_phone : $("#when_interview_offer_phone").is(":checked"),
                when_face_2_face_offer_email : $("#when_face_2_face_offer_email").is(":checked"),
                when_face_2_face_offer_phone : $("#when_face_2_face_offer_phone").is(":checked"),
                when_job_offer_email : $("#when_job_offer_email").is(":checked"),
                when_job_offer_phone : $("#when_job_offer_phone").is(":checked"),
                when_status_update_email : $("#when_status_update_email").is(":checked"),
                when_status_update_phone : $("#when_status_update_phone").is(":checked"),
            }
        }).success(function(rsp){
            if(rsp.status === "ok"){
                $("#tabContent_rsp").addClass("success_rsp");
                $("#tabContent_rsp").html(rsp.msg).show();
            }
            else{
                $("#tabContent_rsp").addClass("error_rsp");
                $("#tabContent_rsp").html(rsp.msg).show();
            }
        })
        .always(function(){
            $("#update_settings_busy").hide();
            $("#update_settings").show();
        }); 
       
    });
    
    $("#save_email_change").click(function(){
        $("#tabContent_rsp").removeClass();
        $("#tabContent_rsp").hide();
        
        var valid = $("#change_email_form").valid();
        
        if(valid === false){
            return false;
        }
        
        $(this).hide();
        $("#save_email_change_busy").show();
        
        
        $.ajax({
            type: "POST",
            url: SITE_URL+"job_seeker_dashboard/update_jobseeker_emails",
            dataType: "json",
            data: {
                change_email : $.trim($("#change_email").val())
            }
        }).success(function(rsp){
            if(rsp.status === "ok"){
                $("#tabContent_rsp").addClass("success_rsp");
                $("#tabContent_rsp").html(rsp.msg).show();
                
                $("#change_email_div").hide();
                $("#change_email").val("");
            }
            else{
                $("#tabContent_rsp").addClass("error_rsp");
                $("#tabContent_rsp").html(rsp.msg).show();
            }
        })
        .always(function(){
            $("#save_email_change_busy").hide();
            $("#save_email_change").show();
        }); 
    });
    $("#save_password_change").click(function(){
        
        $("#tabContent_rsp").removeClass();
        $("#tabContent_rsp").hide();
        
        var valid = $("#change_password_form").valid();
        
        if(valid === false){
            return false;
        }
        
        $(this).hide();
        $("#save_password_change_busy").show();
        
        
        $.ajax({
            type: "POST",
            url: SITE_URL+"job_seeker_dashboard/update_jobseeker_password",
            dataType: "json",
            data: {
                change_password : $.trim($("#change_password").val()),
                confirm_change_password : $.trim($("#confirm_change_password").val())
            }
        }).success(function(rsp){
            if(rsp.status === "ok"){
                $("#tabContent_rsp").addClass("success_rsp");
                $("#tabContent_rsp").html(rsp.msg).show();
                
                $("#change_passwrod_div").hide();
                $("#change_password").val("");
                $("#confirm_change_password").val("");
                
            }
            else{
                $("#tabContent_rsp").addClass("error_rsp");
                $("#tabContent_rsp").html(rsp.msg).show();
            }
        })
        .always(function(){
            $("#save_password_change_busy").hide();
            $("#save_password_change").show();
        });
        
    });
    
</script>