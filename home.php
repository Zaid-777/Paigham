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

	<title>Paigham |Home</title>

	<script 	type="text/javascript"	src="includefiles/js/bootstrap.min.js"></script>
	<script 	type="text/javascript" 	src="includefiles/jquery.js"></script>
	<link 		href="includefiles/css/bootstrap.min.css"	rel="stylesheet">
	<link 		rel="stylesheet" 		type="text/css" 	href="css/home.css">

</head>

<body style="overflow-x: hidden; 
	">

	<div class="main-section">
		<div class="row">
			
			<div class="col-md-3 col-sm-3 col-xs-12 left-sidebar">
				
				<div class="input-group searchbox">
					<div class="input-group-btn">
					<center><a href="account_setting.php"><button class="btn" name="" type="submit">Setting</button></a></center>		
					</div>
				</div>

				<div class="left-chat">
					<ul>
						<div id="online"></div>
					</ul>
				</div>
			</div>

			<div class="col-md-9 col-xs-12 right-sidebar">
				
				<div class="row">
					<!-- getting the user Information who is logged in -->
					<?php

						$user = $_SESSION['user_email'];
						$get_user = "SELECT * FROM users WHERE user_email = '$user'";
						$run_user = mysqli_query($con,$get_user);

						$row = mysqli_fetch_array($run_user);

						$user_id = $row['user_id'];
						$user_name = $row['user_name'];

					?>
					<!-- Getting the user data on which user Click -->
					<?php

					if(isset($_GET['user_name']))
					{
						global $con;
						$get_username = $_GET['user_name'];
						$get_user = "SELECT * FROM users WHERE user_name = '$get_username'";

						$run_user = mysqli_query($con,$get_user);
						$row_user = mysqli_fetch_array($run_user);

						$username   		= $row_user['user_name'];
						$user_profile_image = $row_user['profile_pic'];

					}

					$total_messages = "SELECT * FROM users_chat 
					WHERE (sender_username = '$user_name' AND receiver_username = '$username') OR (receiver_username = '$user_name' AND sender_username = '$username')";

					$run_messages = mysqli_query($con,$total_messages);
					$total  = mysqli_num_rows($run_messages);

					?>
					<div class="col-md-12 right-header">
						<div class="right-header-img">
							<img src="<?php echo $user_profile_image; ?>" alt="Profile Pic">
						</div>
						<div class="right-header-detail">
							<form method="POST">
								<p><?php echo $username;?></p>
								<span><?php echo $total;?>messages</span>
								<button name="logout" class="btn btn-danger">Logout</button>
							</form>
							<?php

								if(isset($_POST['logout']))
								{
									$usdate = mysqli_query($con,"UPDATE users SET log_in = 'Offline' WHERE user_name = '$user_name'");
									header('location:logout.php');
									exit();
								}
							?>
						</div>
					</div>
				</div>
				
				<div class="row">
					<div id="scrolling_to_bottom" class="col-md-12 right-header-contentChat">
						<?php

						$sel_img = "SELECT * FROM users_chat
						WHERE  (sender_username = '$user_name' AND receiver_username = '$username') OR (receiver_username = '$user_name' AND sender_username = '$username') ORDER BY 1 ASC";
						$run_msg = mysqli_query($con,$sel_img);

						while($row = mysqli_fetch_assoc($run_msg))
						{
							$sender_username 	= 	$row['sender_username'];
							$receiver_username 	= 	$row['receiver_username'];
							$msg_content		= 	$row['msg_content'];
							$msg_date 			= 	$row['msg_date'];
						?><ul><?php	
							if($user_name == $sender_username AND $username == $receiver_username)
							{
								echo '
									<li>
										<div class="rightside-right-chat">
										<span>'.$user_name.'<small>('.$msg_date.')</small></span><br><br>
										<p class="pr">'.$msg_content.'</p>
										</div>
										<br><br>
									</li>
								';
							}

						 	else if($user_name == $receiver_username AND $username == 
							$sender_username)
							{
								echo '
									<li>
										<div class="rightside-left-chat">
										<span>'.$username.' <small> ('.$msg_date.')</small></span><br><br>
										<p class="pl">'.$msg_content.'</p>
										</div>
										<br><br>
									</li>
								';
							}

								$update3 = mysqli_query($con,"UPDATE users_chat SET msg_status = 'read' WHERE receiver_username = '$user_name' AND sender_username = '$username'");
						?>
						</ul><?php }?>
					</div>
				</div>

				<div class="row">
					<div class="col-md-12 right-chat-textbox">
						<form method="POST">
							<input type="text" name="msg_content" placeholder="Write Your Message......." autocomplete="off" >
							<button class="btn" name="submit"><i class="fa fa-telegram" aria-hidden="true"></i></button>
						</form>
						
					</div>


				</div>

			</div>

		</div>

	</div>
<?php

	if(isset($_POST['submit']))
	{
		$msg = strip_tags($_POST['msg_content']); 

		if($msg =="")
		{
			echo "
				<div class='alert alert-danger'>
					<strong>
						<center>
							Message was unable to Send!
						</center>
					</strong>
				</div>
			";
		}
		else if(strlen($msg) > 100)
		{
			echo "
				<div class='alert alert-danger'>
					<strong>
						<center>
							Message is too Long.Use Only 100 Characters!
						</center>
					</strong>
				</div>
			";	
		}
		else
		{
			echo '<audio  autoplay><source src="includefiles/msg.mp3" type="audio/mp3"></audio>';
			$insert = "INSERT INTO users_chat(`sender_username`, `receiver_username`, `msg_content`, `msg_status`, `msg_date`) VALUES ('$user_name','$username','$msg','Unread',NOW())";
			$run_insert = mysqli_query($con,$insert);
			echo '<embed loop = "false" src = "includefiles/RingMsg.WAV" hidden = "false" autoplay = "true">';
		}
	}
?>

<script>
	$('#scrolling_to_bottom').animate({
		scrollTop: $('#scrolling_to_bottom').get(0).scrollHeight}, 500);
</script>
<script type="text/javascript">
	$(document).ready(function(){
		var height = $(window).height();
		$('.left-chat').css('height',(height - 187) + 'px');
		$('.right-header-contentChat').css('height',(height - 190) + 'px');
	});
</script>


<script>
	
	$(document).ready(function(){

		fetch_user();
		setInterval(function(){fetch_user()},1000);

		function fetch_user()
		{
			$.ajax({
				url:"get_users_data.php",
				method:"GET",
				success:function(data){
					$('#online').html(data);
				}
			})
		}

	});

</script>


</body>
</html>

<?php
	}
?>