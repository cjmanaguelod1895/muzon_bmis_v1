<?php
//Include DB connection
include ('../database/db_config.php');
$db=$conn;// database connection  

#region Create New User
if (isset($_POST['createNewUser'])) {

  $createNewUserData = json_decode($_POST['createNewUser'], true);


// //legal input values
 $official_ID  = legal_input($createNewUserData['official_ID']);
 $position  = legal_input($createNewUserData['position']);
 $username = legal_input($createNewUserData['username']);
 $password   = legal_input($createNewUserData['password']);
 $conpassword  = legal_input($createNewUserData['conpassword']);
 $Commitee  = legal_input($createNewUserData['commitee']);


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
#endregion




#region Create New Resident
if (isset($_POST['createNewResident'])) {

  $createNewResidentData = json_decode($_POST['createNewResident'], true);


  
//legal input values
 $res_fname  = legal_input($createNewResidentData['res_fname']);
 $res_mname  = legal_input($createNewResidentData['res_mname']);
 $res_lname  = legal_input($createNewResidentData['res_lname']);
 $res_suffix = legal_input($createNewResidentData['res_suffix']);
 $res_gender   = legal_input($createNewResidentData['res_gender']);
 $res_bdate  = legal_input($createNewResidentData['res_bdate']);
 $res_civilstatus  = legal_input($createNewResidentData['res_civilstatus']);
 $res_contacttype  = legal_input($createNewResidentData['res_contacttype']);
 $res_contactnum  = legal_input($createNewResidentData['res_contactnum']);
 $res_address = legal_input($createNewResidentData['res_address']);
 $res_purokno   = legal_input($createNewResidentData['res_purokno']);
 $res_unit  = legal_input($createNewResidentData['res_unit']);
 $res_building  = legal_input($createNewResidentData['res_building']);
 $res_lot  = legal_input($createNewResidentData['res_lot']);
 $res_block  = legal_input($createNewResidentData['res_block']);
 $res_phase  = legal_input($createNewResidentData['res_phase']);
 $res_houseno = legal_input($createNewResidentData['res_houseno']);
 $res_street   = legal_input($createNewResidentData['res_street']);
 $res_subd  = legal_input($createNewResidentData['res_subd']);
 $res_height  = legal_input($createNewResidentData['res_height']);
 $res_citizenship  = legal_input($createNewResidentData['res_citizenship']);
 $res_religion  = legal_input($createNewResidentData['res_religion']);
 $res_occupationstatus = legal_input($createNewResidentData['res_occupationstatus']);
 $res_occupation   = legal_input($createNewResidentData['res_occupation']);
 $res_weight  = legal_input($createNewResidentData['res_weight']);
 $res_img  = $createNewResidentData['res_img'];




$largestNumber= $rid= "";
$rowSQL = mysqli_query($conn, "SELECT MAX( res_ID ) AS max FROM `resident_detail`;" );
$row = mysqli_fetch_array( $rowSQL );
$largestNumber = $row['max'];
$rid= $largestNumber+1;

$largest_address= $aid= "";
$rowSQL = mysqli_query($conn, "SELECT MAX( address_ID ) AS max FROM `resident_address`;" );
$row = mysqli_fetch_array( $rowSQL );
$largest_address= $row['max'];
$aid= $largest_address+1;

$largest_contact= $cid= "";
$rowSQL = mysqli_query($conn, "SELECT MAX( contact_ID ) AS max FROM `resident_contact`;" );
$row = mysqli_fetch_array( $rowSQL );
$largest_contact= $row['max'];
$cid= $largest_contact+1;




$query=mysqli_query($conn,"INSERT INTO resident_detail(res_ID,res_Img, 
res_fName, res_mName,res_lName,suffix_ID, gender_ID, res_Bday, marital_ID,religion_ID,res_Height,res_Weight, occuStat_ID,occupation_ID,country_ID) VALUES('$rid','$res_img','$res_fname','$res_mname','$res_lname','$res_suffix','$res_gender','$res_bdate','$res_civilstatus','$res_religion','$res_height', '$res_weight','$res_occupationstatus','$res_occupation','$res_citizenship') ");


$query=mysqli_query($conn,"INSERT INTO resident_contact(contact_ID,contact_telnum,res_ID,contactType_ID,country_ID) VALUES('$cid','$res_contactnum','$rid','$res_contacttype','$res_citizenship') ");


$query=mysqli_query($conn,"INSERT INTO resident_address(address_ID,address_Unit_Room_Floor_num,res_ID,address_BuildingName,address_Lot_No,address_Block_No,address_Phase_No,address_House_No,address_Street_Name,address_Subdivision,country_ID,purok_ID,region_ID,addressType_ID) VALUES('$aid','$res_unit','$rid','$res_building',' $res_lot',' $res_block','$res_phase','$res_houseno','$res_street','$res_subd','$res_citizenship','$res_purokno',4,'$res_address') ");

if ($query) {
  $response = array(
    'actionType' => 'success',
    'msg' => 'New resident successfully added'
    );
}
else{
  $response = array(
    'actionType' => 'error',
    'msg' => 'Something went wrong!'
    );
}






// //query for checking user is exist
// $sql = mysqli_query($conn,"SELECT * FROM `user_account` WHERE  acc_username = '$username'");
// //count user if exist
// $check = mysqli_num_rows($sql);
// if ($check > 0) {
//   $response = array(
//     'actionType' => 'usernameIsTaken',
//     'msg' => 'Username is already taken!'
//     );
// }
// //else add new
// else{
//   // password  match do this
//     if ($password == $conpassword) {
//     if ($Commitee == 1 and $position == 10) {
//       $pos =  $Commitee;
//     }
//     else{
//         $pos = $position;
//     }
//     $new_password = password_hash($conpassword, PASSWORD_DEFAULT);
//     $sql = mysqli_query($conn,"INSERT INTO 
//       `user_account` (`acc_ID`,`official_ID`,`position_ID`,`acc_username`,`acc_password`,`status_ID`,`acc_created`) VALUES (
//       NULL,
//        '$official_ID',
//         '$pos',
//          '$username',
//           '$new_password',
//            '1',
//             CURRENT_TIMESTAMP)");
          
//                                 $response = array(
//                                   'actionType' => 'success',
//                                   'msg' => 'New user successfully saved.'
//                                   );
//   }
//   // password not match alert this 
//   else{
 
//                                 $response = array(
//                                   'actionType' => 'passwordNotMatch',
//                                   'msg' => 'Password did not match!'
//                                   );
//   }
// }
echo json_encode($response);

}
#endregion




// convert illegal input value to ligal value formate
function legal_input($value) {
  $value = trim($value);
  $value = stripslashes($value);
  $value = htmlspecialchars($value);
  return $value;
}




?>
