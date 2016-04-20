
$(document).on('click', '#myonoffswitch', function() {
    if (jQuery("#myonoffswitch").attr("checked")) {
        var showAvailable = true;
    } else {
        var showAvailable = false;
    }
    console.log(showAvailable);

    var pathname = window.location.pathname;

    //function callController(){
        new Ajax.Request(aeConfigUrl, {
            //method: 'Post',
            //parameters: {"showAvailableProducts":showAvailable},
            //onComplete: function(transport) {
            //
            //    alert(transport.responseText);
            //
            //}
            method:'Post',
            parameters: {showAvailableProducts:showAvailable},
            onSuccess: function(parameters) {
                //var response = transport.responseText || "no response text";
                //alert("Success! \n\n" ); //+ response);
                var showAvailableProducts = showAvailable;
                //alert('Success' + parameters);
            },
            onFailure: function() { alert('Something went wrong...'); }
        });
    //}
});