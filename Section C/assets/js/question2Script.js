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
/*
 * Food Item Submition Form
 */
$( "#foodCreationForm" ).submit(function( event ) {
	event.preventDefault();
	/* you can write validation logic here*/
	alert("Form Submit is clicked");
});
$(document).ready(function() {
   // $('#example').DataTable();
	/*
	 * First Approach
	 */
	/* 
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
			 { "data": "categoryName" },
			 { "data": "description" },
			 { "data": "createdDate" },
		]
	});
	*/
	/*
	 * Second Approach
	 */
	 $.ajax({
		url:'api.php',
		type: 'GET',
		data:{method:"getFoodItems"},
		success: function (data) {
			if(data.status=='ok'){
				for (var key in data.data) {
					html ="<tr>";
					html +=		'<td><img width="80px" src="'+data.data[key]['imageUrl']+'"/></td>';
					html +=		'<td>'+data.data[key]['name']+'</td>';
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
	
});