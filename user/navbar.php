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
          <li><a href="../index.php">Home</a></li>
          <li><a href="../login.php">Login</a></li>
          <li><a href="../register.php">Register</a></li>
        </ul>

        <ul id="nav-mobile" class="side-nav ">
          <li>
            <div class="user-view">
              <div class="background">
                <img src="../img/ocean.jpg" alt="ocean">
              </div>
              <div class="row">
                <div class="col s4">
                  <img src="../img/user.png" alt="" class="circle">
                </div>
                <div class="col s8">
                  <a href="#">
                    <span class="name white-text"><?php echo $_SESSION['s_username']; ?></span>
                  </a>
                  <a href="#">
                    <span class="email white-text"><?php echo $_SESSION['s_email']; ?></span>
                  </a>
                </div>
              </div>
            </div>
          </li>
          <li><a href="index.php"><i class="fas fa-info-circle"></i>&nbsp  Status</a></li>
          <li><a href="../index.php"><i class="fas fa-home"></i>&nbsp  Home</a></li>
          <?php if (isset($_SESSION['s_id'])): ?>
            <li><a href="../logout.php"><i class="fas fa-sign-out-alt"></i>&nbsp Logout</a></li>
          <?php else: ?>
            <li><a href="../login.php"><i class="fas fa-sign-in-alt"></i>&nbsp Login</a></li>
          <?php endif ?>
        </ul>
        <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
      </div>
    </nav>
  </div>
  <ul class="side-nav fixed">
    <li>
      <div class="user-view">
        <div class="background">
          <img src="../img/ocean.jpg" alt="ocean">
        </div>
        <div class="row">
          <div class="col s4">
            <img src="../img/user.png" alt="" class="circle">
          </div>
          <div class="col s8">
            <a href="#">
              <span class="name white-text"><?php echo $_SESSION['s_username']; ?></span>
            </a>
            <a href="#">
              <span class="email white-text"><?php echo $_SESSION['s_email']; ?></span>
            </a>
          </div>
        </div>
      </div>
    </li>
    <li><a href="index.php"><i class="fas fa-info-circle"></i>&nbsp  Status</a></li>
    <li><a href="../index.php"><i class="fas fa-home"></i>&nbsp  Home</a></li>
    <?php if (isset($_SESSION['s_id'])): ?>
      <li><a href="../logout.php"><i class="fas fa-sign-out-alt"></i>&nbsp Logout</a></li>
    <?php else: ?>
      <li><a href="../login.php"><i class="fas fa-sign-in-alt"></i>&nbsp Login</a></li>
    <?php endif ?>
  </ul>
