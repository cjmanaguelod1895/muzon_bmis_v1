<?php
session_start(); // Starting Session
include ('../database/db_config.php');
$error=''; // Variable To Store Error Message
if (isset($_POST['action']) == 'login') {
		if (empty($_POST['username']) || empty($_POST['password'])) 
			{
				$response = array(
					'status' => 0,
					'msg' => 'Username or Password is empty!'
					);

			
			}
		else
		{
			// Establishing Connection with Server by passing server_name, user_id and password as a parameter
			// Define $username and $password
			$username=$_POST['username'];
			$password=$_POST['password'];

			// To protect MySQL injection for Security purpose
			$username = stripslashes($username);
			$password = stripslashes($password);
			$username = mysqli_real_escape_string($conn,$username);
			$password = mysqli_real_escape_string($conn,$password);

			// SQL query to fetch information of registerd users and finds user match.
			$query = mysqli_query($conn,"SELECT * FROM `user_account` WHERE `acc_username` = '$username' AND `status_ID` = 1");
			$data = mysqli_fetch_array($query);

			if(isset($data['acc_password']))
			{
				if(password_verify($password, $data['acc_password']))
				{
					$_SESSION['user_session'] = $data['acc_ID'];
					$_SESSION['official_ID'] = $data['official_ID'];
					$sql = mysqli_query($conn,"SELECT * FROM `brgy_official_detail` bod 
						inner join ref_position rp ON rp.position_ID = bod.commitee_assignID   
						WHERE bod.official_ID = ".$data['official_ID']."");
					$bod = mysqli_fetch_array($sql);
					$_SESSION['position'] = $bod['position_Name'];
					$_SESSION['position_ID']  = $bod['commitee_assignID'];
					
					$response = array(
						'status' => 1,
						'position_name' => $bod['position_Name']
						);

					

				}
				else
				{

					print "<script>alert("+ $_SERVER['DOCUMENT_ROOT'] +") </script>";

					$response = array(
						'status' => 0,
						'msg' => 'Incorrect Username or Password!'
						);
				}
			}
			else 
			{
				$response = array(
					'status' => 0,
					'msg' => 'Incorrect Username or Password!'
					);
			}
			mysqli_close($conn); // Closing Connection
		}

		echo json_encode($response);
}
?>

