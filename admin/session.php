<?php
  require '../model/db.php';

  if (!isset($_SESSION['admin_id'])){
    header("Location: login.php");
  }
?>
