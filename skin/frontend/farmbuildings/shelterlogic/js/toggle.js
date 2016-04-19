
$(document).on('click', '#myonoffswitch', function() {
    if (jQuery("#myonoffswitch").attr("checked")) {
        var showAvailable = true;
    } else {
        var showAvailable = false;
    }
    console.log(showAvailable);
});