<?php
$HOSTNAME = 'localhost';
$USERNAME = 'root';
$PASSWORD = 'root';
$DATABASE = 'donarbase';

$con = mysqli_connect($HOSTNAME, $USERNAME, $PASSWORD, $DATABASE);

if (!$con) {
    die("Connection failed: $con");
}

    echo "Connection successful";
?>
