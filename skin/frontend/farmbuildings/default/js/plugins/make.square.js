// this is jquery dependant
/**
 * make it square
 * @param  {[type]}   ele [description]
 * @param  {[type]}   h   [description]
 * @param  {[type]}   w   [description]
 * @param  {Function} cb  [description]
 * @return {[type]}       [description]
 */
jQuery.fn.makeSQ = function(cb){
  var _e = jQuery(this),
      _eW = _e.outerWidth();
      //console.log(_eW);
    _e.css({ 'width':_eW, 'height':_eW});
  typeof cb === 'function' && cb();
  return;
};

// $(ele).makeSQ();