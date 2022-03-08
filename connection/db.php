<?php
$dbHost = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "tourismdb";

$connection = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName);
if (!$connection) {
    die("Connection Unsuccessful" . mysqli_connect_error());
}
