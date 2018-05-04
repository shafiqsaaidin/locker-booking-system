<?php 
  $serverName = "localhost";
  $userName = "root";
  $password = "";
  $database = "smart_tagging_system";

  // Create connection
  $conn = mysqli_connect($serverName, $userName, $password, $database);

  // Check Connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  // echo "Connected successfully";
?>