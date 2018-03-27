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
 	$('#title').val('');
 	$('#ArticleImage').val('');
 	$('#article_category').val('0');
 	$('#details').val('');
 	$('#message').html('');

 });
/*
 * Article Item Submition Form
 */
 $( "#ArticleCreationForm" ).submit(function( event ) {
 	event.preventDefault();
 	if($('#title').val()=='')
 	{

 		$('#message').html('<div class="alert alert-danger alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Please correct the following information!!</strong><br>Please Enter Name.</div>');
 		
 	}
 	else if(!(/^[a-zA-Z()]+$/.test($('#title').val())))
 	{
 		$('#message').html('<div class="alert alert-danger alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Please correct the following information!!</strong><br>Name can not contain any special character or number.</div>');
 		
 	}
 	else if($('#ArticleImage').val()=='')
 	{
 		$('#message').html('<div class="alert alert-danger alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Please correct the following information!!</strong><br>Please Select Article Image.</div>');

 		
 	}
 	else if($('#article_category').val()=='0')
 	{
 		$('#message').html('<div class="alert alert-danger alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Please correct the following information!!</strong><br>Please Select Article Category.</div>');
 		
 	}
 	else if($('#details').val()=='')
 	{
 		$('#message').html('<div class="alert alert-danger alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Please correct the following information!!</strong><br>Please Enter Article Description.</div>');
 		allvalid=false;
 	}
 	else
 	{
 		var formData = new FormData(this);



 		$.ajax({
 			url: "API/api.php",
 			type: 'POST',
 			data: formData,
 			success: function (data) {
 				$('#message').html('<div class="alert alert-success alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Success!</strong><br>'+data.message+'</div>');

 				$('#example').DataTable().ajax.reload();

 			},
 			cache: false,
 			contentType: false,
 			processData: false
 		});

 	}
 });
 $(document).ready(function() {
   // $('#example').DataTable();
	/*
	 * First Approach
	 */
	 
	 $('#example').DataTable({
	 	ajax: {
	 		url:'API/api.php',
	 		method:'GET',
	 		data:{method:'getArticleItems'},
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
	 	{ "data": "description" },
	 	{ "data": "category_name" },
	 	{
	 		mRender: function (data, type, row) {
	 			return '<div class="btn-group"><a data-id='+row.id+'   class="btn btn-primary up" title="EDIT"><span class="glyphicon glyphicon-edit"></span></a><a class="btn btn-danger del"  data-id='+row.id+' title="DELETE" ><span class="glyphicon glyphicon-trash"></span></a></div>';
	 		}}
	 		]
	 	});

	/*
	 * Second Approach
	 */
	 /*$.ajax({
		url:'API/api.php',
		type: 'GET',
		data:{method:"getArticleItems"},
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
					$("#bodyArticleItem").append(html);
				}
				$('#example').DataTable();
			}
		},
		cache: false,
		contentType: false,
	});
	*/
});
 $("#example tbody").on('click', '.del', function() {
 	var r = confirm("Do you want to Delete record?");
 	if (r == true) {
 		var ids=$(this).data('id');
 	//alert(ids);
 	$.ajax({
 		url: 'API/api.php',
 		type: 'POST',
 		data: {id: ids,method:'deleteArticle'},
 	})
 	.done(function(data) {
 		console.log(data);
 		$('#message2').html('<div class="alert alert-success alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Success!</strong><br>'+data.message+'</div>');
 		$('#example').DataTable().ajax.reload();	
 	})
 	.fail(function() {
 		console.log("error");

 	});
 }
});
 $("#example tbody").on('click', '.up', function() {

 	var ids=$(this).data('id');
 	//alert(ids);
 	
 	$.ajax({
 		url: 'API/api.php',
 		type: 'GET',
 		data: {id: ids,method:'getArticleItem'},
 	})
 	.done(function(data) {
 		console.log(data);
 		
 		// alert("asas");
 		$('#ids').val(data.id);
 		$('#titles').val(data.name);
 		$('#detailss').val(data.description);
 		$('#imageUrl').val(data.imageUrl);
 		$("#image").attr("src",data.imageUrl);
 		$('#article_categorys').val(data.category_id);
 		$('#myModal').modal('show');

 	})
 	.fail(function() {
 		console.log("error");

 	});
 });


 $( "#ArticleupdateForm" ).submit(function( event ) {
 	event.preventDefault();
 	if($('#titles').val()=='')
 	{

 		$('#messages').html('<div class="alert alert-danger alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Please correct the following information!!</strong><br>Please Enter Name.</div>');
 		
 	}
 	else if(!(/^[a-zA-Z()]+$/.test($('#titles').val())))
 	{
 		$('#message').html('<div class="alert alert-danger alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Please correct the following information!!</strong><br>Name can not contain any special character or number.</div>');
 		
 	}
 	else if($('#ArticleImages').val()==''&& $('#imageUrl').val()=='')
 	{
 		$('#message').html('<div class="alert alert-danger alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Please correct the following information!!</strong><br>Please Select Article Image.</div>');

 		
 	}
 	else if($('#article_categorys').val()=='0')
 	{
 		$('#message').html('<div class="alert alert-danger alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Please correct the following information!!</strong><br>Please Select Article Category.</div>');
 		
 	}
 	else if($('#detailss').val()=='')
 	{
 		$('#message').html('<div class="alert alert-danger alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Please correct the following information!!</strong><br>Please Enter Article Description.</div>');
 		
 	}
 	else
 	{
 		var formData = new FormData(this);



 		$.ajax({
 			url: "API/api.php",
 			type: 'POST',
 			data: formData,
 			success: function (data) {
 				$('#myModal').modal('hide');
 				$('#ids').val('');
 				$('#titles').val('');
 				$('#detailss').val('');
 				$('#imageUrl').val('');
 				$("#image").attr("src",'');
 				$('#article_categorys').val('');
 				$('#ArticleImages').val('');
 				$('#message2').html('<div class="alert alert-success alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Success!</strong><br>'+data.message+'</div>');

 				$('#example').DataTable().ajax.reload();

 			},
 			cache: false,
 			contentType: false,
 			processData: false
 		});

 	}
 });