<!DOCTYPE html>
<html>
  <head>
    <title>Computer List</title>
    <style type="text/css">
      body {
        margin: 0;
        padding: 0;
        background: black;
        color: white;
      }
      table, th, td{
        white-space: nowrap;
        border: double 1px blue;
        text-align: center;
        color: black;
      }
      table {
        margin: auto;
    	  background: gray;
      }
      th, td {
        padding: 3px;
      }
      h1 {
        text-align: center;
        color: yellow;
      }
      a {
        color: white;
      }
      a:hover {
        color: skyblue;
      }
      a:active {
        color: purple;
      }
      .add {
        text-align: center;
        font-size: 20px;
        color: white;
      }
      .table {
        margin-top: 100px;
        margin-bottom: 100px;
      }
    </style>
  </head>
  <body>
    <?php
    require('../config.php');
    $conn = new mysqli($servername, $user, $pw, $db);
    if ($conn->connect_error) {
        die("Connection error");
    }
    
    $stmt = $conn->prepare(
      "SELECT machine_id, manufacturer, model, model_year, serial, type, warranty_type, warranty_end_date, 
      vendor, purchase_date, verified_date, retired_date FROM machines ORDER BY machine_id DESC");
    $stmt->execute();
    $stmt->bind_result(
      $machine_id, $manufacturer, $model, $model_year, $serial, $type, $warranty_type,
      $warranty_end_date, $vendor, $purchase_date, $verified_date, $retired_date);
    ?>
    <div>
      <h1>Computer List</h1>
    </div>
    <div class="table">
      <div class="add">
        <a href="./addComputer.php">Add Computer</a>
      </div>
      <table align: center>
        <?php
        echo "<tr>";
        $arr = ["No.", "manufacturer", "model", "model_year", "serial", "type","warranty_type", 
        "warranty_end_date", "vendor", "purchase_date", "verified_date", "retired_date", "Edit", "Delete"];
        foreach($arr as $value) {
          echo '<th>'.$value.'</th>';
        }
        echo "</tr>";
        $index = 0;
        while($stmt->fetch()) {
          echo '<form action="updateComputer.php" method="post">';
          echo '<tr>';
            echo '<input type="hidden" name="machine_id" value="'.$machine_id.'">';
            echo '<input type="hidden" name="manufacturer" value="'.$manufacturer.'">';
            echo '<input type="hidden" name="model" value="'.$model.'">';
            echo '<input type="hidden" name="model_year" value="'.$model_year.'">';
            echo '<input type="hidden" name="serial" value="'.$serial.'">';
            echo '<input type="hidden" name="type" value="'.$type.'">';
            echo '<input type="hidden" name="warranty_type" value="'.$warranty_type.'">';
            echo '<input type="hidden" name="warranty_end_date" value="'.$warranty_end_date.'">';
            echo '<input type="hidden" name="vendor" value="'.$vendor.'">';
            echo '<input type="hidden" name="purchase_date" value="'.$purchase_date.'">';
            echo '<input type="hidden" name="verified_date" value="'.$verified_date.'">';
            echo '<input type="hidden" name="retired_date" value="'.$retired_date.'">';
            echo '<td>'.++$index.'</td>';
            echo '<td>'.$manufacturer.'</td>';
            echo '<td>'.$model.'</td>';
            echo '<td>'.$model_year.'</td>';
            echo '<td>'.$serial.'</td>';
            echo '<td>'.$type.'</td>';
            echo '<td>'.$warranty_type.'</td>';
            echo '<td>'.str_replace("-", "/",$warranty_end_date).'</td>';
            echo '<td>'.$vendor.'</td>';
            echo '<td>'.str_replace("-", "/",$purchase_date).'</td>';
            echo '<td>'.str_replace("-", "/",$verified_date).'</td>';
            echo '<td>'.str_replace("-", "/",$retired_date).'</td>';
            echo '<td><input type="submit" value="Edit" name="update"></td>';
            echo '<td><a href="./delete.php?id='.$machine_id.'">Delete</a></td>';
          echo '</tr>';
          echo '</form>';
        }
        ?>
      </table>
    </div>
  </body>
</html>
