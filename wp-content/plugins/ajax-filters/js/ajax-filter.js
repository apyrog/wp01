jQuery("#from_date").on("change", function(e) {
    get_ajax_filters();
})

function get_ajax_filters() {
    jQuery.ajax({
        url: ajaxurl,
        type: 'post',
        data: {
            action: 'ajax_filter',
            post_title: jQuery('#post_title').val(),
            from_date: jQuery('#from_date').val(),
            post_limit: jQuery('#post_limit').val()
        },
        success: function(data) {
            jQuery('#response').html( data );
        }
    });
    return false;
}
