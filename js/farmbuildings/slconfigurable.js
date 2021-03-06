/**
 * Americaneagle
 */
if(typeof aeProduct == 'undefined') {
    var aeProduct = {};
}

aeProduct.Config = Class.create();
aeProduct.Config.prototype = {
    initialize: function(config) {
        this.config = config;
        this.settings = $$('.super-attribute-select');
        var self = this;
        if(this.config.hasOwnProperty('reconfigure') && this.config.reconfigure == "true") {
            var attributeId = '';
            for(var i = 0; i < this.settings.length; i++ ) {
                attributeId = this.settings[i].id.replace(/[a-z]*/, '');
                for(var j = 0; j < this.config.attributes[attributeId].length; j++) {
                    var newOption = new Option(this.config.attributes[attributeId][j]['val'], this.config.attributes[attributeId][j]['id']);
                    if(this.config.attributes[attributeId][j].selected == 1) {
                        newOption.selected = true;
                    }
                    this.settings[i].options[j+1] = newOption;
                    if(this.config.attributes[attributeId][j].pid !== "undefined"){
                        this.settings[i].options[j+1].writeAttribute('data-pid', this.config.attributes[attributeId][j].pid);
                    }

                }
            }
            document.observe("dom:loaded", function() {
                self.updateAttributes(self.config.additional);
            });

        } else {
            // set first one:
            for (i = 0; i < this.config['options'].length; i++) {
                var newOption = new Option(this.config.options[i]['val'], this.config.options[i]['id']);
                this.settings[0].options[i+1] = newOption;
                if (this.config.options[i]['pid'] !== "undefined"){
                    this.settings[0].options[i+1].writeAttribute('data-pid',this.config.options[i]['pid']);
                }
            }
            // disable the rest
            for(i = 1; i < this.settings.length; i++) {
                this.settings[i].disabled = true;
            }
        }
        this.settings.each(function(element) {
            if(this.settings[this.settings.length - 1].id == element.id){
                Event.observe(element, 'change', this.lastOptionChanged.bind(this));
            } else {
                Event.observe(element, 'change', this.configure.bind(this));
            }
        }.bind(this));

        //var sp = $$('#ala-product-price-' + aeProductId);
        //if(sp[0]){
        //    sp[0].innerHTML = formatCurrency(config.sp, priceFormat);
        //}
        var pb = $$('div.price-box #product-price-' + aeProductId + ' span.price');
        if(pb[0] && pb[0].innerHTML) {
            this.displayPrice = pb[0].innerHTML;
        }
    },
    configure: function(event){

        if (jQuery("#myonoffswitch").attr("checked")) {
            var showAvailable = true;
        } else {
            var showAvailable = false;
        }

        var self = this;
        var element = Event.element(event);
        var params = {"pid": aeProductId, "options": [], "showAvailableProducts": showAvailable};
        var disable = false;
        this.settings.each(function(selector) {
            selector.disabled = disable;
            if(!disable) {
                params.options.push({"id": selector.id, "value": selector.options[selector.options.selectedIndex].value});
            }
            if(selector.id == element.id){
                disable = true;
            }

        }.bind(this));

        // clear specs table:
        var specs = $$('#product-attribute-specs-table td');
        specs.each(function (td) {
            td.innerHTML = "No";
        });
        // clear the price
        var p = $$('div.price-box #product-price-' + aeProductId + ' span.price');
        if(p[0] && p[0].innerHTML != formatCurrency(this.config.sp, priceFormat)){
            p[0].innerHTML = formatCurrency(this.config.sp, priceFormat);
        }

        new Ajax.Request(aeConfigUrl, {
            method: 'post',
            requestHeaders: {Accept: 'application/json'},
            postBody: Object.toJSON(params),
            onSuccess: function(transport) {
                var result = transport.responseText.evalJSON(true);
                self.updateSelectors(result);
            }
        });
    },

    updateSelectors: function(nextOptions) {
        var disable = false;
        this.settings.each(function(selector, idx) {
            selector.disabled = disable;
            if(disable || selector.id == 'attribute' + nextOptions.attributeid) {
                for(var i = selector.options.length; i > 1; i--) {
                    selector.remove(i-1);
                }
                // labels
                var alap = $$('div.price-box p.ala-price-label');
                var cp = $$('div.price-box p.configured-price-label');
                var sku = $$('div.extra-info');

                if(cp[0]) {
                    cp.first().style.display = 'none';
                }
                if(alap[0]){
                    alap.first().style.display = 'block';
                }
                if(sku[0]) {
                    sku.first().style.display = 'none';
                    sku.first().innerHTML = '';
                }
                // prices
                var oldPrice = $$('div.price-box p.old-price');
                var prodPrice = $$('div.price-box p.special-price');
                var configPrice = $$('div.price-box p.configured-price');
                if(oldPrice[0]){
                    oldPrice.first().style.display = 'inline-block';
                }
                if(prodPrice[0]){
                    prodPrice.first().style.display = 'inline-block';
                }
                if(configPrice[0]){
                    configPrice.first().style.display = 'none';
                }

            }
            if (selector.id == 'attribute' + nextOptions.attributeid) {
                for(var i = 0; i < nextOptions.options.length; ++i ) {
                    selector.options[i+1] = new Option(nextOptions.options[i]['val'], nextOptions.options[i]['id']);
                    if(typeof nextOptions.options[i].pid !== "undefined"){
                        selector.options[i+1].writeAttribute('data-pid', nextOptions.options[i].pid);
                    }
                    if(idx != 0 && i == 0){
                        // This line will cause the next option to default to the first item
                        //selector.options[i+1].writeAttribute('selected', 'selected');
                    }
                }
                disable = true;
                //if(idx != 0) {
                //    selector.options[1].selected = true;
                //}
            }
        }.bind(this));
    },

    lastOptionChanged: function(event) {
        var self = this;
        var element = Event.element(event);
        var params = [];
        params.push(
            {
                "pid": element.options[element.options.selectedIndex].readAttribute('data-pid'),
                "spid": aeProductId
            }
        );
        new Ajax.Request(aePriceUrl, {
            method: 'post',
            requestHeaders: {Accept: 'application/json'},
            postBody: Object.toJSON(params),
            onSuccess: function(transport) {
                var result = transport.responseText.evalJSON(true);
                self.updateAttributes(result);
                self.addSkuToRequestForm(result.sku);

                if (jQuery("#myonoffswitch").attr("checked")) {
                    var showAvailable = true;
                } else {
                    var showAvailable = false;
                }

                //if(!showAvailable) {
                //    jQuery('[data-id=atc-button]').hide();
                //    jQuery('#span_id').show();
                //} else {
                //    jQuery('[data-id=atc-button]').show();
                //    jQuery('#span_id').hide();
                //}
            }
        })
    },
    updateAttributes: function (res) {
        var p = $$( 'div.price-box #product-price-' + aeProductId + ' span.price');

        if(res.price && p[0] && p[0].innerHTML) {
            p[0].innerHTML = formatCurrency(res.price, priceFormat);
            //p[0].style.display = 'block';
        }

        // labels
        var alap = $$('div.price-box p.ala-price-label');
        var cp = $$('div.price-box p.configured-price-label');

        if(alap[0]){
            alap.first().style.display = 'none';
        }
        if(cp[0]) {
            cp.first().style.display = 'block';
        }

        //prices
        var oldPrice = $$('div.price-box p.old-price');
        var prodPrice = $$('div.price-box p.special-price');
        var configPrice = $$('div.price-box p.configured-price');
        if(oldPrice[0]){
            oldPrice.first().style.display = 'none';
        }
        if(prodPrice[0]){
            prodPrice.first().style.display = 'none';
        }
        if(configPrice[0]){
            configPrice.first().style.display = 'inline-block';
            configPrice.first().innerHTML = formatCurrency(res.price, priceFormat);
        }

        for(key in res.attribs) {
            var field = $$('*[data-attribute-id="' + key + '"]');
            if(field && field[0]){
                field.first().innerHTML = res.attribs[key];
            }
        }
        var atc = $$('button[data-id="atc-button"]');
        var raq = $$('button[data-id="raq-button"]');
        if(atc && atc[0] && raq && raq[0]) {
            if(parseFloat(res.weight) >= 5000){
                atc.first().style.display = 'none';
                raq.first().style.display = 'inline';
            } else {
                atc.first().style.display = 'inline';
                raq.first().style.display = 'none';
            }
        }
    },
    addSkuToRequestForm: function(sku) {
        this.sku = sku;

        var field = $$('input[name="field[28]"]');

        if(field && field[0]) {
            field.first().value = sku;
        } else {
            aeProductSku = sku;
        }

        var _sku = $$('div.extra-info');

        if (!(_sku[0]) || sku===null){
            _sku.first().style.display = 'none';
        } else {
            _sku.first().style.display = 'block';
            _sku.first().innerHTML = '<span class="sku-details-label">Model #' + sku + '</span>';
        }

    },
    requestQuote: function (button, location) {
        window.location.href = location + '?sku=' + this.sku;
    }
};