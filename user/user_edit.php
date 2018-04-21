<?php
  require 'session.php';
  include 'navbar.php';
  require '../model/db.php';

  $msg = $msgClass = '';

  if (isset($_REQUEST['id'])) {
    $id = mysqli_real_escape_string($conn, $_REQUEST['id']);
    $sql = "SELECT * FROM `student` WHERE `student_id`='$id'";
    $result = mysqli_query($conn, $sql);

    $row = mysqli_fetch_array($result);
  } else {
    header("Location: index.php");
  }

  // Check for submit
  if (filter_has_var(INPUT_POST, 'submit')){
    // Get form data
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $dep = mysqli_real_escape_string($conn, $_POST['department']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Check required fields
    if (!empty($id) && !empty($username) && !empty($name) && !empty($email) && !empty($phone) && !empty($password)){
      // pass
      // Check email
      if (filter_var($email, FILTER_VALIDATE_EMAIL) === false){
        // failed
        $msg = "Please use a valid email";
        $msgClass = "red";
      } else {
        // pass
        // Hashing the password
        $hashedPwd = password_hash($_POST['password'], PASSWORD_DEFAULT);
        // var_dump($hashedPwd);

        // Insert user into database
        $sql = "UPDATE `student` SET `student_id`='$id', `student_username`='$username', `student_pwd`='$hashedPwd', `student_department`='$dep', `student_name`='$name', `student_email`='$email', `student_phone`='$phone' WHERE student_id='$id'";

        if (mysqli_query($conn, $sql)){
          $msg = "Update success";
          $msgClass = "green";
        } else {
          $msg = "Update error: " . $sql . "<br>" . mysqli_error($conn);
          $msgClass = "red";
        }
      }
    } else {
      // failed
      $msg = "Please fill in all fields";
      $msgClass = "red";
    }
  }
?>

<!-- Register form -->
<div class="wrapper">
  <section class="section">
    <div class="container2">
      <div class="row">
        <div class="col s12 m12">
          <?php if($msg != ''): ?>
            <div id="msgBox" class="card-panel <?php echo $msgClass; ?>">
              <span class="white-text"><?php echo $msg; ?></span>
            </div>
          <?php endif ?>
          <div class="card">
            <div class="card-content">
              <span class="card-title center-align"><h5>User Profile</h5></span>
              <div class="row">
                <form class="col s12" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" novalidate>
                  <div class="row">
                    <div class="input-field">
                      <i class="material-icons prefix">credit_card</i>
                      <input type="text" id="id" name="id" value="<?php echo $row['student_id']; ?>">
                      <label for="id">Your User Id</label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="input-field">
                      <i class="material-icons prefix">face</i>
                      <input type="text" id="username" name="username" value="<?php echo $row['student_username']; ?>">
                      <label for="username">Your Username</label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="input-field">
                      <i class="material-icons prefix">account_circle</i>
                      <input type="text" id="name" name="name" value="<?php echo $row['student_name']; ?>">
                      <label for="name">Your Full Name</label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="input-field">
                      <i class="material-icons prefix">school</i>
                      <select name="department">
                        <option value="<?php echo $row['student_department']; ?>" disabled selected><?php echo $row['student_department']; ?></option>
                        <option value="FTMK">FTMK</option>
                        <option value="FKE">FKE</option>
                        <option value="FKEKK">FKEKK</option>
                        <option value="FTP">FTP</option>
                        <option value="FPTT">FPTT</option>
                        <option value="FKP">FKP</option>
                        <option value="FKM">FKM</option>
                      </select>
                    </div>
                  </div>
                  <div class="row">
                    <div class="input-field">
                      <i class="material-icons prefix">email</i>
                      <input type="email" id="email" name="email" value="<?php echo $row['student_email']; ?>">
                      <label for="email">Your Email</label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="input-field">
                      <i class="material-icons prefix">local_phone</i>
                      <input type="text" id="phone" name="phone" value="<?php echo $row['student_phone']; ?>">
                      <label for="phone">Your Phone</label>
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
                    <div class="center">
                      <button type="submit" class="waves-effect waves-light btn blue" name="submit">Update</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<?php
  include 'footer.php';
?>
