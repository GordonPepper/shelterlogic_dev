	function showCC()
	{
		document.getElementById('payment_form_set_acimpro').style.display = 'block';
		document.getElementById('select_payment_form_acimpro').style.display = 'none';		
		document.getElementById("acimpro_cc_type").className = "";
		document.getElementById("acimpro_cc_number").className = "";
		document.getElementById("acimpro_expiration").className = "";
		document.getElementById("acimpro_expiration_yr").className = "";
		document.getElementById("acimpro_cc_cid").className = "";
	}
	
	function showAlreadyPaymethod()
	{
		document.getElementById('acimpro_cc_type_set').className = '';
		document.getElementById('select_payment_form_acimpro').style.display = 'block';
		document.getElementById('payment_form_set_acimpro').style.display = 'none';
		document.getElementById("acimpro_cc_type").className = "required-entry validate-cc-type-select";
		document.getElementById("acimpro_cc_number").className = "input-text validate-cc-number validate-cc-type";
		document.getElementById("acimpro_expiration").className = "month validate-cc-exp required-entry";
		document.getElementById("acimpro_expiration_yr").className = "year required-entry";
		document.getElementById("acimpro_cc_cid").className = "input-text cvv required-entry validate-cc-cvn";
	}