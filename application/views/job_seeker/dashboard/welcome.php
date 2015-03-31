<div class="col-md-1"></div>
<div class="b-doctor col-md-10"><h3>Dr <?php echo ucfirst($jobseeker['last_name']); ?>,</h3>
    <span> Ready to get matched to your dream job?</span>
</div>
<div class="col-sm-12 b-bax-1 ">
    <div class="col-md-2 option">Option 1:</div>
    <div class="col-md-8 b-NPI">
        <p>
            Create your profile. You'll only have to do this once, and you'll be able to apply to multiple jobs with a click of a button! 
            Please have your NPI number available
        </p>
        <a id="lets_get_started_btn" style="width: 60%; font-size: 24px" class="btn btn-lg btn-primary profile_steps_continue" data-step="continue-step0" >Let's Get Started </a>
    </div>
</div>
<div class="col-sm-12 b-bax-1 ">
    <div class="col-md-2 option">Option 2:</div>
    <div class="col-md-8 b-NPI b-NPI2">
        <p>
            Upload your current resume, and let us help auto populate most of the fields. its just easier some time, and it'll have some time
            Please have your NPI number available
        </p>
        <a id="resume_button" style="width: 60%; font-size: 24px" class="btn btn-lg btn-primary profile_steps_continue" >Upload, and Get Started </a>
        <div id="rsp_resume" style="display: none;"></div>
        <div id="resume_file_block" style="height: 100px; text-align: right; display: none;" class="text-center">
            <input style="display: inline; margin: 20px 0 0 0;" type="file" id="resume" name="resume[]" onchange="upload_resume();">
            <div id="save_file_busy" style="display: none;"><?php echo load_img("busy.gif"); ?></div>
        </div>
    </div>
</div>
<div class="col-sm-10 col-sm-offset-1 text-center round_border">
    <p class="text-left b-note">
        <b>Note</b> We care about your privacy.  We only use the information provided for the purposes of finding you the best job matches, and only connect to facilities you want.  Check out our Privacy Policyfor details on what &amp; when we share your data.  We’ve got you covered!
    </p>
</div>
<div style="margin-top: 25px;" class="col-sm-9 col-sm-offset-4 text-left">
    <div class="row">
        <div class="col-sm-1">
            <?php echo load_img("uploadyourcv.jpg") ?>
        </div>
        <div style="margin-left: 10px; font-size: 11px;" class="col-sm-9 alternative_option">
            <p class="text-left">Alternative Option - <strong>Coming Soon</strong><br><br>Upload, and we will auto populate some<br>fields for you, it's just easier sometimes.</p>
        </div>
    </div>

</div>

<div class="clearfix"></div>
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
            data: {jobseeker_id: '<?php echo $jobseeker['id'] ?>'},
            success: function (rsp)
            {

                var rsp_json = $.parseJSON(rsp);

                if (rsp_json.status === "ok") {
                    // everything is ok   
                    $("#lets_get_started_btn").click();

                }
                else {
                    $("#rsp_resume").html(rsp_json.msg).show();
                    $("#rsp_resume").addClass("error_rsp");
                }

                $("#save_file_busy").hide();
            }
        });
    }
</script>

<!--<div style="margin-top: -17px; padding: 10px;" >
    <h3>Dr <?php echo ucfirst($jobseeker['last_name']); ?></h3>
    <h2 style="margin-top: 5px; font-size: 30px; text-align: center;" class="text-left">Ready to get matched to your dream job?</h2>
    <br><br> 
    <div class="col-sm-10 col-sm-offset-1 text-center">
        <p style="font-size: 24px; font-weight: 200; color: #ff5500">
            <em style="font-size: 22px; font-style: italic;">Start by creating your profile. You'll only have to do this once, and you'll be able to apply to multiple jobs with a click of a button!</em>
        </p>
        <a id="lets_get_started_btn" style="width: 60%; font-size: 24px" class="btn btn-lg btn-primary profile_steps_continue" data-step="continue-step0">Let's Get Started </a>
    </div>
    <div class="col-sm-10 col-sm-offset-1 text-center round_border">
        <p class="text-left">
            <span class="red">Hey!</span> We care about your privacy.  We only use the information provided for the purposes of finding you the best job matches, and only connect to facilities you want.  Check out our <a>Privacy Policy</a> for details on what &amp; when we share your data.  We’ve got you covered!
        </p>
    </div>
    <div style="margin-top: 25px;" class="col-sm-9 col-sm-offset-4 text-left">
        <div class="row">
            <div class="col-sm-1">
<?php echo load_img("uploadyourcv.jpg") ?>
            </div>
            <div style="margin-left: 10px; font-size: 11px;" class="col-sm-9 alternative_option">
                <p class="text-left">Alternative Option - <strong>Coming Soon</strong><br><br>Upload, and we will auto populate some<br>fields for you, it's just easier sometimes.</p>
            </div>
        </div>

    </div>

    <div class="clearfix"></div>

</div>-->