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
$g_kanji = $_GET["kanji"];

if(!($g_from && $g_to) && !$g_kanji) {
    $g_from = '1';
    $g_to = '30';
    // TODO: Display different page for no GET parameters
} else if ($g_from > $g_to) {
    die("Invalid parameters");
} else if ($g_from && $g_to) {
    // Display the Kanji table
    if($stmt = $connection->prepare('SELECT kanji FROM KanjiCharacter WHERE id >= ? AND id <= ?')) {
        $stmt->bind_param('ii', $g_from, $g_to);
        $stmt->execute();

        $stmt->bind_result($kanji);

        echo("<table><tr>");
        $id = (int)$g_from;
        $count = 0;
        while ($stmt->fetch()) {
            echo("<td><a href='kanji_list.php?kanji=" . $id . "'>" . $kanji . "</a></td>");
            if($count%5 == 4 && $count != ($g_to - $g_from)) {
                echo("</tr><tr>");
            }
            $count += 1;
            $id += 1;
        }
        echo("</tr></table>");

        $stmt->close();
    }
} else if ($g_kanji) {
    // Display the Kanji information
    if($stmt = $connection->prepare('SELECT expression, reading, meaning FROM KanjiCompound WHERE related_kanji=?')) {
        $stmt->bind_param('i', $g_kanji);
        $stmt->execute();

        $stmt->bind_result($expression, $reading, $meaning);

        echo("<table>");
        while ($stmt->fetch()) {
            echo("<tr><td>" . $expression . "</td><td>" . $reading . "</td><td>" . $meaning . "</td></tr>");
        }
        echo("</table>");

        $stmt->close();
    }
}
    
$connection->close();

?>
