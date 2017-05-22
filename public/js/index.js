
jQuery(document).ready(function() {

    jQuery("#signin-submit").click(function() {
        jQuery('#bottom-bar-1').hide();
        jQuery('#bottom-bar-2').show();

    });
   /* $("#view-button").click(function() {
        
        $.ajax({
            type    : 'POST', 
            url     : 'index.php?m=greeting&a=hello',
            data    : {id : 0},
            cache   : false,
            success : function(result) {
            
            var div = $("#description-text");
            
            // Insert the dynamic data into the modal
            $('#myModal').find('.modal-body p').text('Array: ');
            div.show();
            $('#myModal').modal('show');
            
        }});
    });*/

    $(".view-comments").click(function() {
        $('#comments-modal').modal('show');
    });
});
