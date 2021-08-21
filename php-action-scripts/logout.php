<?php

if (isset($_POST['logout'])) {

require_once('../database/db_config.php');

session_start();
// Redirecting To Home Page
session_destroy(); // Destroying All Sessions
// unset($_SESSION['user_session']);
// header('Location: /bmis_v1/login.php');

$response = array(
  'actionType' => 'success',
  'msg' => 'Successfully Logged out',
  );

}

echo json_encode($response);

?>
