<!doctype html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Computer List</title>
  </head>

  <body>
    <?php
      $serialNumber = ["C02P20DNG3NN", "FSVMJ72", "G5MNJ72", "D25P205ZF8J9", "2X7NJ72", "C02RR5JUG8WN", "HLDKH72", "58D8H72", "D25P205GF8J9", "C1MK8GZHDTY4"];
      $manufacturer = ["Apple", "Dell", "Dell", "Apple", "Dell", "Apple", "Dell","Dell", "Apple", "Apple"];
      $model = ["15\" MacBook Pro", "Latitude E7470", "Latitude E7470", "27\" iMac", "Latitude E5570", "15\" MacBook Pro",  "Latitude E5570",  "Latitude E5570", "27\" iMac", "13\" MacBook Pro"];
      $purchaseYear = ["2015", "2016", "2016", "2015", "2016", "2015", "2016", "2016", "2015", "2013"];
      $laptop = ["Yes", "Yes", "Yes", "", "Yes", "Yes", "Yes", "Yes", "", "Yes"];

      $col = count($serialNumber);
      $appleCount = $dellCount = 0;
      $comp = [];

      for($i = 0; $i < $col; $i++){
        $comp[] = ["serialNumber" => $serialNumber[$i], "manufacturer" => $manufacturer[$i],
                   "model" => $model[$i], "purhaseYear" => $purchaseYear[$i], "laptop" => $laptop[$i], ];
        $comp[$i]["manufacturer"] == "Apple" ? $appleCount++ : $dellCount++;
      }
    ?>
    <table border="1">
      <thead>
       <tr>
      	  <th>Serial Number</th>
      	  <th>Manufacturer</th>
      	  <th>Model</th>
      	  <th>Purchase Year</th>
      	  <th>Laptop</th>
    	  </tr>
      </thead>
      <tbody>
  	     <?php
  	      foreach($comp as $computers){
  	        $color = $computers["laptop"] == "Yes" ? 'white' : '#999999';
  	        echo "<tr style=\"background: $color\">";
           	  echo "<td>$computers[serialNumber]</td>";
           	  echo "<td>$computers[manufacturer]</td>";
           	  echo "<td>$computers[model]</td>";
           	  echo "<td>$computers[purhaseYear]</td>";
           	  echo "<td>$computers[laptop]</td>";
         	  echo "</tr>";
  	      }
     	  ?>
      </tbody>
    </table>

    <p>Total Apple: <?php echo $appleCount; ?></p>
    <p>Total Dell: <?php echo $dellCount; ?></p>
  </body>
</html>
