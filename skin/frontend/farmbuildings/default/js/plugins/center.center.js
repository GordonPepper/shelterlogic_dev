// this is jquery dependant
/**
 * Center any dome element to its parent both vertically and horizontaly The position of the element must be set relative to parent and top:50%;left:50%;
 * @return {[type]} [description]
 */
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

// $(ele).centerCenter();

/**
 * Center any dome element to its parent verticaly The position of the element must be set relative to parent and top:50%;
 * @return {[type]} [description]
 */
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

// $(ele).centerVertical();

/**
 * Center any dome element to its parent horizontaly The position of the element must be set relative to parent and left:50%;
 * @return {[type]} [description]
 */
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

// $(ele).centerHorizontal);