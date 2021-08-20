<?php
//Include DB connection
include ('../database/db_config.php');
$db=$conn;// database connection  

//Update System Setup
if (isset($_POST['updateSystemSetupDetails'])) {

  $systemUpdateData = json_decode($_POST['updateSystemSetupDetails'], true);


  $brgy_name = legal_input($systemUpdateData['brgy_name']);
  $citymun_Name = legal_input($systemUpdateData['brgy_city']);
  $province_Name = legal_input($systemUpdateData['brgy_province']);

  if(empty($brgy_name)){
    $s1 = "Null!! Please Search and Select from the table!";
  }
  else{
    $sql_sub = "UPDATE brgy_address_info SET brgy_Name='$brgy_name',
                citymun_Name='$citymun_Name', province_Name='$province_Name'
                WHERE caller_Code='setter'";
    if (mysqli_query($conn, $sql_sub)) {
        $response = array(
            'actionType' => 'success',
            'msg' => 'Record successfully updated.'
            );
  }
    else {
        $response = array(
            'actionType' => 'error',
            'msg' => 'Error Updating Records!'
            );
  }
  }
  echo json_encode($response);



}



//Get System Setup Images Images
if (isset($_POST['getSystemSetupImages'])) {

    $sql_barangayLogo = mysqli_query($conn,"SELECT * FROM `ref_logo` WHERE logo_ID = 1");
          
    $brgy_logo = mysqli_fetch_array($sql_barangayLogo);

    $sql_municipalityLogo = mysqli_query($conn,"SELECT * FROM `ref_logo` WHERE logo_ID = 2");
        
    $municipal_logo = mysqli_fetch_array($sql_municipalityLogo);



    $barangayLogo = $brgy_logo[1];
    $municipalLogo = $municipal_logo[1];

    $response = array(
        'actionType' => 'success',
        'barangay_logo' => $barangayLogo  ,
        'municipal_logo' => $municipalLogo ,
        );


    echo json_encode($response);
    
  }

  //Update Barangay Logo
if (isset($_POST['updateBarangayLogo'])) {

    $systemUpdateData = json_decode($_POST['updateBarangayLogo'], true);

    $barangayLogo = $systemUpdateData['logo_img'];

    $sql = "UPDATE `ref_logo` SET logo_img='$barangayLogo' WHERE logo_Name='Barangay Logo';";

    if (mysqli_query($conn, $sql)) 
    {
        $response = array(
            'actionType' => 'success',
            'msg' => 'Barangay Logo successfully updated.' ,
            );
        }
    else {
        $response = array(
            'actionType' => 'error',
            'msg' => 'Barangay Logo is not updated.' ,
            );
        }

   


    echo json_encode($response);
    


  }


    //Update Municipality Logo
if (isset($_POST['updateMunicipalityLogo'])) {

    $systemUpdateData = json_decode($_POST['updateMunicipalityLogo'], true);

    $municipalityLogo = $systemUpdateData['logo_img'];

    $sql = "UPDATE `ref_logo` SET logo_img='$municipalityLogo' WHERE logo_Name='Municipal Logo';";

    if (mysqli_query($conn, $sql)) 
    {
        $response = array(
            'actionType' => 'success',
            'msg' => 'Municipality Logo successfully updated.' ,
            );
        }
    else {
        $response = array(
            'actionType' => 'error',
            'msg' => 'Municipality Logo is not updated.' ,
            );
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
