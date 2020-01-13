<?php

include 'dbinfo.php';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$conn->query("DELETE FROM " . $dbtable . " WHERE secret='';");

$sql = "SELECT  datetime, secret FROM " . $dbtable . " ORDER BY id DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<p>" .$row["datetime"]. ":";
        echo "<br/>";
        echo $row["secret"];
        echo "</p><hr/>";
    }
} else {
    echo "0 results";
}
$conn->close();

?>
