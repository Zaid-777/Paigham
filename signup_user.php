<?php
session_start();
include('includefiles/connection.php');

if(isset($_POST['sign_up']))
{
	$name 		= 	strip_tags(mysqli_real_escape_string($con,$_POST['user_name']));
	$last_name 	= 	strip_tags(mysqli_real_escape_string($con,$_POST['last_name']));
	$user_dob 	= 	strip_tags(mysqli_real_escape_string($con,$_POST['user_dob']));
	$email 		= 	strip_tags(mysqli_real_escape_string($con,$_POST['user_email']));
	$bf_name 	= 	strip_tags(mysqli_real_escape_string($con,$_POST['bf_name']));
	$pass 		= 	strip_tags(mysqli_real_escape_string($con,$_POST['user_pass']));
	$confirm_pass = strip_tags(mysqli_real_escape_string($con,$_POST['confirm_pass']));
	$country 	= 	strip_tags(mysqli_real_escape_string($con,$_POST['user_country']));
	$gender 	= 	strip_tags(mysqli_real_escape_string($con,$_POST['user_gender']));
	$capcha		= 	strip_tags(mysqli_real_escape_string($con,$_POST['capcha']));
	$rand 		=	rand(1,4);


	if($name == '' || $name == ' ' || $name == '  ' || $name == '   ' || $name == '    ' || $name == '     ' || $name == '      '|| $name == '       '|| $name == '        ')
	{
		echo "<script>
		alert('We Can Not Verify Your Name!!!.')
		</script>";
		
		exit();
	}
	
	if(strlen($pass) < 8)
	{
		echo "<script>
		alert('Psssword Should be Minmum 8 Characters!!!.')
		</script>";
		
		exit();	
	}

	if($pass != $confirm_pass)
	{
		echo "<script>
		alert('Your Passsword Not Match with Confirm Password!!!.')
		</script>";
		
		exit();	
	}

	$check_email 	=	"SELECT * FROM users WHERE user_email = '$email'";
	$run_email 		= 	mysqli_query($con,$check_email);

	$check 			= 	mysqli_num_rows($run_email);

	if($check)
	{	
		echo "<script>
		alert('Email is Already Exsit, Please Try Again!!!.')
		</script>";
		
		echo "<script>
		window.open('signup.php','_self')
		</script>";
		
		exit();
	}


	if($rand == 1)
	{
		$profile_pic 	= 	"images/profile1.png";
	}
	else if($rand == 2)
	{
		$profile_pic 	=	"images/profile1.png";
	}
	else if($rand == 3)
	{
		$profile_pic 	=	"images/profile1.png";
	}
	else if($rand == 4)
	{
		$profile_pic 	=	"images/profile1.png";
	}

	$password = base64_encode($pass);
	$insert_data 		= 	"INSERT INTO `users`(`user_name`, `last_name`, `DOB`, `user_email`, `user_pass`, `profile_pic`, `user_country`, `user_gender`, `forgotten_answer`) VALUES ('$name','$last_name','$user_dob','$email','$password','$profile_pic','$country','$gender','$bf_name')";

	$run_query 			= 	mysqli_query($con,$insert_data);

	if($run_query)
	{
		echo "<script>
		alert('Congratulations $name, Your Account Created Successfully!')
		</script>";
		
		echo "<script>
		window.open('signin.php','_self')
		</script>";
	}
	else
	{
				echo "<script>alert('Registration Failed, Please Try Again!!!')</script>";
				
				echo "<script>
				window.open('signup.php','_self')
				</script>";
				exit();
	}
}

?>
