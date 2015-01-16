var FB = jQuery.noConflict();
var $ = jQuery.noConflict();

var form_step = 1;
$(document).ready(function(){
    

    $("#employee_siginup_lnk").click(function(){
        
        
        FB.fancybox.showLoading();
        $.ajax({
            type: "POST",
            url: SITE_URL+"employer/employer_popup",
            data: {
                
            },
            dataType: "json"
        }).success(function(rsp){
            FB.fancybox({
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
            FB.fancybox.hideLoading();
        });
        
    });
    
    $("#form12-btn").click(function(){
        
        
        if(form_step == 2){
            var form_step2 = $("#home-signup-btm-step2");
            var v2 = form_step2.valid();
            if(v2 == true){
                // make ajax call to save data
                $("#signupForm_btm2_rsp").hide();
                $("#signupForm_btm2_rsp").removeClass("error_rsp");
                
                form_step++;
                // sign up user form
                var signup = signup_employer_btm_form();
                console.log(signup)
                if(signup.status == "ok"){
                    window.location.href = SITE_URL+'employee_dashboard';
                }
                else{
                    $("#signupForm_btm1_rsp").addClass("error_rsp");
                    $("#signupForm_btm1_rsp").html("oops something went wrong please try again").show();
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
                }
                return false;
            }   
            else{
                return false;
            }
            
        }
    });
    
    $("#signupForm1").validate({
        errorPlacement: function(error, element) {
            element.attr("placeholder",error.text());
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
            }
        },
        errorPlacement: function(error, element) {
            element.attr("placeholder",error.text());
        },
        submitHandler: function(form) {
        }
        ,debug: true
    });
    $("#home-signup-btm-step2").validate({
        errorPlacement: function(error, element) {
            element.attr("placeholder",error.text());
        },
        submitHandler: function(form) {
        }
        ,debug: true
    });
    
    
    
    

});