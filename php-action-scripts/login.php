<?php
  // user exists
  session_start();
//Include DB connection
 include ('../database/db_config.php');

if (isset($_POST['action']) == 'login') {

  $username = $_POST['username'];
  $password = $_POST['password'];
  // validation
  $error = array(
    'error_status' => 0
  );
  if (empty($username)) {
    $error['error_status'] = 1;
    $error['username'] = 'Username is required!';
  }
  if (empty($password)) {
    $error['error_status'] = 1;
    $error['password'] = 'Password is required!';
  }
  if ($error['error_status'] > 0) {
    echo json_encode($error);
    exit();
  }
  // if validation is successful
  $hashed_password = md5($password);
  $qry = "SELECT * from tbluser where username = '" . $username . "' and password = '" . $hashed_password . "'";
  $result = $conn->query($qry);
  $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

  $count = mysqli_num_rows($result);
  if ($count == 1) {
  
    $_SESSION['user_data'] = $row;

    $response = array(
      'status' => 1,
      'first_name' => $_SESSION['user_data']['first_name'],
      'middle_name' => $_SESSION['user_data']['middle_name'],
      'last_name' => $_SESSION['user_data']['last_name'],
      'msg' => 'Login successful',
    );
  } else {
    $response = array(
      'status' => 0,
      'msg' => 'Incorrect Username or Password.'
    );
  }
  echo json_encode($response);
  exit();
}

?>

