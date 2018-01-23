<?php
  $title = "Welcome";
  include "insert/header.php";
  session_start();

  if (isset($_POST['add'])) {
    addTask();
  }
?>

<?php if (isset($_SESSION['user'])) :?>
  <nav>
    <a href="logout.php">Logout <?php echo $_SESSION['user']; ?></a>
    <h1>Project Alpha</h1>
  </nav>
  <section>
    <h2>To do:</h2>
    <ul>
      <?php
        $query = "SELECT title FROM task WHERE user_id = {$_SESSION['id']}";
        $result = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_array($result)) {
          echo "<li>" . $row['title'] . "</li>";
        }
      ?>
    </ul>
    <form action="welcome.php" method="post">
      <input type="text" name="tname">
      <input type="submit" name="add" value="Add">
    </form>
  </section>
<?php else : ?>
  <h1>Login was not accepted</h1>
<?php endif; ?>
  </body>
</html>
