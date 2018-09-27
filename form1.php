<!DOCTYPE html>
<html lang="en">
  <head>
  <title>Basic Form</title>
  </head>
  <body>
    <form method="post" action="process.php">
      <div>
        <label for="firstName">First Name:</label>
        <input type="text" name="firstName" id="firstName" required="required" />
      </div>

      <div>
        <label for="middleName">Middle Name:</label>
        <input type="text" name="middleName" id="middleName" />
      </div>

      <div>
        <label for="lastName">Last Name:</label>
        <input type="text" name="lastName" id="lastName" required="required" />
      </div>

      <div>
        <label for="address">Address:</label>
        <input type="text" name="address" id="address" required="required" />
      </div>

      <div>
        <label for="city">City:</label>
        <input type="text" name="city" id="city" required="required" />
      </div>

      <div>
        <label for="state">State:</label>
        <input type="text" name="state" id="state" maxlength="2" size="2" required="required" />
      </div>

      <div>
        <label for="zip">Zip:</label>
        <input type="text" name="zip" id="zip" maxlength="16" required="required" />
      </div>
      <input type="submit" value="Submit" name="subinfo" />
    </form>
  </body>
</html>
