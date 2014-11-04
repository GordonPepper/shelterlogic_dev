jQuery.noConflict();
(function( $ ) {
	$(document).foundation({
		reveal : {
		    close_on_background_click: false
		},
		 
	});
	$.cookie.raw = true;
	// get tagname 
	$.fn.tagName = function() {
	  return this.prop("tagName").toLowerCase();
	};
	// does exist
	$.fn.doesExist = function(){
	        return $(this).length > 0;
	};
	$.fn.centerCenter = function(){
	 if($(this).length <= 0)return false;
	 $(this).each(function(){
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
	$.fn.centerVertical = function(){
	 if($(this).length <= 0)return false;
	 $(this).each(function(){
	   //get height and width (unitless) and divide by 2
	   var hTall = ($(this).height())/2; //half the image's height, etc.

	   // attach negative and pixel for CSS rule
	   hTall = '-' + hTall + 'px';

	   $(this).css({
	     "margin-top" : hTall
	   });
	 });
	};
	$.fn.centerHorizontal = function(){
	 if($(this).length <= 0)return false;
	 $(this).each(function(){
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
	var is_explorer = browser.indexOf('ie') > -1;
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
	var _quoteMessage = _quoteModal.find('input[value=##build_description##]');
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
	var loadingTimer = setTimeout( _.noop, 2500);
	/*
	|--------------------------------------------------------------------------
	| get hash and split
	|--------------------------------------------------------------------------
	*/
	var hash = (window.location.hash).split("#");

	/*
	|--------------------------------------------------------------------------
	| is reconfigure
	|--------------------------------------------------------------------------
	*/
	var editConfiguration = (typeof aeConfig !== 'undefined' ? aeConfig.config.reconfigure : false);
	var _firstClick = true;

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
	var s7_guy3 = 'xx-xx-000xxx00_charact3';
	var s7_guy = (hash.indexOf('charact1') >= 0 ? 'xx-xx-000xxx00_charact1' : 'xx-xx-000xxx00_charact3');
	

	
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
	| which step
	|--------------------------------------------------------------------------
	*/
	var step = 1;
	/*
	|--------------------------------------------------------------------------
	| build errors and logs
	|--------------------------------------------------------------------------
	*/

	var scriptError = scriptError || {
		logging: function (text) {
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

	
	//top-level namespace
	var farmBuilding = farmBuilding || {};

	;(function ( _NS, undefined ) {
	 
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
		    	var doCenter = function() {
		    		_screenCenter.each(function() {
			    		$(this).stop().centerCenter();
			    	});
			    	return;
		    	}
		    	var centertimer = setTimeout(doCenter,1500);
		    	return;
		    },
		    setActive: function(pos) {
		    	var currentPos = pos + 1;
		    	var quickSelect = function() {
		    		if($(this).data('index') < currentPos) {
		    			$(this).removeClass('disable').addClass('active');
		    		} else if ($(this).data('index') == currentPos) {
		    			$(this).removeClass('disable').addClass('current');
		    		} else {
		    			$(this).removeClass('active').addClass('disable');
		    		}
		    		return;
		    	}
		    	return $('.UI.quickSelect').each(quickSelect);
		    },
		    translateValue: function (v,item) {
		    	if (v.indexOf(_defaultFormOption) <= 0) return false;
		    	var _initialV = v;
		    	var _translatedV = _initialV;
		    	var _item = item.toLowerCase();
		    	
			    	_translatedV = _formObj[_item][_initialV];
			    	return _translatedV;
		    	
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
					return;
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
					case (length <= 100)&&(length > 90):
						//do stuff
						length = '100';
						img_offset = '0';
						break;
					case (length <= 90)&&(length > 70):
						//do stuff
						length = '080';
						img_offset = '-0.04';
						break;
					case (length <= 70)&&(length > 50):
						//do stuff
						length = '060';
						img_offset = '-0.06';
						break;
					case (length <= 50)&&(length > 30):
						//do stuff
						length = '040';
						img_offset = '-0.10';
						break;
					case (length <= 30):
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

			    // console.log('?layer=1&src='+image_vs+'&'+color+'&posN='+img_offset+
			    // ',0&layer=2&src='+image_white+'&posN='+img_offset+
			    // ',0&layer=3&src='+logo_vs+'&$gray$&posN='+img_offset+
			    // ',0&layer=4&src='+s7_guy+'&posN='+img_offset+
			    // ',0&fmt=png-alpha&wid='+imgWidth+'&hei='+imgWidth);
			    
			    return image_url;

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
					return;
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
					return farmBuilding.init.refresh();
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
		    	if(_lastSelection == "FabricMaterial")
		    		return true;

		        var _i = _b.find('img');
		        var image_url = _local.getURL();
		        
		        

		        var nImg = document.createElement('img');
		        nImg.setAttribute('src', image_url);
		        nImg.setAttribute('class', 'preload');
		        $('.preload').append(nImg);
				nImg.onload = function() {
				    // image exists and is loaded
				    _i.attr('src',image_url);
				    return _local.center();

				    
				}
				nImg.onerror = function() {
				    // image did not load
				    if(_formObj.style[_selectArray['Style']] === 'Peak Frame')
				    	image_url = 'http://s7d2.scene7.com/is/image/ShelterLogic/blank_logo?layer=1&src=pe-ab-012xxx08_cover020&$gray$&posN=-0.18,0&layer=2&src=pe-ab-012xxx08_white&posN=-0.18,0&layer=3&src=pe-ab-012xxx08_logo-frm&$gray$&posN=-0.18,0&layer=4&src=xx-xx-000xxx00_charact3&posN=-0.18,0&fmt=png-alpha&wid=1999&hei=1999';
				    else if(_formObj.style[_selectArray['Style']] === 'Barn Frame')
				    	image_url = 'http://s7d2.scene7.com/is/image/ShelterLogic/blank_logo?layer=1&src=pe-cb-012xxx09_cover020&$gray$&posN=-0.18,0&layer=2&src=pe-cb-012xxx09_white&posN=-0.18,0&layer=3&src=pe-cb-012xxx09_logo-frm&$gray$&posN=-0.18,0&layer=4&src=xx-xx-000xxx00_charact3&posN=-0.18,0&fmt=png-alpha&wid=1999&hei=1999';
				    else if(_formObj.style[_selectArray['Style']] === 'Round Frame')
				    	image_url = 'http://s7d2.scene7.com/is/image/ShelterLogic/blank_logo?layer=1&src=pe-bb-012xxx08_cover020&$gray$&posN=-0.18,0&layer=2&src=pe-bb-012xxx08_white&posN=-0.18,0&layer=3&src=pe-bb-012xxx08_logo-frm&$gray$&posN=-0.18,0&layer=4&src=xx-xx-000xxx00_charact3&posN=-0.18,0&fmt=png-alpha&wid=1999&hei=1999';
				    else
				    	image_url = 'http://s7d2.scene7.com/is/image/ShelterLogic/blank_logo?layer=1&src=pe-ab-012xxx08_cover020&$gray$&posN=-0.18,0&layer=2&src=pe-ab-012xxx08_white&posN=-0.18,0&layer=3&src=pe-ab-012xxx08_logo-frm&$gray$&posN=-0.18,0&layer=4&src=xx-xx-000xxx00_charact3&posN=-0.18,0&fmt=png-alpha&wid=1999&hei=1999';

				    _i.attr('src',image_url);
				    var message = 'Failed to load image: '+image_url;
				    //scriptError.report(message, true);
				    return _local.center();
				}
		    },
		    uiLoad: {
		    	getLoadNDoor: function () {
		    		var obtained = 0;
		    		function ImageExist() {
		    			if(_selectArray.Style !== 'Choose an Option...' && _selectArray.Width !== 'Choose an Option...' && _selectArray.Height !== 'Choose an Option...') {
			    		   var StyleMain = _formObj.style[_selectArray['Style']].split(' ')[0];
						   var style = StyleMain.split('')[0];
						   var width = _formObj.width[_selectArray['Width']];
						   var height = _formObj.height[_selectArray['Height']];
						   var src = getBaseUrl()+'images/src/diagrams/'+StyleMain+'/'+style+'_'+width+'x'+height+'.png';
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
					    return;
					}
		    		
					$('#product-attribute-specs-table td.data').each(function() {
						var _id = $(this).data('attribute-id');
						$('#'+_id+' .attribute').text($(this).text());
					});

		    		return ImageExist();
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
					    } else {
					    	$('#'+key+'Selected .attribute').text('-');
					    }
					});
					return _NS.uiEvent.whichChoice();
		    	},
		    	setUIListWidth: function() {
		    		
		    		_ui_builder_list_li.width(UISlide.width);
		    		_ui_builder_list.width(UISlide.contanWidth);
		    		this.setSelectedItems();
		    		this.getLoadNDoor();
		    		return;
		    	},
		    	duplicateInfo: function () {
		    		_mobile_info_Main.html(_info_Main.html());
		    		_accordion_dl_mobile.html(_accordion_dl_main.html());
		    		return;
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
		    		return;
		    	},
		    	updateCartCount: function () {
		    		$('.fa.fa-shopping-cart span').text(_items_miniCart_count.text());
		    		return;
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
	    				var _dataFunc = 'setAttr';
	    				$(_loc_select).find( 'option' ).each(function(index) {
	    					var __this = $(this);
	    					if(_this.parent().attr('id') === 'startStyle') _dataFunc = 'setStyle';
	    					if(__this.text().indexOf(_defaultFormOption) < 0) {
								switch(__type) {
									case 'Style':
											var theText = __this.text().split('P');
											_this.append('<button class="UI UI-Option button expand" data-func="'+_dataFunc+'" data-type="'+__type+'" data-value="'+__this.attr('value')+'">'+__this.text()+'<i class="fa fa-check center"></i></button>');
										break;
									case 'FabricMaterial':
										var theText = __this.text().split('P');
										_this.append('<button class="UI UI-Option button expand textLeft hide-for-large-up" data-func="'+_dataFunc+'" data-type="'+__type+'" data-value="'+__this.attr('value')+'">'+theText[0]+'<i class="fa fa-check center"></i></button>');
										_this.append('<button class="UI UI-Option button expand textLeft show-for-large-up" data-func="'+_dataFunc+'" data-type="'+__type+'" data-value="'+__this.attr('value')+'">'+__this.text()+'<i class="fa fa-check center"></i></button>');
										break;
									case 'FabricColor':
										_this.append('<button class="UI UI-Option button expand box-shadow textCenter makeSquare '+__this.text().replace(" ","_")+'" data-func="'+_dataFunc+'" data-type="'+__type+'" data-value="'+__this.attr('value')+'"> '+__this.text()+' <i class="fa fa-check centerVertical centerHorizontal"></i></button>');
										
										break;

								};
							}
						});
		    		});
		    		this.setUIListWidth();
		    		return this.duplicateInfo();
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
									console.log($(this).attr('data-text'));
								    $('#addToCart').text($(this).attr('data-text')).attr('data-func',$(this).attr('data-func'));
							    } 
							});
							
						}

						// build total
					}
					return;
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
				formCascade: function(id) {
					// var _e = $('#'+id);
					// var _eLength = $('.super-attribute-select').length;
					// var _eIndex = _e.attr('data-index');
					// var is_select = _e.hasClass('super-attribute-select');
					// if(is_select && _eIndex <= _eLength) {
					// 	_e.find('option')[1].selected = true;
						
					// 	var obj = $(_e).get();
					//     Event.observe(obj[0],'change',function(){});
					//     var eventReturn = _NS.fireEvent(obj[0],'change');
					//     _NS.observing.formChange();

					//     return false;
					// } else {
					// 	return true;
					// }
					return true;
				},
				formChange: function (_e) {
		     		var formChanged = _.debounce(function(id) {
		     			if(_NS.observing.formCascade(id))
		     				_NS.init.getState(true);
		     			return observer.disconnect();
		     		}, 200, true);
					MutationObserver = window.MutationObserver || window.WebKitMutationObserver;

					var observer = new MutationObserver(function(mutations, observer) {
					    // Add the actions to be done here if a changes on DOM happened
					    formChanged(mutations[0].target.id);
					});

					// Register the element root you want to look for changes
					observer.observe(document.getElementById('product_addtocart_form'), {
					  subtree: true,
					  attributes: true,
					  childList: true,
					  characterData: true,
					});
					return;
				},

	     	},
		    uiEvent: {
		    	default: function () {
		    		//this.closeInfo();
		    		$('.infoBuilderBox').removeClass(_info_selected_class);
		    		_ui_quickNav.stop().slideUp();
		    		return true;
		    	},
		    	addToCart: function(e) {
		    		$('.add-to-cart-buttons button[data-id=atc-button]').trigger('click');
		    		// if($(e.target).attr('id') === 'addToCart')
		    		// 	$('#confirmModal').foundation('reveal', 'open');
		    		// if($(e.target).attr('id') === 'confirmAddToCart')
		    		// 	$('.add-to-cart-buttons button[data-id=atc-button]').trigger('click');
		    		return;
		    	},
		    	updateCart: function() {
		    		$('.add-to-cart-buttons button.btn-cart').trigger('click');
		    		return;
		    	},
		    	getAQuote: function() {
		    		$('#quoteModal').foundation('reveal', 'open');
		    		return;
		    	},
		    	setAttr: function(_e_) {

		    		if(this.default()) {
			    		var select = _e_;
			    		var _e_type = $(_e_.target).prop('tagName');
			    		var is_select = (_e_type.toLowerCase() === 'select' ? true : false);
			    		var is_option = (_e_type.toLowerCase() === 'option' ? true : false);
			    		var is_button = (_e_type.toLowerCase() === 'button' ? true : false);
			    		if(!is_option)
			    			var dataType = $(_e_.target).data('type');
			    		else 
			    			var dataType = $(_e_.target).parent().data('type');


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
							// if( _local.buildCookie.tester(cook) ) {
							// 	_local.buildCookie.relinquish( cook );
							// }
							// // if re-set style remova all cookies
							// if (dataType == "Style") {
							// 	Object.keys( _local.buildCookie.getObj() ).forEach(function(key) {
							// 	    //alert(key, $.cookie()[key]);
							// 	    //var decKey = key;
							// 	    var decKey = _local.buildCookie.coded( key, 'de' );
							// 	    if ( RegExp( /\b(_build_)/g ).test( decKey ) ) {
							// 	    	//$.removeCookie(key,{ path: '/' });
							// 	    	_local.buildCookie.relinquish( decKey );
							// 	    }
							// 	});
							// }
							// // set new cookies and last changed state
							
							// _local.buildCookie.set(cook, dataValue);
							// _local.buildCookie.set(_lastBuild, dataType);
							
							// get insite form and set values
				    		var _formE = $('.'+_selectPartial+dataType);
				    		$(_formE).stop().each(function(e) {$(this).val(dataValue);});
					    	$(_formE).find('option').each(function() {
					    		if ($(this).attr('value') == dataValue) {
					    			$(this).attr('selected', true);
					    		}
					    	});
					    	var obj = $(_formE).get();
						    Event.observe(obj[0],'change',function(){});
						    var eventReturn = _NS.fireEvent(obj[0],'change');
						    return _NS.observing.formChange();
						    
			    		}
			    		// if our ui is a select field
			    		if (is_select && is_explorer && !is_safari && !isMobile.any()) {
			    			
			    			$(_e_.target).on('change', function(e){ 
			    				// call go with value
			    				_go($(this).val());
			    				$(this).unbind('change');
			    				return _NS.loading(true);
			    			}); 
			    		} else if (is_select && is_safari && !isMobile.any()) {
			    			_go($(_e_.target).val());	
			    			return _NS.loading(true);

			    		} else if (is_select && !is_safari && !isMobile.any()) {
			    			$(_e_.target).on('change', function(e){ 
			    				// call go with value
			    				_go($(this).val());
			    				$(this).unbind('change');
			    				return _NS.loading(true);
			    			}); 
			    		} else if (is_select && isMobile.any()) {
			    			//alert('test');
			    			$(_e_.target).on('blur', function(e){ 
			    				// call go with value
			    				_go($(this).val()); 
			    				$(this).unbind('blur');
			    				return _NS.loading(true);
			    			});
			    		} else if (is_button) { // if it is not a select field
			    			// call go with value
			    			_go($(_e_.target).data('value'));	
			    			return _NS.loading(true);
			    		}
			    		return;
			    	}
		    		
		    	},
		    	setStyle: function(_e_) {
		    		if(this.default()) {
		    			_NS.loading(true);
			    		var select = _e_;
			    		var _e_type = $(_e_.target).prop('tagName');
			    		var is_select = (_e_type.toLowerCase() == 'select' ? true : false);
			    		var dataType = $(_e_.target).data('type');
			    		var this_val = $(_e_.target).data('value');

			    		$(".UISection #build_Style button[data-value*='"+$(_e_.target).data('value')+"']").trigger('click');
			            $('[data-reveal]').foundation('reveal','close');
			    		return _bod.removeClass('start');
			    	}
			    	return;
		    		
		    	},
		    	startOver: function() {
		    		_local.buildCookie.clear();
		    		return;
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

							if(editConfiguration && _lastSelection === 0) {
								var _position = $( '#chooseFabricColor' ).index();
								_lastSelection = 'FabricColor';
							} else {
								var _position = $( '#choose'+_lastSelection ).index();
							}
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
				        var blink = function() {
				        	$('.UIBottom .UIBuilderContainer').removeClass('highlight');
				        	
				        }
						var highlight = setTimeout(blink, 7000);
						//alert(_lastSelection);
						switch(_lastSelection) {
				    			case 'Style':
				    				step = 'Step - 2';
				    				break;
				    			case 'Width':
				    				step = 'Step - 3';
				    				break;
				    			case 'Height':
				    				step = 'Step - 4';
				    				break;
				    			case 'Length':
				    				step = 'Step - 5';
				    				break;
				    			case 'FabricMaterial':
				    				step = 'Step - 6';
				    				break;
				    			case 'FabricColor':
				    				if(editConfiguration)
				    					step = '<i class="fa fa-angle-double-up"></i>';
				    				else
				    					step = 'Buy - <i class="fa fa-cc-amex"></i> <i class="fa fa-cc-visa"></i> <i class="fa fa-cc-mastercard"></i> <i class="fa fa-credit-card"></i>';
				    				break;
				    			default:
				    				step = 'Step - 1';
				    				break;
				    		}
						return $('.step').html(step);
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
			    	return;
		    	},
		    	closeInfo: function (e) {
		    		var _e = $(e.target);
		    		var _parent_id = _e.parent().attr('id');
		    		return _e.parent().removeClass(_info_selected_class);

		    	},
		    	toggleQuickNav: function() {
		    		return _ui_quickNav.stop().slideToggle();
		    	},
		    	closeAccordion: function () {
		    		if (this.default()) {
		    			$('.accordion-navigation, .accordion-navigation .content').removeClass('active');
		    		}
		    		return;
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
							_landscapeMod.foundation('reveal', 'open');
						} else if (isMobile.any() && $(window).height() > 459 && !landscape && fired) {
							//farmBuilding.init.refresh();
						}
					}
					return;
		    	}
		    },
		    resizer: function (f) {
		    		if(_local.isConfigurable())
		    			setUISlide();
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
			    		$(this).makeSQ();
			    	});
			    	_NS.uiEvent.checkOrientation(f);
			    	// added initializers
		            if (isMobile.any() || $(window).width() <= 1025) {
		            	$('.accordion-navigation .content').stop().removeClass('active');
		            	$('dl.accordion').stop().data('options', 'multi_expand:false;toggleable: true');
		            } else {
		            	if (!$('.accordion-navigation .content').stop().hasClass('active')) {
		            		$('.accordion-navigation .content').stop().addClass('active');
		            	}
		            	$('dl.accordion').stop().data('options', 'multi_expand:true;toggleable: true');
		            }
		            $("#mainAccordion .panelnav, #mobileAccordion .panelnav").stop().fitText(1.2, { minFontSize: '6px', maxFontSize: '17px' });
					$("#productTitle, #calcPrice").stop().fitText(1, { minFontSize: '6px', maxFontSize: '25px' });
					$("#shortDesc").stop().fitText(1.1, { minFontSize: '4px', maxFontSize: '20px' });
					$("#addToCart").stop().fitText(1.1, { minFontSize: '10px', maxFontSize: '25px' });
					$("#build_FabricColor button").stop().fitText(1.1, { minFontSize: '10px', maxFontSize: '25px' });
	    		return;
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
		    	return;
		    },
		    
		    modalWork: {
		    	contactModal: function () {
		    		$('#contactModal #infoTable').text('testing');
		    		return;
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
			    	return;
		    	}
		    },
		    loading: function(start) {
		    	var _unLoad = function(start) {
		    		_bod.removeClass('loading');
		    		$('#building').find('img').removeClass('op_0');
	        		$('.elements').removeClass('op_0');
	        		$('#loader').removeClass('loading');
	        		delete farmBuilding;
	        	}
	    		if(start) {
		    		_bod.addClass('loading');
		    		$('#building').find('img').addClass('op_0');
	        		$('.elements').addClass('op_0');
	        		$('#loader').addClass('loading');
		    	} else {
		    		if(loadingTimer) clearTimeout(loadingTimer);
		    		loadingTimer = setTimeout( _unLoad, 3000);
		    	}
		    	return true;
			},
		    init:{ 
		    	
		        getState:function(onloader){
		        	// set selectArray from form values
	        		$('.buttonContainer, #quickNav, .UISection select').html('');
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
				    
		            _NS.imageUrl();
		            _NS.uiLoad.getFormAndSetUI();
		            
		            
		            if(onloader) {
		            	_NS.resizer();
		            }

		            _NS.infoVisible();
		            _NS.uiLoad.setPrice();
		            return _NS.loading(false);
		        	
		        },
		        loader: function() {
	        	
		        	_NS.uiLoad.ajaxModalConnect();
		    		if(_local.isConfigurable()) {

		    			Pace.on('done', function(){ if(!editConfiguration) { if (_NS.init.getState(true)) { _local.pop.start(); } } });
			    		
			    	} else {
			    		farmBuilding.resizer();
			    	}

			    	return true;
		    	},
			    refresh: function () {
			    	return window.location = window.location;
			    }
		    },
		    common: {
		    	init: function() {
		    		if (_local.isConfigurable()) {
						/*
						|--------------------------------------------------------------------------
						| body mutation function
						|--------------------------------------------------------------------------
						*/
						var bodyChanged =  _.debounce(function () {
							$('.centerHorizontal').centerHorizontal();
				    		$('.centerVertical').centerVertical();
				    		$('.centerCenter').centerCenter();
				    		$('.makeSquare').makeSQ();
						}, 1500);
						
						// $("#cofiguratorMain").bind("DOMSubtreeModified", function() {
						//     bodyChanged();
						// });
						MutationObserver = window.MutationObserver || window.WebKitMutationObserver;

						var observer = new MutationObserver(function(mutations, observer) {
						    // fired when a mutation occurs
						    bodyChanged();
						    // ...
						});

						// define what element should be observed by the observer
						// and what types of mutations trigger the callback
						observer.observe(document.getElementById("cofiguratorMain"), {
						  subtree: true, attributes: true, childList: false, characterData: false
						  //...
						});
					}
		    	}
		    },
		    product_sp_series_shelter: {
		    	init: function() {
					if(editConfiguration) {
						setTimeout(function() {
							_NS.init.getState(true)
						}, 1500);
						$('.startOver').remove();
					} else {
						_NS.init.loader();
					}
					$('body').delegate('.UI','click',function(e) {
						e.preventDefault();
						e.stopPropagation();
						if(!$(this).hasClass('disable')) {
							var func = $(this).data('func');
							_.debounce(farmBuilding.uiEvent[func](e), 1000, true);
						}
					});
		    	}
		    },
		    checkout_cart_index: {
		    	init: function() {
		    		$('.btn-proceed-checkout span span').prepend('<i class="fa fa-shopping-cart"></i>');
		    	}
		    },
		    checkout_onepage_index: {
		    	init: function () {
		    		//$('#confirmModal').foundation('reveal', 'open');
		    		var formOnChanged =  _.debounce(function () {
		    			console.log($('#opc-review .btn-checkout').doesExist());
							if($('#opc-review .btn-checkout').doesExist()) {
								console.log($('#agreeTerms').doesExist());
								if(!$('#agreeTerms').doesExist()) {
									$('#review-buttons-container').prepend('<button id="agreeTerms" title="Place Order" class="button" data-reveal-id="confirmModal" ><span><span>Place Order</span></span></button>');
								}
							}
						}, 100);
						
						// $("#cofiguratorMain").bind("DOMSubtreeModified", function() {
						//     bodyChanged();
						// });
						MutationObserver = window.MutationObserver || window.WebKitMutationObserver;

						var formobserver = new MutationObserver(function(mutations, formobserver) {
						    // fired when a mutation occurs
						    formOnChanged();
						    // ...
						});

						// define what element should be observed by the observer
						// and what types of mutations trigger the callback
						formobserver.observe(document.getElementById("checkoutSteps"), {
						  subtree: true, attributes: true, childList: false, characterData: false
						  //...
						});
					$('body').delegate('#confirmOrder','click',function(e) {
						e.preventDefault();
						e.stopPropagation();
						$('[data-reveal]').foundation('reveal','close');
		    			review.save();	
					});
					
		    	}
		    }
		});
	    
	})(farmBuilding = farmBuilding || {});
	
	$(document).on('opened.fndtn.reveal', '#quoteModal', function () {
	  return farmBuilding.modalWork.quoteModal();
	});
	$(document).on('opened.fndtn.reveal', '[data-reveal]', function () {
		var modal = $(this);
	  	$('body').addClass('modalOpen');
	  	// on modal reveal resize text
		$('.reveal-modal h2').fitText(1.45, { minFontSize: '6px', maxFontSize: '43px' });
		$('.reveal-modal .color .btnColor span').fitText(1.45, { minFontSize: '10px', maxFontSize: '20px' });
		$('.reveal-modal#startModal h2').fitText(1.1, { minFontSize: '6px', maxFontSize: '63px' });
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
		return;
	});

	$(document).on('close.fndtn.reveal', '[data-reveal]', function () {
	    return $('body').removeClass('modalOpen');
	});
	var UTIL = {
	  fire: function(func, funcname, args) {
	    var namespace = farmBuilding;
	    funcname = (funcname === undefined) ? 'init' : funcname;
	    if (func !== '' && namespace[func] && typeof namespace[func][funcname] === 'function') {
	      namespace[func][funcname](args);
	    }
	  },
	  loadEvents: function() {
	    UTIL.fire('common');

	    $.each(document.body.className.replace(/-/g, '_').split(/\s+/),function(i,classnm) {
	      UTIL.fire(classnm);
	    });
	  }
	};
	$(document).ready(function() {
		/*
		|--------------------------------------------------------------------------
		| Document ready state
		|--------------------------------------------------------------------------
		*/
		$('.menu-icon').click(function(){ false });
	});

	$(window).load(UTIL.loadEvents);

	$(window).resize(function(){
	    /*
		|--------------------------------------------------------------------------
		| Document smart resize
		|--------------------------------------------------------------------------
		*/
		_.debounce(farmBuilding.init.getState(true), 1000, true);
		
	});

})(jQuery);