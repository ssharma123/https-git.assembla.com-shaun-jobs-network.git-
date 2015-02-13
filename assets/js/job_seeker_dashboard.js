var FBox = jQuery.noConflict();
var $ = jQuery.noConflict();
$(document).ready(function(){
    
    $(".is_phone_number").mask('000-000-0000');
     
    
    $("#get_started_tab").click(function(){
        
        $("#tabContent_rsp").hide();
        
        $(this).parent().parent().find('li').removeClass('active');
        $(this).parent().addClass('active');
        
        FBox.fancybox.showLoading();
        $.ajax({
            type: "GET",
            url: SITE_URL+"job_seeker_dashboard/welcome",
            dataType: "json"
        }).success(function(rsp){
            $("#tabContent").html(rsp.html);
            $("#tabContent").fadeIn();
        })
        .always(function(){
            FBox.fancybox.hideLoading();
        }); 
        
    });
    
    $("#tabContent").on("click",".profile_steps_continue",function(){
        
        var step = $(this).attr('data-step');
        console.log(step);
        $("#tabContent_rsp").html("").show();
        $("#tabContent_rsp").removeClass();
        
        if(step === "continue-step0"){
            FBox.fancybox.showLoading();
            $.ajax({
                type: "GET",
                url: SITE_URL+"job_seeker_dashboard/profile_step_1",
                dataType: "json"
            }).success(function(rsp){
                $("#tabContent").html(rsp.html);

                $("#form_profileStep1").validate({
                    errorPlacement: function(error, element) {
//                        element.attr("placeholder",error.text());
                    },
                    submitHandler: function(form) {
                    }
                });

            })
            .always(function(){
                FBox.fancybox.hideLoading();
            });
        }
        else if(step === "continue-step1"){
            var valid_1 = $("#form_profileStep1").valid();
            if(valid_1 === true){
                
                var save_form_1 = save_profile_form_1();
                
                if(save_form_1 == true){
                    FBox.fancybox.showLoading();
                    $.ajax({
                        type: "GET",
                        url: SITE_URL+"job_seeker_dashboard/profile_step_2",
                        dataType: "json"
                    }).success(function(rsp){
                        $("#tabContent").html(rsp.html);

                        $("#form_profileStep2").validate({
                            errorPlacement: function(error, element) {
//                                element.attr("placeholder",error.text());
                            },
                            submitHandler: function(form) {
                            }
                        });

                    })
                    .always(function(){
                        FBox.fancybox.hideLoading();
                    }); 
                }
            }
        }
        else if(step === "continue-step2"){
            var valid_2 = $("#form_profileStep2").valid();
            if(valid_2 === true){
                
                var save_form_2 = save_profile_form_2();
                
                if(save_form_2 == true){
                    
                    if($("#ui-datepicker-div").length>0){
                        $("#ui-datepicker-div").remove();
                    }
                    FBox.fancybox.showLoading();
                    $.ajax({
                        type: "GET",
                        url: SITE_URL+"job_seeker_dashboard/profile_step_3",
                        dataType: "json"
                    }).success(function(rsp){
                        $("#tabContent").html(rsp.html);

                        $("#form_profileStep3").validate({
                            errorPlacement: function(error, element) {
//                                element.attr("placeholder",error.text());
                            },
                            submitHandler: function(form) {
                            }
                        });

                    })
                    .always(function(){
                        FBox.fancybox.hideLoading();
                    }); 
                }
            }
        }
        else if(step === "continue-step3"){
            
        }
        else if(step === "continue-step4"){
            
        }
    });
});

function show_welcome_popup_jobseeker(){
    FBox.fancybox.showLoading();
    $.ajax({
        type: "POST",
        url: SITE_URL+"job_seeker_dashboard/welcome_popup",
        data: {

        },
        dataType: "json"
    }).success(function(rsp){
        FBox.fancybox({
            content: rsp.html,
            padding: 0,
            closeBtn: false,
            type: 'inline',
        });
    })
    .always(function(){
        FBox.fancybox.hideLoading();
    });
}

function save_profile_form_1(){
    var flag = true;
    FBox.fancybox.showLoading();
    $.ajax({
        type: "POST",
        url: SITE_URL+"job_seeker_dashboard/save_profile_step_1",
        data: {
            first_name : $.trim($("#first_name").val()),
            last_name : $.trim($("#last_name").val()),
            mid_name : $.trim($("#mid_name").val()),
            prefix : $.trim($("#prefix").val()),
            suffix : $.trim($("#suffix").val()),
            prof_suffix : $.trim($("#prof_suffix").val()),
            address : $.trim($("#address").val()),
            apt : $.trim($("#apt").val()),
            city : $.trim($("#city").val()),
            state : $.trim($("#state").val()),
            zip : $.trim($("#zip").val()),
            phone : $.trim($("#phone").val()),
            alt_phone : $.trim($("#alt_phone").val()),
        },
        dataType: "json",
        async: false
    }).success(function(rsp){
        if(rsp.status == "ok"){
            // continue then
        }
        else{
            flag = false;
            $("#tabContent_rsp").html(rsp).show();
            $("#tabContent_rsp").addClass("error_rsp");
        }
    })
    .always(function(){
        FBox.fancybox.hideLoading();
    });
    return flag;
}
function save_profile_form_2(){
    var flag = true;
    FBox.fancybox.showLoading();
    $.ajax({
        type: "POST",
        url: SITE_URL+"job_seeker_dashboard/save_profile_step_2",
        data: {
            experince_level : $.trim($("#experince_level").val()),
            specialty : $.trim($("#specialty").val()),
            sub_specialty : $.trim($("#sub_specialty").val()),
            board_status : $.trim($("#board_status").val()),
            degree : $.trim($("#degree").val()),
            resident_status : $.trim($("#resident_status").val()),
            npi_number : $.trim($("#npi_number").val())
        },
        dataType: "json",
        async: false
    }).success(function(rsp){
        if(rsp.status == "ok"){
            // continue then
        }
        else{
            flag = false;
            $("#tabContent_rsp").html(rsp).show();
            $("#tabContent_rsp").addClass("error_rsp");
        }
    })
    .always(function(){
        FBox.fancybox.hideLoading();
    });
    return flag;
}
