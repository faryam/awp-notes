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

console.log("Hello");
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
	$('#example').DataTable({
		ajax: {
			url:'API/api.php',
			method:'GET',
			data:{method:'getProducts'},
			dataSrc: 'data'
		},
		columns: [
			 { "data": "name" },
			 { "data": "description" },
			 { "data": "id" },
			 { "data": "category_name" },
			 { "data": null,
				"className": "text-center",
				"defaultContent": '<a href="#" class="btn btn-primary a-btn-slide-text btn-xs"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a><a href="#" class="btn btn-danger a-btn-slide-text btn-xs" style="margin-left:5px"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>'
			 }
		
		]
	});
});