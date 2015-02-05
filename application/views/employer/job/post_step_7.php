<?php echo load_js("ajaxfileupload.js"); ?>


<?php 
    // UPLOADIFY CSS files
    // echo load_css('uploadify.css','assets/js/uploadify/');
    // UPLOADIFY JS files
    // echo load_js("jquery.uploadify.js","assets/js/uploadify/");
            
?>


<form id="form_jobStep7" method="post">
    <div style="margin-bottom: 10px;" class="col-sm-8">
        <h1 style=" color: #ff5500; text-align: left;">Congratulations! Job Posted!</h1>
        <p style="text-align: left; padding-top: 2px;" class="text-left"><em><sup>*</sup>An email will not be sent after every job posting. They are available in your Dashboard under the Status Tab along with all updates and match information.</em></p>

        <div style="margin: 20px 40px; background-color: #F8F8F8; border-color: #bbb" class="well">
            <h2 style="margin-top: 0px" class="text-center">One more thing..</h2>
            <div class="col-xs-4">
                <div style="font-size: 18px; border: 1px solid #aaa; background-color: #ddd" class="imageContainer">
                    <?php
//                    var_dump($employer['profile_image']);
                    $src = (isset($employer['profile_image']) && $employer['profile_image'] != "")  ? " src='".base_url("uploads/employers/profiles/".upload_img_thumb($employer['profile_image'],150,185))."' " : "" ;
                    ?>
                    <img class="containedImage" <?php echo $src; ?> >
                </div>
            </div>
            <div class="col-xs-8">
                <p style="margin-top: 20px" class="text-center">Physicians like to know who they are connecting. Please upload an official logo, or a picture of yourself. Lets make this personal!</p>
                <div class="text-center">

                    <fieldset>
                        <div id="queue"></div>
                        <input type="file" id="profile_image" name="profile_image[]" nv-file-select="" onchange="upload_profile_image();">
                        <div id="save_file_busy" style="display: none;"><?php echo load_img("busy.gif"); ?></div>
                    </fieldset>

                </div>
            </div>
            <div class="clearfix"></div>

        </div>
        <div class="text-center">
            <a id="go_to_jobs_dashboard_btn" style="width: 60%; font-size: 22px" class="btn btn-lg btn-primary" href="javascript:void(0)">Go to Jobs Dashboard</a>
        </div>

    </div>
    <div class="col-sm-4 text-center">
        <br><br><br>
        <div>
            <p style="font-size: 12px">He will reach out to you momentarily to make sure you are all set.</p>
            <p style="color: #777; font-size: 13px;" class="text-center ng-binding">Text (123) 123-1231 <br>or<br> <?php echo (isset($employer["email"])) ? $employer["email"] : "" ; ?> </p>
        </div>

    </div>

    <div class="clearfix"></div>
</form>
<script>
//    
//    BASE_URL= '://localhost/medmatch/';
//    <?php $timestamp = time();?>
//    var uploadify = jQuery.noConflict();
//    uploadify(function() {
//        uploadify("#profile_image").uploadify({
//            'formData'     : {
//                'timestamp' : '<?php echo $timestamp; ?>',
//                'token'     : '<?php echo md5('unique_salt' . $timestamp); ?>'
//            },
//            'swf'      : BASE_URL+'assets/js/uploadify/uploadify.swf',
//            'uploader' : BASE_URL+'user/upload_event_media',
//            'removeCompleted': false,
//            'onUploadSuccess' : function(file, data, response) {
//                console.log(file);
//                console.log(data);
//                console.log(response);
//            },
//            'multi'    : false,
//            'buttonClass' : 'btn btn-sm btn-info',
//            'debug'    : true,
//        });    
//    });


function upload_profile_image() {
    $("#save_file_busy").show();
    var image_name = "";
//    alert(SITE_URL);
    $.ajaxFileUpload({
        url: SITE_URL + "employee_dashboard/upload_profile_image",
        secureuri: false,
        fileElementId: 'profile_image',
        dataType: 'json',
        async: false,
        data: { employer_id : '<?php echo $job['employer_id'] ?>' },
        success: function(rsp, status)
        {
            if (rsp.status === "ok") {
                 var image_thumb = BASE_URL+'uploads/employers/profiles/'+rsp.thumbnail_name;
                 $(".containedImage").attr("src",image_thumb);
            }
            $("#save_file_busy").hide();
        }
    });
    return image_name;

}
</script>