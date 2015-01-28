<?php //echo load_js("jquery-1.10.2.min.js"); ?>


<?php 
    // UPLOADIFY CSS files
    echo load_css('uploadify.css','assets/js/uploadify/');
    // UPLOADIFY JS files
    echo load_js("jquery.uploadify.js","assets/js/uploadify/");
            
?>


<form id="form_jobStep7" method="post">
    <div style="margin-bottom: 10px;" class="col-sm-8">
        <h1 style=" color: #ff5500; text-align: left;">Congratulations! Job Posted!</h1>
        <p style="text-align: left; padding-top: 2px;" class="text-left"><em><sup>*</sup>An email will not be sent after every job posting. They are available in your Dashboard under the Status Tab along with all updates and match information.</em></p>

        <div style="margin: 20px 40px; background-color: #F8F8F8; border-color: #bbb" class="well">
            <h2 style="margin-top: 0px" class="text-center">One more thing..</h2>
            <div class="col-xs-4">
                <div style="font-size: 18px; border: 1px solid #aaa; background-color: #ddd" class="imageContainer">
                    <img ng-src="" class="containedImage">
                </div>
            </div>
            <div class="col-xs-8">
                <p style="margin-top: 20px" class="text-center">Physicians like to know who they are connecting. Please upload an official logo, or a picture of yourself. Lets make this personal!</p>
                <div class="text-center">

                    <fieldset>
                        <div id="queue"></div>
                        <input type="file" id="profile_image" name="profile_image" nv-file-select="">
                    </fieldset>

                </div>
            </div>
            <div class="clearfix"></div>

        </div>
        <div class="text-center">
            <a style="width: 60%; font-size: 22px" class="btn btn-lg btn-primary" href="javacript:void(0)">Go to Jobs Dashboard</a>
        </div>

    </div>
    <div class="col-sm-4 text-center">
        <br><br><br>
        <div>
            <p style="font-size: 12px">He will reach out to you momentarily to make sure you are all set.</p>
            <p style="color: #777; font-size: 13px;" class="text-center ng-binding">Text (123) 123-1231 <br>or<br> <?php echo $employer["email"] ?> </p>
        </div>

    </div>

    <div class="clearfix"></div>
</form>
<script>
    
    BASE_URL= '://localhost/medmatch/';
    <?php $timestamp = time();?>
    var uploadify = jQuery.noConflict();
    uploadify(function() {
        uploadify("#profile_image").uploadify({
            'formData'     : {
                'timestamp' : '<?php echo $timestamp; ?>',
                'token'     : '<?php echo md5('unique_salt' . $timestamp); ?>'
            },
            'swf'      : BASE_URL+'assets/js/uploadify/uploadify.swf',
            'uploader' : BASE_URL+'user/upload_event_media',
            'removeCompleted': false,
            'onUploadSuccess' : function(file, data, response) {
                console.log(file);
                console.log(data);
                console.log(response);
            },
            'multi'    : false,
            'buttonClass' : 'btn btn-sm btn-info',
            'debug'    : true,
        });    
    });
</script>