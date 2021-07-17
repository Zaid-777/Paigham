<!DOCTYPE html>
<?php 
session_start();	
include('includefiles/connection.php');
if(!isset($_SESSION['user_email']))
{
	header('Location:signin.php');
}else
{
 ?>
<html>
<head>
	<meta 	charset="UTF-8">
	<meta 	http-equiv="X-UA-Compatable" 	content="IE-edge">
	<meta 	name="veiwport" 				content="width=device-width, initial-scale=1.0">

	<title>Paigham |Change Password</title>

	<script 	type="text/javascript"	src="includefiles/js/bootstrap.min.js"></script>
	<script 	type="text/javascript" 	src="includefiles/jquery.js"></script>
	<link 		href="includefiles/css/bootstrap.min.css"	rel="stylesheet">
</head>
<style type="text/css">
	body{
		overflow-x: hidden;
		background-color: #f2aaef;
	}
	#button{
		width: 25%;
	}
</style>
<body>
			<?php
			$user = $_SESSION['user_email'];

			$get_user = "SELECT * FROM users WHERE user_email = '$user'";
			$run_user = mysqli_query($con,$get_user);

			$row = mysqli_fetch_assoc($run_user);

			$user_name		=	$row['user_name'];
			$user_password	=	$row['user_pass'];
			?>

		<nav class="navbar-brand navbae-expand-sm bg-dark nav-dark" style=" width: 100% ;">
				<ul class="navbar-nav" style="padding: 20px"> 
					<li>
					<?php
						echo '<a style="color: #fff; padding:30px; text-decoration: none;font-size: 20px;" href="account_setting.php">Account Setting</a>';
					?>
					</li>
				</ul>
		</nav><br><br><br><br>

		<div class="row">
			<div class="col-sm-2"></div>
			<div class="col-sm-8">
				<form action="" method="POST">
					
					<table class="table table-bordered table-hover">

						<tr align="center">
							<td colspan="6" class="active"><h2>Modify Password</h2></td>
						</tr>

						<tr>
							<td  align="center" style="font-weight: bold;">Current Password</td>
							<td>
								<input type="password" name="current_pass" class="form-control" required minlength="8" maxlength="15" placeholder="Enter Current Password" />
							</td>
						</tr>
							
						<tr>
							<td  align="center" style="font-weight: bold;">New Password</td>
							<td>
								<input id="mypass" type="password" name="u_pass1" class="form-control" required minlength="8" maxlength="15" placeholder="Enter New Password" />
							</td>
						</tr>


						<tr>
							<td  align="center" style="font-weight: bold;">Confirm Password</td>
							<td>
								<input id="mypass" type="password" name="u_pass2" class="form-control" required placeholder="Enter Confirm Password" />
							</td>
						</tr>

							<tr align="center">
							<td colspan="6">		
								<input type="submit" name="change" class="btn btn-info" required value="Change" id="button" />
							</td>
						</tr>

					</table>

				</form>
				<?php

				if(isset($_POST['change']))
				{
					$c_pass = 	base64_encode(strip_tags(($_POST['current_pass'])));
					$pass1 	=	base64_encode(strip_tags(($_POST['u_pass1'])));
					$pass2 	= 	base64_encode(strip_tags(($_POST['u_pass2'])));


					if($user_password != $c_pass)
					{
						echo'
						<div class="alert alert-danger">
						<b>You Enter Current Passsword Incorrect!!!</b>
						</div>';
					}

					if($pass1 != $pass2)
					{
						echo'
						<div class="alert alert-danger">
						<b>Your New Passsword Not Match with Confirm Password!!!</b>
						</div>';
					}

					if($pass1 == $pass2 AND $user_password == $c_pass)
					{
						$update_pass = mysqli_query($con,"UPDATE users SET user_pass = '$pass1' WHERE user_email = '$user'");

						echo'
						<div class="alert alert-info">
						<b>Your Passsword is Changed!</b>
						</div>';
					}
				}

				?>

			</div>
			
			<div class="col-sm-2"></div>

		</div>

			

</body>
</html>

<?php
	}
?>