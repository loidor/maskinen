<?php

include '../../dbinfo.php';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$inputsecret = strip_tags($_POST["secret"]);
$datetime = date("ymd H:i:s");

$secret = mysqli_real_escape_string($conn, $inputsecret);

$sql = "INSERT INTO ". $dbtable .  " (secret, datetime) VALUES ('" .  $secret  .  "', '" .  $datetime .  "')";

if ($conn->query($sql) === TRUE) {?>
    <html>
        <head>
            <meta charset="utf-8">
            <title>Hemlighetsmaskinen</title>
        </head>
        <body>
            <h1>Hemlighetsmaskinen</h1>
            <p>Din hemlighet har skickats in.</p>
            <form method="post" action="index.php">
                <textarea rows="8" cols="50" spellcheck="false" name="secret" type="text"></textarea><br/>
                <input type="submit" value="Skicka"/>
            </form>
        </body>
    </html>
<?php
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>
