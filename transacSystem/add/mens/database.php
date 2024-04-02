<?php

$host = "localhost";
$dbname = "triftee";
$username = "root";
$password = "";

$mysqli = new mysqli($host, $username, $password, $dbname);

if ($mysqli->connect_errno) {
    die("Connection error: " . $mysqli->connect_error);
}

if (!$mysqli->set_charset("utf8mb4")) {
    die("Error setting charset: " . $mysqli->error);
}

return $mysqli;