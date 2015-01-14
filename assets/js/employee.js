var FB = jQuery.noConflict();
var $ = jQuery.noConflict();

var form_step = 0;
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
                type: 'inline',
//                openEffect: 'fade',
//                openSpeed: 150,
//                closeEffect: 'fade',
//                closeSpeed: 150,
//                closeBtn: false,
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
        form_step++;
        
        if(form_step == 2){
            window.location = BASE_URL+'employee_dashboard';
        }
        else{
            $("#employer-form1").hide();
            $("#employer-form2").show();
            return false;
        }
    });
    
    
    

});