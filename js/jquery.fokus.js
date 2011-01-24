var $j = jQuery.noConflict();

(function ($) {
	$('body').addClass('js');

	$("#s").textPlaceholder();

	$('.secondary-menu').find('.widget-container > .widget-title').click(function () {
		$(this).parents('.widget-container').eq(0)
			.toggleClass('toggled')
			.siblings().removeClass('toggled');
	});
}($j));
