$(document).ready(function() {

$(".form-popup").submit(function(event) {
		$.ajax({
			type        : 'POST',
			url         : 'send.php',
			data        : $( this ).serialize(),
			success     : function(data)
			{
				console.log('test');
				$('.input_text').val('');
				parent.jQuery.fancybox.getInstance().close();	
				$.fancybox.open({
					src: '#thanks', 
				});
				//console.log(data);
				//yaCounter49242592.reachGoal('goal-popup');		

			}
		});	
		event.preventDefault();
	});

});
