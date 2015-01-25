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

$g_from = $_GET["from"];
$g_to = $_GET["to"];

if(!($g_from && $g_to)) {
    $g_from = '1';
    $g_to = '30';
    // TODO: Display different page for no GET parameters
} else if ($g_from > $g_to) {
    die("Invalid parameters");
}

// Display the Kanji table
if($stmt = $connection->prepare('SELECT kanji FROM KanjiCharacter WHERE id >= ? AND id <= ?')) {
    $stmt->bind_param('ii', $g_from, $g_to);
    $stmt->execute();

    $stmt->bind_result($kanji);

    echo("<table><tr>");
    $count = 0;
    while ($stmt->fetch()) {
        echo("<td>" . $kanji . "</td>");
        if($count%5 == 4 && $count != ($g_to - $g_from)) {
            echo("</tr><tr>");
        }
        $count += 1;
    }
    echo("</tr></table>");

    $stmt->close();
}
    
/*
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
 */
$connection->close();

?>
