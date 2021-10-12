jQuery(document).ready(function () {
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
                console.log(cartListUrl);
                url = url.replace(replaceString, '$1' + cartListUrl);
            } else {
                const newCartListArray = jQuery.grep(cartListArray, function (value) {
                    return value !== selectedId;
                });
                const newCartList = newCartListArray.join(",");
                console.log(newCartList);
                url = url.replace(replaceString, '$1' + newCartList);
            }
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
});