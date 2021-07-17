<!DOCTYPE html>
<html>
<head>
	
	<meta 	charset="UTF-8">
	<meta 	http-equiv="X-UA-Compatable"	content="IE-edge">
	<meta 	name="veiwport" 				content="width=device-width, initial-scale=1.0">

	<title>Paigham |SignUp</title>
	

	<script 	type="text/javascript"	src="includefiles/js/bootstrap.min.js"></script>
	<script 	type="text/javascript" 	src="includefiles/jquery.js"></script>
	<link 		href="includefiles/css/bootstrap.min.css"	rel="stylesheet">
	<link 		rel="stylesheet" 		type="text/css" 	href="css/signup.css">

</head>
<body>

	<div class="signup-form">
		<form action="" method="POST">
			<div class="form-header">
				<h2>Sign Up</h2>
				<p>Fill Out And Start Chating With Your Friends.</p>
			</div>
			<div class="form-group">
				<label>First Name</label>
				<input class="form-control" type="text" name="user_name" placeholder="Enter First Name." autocomplete="off" required maxlength="20">
			</div>
			<div class="form-group">
				<label>Last Name</label>
				<input class="form-control" type="text" name="last_name" placeholder="Enter Last Name." autocomplete="off" required maxlength="20">
			</div>
			<div class="form-group">
				<label>Data of Birth</label>
				<input class="form-control" type="date" name="user_dob" required>
			</div>
			<div class="form-group">
				<label>Email Address</label>
				<input class="form-control" type="email" name="user_email" placeholder="Enter Email (abc@email.com)." autocomplete="off" required>
			</div>
			<div class="form-group">
				<label>Best Friend Name</label>
				<input class="form-control" type="text" name="bf_name" placeholder="Enter Best Friend Name." autocomplete="off" required maxlength="30">
			</div>
			<div class="form-group">
				<label>Password</label>
				<input class="form-control" type="password" name="user_pass" placeholder="Enter Password (max 15 characters)." autocomplete="off" required maxlength="15" minlength="8">
			</div>
			<div class="form-group">
				<label>Confirm Password</label>
				<input class="form-control" type="password" name="confirm_pass" placeholder="Enter Password (max 15 characters)." autocomplete="off" required maxlength="15" minlength="8">
			</div>
			<div class="form-group">
				<label>Country</label>
				<select class="form-control" name="user_country" required>
					<option disabled>Select a Country</option>
					<option>Pakistan</option>
					<option>United States</option>
					<option>India</option>
					<option>United Kingdom</option>
					<option>Italy</option>		
				</select>
			</div>
			<div class="form-group">
				<label>Gender</label>
				<select class="form-control" name="user_gender" required>
					<option disabled>Select Your Gender</option>
					<option>Male</option>
					<option>Female</option>
					<option>Others</option>	
				</select>
			</div>
			<?php 

			$var = "1A2a3B4b5C6c7D8d9E0e1F2f3G4g5H6h7I8i9J0j1K2k3L4l5M6m7N8n9O0o1P2p3Q4q5R6r7S8s9T0t1U2u3V4v5W6w7X8x9Y0y1Z2z3"; 
			$shuffle = str_shuffle($var);

			$cApChA = substr($shuffle,0,4);
			
			?>
			<div class="form-group">
				<label>CAPCHA : <?php  echo '<font color = "red">'.$cApChA.'</font>';?></label>
				<input class="form-control" type="text" name="capcha" placeholder="Enter Capcha." autocomplete="off" required maxlength="4" minlength="4">
			</div>
			<div class="form-group">
				<label class="checkbox-inline">
					<input type="checkbox" required> I accept the <a href="#">Terms of Use</a> & <a href="#">Privacy Policy.</a>
				</label>
			</div>

			<div class="form-group">
				<button class="btn btn-primary btn-block btn-lg " type="submit" name="sign_up">Sign Up</button>
			</div>

			<div class="text-center small" style="color: red" >
				Already have an account?
				<a href="signin.php">SignIn Here.</a>
			</div>
			
			<?php 
			include("signup_user.php"); 
			?>

		</form>

	</div>


</body>
</html>