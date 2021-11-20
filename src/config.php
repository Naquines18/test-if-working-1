<?php
// kani kay ang database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "barangaydb";
$port = 3306;

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname,$port);
?>
