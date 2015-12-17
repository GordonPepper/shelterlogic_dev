jQuery.extend({
        setHotspots : function(slide, hotspots) {
            
                if (!hotspots) return;
                var i=0;
                hotspots.each(function() {
                   if (!document.getElementById(hotspots[i].id)) {
                       /******/
                       var imgwidth = slide.width();
                       var scale= imgwidth/hotspots[i].imgW;
                       console.log('scale:'+scale);
                       console.log('hotspots[i].imgH:'+hotspots[i].imgH+' hotspots[i].imgW:'+hotspots[i].imgW);
                       console.log('slide.width:'+slide.width()+' slide.height:'+slide.height());
                       if(typeof hotspots[i].imgW == 'undefined' || hotspots[i].imgW === null){scale = 1;hotspots[i].imgH = slide.height();}
                       var offsetH = parseInt((hotspots[i].imgH*scale - slide.height())/2);
                       /******/
                       console.log('offsetH:'+offsetH);
                       console.log('left:'+parseInt(hotspots[i].left*scale)+' top:'+parseInt(hotspots[i].top*scale - offsetH));
                       slide.append('<div class="hotspot" id="'+hotspots[i].id+'" style="left:'+parseInt(hotspots[i].left*scale)+'px; top:'+parseInt(hotspots[i].top*scale - offsetH)+'px; width:'+parseInt(hotspots[i].width*scale)+'px; height:'+parseInt(hotspots[i].height*scale)+'px;">'+hotspots[i].text+'</div>');
                       var infoblock = slide.find('#'+hotspots[i].id +' .product-info');
                       var infowidth = infoblock.width();             
                       var hspt_width_hf = parseInt(hotspots[i].width*scale/2);
                       var leftposition = hotspots[i].left*scale+hspt_width_hf+7;                
                       infoblock.find('.info-icon').css('left',hspt_width_hf+'px');     
                       if (((leftposition + infowidth + 10)> imgwidth) && (leftposition>(imgwidth-leftposition))) 
                       {
                          if ( jQuery.browser.msie && jQuery.browser.version=='8.0') {
                              if (leftposition-5<infowidth) {
                              infoblock.css('width', leftposition-20 +'px');
                              infowidth = infoblock.width();      
                              }
                              infoblock.css('left', hspt_width_hf-7-infowidth-2*parseInt(infoblock.css('padding-left'))+'px');
                          }
                          else
                          {
                              infoblock.css('left', '');
                              infoblock.css('right', hspt_width_hf+7+'px');               
                          } 
                          
                          if (leftposition-5<infowidth) {
                              infoblock.css('width', leftposition-20 +'px');
                              infowidth = infoblock.width();
                          }      
                        }
                        else
                        {
                             infoblock.css('left', hspt_width_hf+7 + 'px');
                             if ((imgwidth-leftposition-5)<infowidth) {
                                  infoblock.css('width', imgwidth-leftposition-20 +'px');
                                  infowidth = infoblock.width();      
                              }  
                        }
                        var imgheight = slide.height();
                        var infoheight = infoblock.height(); 

                        var hspt_height_hf = parseInt(hotspots[i].height*scale/2);
                        var topposition = hotspots[i].top*scale+hspt_height_hf; 
                        if (((topposition + infoheight + 30)> imgheight) && (topposition>(imgheight-topposition))) 
                        {
                          if ( jQuery.browser.msie && jQuery.browser.version=='8.0') {
                              if (topposition-5<infoheight) {
                               infoblock.css('height', topposition-10 +'px');
                               infoheight = infoblock.height();      
                              }
                              infoblock.css('top', hspt_height_hf-infoheight-2*parseInt(infoblock.css('padding-top'))+'px');
                          }
                          else
                          {
                              infoblock.css('top', '');
                              infoblock.css('bottom', hspt_height_hf+'px');                 
                          }
                          if (topposition-5<infoheight) {
                              infoblock.css('height', topposition-10 +'px');
                              infoheight = infoblock.height();      
                          }
                        }
                        else
                        {
                             infoblock.css('top', hspt_height_hf + 'px');
                             if ((imgheight-topposition-5)<infoheight) {
                                  infoblock.css('height', imgheight-topposition-10 +'px');
                                  infoheight = infoblock.height();      
                             }
                        }     
                        /////// set position for hotspot-icon /////////////
                        console.log('hotspots[i].icon_width:'+hotspots[i].icon_width);
                        var icon = slide.find('#'+hotspots[i].id +' .hotspot-icon');
                        var icon_left = hspt_width_hf -15/* - (hotspots[i].icon_width/2)*/;
                        var icon_top = hspt_height_hf -15/* - (hotspots[i].icon_height/2)*/;
                        icon.css('left',parseInt(icon_left));
                        icon.css('top',parseInt(icon_top));
                        ///////////////////////////////////////////////////
                        
                        i++;
                  }             
              });
        }
});
  
jQuery(document).ready(function() {
    jQuery('.product-info a').on('click touchend', function(e) {
        var el = jQuery(this);
        var link = el.attr('href');
        window.location = link;
    });
    /******************************/
    if ("ontouchstart" in document.documentElement) {
        jQuery(document).on('touchstart', 'body', function(e) {
            jQuery(".hotspot").removeClass('hover');
        });
        jQuery(document).on('touchstart', '.hotspot', function(e) {
            jQuery(this).addClass('hover');
            e.stopPropagation();
        });
        jQuery(document).on('touchstart', '.hotspot .product-info', function(event) {
            event.stopPropagation();
        });
    }
    /******************************/
});              