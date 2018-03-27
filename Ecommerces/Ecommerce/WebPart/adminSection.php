<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Bootstrap Collapsible Left Sidebar</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css"><link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/admin.css">
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>

<body>
	<div class="container-fluid">
		<div class="row" id="row-header">
			<nav class="navbar navbar-inverse">
				<div class="container-fluid">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>                        
						</button>
						<a class="navbar-brand" href="#">Ecommerce Admin Section</a>
						<button type="button" class="toggle-sidebar btn btn-default" aria-label="Justify" style="margin-top: 8px;"><span class="glyphicon glyphicon-align-justify" aria-hidden="true"></span>
						</button>
					</div>
					<div class="collapse navbar-collapse" id="myNavbar">
						<ul class="nav navbar-nav navbar-right">
							<li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
							<li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
						</ul>
					</div>
				</div>
			</nav>
		</div>
		<div class="row" id="row-main" style="margin-top: -20px;">
			<div class="col-md-3" id="sidebar" style="padding: 0px;">
				<ul class="sidebar-nav nav">
					<li class="sidebar-brand">
						<a href="#home"><span class="fa fa-home solo">Product</span></a>
					</li>
				</ul>
			</div>
			<div class="col-md-9" id="content">
				<div class="panel panel-default">
					<div id="message"></div>
					<div class="panel-heading">
						<h4 class="text-center">Products</h4>
					</div>
					<div class="panel-body">
						<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>Name</th>
									<th>Description</th>
									<th>Price</th>
									<th>Category</th>
									<th>Action</th>
								</tr>
							</thead>
							<tfoot>
								<tr>
									<th>Name</th>
									<th>Description</th>
									<th>Price</th>
									<th>Category</th>
									<th>Action</th>
								</tr>
								
							</tfoot>
							<tbody>
								
							</tbody>
						</table>
					</div>
				</div>	
				
			</div>
		</div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
	
	<script>
		$(document).ready(function() {
			$('#example').DataTable({
						ajax: {
							url:'../../ProductsApi/views/product/readProducts.php',
							method:'GET',
							data:{method:'getProducts'},
							dataSrc: 'records'
						},
						columns: [
						{ "data": "name" },
						{ "data": "description" },
						{ "data": "price" },
						{ "data": "category_name" },
						{
							mRender: function (data, type, row) {
								return '<div class="btn-group"><a data-id='+row.id+' class="btn btn-primary up" title="EDIT" href="http://localhost/Ecommerces/ProductsApi/views/product/readOneProduct.php?id='+row.id+'"><span class="glyphicon glyphicon-edit"></span></a><a class="btn btn-danger del"  data-id='+row.id+' title="DELETE" href="#"><span class="glyphicon glyphicon-trash"></span></a></div>';
							}}
							]
					});
			// $.ajax({
			// 	url: "../../ProductsApi/views/product/readProducts.php",
			// 	type: 'GET',
			// 	datatype: 'JSON',
			// 	success: function (data) {
			// 		console.log(data.records);
			// 		var data=data.records;
			// 		var txt='';
			// 		// for (var i = 0; i <data.length; i++)
			// 		// {
						
			// 		// 	txt=' <tr><td>'+data[i].name +'</td> <td>'+data[i].description +'</td> <td>'+data[i].price +'</td> <td>'+data[i].category_name +'</td><td>    <div class="btn-group"><a class="btn btn-primary" title="EDIT" href="#"><span class="glyphicon glyphicon-edit"></span></a><a class="btn btn-danger"  title="DELETE" href="#"><span class="glyphicon glyphicon-trash"></span></a></div> </td></tr>';
			// 		// 	$("#example tbody").append(txt);
			// 		// }
			// 		//$('#example').DataTable();
			// 		$('#example').DataTable({
			// 			data:data,
			// 			columns:[
			// 			{data: "name"},
			// 			{data: "description"},
			// 			{data: "price"},
			// 			{data: "category_name"},
			// 			{
			// 				mRender: function (data, type, row) {
			// 					return '<div class="btn-group"><a data-id='+row.id+' class="btn btn-primary up" title="EDIT" href="http://localhost/Ecommerces/ProductsApi/views/product/readOneProduct.php?id='+row.id+'"><span class="glyphicon glyphicon-edit"></span></a><a class="btn btn-danger del"  data-id='+row.id+' title="DELETE" ><span class="glyphicon glyphicon-trash"></span></a></div>';
			// 				}}]
			// 			}); 
			// 	},
			// 	cache: false,
			// 	contentType: false,
			// 	processData: false
			// });
		} );
		
		$("#example tbody").on('click', '.del', function() {
			
			var ids=$(this).data('id');
			alert(ids);
			$.ajax({
				url: '../../ProductsApi/views/product/deleteProduct.php',
				type: 'POST',
				data: {id: ids},
			})
			.done(function(data) {
				console.log(data);
            	$('#message').html('<div class="alert alert-success fade in"><strong>Success!</strong>'+data.message+'</div>');
					//alert("asas");
				$('#example').DataTable().ajax.reload();	
			})
			.fail(function() {
				console.log("error");
			
			});
			
    
		// 	$.ajax({
		// 		url: "../../ProductsApi/views/product/deleteProduct.php",
		// 		type: 'POST',
		// 		data: {id:ids},
		// 		success: function (data) {
					
		// 					// $.ajax({
		// 					// 	url: "views/product/readProducts.php",
		// 					// 	type: 'GET',
		// 					// 	datatype: 'JSON',
		// 					// 	success: function (data) {
		// 					// 		console.log(data.records);
		// 					// 		var data=data.records;
		// 					// 		// var txt='';
		// 					// 		// for (var i = 0; i <data.length; i++)
		// 					// 		// {

		// 					// 		// 	txt=' <tr><td>'+data[i].name +'</td> <td>'+data[i].description +'</td> <td>'+data[i].price +'</td> <td>'+data[i].category_name +'</td><td>    <div class="btn-group"><a class="btn btn-primary" title="EDIT" href="#"><span class="glyphicon glyphicon-edit"></span></a><a class="btn btn-danger"  title="DELETE" href="#"><span class="glyphicon glyphicon-trash"></span></a></div> </td></tr>';
		// 					// 		// 	$("#example tbody").append(txt);
		// 					// 		// }
		// 					// 		// $('#example').DataTable();

		// 					// 	},
		// 					// 	cache: false,
		// 					// 	contentType: false,
		// 					// 	processData: false
		// 					// });
		// 				},
		// 				cache: false,
		// 				contentType: false,
		// 				processData: false
		// 			});

		 });
		$(document).ready(function () {
			$(".toggle-sidebar").click(function () {
				$("#sidebar").toggleClass("collapsed");
				$("#content").toggleClass("col-md-12 col-md-9");
				
				return false;
			});
		});
	</script>
</body>

</html>