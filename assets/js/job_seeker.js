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
    
    $(document).on("click",".job_match_div",function(e){
        e.stopImmediatePropagation();

        $("#job_match_list_id").hide();
        $("#job_match_detail_block").show();
        
        var id = $(this).attr("data-id");
        var percent = $(this).attr("data-percent");
        var dashboard = $(this).attr("data-dashboard");
        
        get_top_match_job_details(id , percent , dashboard);
        
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
    
    // facebook login
    $("#facebookLogin_jobseeker").click(function(e){
        e.preventDefault();
        e.stopImmediatePropagation();
        show_busy();
        loginToFacebook_jobseeker();
    });
    // linkedin login
    $("#linkedinLogin_jobseeker").click(function(e){
        e.preventDefault();
        e.stopImmediatePropagation();
        show_busy();
        window.open(BASE_URL+"job_seeker/linkedin_connect", "", "width=500, height=200");
    });
    
    $("#complete_sigin_facebook_jobseeker").click(function(){
        var rsp = {};
        rsp.id = $.trim ( $("#facebook_id").val() );
        rsp.first_name = $.trim( $("#first_name").val() );
        rsp.last_name = $.trim( $("#last_name").val() );
        rsp.email = $.trim( $("#email").val() );
        
        connect_with_facebook_jobseeker(rsp);
    });
    
});

function loginToFacebook_jobseeker(){
    $("#fb_error_msg").html('').removeClass();
    $("#fb_error_msg").hide();
    FB.login(function(response) {
            if (response.authResponse && response.status == "connected") {
                    
                    FB.api('/me', {fields: 'id,first_name,last_name,email'}, function(rsp) {
                        connect_with_facebook_jobseeker(rsp);
                    });
            }
            else if (response.status === "unknown" || response.status === "not_authorized") {
                $("#fb_error_msg").html('Login Error '+response.status+' user');
                $("#fb_error_msg").show();
                hide_busy();
            }
            else{
                $("#fb_error_msg").html('Oops something went wrong. Please try again').addClass('error_rsp');
                $("#fb_error_msg").show();
                hide_busy();
            }
    },{scope: 'email'});
}
function connect_with_facebook_jobseeker(rsp){
    $("#fb_error_msg").html('').removeClass();
    $("#fb_error_msg").hide();
    
    console.log(typeof rsp.id);
    console.log(typeof rsp.email);
    
    if( typeof rsp.id === undefined){
        $("#fb_error_msg").html('Oops something went wrong.Unable to read your data from facebook').addClass('error_rsp');
        $("#fb_error_msg").show();
        hide_busy();
    }
    else if ( (typeof rsp.first_name === undefined) && (typeof rsp.last_name === "undefined") ){
        $("#fb_error_msg").html('Oops something went wrong. Unable to read your data from facebook').addClass('error_rsp');
        $("#fb_error_msg").show();
        hide_busy();
    }
    else if( typeof rsp.email === undefined){
        $("#sigin_form_div").hide();
        $("#signin_email_form_div").show();
        
        $("#facebook_id").val(rsp.id);
        $("#name").val(rsp.first_name+" "+rsp.last_name);
        
    }
    else{
        $.ajax({
            type: "POST",
            url: BASE_URL+"job_seeker/facebook_connect",
            data: {
                id: rsp.id,
                first_name: rsp.first_name,
                last_name: rsp.last_name,
                email: rsp.email
            },
            dataType: "json"

        }).success(function(rsp){
            if(rsp.status == 'ok'){
                window.location = BASE_URL+'job_seeker_dashboard';
            }
            else{
                $("#fb_error_msg").html('Oops something went wrong. Please try again').addClass('error_rsp');
                $("#fb_error_msg").show();
            }
        }).always(function(){
            hide_busy();
        });
    }
}

function connect_with_linkedin_jobseeker(linkedin_id , first_name, last_name, email){
    $.ajax({
        type: "POST",
        url: BASE_URL+"job_seeker/linkedin_connect_save",
        data: {
            id: linkedin_id,
            first_name: first_name,
            last_name: last_name,
            email: email
        },
        dataType: "json"
        
    }).success(function(rsp){
        if(rsp.status == 'ok'){
            window.location = BASE_URL+'job_seeker_dashboard';
        }
        else{
            $("#fb_error_msg").html('Oops something went wrong. Please try again');
            $("#fb_error_msg").show();
        }
    }).always(function(){
        hide_busy();
    });
} 

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
function get_top_match_job_details(id , percent , dashboard){
    $("#job_match_detail_block").html("");
    var flag = false;
    FBox.fancybox.showLoading();
    $.ajax({
        type: "POST",
        url: SITE_URL+"job_seeker/get_top_match_job_details",
        data: {
            id: id,
            percent: percent,
            dashboard: dashboard
        },
        dataType: "json",
        async: false
    }).success(function(rsp){
        
        $("#job_match_list_id").hide();
        $("#job_match_detail_block").html(rsp.html);
        $("#job_match_detail_block").show();
        
    })
    .always(function(){
        FBox.fancybox.hideLoading();
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