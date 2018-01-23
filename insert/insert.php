<?php
  $connection = mysqli_connect('localhost', 'Mitz', 'mittenz', 'db_projectalpha');

  if (!$connection) {
    die('failed to connect' . mysqli_error($connection));
  }
?>
