<?php

$largestNumber= $rid= "";
                           $rowSQL = mysqli_query($conn, "SELECT MAX( res_ID ) AS max FROM `resident_detail`;" );
                                  $row = mysqli_fetch_array( $rowSQL );
                                  $largestNumber = $row['max'];
                                    $rid= $largestNumber+1;

                                  ?>

                <?php

$largest_address= $aid= "";
                           $rowSQL = mysqli_query($conn, "SELECT MAX( address_ID ) AS max FROM `resident_address`;" );
                                  $row = mysqli_fetch_array( $rowSQL );
                                  $largest_address= $row['max'];
                                    $aid= $largest_address+1;

                                  ?>

                    <?php

$largest_contact= $cid= "";
                           $rowSQL = mysqli_query($conn, "SELECT MAX( contact_ID ) AS max FROM `resident_contact`;" );
                                  $row = mysqli_fetch_array( $rowSQL );
                                  $largest_contact= $row['max'];
                                    $cid= $largest_contact+1;

                                  ?>

                        <?php
$res_fname = $res_mname = $res_lname = $res_suffix = $res_gender = $res_bdate = $res_bdate = $res_civilstatus= $res_contactnum =$res_id = $res_contacttype = $res_religion = $res_occupationstatus= $res_occupation =$res_height= $res_weight= $res_citizenship=  $res_houseno=   $res_purokno= $res_region= $res_address= $res_brgy="" ;

 $res_building= $res_lot= $res_block= $res_phase=$res_street =$res_subd= "";

 $res_unit=  "0";     

$isuffix= $igender= $icstatus = $ictype= $irel= $ioccst= $iocc= $iciti= $ipurok=$iadd= $ibrgy="" ;

  if ($_SERVER["REQUEST_METHOD"]== "POST"){
$res_fname=$_POST["res_fname"];
        }

 if ($_SERVER["REQUEST_METHOD"]== "POST"){
$res_mname=$_POST["res_mname"];
        }

 if ($_SERVER["REQUEST_METHOD"]== "POST"){
$res_lname=$_POST["res_lname"];
        }

 if ($_SERVER["REQUEST_METHOD"]== "POST"){
     $isuffix=$_POST["res_suffix"];
       }

        if ($_SERVER["REQUEST_METHOD"]== "POST"){
             $suffix= "";
                        $rows = mysqli_query($conn, "SELECT suffix_ID  FROM `ref_suffixname` where suffix = '$isuffix';" );
                                  $row = mysqli_fetch_array( $rows );
                                  $suffix = $row['suffix_ID'];
             $res_suffix=$suffix;
        }

if ($_SERVER["REQUEST_METHOD"]== "POST"){
     $igender=$_POST["res_gender"];
       }

        if ($_SERVER["REQUEST_METHOD"]== "POST"){
             $gender= "";
                        $rows = mysqli_query($conn, "SELECT gender_ID  FROM `ref_gender` where gender_Name = '$igender';" );
                                  $row = mysqli_fetch_array( $rows );
                                  $gender = $row['gender_ID'];
             $res_gender=$gender;
        }

 if ($_SERVER["REQUEST_METHOD"]== "POST"){
$res_bdate=$_POST["res_bdate"];
        }

if ($_SERVER["REQUEST_METHOD"]== "POST"){
     $icstatus=$_POST["res_civilstatus"];
       }

        if ($_SERVER["REQUEST_METHOD"]== "POST"){
             $cstatus= "";
                        $rows = mysqli_query($conn, "SELECT marital_ID  FROM `ref_marital_status` where marital_Name = '$icstatus';" );
                                  $row = mysqli_fetch_array( $rows );
                                  $cstatus = $row['marital_ID'];
             $res_civilstatus=$cstatus;
        }

 if ($_SERVER["REQUEST_METHOD"]== "POST"){
$res_contactnum=$_POST["res_contactnum"];
        }

if ($_SERVER["REQUEST_METHOD"]== "POST"){
     $ictype=$_POST["res_contacttype"];
       }

        if ($_SERVER["REQUEST_METHOD"]== "POST"){
             $ctype= "";
                        $rows = mysqli_query($conn, "SELECT contactType_ID  FROM `ref_contact` where contactType_Name = '$ictype';" );
                                  $row = mysqli_fetch_array( $rows );
                                  $ctype = $row['contactType_ID'];
             $res_contacttype=$ctype;
        }

if ($_SERVER["REQUEST_METHOD"]== "POST"){
     $irel=$_POST["res_religion"];
       }

        if ($_SERVER["REQUEST_METHOD"]== "POST"){
             $relig= "";
                        $rows = mysqli_query($conn, "SELECT religion_ID  FROM `ref_religion` where religion_name = '$irel';" );
                                  $row = mysqli_fetch_array( $rows );
                                  $relig = $row['religion_ID'];
             $res_religion= $relig;
        }

if ($_SERVER["REQUEST_METHOD"]== "POST"){
     $ioccst=$_POST["res_occupationstatus"];
       }

        if ($_SERVER["REQUEST_METHOD"]== "POST"){
          if ($ioccst == "NULL") {
            $occst= NULL;
          }
          else{

             $occst= "";
                        $rows = mysqli_query($conn, "SELECT occuStat_ID  FROM `ref_occupation_status` where occuStat_Name = '$ioccst';" );
                                  $row = mysqli_fetch_array( $rows );
                                  $occst = $row['occuStat_ID'];
             $res_occupationstatus=$occst;
          }
        }

if ($_SERVER["REQUEST_METHOD"]== "POST"){
     $iocc=$_POST["res_occupation"];
       }

        if ($_SERVER["REQUEST_METHOD"]== "POST"){
             $occ= "";
                        $rows = mysqli_query($conn, "SELECT occupation_ID  FROM `ref_occupation` where occupation_Name = '$iocc';" );
                                  $row = mysqli_fetch_array( $rows );
                                  $occ = $row['occupation_ID'];
             $res_occupation=$occ;
        }

 if ($_SERVER["REQUEST_METHOD"]== "POST"){
$res_height=$_POST["res_height"];
        }

 if ($_SERVER["REQUEST_METHOD"]== "POST"){
$res_weight=$_POST["res_weight"];
        }

if ($_SERVER["REQUEST_METHOD"]== "POST"){
     $iciti=$_POST["res_citizenship"];
       }

        if ($_SERVER["REQUEST_METHOD"]== "POST"){
             $citi= "";
                        $rows = mysqli_query($conn, "SELECT country_ID  FROM `ref_country` where country_citizenship = '$iciti';" );
                                  $row = mysqli_fetch_array( $rows );
                                  $citi= $row['country_ID'];
             $res_citizenship= $citi;
        }

  if ($_SERVER["REQUEST_METHOD"]== "POST"){
$res_unit=$_POST["res_unit"];
        }

if ($_SERVER["REQUEST_METHOD"]== "POST"){
$res_building=$_POST["res_building"];
        }

 if ($_SERVER["REQUEST_METHOD"]== "POST"){
$res_lot=$_POST["res_lot"];
        }

 if ($_SERVER["REQUEST_METHOD"]== "POST"){
$res_block=$_POST["res_block"];
        }

 if ($_SERVER["REQUEST_METHOD"]== "POST"){
$res_phase=$_POST["res_phase"];
        }

if ($_SERVER["REQUEST_METHOD"]== "POST"){
$res_houseno=$_POST["res_houseno"];
        } 

if ($_SERVER["REQUEST_METHOD"]== "POST"){
$res_street=$_POST["res_street"];
        }

 if ($_SERVER["REQUEST_METHOD"]== "POST"){
$res_subd=$_POST["res_subd"];
        }

if ($_SERVER["REQUEST_METHOD"]== "POST"){
     $ipurok=$_POST["res_purokno"];
       }

        if ($_SERVER["REQUEST_METHOD"]== "POST"){
             $purok= "";
             $region= "";
                        $rows = mysqli_query($conn, "SELECT purok_ID,region_Code  FROM `ref_purok` where purok_Name = '$ipurok';" );
                                  $row = mysqli_fetch_array( $rows );
                                  $purok = $row['purok_ID'];
                                  $region = $row['region_Code'];

             $res_purokno=$purok;

             $res_region=$region;
        }

if ($_SERVER["REQUEST_METHOD"]== "POST"){
     $iadd=$_POST["res_address"];
       }

        if ($_SERVER["REQUEST_METHOD"]== "POST"){
             $address= "";
                        $rows = mysqli_query($conn, "SELECT addressType_ID  FROM `ref_address` where addressType_Name = '$iadd';" );
                                  $row = mysqli_fetch_array( $rows );
                                  $address= $row['addressType_ID'];
             $res_address= $address;
        }

if ($_SERVER["REQUEST_METHOD"]== "POST"){
 $file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
}
?>

                            <?php

If($rid &&$res_fname  && $res_lname && $res_suffix && $res_gender && $res_bdate && $res_civilstatus && $res_religion && $res_religion && $res_occupationstatus && $res_occupation && $res_height && $res_weight && $res_citizenship){

        $query=mysqli_query($conn,"INSERT INTO resident_detail(res_ID,res_Img, 
res_fName, res_mName,res_lName,suffix_ID, gender_ID, res_Bday, marital_ID,religion_ID,res_Height,res_Weight, occuStat_ID,occupation_ID,country_ID) VALUES('$rid','$file','$res_fname','$res_mname','$res_lname','$res_suffix','$res_gender','$res_bdate','$res_civilstatus','$res_religion','$res_height', '$res_weight','$res_occupationstatus','$res_occupation','$res_citizenship') ");
    echo "<script type='text/javascript'>alert('submitted successfully!')</script>";

        if ($res_contactnum && $rid && $res_contacttype && $res_citizenship){
             $query=mysqli_query($conn,"INSERT INTO resident_contact(contact_ID,contact_telnum,res_ID,contactType_ID,country_ID) VALUES('$cid','$res_contactnum','$rid','$res_contacttype','$res_citizenship') ");

        }

          if ( $rid ){
             $query=mysqli_query($conn,"INSERT INTO resident_address(address_ID,address_Unit_Room_Floor_num,res_ID,address_BuildingName,address_Lot_No,address_Block_No,address_Phase_No,address_House_No,address_Street_Name,address_Subdivision,country_ID,purok_ID,region_ID,addressType_ID) VALUES('$aid','$res_unit','$rid','$res_building',' $res_lot',' $res_block','$res_phase','$res_houseno','$res_street','$res_subd','$res_citizenship','$res_purokno','$res_region','$res_address') ");

        }

    header('Location: resident.php');

    }

?>