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
<h3>Kanji List</h3>
<div id='kanji_list_menu' style='float:left; width:15%;'>
    <a href='kanji_list.php'>All</a><br>
    <a href='kanji_list.php?from=1&to=30'>Kanji Set #1-30</a><br>
    <a href='kanji_list.php?from=31&to=40'>Kanji Set #31-40</a><br>
</div>
<div id='kanji_info' style='float:right; width:50%;'></div>
<div id='kanji_character_list' style='width:35%;'></div>

<?php
$g_from = $_GET["from"];
$g_to = $_GET["to"];
$g_kanji = $_GET["kanji"];

if (!($g_from && $g_to) && !$g_kanji) {
    $g_from = '31';
    $g_to = '40';
} 

if ($g_from > $g_to) {
    die("Invalid parameters");
} else if ($g_from && $g_to) {
    // Display the Kanji table
    if($stmt = $connection->prepare('SELECT kanji FROM KanjiCharacter WHERE id >= ? AND id <= ?')) {
        $stmt->bind_param('ii', $g_from, $g_to);
        $stmt->execute();

        $stmt->bind_result($kanji);

        $html_kanji_character_list = "<table><tr>";
        $id = (int)$g_from;
        $count = 0;
        while ($stmt->fetch()) {
            $html_kanji_character_list .= "<td><a href='kanji_list.php?from=" . $g_from . "&to=" . $g_to . "&kanji=" . $id . "'>" . $kanji . "</a></td>";
            if($count%5 == 4 && $count != ($g_to - $g_from)) {
                $html_kanji_character_list .= "</tr><tr>";
            }
            $count += 1;
            $id += 1;
        }
        $html_kanji_character_list .= "</tr></table>";

        $stmt->close();
        echo("<script>document.getElementById('kanji_character_list').innerHTML = \"" . $html_kanji_character_list . "\";</script>");
    }

    // Display the Kanji information
    if ($g_kanji) {
        if($stmt = $connection->prepare('SELECT expression, reading, meaning FROM KanjiCompound WHERE related_kanji=?')) {
            $stmt->bind_param('i', $g_kanji);
            $stmt->execute();

            $stmt->bind_result($expression, $reading, $meaning);

            $html_kanji_info = "<table>";
            while ($stmt->fetch()) {
                $html_kanji_info .= "<tr><td>" . $expression . "</td><td>" . $reading . "</td><td>" . $meaning . "</td></tr>";
            }
            $html_kanji_info .= "</table>";

            $stmt->close();
            echo("<script>document.getElementById('kanji_info').innerHTML = '" . $html_kanji_info . "'</script>");
        }
    } 
}     

$connection->close();

?>
