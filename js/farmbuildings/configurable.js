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
            }
        }
        this.settings.each(function(element) {
            if(this.settings[this.settings.length - 1].id == element.id){
                Event.observe(element, 'change', this.lastOptionChanged.bind(this));
            } else {
                Event.observe(element, 'change', this.configure.bind(this));
            }
        }.bind(this));
    },
    configure: function(event){

        var self = this;
        var element = Event.element(event);
        var params = {"pid": aeProductId, "options": []};
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
        var p = $$('#product-price-' + aeProductId + ' > span.price');
        if(p[0].innerHTML != formatCurrency(0.0, priceFormat)){
            p[0].innerHTML = formatCurrency(0.0, priceFormat);
        }

        new Ajax.Request('/fbconfig/index', {
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
        new Ajax.Request('/fbconfig/index/product', {
            method: 'post',
            requestHeaders: {Accept: 'application/json'},
            postBody: Object.toJSON(params),
            onSuccess: function(transport) {
                var result = transport.responseText.evalJSON(true);
                self.updateAttributes(result);
                self.addSkuToRequestForm(result.sku);
            }
        })
    },
    updateAttributes: function (res) {
        var p = $$('#product-price-' + aeProductId + ' > span.price');
        p[0].innerHTML = formatCurrency(res.price, priceFormat);
        for(key in res.attribs) {
            $$('*[data-attribute-id="' + key + '"]').first().innerHTML = res.attribs[key];
        }
        if((parseFloat(res.weight) + parseFloat(aeCurrentCartWeight)) >= 5000){
            $$('button[data-id="atc-button"]').first().style.display = 'none';
            $$('button[data-id="raq-button"]').first().style.display = 'inline';
        } else {
            $$('button[data-id="atc-button"]').first().style.display = 'inline';
            $$('button[data-id="raq-button"]').first().style.display = 'none';
        }
    },
    addSkuToRequestForm: function(sku) {
        $$('input[name="field[28]"]').first().value = sku;
    },
    requestQuote: function (button) {
        //alert('requesting quote!');
    }
};
