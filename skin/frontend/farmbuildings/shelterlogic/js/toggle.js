
jQuery(document).on('click', '#myonoffswitch', function() {
    if (jQuery("#myonoffswitch").attr("checked")) {
        var showAvailable = true;
    } else {
        var showAvailable = false;
    }
    var params = {showAvailableProducts:showAvailable, pid: aeProductId, options: []};
    console.log(showAvailable);
    new Ajax.Request(aeConfigUrl, {
        method: 'post',
        requestHeaders: {Accept: 'application/json'},
        postBody: Object.toJSON(params),

        onSuccess: function (transport) {
            var result = transport.responseText.evalJSON(true);
            if( typeof result.options == 'undefined') {
                var select = jQuery("select[data-index=1]");
                jQuery('option', select).not(':eq(0)').remove();
            }
            if (result.options.length > 0) {
                var select = document.getElementById("attribute" + result.attributeid);
                jQuery('option', select).not(':eq(0)').remove();

                for (var i in result.options) {
                    if (result.options.hasOwnProperty(i)) {
                        var attr = result.options[i];
                        var opt = document.createElement('option');
                        opt.value = attr.id;
                        opt.innerHTML = attr.val;
                        opt.setAttribute('data-pid', 'data-pid');
                        select.appendChild(opt);
                    }
                }
                if (!showAvailable) {
                    jQuery('[data-id=atc-button]').hide();
                    jQuery('#span_id').show();
                } else {
                    jQuery('[data-id=atc-button]').show();
                    jQuery('#span_id').hide();
                }
            } else {
                jQuery("#myonoffswitch").attr("checked", true);
                alert('All products are available');
            }
        }
    });
});