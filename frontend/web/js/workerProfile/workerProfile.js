jQuery(document).ready(function () {
    jQuery('.worker-roll-down').click(function(e) {
        const id = e.target.id;
        jQuery('.worker-roll-down-' + id).hide();
        jQuery('.description-'+ id).show();
        jQuery('.worker-roll-up-' + id).show();
    });

    jQuery('.worker-roll-up').click(function(e) {
        const id = e.target.id;
        jQuery('.worker-roll-down-' + id).show();
        jQuery('.description-'+ id).hide();
        jQuery('.worker-roll-up-' + id).hide();
    });

    jQuery('.vacancies-info-search-roll-down').click(function(e) {
        const id = e.target.id;
        jQuery('.vacancies-info-search-roll-down-' + id).hide();
        jQuery('.description-'+ id).show();
        jQuery('.vacancies-info-search-roll-up-' + id).show();
    });

    jQuery('.vacancies-info-search-roll-up').click(function(e) {
        const id = e.target.id;
        jQuery('.vacancies-info-search-roll-down-' + id).show();
        jQuery('.description-'+ id).hide();
        jQuery('.vacancies-info-search-roll-up-' + id).hide();
    });
});