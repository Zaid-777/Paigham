<!DOCTYPE html>
<html>
<head>

	<meta 	charset="UTF-8">
	<meta 	http-equiv="X-UA-Compatable" 	content="IE-edge">
	<meta 	name="veiwport" 				content="width=device-width, initial-scale=1.0">
	
	<title>Paigham |SignIn</title>

	<script 	type="text/javascript" 	src="includefiles/js/bootstrap.min.js"></script>
	<script 	type="text/javascript" 	src="includefiles/jquery.js"></script>
	<link 		href="includefiles/css/bootstrap.min.css" 	rel="stylesheet">
	<link 		rel="stylesheet" 		type="text/css" 	href="css/signin.css">

</head>
<body>

	<div class="signin-form">
		<form action="" method="POST">
			<div class="form-header">
				<h2>Sign In</h2>
				<p> Login to Paigham</p>
			</div>
			<div class="form-group">
				<label>Email</label>
				<input class="form-control" type="email" name="email" placeholder="Enter Email (abc@email.com)." autocomplete="off" required>
			</div>
			<div class="form-group">
				<label>Password</label>
				<input class="form-control" type="password" name="pass" placeholder="Enter Password..." autocomplete="off" required maxlength="15" minlength="8">
			</div>
			<div class="small">
				Forgot Password?<a href="forgot_pass.php"> Click Here.</a>
			</div>

			<div class="form-group">
				<button class="btn btn-primary btn-block btn-lg " type="submit" name="sign_in">Sign In</button>
			</div>

			<div class="text-center small" style="color: red" >
				Don't Have an account?
				<a href="signup.php"> Sign Up.</a>
			</div>
			<?php include("signin_user.php"); ?>
		</form>

	</div>


</body>
</html>