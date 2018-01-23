<?php
  $title = 'Register';
  $bodyID = "register";
  include 'insert/header.php';
  session_start();
  $errorMessage = '';

  if (isset($_POST['register'])) {
    $user = $_POST['user'];
    $pass = $_POST['pass'];

    if (userExist($user)) {
      echo "User already exist";
    }
    else {
      $user = mysqli_real_escape_string($connection, $user);
      $pass = mysqli_real_escape_string($connection, $pass);

      $hashformat = "$2y$10$";
      $salt = "p4vNBzGFhQ4deEa3AXcWUo";

      $hashnsalt = $hashformat . $salt;
      $pass = crypt($pass, $hashnsalt);

      $query = "INSERT INTO users(username, password) ";
      $query .= "VALUES('$user', '$pass')";

      $result = mysqli_query($connection, $query);
      if (!$result) {
        die("Query failed" . mysqli_error($connection));
      }

      header("Location: login.php");
    }
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Register</title>
    <link rel="stylesheet" href="css/alpha.css">
  </head>
  <body>
    <form action="register.php" method="post">
      <h3>Register</h3>
      <input type="text" name="user" placeholder="'Username">
      <input type="password" name="pass" placeholder="password">
      <input type="submit" name="register" value="Register">
      <?php echo $errorMessage; ?>
    </form>
  </body>
</html>
