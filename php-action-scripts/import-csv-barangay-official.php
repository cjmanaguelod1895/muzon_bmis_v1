<?php

//fetch.php

if(!empty($_FILES['csv_file']['name']))
{
 $file_data = fopen($_FILES['csv_file']['tmp_name'], 'r');
 $column = fgetcsv($file_data);
 while($row = fgetcsv($file_data))
 {
  $row_data[] = array(
   'Position'  => $row[0],
   'Name'  => $row[1],
   'Contact'  => $row[2],
   'Address'  => $row[3],
   'Startof Term'  => $row[4],
   'End of Term'  => $row[5],
   'Status'  => $row[6],

  );
 }
 $output = array(
  'column'  => $column,
  'row_data'  => $row_data
 );

 echo json_encode($output);


 
}

if (isset($_POST['cjmanaguelod'])) {
    $dados = json_encode($_POST['cjmanaguelod'], true);
    print json_encode(['successo' => true]);
}







?>



