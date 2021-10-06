jQuery(document).ready(function () {
   jQuery('.employer-roll-down').click(function(e) {
      const id = e.target.id;
      jQuery('.employer-roll-down-' + id).hide();
      jQuery('.description-'+ id).show();
      jQuery('.employer-roll-up-' + id).show();
   });

   jQuery('.employer-roll-up').click(function(e) {
      const id = e.target.id;
      jQuery('.employer-roll-down-' + id).show();
      jQuery('.description-'+ id).hide();
      jQuery('.employer-roll-up-' + id).hide();
   });
});