<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Home</title>
  <link rel="stylesheet" href="css/materialize.min.css">
  <script src="js/fontawesome-all.min.js"></script>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <nav class="white" role="navigation">
    <div class="nav-wrapper container">
      <a id="logo-container" href="#" class="brand-logo">
        <img class="logo-img" src="img/logo.png" alt="logo">
      </a>
      <ul class="right hide-on-med-and-down black-text">
        <?php if(isset($_SESSION['s_id'])): ?>
          <li><a href="index.php">Home</a></li>
          <li><a href="user/index.php">Dashboard</a></li>
          <li><a href="logout.php">Logout</a></li>
        <?php else: ?>
          <li><a href="index.php">Home</a></li>
          <li><a href="register.php">Register</a></li>
          <li><a href="login.php">Login</a></li>
        <?php endif ?>
      </ul>

      <ul id="nav-mobile" class="side-nav">
        <?php if(isset($_SESSION['s_id'])): ?>
          <li><a href="index.php">Home</a></li>
          <li><a href="user/index.php">Dashboard</a></li>
          <li><a href="logout.php">Logout</a></li>
        <?php else: ?>
          <li><a href="index.php">Home</a></li>
          <li><a href="register.php">Register</a></li>
          <li><a href="login.php">Login</a></li>
        <?php endif ?>
      </ul>
      <a href="#" data-activates="nav-mobile" class="button-collapse grey-text"><i class="material-icons">menu</i></a>
    </div>
  </nav>
