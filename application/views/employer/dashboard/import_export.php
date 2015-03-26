<?php 
// echo "<pre>"; print_r($setting); echo "</pre>"; die;
?>
<style>
    .export_jobs_div{
        margin: 10px;
    }
    .export_jobs_div a{
        margin: 10px;
    }
    #import_jobs_block{
        margin-left: 10px;
        display: inline-block;
    }
</style>
<div id="setting_tab_item">
    
    <div class="sec_row">
        <strong>Export:</strong>
        <div class="clearfix"></div>
        
        <div class="export_jobs_div">
            <a class="btn btn-lg btn-blue " href="<?php echo site_url('php_excel/export'); ?>">Export Jobs</a>
        </div>
    </div>
    <div class="sec_row">
        <strong>Import:</strong>
        <div class="clearfix"></div>
        <div id="import_job_rsp" class="" style="display: none;"></div>
        <div class="export_jobs_div">
            <a class="btn btn-lg btn-warning" id="import_jobs_btn" href="javascript:void(0);">Import Jobs</a>
            <div id="import_jobs_block" style="display: none;">
                <input style="display: inline-block;" type="file" id="import_jobs_file" onchange="import_jobs();" name="import_jobs_file[]">
                <div id="save_file_busy" style="display: none;"><?php echo load_img("busy.gif"); ?></div>
            </div>
        </div>
    </div>

    <br>
    <br>
    
    
</div>
<?php echo load_js("ajaxfileupload.js"); ?>
<script>
    $(document).on('click','#import_jobs_btn',function(){
        $("#import_jobs_block").show();
    });
    
    function import_jobs(){
        $("#import_job_rsp").addClass();
        $("#import_job_rsp").html('').hide();
                    
        $("#save_file_busy").css('display','inline-block');
        $.ajaxFileUpload({
            url: SITE_URL + "php_excel/import",
            secureuri: false,
            fileElementId: 'import_jobs_file',
            dataType: 'json',
            async: false,
            success: function(rsp, status)
            {
                if (rsp.status === "ok") {
                     
                }
                else{
                    $("#import_job_rsp").addClass('error_rsp');
                    $("#import_job_rsp").html(rsp.msg).show();
                }
                $("#save_file_busy").hide();
            }
        });
    }
</script>