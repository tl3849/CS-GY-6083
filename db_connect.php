<?php
$servername = "localhost";
$username = "ufunyaiwmv11z";
$password = "lr0i6i0gqpkj";
$dbname = "dbfq7hpza67qzu";

function getConnection() {
    global $servername, $username, $password, $dbname;
    
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}
?>