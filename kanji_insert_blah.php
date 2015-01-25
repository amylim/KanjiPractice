<?php
echo("Nothing to do.");
exit();

include("include/kanjidb_admin_connect.php"); 

mysql_query("SET NAMES utf8");
$sql = "
    DELETE FROM KanjiCharacter
    WHERE rid=4;
";

if ($connection->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $connection->error;
}

$connection->close();
?>
