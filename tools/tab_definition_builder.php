<?php include($_SERVER['DOCUMENT_ROOT']."/include/kanjidb_connect.php");

// Create a definition builder from the given kanji
$f_input = htmlspecialchars($_POST['input']);
$output = "";

$f_input_arr = explode("\n", $f_input);
foreach($f_input_arr as $each_input) {
    $each_input = trim($each_input);
    $sql = "SELECT word_japanese, word_furigana, word_english FROM iKnow WHERE word_japanese='$each_input'";
    if($stmt = $connection->prepare($sql)) {
        $stmt->execute();
        $stmt->bind_result($word_japanese, $word_furigana, $word_english);

        $empty_result = true;
        while ($stmt->fetch()) {
            $output .= $word_japanese . "\t" . $word_furigana . "\t" . $word_english . "\n";
            $empty_result = false;
        }
        $stmt->close();

        if($empty_result) {
            $output .= $each_input . "\n";
        }
    }
}
$connection->close();

echo("
    <form id='iknowform' method='post'>
        <textarea name='input' style='float:left; width:50%; height:80%'>$f_input</textarea>
        <textarea name='output' style='width:50%; height:80%'>$output</textarea>
        <input type='submit' value='Submit'>
    <form>
");

?>
