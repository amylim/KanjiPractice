<?php include("include/kanjidb_connect.php"); ?>
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

echo("<h3>Kanji List</h3>");

$sql = "SELECT * FROM KanjiCompound";
$result = $connection->query($sql);


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
