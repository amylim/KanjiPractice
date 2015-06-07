<?php include($_SERVER['DOCUMENT_ROOT']."/include/kanjidb_connect.php"); ?>
<h3>Kanji Toggle Practice</h3>
Click on the expression to toggle between Kanji and its reading.<br><br>
<script type="text/javascript">
function Term(jap, sound, eng) {
    this.lang = jap;
    this.pronounciation = sound;
    this.eng = eng;
}

var list = new Array(
<?php
if($stmt = $connection->prepare('SELECT expression, reading, meaning FROM KanjiCompound')) {
    $stmt->execute();

    $stmt->bind_result($expression, $reading, $meaning);

    $html_list = "";
    while ($stmt->fetch()) {
        $html_list .= "new Term(\"" . $expression . "\", \"" . $reading . "\", \"" . $meaning . "\"),";
    }

    $stmt->close();
    echo(rtrim($html_list, ","));
}
?>
);

function shuffleList() {
    for(var i = 0; i < list.length; i++) {
        var j = Math.floor((Math.random() * list.length)); 
        var temp = list[i];
        list[i] = list[j];
        list[j] = temp;
    }
}

function printTable() {
    shuffleList();
    var tableCode = "<table>";
    for(var i = 0; i < list.length; i++) {
        tableCode += makeRow(i);
    }
    tableCode += "</table>";
    return tableCode;
}

function toggleExpression(id) {
    var currentText = document.getElementById("expression"+id).innerText;
    if(currentText == list[id].lang) {
        document.getElementById("expression"+id).innerText = list[id].pronounciation;
    } else {
        document.getElementById("expression"+id).innerText = list[id].lang;
    }
}

function makeRow(i) {
    return "<tr><td style='text-align:right'>" + list[i].eng + "</td><td id='expression" + i + "' onclick='toggleExpression(" + i + ")'>" + list[i].lang + "</td></tr>";
}

document.write(printTable());
</script>
