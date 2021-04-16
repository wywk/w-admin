$(function () {
	var scr_top = 0;
	$('input').on('click',function () {
		scr_top = $(window).scrollTop()
	});
	$('input').blur(function () {
		setTimeout(function () {
			$(window).scrollTop(scr_top)
		},10)
	})
});