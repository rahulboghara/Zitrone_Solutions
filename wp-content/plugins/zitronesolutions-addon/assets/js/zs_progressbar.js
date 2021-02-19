jQuery(document).ready(function() {
  "use strict";
	var el = jQuery(".zs_progress_bar");
	jQuery(el).each(function() {
		jQuery(this).appear(function() {
			var percent = ( jQuery(this).find(".zs_progressbarfill").attr("data-value") / 100 );
			var filltime = parseInt(jQuery(this).find(".zs_progressbarfill").attr("data-time"));
			var add_width = (percent*jQuery(this).find(".zs_progressbarfill").parent().width())+'px';
			jQuery(this).find(".zs_progressbarfill").animate({
				width: add_width
			}, { duration: filltime, queue: false });
		});
	});
});
