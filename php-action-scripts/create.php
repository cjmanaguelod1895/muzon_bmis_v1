<?php
//Include DB connection
include ('../database/db_config.php');
$db=$conn;// database connection  

if (isset($_POST['createNewUser'])) {

  $createNewUserData = json_decode($_POST['createNewUser'], true);


// //legal input values
 $official_ID  = legal_input($createNewUserData['official_ID']);
 $position  = legal_input($createNewUserData['position']);
 $username = legal_input($createNewUserData['username']);
 $password   = legal_input($createNewUserData['password']);
 $conpassword  = legal_input($createNewUserData['conpassword']);
 $Commitee  = legal_input($createNewUserData['commitee']);

// //Convert TermStart and TermEnd date
// $date1 = strtotime($termStart);
// $date2 = strtotime($termEnd);


// $convertedTermStart = date('Y-m-d',$date1);
// $convertedTermEnd = date('Y-m-d',$date2);

 
   
// if(!empty($sPosition) && !empty($completeName) && !empty($pcontact) && !empty($paddress) && !empty($termStart)
// && !empty($termEnd)){
//     //  Sql Query to insert user data into database table
//     insert_data($sPosition, $completeName,$pcontact,$paddress,$convertedTermStart, $convertedTermEnd);
// }else{
//  echo "All fields are required";
// }

//query for checking user is exist
$sql = mysqli_query($conn,"SELECT * FROM `user_account` WHERE  acc_username = '$username'");
//count user if exist
$check = mysqli_num_rows($sql);
if ($check > 0) {
  $response = array(
    'actionType' => 'usernameIsTaken',
    'msg' => 'Username is already taken!'
    );
}
//else add new
else{
  // password  match do this
    if ($password == $conpassword) {
    if ($Commitee == 1 and $position == 10) {
      $pos =  $Commitee;
    }
    else{
        $pos = $position;
    }
    $new_password = password_hash($conpassword, PASSWORD_DEFAULT);
    $sql = mysqli_query($conn,"INSERT INTO 
      `user_account` (`acc_ID`,`official_ID`,`position_ID`,`acc_username`,`acc_password`,`status_ID`,`acc_created`) VALUES (
      NULL,
       '$official_ID',
        '$pos',
         '$username',
          '$new_password',
           '1',
            CURRENT_TIMESTAMP)");
          
                                $response = array(
                                  'actionType' => 'success',
                                  'msg' => 'New user successfully saved.'
                                  );
  }
  // password not match alert this 
  else{
 
                                $response = array(
                                  'actionType' => 'passwordNotMatch',
                                  'msg' => 'Password did not match!'
                                  );
  }
}
echo json_encode($response);




}

// convert illegal input value to ligal value formate
function legal_input($value) {
  $value = trim($value);
  $value = stripslashes($value);
  $value = htmlspecialchars($value);
  return $value;
}

?>
