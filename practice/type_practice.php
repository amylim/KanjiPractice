<?php include($_SERVER['DOCUMENT_ROOT']."/include/kanjidb_connect.php"); ?>
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
    var tableCode = "<table><colgroup></colgroup><colgroup width='15'></colgroup><colgroup></colgroup>";
    for(var i = 0; i < list.length; i++) {
        tableCode += makeRow(i);
    }
    tableCode += "</table>";
    return tableCode;
}

function verifyInput(id) {
    var input = document.getElementById("term" + id).value;
    if(input == list[id].lang || input == list[id].pronounciation) {
        //document.getElementById("colJ" + id).innerHTML = input;
        document.getElementById("colJ" + id).innerHTML = list[id].lang + "(" + list[id].pronounciation + ")";
        document.getElementById("colCheck" + id).innerHTML = "<span style='color:green'>&radic;</span>";
    } else {
        document.getElementById("colCheck" + id).innerHTML = "<span style='color:red'>X</span>";
    }
    document.getElementById("colCheck" + id).title = list[i].pronounciation;
}

function makeRow(i) {
    var langInput = "<input  id='term" + i + "' type='text' name='langInput' onchange='verifyInput(" + i + ")' />";
    var row = "<tr id='row"+ i +"'><td id='colJ" + i + "' class='j'>" + langInput + "</td><td id='colCheck"+i+"'></td><td>" + list[i].eng + "</td></tr>";
    return row;
}

document.write(printTable());
</script>
