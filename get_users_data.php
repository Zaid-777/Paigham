<?php 

	session_start();
	$con = mysqli_connect('localhost','root','','paigham') OR die('Connection Failed!!!');

	$current_timestamp = strtotime(date('Y-m-d H:i:s') . '-10 second');
	$current_timestamp = date('Y-m-d H:i:s', $current_timestamp);

	$mainuser = $_SESSION['user_email'];
	$user = "SELECT * FROM users";

	$run_user = mysqli_query($con,$user);


	while($row_user = mysqli_fetch_array($run_user))
	{
		$user_id		= 	$row_user['user_id'];
		$user_name 		= 	$row_user['user_name'];
		$user_email 	= 	$row_user['user_email'];
		$user_profile 	= 	$row_user['profile_pic'];
		$log_in 		=	$row_user['log_in'];


		$noti =  mysqli_query($con,"SELECT * FROM users_chat WHERE msg_status = 'unread' AND sender_username = '$user_name'");

		$notifications = mysqli_num_rows($noti);


		if($user_email == $mainuser)
		{

			echo '
		<li>
			<div class="chat-left-img">
				<a href="home.php?user_name='.$user_name.'" style="color: black" alt="Profile Pic">
				<img src="'.$user_profile.'" style="border: 5px solid rgba(0,230,0,8)">
			</div>
			<div class="chat-left-detail">
				<p>'.$user_name.'</p></a>';
		}
		if($user_email != $mainuser)
		{
			if( 'NOW()' > $current_timestamp )
			{
				echo "
			<li>
				
				<div class='chat-left-img'>
					<a href='home.php?user_name=$user_name' style='color: black ;' alt='Profile Pic'>
					<img src='$user_profile' style='border: 5px solid rgba(0,0,0,0.28)'>
					</a>
				</div>&nbsp";
			}
			
			if( $notifications > 0 AND  'NOW()' > $current_timestamp )
			{
				echo "
				<small class='alert alert-info' style='font-size: 12px;padding: 1%;'>$notifications</small>";
			}

			
			echo "
			<div class='chat-left-detail'>
			<a href='home.php?user_name=$user_name' style='color: black ;'>
				<p>$user_name</p>
			</a>";
		}
			
		

		if($log_in == 'Online' AND  'NOW()' > $current_timestamp )
		{
			echo '
			<span><i class="fa fa-circle" aria-hidden="true">Online</i>
			</span>';
		}
		else
		{
			echo '
			<span><i class="fa fa-circle-o" aria-hidden="true">Offline</i>
			</span>';	
		}
		
	 echo	"</div><br><br><hr></li>
		";
	}

?>