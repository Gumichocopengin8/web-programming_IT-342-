<?php
  require('../config.php');
  $conn = new mysqli($servername, $user, $pw, $db);
  if ($conn->connect_error) {
      die("Connection error");
  }
  
  $param = $_GET['id'];
  $sql = "DELETE FROM machines WHERE machine_id = $param";
  $stmt = $conn->prepare($sql);

  if($stmt->execute()) {
    echo "Successfully Delete data";
  } else {
    echo "Failed to delete data";
  }
  header('Location: ./computerList.php'); // redirect
  $stmt->close();
?>
