<?php 
	
	$room = null;
	$joinname = null;
	$headText = "";
	if (!empty($_POST['username']))
	{
		$username = $_POST['username'];
		$phonenumber = $_POST['phonenumber'];
		$email = $_POST['email'];
		
		
		$servername = "localhost";
		$dbusername = "SWCS_UK_AP_USER";
		$dbpassword = "unfold*mystries%";
		$dbname = "chat";

		// Create connection
		$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 
		$sql = "INSERT INTO `users` (`username`,`phonenumber`,`email`) VALUES ( '$username','$phonenumber','$email');" ;
		$conn->query($sql) ;
		$user_id = $conn->insert_id;
		
		$data = ['username'=>$username,"user_id"=>$user_id,'agentname'=>'gbdm'] ;
		echo json_encode($data) ; die ;
	}
	else
	{
		var_dump("Who are you?");
		die();
	}
	
?>