<!DOCTYPE html>
<html>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

	<link rel="stylesheet" href="assets/css/custom.css" />
<body id="Signup-Bgcolor">
	<div class="container">
	<div class="row">
		<div class="col-lg-10 col-lg-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="text-center">Sign Up</h4>
				</div>
				<div class="panel-body">
					<div class="row">
						<form id="signUpForm" class="form-horizontal text-center">
							<div class="col-lg-12">
							<div class="form-group">
									<label class="control-label col-sm-2" for="Name">Name:</label>
									<div class="col-sm-8">
										<input type="hidden" class="form-control" id="method" name="method" value="signUP" />
										<input type="text" class="form-control" id="name" name="name" placeholder="Enter Name of Food Item" required>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-sm-2" for="Email">Email:</label>
									<div class="col-sm-8">
										<input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-sm-2" for="Password">Password:</label>
									<div class="col-sm-8">
										<input type="password" class="form-control" id="password" name="password" placeholder="Enter your email" required>
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
										<button type="button" class="btn btn-default">Reset</button>
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
<script>
$( "#signUpForm" ).submit(function( event ) {
event.preventDefault();
var formData = new FormData(this);
console.log(formData);
$.ajax({
	url: "../API/savefile.php",
	type: 'POST',
	data: formData,
	success: function (data) {
		$('#loading').hide();
		$("#message").html(data);
	},
	cache: false,
	contentType: false,
	processData: false
});
});
</script>    
</body>
</html>
