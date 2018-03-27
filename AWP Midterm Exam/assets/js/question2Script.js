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
  $('#name').val('');
  $('#foodImage').val('');
  $('#food_cat').val('0');
  $('#description').val('');
  $('#message').html('');
});
/*
 * Food Item Submition Form
 */
$( "#foodCreationForm" ).submit(function( event ) {
	event.preventDefault();

	var allvalid=true;
	if($('#name').val()=='')
	{
		
		$('#message').html('<div class="alert alert-danger alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Please correct the following information!!</strong><br>Please Enter Name.</div>');
		allvalid=false;
	}
	else if(!(/^[a-zA-Z()]+$/.test($('#name').val())))
	{
		$('#message').html('<div class="alert alert-danger alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Please correct the following information!!</strong><br>Name can not contain any special character or number.</div>');
		allvalid=false;
	}
	else if($('#foodImage').val()=='')
	{
		$('#message').html('<div class="alert alert-danger alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Please correct the following information!!</strong><br>Please Select Food Image.</div>');
		
		allvalid=false;
	}
	else if($('#food_cat').val()=='0')
	{
		$('#message').html('<div class="alert alert-danger alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Please correct the following information!!</strong><br>Please Select Food Category.</div>');
		allvalid=false;
	}
	else if($('#description').val()=='')
	{
		$('#message').html('<div class="alert alert-danger alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Please correct the following information!!</strong><br>Please Enter Food Description.</div>');
		allvalid=false;
	}
	else
	{
		$('#message').html('<div class="alert alert-success alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Success!</strong><br>All Valid.</div>');
	}
});
$(document).ready(function() {
    //$('#example').DataTable();
	/*
	 * First Approach
	 */
	 
	$('#example').DataTable({
		ajax: {
			url:'API/api.php',
			method:'GET',
			data:{method:'getFoodItems'},
			dataSrc: 'data'
		},
		columns: [
			 { 
			   "data": "imageUrl",
				"render" : function ( url, type, full) {
					return '<img width="80px" src="'+url+'"/>';
				}
			 },
			 { "data": "name" },
			 { "data": "category_name" },
			 { "data": "description" },
			 { "data": "createdDate" },
		],
		initComplete: function () {
            this.api().columns().every( function () {
                var column = this;
                var select = $('<select><option value=""></option></select>')
                    .appendTo( $(column.header()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        }
	});
	
	/*
	 * Second Approach
	 */
	 /*$.ajax({
		url:'API/api.php',
		type: 'GET',
		data:{method:"getFoodItems"},
		success: function (data) {
			if(data.status=='ok'){
				for (var key in data.data) {
					html ="<tr>";
					html +=		'<td><img width="80px" src="'+data.data[key]['imageUrl']+'"/></td>';
					html +=		'<td>name'+data.data[key]['name']+'</td>';
					html +=		'<td>'+data.data[key]['categoryName']+'</td>';
					html +=		'<td>'+data.data[key]['description']+'</td>';
					html +=		'<td>'+data.data[key]['createdDate']+'</td>';
					html +="</tr>";
					$("#bodyFoodItem").append(html);
				}
				$('#example').DataTable();
			}
		},
		cache: false,
		contentType: false,
	});
	*/
});