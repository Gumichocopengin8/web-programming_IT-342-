<?php
  session_start();

  if(isset($_SESSION["username"])) {
    header('Location: ../computerList.php');
    exit();
  }

  $error_msg = '';

  require('../config.php');
  $conn = new mysqli($servername, $user, $pw, $db);
  if ($conn->connect_error) {
      die("Connection error");
  }

  $stmt = $conn->prepare("SELECT username, password FROM users");
  $stmt->execute();
  $stmt->bind_result($username, $hash);

  if (isset($_POST['subform'])) {
    if ($_POST['username'] && $_POST['password']) {
      while($stmt->fetch()) {
        if ($_POST['username'] === $username && password_verify($_POST['password'], $hash)) {
          session_regenerate_id(true);
          $_SESSION['username'] = $username;
          header('Location: ../computerList.php');
          exit();
        } else {
          $error_msg = "username or password is invalid";
        }
      }
    } else
      $error_msg = "Fill in all fields";
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Log in</title>
    <link rel="stylesheet" type="text/css" href="/ComputerList/static/CSS/login.css"/>
  </head>
  <body>
    <div id="wrapper">
      <div class="title">Login</div>
      <p>No account? <a href="./signup.php">Sign up</a></p>
      <div class="form">
        <?php
        if ($error_msg)
          echo "<p style=color:red>$error_msg</p>";
        ?>
        <form method="post" action="" class="form-container">
          <div>
            <label for="username">Username: </label>
            <input class="input" type="text" name="username" id="username" value=""/>
          </div>
          <div>
            <label for="password">Password: </label>
            <input class="input" type="password" name="password" id="password" value=""/>
          </div>
          <div>
            <input class="submit" type="submit" value="subform" name="subform"/>
          </div>
        </form>
      </div>
    </div>
  </body>
</html>
