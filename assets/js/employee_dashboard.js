var $ = jQuery.noConflict();
$(document).ready(function(){
    $(".employerdashbordTabs").click(function(){
        
        var tab_id = $(this).attr('id');
        $(this).parent().parent().find('li').removeClass('active');
        $(this).parent().addClass('active');
        $(".employerdashbordTabs-items").hide();
        $("#"+tab_id+"-item").fadeIn();
    });
    
    $("#new-job-post-btn").click(function(){
        var tab_id = $(this).attr('id');
        $(".employerdashbordTabs-items").hide();
        $("#"+tab_id+"-item").show();
        $(".post-job-steps").hide();
        $("#post-job-step1").fadeIn();
    });
    
    $(".post-form-continue-btn").click(function(){
        
        var step_to = $(this).attr('data-stepTo');
        $(".post-job-steps").hide();
        $("#post-job-step"+step_to).fadeIn();
        
    });
    $(".post-form-back").click(function(){
        
        var step_to = $(this).attr('data-backTo');
        $(".post-job-steps").hide();
        $("#post-job-step"+step_to).fadeIn();
        
    });
    
    $("#signup_sigin_form").validate({
        rules: {
            signin_confirm_password: {
                equalTo: "#signin_password"
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
});