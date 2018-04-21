<?php
  require "model/db.php";

  // required headers
  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");

  // get total active student
  // $sql1 = "SELECT SUM(record_sub = 'active') AS active, SUM(record_sub = 'expired') AS expired FROM record";

  // get total booked locker, available, damage
  $sql1 = "SELECT SUM(locker_status = 'available') AS available, SUM(locker_status = 'booked') AS booked, SUM(locker_status = 'damage') AS damage FROM locker";

  $sql1 = "SELECT SUM(record_sub = 'active') AS active, SUM(record_sub = 'expired') AS expired FROM record";
  $result = mysqli_query($conn, $sql1);
  while ($row = mysqli_fetch_array($result)) {
    echo $row['active'].",".$row['expired'];
  }

?>
