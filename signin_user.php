<?php
session_start();

include("includefiles/connection.php");

if(isset($_POST['sign_in']))
{
	$email 		=	strip_tags(mysqli_real_escape_string($con,$_POST['email']));
	$pass 		=	base64_encode(strip_tags(mysqli_real_escape_string($con,$_POST['pass'])));

	$select_user	=	"SELECT * FROM users WHERE user_email = '$email'";
	$query 			=	mysqli_query($con,$select_user);
	$check_user 	=	mysqli_num_rows($query);

	if($check_user)
	{

		$select_user_pass	=	"SELECT * FROM users WHERE user_email = '$email' AND user_pass = '$pass'";
		$query_pass 		=	mysqli_query($con,$select_user_pass);
		$check_user_pass 	=	mysqli_num_rows($query_pass);		

		if($check_user_pass)
		{
			$_SESSION['user_email']		=	$email;
			
			$update_status	=	mysqli_query($con,"UPDATE users SET log_in = 'Online' WHERE user_email = '$email'  AND user_pass = '$pass'");

			$user 		=	$_SESSION['user_email'];
			
			$get_user	=	"SELECT * FROM users WHERE  user_email = '$user'  AND user_pass = '$pass'";

			$run_user 	=	mysqli_query($con,$get_user);
			$row 		=	mysqli_fetch_array($run_user);

			$user_name 	=	$row['user_name'];

			echo "<script>window.open('home.php?user_name=$user_name','_self')</script>";
		}
		else
		{
			echo "
			<br>
			<div class='alert alert-danger'>
			<strong>
				Your Password Incorrect!!!,<br>
				Please Try Again OR Forgot Password.
			</strong>
			</div>";
		}		 
	}
	else
	{
		echo "
		<br>
		<div class='alert alert-danger'>
		<strong>
			Your Email Incorrect, Please Try Again!.
		</strong>
		</div>";
	}
}

?>