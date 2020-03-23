<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "scifi";

$conn = mysqli_connect($servername, $username, $password, $dbname);

$sql = "SELECT * FROM films";
