<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" href="assets/css/custom.css" />
	</head>
	<body id="Signup-Bgcolor">
		<div class="container">
		<div class="row">
			<div class="col-lg-10 col-lg-offset-1">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="text-center">Product Creation</h4>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12" id="message">
							</div>
							<form id="productCreationForm" class="form-horizontal text-center">
								<div class="col-lg-12">
								<div class="form-group">
										<label class="control-label col-sm-2" for="Name">Product Name:</label>
										<div class="col-sm-8">
											<input type="hidden" class="form-control" id="method" name="method" value="productRegistration"/>
											<input type="text" class="form-control" id="name" name="name" placeholder="Enter Product Name">
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-2" for="Price">Product Price:</label>
										<div class="col-sm-8">
											<input type="number" class="form-control" id="price" name="price" placeholder="Enter Product Price">
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-2" for="Category">Password:</label>
										<div class="col-sm-8">
											<select class="form-control" id="categoryId" name="categoryId">
												<option value="1">Fashion</option>
												<option value="2">Electronics</option>
												<option value="3">Motors</option>
												<option value="5">Movies</option>
												<option value="6">Books</option>
												<option value="13">Sports</option>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-2" for="Food Image">Choose an Image:</label>
										<div class="col-sm-8">
											<input type="file" id="productImage" name="productImage" style="margin-top: 5px;" />
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-2" for="Category">Description:</label>
										<div class="col-sm-8">
											<textarea class="form-control" rows="5" name="description" id="description"></textarea>
										</div>
									</div>
									<div class="form-group">
										<div class="col-sm-8 col-sm-offset-2" style="padding-top:10px;">
											<button type="submit" class="btn btn-default" value="submit">Submit</button>
											<button type="button" class="btn btn-default" value="reset">Reset</button>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="assets/js/productCreation.js"></script>    
	</body>
</html>
