<!DOCTYPE html>
<html>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="assets/css/custom.css" />
<body id="Signup-Bgcolor">
	<div class="container">

		<div class="row" id="add">
			<div class="col-lg-10 col-lg-offset-1">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="text-center">Add Product</h4>
					</div>
					<span id="message" class="text-center"></span>
					<div class="panel-body">
						<div class="row">
							<form id="signUpForm" class="form-horizontal text-center" method="post" action="">
								<div class="col-lg-12">
									<div class="form-group">
										<label class="control-label col-sm-2" for="Name">Name:</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" required>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-2" for="Email">Description:</label>
										<div class="col-sm-8">
											<textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter description"></textarea>
											
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-2" for="Password">Price:</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" id="price" name="price" placeholder="Enter price" required>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-2" for="Password">Categories:</label>
										<div class="col-sm-8">
											<select class="form-control m-bot15" id="category_id" name="category_id">

												
											</select>
										</div>

									</div>
									<div class="form-group">
										<label class="control-label col-sm-2" for="Food Image">Choose an Image:</label>
										<div class="col-sm-8">
											<input type="file" id="userImage" name="userImage" style="margin-top: 5px;" required/>
										</div>
									</div>
									<div class="form-group">
										<div class="col-sm-8 col-sm-offset-2" style="padding-top:10px;">
											<button type="submit" class="btn btn-default">Submit</button>
											<button type="button" class="btn btn-default" id="gg">Reset</button>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row" id="up">
			<div class="col-lg-10 col-lg-offset-1">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="text-center">Update Product</h4>
					</div>
					<span id="messages" class="text-center"></span>
					<div class="panel-body">
						<div class="row">
							<form id="UpdateForm" class="form-horizontal text-center" method="post" action="">
								<div class="col-lg-12">
									<div class="form-group">
										<input type="hidden" id="id" name="id">
										<label class="control-label col-sm-2" for="Name">Name:</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" id="names" name="name" placeholder="Enter Name" required>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-2" for="Email">Description:</label>
										<div class="col-sm-8">
											<textarea class="form-control" id="descriptions" name="description" rows="3" placeholder="Enter description"></textarea>
											
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-2" for="Password">Price:</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" id="prices" name="price" placeholder="Enter price" required>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-2" for="Password">Categories:</label>
										<div class="col-sm-8">
											<select class="form-control m-bot15" id="category_ids" name="category_id">

												
											</select>
										</div>

									</div>
									<div class="form-group">
										<label class="control-label col-sm-2" for="Food Image">Choose an Image:</label>
										<div class="col-sm-8">
											<input type="file" id="userImages" name="userImage" style="margin-top: 5px;" required/>
										</div>
									</div>
									<div class="form-group">
										<div class="col-sm-8 col-sm-offset-2" style="padding-top:10px;">
											<button type="submit" class="btn btn-default">Update</button>
											<button type="button" class="btn btn-default" id="ggs">Cancel</button>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-10 col-lg-offset-1">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="text-center">Products</h4>
					</div>
					<div class="panel-body">
						<div class="row ">
							<table id="example" class="table table-striped table-bordered text-center" cellspacing="0" width="100%">
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
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>

	<!-- custom form validation script for this page-->
	<script >

		$(document).ready(function() {
			$('#up').hide();
			$('#example').DataTable({
				ajax: {
					url:'views/product/readProducts.php',
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
						return '<div class="btn-group"><a data-id='+row.id+' class="btn btn-primary up" title="EDIT"><span class="glyphicon glyphicon-edit"></span></a><a class="btn btn-danger del"  data-id='+row.id+' title="DELETE" href="#"><span class="glyphicon glyphicon-trash"></span></a></div>';
					}}
					]
				});
		} );
		$(document).ready(function() {
			$.ajax({
				url: "views/category/readCategories.php",
				type: 'GET',
				datatype: 'JSON',
				success: function (data) {
					console.log(data.records);
					var data=data.records;
					var txt='';
					for (var i = 0; i <data.length; i++)
					{
						
						txt='<option value='+data[i].id+'>'+data[i].name+'</option>';
						$("#category_id").append(txt);
					}
					txt='';
					for (var i = 0; i <data.length; i++)
					{
						
						txt='<option value='+data[i].id+'>'+data[i].name+'</option>';
						$("#category_ids").append(txt);
					}
					
				},
				cache: false,
				contentType: false,
				processData: false
			});
		} );
		$('#gg').click(function(event) {
			$('#category_id').val('2');
		});
		$("#signUpForm").validate({

			submitHandler: function(form) {
				console.log($(form));
				var formData = new FormData($('#signUpForm')[0]);
				event.preventDefault();
					//var formData =new FormData(this);

					$.ajax({
						url: "views/product/createProduct.php",
						type: 'POST',
						data: formData,
						success: function (data) {
							$('#message').html('<div class="alert alert-success fade in"><strong>Success!</strong>'+data.message+'</div>');
							$('#example').DataTable().ajax.reload();
							
						},
						cache: false,
						contentType: false,
						processData: false
					});












				}, 

				rules: {
					name: {
						required: true
					},
					description: {
						required: true
					},
					price: {
						required: true,
						digits: true
					},
					category_id: {
						required: true
					},
					userImage: {
						required: true
					}
				},
				messages: {                
					name: {
						required: "Please enter a  Name."
					},
					description: {
						required: "Please enter a description."
					},
					price: {
						required: "Please enter a price."
					},
					category_id: {
						required: "Please select a category."
					},
					userImage: {
						required: "Please select a product image."
					}
				}
			});

		$("#UpdateForm").validate({

			submitHandler: function(form) {
				console.log($(form));
				var formData = new FormData($('#UpdateForm')[0]);
				event.preventDefault();


				$.ajax({
					url: "views/product/updateProduct.php",
					type: 'POST',
					data: formData,
					success: function (data) {
						$('#messages').html('<div class="alert alert-success fade in"><strong>Success!</strong>'+data.message+'</div>');

						$('#example').DataTable().ajax.reload();	

					},
					cache: false,
					contentType: false,
					processData: false
				});












			}, 

			rules: {
				names: {
					required: true
				},
				descriptions: {
					required: true
				},
				prices: {
					required: true,
					digits: true
				},
				category_ids: {
					required: true
				},
				userImages: {
					required: true
				}
			},
			messages: {                
				names: {
					required: "Please enter a  Name."
				},
				descriptions: {
					required: "Please enter a description."
				},
				prices: {
					required: "Please enter a price."
				},
				category_ids: {
					required: "Please select a category."
				},
				userImages: {
					required: "Please select a product image."
				}
			}
		});

		$("#example tbody").on('click', '.del', function() {
			
			var ids=$(this).data('id');
			alert(ids);
			$.ajax({
				url: 'views/product/deleteProduct.php',
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
		});
		$("#example tbody").on('click', '.up', function() {
			
			var ids=$(this).data('id');
			alert(ids);
			$.ajax({
				url: 'views/product/readOneProduct.php',
				type: 'GET',
				data: {id: ids},
			})
			.done(function(data) {
				console.log(data);
				$('#add').hide();
				$('#up').show();
				$('#id').val(data.id);
				$('#names').val(data.name);
				$('#descriptions').val(data.description);
				$('#prices').val(data.price);
				$('#category_ids').val(data.category_id);

			})
			.fail(function() {
				console.log("error");
				
			});
		});
	</script>

</body>
</html>
