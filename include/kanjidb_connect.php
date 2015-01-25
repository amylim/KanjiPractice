<?php
header('Content-type:text/html; charset=utf-8');

$server = "localhost";
$user = "kanjidbuser";
$pass = "e7SFqxKdkq4YWauEwJG35RZf";
$db = "KanjiDB";

$connection = new mysqli($server, $user, $pass, $db);
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
} 
?>
