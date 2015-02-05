var FBox = jQuery.noConflict();
var $ = jQuery.noConflict();
$(document).ready(function(){
    
    $(".is_phone_number").mask('000-000-0000');
    $.validator.addMethod("greaterThan", function (value, element, param) {
        var $min = $(param);

        if (this.settings.onfocusout) {
            $min.off(".validate-greaterThan").on("blur.validate-greaterThan", function () {
                $(element).valid();
            });
        }

        return parseInt(value) > parseInt($min.val());
    }, "Max must be greater than min value");
    
                        
    $(".employerdashbordTabs").click(function(){
        
        var tab_id = $(this).attr('id');
        $(this).parent().parent().find('li').removeClass('active');
        $(this).parent().addClass('active');
        $(".employerdashbordTabs-items").hide();
        $("#"+tab_id+"-item").fadeIn();
    });
    $("#tabJobPost").click(function(){
        $("#rsp_post-job-container").hide();
        
        $(this).parent().parent().find('li').removeClass('active');
        $(this).parent().addClass('active');
        $(".employerdashbordTabs-items").hide();
        $("#post-job-container").hide();
        $("#new-job-post-btn-item").show();
        FBox.fancybox.showLoading();
        $.ajax({
            type: "GET",
            url: SITE_URL+"employee_dashboard/dashboard_job_list",
            dataType: "json"
        }).success(function(rsp){
            $("#post-job-container").html(rsp.html);
            $("#post-job-container").fadeIn();
        })
        .always(function(){
            FBox.fancybox.hideLoading();
        }); 
         
        
        
    });
    
    $("#tabSetting").click(function(){
        $("#rsp_post-job-container").hide();
        
        $(this).parent().parent().find('li').removeClass('active');
        $(this).parent().addClass('active');
        $(".employerdashbordTabs-items").hide();
        $("#post-job-container").hide();
        $("#new-job-post-btn-item").show();
        FBox.fancybox.showLoading();
        $.ajax({
            type: "GET",
            url: SITE_URL+"employee_dashboard/dashboard_settings",
            dataType: "json"
        }).success(function(rsp){
            $("#post-job-container").html(rsp.html);
            $("#post-job-container").fadeIn();
        })
        .always(function(){
            FBox.fancybox.hideLoading();
        }); 
    });
    $("#tabStatus").click(function(){
        $("#rsp_post-job-container").hide();
        
        $(this).parent().parent().find('li').removeClass('active');
        $(this).parent().addClass('active');
        $(".employerdashbordTabs-items").hide();
        $("#post-job-container").hide();
        $("#new-job-post-btn-item").show();
        FBox.fancybox.showLoading();
        $.ajax({
            type: "GET",
            url: SITE_URL+"employee_dashboard/dashboard_status",
            dataType: "json"
        }).success(function(rsp){
            $("#post-job-container").html(rsp.html);
            $("#post-job-container").fadeIn();
        })
        .always(function(){
            FBox.fancybox.hideLoading();
        }); 
    });
    
    $("#tabMatches").click(function(){
        $("#rsp_post-job-container").hide();
        
        $(this).parent().parent().find('li').removeClass('active');
        $(this).parent().addClass('active');
        $(".employerdashbordTabs-items").hide();
        $("#post-job-container").hide();
        $("#new-job-post-btn-item").show();
        FBox.fancybox.showLoading();
        $.ajax({
            type: "GET",
            url: SITE_URL+"employee_dashboard/dashboard_matches",
            dataType: "json"
        }).success(function(rsp){
            $("#post-job-container").html(rsp.html);
            $("#post-job-container").fadeIn();
        })
        .always(function(){
            FBox.fancybox.hideLoading();
        }); 
    });
    
    
    $("#new-job-post-btn").click(function(){
        // Fix date picker issue 
        $("#ui-datepicker-div").remove();
        
        var tab_id = $(this).attr('id');
        console.log(tab_id);
        $(".employerdashbordTabs-items").hide();
        $("#"+tab_id+"-item").show();
//        $(".post-job-steps").hide();
//        $("#post-job-step1").fadeIn();
        
        FBox.fancybox.showLoading();
        $.ajax({
            type: "GET",
            url: SITE_URL+"employee_dashboard/job_post_step_1",
            dataType: "json"
        }).success(function(rsp){
            $("#post-job-container").html(rsp.html);
            $("#form_jobStep1").validate({
                errorPlacement: function(error, element) {
                    element.attr("placeholder",error.text());
                },
                submitHandler: function(form) {
                    
                }
            });
            
        })
        .always(function(){
            FBox.fancybox.hideLoading();
        }); 
         
        $("#post-job-container").fadeIn();
        
    });
    $("#new-job-post-btn2").click(function(){
        // Fix date picker issue 
        $("#ui-datepicker-div").remove();
        
        $(".employerdashbordTabs-items").hide();
        $(".new-job-post-div").show();
        //$(".post-job-steps").hide();
        
         
        FBox.fancybox.showLoading();
        $.ajax({
            type: "POST",
            url: SITE_URL+"employee_dashboard/job_post_step_1",
            data: {
            },
            dataType: "json"
        }).success(function(rsp){
            $("#post-job-container").html(rsp.html);
            $("#form_jobStep1").validate({
                errorPlacement: function(error, element) {
                    element.attr("placeholder",error.text());
                },
                submitHandler: function(form) {
                    
                }
            });
        })
        .always(function(){
            FBox.fancybox.hideLoading();
        }); 
         
        $("#post-job-container").fadeIn();
    });
    
    $("#post-job-container").on("click","#go_to_jobs_dashboard_btn",function(){
        $("#tabJobPost").click();
    });
    
    $("#post-job-container").on("click",".post-form-continue-btn",function(){
        var id = $(this).attr('id');
        console.log(id);
        $("#rsp_post-job-container").html("").show();
        $("#rsp_post-job-container").removeClass();
        
        if(id === "continue-step1"){
            var valid_1 = $("#form_jobStep1").valid();
            if(valid_1 === true){
                
                var save_form_1 =save_job_data_form_1();
                
                if(save_form_1 == true){
                    FBox.fancybox.showLoading();
                    $.ajax({
                        type: "GET",
                        url: SITE_URL+"employee_dashboard/job_post_step_2",
                        dataType: "json"
                    }).success(function(rsp){
                        $("#post-job-container").html(rsp.html);

                        $("#form_jobStep2").validate({
                            errorPlacement: function(error, element) {
                                element.attr("placeholder",error.text());
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
        else if (id === "continue-step2"){
            var valid_2 = $("#form_jobStep2").valid();
            if(valid_2 === true){
                
                var save_form_2 =save_job_data_form_2();
                
                if(save_form_2 == true){
                    FBox.fancybox.showLoading();
                    $.ajax({
                        type: "GET",
                        url: SITE_URL+"employee_dashboard/job_post_step_3",
                        dataType: "json"
                    }).success(function(rsp){
                        $("#post-job-container").html(rsp.html);

                        $("#form_jobStep3").validate({
                            errorPlacement: function(error, element) {
                                element.attr("placeholder",error.text());
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
        else if (id === "continue-step3"){
            var valid_3 = $("#form_jobStep3").valid();
            if(valid_3 === true){
                
                var save_form_3 = save_job_data_form_3();
                if(save_form_3 == true){
                    FBox.fancybox.showLoading();
                    $.ajax({
                        type: "GET",
                        url: SITE_URL+"employee_dashboard/job_post_step_4",
                        dataType: "json"
                    }).success(function(rsp){
                        $("#post-job-container").html(rsp.html);

                        $("#form_jobStep4").validate({
                            errorPlacement: function(error, element) {
                                element.attr("placeholder",error.text());
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
        else if (id === "continue-step4"){
            var valid_4 = $("#form_jobStep4").valid();
            if(valid_4 === true){
                
                var save_form_4 = save_job_data_form_4();
                if(save_form_4 == true){
                    FBox.fancybox.showLoading();
                    $.ajax({
                        type: "GET",
                        url: SITE_URL+"employee_dashboard/job_post_step_5",
                        dataType: "json"
                    }).success(function(rsp){
                        $("#post-job-container").html(rsp.html);
                        
                        
                        $("#form_jobStep5").validate({
                            errorPlacement: function(error, element) {
                                element.attr("placeholder",error.text());
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
        else if (id === "continue-step5"){
            var valid_5 = $("#form_jobStep5").valid();
            if(valid_5 === true){
                
                var save_form_5 = save_job_data_form_5();
                if(save_form_5 !== false){
                    if(save_form_5.mode == "update" ){
                        $("#tabJobPost").click();
                    }
                    else{
                        FBox.fancybox.showLoading();
                        $.ajax({
                            type: "GET",
                            url: SITE_URL+"employee_dashboard/job_post_step_6",
                            dataType: "json"
                        }).success(function(rsp){
                            $("#post-job-container").html(rsp.html);
                            
                            
                            
                            $("#form_jobStep6").validate({
                                errorPlacement: function(error, element) {
                                    if(element.attr("id") == "agree_to_term"){
                                        $("#agree_to_term").parent().css("color","#FF0000");
                                    }
                                    element.attr("placeholder",error.text());
                                },
                                submitHandler: function(form) {
                                    $("#agree_to_term").parent().css("color","");
                                }
                            });


                        })
                        .always(function(){
                            FBox.fancybox.hideLoading();
                        }); 
                    }
                }
            }
        }
        else if (id === "continue-step6"){
            var valid_6 = $("#form_jobStep6").valid();
            if(valid_6 === true){
                
                var save_form_6 = save_job_data_form_6();
                if(save_form_6 == true){
                    FBox.fancybox.showLoading();
                    $.ajax({
                        type: "GET",
                        url: SITE_URL+"employee_dashboard/job_post_step_7",
                        dataType: "json"
                    }).success(function(rsp){
                        $("#post-job-container").html(rsp.html);
                        
                    })
                    .always(function(){
                        FBox.fancybox.hideLoading();
                    }); 
                }
            }
        }
        else if (id === "skip-step6"){
                
            FBox.fancybox.showLoading();
            $.ajax({
                type: "GET",
                url: SITE_URL+"employee_dashboard/job_post_step_7",
                dataType: "json"
            }).success(function(rsp){
                $("#post-job-container").html(rsp.html);

            })
            .always(function(){
                FBox.fancybox.hideLoading();
            }); 
        }
        
        
    });
        
    
    $(".post-form-back").click(function(){
        
        var step_to = $(this).attr('data-backTo');
        $(".post-job-steps").hide();
        $("#post-job-step"+step_to).fadeIn();
        
    });
    
    if( $("#signup_sigin_form").length > 0){
        $("#signup_sigin_form").validate({
            rules: {
                'confirm_password': {
                    equalTo: "#signin_password_2"
                },
                'password': {
                    minlength: 6,
                    required: true
                },
                'signup_phone': {
                    minlength: 10,
                    required: true
                }
            },
            errorPlacement: function(error, element) {
                element.attr("placeholder",error.text());
            },
            submitHandler: function(form) {
                $("#signup_signin_form_rsp").hide();
                $("#signup_signin_form_rsp").removeClass("error_rsp");
                var email = $("#signin_signup_email").val();
                if( employer_email_exist(email) === true){
                    $("#signup_signin_form_rsp").addClass("error_rsp");
                    $("#signup_signin_form_rsp").html("Email already Exist").show();
                }
                else{
                    form.submit();    
                }

                return false;
            }
        });
    }
    
    
    $(".paynow_temp").click(function(){
        
        
        FBox.fancybox.showLoading();
        $.ajax({
            type: "POST",
            url: SITE_URL+"employee_dashboard/payment_popup",
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
        
    });
    
    
    $("#post-job-container").on("change",".parent_speciality",function(){
       parent_speciality_change(); 
    });
    
    $("#post-job-container").on("click","#change_email_link",function(){
       $("#change_email_div").toggle();
    });
    $("#post-job-container").on("click","#change_pass_link",function(){
       $("#change_passwrod_div").toggle();
    });
    
    
    $("#post-job-container").on("click",".delete_job_dashboard",function(){
        var job_id = $(this).attr("data-value");
        
        $("#rsp_post-job-container").html("");
        $("#rsp_post-job-container").removeClass().hide();
        
        bootbox.confirm("Are you sure?", function(result) {
            if(result === true){
                var rsp = delete_job(job_id);
                if(rsp !== false){
                    $("#rsp_post-job-container").html(rsp.msg);
                    $("#rsp_post-job-container").addClass("success_rsp").show();
                }
            }
        }); 
         
    });
    
    
    
    $("#post-job-container").on("click",".edit_job_dashboard",function(){
        $("#ui-datepicker-div").remove();
        
        var job_id = $(this).attr("data-value");
        
        $("#rsp_post-job-container").html("");
        $("#rsp_post-job-container").removeClass().hide();
        
        $(".employerdashbordTabs-items").hide();
        $(".new-job-post-div").show();
        //$(".post-job-steps").hide();
        
         
        FBox.fancybox.showLoading();
        $.ajax({
            type: "POST",
            url: SITE_URL+"employee_dashboard/job_post_step_1",
            data: {
                recent_job_id: job_id
            },
            dataType: "json"
        }).success(function(rsp){
            $("#post-job-container").html(rsp.html);
            $("#form_jobStep1").validate({
                errorPlacement: function(error, element) {
                    element.attr("placeholder",error.text());
                },
                submitHandler: function(form) {
                    
                }
            });
        })
        .always(function(){
            FBox.fancybox.hideLoading();
        });
         
        $("#post-job-container").fadeIn();
         
    });
    
    $("#post-job-container").on("click",".matches_link",function(){
        
        var applied_job_div = $(this).parent().parent().parent().next();
        if(applied_job_div.hasClass("applied_jobs_div")){
            $(applied_job_div).toggle();
        }
        var plus = $(this).find(".glyphicon");
        
        if( plus.hasClass("glyphicon-plus-sign") ){
            plus.removeClass("glyphicon-plus-sign").addClass("glyphicon-minus-sign");
        }
        else{
            plus.removeClass("glyphicon-minus-sign").addClass("glyphicon-plus-sign");
        }
        
        
    });
     
    $(".contact_us_map_lnk").click(function(){
        popupContactUsMap();
    });
    
    $(".contact_us_email_lnk").click(function(){
        popupContactUsEmail();
    });
    
    $("#post-job-container").on("click",".update_job_status",function(){
        
        var element = $(this);
        var type = $(this).attr("data-type");
        var id = $(this).attr("data-id");
        
        update_job_status(element ,id, type);
        
    });
    
    $("#post-job-container").on("click",".delete_job_applied",function(){
        var job_applied_id = $(this).attr("data-value");
        
        bootbox.confirm("Are you sure?", function(result) {
            if(result === true){
                var rsp = delete_job_applied(job_applied_id);
                if(rsp !== false){
                    $("#rsp_post-job-container").html(rsp.msg);
                    $("#rsp_post-job-container").addClass("success_rsp").show();
                }
            }
        }); 
    });
    
});

function update_job_status(element , id, type){
    var flag = true;
    FBox.fancybox.showLoading();
    $.ajax({
        type: "POST",
        url: SITE_URL+"employee_dashboard/update_job_status",
        data: {
            id : $.trim(id),
            type : $.trim(type),
        },
        dataType: "json",
        async: false
    }).success(function(rsp){
        if(rsp.status == "ok"){
            // continue then
            
            if(type === "interview"){
                bootbox.alert("Interview Offered");
                
                element.removeClass("update_job_status");
                element.removeClass("btn-danger");
                element.addClass("btn-success");
            }
            else if(type === "face_2_face"){
                popupFace2Face(element, id);
            }
            else if(type === "job_offer"){
                popupJobOffer(element, id);
            }
            else{
                element.removeClass("update_job_status");
                element.removeClass("btn-danger");
                element.addClass("btn-success");
            }
        }
        else{
            flag = false;
        }
    })
    .always(function(){
        FBox.fancybox.hideLoading();
    });
    return flag;
}
function popupFace2Face(element , id){
    
    var btn_id = element.attr("id");
    
    FBox.fancybox.showLoading();
    $.ajax({
        type: "POST",
        url: SITE_URL+"employee_dashboard/popup_face_2_face",
        data: {
            id : id,
            btn_id : btn_id
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
function popupJobOffer(element , id){
    
    var btn_id = element.attr("id");
    
    FBox.fancybox.showLoading();
    $.ajax({
        type: "POST",
        url: SITE_URL+"employee_dashboard/popup_job_offer",
        data: {
            id : id,
            btn_id : btn_id
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

function show_welcome_popup(){
    FBox.fancybox.showLoading();
    $.ajax({
        type: "POST",
        url: SITE_URL+"employee_dashboard/welcome_popup",
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

function parent_speciality_change(){
    $.ajax({
        type: "POST",
        url: SITE_URL+"employee_dashboard/get_specialties/sub",
        data: {
            parent_id : $.trim($("#specialty").val()),
            options: 'true'
        },
        dataType: "json",
    }).success(function(rsp){
        $("#sub_specialty").html(rsp.html); 
    });
}
function save_job_data_form_1(){
    var flag = true;
    FBox.fancybox.showLoading();
    $.ajax({
        type: "POST",
        url: SITE_URL+"employee_dashboard/save_job_post_step_1",
        data: {
            internal_id : $.trim($("#internal_id").val()),
            specialty : $.trim($("#specialty").val()),
            sub_specialty : $.trim($("#sub_specialty").val()),
            job_headline : $.trim($("#job_headline").val()),
            title : $.trim($("#title").val()),
            fill_by : $.trim($("#fill_by").val()),
            position_type : $.trim($("#position_type").val()),
            employment_length : $.trim($("#employment_length").val()),
            prefered_designation : $.trim($("#prefered_designation").val()),
        },
        dataType: "json",
        async: false
    }).success(function(rsp){
        if(rsp.status == "ok"){
            // continue then
        }
        else{
            flag = false;
            $("#rsp_post-job-container").html(rsp).show();
            $("#rsp_post-job-container").addClass("error_rsp");
        }
    })
    .always(function(){
        FBox.fancybox.hideLoading();
    });
    return flag;
}
function save_job_data_form_2(){
    var flag = true;
    FBox.fancybox.showLoading();
    $.ajax({
        type: "POST",
        url: SITE_URL+"employee_dashboard/save_job_post_step_2",
        data: {
            active_license_requires_certification : $("#active_license_requires_certification").is(":checked"),
            requires_bls_certification : $("#requires_bls_certification").is(":checked"),
            accept_ji_certification : $("#accept_ji_certification").is(":checked")
        },
        dataType: "json",
        async: false
    }).success(function(rsp){
        if(rsp.status == "ok"){
            // continue then
        }
        else{
            flag = false;
            $("#rsp_post-job-container").html(rsp).show();
            $("#rsp_post-job-container").addClass("error_rsp");
        }
    })
    .always(function(){
        FBox.fancybox.hideLoading();
    });
    return flag;
}
function save_job_data_form_3(){
    var flag = true;
    FBox.fancybox.showLoading();
    $.ajax({
        type: "POST",
        url: SITE_URL+"employee_dashboard/save_job_post_step_3",
        data: {
            department_size : $.trim($("#department_size").val()),
            patients_per_day : $.trim($("#patients_per_day").val()),
            in_patient : $("#in_patient").is(":checked"),
            out_patient : $("#out_patient").is(":checked"),
            work_schedule : $.trim($("#work_schedule").val()),
            custom_work_schedule : $.trim($("#custom_work_schedule").val()),
            call_schedule : $.trim($("#call_schedule").val()),
        },
        dataType: "json",
        async: false
    }).success(function(rsp){
        if(rsp.status == "ok"){
            // continue then
        }
        else{
            flag = false;
            $("#rsp_post-job-container").html(rsp).show();
            $("#rsp_post-job-container").addClass("error_rsp");
        }
    })
    .always(function(){
        FBox.fancybox.hideLoading();
    });
    return flag;
}
function save_job_data_form_4(){
    var flag = true;
    FBox.fancybox.showLoading();
    $.ajax({
        type: "POST",
        url: SITE_URL+"employee_dashboard/save_job_post_step_4",
        data: {
            salary_range : $.trim($("#salary_range").val()),
            salary_range_min : $.trim($("#salary_range_min").val()),
            salary_range_max : $.trim($("#salary_range_max").val()),
            bonus : $.trim($("#bonus").val()),
            pay_frequency : $.trim($("#pay_frequency").val()),
            benifits_401k : $("#benifits_401k").is(":checked"),
            benifits_cme_allowance : $("#benifits_cme_allowance").is(":checked"),
            benifits_loan : $("#benifits_loan").is(":checked"),
            vacation_days : $.trim($("#vacation_days").val()),
            employment_term : $.trim($("#employment_term").val())
        },
        dataType: "json",
        async: false
    }).success(function(rsp){
        if(rsp.status == "ok"){
            // continue then
        }
        else{
            flag = false;
            $("#rsp_post-job-container").html(rsp).show();
            $("#rsp_post-job-container").addClass("error_rsp");
        }
    })
    .always(function(){
        FBox.fancybox.hideLoading();
    });
    return flag;
}
function save_job_data_form_5(){
    var flag = true;
    FBox.fancybox.showLoading();
    $.ajax({
        type: "POST",
        url: SITE_URL+"employee_dashboard/save_job_post_step_5",
        data: {
            citizen : $("#citizen").is(":checked"),
            green_card : $("#green_card").is(":checked"),
            visa : $("#visa").is(":checked"),
            description : $.trim($("#description").val())
        },
        dataType: "json",
        async: false
    }).success(function(rsp){
        if(rsp.status == "ok"){
            // continue then
            flag = rsp;
        }
        else{
            flag = false;
            $("#rsp_post-job-container").html(rsp).show();
            $("#rsp_post-job-container").addClass("error_rsp");
        }
    })
    .always(function(){
        FBox.fancybox.hideLoading();
    });
    return flag;
}
function save_job_data_form_6(){
    var flag = true;
    FBox.fancybox.showLoading();
    $.ajax({
        type: "POST",
        url: SITE_URL+"employee_dashboard/save_job_post_step_6",
        data: {
            auth_first_name : $.trim($("#auth_first_name").val()),
            auth_last_name : $.trim($("#auth_last_name").val()),
            agree_to_term : $("#agree_to_term").is(":checked")
        },
        dataType: "json",
        async: false
    }).success(function(rsp){
        if(rsp.status == "ok"){
            // continue then
        }
        else{
            flag = false;
            $("#rsp_post-job-container").html(rsp).show();
            $("#rsp_post-job-container").addClass("error_rsp");
        }
    })
    .always(function(){
        FBox.fancybox.hideLoading();
    });
    return flag;
}

function delete_job(job_id){
    var flag = false;
    $.ajax({
        type: "POST",
        url: SITE_URL+"employee_dashboard/delete_job/",
        data: {
            job_id : $.trim(job_id)
        },
        dataType: "json",
        async: false
    }).success(function(rsp){
         if(rsp.status === "ok"){
             $("#job-list-item_"+job_id).remove();
             flag = rsp;
         }
    });
    return flag;
}
function delete_job_applied(job_app_id){
    var flag = false;
    $.ajax({
        type: "POST",
        url: SITE_URL+"employee_dashboard/delete_job_applied/",
        data: {
            job_app_id : $.trim(job_app_id)
        },
        dataType: "json",
        async: false
    }).success(function(rsp){
         if(rsp.status === "ok"){
             $("#job-applied-list-item_"+job_app_id).remove();
             flag = rsp;
         }
    });
    return flag;
}

