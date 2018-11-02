<html>
  <head>
    <meta charset="UTF-8">
    <title>User Registration Form</title>
    <link rel="stylesheet" type="text/css" href="/ComputerList/static/CSS/addComputer.css"/>
  </head>
  <body>
    <?php
      session_start();

      if(!isset($_SESSION["username"])) {
        header('Location: ./auth/login.php');
        exit();
      }

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
            if($_POST['type'] === "Laptop"||$_POST['type'] === "Desktop"||$_POST['type'] === "Tablet Computer"||$_POST['type'] === "iPad") {
              if(isDate($_POST['warranty_end_date']) && isDate($_POST['purchase_date']) && isDate($_POST['verified_date']) && isDate($_POST['retired_date'])) {
                require_once('./config.php');
                $conn = new mysqli($servername, $user, $pw, $db);
                if ($conn->connect_error)
                  die('Connection Error: '.$conn->connect_error);
                $stmt = $conn->prepare("insert into machines (
                  manufacturer, model, model_year, serial, type, warranty_type, warranty_end_date,
                  vendor, purchase_date, verified_date, retired_date) values (?,?,?,?,?,?,?,?,?,?,?)");
                $stmt->bind_param("ssissssssss",
                  $_POST['manufacturer'], $_POST['model'], $_POST['model_year'], $_POST['serial'],
                  $_POST['type'], $_POST['warranty_type'], $_POST['warranty_end_date'], $_POST['vendor'],
                  $_POST['purchase_date'], $_POST['verified_date'], $_POST['retired_date']);
                if ($stmt->execute()) {
                  echo "<p>Successfully requested account</p>";
                  header('Location: ./computerList.php'); // redirect
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
      <div id="nav">
        <div class="flex-container">
          <div class=logo><a href="./computerList.php">GitPub</a></div>
          <div class="nav-title">Add computer</div>
          <div><a href="./auth/logout.php">logout</a></div>
        </div>
      </div>

      <div class="contents">
        <p class="title">Please provide the following information</p>
        <?php
          if ($error_msg) {
            echo "<p style=color:red>$error_msg </p>";
          }
        ?>
        <form method="post" action="./addComputer.php" class="form">
          <div>
            <label class="prompt" for="manufacturer">Manufacturer:</label>
            <input class="field" type="text" name="manufacturer" value="<?php if(!empty($_POST['manufacturer'])){ echo $_POST['manufacturer'];}?>" required/>
          </div>
          <div>
            <label class="prompt" for="Model">model:</label>
            <input class="field" type="text" name="model" value="<?php if(!empty($_POST['model'])){ echo $_POST['model'];}?>" required/>
          </div>
          <div>
            <label class="prompt" for="model_year">Model Year:</label>
            <input class="field" type="number" name="model_year" value="<?php echo date("Y"); ?>" required/>
          </div>
          <div>
            <label class="prompt" for="serial">Serial:</label>
            <input class="field" type="text" name="serial" value="<?php if(!empty($_POST['serial'])){ echo $_POST['serial'];}?>"/>
          </div>
          <div>
            <label class="prompt" for="type">Type:</label>
            <select class="field" name="type">
              <?php
                if(!empty($_POST['type'])){
                  echo '<option value="'.$_POST['type'].'">'.$_POST['type'].'</option>';
                }
                $values = ["Laptop", "Desktop", "Tablet Computer","iPad"];
                foreach($values as $value) {
                  echo '<option value="'.$value.'">'.$value.'</option>';
                }
              ?>
            </select>
          </div>
          <div>
            <label class="prompt" for="warranty_type">Warranty Type:</label>
            <input class="field" type="text" name="warranty_type" value="<?php if(!empty($_POST['warranty_type'])){ echo $_POST['warranty_type'];}?>"/>
          </div>
          <div>
            <label class="prompt" for="warranty_end_date">Warranty End Date:</label>
            <input class="field" type="date" name="warranty_end_date" value="<?php if(!empty($_POST['warranty_end_date'])){ echo $_POST['warranty_end_date'];}?>"/>
          </div>
          <div>
            <label class="prompt" for="vendor">Vendor:</label>
            <input class="field" type="text" name="vendor" value="<?php if(!empty($_POST['vendor'])){ echo $_POST['vendor'];}?>"/>
          </div>
          <div>
            <label class="prompt" for="purchase_date">Purchase Date:</label>
            <input class="field" type="date" name="purchase_date" value="<?php if(!empty($_POST['purchase_date'])){ echo $_POST['purchase_date'];}?>"/>
          </div>
          <div>
            <label class="prompt" for="verified_date">Verified Date:</label>
            <input class="field" type="date" name="verified_date" value="<?php if(!empty($_POST['verified_date'])){ echo $_POST['verified_date'];}?>"/>
          </div>
          <div>
            <label class="prompt" for="retired_date">Retired Date:</label>
            <input class="field" type="date" name="retired_date" value="<?php if(!empty($_POST['retired_date'])){ echo $_POST['retired_date'];}?>"/>
          </div>

          <input type="hidden" name="url" />
          <div><input class="submit" type="submit" name="subform" value="Add Computer"/></div>
        </form>
      </div>
    </div>
    <?php
      }
    ?>
  </body>
</html>
