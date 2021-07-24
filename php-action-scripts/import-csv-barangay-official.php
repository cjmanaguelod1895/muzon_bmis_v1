<?php
//Include DB connection
include ('../database/db_config.php');

if(!empty($_FILES['csv_file']['name']))
{
 $file_data = fopen($_FILES['csv_file']['tmp_name'], 'r');
 $column = fgetcsv($file_data);
 while($row = fgetcsv($file_data))
 {
  $row_data[] = array(
   'barangay_id'  => $row[0],
   'sPosition'  => $row[1],
   'completeName'  => $row[2],
   'pcontact'  => $row[3],
   'paddress'  => $row[4],
   'termStart'  => $row[5],
   'termEnd'  => $row[6],
   'status'  => $row[7],

  );
 }
 $output = array(
  'column'  => $column,
  'row_data'  => $row_data
 );

 echo json_encode($output);

 
}

if (isset($_POST['excelData'])) {

    $response = array(
        'status' => 1,
        'msg' => 'Data has been upload.'
      );

    $array = json_decode($_POST['excelData'], true);
    foreach ($array as $row) {

        $query = "SELECT  EXISTS(SELECT 1 from tblofficial where barangay_id='".$row["barangay_id"]."');";

     
        $test1 = strtotime($row["termStart"]);
        $test2 = strtotime($row["termEnd"]);
       
        $convertedTermStart = date('Y-m-d',$test1);
        $convertedTermEnd = date('Y-m-d',$test2);
        

        $r1=mysqli_fetch_row(mysqli_query($conn, $query));

        if (current($r1) == 0) {
            $insert = "INSERT INTO tblofficial(barangay_id,sPosition, completeName, pcontact, paddress, termStart, termEnd, status ) VALUES ('".$row["barangay_id"]."','".$row["sPosition"]."', '".$row["completeName"]."', '".$row["pcontact"]."', '".$row["paddress"]."','".$convertedTermStart."','".$convertedTermEnd."', '".$row["status"]."' )";

            $response = array(
                'status' => 1,
                'msg' => 'Data has been added.'
              );

              mysqli_query($conn, $insert); 
        } 
        else {

            $update = "UPDATE tblofficial 
            SET  sPosition = '".$row['sPosition']."',
            completeName = '".$row["completeName"]."',
            pcontact = '".$row["pcontact"]."',
            paddress = '".$row["paddress"]."',
            termStart = '$convertedTermStart',
            termEnd = '$convertedTermEnd',
            status = '".$row["status"]."'
            WHERE barangay_id = '".$row["barangay_id"]."'"; 
            $response = array(
             'status' => 1,
             'msg' => 'Data has been updated.'
           );
        
           mysqli_query($conn, $update);

        }
        
    }

   echo json_encode($response);

    
}

?>
