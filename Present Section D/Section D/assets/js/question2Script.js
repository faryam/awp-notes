/*
 * Menu-toggle
 */
$("#menu-toggle").click(function(e) {
    e.preventDefault();
    $("#wrapper").toggleClass("active");
});
/*
 * Reset Button
 */
$( "#resetBtn" ).on( "click", function() {
  /* you can write reset logic here*/
  alert("Form Reset is clicked");
});
function fun(as)
{
	alert(as);
}
$(document).ready(function() {
    
	
	$.ajax({
		url:'API/api.php',
		type: 'GET',
		data:{method:"readProducts"},
		success: function (data) {
			if(data.status=='ok'){
				for (var key in data.data) {
					html ="<tr>";
					html +=		'<td><img width="80px" src="'+data.data[key]['imageUrl']+'"/></td>';
					html +=		'<td>'+data.data[key]['title']+'</td>';
					html +=		'<td>'+data.data[key]['category_name']+'</td>';
					html +=		'<td>'+data.data[key]['detail']+'</td>';
					
					 html += "<td><a href='#' class='btn btn-primary a-btn-slide-text btn-xs'><span class='glyphicon glyphicon-edit' aria-hidden='true'></span></a><a onclick=fun('"+ data.data[key]['id']+"'); class='btn btn-danger a-btn-slide-text btn-xs' style='margin-left:5px'><span class='glyphicon glyphicon-remove' aria-hidden='true'></span></a></td>";
					html +="</tr>";
					$("#bodyProduct").append(html);
				}
				$('#example').DataTable();
			}
		},
		cache: false,
		contentType: false,
	});
	
});


$( "#ArticleCreationForm" ).submit(function( event ) {
	
	event.preventDefault();
	/* you can write validation logic here*/
	
	var inputs = $('#ArticleCreationForm :input');
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
		url: "API/api.php",
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
	
	
	alert("Form Submit is clicked");
});

