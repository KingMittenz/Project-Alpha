<?php
  function userExist($user){
    global $connection;

    $query = "SELECT username FROM users WHERE username = '$user'";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) > 0) {
      return true;
    }
    else{
      return false;
    }
  }

  function addTask(){
    global $connection;

    if (isset($_POST['tname'])) {
      $title = $_POST['tname'];
      $userID = $_SESSION['id'];

      $query  = "INSERT INTO task(title, user_id)";
      $query .= "VALUES('$title', '$userID')";

      $addTask = mysqli_query($connection, $query);
    }
    else {
      echo "Wtf?";
    }
  }
?>
