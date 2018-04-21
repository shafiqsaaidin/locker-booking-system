<?php
  require 'session.php';
  include 'navbar.php';
  require_once 'model/db.php';

  $msg = $msgClass = '';

  // handle the get request base on user id
  if (isset($_REQUEST['id'])) {
    $id = mysqli_real_escape_string($conn, $_REQUEST['id']);
    $sql = "SELECT * FROM `locker` WHERE `locker_id`='$id'";
    $result = mysqli_query($conn, $sql);

    $row = mysqli_fetch_array($result);

    $_SESSION['locker_id'] = $row['locker_id'];
    $_SESSION['locker_price'] = $row['locker_price'];
  }

  // Process booked locker and insert into database
  if (filter_has_var(INPUT_POST, 'book')) {
    $start = mysqli_real_escape_string($conn, $_POST['start']);
    $end = mysqli_real_escape_string($conn, $_POST['end']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $sid = mysqli_real_escape_string($conn, $_POST['studentid']);
    $lid = mysqli_real_escape_string($conn, $_POST['lockerid']);
    $file = $_FILES['item'];

    $fileName = $_FILES['item']['name'];
    $fileTmpName = $_FILES['item']['tmp_name'];
    $fileSize = $_FILES['item']['size'];
    $fileError = $_FILES['item']['error'];
    $fileType = $_FILES['item']['type'];

    $fileExt = explode('.', $fileName);
    $fileActulExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png');

    if (in_array($fileActulExt, $allowed)) {
      if ($fileError === 0 ) {
        if ($fileSize < 500000) {
          $fileNameNew = uniqid('', true).".".$fileActulExt;
          $fileDestination = 'img/uploads/'.$fileNameNew;

          $sql = "INSERT INTO `record` (record_start, record_end, record_price, record_item, student_id, locker_id)
          VALUES ('$start', '$end', '$price', '$fileDestination', '$sid', '$lid');";
          $sql .= "UPDATE `locker` SET locker_status='Booked' WHERE locker_id='$lid'";

          $result = mysqli_multi_query($conn, $sql);
          if ($result) {
            do {
              // grab the result of the next query
              if (($result = mysqli_store_result($conn)) === false && mysqli_error($conn) !='') {
                // echo "Query failed: " . mysqli_error($mysqli);
              }
            } while (mysqli_more_results($conn) && mysqli_next_result($conn));
            move_uploaded_file($fileTmpName, $fileDestination);
            $msg = "<a href='index.php' class='white-text'><i class='fas fa-arrow-circle-left'></i></a> Booking success";
            $msgClass = "green";
          } else {
            // echo "First query failed..." . mysqli_error($conn);
          }

        } else {
          $msg = "Your file is too big!";
          $msgClass = "red";
        }
      } else {
        $msg = "There was an arror uploading your file!";
        $msgClass = "red";
      }
    }
  }
  mysqli_close($conn);

?>
<section class="section">
  <div class="container">
    <h5><i class="fab fa-wpforms"></i> Booking information</h5>
    <div class="divider"></div><br>
    <?php if($msg != ''): ?>
      <div class="card-panel <?php echo $msgClass; ?>">
        <span class="white-text"><?php echo $msg; ?></span>
      </div>
    <?php endif ?>
    <form enctype="multipart/form-data" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="card-panel">
      <div class="row">
        <div class="input-field col s6 m6">
          <input readonly type="text" id="lockerid" name="lockerid" value="<?php echo $_SESSION['locker_id']; ?>">
          <label for="id">Locker id</label>
        </div>
        <div class="input-field col s6 m6">
          <input readonly type="text" id="studentid" name="studentid" value="<?php echo $_SESSION['s_id']; ?>">
          <label for="id">Student id</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6 m6">
          <input id="start" type="text" class="datepicker" name="start">
          <label for="start">Start date</label>
        </div>
        <div class="input-field col s6 m6">
          <input id="end" type="text" class="datepicker" name="end">
          <label for="end">End date</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6 m6">
          <input readonly type="text" id="price" name="price" value="<?php echo $_SESSION['locker_price']; ?>">
          <label for="price">Locker Price (RM)</label>
        </div>
        <div class="input-field file-field col s6 m6">
          <div class="btn blue">
            <span>Picture</span>
            <input type="file" name="item">
          </div>
          <div class="file-path-wrapper">
            <input class="file-path validate" type="text">
          </div>
        </div>
      </div>
      <div class="center">
        <a href="index.php" class="btn btn-flat">Cancel</a>
        <button type="submit" name="book" class="btn green">Book now</button>
      </div>
    </form>
  </div>
</section>
<?php
  include 'footer.php';
?>
