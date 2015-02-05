<?php echo load_js("ajaxfileupload.js"); ?>
<style>
    #datepicker1,#datepicker2,#datepicker3{
        min-height: 240px;
    }
    .datepicker_div{
        margin: 5px;
        display: inline-block;
    }
    .selected_date_text{
        display: inline-block;
        padding: 5px;
        width: 100%;
    }
    .interview_heading{
        font-size: 18px;
        font-weight: bold;
    }
    .interview_text{
        font-size: 12px;
    }
</style>
<div style="width: 900px; padding: 30px 0 30px 0;">
    <div class="col-lg-12 ">
        <h3 class="interview_heading">Job Offer</h3>
        <p class="interview_text">Great! Please upload your job offer letter here and all supporting documents</p>
        
    </div>


    <div class="col-lg-12 text-center">
        
        <p class="interview_text text-left">Offer Letter </p>
        <input type="file" id="job_letter" name="job_letter[]" nv-file-select="" >
            
    </div>
    <div class="col-lg-12 text-right">
        <div id="job_offer_rsp" class="" style="display: none; text-align: left;"></div>
        
        <div id="save_date_busy" style="display: none;"><?php echo load_img("busy.gif"); ?></div>
        <input type="button" class="btn btn-success" id="save_job_offer" value="Save">
        <input type="button" class="btn btn-danger" id="cancel_job_offer" value="Cancel">
    </div>
    
    <div style="clear:both;"></div>
</div>

<script>
    var job_applied_id = '<?php echo $id; ?>';
    var btn_id = '<?php echo $btn_id; ?>';
    function upload_file() {
        $("#save_file_busy").css("display","inline");
        $.ajaxFileUpload({
            url: SITE_URL + "employee_dashboard/upload_job_offer",
            secureuri: false,
            fileElementId: 'job_letter',
            dataType: 'json',
            async: false,
            data: { id : job_applied_id },
            success: function(rsp)
            {
                if (rsp.status === "ok") {
                     // uploaded successfully 
                     var element = $("#"+btn_id);
                    element.removeClass("update_job_status");
                    element.removeClass("btn-danger");
                    element.addClass("btn-success");
                    parent.jQuery.fancybox.close();
                }
                else{
                    $("#job_offer_rsp").html(rsp.msg);
                    $("#job_offer_rsp").addClass("error_rsp").show();
                }
                $("#save_file_busy").css("display","none");
            }
        });
    }
    
    $("#save_job_offer").click(function(){
        
        $("#job_offer_rsp").hide();
        $("#job_offer_rsp").removeClass();
        
        upload_file();
        
    });
    $("#cancel_job_offer").click(function(){
        parent.jQuery.fancybox.close();
    });
</script>