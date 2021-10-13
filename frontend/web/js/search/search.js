jQuery(document).ready(function () {
    const defaultMaxPrice = jQuery('.search-max-price').val();
    let maxPrice = defaultMaxPrice;
    let minPrice = 0;

    getMaxPrice();

    jQuery('.search-roll-down').click(function (e) {
        const id = e.target.id;
        jQuery('.search-roll-down-' + id).hide();
        jQuery('.description-' + id).show();
        jQuery('.search-roll-up-' + id).show();
    });

    jQuery('.search-roll-up').click(function (e) {
        const id = e.target.id;
        jQuery('.search-roll-down-' + id).show();
        jQuery('.description-' + id).hide();
        jQuery('.search-roll-up-' + id).hide();
    });


    //search logic
    jQuery('.cart-list-checkbox').click(function (e) {
        listCheckboxClick('cartlist', e.target.id);
    });

    jQuery('.type-list-checkbox').click(function (e) {
        listCheckboxClick('typelist', e.target.id);
    });

    function listCheckboxClick(paramName, selectedId) {
        let url = window.location.href;
        let cartListUrl = getUrlParameter(paramName);
        let replaceString = '';
        let replaceUndefinedString = '';

        if (typeof cartListUrl !== 'undefined')
            cartListUrl = cartListUrl.replace('%2C', ',');

        selectedId = selectedId.split("-")[1];

        if (paramName === 'cartlist') {
            replaceString = /(cartlist=)[^&]+/ig;
            replaceUndefinedString = /(cartlist=)/;
        }
        if (paramName === 'typelist') {
            replaceString = /(typelist=)[^&]+/ig;
            replaceUndefinedString = /(typelist=)/;
        }

        if (typeof cartListUrl === 'undefined') {
            url = url + '&' + paramName + '=' + selectedId;
        } else if (cartListUrl.length === 0) {
            url = url.replace(replaceUndefinedString, '$1' + selectedId);
        } else {
            const cartListArray = cartListUrl.split(',');
            if (jQuery.inArray(selectedId, cartListArray) === -1) {
                cartListUrl = cartListUrl + ',' + selectedId;
                url = url.replace(replaceString, '$1' + cartListUrl);
            } else {
                const newCartListArray = jQuery.grep(cartListArray, function (value) {
                    return value !== selectedId;
                });
                const newCartList = newCartListArray.join(",");
                url = url.replace(replaceString, '$1' + newCartList);
            }
        }

        window.location.href = url;
    }

    function priceUrl(params, price) {
        let url = window.location.href;
        const cartListUrl = getUrlParameter(params);
        const priceListUrl = price.join(",");

        if (typeof cartListUrl === 'undefined') {
            url = url + '&' + params + '=' + priceListUrl;
        } else if (cartListUrl.length === 0) {
            url = url.replace(/(price=)/, '$1' + priceListUrl);
        } else {
            url = url.replace(/(price=)[^&]+/ig, '$1' + priceListUrl);
        }

        window.location.href = url;
    }

    function getUrlParameter(sParam) {
        const sPageURL = window.location.search.substring(1);
        const sURLVariables = sPageURL.split('&');

        for (var i = 0; i < sURLVariables.length; i++) {
            let sParameterName = sURLVariables[i].split('=');
            if (sParameterName[0] == sParam) return sParameterName[1];
        }
    }

    jQuery('#slider-container-search-price').slider({
        range: true,
        min: 0,
        max: defaultMaxPrice,
        values: [minPrice, maxPrice],
        create: function () {
            jQuery("#from").text(minPrice);
            jQuery("#to").text(maxPrice);
        },
        slide: function (event, ui) {
            jQuery("#from").text(ui.values[0]);
            jQuery("#to").text(ui.values[1]);
            var mi = ui.values[0];
            var mx = ui.values[1];
            filterSystem(mi, mx);
        },
        change: function (event, ui) {
            priceUrl('price', ui.values);
        }
    });

    function filterSystem(minPrice, maxPrice) {
        var price = parseInt($(this).data("price"), 10);
        return price >= minPrice && price <= maxPrice;
    }

    function getMaxPrice() {
        let priceListUrl = getUrlParameter('price');

        if (typeof priceListUrl !== 'undefined') {
            priceListUrl = priceListUrl.replace('%2C', ',');
            const priceListArray = priceListUrl.split(',');

            if (priceListArray.length === 2) {
                minPrice = parseInt(priceListArray[0]);
                maxPrice = parseInt(priceListArray[1]);

                if ((minPrice > 0 && minPrice < maxPrice && minPrice < 1000000) && (maxPrice > 0 && maxPrice > minPrice && maxPrice < 1000000)) {
                    minPrice = priceListArray[0];
                    maxPrice = priceListArray[1];
                } else {
                    minPrice = 0;
                    maxPrice = defaultMaxPrice;
                }
            }
        }
    }
});