<!DOCTYPE html>
<html lang="en">
 <head>
  <meta charset="UTF-8">
  <title>Hello World</title>
 </head>
 <body>
   <form method="post" action="page2.php">
     <input type="text" name="number2"/>
     <input type="submit" value="Submit"/>
   </form>
  <?php
    echo $_GET['number2'];
    $number1 = 1;
    echo "<a href=\"page2.php?number1=$number1\">Click here to go to page2</a>";
  ?>
  <div>hello??</div>
 </body>
</html>
