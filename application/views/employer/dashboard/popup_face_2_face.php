<?php 
    echo load_css('jquery-ui.css','assets/js/jquery_ui/');
    echo load_js("jquery-ui.js","assets/js/jquery_ui/");
?>
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
        <h3 class="interview_heading">Interview Offered</h3>
        <p class="interview_text">Please choose 3 dates that are available, and Candidate will select from one of these. We will then provide you access to contact details to coordinate visit. </p>
    </div>
    <div class="col-lg-12 text-center">
        <div class="datepicker_div">    
            <div id="datepicker1" ></div>
            <div class="selected_date_text">
                <strong>Selected Date 1:</strong> <span id="date_1_text"></span>
            </div>
        </div>
        <div class="datepicker_div">    
            <div id="datepicker2" ></div>
            <div class="selected_date_text">
                <strong>Selected Date 2:</strong> <span id="date_2_text"></span>
            </div>
        </div>
        <div class="datepicker_div">    
            <div id="datepicker3" ></div>
            <div class="selected_date_text">
                <strong>Selected Date 3:</strong> <span id="date_3_text"></span>
            </div>
        </div>
            
    </div>
    <div class="col-lg-12 text-right">
        <div id="face2face_rsp" class="" style="display: none; text-align: left;"></div>
        
        <input type="hidden" id="date_1" value="">
        <input type="hidden" id="date_2" value="">
        <input type="hidden" id="date_3" value="">
        <div id="save_date_busy" style="display: none;"><?php echo load_img("busy.gif"); ?></div>
        <input type="button" class="btn btn-success" id="save_date" value="Save">
        <input type="button" class="btn btn-danger" id="cancel_date" value="Cancel">
    </div>
    <div style="clear:both;"></div>
</div>

<script>
    var job_applied_id = '<?php echo $id; ?>';
    var btn_id = '<?php echo $btn_id; ?>';
    $("#datepicker1").datepicker({
        dateFormat:"yy-mm-dd" ,
        onSelect: function(text , date){
            $('#date_1_text').text(text);
            $('#date_1').val(text);
        }
    });
    $("#datepicker2").datepicker({
        dateFormat:"yy-mm-dd" ,
        onSelect: function(text , date){
            $('#date_2_text').text(text);
            $('#date_2').val(text);
        }
    });
    $("#datepicker3").datepicker({
        dateFormat:"yy-mm-dd" ,
        onSelect: function(text , date){
            $('#date_3_text').text(text);
            $('#date_3').val(text);
        }
    });
    
    
    $("#save_date").click(function(){
        
        var date_1 = $("#date_1").val();
        var date_2 = $("#date_2").val();
        var date_3 = $("#date_3").val();
        
        $("#face2face_rsp").hide();
        $("#face2face_rsp").removeClass();
        if(date_1 === ""){
            $("#face2face_rsp").html("Please Select Date 1");
            $("#face2face_rsp").addClass("error_rsp").show();
        }
        else if(date_2 === ""){
            $("#face2face_rsp").html("Please Select Date 2");
            $("#face2face_rsp").addClass("error_rsp").show();
        }
        else if(date_3 === ""){
            $("#face2face_rsp").html("Please Select Date 3");
            $("#face2face_rsp").addClass("error_rsp").show();
        }
        else{
            $(this).hide();
            $("#save_date_busy").css("display","inline");
            $.ajax({
                type: "POST",
                url: SITE_URL+"employee_dashboard/save_face_2_face_dates/",
                data: {
                    id: job_applied_id,
                    date_1 : date_1,
                    date_2 : date_2,
                    date_3 : date_3
                },
                dataType: "json"
            }).success(function(rsp){
                if(rsp.status === "ok"){
                    var element = $("#"+btn_id);
                    element.removeClass("update_job_status");
                    element.removeClass("btn-danger");
                    element.addClass("btn-success");
                    parent.jQuery.fancybox.close();
                }
            })
            .always(function(){
                $("#save_date_busy").css("display","none");
                $("#save_date").show();
            }); 
        }
    });
    $("#cancel_date").click(function(){
        parent.jQuery.fancybox.close();
    });
</script>