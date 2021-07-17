<?php

	$con = mysqli_connect('localhost','root','','paigham') OR die('Connection will Not Established!!!');

	
	$Users_Table_Search 	=	"SELECT * FROM `paigham`.users"; 
	$Search1 	= 	mysqli_query($con,$Users_Table_Search);

	if(!$Search1)
	{
		$Users_Table_Query = "CREATE TABLE `users`(`user_id` int(11) NOT NULL, `user_name` varchar(255), `last_name` varchar(255), `DOB` date, `user_email` varchar(255) NOT NULL, `user_pass` varchar(255), `profile_pic` varchar(255) NOT NULL DEFAULT 'images/profile1.png', `user_country` varchar(255) NOT NULL DEFAULT 'Pakistan', `user_gender` varchar(255) NOT NULL DEFAULT 'Male', `forgotten_answer` varchar(255), `log_in` varchar(255) NOT NULL DEFAULT 'Offline')";

		mysqli_query($con,$Users_Table_Query);

		
		$COMPOSITE_KEY = "ALTER TABLE `users` ADD PRIMARY KEY(user_id,user_name,user_email)";
		mysqli_query($con,$COMPOSITE_KEY);

		$UNIQUE_KEY = "ALTER TABLE `users` ADD UNIQUE(user_id,user_email)";
		mysqli_query($con,$UNIQUE_KEY);


		$AUTO_USERS = "ALTER TABLE `users` CHANGE `user_id` `user_id` int(11) AUTO_INCREMENT";
		mysqli_query($con,$AUTO_USERS);
	}
	
	$Users_Chat_Table_Search 	=	"SELECT * FROM `paigham`.users_chat"; 
	$Search2 					= 	mysqli_query($con,$Users_Chat_Table_Search);

	if(!$Search2)
	{
		$Users_Chat_Table_Query = "CREATE TABLE `users_chat`(`msg_id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY, `sender_username` varchar(255) NOT NULL, `receiver_username` varchar(255) NOT NULL, `msg_content` text, `msg_status` varchar(255) NOT NULL DEFAULT 'Unread',`msg_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP)";
		mysqli_query($con,$Users_Chat_Table_Query);
	}	




?>