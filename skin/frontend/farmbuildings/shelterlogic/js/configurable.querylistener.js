jQuery.fn.doesExist = function(){
        return jQuery(this).length > 0;
 };

/// Avoid PrototypeJS conflicts, assign jQuery to $j instead of $
var $c = jQuery.noConflict();

// Use $j(document).ready() because Magento executes Prototype inline
$c(document).ready(function() {
	/*
	|--------------------------------------------------------------------------
	| query params listener
	|--------------------------------------------------------------------------
	*/
	function setconfigVars(qp){
	    var vars = [], hash;
	    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
	    for(var i = 0; i < hashes.length; i++)
	    {
	        hash = hashes[i].split('=');
	        var className = 'select.'+hash[0];
	        if(hash[0].startsWith(qp) && $c(className).doesExist()) {
	        	$c(className).find('option[value='+hash[1]+']').attr('selected','selected');
	        	$c(className).trigger('change');
	        }
	    }
	    return vars;
	}
	var setterconfig = getconfigVars("configurable_");
	

});