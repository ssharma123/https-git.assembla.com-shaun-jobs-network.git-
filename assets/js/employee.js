//var $ = jQuery.noConflict();
var facebook_app_id = '786134894789637';
var base_url = "http://104.236.98.239/";
// FACEBOOK SIGNIN CODE
window.fbAsyncInit = function() {
    // init the FB JS SDK
    FB.init({
        appId: facebook_app_id, // App ID from the app dashboard
        status: true, // Check Facebook Login status
        xfbml: true,                                  // Look for social plugins on the page
        cookie:true,    
        oauth : true
    });
};
// Load the SDK asynchronously
(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) {
        return;
    }
    js = d.createElement(s);
    js.id = id;
    js.src = "//connect.facebook.net/en_US/all.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

if(typeof facilities == "undefined"){
    facilities = [];
}
$(document).ready(function(){
    
    $(".is_phone_number").mask('000-000-0000');
    $(".validate_form").validate({
        errorPlacement: function(error, element) {
            element.attr("placeholder",error.text());
        }
    });
    
    $(".facilities-auto").typeahead({
        source: facilities,
        display: 'name',
        val: 'id',
        itemSelected:function(data,value,text){
            $("#signup1-facility_id").val(value);
        }
    });
    
    $(".facilities-auto").keyup(function(){
        $("#signup1-facility_id").val('0');
    });
    
    $(".facilities-auto2").typeahead({
        source: facilities,
        display: 'name',
        val: 'id',
        itemSelected:function(data,value,text){
            $("#signup1-facility_id_2").val(value);
        }
    });
    $(".facilities-auto2").keyup(function(){
        $("#signup1-facility_id_2").val('0');
    });
    
        
    
    $("#signupForm2").validate({
        rules: {
            confirm_password: {
                equalTo: "#password"
            },
            'password': {
                minlength: 6,
                required: true
            },
            'billing_phone': {
                minlength: 10,
                required: true
            }
        },
        errorPlacement: function(error, element) {
            element.attr("placeholder",error.text());
        },
        submitHandler: function(form) {
            // do other things for a valid form
            $("#signupForm2_rsp").hide();
            $("#signupForm2_rsp").removeClass("error_rsp");
            var email = $("#signup_email").val();
            if( employer_email_exist(email) === true){
                $("#signupForm2_rsp").addClass("error_rsp");
                $("#signupForm2_rsp").html("Email already Exist").show();
            }
            else{
                form.submit();    
            }
            
            return false;
        }
    });
    
    
    // facebook login
    $("#facebookLogin").click(function(e){
        e.preventDefault();
        e.stopImmediatePropagation();
        show_busy();
        loginToFacebook();
    });
    // linkedin login
    $("#linkedinLogin").click(function(e){
        e.preventDefault();
        e.stopImmediatePropagation();
        show_busy();
        window.open(base_url+"employer/linkedin_connect", "", "width=500, height=200");
    });
    
    
    
    if( $("#paypal_checkout_form").length > 0){
        $("#paypal_checkout_form").validate({
             
            errorPlacement: function(error, element) {
                element.attr("placeholder",error.text());
            },
            submitHandler: function(form) {
                 
                    form.submit();    

                return false;
            }
        });
    }

});
function loginToFacebook(){
    $("#fb_error_msg").html('').removeClass();
    $("#fb_error_msg").hide();
    FB.login(function(response) {
            if (response.authResponse && response.status == "connected") {
                    
                    FB.api('/me', {fields: 'id,first_name,last_name,email'}, function(rsp) {
                        connect_with_facebook(rsp);
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
function connect_with_facebook(rsp){
    $("#fb_error_msg").html('').removeClass();
    $("#fb_error_msg").hide();
    $.ajax({
        type: "POST",
        url: base_url+"employer/facebook_connect",
        data: {
            id: rsp.id,
            name: rsp.first_name+" "+rsp.last_name,
            email: rsp.email
        },
        dataType: "json"
        
    }).success(function(rsp){
        if(rsp.status == 'ok'){
            window.location = base_url+'employee_dashboard';
        }
        else{
            $("#fb_error_msg").html('Oops something went wrong. Please try again').addClass('error_rsp');
            $("#fb_error_msg").show();
        }
    }).always(function(){
        hide_busy();
    });
        
}

function connect_with_linkedin(linkedin_id , name, email){
     
    $.ajax({
        type: "POST",
        url: base_url+"employer/linkedin_connect_save",
        data: {
            id: linkedin_id,
            name: name,
            email: email
        },
        dataType: "json"
        
    }).success(function(rsp){
        if(rsp.status == 'ok'){
            window.location = base_url+'employee_dashboard';
        }
        else{
            $("#fb_error_msg").html('Oops something went wrong. Please try again');
            $("#fb_error_msg").show();
        }
    }).always(function(){
        hide_busy();
    });
        
}
function show_busy(){
    $("#connect_btn_busy").show();
}
function hide_busy(){
    $("#connect_btn_busy").hide();
}
function employer_email_exist(email){
    var flag = false;
    $.ajax({
        type: "POST",
        url: SITE_URL+"employer/email_exist",
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
function signup_employer_btm_form(){
    var flag = false;
    $.ajax({
        type: "POST",
        url: SITE_URL+"employer/employer_signup_btm_form",
        data: {
            signup_name: $.trim($("#signup2-name").val()),
            signup_email: $.trim($("#signup2-email").val()),
            password: $.trim($("#signup2-password").val()),
            confirm_password: $.trim($("#signup2_confirm_password").val()),
            signup_facility: $.trim($("#signup2-facility").val()),
            signup_facility_id: $.trim($("#signup1-facility_id_2").val()),
            facility_name: $.trim($("#facility_name").val()),
            facility_address: $.trim($("#facility_address").val()),
            facility_zipCode: $.trim($("#facility_zipCode").val()),
            facility_city: $.trim($("#facility_city").val()),
            facility_num_of_employee: $.trim($("#facility_num_of_employee").val()),
            facility_num_of_bed: $.trim($("#facility_num_of_bed").val()),
            billing_name: $.trim($("#billing_name").val()),
            billing_phone: $.trim($("#billing_phone").val()),
            billing_email: $.trim($("#billing_email").val())
        },
        dataType: "json",
        async: false
    }).success(function(rsp){
        flag = rsp;
    });
    return flag;
}