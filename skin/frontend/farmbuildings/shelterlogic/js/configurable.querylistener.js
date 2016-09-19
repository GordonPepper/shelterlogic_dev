/// Avoid PrototypeJS conflicts, assign jQuery to $j instead of $
var $c = jQuery.noConflict();

// Use $j(document).ready() because Magento executes Prototype inline
$c(document).ready(function() {
	/*
	|--------------------------------------------------------------------------
	| query params listener
	|--------------------------------------------------------------------------
	*/
	function getconfigVars(qp){
	    var vars = [], hash;
	    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
	    for(var i = 0; i < hashes.length; i++)
	    {
	        hash = hashes[i].split('=');
	        if(hash[0].startsWith(qp)) {
	        	vars.push(hash[0]);
	        	vars[hash[0]] = hash[1];
	        }
	    }
	    return vars;
	}
	$c.each(getconfigVars("configurable_"), function(k, v) {
    	console.log(k + " , " + v);
  	});

});