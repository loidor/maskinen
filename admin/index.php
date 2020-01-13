<?php
$username = "USERNAME";
$password = "PASSWORD";
$nonsense = "NONSENSETEXT";

if (isset($_COOKIE['PrivatPageLogin'])) {
    if ($_COOKIE['PrivatPageLogin'] == md5($password.$nonsense)) {

        //Protected content
?>
        <html>
        <head>
            <meta charset="utf-8">
	    <title>Hemlighetsmaskinen: AMDI</title>
            <link href="terminal.css" rel="stylesheet">
        </head>
        <body>
        <h1>//@ECHO PRINT class "Hemligheter"</h1>
<?php
        //Outside of root directory
        include("../../../view.php");

        exit;
   } 
   
   else {
        echo "Bad Cookie.";
        exit;
   }
}

if (isset($_GET['p']) && $_GET['p'] == "login") {
   
    if ($_POST['user'] != $username) {
        echo "Anv&auml;ndarnamnet st&auml;mmer inte.";
        exit;
    } 
    else if ($_POST['keypass'] != $password) {
        echo "L&ouml;senordet st&auml;mmer inte.";
        exit;
    } 
    else if ($_POST['user'] == $username && $_POST['keypass'] == $password) {
        setcookie('PrivatPageLogin', md5($_POST['keypass'].$nonsense));
        header("Location: $_SERVER[PHP_SELF]");
    } 
    else {
        echo "Du kunde inte loggas in just nu.";
    }
}
?>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>?p=login" method="post">
    <label>User:<br/>
	<input type="text" name="user" id="user" />
    </label>
    <br />
    <label>Pass:<br/>
	<input type="password" name="keypass" id="keypass" />
    </label>
    <br />
    <input type="submit" id="submit" value="Login" />
    <br />
</form>
