$( "#productCreationForm" ).submit(function( event ) {
	event.preventDefault();
	var inputs = $('#productCreationForm :input');
	message= "";
	valid = true;
	inputs.each(function() {
		var $this = $(this);
		
		if(!$this.val()) {
			var inputName = $this.attr('name');
			valid = false;
			message += 'Please enter your ' + inputName + '<br>';
		}
	});
	if(!valid) {
		innerhtml  = '<div class="alert alert-danger alert-dismissable fade in">';
		innerhtml +=		'<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
		innerhtml +=		'<strong>Please correct the following information!</strong><br>';
		innerhtml +=		message;
		innerhtml += '</div>';
		$("#message").html(innerhtml);
		$('html, body').animate({ scrollTop: $('#message').offset().top }, 'slow');
		return false;
	}
	
	var formData = new FormData(this);
	$.ajax({
		url: "../API/api.php",
		type: 'POST',
		data: formData,
		success: function (data) {
			//data = JSON.parse(data);
			if(data.status=='ok'){
				innerhtml  = '<div class="alert alert-success alert-dismissable fade in">';
				innerhtml +=		'<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
				innerhtml +=		'<strong>Success!</strong><br>';
				innerhtml +=		data.message;
				innerhtml += '</div>';
				$("#message").html(innerhtml);
			}else{
				innerhtml  = '<div class="alert alert-danger alert-dismissable fade in">';
				innerhtml +=		'<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
				innerhtml +=		'<strong>Please correct the following information!</strong><br>';
				innerhtml +=		data.message;
				innerhtml += '</div>';
				$("#message").html(innerhtml);
			}
			$('html, body').animate({ scrollTop: $('#message').offset().top }, 'slow');
		},
		cache: false,
		contentType: false,
		processData: false
	});
});