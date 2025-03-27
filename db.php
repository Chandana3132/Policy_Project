<?php

include 'config.php';
// Create connection
$conn = new mysqli('localhost', 'root', '','digital');
// Check connection
if ($conn->connect_error) {
 	 die("Connection failed: " . $conn->connect_error);
}

STATIC $name;

?>