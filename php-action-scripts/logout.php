<?php
session_start();
session_destroy();
  unset($_SESSION['username']); 
 
  header('Location: /bmis_v1/login.php');
?>