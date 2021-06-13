

<!DOCTYPE html>
<html>
    <head>
        <title>Add Record</title>
    </head>
  
    <body>
<?php

// This is the page for storing result for all parties for Each new polling unit.
// Set the database access information as constants:
DEFINE ('DB_USER', 'b746fd54c77e63');
DEFINE ('DB_PASSWORD', 'c3ce0c7a');
DEFINE ('DB_HOST', 'us-cdbr-east-04.cleardb.com');
DEFINE ('DB_NAME', 'heroku_9069e865753cbde');

$dbc = mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
mysqli_set_charset($dbc, 'utf8');


// Check for a form submission:
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
// Required field names
$required = array('polling_unit_id','ward_id','lga_id','polling_unit_number','polling_unit_name',  'polling_unit_description','entered_by_user');

// Loop over field names, make sure each one exists and is not empty
$error = false;
foreach($required as $field) {
  if (empty($_POST[$field])) {
    $error = true;
  }
}
if (!$error) { // If everything's OK...
  // Make sure the ward_id and lga_id are available:
  $q = "SELECT ward_id, lga_id FROM ward WHERE ward_id='{$_POST["ward_id"]}' AND lga_id='{$_POST["lga_id"]}'";
  $r = mysqli_query ($dbc, $q);
  // Get the number of rows returned:
  $rows = mysqli_num_rows($r); 
		
if ($rows != 0) { 
    
   $pui= $_POST["polling_unit_id"]; 
   $wi = $_POST["ward_id"];
   $lgi = $_POST["lga_id"];
   $puno =$_POST["polling_unit_number"];
   $pun  =$_POST["polling_unit_name"];
   $pud  = $_POST["polling_unit_description"];
   $eu   = $_POST["entered_by_user"];

$q = "INSERT INTO polling_unit(polling_unit_id, ward_id, lga_id,polling_unit_number, polling_unit_name, polling_unit_description,entered_by_user) VALUES ('$pui','$wi','$lgi','$puno','$pun','$pud','$eu')";
			
			$r = mysqli_query ($dbc, $q);

			if (mysqli_affected_rows($dbc) == 1) { // If it ran OK.							


				echo "<h3>Successful !</h3><p>Thank you for adding a new record! Please use the form to add more records.</p>";
						
				// Finish the page:

				exit(); // Stop the page.
				
			} else { // If it did not run OK.
				trigger_error('You could not not add a new record due to a system error. We apologize for any inconvenience.');
			}
			
		} else { 
			
            trigger_error('Invalid ward or local government id.');
					
			} 
			
        }
    else{
        echo 'All Fields are required';
    }
		
	} 


?>

<form action = "index.php" method = "post" accept-charset="utf-8" style="padding-left:100px">
  <fieldset><legend>Add a record now. All fields required</legend>
              
        Polling Unit Id : <input type = "number" name = "polling_unit_id" 
                placeholder = "Polling Unit Id" />
                    
              <br><br>
                
        Ward Id : <input type = "number"
                name = "ward_id" placeholder = "ward id" />
                    
              <br><br>
        Local Government Id : <input type = "number" name = "lga_id" 
                placeholder = "Local Government Id" />
                    
              <br><br>
                
        Polling Unit Number : <input type = "number"
                name = "polling_unit_number" placeholder = "polling unit number" />
                    
              <br><br>
        Polling Unit Name : <input type = "text" name = "polling unit name" 
                placeholder = "polling unit name" />
                    
              <br><br>
                
        Polling Unit description : <input type = "text"
                name = "polling_unit_description" placeholder = "polling unit description" />                
              <br><br>
        Entered by user : <input type = "text"
                name = "entered_by_user" placeholder = "user name" />                
              <br><br>

              <input type = "submit" name = "submit" value = "Submit">
              </fieldset>
          </form>
          <a href= 'task1.php'>go to task 1</a> <a href= 'display_results.php'>go to task 2</a>
          </body>
        
</html> 