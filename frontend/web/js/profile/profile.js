jQuery(document).ready(function () {
    jQuery('.profile-roll-down').click(function(e) {
        const id = e.target.id;
        jQuery('.profile-roll-down-' + id).hide();
        jQuery('.description-'+ id).show();
        jQuery('.profile-roll-up-' + id).show();
    });

    jQuery('.profile-roll-up').click(function(e) {
        const id = e.target.id;
        jQuery('.profile-roll-down-' + id).show();
        jQuery('.description-'+ id).hide();
        jQuery('.profile-roll-up-' + id).hide();
    });
});