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

                    })
                    .always(function(){
                        FBox.fancybox.hideLoading();
                    }); 
                }
            }
        }
        else if(step === "continue-step3"){
            
            $("#add_license").removeClass("error");
            $("#add_certification").removeClass("error");
            
            if( total_license <= 0){
                $("#add_license").addClass("error");
            }
            else if( total_cert <= 0 ){
                $("#add_certification").addClass("error");
            }
            else{
                if($("#ui-datepicker-div").length>0){
                    $("#ui-datepicker-div").remove();
                }
                FBox.fancybox.showLoading();
                $.ajax({
                    type: "GET",
                    url: SITE_URL+"job_seeker_dashboard/profile_step_4",
                    dataType: "json"
                }).success(function(rsp){
                    $("#tabContent").html(rsp.html);

                })
                .always(function(){
                    FBox.fancybox.hideLoading();
                });
            }
            
        }
        else if(step === "continue-step4"){
            
            $("#add_degree").removeClass("error");
            $("#add_residency").removeClass("error");
            $("#add_fellowship").removeClass("error");
            
            if( total_degrees <= 0){
                $("#add_degree").addClass("error");
            }
            else if( total_residencys <= 0 ){
                $("#add_residency").addClass("error");
            }
            else if( total_fellowships <= 0 ){
                $("#add_fellowship").addClass("error");
            }
            else{
                if($("#ui-datepicker-div").length>0){
                    $("#ui-datepicker-div").remove();
                }
                FBox.fancybox.showLoading();
                $.ajax({
                    type: "GET",
                    url: SITE_URL+"job_seeker_dashboard/profile_step_5",
                    dataType: "json"
                }).success(function(rsp){
                    $("#tabContent").html(rsp.html);

                })
                .always(function(){
                    FBox.fancybox.hideLoading();
                });
            }
            
        }
        else if(step === "continue-step5"){
            
            if($("#ui-datepicker-div").length>0){
                $("#ui-datepicker-div").remove();
            }
            FBox.fancybox.showLoading();
            $.ajax({
                type: "GET",
                url: SITE_URL+"job_seeker_dashboard/profile_step_6",
                dataType: "json"
            }).success(function(rsp){
                $("#tabContent").html(rsp.html);
            })
            .always(function(){
                FBox.fancybox.hideLoading();
            });
            
        }
        
        else if(step === "continue-step6"){
            var valid = $("#form_profileStep6").valid();
            if(valid === true){
                upload_file_document();
                var save_form_6 = save_profile_form_6();
                if(save_form_6 === true){
                     
                    FBox.fancybox.showLoading();
                    $.ajax({
                        type: "GET",
                        url: SITE_URL+"job_seeker_dashboard/profile_step_7",
                        dataType: "json"
                    }).success(function(rsp){
                        $("#tabContent").html(rsp.html);
                    })
                    .always(function(){
                        FBox.fancybox.hideLoading();
                    }); 
                }
            }
            else{
                $("html, body").animate({ scrollTop: $('#form_profileStep6').offset().top }, 500);
            }
        }
        else if(step === "continue-step7"){
            save_profile_form_7();
            FBox.fancybox.showLoading();
            $.ajax({
                type: "GET",
                url: SITE_URL+"job_seeker_dashboard/profile_step_8",
                dataType: "json"
            }).success(function(rsp){
                $("#tabContent").html(rsp.html);
            })
            .always(function(){
                FBox.fancybox.hideLoading();
            });
        }
        
    });
    
    $("#tab_profile").click(function(){
        
        $("#tabContent_rsp").hide();

        $(this).parent().parent().find('li').removeClass('active');
        $(this).parent().addClass('active');
        
        /* datepicker fix */
        if($("#ui-datepicker-div").length>0){
            $("#ui-datepicker-div").remove();
        }

        $("#tabContent").hide();
        FBox.fancybox.showLoading();
        $.ajax({
            type: "GET",
            url: SITE_URL+"job_seeker_dashboard/tab_profile/",
            dataType: "json"
        }).success(function(rsp){
            $("#tabContent").html(rsp.html);
            $("#tabContent").fadeIn();
            
            init_all_profiles_forms();
        })
        .always(function(){
            FBox.fancybox.hideLoading();
        }); 

    });
    $("#tab_status").click(function(){
        
        $("#tabContent_rsp").hide();

        $(this).parent().parent().find('li').removeClass('active');
        $(this).parent().addClass('active');

        $("#tabContent").hide();
        FBox.fancybox.showLoading();
        $.ajax({
            type: "GET",
            url: SITE_URL+"job_seeker_dashboard/tab_status/",
            dataType: "json"
        }).success(function(rsp){
            $("#tabContent").html(rsp.html);
            $("#tabContent").fadeIn();
        })
        .always(function(){
            FBox.fancybox.hideLoading();
        }); 

    });
    $("#tab_matches").click(function(){
        
        $("#tabContent_rsp").hide();

        $(this).parent().parent().find('li').removeClass('active');
        $(this).parent().addClass('active');

        $("#tabContent").hide();
        FBox.fancybox.showLoading();
        $.ajax({
            type: "GET",
            url: SITE_URL+"job_seeker_dashboard/tab_matches/",
            dataType: "json"
        }).success(function(rsp){
            $("#tabContent").html(rsp.html);
            $("#tabContent").fadeIn();
        })
        .always(function(){
            FBox.fancybox.hideLoading();
        }); 

    });
    $("#tab_settings").click(function(){
        
        $("#tabContent_rsp").hide();

        $(this).parent().parent().find('li').removeClass('active');
        $(this).parent().addClass('active');

        $("#tabContent").hide();
        FBox.fancybox.showLoading();
        $.ajax({
            type: "GET",
            url: SITE_URL+"job_seeker_dashboard/tab_settings/",
            dataType: "json"
        }).success(function(rsp){
            $("#tabContent").html(rsp.html);
            $("#tabContent").fadeIn();
        })
        .always(function(){
            FBox.fancybox.hideLoading();
        }); 

    });
    
    $("#tabContent").on("click","#change_email_link",function(){
       $("#change_email_div").toggle();
    });
    $("#tabContent").on("click","#change_pass_link",function(){
       $("#change_passwrod_div").toggle();
    });
    
    $("#tabContent").on("click","#contact_info_edit_link",function(){
        $("#contact_info_block").hide();
        $("#contact_info_edit").show();
    });
    $("#tabContent").on("click","#contact_info_cancel",function(){
        $("#contact_info_block").show();
        $("#contact_info_edit").hide();
    });
    
    $("#tabContent").on("click","#contact_info_save",function(){
        var valid = $("#contact_info_form").valid();
        if(valid === true){
            var save = contact_info_save();
            if(save === true){
                $("#contact_info_edit").hide();
                $("#contact_info_block").show();
            }
        }
    });
    
    $("#tabContent").on("click","#profession_edit_link",function(){
        $("#profession_block").hide();
        $("#profession_edit").show();
    });
    $("#tabContent").on("click","#profession_cancel",function(){
        $("#profession_block").show();
        $("#profession_edit").hide();
    });
    
    $("#tabContent").on("click","#profession_save",function(){
        var valid = $("#profession_form").valid();
        if(valid === true){
            var save = profession_save();
            if(save === true){
                $("#profession_edit").hide();
                $("#profession_block").show();
            }
        }
    });
    
    $("#tabContent").on("click","#certification_edit_link",function(){
        $("#certification_block").hide();
        $("#certification_edit").show();
        
        $("#certification_rsp").hide();
        
    });
    $("#tabContent").on("click","#education_edit_link",function(){
        $("#education_block").hide();
        $("#education_edit").show();
        
        $("#education_rsp").hide();
        
    });
    $("#tabContent").on("click","#practice_edit_link",function(){
        $("#practice_block").hide();
        $("#practice_edit").show();
        
        $("#practice_rsp").hide();
        
    });
    
    $(".contact_us_map_lnk").click(function(){
        popupContactUsMap();
    });
    
    $(".contact_us_email_lnk").click(function(){
        popupContactUsEmail();
    });
     
    
});

function popupContactUsMap(){
    FBox.fancybox.showLoading();
        $.ajax({
            type: "POST",
            url: SITE_URL+"employer/contact_us_map_popup",
            data: {
                
            },
            dataType: "json"
        }).success(function(rsp){
            FBox.fancybox({
                content: rsp.html,
                padding: 0,
                closeBtn: false,
                type: 'inline'
            });
        })
        .always(function(){
            FBox.fancybox.hideLoading();
        });
}
function popupContactUsEmail(){
    FBox.fancybox.showLoading();
    $.ajax({
        type: "POST",
        url: SITE_URL+"employer/contact_us_email_popup",
        data: {

        },
        dataType: "json"
    }).success(function(rsp){
        FBox.fancybox({
            content: rsp.html,
            padding: 0,
            closeBtn: false,
            type: 'inline'
        });
    })
    .always(function(){
        FBox.fancybox.hideLoading();
    });
}

function contact_info_save(){
    var flag = true;
    FBox.fancybox.showLoading();
    $.ajax({
        type: "POST",
        url: SITE_URL+"job_seeker_dashboard/contact_info_save",
        data: {
            first_name : $.trim($("#first_name").val()),
            last_name : $.trim($("#last_name").val()),
            address : $.trim($("#address").val()),
            apt : $.trim($("#apt").val()),
            city : $.trim($("#city").val()),
            state : $.trim($("#state").val()),
            zip : $.trim($("#zip").val()),
            phone : $.trim($("#phone").val()),
            alt_phone : $.trim($("#alt_phone").val())
        },
        dataType: "json",
        async: false
    }).success(function(rsp){
        if(rsp.status == "ok"){
            // continue then
            $("#contact_info_block").html(rsp.html);
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
function profession_save(){
    var flag = true;
    FBox.fancybox.showLoading();
    $.ajax({
        type: "POST",
        url: SITE_URL+"job_seeker_dashboard/profession_save",
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
            $("#profession_block").html(rsp.html);
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
function init_all_profiles_forms(){
    $("#contact_info_form").validate({
        errorPlacement: function(error, element) {
        },
        submitHandler: function(form) {
        }
    });
    $("#profession_form").validate({
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
    $("#add_certification_form").validate({
        errorPlacement: function(error, element) {
        },
        submitHandler: function(form) {
        }
    });
    $("#add_degree_form").validate({
        errorPlacement: function(error, element) {
        },
        submitHandler: function(form) {
        }
    });
    $("#add_residency_form").validate({
        errorPlacement: function(error, element) {
        },
        submitHandler: function(form) {
        }
    });
    $("#add_fellowship_form").validate({
        errorPlacement: function(error, element) {
        },
        submitHandler: function(form) {
        }
    });
    $("#add_practice_form").validate({
        errorPlacement: function(error, element) {
        },
        submitHandler: function(form) {
        }
    });
}

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

function show_default_tab(){
    FBox.fancybox.showLoading();
    $.ajax({
        type: "POST",
        url: SITE_URL+"job_seeker_dashboard/tab_profile",
        dataType: "json"
    }).success(function(rsp){
        $("#tabContent").html(rsp.html);
        init_all_profiles_forms();
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
function save_profile_form_6(){
    var flag = true;
    FBox.fancybox.showLoading();
    $.ajax({
        type: "POST",
        url: SITE_URL+"job_seeker_dashboard/save_profile_step_6",
        data: {
            position_type : $.trim($("#position_type").val()),
            service : $.trim($("#service").val()),
            institution_type : $.trim($("#institution_type").val()),
            patient_per_day : $.trim($("#patient_per_day").val()),
            salary : $.trim($("#salary").val()),
            availability : $.trim($("#availability").val())
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
function save_profile_form_7(){
    var flag = true;
    FBox.fancybox.showLoading();
    $.ajax({
        type: "POST",
        url: SITE_URL+"job_seeker_dashboard/save_profile_step_7",
        data: {
            criteria_1 : $.trim($("#criteria_1").val()),
            criteria_2 : $.trim($("#criteria_2").val()),
            criteria_3 : $.trim($("#criteria_3").val()),
            criteria_4 : $.trim($("#criteria_4").val()),
            ultimate_motivation : $.trim($("#ultimate_motivation").val()),
            selective_active_why : $.trim($("#selective_active_why").val()),
            ideal_job : $.trim($("#ideal_job").val())
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

