jQuery(document).ready(function () {

    jQuery('.search-location').on('input', function () {
        jQuery('.search-location').autocomplete({
            source: function (request, response) {
                const keyword = jQuery('.search-location').val();
                jQuery.ajax({
                    url: "/ajax/locality",
                    type: "GET",
                    data: {"keyword": keyword},
                    success: function (data) {
                        var autocomplete = {};
                        if (data !== 'null') {
                            selected = false;
                            let autocompleteString = '';
                            const jsonData = jQuery.parseJSON(data);
                            jQuery.each(jsonData, function (arKey, arValue) {
                                autocompleteString = arValue.loctitle + ' ' + arValue.loctype + ' ';

                                if(arValue.title !== null)
                                    autocompleteString = autocompleteString + arValue.title + ' ';
                                if(arValue.type !== null)
                                    autocompleteString = autocompleteString + arValue.type;

                                autocomplete[arValue.id] = autocompleteString;
                            });
                            response(autocomplete);
                        } else {
                            console.log('source ajax error');
                        }
                    }
                });
            }, select: function (event, ui) {
                console.log(event);
                console.log(ui);
                // jQuery("ul.ui-autocomplete").hide();
                // if (ui.item.label) {
                //     const label = ui.item.label.split(';');
                //     if (label.length == 6) {
                //         userUSAddress = {
                //             city: label[2],
                //             country: 'US',
                //             state: label[3],
                //             street_number: label[0],
                //             zipCode: label[4],
                //             subpremise: label[1]
                //         };
                //         jQuery("#new-form-address").val(ui.item.label.replace(/;/g, ' '));
                //         return false;
                //     } else {
                //         selected = true;
                //         setTimeout(function () {
                //             const entries = label[5].split(' ');
                //             jQuery('#new-form-address').autocomplete('search', label[0] + ' ' + label[1] + ' ' + entries[0] + ') ' + label[2] + ' ' + label[3] + ' ' + label[4]);
                //         }, 0);
                //         jQuery("#new-form-address").val(ui.item.label.replace(/;/g, ' '));
                //         return false;
                //     }
                // }
            }, minLength: 3,
            close: function () {
                if (!jQuery("ul.ui-autocomplete").is(":visible")) {
                    jQuery("ul.ui-autocomplete").show();
                }
            },
            // search: function (event, ui) {
            //     jQuery("ul.ui-autocomplete").hide();
            //     jQuery(".no-match").hide();
            //     jQuery('.address-loader').show();
            // },
            // response: function (ul, item) {
            //     jQuery('.address-loader').hide();
            //     jQuery(this).data('ui-autocomplete')._renderItem = function (ul, item) {
            //         return jQuery("<li class='autocomplete-address-li'>").append("<div data-address='" + item.label + "'>" + item.label.replace(/;/g, ' ') + "</div>")
            //             .appendTo(ul);
            //     };
            //
            //     jQuery("ul.ui-autocomplete").show();
            // }
        });
        jQuery("#new-form-address").autocomplete("enable");
    });

    console.log('wroking');
});