<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Product Display</title>
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/admin.css">
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
			<div class="col-md-9" id="content" style="padding-top:25px">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4>Products</h4>
					</div>
					<div class="panel-body">
						<div class="row" style="padding:10px" >
							<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
								<thead>
									<tr>
										<th>Name</th>
										<th>Description</th>
										<th>Price</th>
										<th>Category Name</th>
										<th>Action</th>
									</tr>
								</thead>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
	
	<script src="assets/js/productDisplay.js"></script>
</body>

</html>