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
        //alert("configurating the product! ");

        this.settings = $$('.super-attribute-select');
        //alert('found selector: ' + selectors[0].id);
        this.settings.each(function(element) {
            if(this.settings[this.settings.length - 1].id == element.id){
                Event.observe(element, 'change', this.lastOptionChanged.bind(this));
            } else {
                Event.observe(element, 'change', this.configure.bind(this));
            }
        }.bind(this));

        // set first one:
        var attributeId = this.settings[0].id.replace(/[a-z]*/, '');
        for (i = 0; i < this.config['options'].length; i++) {
            var newOption = new Option(this.config.options[i]['val'], this.config.options[i]['id']);
            this.settings[0].options[i+1] = newOption;
        }

        // need to clean and disable subsequent values.
    },
    configure: function(event){

        /*
        * So. loop over the settings, create an ordered list of options and values
        * pack into an array. when the current element matches, switch to clearing and
        * disabling.
        */
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
        this.settings.each(function(selector) {
            selector.disabled = disable;
            if(disable || selector.id == 'attribute' + nextOptions.attributeid) {
                for(i = selector.options.length; i > 1; i--) {
                    selector.remove(i-1);
                }
            }
            if (selector.id == 'attribute' + nextOptions.attributeid) {
                for(i=0; i<nextOptions.options.length; ++i ) {
                    selector.options[i+1] = new Option(nextOptions.options[i]['val'], nextOptions.options[i]['id']);
                    if(typeof nextOptions.options[i].pid !== "undefined"){
                        selector.options[i+1].dataset.pid =  nextOptions.options[i].pid;
                    }
                }
                disable = true;
            }
        }.bind(this));
    },

    lastOptionChanged: function(event) {
        var self = this;
        var element = Event.element(event);
        var params = [];
        params.push(
            {
                "pid": element.options[element.options.selectedIndex].dataset.pid,
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
            }
        })
    },
    updateAttributes: function (res) {
        var p = $$('#product-price-' + aeProductId + ' > span.price');
        p[0].innerHTML = formatCurrency(res.price, priceFormat);
        for(key in res.attribs) {
            $$('*[data-attribute-id="' + key + '"]').first().innerHTML = res.attribs[key];
        }
        if(parseFloat(res.weight) >= 5000){
            $$('button[data-id="atc-button"]').first().style.display = 'none';
            $$('button[data-id="raq-button"]').first().style.display = 'inline';
        } else {
            $$('button[data-id="atc-button"]').first().style.display = 'inline';
            $$('button[data-id="raq-button"]').first().style.display = 'none';
        }
    },
    requestQuote: function (button) {
        alert('requesting quote!');
    }
};

/*
{
    "id": "174",
    "code": "style",
    "options": [
    {
        "id": "12",
        "val": "Barn",
        "pos": 0
    },
    {
        "id": "14",
        "val": "Peak",
        "pos": 1
    }
]
}
*/