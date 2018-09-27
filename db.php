<!DOCTYPE html>
<html lang="en">
  <?php
    include('config.php');
    $conn = new mysqli($servername, $user, $pw, $db);
    if ($conn->connect_error)
      die('Connection Error: '.$conn->connect_error);
    else
      echo "success";
  ?>
</html>
