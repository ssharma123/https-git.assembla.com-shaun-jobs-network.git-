<style>
  .info_top{
    font-size:14px;
  }
  .info_top span{
    font-size:12px;
    font-style:italic;
  }
  .line_separator{
    border-top:1px solid ;
    margin-top: 15px ;
    margin-bottom: 15px ;
  }
</style> 

<?php echo load_js("ajaxfileupload.js"); ?>

<div class="col-sm-10 col-sm-offset-1 text-center" >
    <form id="form_profileStep8" method="post">
         
        <div class="col-sm-8 text-left" style="margin-bottom: 10px;">
            
            <h3>Profile Complete</h3>
            <p class="text-left" style="font-size: 1.3em; font-weight: 200; color: #ff5500"><em>Thanks for completing your profile.<br>
                    Your jobs matches are waiting for you!</em></p>

            <div class="well" style="margin: 20px 40px; background-color: #F8F8F8; border-color: #bbb">
                <h2 class="text-center" style="margin-top: 0px">One more thing..</h2>
                <div class="col-xs-4">
                    <div class="imageContainer" style="font-size: 18px; border: 1px solid #aaa; background-color: #ddd">
                        <?php
                        $src = (isset($jobseeker['profile_image']) && $jobseeker['profile_image'] != "")  ? " src='".base_url("uploads/jobseeker/profiles/".upload_img_thumb($jobseeker['profile_image'],150,185))."' " : "" ;
                        ?>
                        <img class="containedImage" <?php echo $src; ?> >
                    </div>
                </div>
                <div class="col-xs-8">
                    <p class="text-center" style="margin-top: 20px">Your profile will stand out with a professional picture of you.</p>
                    <div class="text-center">
                        <fieldset>
                            <input type="file" id="profile_image" name="profile_image[]" onchange="upload_profile_image();">
                            <div id="save_file_busy" style="display: none;"><?php echo load_img("busy.gif"); ?></div>
                        </fieldset>
                    </div>
                </div>
                <div class="clearfix"></div>

            </div>
            <div class="text-center">
                <div style="text-align: center; margin-top: 20px;">
                    <a href="<?php echo site_url("job_seeker_dashboard/"); ?>" class="btn btn-lg btn-primary profile_steps_continue">Go to matches</a>
                </div>
            </div>

        </div>
        
        <div class="col-sm-4 text-center">
            <p style="font-weight: 300; margin-top: 60px; font-size: 1.3em">Your personal<br>match consultant</p>
            <p style="font-size: 12px">We are here for you, whenever you need us!  Seriously.</p>
        </div>

        <div class="clearfix"></div>

    </form>
</div>
<script>
function upload_profile_image() {
    $("#save_file_busy").show();
    var image_name = "";
    $.ajaxFileUpload({
        url: SITE_URL + "job_seeker_dashboard/upload_profile_image",
        secureuri: false,
        fileElementId: 'profile_image',
        dataType: 'json',
        async: false,
        data: { jobseeker_id : '<?php echo $jobseeker['id'] ?>' },
        success: function(rsp, status)
        {
            if (rsp.status === "ok") {
                 var image_thumb = BASE_URL+'uploads/jobseeker/profiles/'+rsp.thumbnail_name;
                 $(".containedImage").attr( "src",image_thumb );
            }
            $("#save_file_busy").hide();
        }
    });
    return image_name;
}
</script>