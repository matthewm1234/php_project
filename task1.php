
<!DOCTYPE html>
<html>
    <head>
        <title>Form</title>
    </head>
  
    <body>
<?php 
// This is the page for storing result for all parties for Each new polling unit.
// Set the database access information as constants:
    // DEFINE ('DB_USER', 'root');
    // DEFINE ('DB_PASSWORD', '');
    // DEFINE ('DB_HOST', '127.0.0.1');
    // DEFINE ('DB_NAME', 'bincomphptest'); 

    DEFINE ('DB_USER', 'b746fd54c77e63');
    DEFINE ('DB_PASSWORD', 'c3ce0c7a');
    DEFINE ('DB_HOST', 'us-cdbr-east-04.cleardb.com');
    DEFINE ('DB_NAME', 'heroku_9069e865753cbde');

    $dbc = mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    mysqli_set_charset($dbc, 'utf8');

    $query = "SELECT * FROM announced_pu_results";

    $r = mysqli_query ($dbc, $query);
    if (!$r) die("Fatal Error");

    $rows = mysqli_num_rows($r); 

    echo "<table><tr><th>Result id</th><th>Party</th><th>Score</th></tr>";

	while ($row = mysqli_fetch_array ($r, MYSQLI_ASSOC)) {
        echo "<tr>";
        echo "<td>" . $row['result_id'] . "</td>";
		echo "<td>" . $row['party_abbreviation'];
        echo "<td>" . $row['party_score'];
        echo "</tr>";
    }
    echo "</table>";	
    ?>
    </body>
    </html>