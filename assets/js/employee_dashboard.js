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
});