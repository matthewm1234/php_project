
<!DOCTYPE html>
<html>
    <head>
        <title>Form</title>
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

?>
<form action="display_results.php" method="post" accept-charset="utf-8">

<fieldset><legend>Select Local Government and check sum total:</legend>


<p><label for="local government"><strong>Local governments</strong></label><br />
<select name="lga">
<option>Select One</option>
<?php // Retrieve all local governments and add to the pull-down menu:
$q = "SELECT lga_id, lga_name FROM lga ORDER BY lga_name ASC";		
$r = mysqli_query ($dbc, $q);
while ($row = mysqli_fetch_array ($r, MYSQLI_NUM)) {
echo "<option value=\"$row[0]\" ";
// Check for stickyness:
if (isset($_POST['lga']) && ($_POST['lga'] == $row[1]) ) echo ' selected="selected"';
echo ">$row[1]</option>\n";
}
?>
</select>

<p><input type="submit" name="submit_button" value="Get Summed total" id="submit_button"/></p>

</fieldset>

</form> 

<?php
// Check for a form submission:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

if (filter_var($_POST['lga'], FILTER_VALIDATE_INT, array('min_range' => 1))) {
    $lga = $_POST['lga'];
	$q = "SELECT party_abbreviation, SUM(party_score) FROM announced_pu_results INNER JOIN polling_unit ON polling_unit.uniqueid = announced_pu_results.polling_unit_uniqueid WHERE lga_id = $lga GROUP BY party_abbreviation";
	$r = mysqli_query ($dbc, $q);

	while ($row = mysqli_fetch_array ($r, MYSQLI_NUM)) {

		echo 'Party: ' .htmlspecialchars($row[0]) . '<br>';
		echo 'Total number: ' . htmlspecialchars($row[1]) . '<br><br>';
	}	

} 
	else { 
			echo 'No Local Government Selected';
	}

	}

?>
</body>
</html>