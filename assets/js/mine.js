window.onload = function(){

	$(".content-help").mouseleave(function(){
		$(".content-help").hide(500);
	});

	$(".help").mouseover(function(){
		$(this).find('.content-help').show(500);
	});

}