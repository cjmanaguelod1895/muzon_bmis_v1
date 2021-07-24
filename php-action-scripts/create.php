<?php
//Include DB connection
include ('../database/db_config.php');
$db=$conn;// database connection  

if (isset($_POST['createBarangayOfficial'])) {

  $createBarangayOfficialData = json_decode($_POST['createBarangayOfficial'], true);

//legal input values
 $firstName  = legal_input($createBarangayOfficialData['firstName']);
 $middleName = legal_input($createBarangayOfficialData['middleName']);
 $lastName   = legal_input($createBarangayOfficialData['lastName']);

 
 $middleNameChecked = strlen($middleName) <= 0 ? '' : $middleName;
 $completeName = $firstName.' '.$middleNameChecked.' ' .$lastName; 


 $sPosition  = legal_input($createBarangayOfficialData['sPosition']);
 $pcontact = legal_input($createBarangayOfficialData['pcontact']);
 $paddress = legal_input($createBarangayOfficialData['paddress']);
 $termStart= $createBarangayOfficialData['termStart'];
 $termEnd  = $createBarangayOfficialData['termEnd'];

//Convert TermStart and TermEnd date
$date1 = strtotime($termStart);
$date2 = strtotime($termEnd);


$convertedTermStart = date('Y-m-d',$date1);
$convertedTermEnd = date('Y-m-d',$date2);

 
   
if(!empty($sPosition) && !empty($completeName) && !empty($pcontact) && !empty($paddress) && !empty($termStart)
&& !empty($termEnd)){
    //  Sql Query to insert user data into database table
    insert_data($sPosition, $completeName,$pcontact,$paddress,$convertedTermStart, $convertedTermEnd);
}else{
 echo "All fields are required";
}

}

// convert illegal input value to ligal value formate
function legal_input($value) {
  $value = trim($value);
  $value = stripslashes($value);
  $value = htmlspecialchars($value);
  return $value;
}
// // function to insert user data into database table
function insert_data($sPosition,$completeName,$pcontact, $paddress, $convertedTermStart, $convertedTermEnd){
 
  global $db;
   $query="INSERT INTO tblofficial(sPosition,completeName,pcontact,paddress,termStart, termEnd) VALUES('$sPosition','$completeName','$pcontact','$paddress','$convertedTermStart', '$convertedTermEnd' )";
  $execute=mysqli_query($db,$query);
  if($execute==true)
  {
    echo "User data was inserted successfully";
  }
  else{
   echo  "Error: " . $sql . "<br>" . mysqli_error($db);
  }
}
?>
