$(function(){

	var current_effect = $('#waitMe_ex_effect').val();

	$('#waitMe_ex').click(function(){
		run_waitMe(current_effect);
	});
	$('#waitMe_ex_close').click(function(){
		$('.containerBlock > form').waitMe('hide');
	});

	$('#waitMe_ex_effect').change(function(){
		current_effect = $(this).val();
		run_waitMe(current_effect);
	});
	
	$('#waitMe_ex_effect').click(function(){
		current_effect = $(this).val();
	});
	
	function run_waitMe(effect){
		$('.containerBlock > form').waitMe({
			effect: effect,
			text: 'Please wait...',
			bg: 'rgba(255,255,255,0.7)',
			color:'#000',
			sizeW:'',
			sizeH:'',
			source: 'img.svg'
		});
	}
	
	
	var current_body_effect = 'facebook'; //$('#waitMe_ex_body_effect').val();
	
	$('#waitMe_ex_body').click(function(){
		run_waitMe_body(current_body_effect);
	});
	
	$('#waitMe_ex_body_effect').change(function(){
		current_body_effect = $(this).val();
		run_waitMe_body(current_body_effect);
	});
	
	function run_waitMe_body(effect){
		$('body').addClass('waitMe_body');
		var img = '';
		var text = '';
		if(effect == 'img'){
			img = 'background:url(\'img.svg\')';
		} else if(effect == 'text'){
			text = 'Loading...'; 
		}
		var elem = $('<div class="waitMe_container ' + effect + '"><div style="' + img + '">' + text + '</div></div>');
		$('body').prepend(elem);
		
		setTimeout(function(){
			$('body.waitMe_body').addClass('hideMe');
			setTimeout(function(){
				$('body.waitMe_body').find('.waitMe_container:not([data-waitme_id])').remove();
				$('body.waitMe_body').removeClass('waitMe_body hideMe');
			},200);
		},4000);
	}
	
});