var $ = jQuery.noConflict();
$(document).ready(function(){
    $(".employerdashbordTabs").click(function(){
        
        var tab_id = $(this).attr('id');
        $(this).parent().parent().find('li').removeClass('active');
        $(this).parent().addClass('active');
        $(".employerdashbordTabs-items").hide('fast',function(){
            $("#"+tab_id+"-item").show();
        });
    });
});