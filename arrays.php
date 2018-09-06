<!doctype html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Computer List</title>
  </head>

  <body>

    <?php
      $serialNumber = ["C02P20DNG3NN", "FSVMJ72", "G5MNJ72", "D25P205ZF8J9", "2X7NJ72", "C02RR5JUG8WN", "HLDKH72", "58D8H72", "D25P205GF8J9", "C1MK8GZHDTY4"];
      $manufactuer = ["Apple", "Dell", "Dell", "Apple", "Dell", "Apple", "Dell","Dell", "Apple", "Apple"];
      $model = ["15\" MacBook Pro", "Latitude E7470", "Latitude E7470", "27\" iMac", "Latitude E5570", "15\" MacBook Pro",  "Latitude E5570",  "Latitude E5570", "27\" iMac", "13\" MacBook Pro"];
      $purchaseYear = ["2015", "2016", "2016", "2015", "2016", "2015", "2016", "2016", "2015", "2013"];
      $laptop = ["Yes", "Yes", "Yes", "", "Yes", "Yes", "Yes", "Yes", "", "Yes"];

      print(count($serialNumber))
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
    	   <tr>
       	  <td>First Serial Number</td>
       	  <td>First Manufacturer</td>
       	  <td>First Model</td>
       	  <td>First Purchase Year</td>
       	  <td>Yes</td>
    	  </tr>
    	  <tr style="background: #999999;"> <!-- desktop rows should have gray background-->
      	  <td>Second Serial Number</td>
      	  <td>Second Manufacturer</td>
      	  <td>Second Model</td>
      	  <td>Second Purchase Year</td>
      	  <td>No</td>
    	  </tr>
      </tbody>
    </table>

    <p>Total Apple: ## here</p>
    <p>Total Dell: ## here</p>

  </body>
</html>
