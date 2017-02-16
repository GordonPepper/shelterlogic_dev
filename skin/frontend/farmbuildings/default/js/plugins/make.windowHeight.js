// this is jquery dependant
/**
 * set the height and width to the window dimensions
 * @param  {[type]}   h  [description]
 * @param  {[type]}   w  [description]
 * @param  {Function} cb [description]
 * @return {[type]}      [description]
 */
jQuery.fn.winHW = function(ele,h,w,cb){
  var _e = jQuery(this);
  var _w = jQuery(window);
  var winH = _w.height();
  var winW = _w.width();
  if(h){_e.height(winH+'px');}
  if(w){_e.width(winW+'px');}
  typeof cb === 'function' && cb();
  //console.log(winH + ' - ' +winW);
};

//$(ele).winHW(window,true,true,callbackFunction());