<?php
  session_start();
  // require 'session.php';
  include 'navbar.php';
  require 'model/db.php';

  // if user already login redirect them to index page
  if (isset($_SESSION['s_id'])) {
    header("Location: index.php");
  }

  // Error message and class
  $msg = $msgClass = '';

  if (filter_has_var(INPUT_POST, 'submit')) {
    // Get form data
    $id = mysqli_real_escape_string($conn, $_POST['userid']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Check if inputs are empty
    if (!empty($id) && !empty($password)){
      // success
      $sql = "SELECT * FROM `student` WHERE `student_id`='$id'";
      $result = mysqli_query($conn, $sql);
      $resultCheck = mysqli_num_rows($result);
      $row = mysqli_fetch_assoc($result);

      if ($resultCheck < 1) {
        // error, id not exist
        $msg = "Invalid user Id or password";
        $msgClass = "red";
      } else {
        // dehashing the password
        $pwdCheck = password_verify($_POST['password'], $row['student_pwd']);

        if($pwdCheck == false) {
          $msg = "Invalid password";
          $msgClass = "red";
        } elseif ($pwdCheck == true) {
          $_SESSION['s_id'] = $row['student_id'];
          $_SESSION['s_username'] = $row['student_username'];
          $_SESSION['s_name'] = $row['student_name'];
          $_SESSION['s_email'] = $row['student_email'];
          $_SESSION['s_phone'] = $row['student_phone'];

          header("location: index.php");
        }
      }
    } else {
      // failed ouput an error
      $msg = "Please fill in all fields";
      $msgClass = "red";
    }

    mysqli_close($conn);
  }

?>

<!-- Login form -->
<div class="container">
  <div class="box">
    <div class="row">
      <div class="col s12 m12">
        <?php if($msg != ''): ?>
          <div id="msgBox" class="card-panel <?php echo $msgClass; ?>">
            <span class="white-text"><?php echo $msg; ?></span>
          </div>
        <?php endif ?>
        <div class="card">
          <div class="card-image">
            <img id="userimg" src="img/user.png" class="circle responsive-img">
          </div>
          <div class="card-content">
            <span class="card-title center-align">User Login</span>
            <div class="row">
              <form class="col s12" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" novalidate>
                <div class="row">
                  <div class="input-field">
                    <i class="material-icons prefix">account_circle</i>
                    <input type="text" id="userid" name="userid">
                    <label for="userid">User id</label>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field">
                      <i class="material-icons prefix">lock</i>
                    <input type="password" id="password" name="password">
                    <label for="userid">Your password</label>
                  </div>
                </div>
                <div class="row">
                  <p class="center-align">
                    New user? <a href="register.php">Register here</a><br>
                    Admin ? <a href="admin/">Login here</a><br><br>
                    <button type="submit" class="waves-effect waves-light btn blue" name="submit">Login</button>
                  </p>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end login form -->

<?php
  include 'footer.php';
?>
