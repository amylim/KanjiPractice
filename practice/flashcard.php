<?php include($_SERVER['DOCUMENT_ROOT']."/include/kanjidb_connect.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Flashcard Practice</title>
<script>
document.addEventListener('touchmove', function(e){e.preventDefault()}, false);
document.getElementById('canvas').addEventListener('touchmove', function(e){e.stopPropagation()}, false);
//document.addEventListener('touchmove', this.touchmove);
//function touchmove(e) {
//    e.preventDefault()
//}
</script>
<style type="text/css">
html,body { height:100% }
body { overflow:hidden; }
#wrap { height:100%; overflow:hidden; }
#question,#answer,#next { text-align:center; padding:10px; height:12%; background-color:#ccc; font-size:8vh; }
#answer { float:left; width:85%; font-size:4vh; }
#next { float:right; width:10% }
#container { position: relative; }
#canvas { border: 1px solid #000; }
</style>
</head>
<body>
<div id="debug"></div>
<div id="wrap">
<?php

$sql = "SELECT COUNT(*) as total_count FROM KanjiCompound";
$result = $connection->query($sql);
$data = $result->fetch_assoc();
$kanji_compound_id = mt_rand(1,$data["total_count"]);

$sql = "SELECT * FROM KanjiCompound WHERE rid=".$kanji_compound_id;
$result = $connection->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    echo "An error occurred. Try refreshing the page.";
    exit();
}
$connection->close();

$show_expression_as_question = mt_rand(0,1);
if($show_expression_as_question) {
    $question = $row["expression"];
    $answer = $row["reading"];
} else {
    $answer = $row["expression"];
    $question = $row["reading"];
}
$meaning = $row["meaning"];

echo("<div id='question'>" . $question . "</div>");
?>

<div id="container">
    <canvas id="canvas" width="400" height="300">
        <p>Unfortunately, your browser is currently unsupported by our web
        application.  We are sorry for the inconvenience. Please use one of the
        supported browsers listed below, or draw the image you want using an
        offline tool.</p>
        <p>Supported browsers: <a href="http://www.opera.com">Opera</a>, <a
            href="http://www.mozilla.com">Firefox</a>, <a
            href="http://www.apple.com/safari">Safari</a>, and <a
            href="http://www.konqueror.org">Konqueror</a>.</p>
    </canvas>
</div>

<script type="text/javascript" src="canvas.js"></script>
<script>
function showAnswer() {
    document.getElementById('answer').innerHTML = '<?php echo($answer . "<br>" . $meaning); ?>';
}
</script>

<div id="answer" onclick="showAnswer()">Show Answer</div>
<a href="flashcard.php"><div id="next">&gt;</div></a>
</div>
</body>
</html>
