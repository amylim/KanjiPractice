<style type="text/css">
table {
    border-collapse: collapse;
}
table, th, td {
    border: 1px solid black;
    padding: 5px;
}
</style>
<?php
header('Content-type:text/html; charset=utf-8');

$servername = "localhost";
$username = "kanjicharuser";
$password = "GHZcrVbB8XQBR74pyd2jtQ8a";
$dbname = "KanjiDB";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

//$sql = "SELECT id, kanji FROM KanjiCharacter";
//$result = $conn->query($sql);
//
//if ($result->num_rows > 0) {
//    // output data of each row
//    while($row = $result->fetch_assoc()) {
//        echo "id: " . $row["id"]. " - Kanji: " . $row["kanji"] . "<br>";
//    }
//} else {
//    echo "0 results";
//}

echo("<h3>Kanji List</h3>");

$sql = "SELECT * FROM KanjiCompound";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
    // output data of each row
    echo("<table>");
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["expression"] . "</td><td>" . $row["reading"] . "</td><td>" . $row["meaning"] . "</td></tr>";
    }
    echo("</table>");
} else {
    echo "0 results";
}
$conn->close();

?>
