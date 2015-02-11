var FBox = jQuery.noConflict();
var $ = jQuery.noConflict();

if(typeof states == "undefined"){
    states = [];
}
$(document).ready(function(){
    
    
    
    

    $(".lets_start_popup").click(function(){
        
        
        FBox.fancybox.showLoading();
        $.ajax({
            type: "POST",
            url: SITE_URL+"job_seeker/let_start_popup",
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
    
    $(document).on("change",".parent_speciality",function(){
       parent_speciality_change(); 
    });
    
    $(".job_match_div").click(function(){
        $("#job_match_list_id").hide();
        $("#job_match_detail_block").show();
        
    });
    
    
    $("#job_seeker_signup").validate({
        rules: {
            confirm_password: {
                equalTo: "#password",
                required: true
            },
            'password': {
                minlength: 6,
                required: true
            },
            'phone': {
                minlength: 10,
                required: true
            }
        },
        errorPlacement: function(error, element) {
            element.attr("placeholder",error.text());
        },
        submitHandler: function(form) {
            // do other things for a valid form
            $("#jobseeker_signup_rsp").hide();
            $("#jobseeker_signup_rsp").removeClass("error_rsp");
            var email = $("#signup_email").val();
            if( job_seeker_email_exist(email) === true){
                $("#jobseeker_signup_rsp").addClass("error_rsp");
                $("#jobseeker_signup_rsp").html("Email already Exist").show();
            }
            else{
                form.submit();    
            }
            
            return false;
        }
    });
    
    
});

function job_seeker_email_exist(email){
    var flag = false;
    $.ajax({
        type: "POST",
        url: SITE_URL+"job_seeker/email_exist",
        data: {
            email: email
        },
        dataType: "json",
        async: false
    }).success(function(rsp){
        if(rsp.status === "ok"){
            flag = true;
        }
        else{
            flag = false;
        }
    });
    return flag;
}

function parent_speciality_change(){
    if($("#specialty").val() !== ""){
        $.ajax({
            type: "POST",
            url: SITE_URL+"job_seeker/get_specialties/sub",
            data: {
                parent_id : $.trim($("#specialty").val()),
                options: 'true'
            },
            dataType: "json",
        }).success(function(rsp){
            $("#sub_specialty").html(rsp.html); 
        });
    }
}