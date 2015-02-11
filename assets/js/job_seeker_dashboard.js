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
        
        if(step === "step_1"){
            FBox.fancybox.showLoading();
            $.ajax({
                type: "GET",
                url: SITE_URL+"job_seeker_dashboard/profile_step_1",
                dataType: "json"
            }).success(function(rsp){
                $("#tabContent").html(rsp.html);

                $("#form_profileStep1").validate({
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
        else if(step === "step_2"){
            
        }
        else if(step === "step_3"){
            
        }
        else if(step === "step_4"){
            
        }
        else if(step === "step_5"){
            
        }
    });
});

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

