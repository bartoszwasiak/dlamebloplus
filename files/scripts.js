$(document).ready(function(){
	$('.err').click(function(){
		$(this).fadeOut(300);
	});
	$('.succ').click(function(){
		$(this).fadeOut(300);
	});

	$("a[id^='star_']").mouseover(function(){
		
		$str = $(this).prop("id");
		$num = parseInt($str.replace("star_", ""));
		
		console.log($num);
		for($i=1; $i<6; $i++){
			if($i<=$num){
				$('#star_' + $i).css("color", "gold");
			}
			else{
				$('#star_' + $i).css("color", "#ddd");
			}
		}

	});
	$("a[id^='star_']").mouseout(function(){
		$num = parseInt($('.hidden-rate').prop('id'));;
		
		console.log($num);
		for($i=1; $i<6; $i++){
			if($i<=$num){
				$('#star_' + $i).css("color", "gold");
			}
			else{
				$('#star_' + $i).css("color", "#ddd");
			}
		}

	});

});