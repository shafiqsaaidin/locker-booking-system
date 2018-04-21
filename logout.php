<?php
  session_start();

  // Remove all session variables
  session_unset();

  if (session_destroy()){
    header("Location: login.php");
  }
?>
