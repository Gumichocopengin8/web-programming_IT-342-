<?php
  session_start();

  $error_msg = "";
  if (isset($_POST['subform'])) {
    if ($_POST['username'] && $_POST['password'] && $_POST['retype']) {
      if (ctype_alnum($_POST['username'])) {
        if ($_POST['password'] === $_POST['retype']) {
          require_once('../config.php');
          $conn = new mysqli($servername, $user, $pw, $db);
          if ($conn->connect_error)
            die('Connection Error: '.$conn->connect_error);
          $password = $_POST['password'];
          $options = array('cost' => 15);
          $hash = password_hash($password, PASSWORD_DEFAULT, $options);
          $stmt = $conn->prepare("insert into users (username, password, active) values (?,?, 0)");
          $stmt->bind_param("ss", $_POST['username'], $hash);
          if ($stmt->execute()) {
            $_SESSION['username'] = $_POST['username'];
            header('Location: ../computerList.php');
            exit();
          } else
            $error_msg = "Try again, username is probably taken";
        } else
          $error_msg = "Password doesn't match";
      } else
        $error_msg = "Username only contains alphanumeric characters";
    } else
      $error_msg = "Fill in all fields";
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Sign up</title>
    <link rel="stylesheet" type="text/css" href="/ComputerList/static/CSS/signup.css"/>
  </head>
  <body>
    <div id="wrapper">
      <div class="title">Sign up</div>
      <p>Have an account? <a href="./login.php">Login</a></p>
      <div class="form">
        <?php
        if ($error_msg)
          echo "<p style=color:red>$error_msg</p>";
        ?>
        <form method="post" action="" class="form-container">
          <div>
            <label for="username">Username: </label>
            <input class="input" type="text" name="username" id="username" value="<?php if(!empty($_POST['username']))echo $_POST['username'];?>"/>
          </div>
          <div>
            <label for="password">Password: </label>
            <input class="input" type="password" name="password" id="password" value=""/>
          </div>
          <div>
            <label for="retype">Retype: </label>
            <input class="input" type="password" name="retype" id="retype" value=""/>
          </div>
          <div>
            <input class="submit" type="submit" value="subform" name="subform"/>
          </div>
        </form>
      </div>
    </div>
  </body>
</html>
