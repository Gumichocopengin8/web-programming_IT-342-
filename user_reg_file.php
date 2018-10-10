<html>
  <head>
    <title>User Registration Form</title>
  </head>
  <body>
    <?php
      $showform = true;
      if (isset($_POST['subform'])) {
        echo "<p>Form submitted</p>";
        if ($_POST['username'] && $_POST['password'] && $_POST['retype']) {
          if (ctype_alnum($_POST['username'])) {
            if ($_POST['password'] === $_POST['retype']) {
              require_once('config.php');
              $conn = new mysqli($servername, $user, $pw, $db);
              if ($conn->connect_error)
                die('Connection Error: '.$conn->connect_error);
              $stmt = $conn->prepare("insert into users (username, password, active) values (?,?, 0)");
              $stmt->bind_param("ss", $_POST['username'], $_POST['password']);
              if ($stmt->execute()) {
                echo "<p>Successfully requested account</p>";
                $showform = false;
              } else
                $error_msg = "failed to insert";
              $stmt->close();
            } else
              $error_msg = "Password fields don't match";
          } else
            $error_msg = "Username only contains alphanumeric characters";
        } else
          $error_msg = "Enter all fields";
      }
      if ($showform) {
        if ($error_msg)
          echo "<p style=color:red>$error_msg</p>";
    ?>
    <p>Please provide the following information to request an account: (all fields are required)</p>
    <form method="post" action="user_reg_file.php">
      <div>
        <div class="prompt"><label for="username">Username:</label></div>
        <div class="field"><input type="text" name="username" value="" required /></div>
      </div>
      <div>
        <div class="prompt"><label for="password">Password:</label></div>
        <div class="field"><input type="password" name="password" value="" required /></div>
      </div>
      <div>
        <div class="prompt"><label for="retype">Retype Password:</label></div>
        <div class="field"><input type="password" name="retype" value="" required /></div>
      </div>

      <input type="hidden" name="url" />
      <div><input type="submit" name="subform" value="Request Account" /></div>
    </form>
    <?php
      }
    ?>
  </body>
</html>
