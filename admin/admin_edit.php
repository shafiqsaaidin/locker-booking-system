<?php
  session_start();
  require 'session.php';
  include 'navbar.php';
  require '../model/db.php';

  $msg = $msgClass = '';

  // handle the get request base on user id
  if (isset($_REQUEST['id'])) {
    $id = mysqli_real_escape_string($conn, $_REQUEST['id']);
    $sql = "SELECT * FROM `admin` WHERE `admin_id`='$id'";
    $result = mysqli_query($conn, $sql);

    $row = mysqli_fetch_array($result);
  }

  // Check for submit
  if (filter_has_var(INPUT_POST, 'submit')){
    // Get form data
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Check required fields
    if (!empty($id) && !empty($username) && !empty($email) && !empty($phone) && !empty($password)){
      // pass
      // Hashing the password
      $hashedPwd = password_hash($_POST['password'], PASSWORD_DEFAULT);
      // var_dump($hashedPwd);

      // Insert user into database
      $sql = "UPDATE `admin` SET admin_id='$id', admin_username='$username', admin_email='$email', admin_phone='$phone', admin_password='$hashedPwd' WHERE admin_id='$id'";

      if (mysqli_query($conn, $sql)){
        $msg = "Update Successfull";
        $msgClass = "green";
      } else {
        $msg = "Update error: " . $sql . "<br>" . mysqli_error($conn);
        $msgClass = "red";
      }
    } else {
      // failed
      $msg = "Please fill in all fields";
      $msgClass = "red";
    }
  }

  mysqli_close($conn);
?>
<div class="wrapper">
  <section class="section">
    <div class="container2">
      <?php if($msg != ''): ?>
        <div id="msgBox" class="card-panel <?php echo $msgClass; ?>">
          <span class="white-text"><?php echo $msg; ?></span>
        </div>
      <?php endif ?>
      <h5><i class="fas fa-edit"></i> Edit user <span class="blue-text"><?php echo $row['admin_id']; ?></span></h5>
      <div class="divider"></div><br><br>

      <!-- Locker edit form  -->
      <form class="col s12" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" novalidate>
        <div class="row">
          <div class="input-field">
            <i class="material-icons prefix">credit_card</i>
            <input type="text" id="id" name="id" value="<?php echo $row['admin_id']; ?>">
            <label for="id">Admin Id</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field">
            <i class="material-icons prefix">face</i>
            <input type="text" id="uname" name="username" value="<?php echo $row['admin_username']; ?>">
            <label for="uname">Username</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field">
            <i class="material-icons prefix">email</i>
            <input type="email" id="email" name="email" value="<?php echo $row['admin_email']; ?>">
            <label for="email">Email</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field">
            <i class="material-icons prefix">local_phone</i>
            <input type="text" id="phone" name="phone" value="<?php echo $row['admin_phone']; ?>">
            <label for="phone">Phone</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field">
            <i class="material-icons prefix">lock</i>
            <input type="password" id="password" name="password">
            <label for="userid">New password</label>
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
  include 'footer.php';
?>
