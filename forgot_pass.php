<!DOCTYPE html>
<html>
<head>

	<meta 	charset="UTF-8">
	<meta 	http-equiv="X-UA-Compatable" 	content="IE-edge">
	<meta 	name="veiwport" 				content="width=device-width, initial-scale=1.0">
	
	<title>Paigham |Forgot Password</title>

	<script 	type="text/javascript" 	src="includefiles/js/bootstrap.min.js"></script>
	<script 	type="text/javascript" 	src="includefiles/jquery.js"></script>
	<link 		href="includefiles/css/bootstrap.min.css" 	rel="stylesheet">
	<link 		rel="stylesheet" 		type="text/css" 	href="css/signin.css">

</head>
<body>

	<div class="signin-form">
		<form action="" method="POST">
			<div class="form-header">
				<h2>Forgot Password</h2>
				<p>Paigham</p>
			</div>
			<div class="form-group">
				<label>Email</label>
				<input class="form-control" type="email" name="email" placeholder="Enter Email (abc@email.com)." autocomplete="off" required>
			</div>
			
			<div class="form-group">
				<label>Best Friend Name</label>
				<input class="form-control" type="text" name="bf" placeholder="Enter Name." autocomplete="off" required>
			</div>

			<div class="form-group">
				<button class="btn btn-primary btn-block btn-lg " type="submit" name="sb">Submit</button>
			</div>

			<div class="text-center small" style="color: red" >
				Back To SignIn? 
				<a href="signin.php">
				Click Here. </a>
			</div>
		</form>

	<?php
		session_start();

		include('includefiles/connection.php');

		if(isset($_POST['sb']))
		{
			$email =	strip_tags($_POST['email']);
			$Bfriend = strip_tags($_POST['bf']);

			$select_user = "SELECT * FROM users WHERE user_email = '$email' AND forgotten_answer = '$Bfriend'";

			$run_query1 = mysqli_query($con,$select_user);
			
		 	$check_user = mysqli_num_rows($run_query1);
			
			if($check_user == 1)
			{
				$_SESSION['user_email'] = $email;

				echo "<script>window.open('create_password.php','_self')</script>";
			}
			else
			{
				echo "<script>alert('Your Email Or Best Friend Name Incorrect!!!')</script>";

				echo "<script>window.open('forgot_pass.php','_self')</script>";
			}

		}
	?>
</div>

</body>
</html>