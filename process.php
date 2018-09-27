<?php
  require_once('config.php');
  $conn = new mysqli($servername, $user, $pw, $db);
  if ($conn->connect_error)
    die('Connection Error: '.$conn->connect_error);
  foreach($_POST as $key=>$value){
    $$key = $value;
  }
  $sql = "insert into people (firstName, middleName, lastName, address, city, state, zip)
          values ('$firstName', '$middleName', '$lastName', '$address', '$city', '$state', '$zip')";
  if ($conn->query($sql)===TRUE)
    $success = 1;
  else
    die('Insert Error: '.$conn->error);
?>

<!DOCTYPE html>
<html>
  <head>
    <title>PHP Form Testing</title>
    <meta http-equiv="refresh"content="3; url=https://it342-keitanonaka-keitanonaka.c9users.io/form1.php">
  </head>
  <body>
    <?php
      if ($success == 1){
        echo "<p>Record inserted successfully</p>";
        echo "<p>Redirect in 3 seconds</p>";
      } else
        echo "<p>Record insert failed</p>";
    ?>
  </body>
</html>
