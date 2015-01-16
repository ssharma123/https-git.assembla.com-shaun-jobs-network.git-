//var $ = jQuery.noConflict();
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
    
    

});

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