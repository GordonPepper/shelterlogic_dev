//jQuery.noconflict();
(function($){
$(document).foundation({
	reveal : {
	    close_on_background_click: false
	},
	 
});
$.cookie.raw = true;

// ==========================
// delete this on live form it is hear only to emulate the live form on insitesoft
// ==========================


function __doPostBack (id) {
	//$('form').submit();
	farmBuilding.init.getState();
}

// ==========================
// end delete above for live form
// ==========================


// does exist
jQuery.fn.doesExist = function(){
        return jQuery(this).length > 0;
};
jQuery.fn.centerCenter = function(){
 if(jQuery(this).length <= 0)return false;
 jQuery(this).each(function(){
   //get height and width (unitless) and divide by 2
   var hWide = ($(this).outerWidth())/2; //half the image's width
   var hTall = ($(this).outerHeight())/2; //half the image's height, etc.

   // attach negative and pixel for CSS rule
   hWide = '-' + hWide + 'px';
   hTall = '-' + hTall + 'px';

   $(this).css({
     "margin-left" : hWide,
     "margin-top" : hTall
   });
 });
};
jQuery.fn.centerVertical = function(){
 if(jQuery(this).length <= 0)return false;
 jQuery(this).each(function(){
   //get height and width (unitless) and divide by 2
   var hTall = ($(this).height())/2; //half the image's height, etc.

   // attach negative and pixel for CSS rule
   hTall = '-' + hTall + 'px';

   $(this).css({
     "margin-top" : hTall
   });
 });
};
jQuery.fn.centerHorizontal = function(){
 if(jQuery(this).length <= 0)return false;
 jQuery(this).each(function(){
   var hWide = ($(this).width())/2; //half the image's width

   // attach negative and pixel for CSS rule
   hWide = '-' + hWide + 'px';

   $(this).css({
     "margin-left" : hWide
   });
 });
};
/*
|--------------------------------------------------------------------------
| detect browser
|--------------------------------------------------------------------------
*/
var browser = navigator.sayswho.toLowerCase();
var is_chrome = browser.indexOf('chrome') > -1;
var is_explorer = browser.indexOf('internet') > -1;
var is_firefox = browser.indexOf('firefox') > -1;
var is_safari = browser.indexOf("safari") > -1;
var is_Opera = browser.indexOf("presto") > -1;
var device_type = (isMobile.any() ? "mobile" : "desktop");
setTimeout(function() {
	$('body').addClass( device_type + ' op_1 ' + browser.split(' ')[0] );
},500);
// Avoid `console` errors in browsers that lack a console.
(function() {
    var method;
    var noop = function () {};
    var methods = [
        'assert', 'clear', 'count', 'debug', 'dir', 'dirxml', 'error',
        'exception', 'group', 'groupCollapsed', 'groupEnd', 'info', 'log',
        'markTimeline', 'profile', 'profileEnd', 'table', 'time', 'timeEnd',
        'timeStamp', 'trace', 'warn'
    ];
    var length = methods.length;
    var console = (window.console = window.console || {});

    while (length--) {
        method = methods[length];

        // Only stub undefined methods.
        if (!console[method]) {
            console[method] = noop;
        }
    }
}());

//top-level namespace
//var farmBuilding = farmBuilding || {};

;(function ( _NS, undefined ) {
    
    /*
	|--------------------------------------------------------------------------
	| Base selectors
	|--------------------------------------------------------------------------
	*/
    var _bod = $('body');
    var _b = $('#building');
    var _screenH = $('.winH');
    var _screenW = $('.winW');
    var _screenWH = $('.winHW');
    var _screenCenter = $('.centerCenter');
    var _screenCenterVertical = $('.centerVertical');
    var _screenCenterHorizontal = $('.centerHorizontal');
    var _makeSquare = $('.makeSquare');

    var _startMod = $('#startModal');
    var _landscapeMod = $('#landscapeModal');

    var _door_center_height = $('#door_center_height');
    var _UIDiagram = $('#diagram');
    var _theDiagram = $('#theDiagram');

    var _calcPrice = $('.calcPrice');

    /*
	|--------------------------------------------------------------------------
	| UI elements
	|--------------------------------------------------------------------------
	*/
    var _ui_element = $('.UI');
    var _ui_element_option = $('.UI.UI-Option');
    var _ui_builder_nav = $('.UIBuilderNav');
    var _ui_builder_nav_item = $('.UIBuilderNav .UI');
    var _ui_builder_list = $('#UIList');
    var _ui_builder_list_li = $('ul#UIList li.UISection');
    var _info_selected_class = 'selected';
    var _uni_info_class = 'info';
    var _ui_quickNav = $('#quickNav');
    var _info_Main = $('#infoMain');
    var _mobile_info_Main = $('#mobileInfoMain');
    var _accordion_dl_main = $('#mainAccordion');
    var _accordion_dl_mobile = $('#mobileAccordion');

    /*
	|--------------------------------------------------------------------------
	| identifiers to listen for change
	|--------------------------------------------------------------------------
	*/
	var _selectPartial = 'configurable_';
	var _selectGroup = $('.product-essential select');
	var _detailPartial = 'ctl00_ContentPlaceHolderBody_ctl00_lbl';
	var _defaultFormOption = 'Choose a';
	var _price = $('#mainPrice .regular-price .price');
	var _quoteModal = $('#quoteModal');
	var _quoteMessage = _quoteModal.find('input[name=message]');
	// var _optionsTable = 'ctl00_ContentPlaceHolderBody_ctl00_tblOptions';
	var _miniCart = $('.header-minicart .count');
	var _items_miniCart_count = $('.header-minicart .count');

	/*
	|--------------------------------------------------------------------------
	| cookie parameters and encoding variables
	|--------------------------------------------------------------------------
	*/
	var alpha = "1qQ2wW3eE4rR5tT6yY7uU8iI9oO0pPazsxdcfvgbhnjmklAZSXDCFVGBHNJMKL";
    var alpha_arr = alpha.split('');
	var alpha_arr2 = alpha.split('').reverse();
	// cookie name for last build element
	var _lastBuild = 'lastBuild';
	var _lastSelection = 0;
	var _cookExp = 7;
	var _cookPath = window.location.pathname;

	/*
	|--------------------------------------------------------------------------
	| initialize variables for door wind snow load retreival used in getLoadNDoor: function
	|--------------------------------------------------------------------------
	*/

	var loadID, loadCheck = '';
	var loadSelected_tmp, loadSelected = [];
	
	/*
	|--------------------------------------------------------------------------
	| get hash and split
	|--------------------------------------------------------------------------
	*/
	var hash = (window.location.hash).split("#");

	/*
	|--------------------------------------------------------------------------
	| get calcuable data for UISlider element
	|--------------------------------------------------------------------------
	*/
	
	var UISlide = {};
	function setUISlide () {
		UISlide = {
			'width'			: $('.UIBuilderContainer').width(),
			'in_width'		: $('.UIBuilderContainer').innerWidth(),
			'count'			: $('ul#UIList li.UISection').size(),
		};
	}setUISlide ();
	// extend calcuable data for UISlider element
	$.extend(true, UISlide, {
		'contanWidth'	: (UISlide.in_width*UISlide.count)
	});

	/*
	|--------------------------------------------------------------------------
	| scene7 variables
	| example url : 'http://s7d2.scene7.com/is/image/ShelterLogic/pe-cb-025xxx14_cover020?layer=1&src=pe-cb-025xxx14_cover060&$green$&posN=0,0&layer=2&src=pe-cb-025xxx14_logo-frm&$gray$&posN=0,0&layer=3&src=xx-xx-000xxx00_charact1&posN=0,0';
	|--------------------------------------------------------------------------
	*/
 
	// base url
	var s7_base = 'http://s7d2.scene7.com/is/image/ShelterLogic/';
	// person variable
	var s7_guy1 = 'xx-xx-000xxx00_charact1';
	var s7_guy2 = 'xx-xx-000xxx00_charact2';
	var s7_guy = (hash.indexOf('charact1') >= 0 ? 'xx-xx-000xxx00_charact1' : 'xx-xx-000xxx00_charact2');
	
	/*
	|--------------------------------------------------------------------------
	| color variables 
	|--------------------------------------------------------------------------
	*/
	var s7_colors = {
		// not defined in current form
		'MAIN'	: "$main$",
		'Hunter Green'	: "$huntergreen$",
		'Black'	: "$black$",
		// defined in current form
		'Gray'	: "$gray$",
		'White'	: "$white$",
		'Green'	: "$green$",
		'Tan'	: "$tan$",
		'Clear'	: "$translucent$",
		'Brown'	: "$brown$"
	};
	// example to use variable as obj attr/index 
	// data[x]; //=> bar

	/*
	|--------------------------------------------------------------------------
	| set totals variable
	|--------------------------------------------------------------------------
	*/
	var _total = 0;
	/*
	|--------------------------------------------------------------------------
	| objects for UI
	|--------------------------------------------------------------------------
	*/
	var _selectArray = {
		'Style':null,
		'Width':null,
		'Height':null,
		'Length':null,
		'FabricMaterial':null,
		'FabricColor':null
	};
	/*
	|--------------------------------------------------------------------------
	|  Object for Sku calc
	|--------------------------------------------------------------------------
	*/
	var _optionsObj = {

		// always PE
		'product_line'	: 'PE',
		// 0 = null, PK = Peak, RD = Round, BN = Barn
		'style'			: {
			'0'		: null,
			'14'	: 'A',
			'13'	: 'B',
			'12'	: 'C'
		},
		// always A
		'category'		: 'A',
		// fron panel
		'front_panel'	: {
			// width is  <= 17
			'17'	: 'C',
			// width is >= 18
			"18"	: 'D'
		},
		'back_panel'	: {
			// Default to A
			'default'	: 'A',
			// width is  <= 17 use 2 zip
			'17'	: 'C',
			// width is >= 18 use 3 zip
			"18"	: 'D'
		},
		'fabricmaterial'		: {
			// standard
			'15'	: '01',
			// Heavy Duty
			'17'	: '02',
			// Ultra Duty
			'16'	: '03'   
		},
		'fabriccolor': {
			// White
			'23'	: '01', 
			// Gray
			'GY'	: '03',
			// Green
			'GN'	: '04',
			// Tan
			'TN'	: '05',
			// Clear
			'19'	: '08',
			// Brown
			'18'	: '09',
		},
		// Always defaults to F for galvanized
		'frame_color'	: 'F',
		// number of characters
		'Width'			: 3,
		// number of characters
		'Length'		: 3,
		// number of characters
		'Height'		: 2 
	};

	/*
	|--------------------------------------------------------------------------
	| Object for converting form values to readable text
	|--------------------------------------------------------------------------
	*/
	var _formObj = {
		// always PE
		'product_line'	: 'PE',
		'style'			: {},
		'width'			: {},
		'height'		: {},
		'length'		: {},
		'fabricmaterial': {},
		'fabriccolor'	: {}
	};
	
	/*
	|--------------------------------------------------------------------------
	| build errors and logs
	|--------------------------------------------------------------------------
	*/

	var scriptError = scriptError || {
		logging: function (text) {
			//console.log(text);
			loc = window.location;
			//loc = 'www.shelterlogic.com/farmtest';
			$.get(
				"https://zapier.com/hooks/catch/o2hiic/",
				{ url: loc, message: text, date: Date() },
				function(data) {
					console.log("Response: " + text);
				}
			);
		},
		report: function (text, logBool) {
			console.log(text);
			if(logBool) {
				this.logging(text);	
			}
		}
	};
	/*
	|--------------------------------------------------------------------------
	| _local defines provate methods
	|--------------------------------------------------------------------------
	*/
    window._local = {
    	isConfigurable: function(){
    		return _bod.hasClass('product-sp-series-shelter')
    	},firstElement: function (obj) {
		    for (var a in obj) return a;
		},
	    center: function () {
	    	if (centertimer) clearTimeout(centertimer);
	    	var centertimer = setTimeout(function(){
	    		_screenCenter.each(function() {
		    		$(this).stop().centerCenter();
		    	});
	    	},1500);
	    },
	    setActive: function(pos) {
	    	var currentPos = pos + 1;
	    	$('.UI.quickSelect').each(function(){
	    		if($(this).data('index') < currentPos) {
	    			$(this).removeClass('disable').addClass('active');
	    		} else if ($(this).data('index') == currentPos) {
	    			$(this).removeClass('disable').addClass('current');
	    		} else {
	    			$(this).removeClass('active').addClass('disable');
	    		}
	    	});
	    },
	    translateValue: function (v,item) {
	    	if (v.indexOf(_defaultFormOption) <= 0) return false;
	    	var _initialV = v;
	    	var _translatedV = _initialV;
	    	var _item = item.toLowerCase();
	    	// if(_item == 'width' || _item == 'height' || _item == 'length') {
	    	// 	return _translatedV;
	    	// } else {
		    	_translatedV = _formObj[_item][_initialV];
		    	return _translatedV;
	    	//}
	    	return false;
	    	
	    },
	    translateSku: function (type,value) {
			var localArray = _optionsObj[type.toLowerCase()];
			var transVal = localArray[value];
			if(transVal && transVal !== 'undefined' && transVal !== null) {
				return transVal;

			} else {
				return false;
			}
		},
		calculateSku: function() {
			var style = this.translateSku('style', _formObj.style[_selectArray['Style']]);
			var front_panel = (_formObj['width'][_selectArray['Width']] <= 17 ? _optionsObj['front_panel']['17'] : _optionsObj['front_panel']['18']);
			var back_panel = _optionsObj['back_panel']['default'];
			if (_formObj['style'][_selectArray['Style']] == 'BN')
				back_panel = (_formObj['width'][_selectArray['Width']] <= 17 ? _optionsObj['back_panel']['17'] : _optionsObj['back_panel']['18']);
			var fabric = this.translateSku('fabricmaterial', _formObj['fabricmaterial'][_selectArray['FabricMaterial']]);
			var color = this.translateSku('fabriccolor', _formObj['fabriccolor'][_selectArray['FabricColor']]);
			var width = '0'+_formObj['width'][_selectArray['Width']];
			var length = (_formObj['length'][_selectArray['Length']] < 100 ? '0'+_formObj['length'][_selectArray['Length']] : _formObj['length'][_selectArray['Length']]);

			var SKU = _optionsObj['product_line']+style+_optionsObj['category']+front_panel+back_panel+fabric+color+_optionsObj['frame_color']+width+length+_formObj['height'][_selectArray['Height']];
			
			return SKU;
			//scriptError.report(this.translateSku('FabricMaterial','HDY'), false);
		},
		pop:{
			start: function () {
				
					_bod.addClass('start');
					_startMod.foundation('reveal', 'open');
				
			},
		},
		getURL: function () {
			var style 	= this.translateSku('style', _selectArray['Style']);
			var width 	= _formObj.width[_selectArray['Width']];
			var height 	= (_formObj.height[_selectArray['Height']] < 10 ? '0'+_formObj.height[_selectArray['Height']] : _formObj.height[_selectArray['Height']]);
    		var length 	= _formObj.length[_selectArray['Length']];
    		var color 	= (s7_colors[_formObj.fabriccolor[_selectArray['FabricColor']]] !== undefined ? s7_colors[_formObj.fabriccolor[_selectArray['FabricColor']]] : "$gray$");

    		if(!style || style === undefined) {
    			style = "a";
    		}
    		if(!width || width === undefined) {
    			width = "12";
    			switch(style.toLowerCase()) {
    				case 'a':
    				case 'b':
    					height = "08";
    					break;
    				case 'c':
    					height = "09";
    					break;
    			}
    			length = 20;
    		} else if(width && !height || width && height === undefined) {
    			
    			height = _formObj.height[this.firstElement(_formObj.height)];
    			
    		} else if(width && height && !length || width && height && length === undefined) {
    			length = 20;
    			
    		} 
    		if(!color || color === undefined) {
    			color = s7_colors[_formObj.fabriccolor['Gray']];
    		}

    		var imgWidth = (Math.floor($(window).width()*1.5) < 2000 ? Math.floor($(window).width()*1.5) : 1999);
    		var image_starter = 'blank_logo';
    		var image_vs, logo_vs, image_url, image_white = '';
    		
    		// img offset for smaller images/src
			var img_offset = 0;
    		switch (true) {
				case (length > 100):
					//do stuff
					length = '100';
					img_offset = 0;
					break;
				case (length <= 100)&&(length > 80):
					//do stuff
					length = '100';
					img_offset = '0';
					break;
				case (length <= 80)&&(length > 60):
					//do stuff
					length = '080';
					img_offset = '-0.04';
					break;
				case (length <= 60)&&(length > 40):
					//do stuff
					length = '060';
					img_offset = '-0.06';
					break;
				case (length <= 40)&&(length > 20):
					//do stuff
					length = '040';
					img_offset = '-0.10';
					break;
				case (length <= 20):
				default:
					//do stuff
					length = '020';
					img_offset = '-0.18';
					break;
		    }
		    image_vs = ('pe-'+style+'b-0'+width+'xxx'+height+'_cover'+length).toLowerCase();
		    logo_vs = ('pe-'+style+'b-0'+width+'xxx'+height+'_logo-frm').toLowerCase();
		    image_white = ('pe-'+style+'b-0'+width+'xxx'+height+'_white').toLowerCase();
		    
		    image_url = 'http://s7d2.scene7.com/is/image/ShelterLogic/'+image_starter+
		    '?layer=1&src='+image_vs+'&'+color+'&posN='+img_offset+
		    ',0&layer=2&src='+image_white+'&posN='+img_offset+
		    ',0&layer=3&src='+logo_vs+'&$gray$&posN='+img_offset+
		    ',0&layer=4&src='+s7_guy+'&posN='+img_offset+
		    ',0&fmt=png-alpha&wid='+imgWidth+'&hei='+imgWidth;
		    
		    return image_url;
	    	// return 'http://s7d2.scene7.com/is/image/ShelterLogic/pe-cb-025xxx14_cover020?layer=1&src=pe-cb-025xxx14_cover060&$green$&posN=0,0&layer=2&src=pe-cb-025xxx14_logo-frm&$gray$&posN=0,0&layer=3&src=xx-xx-000xxx00_charact1&posN=0,0';

	    },
	    buildCookie: {
	    	shuffle: function (o){ //v1.0
			    for(var j, x, i = o.length; i; j = 9, x = o[--i], o[i] = o[j], o[j] = x);
			    return o;
			},
	    	coded: function (_val, _direction) {
	    		if (!is_firefox) {
					if (!_val) {
						return false;
					}
					//scriptError.report(_val,false);
					var _array = _val.toString().split('');
					var _coded = [];
					switch (_direction) {
						case 'de':
							var match_arr = alpha_arr2;
							var insert_arr = alpha_arr;
							break;
						case 'en':
						default:
							var match_arr = alpha_arr;
							var insert_arr = alpha_arr2;
							break;
					}
					for (i = 0; i <= _array.length; i++) {
						if ( i < _array.length ) {
						    var in_a = $.inArray( _array[i] , match_arr );
						    if(in_a >= 0) { _coded.push(insert_arr[in_a]); }
						    else { _coded.push(_array[i]); }
						} else if ( i = _array.length ) {
							var _coded = _coded.join('');
						}
					}
					return _coded; 
				} else {
					return _val;	
				}
	    	},
	    	set: 	function (_name, _val) {
	    		//$.cookie( _name, _val, { expires: _cookExp, path: _cookPath } );
				$.cookie( this.coded( _name, 'en' ), this.coded( _val, 'en' ), { expires: _cookExp, path: _cookPath } );
	    	},
	    	get: 	function (_name) {
	    		//return $.cookie( _name );
	    		return this.coded( $.cookie( _name ), 'de' );
	    	},
	    	getObj: function () {
	    		return $.cookie();
	    	},
	    	tester: 	function (_name) {
	    		//return $.cookie( _name ) !== undefined ? true : false;
	    		return $.cookie( this.coded( _name, 'en' ) ) !== undefined ? true : false;
	    	},
	    	relinquish: 	function (_name) {
	    		//return $.removeCookie( _name,{ path: _cookPath });
	    		return $.removeCookie( this.coded( _name, 'en' ),{ path: _cookPath });
	    	},
	    	clear: function() {
	    		Object.keys( _local.buildCookie.getObj() ).forEach(function(key) {
					//var decKey = key;
					_local.buildCookie.relinquish(_lastBuild);
					var decKey = _local.buildCookie.coded( key, 'de' );
				    if (RegExp(/\b(build_)/g).test(decKey)) {
				    	_local.buildCookie.relinquish(decKey);
				    }
				});
				this.set('refresh', '1');
				farmBuilding.init.refresh();
	    	}
	    }
    };
    
   
    /*
	|--------------------------------------------------------------------------
	| Extend the buildings namespace
	|--------------------------------------------------------------------------
	*/
    $.extend(true, _NS, {
    	
	    imageUrl: function () {
	        var _i = _b.find('img');
	        var image_url = _local.getURL();
	        _i.addClass('op_0');
	        _bod.addClass('loading');
	        $('#loader').addClass('loading');
	        var nImg = document.createElement('img');
	        nImg.setAttribute('src', image_url);
	        nImg.setAttribute('class', 'preload');
	        $('.preload').append(nImg);
			nImg.onload = function() {
			    // image exists and is loaded
			    _i.attr('src',image_url);
			    _local.center();
			    _bod.removeClass('loading');
			    _i.removeClass('op_0');
			     $('#loader').removeClass('loading');
			}
			nImg.onerror = function() {
			    // image did not load
			    if(_formObj.style[_selectArray['Style']] === 'Peak')
			    	image_url = 'http://s7d2.scene7.com/is/image/ShelterLogic/blank_logo?layer=1&src=pe-ab-012xxx08_cover020&$gray$&posN=-0.18,0&layer=2&src=pe-ab-012xxx08_white&posN=-0.18,0&layer=3&src=pe-ab-012xxx08_logo-frm&$gray$&posN=-0.18,0&layer=4&src=xx-xx-000xxx00_charact2&posN=-0.18,0&fmt=png-alpha&wid=1999&hei=1999';
			    else if(_formObj.style[_selectArray['Style']] === 'Barn')
			    	image_url = 'http://s7d2.scene7.com/is/image/ShelterLogic/blank_logo?layer=1&src=pe-cb-012xxx09_cover020&$gray$&posN=-0.18,0&layer=2&src=pe-cb-012xxx09_white&posN=-0.18,0&layer=3&src=pe-cb-012xxx09_logo-frm&$gray$&posN=-0.18,0&layer=4&src=xx-xx-000xxx00_charact2&posN=-0.18,0&fmt=png-alpha&wid=1999&hei=1999';
			    else if(_formObj.style[_selectArray['Style']] === 'Round')
			    	image_url = 'http://s7d2.scene7.com/is/image/ShelterLogic/blank_logo?layer=1&src=pe-bb-012xxx08_cover020&$gray$&posN=-0.18,0&layer=2&src=pe-bb-012xxx08_white&posN=-0.18,0&layer=3&src=pe-bb-012xxx08_logo-frm&$gray$&posN=-0.18,0&layer=4&src=xx-xx-000xxx00_charact2&posN=-0.18,0&fmt=png-alpha&wid=1999&hei=1999';
			    else
			    	image_url = 'http://s7d2.scene7.com/is/image/ShelterLogic/blank_logo?layer=1&src=pe-ab-012xxx08_cover020&$gray$&posN=-0.18,0&layer=2&src=pe-ab-012xxx08_white&posN=-0.18,0&layer=3&src=pe-ab-012xxx08_logo-frm&$gray$&posN=-0.18,0&layer=4&src=xx-xx-000xxx00_charact2&posN=-0.18,0&fmt=png-alpha&wid=1999&hei=1999';

			    _i.attr('src',image_url);
			    _local.center();
			    _bod.removeClass('loading');
			    _i.removeClass('op_0');
			     $('#loader').removeClass('loading');
			    scriptError.report('Failed to load image: '+image_url+' - Calculated SKU: '+_local.calculateSku(), true);
			}
	    },
	    uiLoad: {
	    	getLoadNDoor: function () {
	    		var obj = buildAttributes;
	    		var obtained = 0;
	    		function ImageExist(obj) {
				   var style = obj['Style'].split('')[0];
				   var width = obj['Width'];
				   var height = obj['Height'];
				   var src = getBaseUrl()+'images/src/diagrams/'+obj['Style']+'/'+style+'_'+width+'x'+height+'.png';
				   $.get(src)
				    .done(function() { 
				        // exists code 
				        _theDiagram.each(function() { $(this).attr('src', src); });
				   		_UIDiagram.each(function() { $(this).show(); });
				    }).fail(function() { 
				        // not exists code
				        _theDiagram.each(function() { $(this).attr('src', ''); });
				   		_UIDiagram.each(function() { $(this).hide(); });
				    });
				}
	    		Object.keys(_selectArray).forEach(function(key) {
	    			if ( key == 'Style' || key == 'Width' || key == 'Height' ) {
	    				if ( _selectArray[key] !== null ) {
							
							loadSelected_tmp = jQuery.grep(obj, function( n ) {
								return ( n[key] == _formObj[key.toLowerCase()][_selectArray[key]]);
							});
							
							if(loadSelected_tmp !== null) {
								loadSelected = loadSelected_tmp;
								obj = loadSelected;
								obtained = Object.keys(obj).length;
							} else {
								loadSelected_tmp = false;
							}
	    				}
	    			}
	    		});
	    		//console.log(loadSelected_tmp);
	    		if (loadSelected_tmp !== false && obtained == 1) {
	    			ImageExist(loadSelected[0]);
	    			if(loadSelected[0]['door_width'] !== "0")
	    				$('#door_width .attribute').text(loadSelected[0]['door_width']);
	    			if(loadSelected[0]['door_height'] !== "0")
	    				$('#door_height .attribute').text(loadSelected[0]['door_height']);
	    			if(loadSelected[0]['snow_load'] !== "0")
	    				$('#snow_load .attribute').text(loadSelected[0]['snow_load']+" psf*");
	    			if(loadSelected[0]['wind_load'] !== "0")
	    				$('#wind_load .attribute').text(loadSelected[0]['wind_load']+" mph*");

	    			if(loadSelected[0]['door_center_height'] !== "0") {
	    				$('#door_center_height').show();
	    				$('#door_center_height .attribute').text(loadSelected[0]['door_center_height']);
	    			} else {
	    				$('#door_center_height').hide();
	    			}
	    			_UIDiagram.show();
	    		} else {
	    			//scriptError.report('failure to set door and load ratings due to unmet condition',false);
	    			_UIDiagram.hide();
	    		}
			},
	    	// functions to set values to UI elements and sizing
	    	setSelectedItems: function() {
	    		// loop the _selectArray object and set selected values
	    		if(!_selectArray)
	    			return false;

	    		Object.keys(_selectArray).forEach(function(key) {
				    $('.UI[data-type="'+key+'"]').each(function(){
				    	if ($(this).data('value') == _selectArray[key]) {
				    		$(this).addClass(_info_selected_class);
				    	}
				    });
				    if(_formObj[key.toLowerCase()][_selectArray[key]] !== null && _formObj[key.toLowerCase()][_selectArray[key]] !== undefined) {
				    	if ( key == 'Width' || key == 'Height' || key == 'Length' ) {
				    		$('#'+key+'Selected .attribute').text(_formObj[key.toLowerCase()][_selectArray[key]]+"'");
				    	} else {
					    	$('#'+key+'Selected .attribute').text(_formObj[key.toLowerCase()][_selectArray[key]]);
					    }
				    }
				    //_bod.addClass(key+'_'+_selectArray[key]);
				});
				_NS.uiEvent.whichChoice();
	    	},
	    	setUIListWidth: function() {
	    		
	    		_ui_builder_list_li.width(UISlide.width);
	    		_ui_builder_list.width(UISlide.contanWidth);
	    		this.setSelectedItems();
	    		this.getLoadNDoor();
	    	},
	    	duplicateInfo: function () {
	    		_mobile_info_Main.html(_info_Main.html());
	    		_accordion_dl_mobile.html(_accordion_dl_main.html());
	    	},
	    	ajaxModalConnect: function () {
	    		$('.modalAjax').each(function() {
	    			// this
	    			var _this = $(this);
	    			var where = window.location.host;
	    			var fileslocation = getBaseUrl();
	    			// get href
	    			var h = _this.attr('href').split('#').pop();
	    			_this.attr('href', fileslocation+'modal/'+h+'.php');
	    		});
	    	},
	    	updateCartCount: function () {
	    		$('.fa.fa-shopping-cart span').text(_items_miniCart_count.text());
	    	},
	    	getFormAndSetUI: function () {
	    		// create quick nav
				_ui_builder_list_li.each(function(index) {
					var _e = $(this);
					var _eAsset = _e.attr('id').split('choose').pop();
					_eAsset = _eAsset.split('Fabric').pop();
					_ui_quickNav.append('<div class="small-4 large-4 columns UI quickSelect" data-func="whichChoice" data-index="'+index+'">'+_eAsset+'</div>');
				});
	    		// get the options from the hidden form and build our select fields
	    		_ui_element_option.each(function() {
	    			var _this = $(this);
	    			if(_this.prop('tagName').toLowerCase() == 'select') {
	    				var __type = _this.data('type');
	    				var _loc_select = $('.'+_selectPartial + __type);
	    				$(_loc_select).find( 'option' ).each(function() {
	    					var _ = $(this);
	    					var _val = _.attr('value');
	    					var _new = _.clone();
	    					_new.attr('data-value', _.text());
						  	_this.append(_new);
						});
	    			}
	    		});
	    		// get and set FabricMaterial
	    		$('.buttonContainer').each(function() {
	    			var _this = $(this);
	    			var __id = _this.attr('id');
	    			var __type = __id.split('build_').pop();
    				var _loc_select = $('.'+_selectPartial + __type);
    				$(_loc_select).find( 'option' ).each(function(index) {
    					var __this = $(this);
    					if(__this.text().indexOf(_defaultFormOption) < 0) {
							switch(__type) {
								case 'Style':
										var theText = __this.text().split('P');
										_this.append('<button class="UI UI-Option button expand textLeft" data-func="setAttr" data-type="'+__type+'" data-value="'+__this.attr('value')+'">'+__this.text()+'<i class="fa fa-check center"></i></button>');
									break;
								case 'FabricMaterial':
									var theText = __this.text().split('P');
									_this.append('<button class="UI UI-Option button expand textLeft" data-func="setAttr" data-type="'+__type+'" data-value="'+__this.attr('value')+'"><span class="hide-for-large-up">'+theText[0]+'</span><span class="show-for-large-up">'+__this.text()+'</span><i class="fa fa-check center"></i></button>');
									break;
								case 'FabricColor':
									_this.append('<button class="UI UI-Option button expand box-shadow textCenter makeSquare '+__this.text().replace(" ","_")+'" data-func="setAttr" data-type="'+__type+'" data-value="'+__this.attr('value')+'"> '+__this.text()+' <i class="fa fa-check centerVertical centerHorizontal"></i></button>');
									
									break;

							};
						}
					});
	    		});
	    		this.setUIListWidth();
	    		this.duplicateInfo();
	    		// we are going to use the built in minicart
	    		// this.updateCartCount();
	    	},
	    	setPrice:function() {
	    		if(_price.doesExist()) {
					var _total = _price.text();
					if(_total === '$0.00' || _total === '') {
						_calcPrice.text('Build Your Building');
						$('#addToCart').addClass('disabled');
					} else {
						_calcPrice.text(_total);
						$('#addToCart').removeClass('disabled');
						$('.btn-cart').each(function(){
							if ( $(this).css('display') == 'none') {
							    $('#addToCart').text($(this).attr('data-text')).attr('data-func',$(this).attr('data-func'));
						    }
						});
						
					}

					// build total
				}
	    	}

	    },
	    fireEvent: function(element,event) {
		    if (document.createEventObject)
		    {
		        // dispatch for IE
		        var evt = document.createEventObject();
		        return element.fireEvent('on'+event,evt);
		    }
		    else
		    {
		        // dispatch for firefox + others
		        var evt = document.createEvent("HTMLEvents");
		        evt.initEvent(event, true, true );
		        return !element.dispatchEvent(evt);
		    }
		},
		observing: {
			formCascade: function() {
				farmBuilding.init.getState(false);
			},
			formChange: function () {
	     		var formChanged = _.debounce(function() {
	     			_NS.observing.formCascade();
	     			observer.disconnect();
	     		}, 200, true);
				MutationObserver = window.MutationObserver || window.WebKitMutationObserver;

				var observer = new MutationObserver(function(mutations, observer) {
				    // Add the actions to be done here if a changes on DOM happened
				    formChanged();
				});

				// Register the element root you want to look for changes
				observer.observe(document.getElementById('product_addtocart_form'), {
				  subtree: true,
				  attributes: true
				});
			},

     	},
	    uiEvent: {
	    	default: function () {
	    		//this.closeInfo();
	    		$('.infoBuilderBox').removeClass(_info_selected_class);
	    		_ui_quickNav.stop().slideUp();
	    		return true;
	    	},
	    	addToCart: function() {
	    		$('.add-to-cart-buttons button[data-id=atc-button]').trigger('click');
	    	},
	    	getAQuote: function() {
	    		$('#quoteModal').foundation('reveal', 'open');
	    	},
	    	setAttr: function(_e_) {
	    		if(this.default()) {
		    		var select = _e_;
		    		var _e_type = $(_e_.target).prop('tagName');
		    		var is_select = (_e_type.toLowerCase() == 'select' ? true : false);
		    		var dataType = $(_e_.target).data('type');
		    		var dataValue = $(_e_.target).data('value');
		    		_selectArray[dataType] = dataValue;
		    		_lastSelection = dataType;
		    		
		    		// local function to fire form with selected value
		    		function _go (_value) {
		    			var dataValue = _value;

		    			switch(dataType) {
			    			case 'Style':
			    				_selectArray['Width'] = null;
			    				_selectArray['Height'] = null;
			    				_selectArray['Length'] = null;
			    				_selectArray['FabricMaterial'] = null;
			    				_selectArray['FabricColor'] = null;
			    				break;
			    			case 'Width':
			    				_selectArray['Height'] = null;
			    				_selectArray['Length'] = null;
			    				_selectArray['FabricMaterial'] = null;
			    				_selectArray['FabricColor'] = null;
			    				break;
			    			case 'Height':
			    				_selectArray['Length'] = null;
			    				_selectArray['FabricMaterial'] = null;
			    				_selectArray['FabricColor'] = null;
			    				break;
			    			case 'Length':
			    				_selectArray['FabricMaterial'] = null;
			    				_selectArray['FabricColor'] = null;
			    				break;
			    			case 'FabricMaterial':
			    				_selectArray['FabricColor'] = null;
			    				break;
			    			case 'FabricColor':
			    			default:
			    				break;
			    		}
		    			//set cookie 
						var cook = "build_"+dataType;
						
						// if cook is undefined remove
						if( _local.buildCookie.tester(cook) ) {
							_local.buildCookie.relinquish( cook );
						}
						// if re-set style remova all cookies
						if (dataType == "Style") {
							Object.keys( _local.buildCookie.getObj() ).forEach(function(key) {
							    //alert(key, $.cookie()[key]);
							    //var decKey = key;
							    var decKey = _local.buildCookie.coded( key, 'de' );
							    if ( RegExp( /\b(_build_)/g ).test( decKey ) ) {
							    	//$.removeCookie(key,{ path: '/' });
							    	_local.buildCookie.relinquish( decKey );
							    }
							});
						}
						// set new cookies and last changed state
						/*
						 * [TO-DO] create auto loader for defaulting through first selections
						 */
						_local.buildCookie.set(cook, dataValue);
						_local.buildCookie.set(_lastBuild, dataType);
						
						// get insite form and set values
			    		var _formE = $('.'+_selectPartial+dataType);
			    		$(_formE).stop().each(function(e) {$(this).val(dataValue);});
				    	$(_formE).find('option').each(function() {
				    		if ($(this).attr('value') == dataValue) {
				    			$(this).attr('selected', true);
				    		}
				    	});
				    	// trigger insite form change
				    	//$(_formE).trigger('change');
				    	var obj = jQuery(_formE).get();
					    Event.observe(obj[0],'change',function(){});
					    var eventReturn = _NS.fireEvent(obj[0],'change');
					    _NS.observing.formChange();
					    
					    // var nextIndex = parseInt($('select').index(_formE)) + 1;
					    // var nextField = $('#'+$('select:eq( '+nextIndex+' )').attr('id'));
					    
					    // nextField.bind("DOMSubtreeModified", function() {alert('test');});
		    		}

		    		// if our ui is a select field
		    		if (is_select && is_safari && !isMobile.any()) {
		    			$(_e_.target).on('click', function(e){ 
		    				// call go with value
		    				_go($(this).val()); 
		    			});

		    		} else if (is_select && !is_safari && !isMobile.any()) {
		    			$(_e_.target).on('change', function(e){ 
		    				// call go with value
		    				_go($(this).val()); 
		    			}); 
		    		} else if (is_select && isMobile.any()) {
		    			//alert('test');
		    			$(_e_.target).on('blur', function(e){ 
		    				// call go with value
		    				_go($(this).val()); 
		    			});
		    		} else { // if it is not a select field
		    			// call go with value
		    			_go($(_e_.target).data('value'));	
		    		}
		    	}
	    		
	    	},
	    	setStyle: function(_e_) {
	    		if(this.default()) {
		    		var select = _e_;
		    		var _e_type = $(_e_.target).prop('tagName');
		    		var is_select = (_e_type.toLowerCase() == 'select' ? true : false);
		    		var dataType = $(_e_.target).data('type');
		    		var this_val = $(_e_.target).data('value');
		    		$(".UISection #build_Style button[data-value*='"+$(_e_.target).data('value')+"']").trigger('click');
		            $('[data-reveal]').foundation('reveal','close');
		    		
		    	}
	    		
	    	},
	    	startOver: function() {
	    		_local.buildCookie.clear();
	    	},
	    	whichChoice: function(e) {
	    		
	    		if(this.default()) {
		    		var move = ((UISlide.in_width-UISlide.width)/2)+UISlide.width;
			        var curr_pos = parseInt(_ui_builder_list.css('left').split('px')[0].split('-').pop());
			        if(highlight) {
	    				clearTimeout(highlight);
	    			}
					if (e) {
					
						var _e = $(e.currentTarget);
						if ( _e.hasClass('fa') ) { 
							if ( _e.hasClass('prev') ) { var move_to = curr_pos-move; }
							else { var move_to = curr_pos+move; }
						} else if ( _e.data('index') >= 0 ) {
							var _position = _e.data('index');
							var check_move = move*(_position);
							if ( check_move < (UISlide.count)*UISlide.width ) {
								var move_to = check_move;
							} else {
								var move_to = move*_position;
							}
						}
									        
					} //end if
					else {
						//console.log('repeater test - you should only see this once per call');
						var _position = $( '#choose'+_lastSelection ).index();
						_local.setActive(_position);
						var check_move = move*(_position+1);
						if ( check_move < (UISlide.count)*UISlide.width ) {
							var move_to = check_move;
						} else {
							var move_to = move*_position;
						}
					} // end else

					_ui_builder_list.css( {'left':"-"+move_to+"px"} );
					if( move_to == 0 ) {
			        	$('.prev').addClass('disable');
			        } else if ( move_to >= ((UISlide.count-1)*UISlide.width) ) { 
			        	$('.next').addClass('disable');
			    	} else {
			        	_ui_builder_nav_item.removeClass('disable');
			        }
			        $('.UIBottom .UIBuilderContainer').addClass('highlight');
					var highlight = setTimeout(function () {
						$('.UIBottom .UIBuilderContainer').removeClass('highlight');
					}, 5000);
			    }
	    	},
	    	getInfo: function (e) {
	    		var infoId = $(e.target).data('infoid');
	    		if ( $('.'+infoId).hasClass(_info_selected_class) ) {
	    			$('.'+infoId).removeClass(_info_selected_class);
	    		} else {
		    		$('.'+_uni_info_class).removeClass(_info_selected_class);
		    		$('.'+infoId).addClass(_info_selected_class);
		    		$('.'+infoId+' .scroll').height($('.leftSide .UIBottom .UIBuilderContainer').height()+8);
		    	}
	    	},
	    	closeInfo: function (e) {
	    		var _e = $(e.target);
	    		var _parent_id = _e.parent().attr('id');
	    		_e.parent().removeClass(_info_selected_class);
	    	},
	    	toggleQuickNav: function() {
	    		_ui_quickNav.stop().slideToggle();
	    	},
	    	closeAccordion: function () {
	    		if (this.default()) {
	    			$('.accordion-navigation, .accordion-navigation .content').removeClass('active');
	    		}
	    	},
	    	checkOrientation: function (fired) {
	    		if (this.default()) {
		    		var landscape = false;
					switch ( window.orientation ) {
						case 0:
							landscape = false;
							break;
						case 90:
						case -90:
							landscape = true;
							break;
					}
					
					if (isMobile.any() && $(window).height() < 459 && landscape) {
						//alert('in');
						//return false;
						_landscapeMod.foundation('reveal', 'open');
						$('#mainUIElements').addClass('op_0');
					} else if (isMobile.any() && $(window).height() > 459 && !landscape && fired) {
						farmBuilding.init.refresh();
					}
				}
				
	    	}
	    },
	    resizer: function (f) {
    		setUISlide();
    		//_NS.uiLoad.setUIListWidth();
	    	_screenWH.each(function() {
	    		$(this).winHW(window,true,true, _local.center());
	    	});
	    	_screenH.each(function() {
	    		$(this).winHW(window,true,false, _local.center());
	    	});
	    	_screenW.each(function() {
	    		$(this).winHW(window,false,true, _local.center());
	    	});
	    	_screenCenterHorizontal.each(function() {
	    		$(this).centerHorizontal();
	    	});
	    	_screenCenterVertical.each(function() {
	    		$(this).centerVertical();
	    	});
	    	_makeSquare.each(function() {
	    		$(this).stop().makeSQ();
	    	});
	    	_NS.uiEvent.checkOrientation(f);
	    	// added initializers
            if (isMobile.any() || $(window).width() <= 1025) {
            	$('.accordion-navigation .content').removeClass('active');
            	$('dl.accordion').data('options', 'multi_expand:false;toggleable: true');
            } else {
            	if (!$('.accordion-navigation .content').hasClass('active')) {
            		$('.accordion-navigation .content').addClass('active');
            	}
            	$('dl.accordion').data('options', 'multi_expand:true;toggleable: true');
            }
            $("#mainAccordion .panelnav, #mobileAccordion .panelnav").fitText(1.2, { minFontSize: '6px', maxFontSize: '17px' });
			$("#productTitle, #calcPrice").fitText(1, { minFontSize: '6px', maxFontSize: '25px' });
			$("#shortDesc").fitText(1.1, { minFontSize: '4px', maxFontSize: '20px' });
			$("#addToCart").fitText(1.1, { minFontSize: '10px', maxFontSize: '25px' });
			$("#build_FabricColor button").fitText(1.1, { minFontSize: '10px', maxFontSize: '25px' });
			
			
	    },
	    infoVisible: function () {
	    	$('.showInfo').each(function() {
	    		var $this = $(this);
	    		var infoEle = $('div.'+$this.data('infoid'));
	    		var infoContent = infoEle.find('.scroll').html();
	    		if(!infoContent) {
	    			$this.hide();
	    		}
	    	});
	    },
	    
	    modalWork: {
	    	contactModal: function () {
	    		$('#contactModal #infoTable').text('testing');

	    	},
	    	quoteModal: function() {
	    		if(_quoteModal.doesExist() && _quoteMessage.doesExist()) {
		    		var buildStatment = '';
		    		Object.keys(_selectArray).forEach(function(key) {
		    			if(_formObj[key.toLowerCase()][_selectArray[key]] === undefined)
		    				return;

		    			buildStatment = buildStatment + key + ' - ' + _formObj[key.toLowerCase()][_selectArray[key]] + ', ';
		    		});
		    		_quoteMessage.attr('value','I would like a quote on a '+buildStatment+' building');
		    	}
	    	}
	    },
	    
	    init:{ 
	        getState:function(onloader){
	        	// set selectArray from form values
	        		$('.buttonContainer, #quickNav, .UISection select').html('');
		        	//clearTimeout(resizeTimer);
		        	
            		$("select[class^='"+_selectPartial+"']").each(function (i, el) {
            			 var _CLASSSESplit = $(this).attr('class').split(" ");
				         var _CLASSSplit = _CLASSSESplit[0].split("_").pop(-1);
				         _class = _CLASSSplit.toLowerCase();

				         $(this).find('option').each(function(){
				         	if(!$(this).attr('value'))
				         		return;

				         	_val = $(this).attr('value').toString();
				         	_formObj[_class][_val] = $(this).text();

				         });
            			
            		});
	            	$("select[class^='"+_selectPartial+"']").each(function (i, el) {
				         var _CLASSSESplit = $(this).attr('class').split(" ");
				         var _CLASSSplit = _CLASSSESplit[0].split("_").pop(-1);
				         
				         if(_CLASSSplit === "Width" || _CLASSSplit === "Height" || _CLASSSplit === "Length") {
				         	_selectArray[_CLASSSplit] = $(this).val();
				         } else {
				         	_selectArray[_CLASSSplit] = $(this).val();	
				         }
				         
				    });
				    
				    // set totals
				    
		            
		            _NS.imageUrl();
		            _NS.uiLoad.getFormAndSetUI();
		            _NS.uiLoad.setPrice();
		            
		            if(onloader)
		            	_NS.resizer();

		            _NS.infoVisible();
	        	
	        },
	        loader: function() {
	        	_NS.uiLoad.ajaxModalConnect();
	    		if(_local.isConfigurable()) {
		    		_local.pop.start();
		    		_NS.init.getState(true);
		    	} else {
		    		farmBuilding.resizer();
		    	}
	    	},
		    refresh: function () {
		    	//comment out condition for ios, for some reason it is working now
				// if (navigator && navigator.platform && navigator.platform.match(/^(iPad|iPod|iPhone)$/)) {
				//     window.location.reload;
				// } else {
					window.location = window.location;
				//}
		    	return false;
		    }
	    }
	});
    
})(window.farmBuilding = window.farmBuilding || {});

$(document).on('open.fndtn.reveal', '[data-reveal]', function () {
  var modal = $(this);
});
$(document).on('opened.fndtn.reveal', '#quoteModal', function () {
  farmBuilding.modalWork.quoteModal();
});
$(document).on('opened.fndtn.reveal', '[data-reveal]', function () {
	var modal = $(this);
  	$('body').addClass('modalOpen');
  	// on modal reveal resize text
	$('.reveal-modal h2').fitText(1.45, { minFontSize: '6px', maxFontSize: '43px' });
	$('.reveal-modal .color .btnColor span').fitText(1.45, { minFontSize: '10px', maxFontSize: '20px' });
	$('.reveal-modal#startModal h2').fitText(1, { minFontSize: '6px', maxFontSize: '63px' });
	$('.reveal-modal h4').fitText(1.4, { minFontSize: '6px', maxFontSize: '25px' });
	var bigbrother = -1;

    $('.orbit-slides-container li').each(function() {
      bigbrother = bigbrother > $('.orbit-slides-container li').height() ? bigbrother : $('.orbit-slides-container li').height();
    });

    $('.orbit-slides-container').each(function() {
      $('.orbit-slides-container').height(bigbrother);
    });
    $('.centerHorizontal').centerHorizontal();
	$('.centerVertical').centerVertical();
	$('.centerCenter').centerCenter();
	$('.makeSquare').makeSQ();
});

$(document).on('close.fndtn.reveal', '[data-reveal]', function () {
    var modal = $(this);
    $('body').removeClass('modalOpen');
});

$(document).ready(function() {
	/*
	|--------------------------------------------------------------------------
	| Document ready state
	|--------------------------------------------------------------------------
	*/
	// copy logo to appropriate locations
	
	// delete this on live site
	$('#showForm').on('click',function(e) {
		e.preventDefault();
		$(this).parent().toggleClass('show');
	});
	// END Delete this on live site
	// 
	// $("body").bind("DOMSubtreeModified", function () {
	// 	clearTimeout(sizeTimer);
	// 	var sizeTimer = setTimeout(function() {
	//     		$('.centerHorizontal').centerHorizontal();
	//     		$('.centerVertical').centerVertical();
	//     		$('.centerCenter').centerCenter();
	//     		$('.makeSquare').makeSQ();
	// 	},1000);
	// });
	
	var bodyChanged = _.debounce(function() {
		$('.centerHorizontal').centerHorizontal();
		$('.centerVertical').centerVertical();
		$('.centerCenter').centerCenter();
		$('.makeSquare').makeSQ();

	}, 1000, true);
	MutationObserver = window.MutationObserver || window.WebKitMutationObserver;

	var observer = new MutationObserver(function(mutations, observer) {
	    // Add the actions to be done here if a changes on DOM happened
	    bodyChanged();
	});

	// Register the element root you want to look for changes
	observer.observe(document.getElementsByTagName('body')[0], {
	  subtree: true,
	  attributes: true
	});
});

$(window).load(function() {
	/*
	|--------------------------------------------------------------------------
	| Document ready state
	|--------------------------------------------------------------------------
	*/
	farmBuilding.init.loader();
	
	$('body').delegate('.UI','click change',function(e) {
		e.preventDefault();
		if(!$(this).hasClass('disable')) {
			var func = $(this).data('func');
			farmBuilding.uiEvent[func](e);
		}
	});
});

$(window).smartresize(function(){
    /*
	|--------------------------------------------------------------------------
	| Document smart resize
	|--------------------------------------------------------------------------
	*/
	if(isMobile.any()) {
		farmBuilding.resizer(true);
	} else if($(window).width() < 1030) {
		clearTimeout(refresh);
		$('.off-canvas-wrap').fadeOut('fast');
		var refresh = setTimeout(function(){
			farmBuilding.init.refresh();
		},500); 
	} else {
		farmBuilding.resizer();
	}
	
});

})(jQuery);