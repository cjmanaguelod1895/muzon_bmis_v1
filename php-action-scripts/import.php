<?php
  // user exists
  session_start();
//Include DB connection
 include ('../database/db_config.php');

 header("Content-Type:application/json");

if (isset($_POST['cjmanaguelod'])) {
    $dados = json_encode($_POST['cjmanaguelod'], true);
    print json_encode(['successo' => true]);
}


?>

