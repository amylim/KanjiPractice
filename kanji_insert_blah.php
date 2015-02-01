<?php
echo("Nothing to do.");
exit();

include("include/kanjidb_admin_connect.php"); 

mysql_query("SET NAMES utf8");

// change quere here

// KanjiCharacter
//$sql = "
//    INSERT INTO KanjiCharacter (id, kanji)
//    VALUES 
//    (31,'夢'),
//(40,'良');
//";
$sql = "
    INSERT INTO KanjiCompound (related_kanji, expression, reading, meaning)
    VALUES
    (31,'夢','ゆめ','dream'),
(40,'不良','ふりょう','delinquent');

    ";
//$sql = "
//    UPDATE KanjiCompound 
//    SET meaning='forest'
//    WHERE RID=68;
//";

if ($connection->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $connection->error;
}

$connection->close();
?>
