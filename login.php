<?php
  $title = 'Register';
  $bodyID = 'register';
  include 'insert/header.php';
  session_start();
  $errorMessage = '';

  if (isset($_POST['login'])) {
    $user = $_POST['user'];
    $pass = $_POST['pass'];

    $user = mysqli_real_escape_string($connection, $user);
    $pass = mysqli_real_escape_string($connection, $pass);

    $query = "SELECT * FROM users WHERE username = '{$user}'";
    $selectuser = mysqli_query($connection, $query);

    if (!$selectuser) {
      die('query failed') . mysqli_error($connection);
    }

    $db_user = '';
    $db_pass = '';

    while ($row = mysqli_fetch_array($selectuser)) {
      $db_id = $row['id'];
      $db_user = $row['username'];
      $db_pass = $row['password'];
    }

    $pass = crypt($pass, $db_pass);

    if ($user === $db_user && $pass === $db_pass) {
      $_SESSION['user'] = $db_user;
      $_SESSION['id'] = $db_id;
      header("Location: welcome.php");
    }
    else{
      $errorMessage = "Login failed";
    }

  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="css/alpha.css">
  </head>
  <body>
    <form class="login" action="login.php" method="post">
      <h3>login</h3>
      <input type="text" name="user" placeholder="Username">
      <input type="password" name="pass" placeholder="password">
      <input type="submit" name="login" value="Login">
      <a href="register.php">Not registered? Press here to register an account.</a>
      <?php echo $errorMessage; ?>
    </form>
  </body>
</html>
