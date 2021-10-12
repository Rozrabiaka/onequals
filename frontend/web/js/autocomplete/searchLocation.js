jQuery(document).ready(function () {

    jQuery('.search-location').on('input', function () {
        if (jQuery('.search-location').val().length === 0) jQuery('.country-js-hidden-id').val('');
        jQuery('.search-location').autocomplete({
            appendTo: '.search-input',
            open: function () {
                jQuery('#div .ui-menu').width(300)
            },
            source: function (request, response) {
                const keyword = jQuery('.search-location').val();
                jQuery.ajax({
                    url: "/ajax/locality",
                    type: "GET",
                    data: {"keyword": keyword},
                    success: function (data) {
                        var autocomplete = {};
                        let obj = {};

                        if (data !== 'null') {
                            selected = false;
                            let autocompleteString = '';
                            const jsonData = jQuery.parseJSON(data);
                            jQuery.each(jsonData, function (arKey, arValue) {
                                autocompleteString = arValue.loctitle + ' ' + arValue.loctype + ' ';

                                if (arValue.title !== null)
                                    autocompleteString = autocompleteString + arValue.title + ' ';
                                if (arValue.type !== null)
                                    autocompleteString = autocompleteString + arValue.type;

                                obj = {
                                    'id': arValue.id,
                                    'value': autocompleteString,
                                    'label': autocompleteString
                                }

                                autocomplete[arValue.id] = obj;
                            });


                            response(autocomplete);
                        } else {
                            console.log('source ajax error');
                        }
                    }
                });
            }, select: function (event, ui) {
                jQuery("ul.ui-autocomplete").hide();
                if (ui.item.id) {
                    jQuery('.country-js-hidden-id').val(ui.item.id);
                }
            }, minLength: 3,
            close: function () {
                if (!jQuery("ul.ui-autocomplete").is(":visible")) {
                    jQuery("ul.ui-autocomplete").show();
                }
            },
        });
        jQuery("#new-form-address").autocomplete("enable");
    });

    console.log('wroking');
});