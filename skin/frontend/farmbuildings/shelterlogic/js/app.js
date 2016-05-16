/**
 * Magento Enterprise Edition
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Magento Enterprise Edition License
 * that is bundled with this package in the file LICENSE_EE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.magentocommerce.com/license/enterprise-edition
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @category    design
 * @package     rwd_default
 * @copyright   Copyright (c) 2014 Magento Inc. (http://www.magentocommerce.com)
 * @license     http://www.magentocommerce.com/license/enterprise-edition
 */

// =============================================
// Primary Break Points
// =============================================

// These should be used with the bp (max-width, xx) mixin
// where a min-width is used, remember to +1 to break correctly
// If these are changed, they must also be updated in _var.scss

var bp = {
    xsmall: 479,
    small: 599,
    medium: 770,
    large: 979,
    xlarge: 1199
}

// ==============================================
// Search
// ==============================================

Varien.searchForm.prototype.initialize = function (form, field, emptyText) {
    this.form = $(form);
    this.field = $(field);
    this.emptyText = emptyText;

    this.validator = new Validation(this.form);

    Event.observe(this.form, 'submit', this.submit.bind(this));
    Event.observe(this.field, 'focus', this.focus.bind(this));
    Event.observe(this.field, 'blur', this.blur.bind(this));
    this.blur();
}

Varien.searchForm.prototype.submit = function (event) {
    if (!this.validator || !this.validator.validate()) {
        Event.stop(event);
        return false;
    }
    return true;
}

// ==============================================
// jQuery Init
// ==============================================

// Avoid PrototypeJS conflicts, assign jQuery to $j instead of $
var $j = jQuery.noConflict();

// Use $j(document).ready() because Magento executes Prototype inline
$j(document).ready(function () {

    // ==============================================
    // Shared Vars
    // ==============================================

    // Document
    var w = $j(window);
    var d = $j(document);
    var body = $j('body');

    // =============================================
    // Skip Links
    // =============================================

    var skipContents = $j('.skip-content');
    var skipLinks = $j('.skip-link');

    skipLinks.on('click', function (e) {
        e.preventDefault();

        var self = $j(this);
        var target = self.attr('href');

        // Get target element
        var elem = $j(target);

        // Check if stub is open
        var isSkipContentOpen = elem.hasClass('skip-active') ? 1 : 0;

        // Hide all stubs
        skipLinks.removeClass('skip-active');
        skipContents.removeClass('skip-active');

        // Toggle stubs
        if (isSkipContentOpen) {
            self.removeClass('skip-active');
        } else {
            self.addClass('skip-active');
            elem.addClass('skip-active');
        }
    });

    $j('#header-cart').on('click', '.skip-link-close', function(e) {
        var parent = $j(this).parents('.skip-content');
        var link = parent.siblings('.skip-link');

        parent.removeClass('skip-active');
        link.removeClass('skip-active');

        e.preventDefault();
    });


    // ==============================================
    // Header Menus
    // ==============================================

    var nav = $j('#nav');

    // ----------------------------------------------
    // Top Menus

    var MenuManagerState = {
        TOUCH_SCROLL_THRESHOLD: 20,

        touchStartPosition: null,

        shouldCancelTouch: function() {
            if(!this.touchStartPosition) {
                return false;
            }

            var scroll = $j(window).scrollTop() - this.touchStartPosition;
            return Math.abs(scroll) > this.TOUCH_SCROLL_THRESHOLD;
        }
    };

    var pointerEvent = 'touchend';
    // If device has implemented touch/click agnostic event, use it instead of "click"
    if (window.navigator.pointerEnabled) {
        pointerEvent = 'pointerdown';
    } else if (window.navigator.msPointerEnabled) {
        pointerEvent = 'MSPointerDown';
    }
    nav.find('a.has-children.level0').on(pointerEvent,function (event) {
        //scroll occurred, cancel event
        if(MenuManagerState.shouldCancelTouch()) {
            return;
        }

        // If mouse is being used on large viewport, use native hover state
        if (window.navigator.msPointerEnabled
            && event.originalEvent.pointerType == 'mouse'
            && Modernizr.mq("screen and (min-width:" + (bp.medium + 1) + "px)")
        ) {
            $j(this).data('has-touch', false);
            return;
        }
        $j(this).data('has-touch', true);
        var elem = $j(this).parent();

        var alreadyExpanded = elem.hasClass('menu-active');

        nav.find('li.level0').removeClass('menu-active');

        // Collapse all active sub-menus
        nav.find('.sub-menu-active').removeClass('sub-menu-active');

        if (!alreadyExpanded) {
            elem.addClass('menu-active');
        }

        event.preventDefault();
    }).on('click', function (event) {
        var elem = $j(this);
        if (elem.data('has-touch')) {
            elem.data('has-touch', false);
            event.preventDefault();
            return;
        }

        if(Modernizr.mq("screen and (max-width:" + bp.medium + "px)")) {
            var elem = $j(this).parent();

            var alreadyExpanded = elem.hasClass('menu-active');

            nav.find('li.level0').removeClass('menu-active');

            // Collapse all active sub-menus
            nav.find('.sub-menu-active').removeClass('sub-menu-active');

            if (!alreadyExpanded) {
                elem.addClass('menu-active');
            }

            event.preventDefault();
        }

    }).on('touchstart', function(event) {
        $j(this).data('has-touch');
        MenuManagerState.touchStartPosition = $j(window).scrollTop();
    });

    // ----------------------------------------------
    // Sub Menus

    nav.find('li.level1 a.has-children').on('click', function (e) {
        e.preventDefault();
        e.stopPropagation();

        var elem = $j(this).parent();

        // Check if sub-menu is open
        var isSubMenuActive = elem.hasClass('sub-menu-active') ? 1 : 0;

        // On smaller screens, allow multiple sibling sub-menus to show at once,
        // but this is a large touch device, avoid multiple sub-menus showing at once.
        if (Modernizr.mq("screen and (min-width:" + (bp.medium + 1) + "px)")) {
            elem
                .siblings('.sub-menu-active')
                .removeClass('sub-menu-active')
                .find('.sub-menu-active')
                .removeClass('sub-menu-active');
        }
        if (isSubMenuActive) {
            elem.removeClass('sub-menu-active');
        } else {
            elem.addClass('sub-menu-active');
        }
    });

    // Prevent sub menus from spilling out of the window.
    function preventMenuSpill() {
        var windowWidth = $j(window).width();
        $j('ul.level0').each(function(){
            var ul = $j(this);
            //Show it long enough to get info, then hide it.
            ul.addClass('position-test');
            ul.removeClass('spill');
            var width = ul.outerWidth();
            var offset = ul.offset().left;
            ul.removeClass('position-test');
            //Add the spill class if it will spill off the page.
            if ((offset + width) > windowWidth) {
                ul.addClass('spill');
            }
        });
    }
    preventMenuSpill();
    $j(window).on('delayed-resize', preventMenuSpill);


    // ==============================================
    // Language Switcher
    // ==============================================

    // In order to display the language switcher next to the logo, we are moving the content at different viewports,
    // rather than having duplicate markup or changing the design
/*
    enquire.register('(max-width: ' + bp.medium + 'px)', {
        match: function () {
            $j('.page-header-container .store-language-container').prepend($j('.form-language'));
        },
        unmatch: function () {
            $j('.header-language-container .store-language-container').prepend($j('.form-language'));
        }
    });
*/
    // ==============================================
    // Enquire JS
    // ==============================================

    enquire.register('screen and (min-width: ' + (bp.medium + 1) + 'px)', {
        match: function () {
            $j('.menu-active').removeClass('menu-active');
            $j('.sub-menu-active').removeClass('sub-menu-active');
            $j('.skip-active').removeClass('skip-active');
        },
        unmatch: function () {
            $j('.menu-active').removeClass('menu-active');
            $j('.sub-menu-active').removeClass('sub-menu-active');
            $j('.skip-active').removeClass('skip-active');
        }
    });

    // ==============================================
    // UI Pattern - Media Switcher
    // ==============================================

    // Used to swap primary product photo from thumbnails.

    var mediaListLinks = $j('.media-list').find('a');
    var mediaPrimaryImage = $j('.primary-image').find('img');

    if (mediaListLinks.length) {
        mediaListLinks.on('click', function (e) {
            e.preventDefault();

            var self = $j(this);

            mediaPrimaryImage.attr('src', self.attr('href'));
        });
    }

    // ==============================================
    // UI Pattern - ToggleSingle
    // ==============================================

    // Use this plugin to toggle the visibility of content based on a toggle link/element.
    // This pattern differs from the accordion functionality in the Toggle pattern in that each toggle group acts
    // independently of the others. It is named so as not to be confused with the Toggle pattern below
    //
    // This plugin requires a specific markup structure. The plugin expects a set of elements that it
    // will use as the toggle link. It then hides all immediately following siblings and toggles the sibling's
    // visibility when the toggle link is clicked.
    //
    // Example markup:
    // <div class="block">
    //     <div class="block-title">Trigger</div>
    //     <div class="block-content">Content that should show when </div>
    // </div>
    //
    // JS: jQuery('.block-title').toggleSingle();
    //
    // Options:
    //     destruct: defaults to false, but if true, the plugin will remove itself, display content, and remove event handlers


    jQuery.fn.toggleSingle = function (options) {

        // passing destruct: true allows
        var settings = $j.extend({
            destruct: false
        }, options);

        return this.each(function () {
            if (!settings.destruct) {
                $j(this).on('click', function () {
                    $j(this)
                        .toggleClass('active')
                        .next()
                        .toggleClass('no-display');
                });
                // Hide the content
                $j(this).next().addClass('no-display');
            } else {
                // Remove event handler so that the toggle link can no longer be used
                $j(this).off('click');
                // Remove all classes that were added by this plugin
                $j(this)
                    .removeClass('active')
                    .next()
                    .removeClass('no-display');
            }

        });
    }

    // ==============================================
    // UI Pattern - Toggle Content (tabs and accordions in one setup)
    // ==============================================
    
    $j('.toggle-content').each(function () {
        var wrapper = jQuery(this);

        var hasTabs = wrapper.hasClass('tabs');
        var hasAccordion = wrapper.hasClass('accordion');
        var startOpen = wrapper.hasClass('open');

        var dl = wrapper.children('dl:first');
        var dts = dl.children('dt');
        var panes = dl.children('dd');
        var groups = new Array(dts, panes);

        //Create a ul for tabs if necessary.
        if (hasTabs) {
            var ul = jQuery('<ul class="toggle-tabs"></ul>');
            dts.each(function () {
                var dt = jQuery(this);
                var li = jQuery('<li></li>');
                li.html(dt.html());
                ul.append(li);
            });
            ul.insertBefore(dl);
            var lis = ul.children();
            groups.push(lis);
        }

        //Add "last" classes.
        var i;
        for (i = 0; i < groups.length; i++) {
            groups[i].filter(':last').addClass('last');
        }

        function toggleClasses(clickedItem, group) {
            var index = group.index(clickedItem);
            var i;
            for (i = 0; i < groups.length; i++) {
                groups[i].removeClass('current');
                groups[i].eq(index).addClass('current');
            }
        }

        //Toggle on tab (dt) click.
        dts.on('click', function (e) {
            //They clicked the current dt to close it. Restore the wrapper to unclicked state.
            if (jQuery(this).hasClass('current') && wrapper.hasClass('accordion-open')) {
                wrapper.removeClass('accordion-open');
            } else {
                //They're clicking something new. Reflect the explicit user interaction.
                wrapper.addClass('accordion-open');
            }
            toggleClasses(jQuery(this), dts);
        });

        //Toggle on tab (li) click.
        if (hasTabs) {
            lis.on('click', function (e) {
                toggleClasses(jQuery(this), lis);
            });
            //Open the first tab.
            lis.eq(0).trigger('click');
        }

        //Open the first accordion if desired.
        if (startOpen) {
            dts.eq(0).trigger('click');
        }

    });


    // ==============================================
    // Layered Navigation Block
    // ==============================================

    // On product list pages, we want to show the layered nav/category menu immediately above the product list.
    // While it would make more sense to just move the .block-layered-nav block rather than .col-left-first
    // (since other blocks can be inserted into left_first), it creates simpler code to move the entire
    // .col-left-first block, so that is the approach we're taking

/* DISABLED: Function not needed and causes problem with multiple duplicates of left column content when resizing.
    if ($j('.col-left-first > .block').length && $j('.category-products').length) {
        enquire.register('screen and (max-width: ' + bp.medium + 'px)', {
            match: function () {
                $j('.col-left-first').insertBefore($j('.category-products'))
            },
            unmatch: function () {
                // Move layered nav back to left column
                $j('.col-left-first').insertBefore($j('.col-main'))
            }
        });
    }
*/

    // ==============================================
    // 3 column layout
    // ==============================================

    // On viewports smaller than 1000px, move the right column into the left column
    if ($j('.main-container.col3-layout').length > 0) {
        enquire.register('screen and (max-width: 1000px)', {
            match: function () {
                var rightColumn = $j('.col-right');
                var colWrapper = $j('.col-wrapper');

                rightColumn.appendTo(colWrapper);
            },
            unmatch: function () {
                var rightColumn = $j('.col-right');
                var main = $j('.main');

                rightColumn.appendTo(main);
            }
        });
    }


    // ==============================================
    // Block collapsing (on smaller viewports)
    // ==============================================

    enquire.register('(max-width: ' + bp.medium + 'px)', {
        setup: function () {
            this.toggleElements = $j(
                // This selects the menu on the My Account and CMS pages
                '.col-left-first .block:not(.block-layered-nav) .block-title, ' +
                    '.col-left-first .block-layered-nav .block-subtitle--filter, ' +
                    '.sidebar:not(.col-left-first) .block .block-title'
            );
        },
        match: function () {
            this.toggleElements.toggleSingle();
        },
        unmatch: function () {
            this.toggleElements.toggleSingle({destruct: true});
        }
    });


    // ==============================================
    // OPC - Progress Block
    // ==============================================

    if ($j('body.checkout-onepage-index').length) {
        enquire.register('(max-width: ' + bp.large + 'px)', {
            match: function () {
                $j('#checkout-step-review').prepend($j('#checkout-progress-wrapper'));
            },
            unmatch: function () {
                $j('.col-right').prepend($j('#checkout-progress-wrapper'));
            }
        });
    }

    // ==============================================
    // Checkout Cart - events
    // ==============================================

/*
    if ($j('body.checkout-cart-index').length) {
        $j('input[name^="cart"]').focus(function () {
            $j(this).siblings('button').fadeIn();
        });
    }
*/
    var QtyHasChanged = false;
    $j(".cart_update_trigger").on({

        click:function(e){
            QtyHasChanged = false;
            $j("#cart_update_form").submit();
        }

    });

    function msgCloseFN(o,e,i){
        o.closest(e).fadeOut("normal",function(){i.remove();});
    }
    $j(".messages").find("span").after('<div class="dismiss fa fa-times" title="Close Message"></div>').end().find(".dismiss").each(function(){
        var thisDismiss=$j(this);
        $j(this).on({
            click:function(){
                var thisMsg=$j(this).closest("ul");
                if($j(thisMsg).children().length>1) {
                    msgCloseFN(thisDismiss,"li",$j(this));
                } else {
                    msgCloseFN(thisDismiss,"ul",$j(this));
                }
            }
        });
    });

    // ==============================================
    // Store Item Details
    // ==============================================

    var qtyWrapper=".qty-wrapper",
    qtyItems=[".qty-dec",".qty-inc"],
    qtyCounterFN=function(b,o,s){
        var url = window.location.href;
        var cart_url = "/checkout/cart/";

        $j(o).on({click:function(e){
            e.preventDefault();
        }});
        if (b) {
            $j(o,s).on({
                click:function(e){$j(".qty",s).val(function(i,v){
                    if (url.indexOf(cart_url) > -1){
                        QtyHasChanged = true;
                    }
                    return(++v);
                });}
            });
        } else {
            $j(o,s).on({
                click:function(e){$j(".qty",s).val(function(i,v){
                    if (url.indexOf(cart_url) > -1){
                        QtyHasChanged = true;
                    }

                    return((--v>0)?v:1);});}
            });
        }
    }
    $j(qtyWrapper).each(function(){
        $j(this).find(".qty").on({
            change:function(i,v){
                $j(this).val(function(i,v){return(((isNaN(v))||v<1)?1:v);});
            }
        });
    });
    $j(qtyWrapper).each(function(){
        var zet=$(this);
        $j(qtyItems,this).each(
            function(i,v){
                if (i>0){qtyCounterFN(true,v,zet);}else{qtyCounterFN(false,v,zet);}
            }
        );
    });

    $j(window).on('beforeunload', function() {
        if (QtyHasChanged){
            return 'You have changed the quantity of items in your cart. You must click "Update Cart" to save these changes.';
        }
    });

    // ==============================================
    // Header Search Control
    // ==============================================

    var hdrSearch="#header-search";
    $j("label",hdrSearch).on({
  //      click:function(e){
//            $j(".input-box",hdrSearch).toggle();
    //    }
    });

    // ==============================================
    // Product Listing - Align action buttons/links
    // ==============================================

    // Since the number of columns per grid will vary based on the viewport size, the only way to align the action
    // buttons/links is via JS

    if ($j('.products-grid').length) {

        var alignProductGridActions = function () {
            var gridRows = []; // This will store an array per row
            var tempRow = [];
            productGridElements = $j('.products-grid > li');
            productGridElements.each(function (index) {
                // The JS ought to be agnostic of the specific CSS breakpoints, so we are dynamically checking to find
                // each row by grouping all cells (eg, li elements) up until we find an element that is cleared.
                // We are ignoring the first cell since it will always be cleared.
                if ($j(this).css('clear') != 'none' && index != 0) {
                    gridRows.push(tempRow); // Add the previous set of rows to the main array
                    tempRow = []; // Reset the array since we're on a new row
                }
                tempRow.push(this);

                // The last row will not contain any cells that clear that row, so we check to see if this is the last cell
                // in the grid, and if so, we add its row to the array
                if (productGridElements.length == index + 1) {
                    gridRows.push(tempRow);
                }
            });

            $j.each(gridRows, function () {
                var tallestHeight = 0;
                $j.each(this, function () {
                    // Since this function is called every time the page is resized, we need to remove the min-height
                    // so each cell can return to its natural size before being measured.
                    $j(this).find('.product-info').css('height', '');
                    // We are checking the height of .product-info (rather than the entire li), because the images
                    // will not be loaded when this JS is run.
                    elHeight = parseInt($j(this).find('.product-info').css('height'));
                    if (elHeight > tallestHeight) {
                        tallestHeight = elHeight;
                    }
                });
                // Set the height of all .product-info elements in a row to the tallest height
                $j.each(this, function () {
                    $j(this).find('.product-info').css('height', tallestHeight);
                });
            });
        }
        alignProductGridActions();

        // Since the height of each cell and the number of columns per page may change when the page is resized, we are
        // going to run the alignment function each time the page is resized.
        $j(window).on('delayed-resize', function (e, resizeEvent) {
            alignProductGridActions();
        });
    }

    // ==============================================
    // Generic, efficient window resize handler
    // ==============================================

    // Using setTimeout since Web-Kit and some other browsers call the resize function constantly upon window resizing.
    var resizeTimer;
    $j(window).resize(function (e) {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function () {
            $j(window).trigger('delayed-resize', e);
        }, 250);
    });
});

// ==============================================
// PDP - image zoom - needs to be available outside document.ready scope
// ==============================================

var ProductMediaManager = {
    IMAGE_ZOOM_THRESHOLD: 20,
    zoomEnabled: Modernizr.mq("screen and (min-width:768px)"),
    imageWrapper: null,

    destroyZoom: function() {
        $j('.zoomContainer').remove();
        $j('.product-image-gallery .gallery-image').removeData('elevateZoom');
    },

    createZoom: function(image) {
        ProductMediaManager.destroyZoom();

        if(!ProductMediaManager.zoomEnabled) { //zoom not enabled
            return;
        }

        if(image.length <= 0) { //no image found
            return;
        }

        // UPDATE: In Shelterlogic, the zoomed image always have adequate size
        //if(image[0].naturalWidth && image[0].naturalHeight) {
        //    var widthDiff = image[0].naturalWidth - image.width() - ProductMediaManager.IMAGE_ZOOM_THRESHOLD;
        //    var heightDiff = image[0].naturalHeight - image.height() - ProductMediaManager.IMAGE_ZOOM_THRESHOLD;
        //
        //    if(widthDiff < 0 && heightDiff < 0) {
        //        //image not big enough
        //
        //        image.parents('.product-image').removeClass('zoom-available');
        //
        //        return;
        //    } else {
        //        image.parents('.product-image').addClass('zoom-available');
        //    }
        //}

        image.elevateZoom();
    },

    swapImage: function(targetImage) {
        targetImage = $j(targetImage);
        targetImage.addClass('gallery-image');

        ProductMediaManager.destroyZoom();

        var imageGallery = $j('.product-image-gallery');

        if(targetImage[0].complete) { //image already loaded -- swap immediately

            imageGallery.find('.gallery-image').removeClass('visible');

            //move target image to correct place, in case it's necessary
            imageGallery.append(targetImage);

            //reveal new image
            targetImage.addClass('visible');

            //wire zoom on new image
            ProductMediaManager.createZoom(targetImage);

        } else { //need to wait for image to load

            //add spinner
            imageGallery.addClass('loading');

            //move target image to correct place, in case it's necessary
            imageGallery.append(targetImage);

            //wait until image is loaded
            imagesLoaded(targetImage, function() {
                //remove spinner
                imageGallery.removeClass('loading');

                //hide old image
                imageGallery.find('.gallery-image').removeClass('visible');

                //reveal new image
                targetImage.addClass('visible');

                //wire zoom on new image
                ProductMediaManager.createZoom(targetImage);
            });

        }
    },

    wireThumbnails: function() {
        //trigger image change event on thumbnail click
        $j('.product-image-thumbs .thumb-link').click(function(e) {
            e.preventDefault();
            var jlink = $j(this);
            var target = $j('#image-' + jlink.data('image-index'));

            ProductMediaManager.swapImage(target);
        });
    },

    initZoom: function() {
        ProductMediaManager.createZoom($j(".no-touch .gallery-image.visible")); //set zoom on first image
    },

    init: function() {
        ProductMediaManager.imageWrapper = $j('.product-img-box');

        enquire.register("screen and (min-width:768px)", {
            match : function() {
                ProductMediaManager.zoomEnabled = true;
                ProductMediaManager.initZoom();
            },
            unmatch : function() {
                ProductMediaManager.destroyZoom();
                ProductMediaManager.zoomEnabled = false;
            }
        });
        //resizing the window causes problems with zoom -- reinitialize
        $j(window).on('delayed-resize', function(e, resizeEvent) {
            ProductMediaManager.destroyZoom();
            ProductMediaManager.initZoom();
        });

        ProductMediaManager.wireThumbnails();

        $j(document).trigger('product-media-loaded', ProductMediaManager);
    }
};

$j(document).ready(function() {
    ProductMediaManager.init();
});

/*
 * jQuery throttle / debounce - v1.1 - 3/7/2010
 * http://benalman.com/projects/jquery-throttle-debounce-plugin/
 *
 * Copyright (c) 2010 "Cowboy" Ben Alman
 * Dual licensed under the MIT and GPL licenses.
 * http://benalman.com/about/license/
 */
(function(b,c){var $=b.jQuery||b.Cowboy||(b.Cowboy={}),a;$.throttle=a=function(e,f,j,i){var h,d=0;if(typeof f!=="boolean"){i=j;j=f;f=c}function g(){var o=this,m=+new Date()-d,n=arguments;function l(){d=+new Date();j.apply(o,n)}function k(){h=c}if(i&&!h){l()}h&&clearTimeout(h);if(i===c&&m>e){l()}else{if(f!==true){h=setTimeout(i?k:l,i===c?e-m:e)}}}if($.guid){g.guid=j.guid=j.guid||$.guid++}return g};$.debounce=function(d,e,f){return f===c?a(d,e,false):a(d,f,e!==false)}})(this);

/* Slide Toggle */

$j.fn.xMod=function(o) {
	var sObj=this,
	trigger=o.trigger,
	target=o.target,
	sObjTrig;
	if (!o.xbind) {
        $j(sObj).removeClass("x-active").find(trigger).off("click");
        $j(this).closest(sObj).find(target).removeAttr("style");
    } else if ($j(sObj).hasClass("x-active")) {
        return;
    } else {
        $j(sObj).addClass("x-active").find(trigger).on({
            click:function(e){
                e.preventDefault();
                $j(this).toggleClass("active").closest(sObj).find(target).slideToggle(400);
            }
        });
    }
}

$j(document).ready(function() {

    function xModBind(b,o) {
        $j(".x-mod",o).each(function() {

            $j(this).xMod({
                xbind:b,
                trigger:".x-trigger",
                target:".x-target"
            });
        });
    }

    xModBind(true,"body");

    function spFN() {
        if ($j("#mobitoggle").is(":visible")) {
            $j("#footer .x-footer-mod").each(function() {
                $j(this).xMod({
                    xbind:true,
                    trigger:".x-trigger",
                    target:".x-target"
                });
            });
        } else {
            $j("#footer .x-footer-mod").each(function() {
                $j(this).xMod({
                    xbind:false,
                    trigger:".x-trigger",
                    target:".x-target"
                });
            });
        }
    }

    spFN();

    $j(window).resize($j.debounce(500,spFN));

/* Recommended Products - Match Height - Begin */

	function recommendedProductsFN(){
        if ($j("#mobitoggle").is(":visible")) {
        	$j("#product-recommended-items").recommendedProducts(false);
        } else {
        	$j("#product-recommended-items").recommendedProducts(true);
        }
	}
	$j.fn.recommendedProducts=function(b) {
		var sObj=$j(this).find("ul ul>li>a");
		var rpMinH=0;
    	var rpTmpH=0;
		if (b) {
			sObj.each(function(){
                $j(this).css("min-height","0px");
				rpTmpH=$j(this).innerHeight();
				rpMinH=(rpTmpH>rpMinH)?rpTmpH:rpMinH;
			});
			sObj.css("min-height",rpMinH+"px");
		} else {
			sObj.each(function(){
				$j(this).css("min-height","0px");
			});
		}
	}
	recommendedProductsFN();
	$j(window).resize($j.debounce(500,recommendedProductsFN));
    $j(".flex-block .x-trigger").on({
        click:function(){
            setTimeout(function(){
            	recommendedProductsFN();
            },500);
        }
    });
/* Recommended Products - Match Height - End */

/* Magpassion Menu - Emulate Mobile Touch Event - Begin */
    function magFN(b){

        var magNavContainer=$j("#magpassion-nav-container");

        magNavContainer.find(">ul>li>a.hasChild").off("click.mag");

        if (b) {
            magNavContainer.find(">ul>li>a.hasChild").on("click.mag",function(e) {
                e.preventDefault();
                $j(this).parent().toggleClass("active").siblings().removeClass("active");
            });
        } else {
            magNavContainer.find(">ul>li>a.hasChild").on("click.mag",function(e) {
                if ($j(this).parent().find(">ul").css("opacity")==0) {
                    e.preventDefault();
                }
                $j(this).parent().addClass("active").siblings().removeClass("active");
            });
        }

    }

    /* Initialize navigation check mobile vs desktop */
    function magInitFN() {
        if ($j("#header [href*='header-nav']").is(":visible")) {
            magFN(true);
        } else {
            magFN(false);
        }
    }
    magInitFN();
    $j(window).resize($j.debounce(500,magInitFN));
/* Magpassion Menu - Emulate Mobile Touch Event - End */

});