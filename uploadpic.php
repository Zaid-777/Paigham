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

	<title>Paigham |Change Profile</title>

	<script 	type="text/javascript"	src="includefiles/js/bootstrap.min.js"></script>
	<script 	type="text/javascript" 	src="includefiles/jquery.js"></script>
	<link 		href="includefiles/css/bootstrap.min.css"	rel="stylesheet">
</head>
<style type="text/css">
	body{
		overflow-x: hidden;
		background-color: #f2aaef;
	}
	.card{
		box-shadow: 0px 0px 4px rgba(0,0,0,.3);
		max-width: 400px;
		margin: auto;
		background: #c099ef;
		border-radius: 30px;
		max-height: 400px;
		text-align: center;
		font-family: sans-serif;
	}

	.card img{
		border-radius: 30px;
		min-height: 300px;
		max-height: 300px;
	}

	.title{
		color: gray;
		font-size: 18px;
	}

 button{
		border: none;
		outline: none;
		padding: 9px;
		background-color: lightblue;
		border-radius: 10px;
		color: #000;
		font-size: 18px;
		text-align: center;
		cursor: pointer;
		margin-top: 10px; 
		width: 100%;
	}

.filea{
		margin-top: 0px;
		width: 0px;
		background-color: #fff;
		margin-left: 90px;
}
	#update_profile{
		
	}

	label{
		padding: 7px;
		font-size: 20px;
		color: black;
		margin-right: 10px; 
		display: contents;
		cursor: pointer;
	}

	label:hover{
		background-color: black;
		color:red;
	}

	label[type="file"]{
		display: none;
	}



</style>
<body>

		

			<?php
			$user = $_SESSION['user_email'];

			$get_user = "SELECT * FROM users WHERE user_email = '$user'";
			$run_user = mysqli_query($con,$get_user);

			$row = mysqli_fetch_assoc($run_user);

			$user_name		=	$row['user_name'];
			$user_profile	=	$row['profile_pic'];

			echo '<nav class="navbar-brand navbae-expand-sm bg-dark nav-dark" style=" width: 100% ;">
			<ul class="navbar-nav" style="padding: 20px"> 
				<li>
					<a style="color: #fff; padding:30px; text-decoration: none;font-size: 20px;" href="account_setting.php">Account Setting</a>
				</li>
			</ul>
			</nav><br><br>';

			echo '<div class="card">
				<img src="'.$user_profile.'" alt="Profile Pic">
				<h1>'.$user_name.'</h1>
				<form method="POST" enctype = "multipart/form-data">
					<label id="update_profile">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Select Profile
					<input class="filea" type="file" name="u_image" size="60">
					</label><br>
					<button id="button_profile" name="update">Update Profile</button>
				</form>
				</div>
			';
			?>

			<?php

			if(isset($_POST['update']))
			{
				$u_image = $_FILES['u_image']['name'];
				$image_tmp = $_FILES['u_image']['tmp_name'];

				$random_number = rand(1,1000);

				if($u_image == '')
				{
					echo "<script>
					alert('Please Select Profile Picture!')
					</script>";
					echo "<script>
					window.open('uploadpic.php','_self')
					</script>";
					exit();
				}
				else
				{
					move_uploaded_file($image_tmp,"images/$u_image.$random_number");

						$update = "UPDATE users SET profile_pic = 'images/$u_image.$random_number' WHERE user_email  = '$user'";

					$run = mysqli_query($con,$update);

					if($run)
					{
						echo "<script>
					alert('Your Profile Picture Updated!.')
					</script>";
					echo "<script>
					window.open('uploadpic.php','_self')
					</script>";
					}
					else
					{

					}
				}
			}

			?>
</body>
</html>

<?php
	}
?>