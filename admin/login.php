<?php
  require '../model/db.php';
  session_start();

  $msg = $msgClass = '';

  if (filter_has_var(INPUT_POST, 'submit')) {
    // Get form data
    $id = mysqli_real_escape_string($conn, $_POST['userid']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Check if inputs are empty
    if (!empty($id) && !empty($password)){
      // success
      $sql = "SELECT * FROM `admin` WHERE `admin_id`='$id'";
      $result = mysqli_query($conn, $sql);
      $resultCheck = mysqli_num_rows($result);
      $row = mysqli_fetch_assoc($result);

      if ($resultCheck < 1) {
        // error, id not exist
        $msg = "Invalid Admin id or password";
        $msgClass = "red";
      } else {
        // dehashing the password
        $pwdCheck = password_verify($_POST['password'], $row['admin_password']);

        if($pwdCheck == false) {
          $msg = "Invalid password";
          $msgClass = "red";
        } elseif ($pwdCheck == true) {
          $_SESSION['admin_id'] = $row['admin_id'];
          $_SESSION['admin_uname'] = $row['admin_username'];
          $_SESSION['admin_email'] = $row['admin_email'];

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
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Home</title>
  <link rel="stylesheet" href="../css/materialize.min.css">
  <script src="../js/fontawesome-all.min.js"></script>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
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
              <img id="admin_img" src="../img/logo.png" class="responsive-img">
            </div>
            <div class="card-content">
              <span class="card-title center-align">Admin Login</span>
              <div class="row">
                <form class="col s12" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" novalidate>
                  <div class="row">
                    <div class="input-field">
                      <i class="material-icons prefix">account_circle</i>
                      <input type="text" id="userid" name="userid">
                      <label for="userid">Admin id</label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="input-field">
                        <i class="material-icons prefix">lock</i>
                      <input type="password" id="password" name="password">
                      <label for="userid">Password</label>
                    </div>
                  </div>
                  <div class="center">
                    <button type="submit" class="waves-effect waves-light btn blue" name="submit">Login</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php include 'footer.php'; ?>
