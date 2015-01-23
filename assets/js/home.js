var FBox = jQuery.noConflict();
var $ = jQuery.noConflict();

var form_step = 1;
$(document).ready(function(){
    

    $("#employee_siginup_lnk").click(function(){
        
        
        FBox.fancybox.showLoading();
        $.ajax({
            type: "POST",
            url: SITE_URL+"employer/employer_popup",
            data: {
                
            },
            dataType: "json"
        }).success(function(rsp){
            FBox.fancybox({
                content: rsp.html,
                padding: 0,
                closeBtn: false,
                type: 'inline',
//                openEffect: 'fade',
//                openSpeed: 150,
//                closeEffect: 'fade',
//                closeSpeed: 150,
//                width: '800',
//                margin: [0, 0, 0, 0],
//                afterClose: function() {
//                },
//                afterShow: function() {
//                },
//                autoCenter: true,
//                helpers: {
//                    overlay: {
//                        closeClick : true,
//                        locked : false
//                    }
//                }
            });
        })
        .always(function(){
            FBox.fancybox.hideLoading();
        });
        
    });
    
    $("#form12-btn").click(function(){
        
        
        if(form_step >= 2){
            var form_step2 = $("#home-signup-btm-step2");
            var v2 = form_step2.valid();
            if(v2 == true){
                // make ajax call to save data
                $("#signupForm_btm2_rsp").hide();
                $("#signupForm_btm2_rsp").removeClass("error_rsp");
                
                form_step++;
                // sign up user form
                var signup = signup_employer_btm_form();
                if(signup.status == "ok"){
                    window.location.href = SITE_URL+'employee_dashboard';
                }
                else{
                    $("#signupForm_btm2_rsp").addClass("error_rsp");
                    $("#signupForm_btm2_rsp").html("oops something went wrong please try again").show();
                }
            }
            return false;
        }
        else{
            
            var v = $("#home-signup-btm-step1").valid();
            if(v == true){
                // do other things for a valid form
                $("#signupForm_btm1_rsp").hide();
                $("#signupForm_btm1_rsp").removeClass("error_rsp");
                var email = $("#signup2-email").val();

                if( employer_email_exist(email) === true){
                    $("#signupForm_btm1_rsp").addClass("error_rsp");
                    $("#signupForm_btm1_rsp").html("Email already Exist").show();
                }
                else{
                    form_step++;
                    $("#employer-form1").hide();
                    $("#employer-form2").show();
                    
                    $("#facility_name").val("");
                    $("#facility_address").val("");
                    $("#facility_zipCode").val("");
                    $("#facility_city").val("");
                    $("#facility_num_of_employee").val("");
                    $("#facility_num_of_bed").val("");
                    $("#billing_name").val("");
                    $("#billing_phone").val("");
                    $("#billing_email").val("");
                    
                }
                return false;
            }   
            else{
                return false;
            }
            
        }
    });
    
    $("#signupForm1").validate({
        messages: {
            'signup1-name': "Please specify your name",
            'signup1-email': {
                required: "Email is required",
                email: "Valid Email is required",
            },
            'signup1-facility':"Please specify your facility name"
        },
        submitHandler: function(form) {
            // do other things for a valid form
            $("#signupForm1_rsp").hide();
            $("#signupForm1_rsp").removeClass("error_rsp");
            var email = $("#signup1-email").val();
            if( employer_email_exist(email) === true){
                $("#signupForm1_rsp").addClass("error_rsp");
                $("#signupForm1_rsp").html("Email already Exist").show();
            }
            else{
                form.submit();    
            }
            
            return false;
        }
    });
    
    $("#home-signup-btm-step1").validate({
        rules: {
            signup2_confirm_password: {
                equalTo: "#signup2-password"
            },
            'signup2-password': {
                minlength: 6,
                required: true
            }
        },
        errorPlacement: function(error, element) {
            element.attr("placeholder",error.text());
        },
        submitHandler: function(form) {
        }
    });
    $("#home-signup-btm-step2").validate({
        rules: {
            signup2_confirm_password: {
                equalTo: "#signup2-password"
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
        }
        ,debug: true
    });
    
    
    
    
    
});