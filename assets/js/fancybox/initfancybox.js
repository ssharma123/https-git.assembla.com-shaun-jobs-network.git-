
$(document).ready(function() {

    $('.fancybox').fancybox({
        padding: 0,
        openEffect: 'fade',
        openSpeed: 150,
        closeEffect: 'fade',
        closeSpeed: 150,
        closeClick: false,
        showCloseButton: false,
        autoCenter: true,
        helpers: {
            overlay: {
                closeClick : true,
                locked : false
            }
        }
    });
});
