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
  <div class="wrapper">
    <nav class="blue darken-2 hide-on-med-and-up" role="navigation">
      <div class="nav-wrapper container">
        <ul class="right hide-on-med-and-down">
          <li><a href="index.php">Home</a></li>
          <li><a href="login.php">Login</a></li>
          <li><a href="register.php">Register</a></li>
        </ul>

        <ul id="nav-mobile" class="side-nav ">
          <li>
            <div class="user-view">
              <div class="background">
                <img src="../img/bg_img.jpeg" alt="ocean">
              </div>
              <a href="">
                <img src="../img/logo.png" alt="" class="responsive-img" height="50%" width="100%">
              </a>
              <a href="#">
                <span class="name grey-text text-darken-4">John Doe</span>
              </a>
              <a href="#">
                <span class="email grey-text text-darken-4">jdoe@gmail.com</span>
              </a>
            </div>
          </li>
          <li><a href="index.php"><i class="fas fa-home"></i>&nbsp  Home</a></li>
          <li><a href="users.php"><i class="fas fa-users"></i>&nbsp  Users</a></li>
          <li><a href="locker.php"><i class="fas fa-box"></i>&nbsp  Locker</a></li>
          <li><a href="report.php"><i class="fas fa-chart-line"></i>&nbsp  Report</a></li>
          <li><a href="index.php"><i class="fas fa-sign-out-alt"></i>&nbsp Logout</a></li>
        </ul>
        <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
      </div>
    </nav>
  </div>
  <ul class="side-nav fixed">
    <li>
      <div class="user-view">
        <div class="background">
          <img src="../img/bg_img.jpeg" alt="ocean">
        </div>
        <img src="../img/logo.png" alt="" class="responsive-img" height="50%" width="100%">
        <a href="#">
          <span class="name grey-text text-darken-4"><?php echo $_SESSION['admin_uname']; ?></span>
        </a>
        <a href="#">
          <span class="email grey-text text-darken-4"><?php echo $_SESSION['admin_email']; ?></span>
        </a>
      </div>
    </li>
    <li><a href="index.php"><i class="fas fa-home"></i>&nbsp  Home</a></li>
    <li><a href="records.php"><i class="fas fa-book"></i>&nbsp  Record</a></li>
    <li><a href="locker.php"><i class="fas fa-box"></i>&nbsp  Locker</a></li>
    <li><a href="users.php"><i class="fas fa-users"></i>&nbsp  Users</a></li>
    <li><a href="admin.php"><i class="fas fa-user"></i>&nbsp  Admin</a></li>
    <li><a href="report.php"><i class="fas fa-chart-line"></i>&nbsp  Report</a></li>
    <?php if (isset($_SESSION['admin_id'])): ?>
      <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i>&nbsp Logout</a></li>
    <?php else: ?>
      <li><a href="login.php"><i class="fas fa-sign-in-alt"></i>&nbsp Login</a></li>
    <?php endif ?>
  </ul>
