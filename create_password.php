<!DOCTYPE html>
<html>
<head>

	<meta 	charset="UTF-8">
	<meta 	http-equiv="X-UA-Compatable" 	content="IE-edge">
	<meta 	name="veiwport" 				content="width=device-width, initial-scale=1.0">
	
	<title>Paigham |Change Password</title>

	<script 	type="text/javascript" 	src="includefiles/js/bootstrap.min.js"></script>
	<script 	type="text/javascript" 	src="includefiles/jquery.js"></script>
	<link 		href="includefiles/css/bootstrap.min.css" 	rel="stylesheet">
	<link 		rel="stylesheet" 		type="text/css" 	href="css/signin.css">

</head>
<body>

	<div class="signin-form">
		<form action="" method="POST">
			<div class="form-header">
				<h2>Create New Password</h2>
				<p>Paigham</p>
			</div>
			
			<div class="form-group">
				<label>Enter Password</label>
				<input class="form-control" type="password" name="pass1" placeholder="Enter New Password..." autocomplete="off" required maxlength="15" minlength="8">
			</div>

			<div class="form-group">
				<label>Confirm Password</label>
				<input class="form-control" type="password" name="pass2" placeholder="Enter Confirm Password..." autocomplete="off" required maxlength="15" minlength="8">
			</div>

			<div class="form-group">
				<button class="btn btn-primary btn-block btn-lg " type="change" name="changeit">Change</button>
			</div>
		</form>

	<?php
	session_start();
	include('includefiles/connection.php');
	
	if(isset($_POST['changeit']))
	{

		$user 	= 	$_SESSION['user_email'];
		$pass1 	=	base64_encode(strip_tags(($_POST['pass1'])));
		$pass2 	= 	base64_encode(strip_tags(($_POST['pass2'])));


		if($pass1 != $pass2)
		{
			echo'
			<div class="alert alert-danger">
			<b>Your New Passsword Not Match with Confirm Password!!!</b>
			</div>';
		}

		if($pass1 == $pass2)
		{
			$update_pass = mysqli_query($con,"UPDATE users SET user_pass = '$pass1' WHERE user_email = '$user'");

			session_destroy();

			echo"</script>
			alert('Your Passsword is Changed!')
			</script>";

			echo "<script>
			alert('Go Ahead and SignIn')
			</script>";
			
			echo "<script>
			window.open('signin.php','_self')
			</script>";  
		}
	}
	?>

	</div>
</body>
</html>