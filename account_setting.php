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

	<title>Paigham |Account Setting</title>

	<script 	type="text/javascript"	src="includefiles/js/bootstrap.min.js"></script>
	<script 	type="text/javascript" 	src="includefiles/jquery.js"></script>
	<link 		href="includefiles/css/bootstrap.min.css"	rel="stylesheet">
	
	<style type="text/css">
		body{
			overflow-x: hidden;
			background-color: #f2aaef;
		}
	</style>

</head>
<body>
			<?php
			$user = $_SESSION['user_email'];

			$get_user = "SELECT * FROM users WHERE user_email = '$user'";
			$run_user = mysqli_query($con,$get_user);

			$row = mysqli_fetch_assoc($run_user);

			$user_name		=	$row['user_name'];
			$last_name		=	$row['last_name'];
			$dob			=	$row['DOB'];
			$user_email		=	$row['user_email'];
			$user_pass		=	$row['user_pass'];
			$user_profile	=	$row['profile_pic'];
			$user_country	=	$row['user_country'];
			$user_gender	=	$row['user_gender'];
			$forgotten_ans 	=	$row['forgotten_answer'];

			$send_rec_name 	= 	$user_name;
			?>

	<nav class="navbar-brand navbae-expand-sm bg-dark nav-dark" style=" width: 100% ;">
			<ul class="navbar-nav" style="padding: 20px"> 
				<li>
				<?php
					echo '<a style="color: #fff; padding:30px; text-decoration: none;font-size: 20px;" href="home.php?user_name='.$user_name.'">Home Chat</a>';
				?>
				</li>
			</ul>
	</nav><br><br>



	<div  class="row">
		<div class="col-sm-2">
		</div>
			<div class="col-sm-8">
				<form action="" method="POST" enctype="multipart/form-data">
					<table class="table table-bordered table-hover">

						<tr align="center">
							<td colspan="6" class="active"><h2>Modify Account Setting</h2></td>
						</tr>

						<tr>
							<td   align="center" style="font-weight: bold;">Modify Your Name</td>
							<td>
								<input  type="text" name="u_name" class="form-control" required value="<?php echo $user_name ?>" />
							</td>
						</tr>

						<tr>
							<td   align="center" style="font-weight: bold;">Modify Last Name</td>
							<td>
								<input  type="text" name="u_last_name" class="form-control" required value="<?php echo $last_name ?>" />
							</td>
						</tr>


						<tr align="center">
							<td><b>Modify Profile Picture</b></td>
							<td><a class="btn btn-default" href="uploadpic.php" style="text-decoration: none;font-size: 15px;"><i class="fa fa-user" aria-hidden="true"></i>Change Profile Picture</td>
						</tr>
						
						<tr>
							<td align="center" style="font-weight: bold;">Modify Date Of Birth</td>
							<td>
								<input type="date" name="u_date" class="form-control" required value="<?php echo $dob ?>" />
							</td>
						</tr>

						<tr>
							<td align="center" style="font-weight: bold;">Modify Your Email</td>
							<td>
								<input type="email" name="u_email" class="form-control" required value="<?php echo $user_email ?>" />
							</td>
						</tr>


						<tr>
							<td align="center" style="font-weight: bold;">Modify Your Country</td>
							<td>
								<select class="form-control" name="u_country">
									<option disabled>Your Country--<?php echo $user_country?></option>
					<option>Pakistan</option>
					<option>United States</option>
					<option>India</option>
					<option>United Kingdom</option>
					<option>Italy</option>

								</select>
							</td>
						</tr>

						<tr>
							<td align="center" style="font-weight: bold;">Modify Your Country</td>
							<td>
								<select class="form-control" name="u_gender">
									<option disabled>Your Gender--<?php echo $user_gender?></option>
					<option>Male</option>
					<option>Felmale</option>
					<option>Others</option>
								</select>
							</td>
						</tr>

						<tr>
							<td align="center" style="font-weight: bold;">Forgotten Answer</td>
							<td>
								<input type="text" name="f" class="form-control" required value="<?php echo $forgotten_ans ?>" />
							</td>
						</tr>

						<tr align="center">
							<td style="font-weight: bold;">Modify Password</td>
							<td>
								<a href="change_password.php" class="btn btn-default" style="text-decoration: none;font-size: 15px;"><i class="fa fa-fw" aria-hidden="true"></i>Change Password</a>
							</td>
						</tr>

						<tr>
							<td colspan="6" align="right" >
								<input style="width: 200px;" type="submit" name="update" value="Update" class="btn btn-info">
							</td>
						</tr>

					</table>

				</form>

					<?php

						if(isset($_POST['update']))
						{
								$name 		= 	strip_tags($_POST['u_name']);
								$email 		= 	strip_tags($_POST['u_email']);
								$last_name 	=	strip_tags($_POST['u_last_name']);
								$date 		=	strip_tags($_POST['u_date']);
								$country 	= 	strip_tags($_POST['u_country']);
								$gender 	= 	strip_tags($_POST['u_gender']);
								$forg_ans 	= 	strip_tags($_POST['f']);

								$up_query ="UPDATE `users` SET `user_name`= '$name',`last_name` = '$last_name' , `DOB` = '$date',`user_email`= '$email',`user_country`= '$country',`user_gender`= '$gender',`forgotten_answer`= '$forg_ans' WHERE user_email = '$user'";

								$run_upquery = mysqli_query($con,$up_query);
								
								if($run_upquery)
								{

									$run_up_query1 = mysqli_query($con,"UPDATE `users_chat` SET `sender_username`= '$name' WHERE sender_username = '$send_rec_name'");	
									
									$run_up_query2 = mysqli_query($con,"UPDATE `users_chat` SET `receiver_username`= '$name' WHERE receiver_username = '$send_rec_name'");
									
									echo "<script>
									window.open('account_setting.php?user_name=".$name."','_self')
									</script>";
								}
						}

					?>

			</div>
			<div class="col-sm-2">
				
			</div>
	</div>

</body>
</html>

<?php
	}
?>