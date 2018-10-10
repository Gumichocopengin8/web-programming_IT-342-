<html>
  <head>
    <title>User Registration Form</title>
    <style type="text/css">
      :root {
        --input-rounded: 5px;
      }
    
      body {
        margin: 0;
        padding: 0;
        background: #f1f1f1;
      }
      input {
        -webkit-border-radius: var(--input-rounded);
        -moz-border-radius: var(--input-rounded);
        border-radius: var(--input-rounded);
      }
      #wrapper {
        background: #fff;
        margin: 40px 50px 40px 50px;
      }
      .title {
        font-size: 30px;
        text-align: center;
      }
      .form {
        text-align: right;
        margin-right: 35vw;
      }
      .prompt {
        font-size: 25px;
        margin-top: 20px;
        text-align: right;
      }
      .field {
        width: 130px;
        margin-left: 30px;
      }
      .submit {
        margin: 30px 80px 20px 40px;
        display: inline-block;
        padding: 0.5em 1em;
        text-decoration: none;
        background: skyblue;
        color: blue;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.29);
        border-bottom: solid 3px #627295;
        border-radius: 3px;
        font-weight: bold;
        text-shadow: 1px 1px 1px rgba(255, 255, 255, 0.5);
      }
      .submit::after {
        -ms-transform: translateY(4px);
        -webkit-transform: translateY(4px);
        transform: translateY(4px);
        box-shadow: 0px 0px 1px rgba(0, 0, 0, 0.2);
        border-bottom: none;
      }
    </style>
  </head>
  <body>
    <?php
      function isDate($date, $format = 'Y-m-d') {
        if(!$date)
          return true;
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
      }
    
      $showform = true;
      if (isset($_POST['subform'])) {
        echo "<p>Form submitted</p>";
        if($_POST['manufacturer'] && $_POST['model'] && $_POST['model_year']) {
          if(ctype_digit($_POST['model_year'])) {
            if($_POST['type'] === "laptop"||$_POST['type'] === "desktop"||$_POST['type'] === "tablet"||$_POST['type'] === "iPad") {
              if(isDate($_POST['warranty_end_date']) && isDate($_POST['purchase_date']) && isDate($_POST['verified_date']) && isDate($_POST['retired_date'])) {
                require_once('config.php');
                $conn = new mysqli($servername, $user, $pw, $db);
                if ($conn->connect_error)
                  die('Connection Error: '.$conn->connect_error);
                $stmt = $conn->prepare("insert into machines (
                  manufacturer, model, model_year, serial, type, warranty_type, warranty_end_date, 
                  vendor, purchase_date, verified_date, retired_date) values (?,?,?,?,?,?,?,?,?,?,?)");
                $stmt->bind_param("sssssssssss", 
                  $_POST['manufacturer'], $_POST['model'], $_POST['model_year'], $_POST['serial'],
                  $_POST['type'], $_POST['warranty_type'], $_POST['warranty_end_date'], $_POST['vendor'], 
                  $_POST['purchase_date'], $_POST['verified_date'], $_POST['retired_date']);
                if ($stmt->execute()) {
                  echo "<p>Successfully requested account</p>";
                  echo "<p>Redirect in 3 seconds</p>";
                  echo "<script> 
                          setTimeout(function(){
                            window.location.href = '/machinesDB.php';
                          }, 3*1000);
                        </script>";
                  $showform = false;
                } else
                  $error_msg = "failed to insert";
                $stmt->close();
                }else 
                  $error_msg = "Wrong format";
              } else 
                $error_msg = "Do not edit HTML";
            } else
              $error_msg = "Must be numeric";
          } else 
            $error_msg = "Enter all fields";
        }
      if ($showform) {
    ?>
    <div id="wrapper">
      <p class="title">Please provide the following information:</p>
      <?php
        if ($error_msg) {
          echo "<p style=color:red>$error_msg </p>";
        }
      ?>
      <form method="post" action="machinesDB.php" class="form">
        <div>
          <label class="prompt" for="manufacturer">Manufacturer:</label>
          <input class="field" type="text" name="manufacturer" value="" required/>
        </div>
        <div>
          <label class="prompt" for="Model">model:</label>
          <input class="field" type="text" name="model" value="" required/>
        </div>
        <div>
          <label class="prompt" for="model_year">Model Year:</label>
          <input class="field" type="number" name="model_year" value="<?php echo date("Y"); ?>" required/>
        </div>
        <div>
          <label class="prompt" for="serial">Serial:</label>
          <input class="field" type="text" name="serial" value=""/>
        </div>
        <div>
          <label class="prompt" for="type">Type:</label>
          <select class="field" name="type">
            <?php
              $values = ["laptop" => "Laptop", "desktop" => "Desktop", "tablet" => "Tablet Computer", "iPad" => "iPad"];
              foreach($values as $value => $item) {
                echo '<option value="'.$value.'">'.$item.'</option>';
              }
            ?>
          </select>
        </div>
        <div>
          <label class="prompt" for="warranty_type">Warranty Type:</label>
          <input class="field" type="text" name="warranty_type" value=""/>
        </div>
        <div>
          <label class="prompt" for="warranty_end_date">Warranty End Date:</label>
          <input class="field" type="date" name="warranty_end_date" value=""/>
        </div>
        <div>
          <label class="prompt" for="vendor">Vendor:</label>
          <input class="field" type="text" name="vendor" value=""/>
        </div>
        <div>
          <label class="prompt" for="purchase_date">Purchase Date:</label>
          <input class="field" type="date" name="purchase_date" value=""/>
        </div>
        <div>
          <label class="prompt" for="verified_date">Verified Date:</label>
          <input class="field" type="date" name="verified_date" value=""/>
        </div>
        <div>
          <label class="prompt" for="retired_date">Retired Date:</label>
          <input class="field" type="date" name="retired_date" value=""/>
        </div>
  
        <input type="hidden" name="url" />
        <div><input class="submit" type="submit" name="subform" value="Request Account"/></div>
      </form>
    </div>
    <?php
      }
    ?>
  </body>
</html>
