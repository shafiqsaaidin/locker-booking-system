<?php
  session_start();
  require 'session.php';
  include 'navbar.php';
  require '../model/db.php';

  $msg = $msgClass = '';

  // handle the get request base on user id
  if (isset($_REQUEST['id'])) {
    $id = mysqli_real_escape_string($conn, $_REQUEST['id']);
    $sql = "SELECT * FROM `locker` WHERE `locker_id`='$id'";
    $result = mysqli_query($conn, $sql);

    $row = mysqli_fetch_array($result);
  }

  if (isset($_POST['submit'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);

    $sql = "UPDATE `locker` SET locker_id='$id', locker_status='$status', locker_price='$price' WHERE locker_id='$id'";
    if (mysqli_query($conn, $sql)) {
      $msg = "<a href='locker.php' class='white-text'><i class='fas fa-arrow-circle-left'></i></a> Update Successfull";
      $msgClass = "green";
    } else {
      $msg = "Update error: " . $sql . "<br>" . mysqli_error($conn);
      $msgClass = "red";
    }
  }
?>
<div class="wrapper">
  <section class="section">
    <div class="container2">
      <?php if($msg != ''): ?>
        <div id="msgBox" class="card-panel <?php echo $msgClass; ?>">
          <span class="white-text"><?php echo $msg; ?></span>
        </div>
      <?php endif ?>
      <h5><i class="fas fa-edit"></i> Edit locker <?php echo $row['locker_id']; ?></h5>
      <div class="divider"></div><br><br>

      <!-- Locker edit form  -->
      <form class="col s12" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" novalidate>
        <div class="row">
          <div class="input-field col s12">
            <input type="text" id="id" name="id" value="<?php echo $row['locker_id']; ?>">
            <label for="id">Locker id</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <select name="status">
              <option value="<?php echo $row['locker_status']; ?>" disabled selected><?php echo $row['locker_status']; ?></option>
              <option value="Available">Available</option>
              <option value="Booked">Booked</option>
              <option value="Damage">Damage</option>
            </select>
            <label>Status</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <input id="price" type="text" name="price" value="<?php echo $row['locker_price']; ?>">
            <label for="price">Price</label>
          </div>
        </div>
        <div class="row">
          <div class="center">
            <button type="submit" class="waves-effect waves-light btn blue" name="submit">Update</button>
          </div>
        </div>
      </form>
    </div>
  </section>
</div>
<?php
  mysqli_close($conn);
  include 'footer.php';
?>
