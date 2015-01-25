<?php
header('Content-type:text/html; charset=utf-8');

$server = "localhost";
$user = "kanjidbadmin";
$pass = "pN8VFEsYtGHVc2trdv9Q6TLu";
$db = "KanjiDB";

$connection = new mysqli($server, $user, $pass, $db);
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
} 
?>
