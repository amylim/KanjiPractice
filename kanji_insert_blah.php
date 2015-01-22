<?php
echo("Nothing to do.");
exit();

include("include/kanjidb_admin_connect.php"); 

mysql_query("SET NAMES utf8");
$sql = "
    INSERT INTO KanjiCompound (related_kanji, expression, reading, meaning)
    VALUES (1,'選ぶ','えらぶ','to select'),
        (1,'選択','せんたく','choice'),
(1,'選手','せんしゅ','team member'),
(2,'言葉','ことば','language'),
(2,'紅葉','こうよう','fall colors'),
(3,'農業','のうぎょう','agriculture'),
(3,'農家','のうか','farm family'),
(3,'農場','のうじょう','farm family'),
(4,'便り','たより','news'),
(4,'便利','べんり','convenient'),
(5,'利子','りし','interest (bank)'),
(5,'左利き','ひだりきき','left handed'),
(6,'伝わる','つたわる','to be handed down'),
(6,'伝える','つたえる','to communicate'),
(6,'伝言','でんごん','message'),
(6,'伝説','でんせつ','legend'),
(7,'収める','おさめる','to finish'),
(7,'収まる','おさまる','to be obtained'),
(7,'収穫','しゅうかく','harvest'),
(7,'収入','しゅうにゅう','income'),
(7,'年収','ねんしゅう','annual income'),
(8,'収穫','しゅうかく','harvest; crop'),
(9,'忙しい','いそがしい','busy'),
(9,'多忙','たぼう','very busy'),
(10,'向く','むく','face other side'),
(10,'向こう','むこう','other side'),
(10,'方向','ほうこう','direction'),
(11,'肩','かた','shoulder'),
(11,'右肩','みぎかた','right shoulder'),
(11,'肩書き','かたがき','title'),
(12,'仲間','なかま','buddy'),
(12,'仲直り','なかなおり','reconsiliation'),
(13,'移る','うつる','to move (house)'),
(13,'移す','うつす','to change'),
(13,'移転','いてん','relocation'),
(13,'移動','いどう','move'),
(14,'押す','おす','support'),
(14,'推量','すいりょう','guess (n.)'),
(14,'推移','すいい','transition'),
(15,'量る','はかる','measure (something)'),
(15,'重量','じゅうりょう','weight'),
(15,'大量','たいりょう','large amount'),
(16,'受ける','うける','to receive'),
(16,'受かる','うかる','to pass'),
(16,'受話器','じゅわき','receiver'),
(16,'受験','じゅけん','taking an examination'),
(17,'出身','しゅっしん','person\'s origin'),
(17,'身分','みぶん','social status'),
(17,'身長','しんちょう','height (of body)'),
(18,'将来','しょうらい','future'),
(18,'将軍','しょうぐん','general'),
(18,'主将','しゅしょう','commander-in-chief'),
(19,'余暇','よか','leisure time'),
(19,'休暇','きゅうか','holiday'),
(20,'遊園地','ゆうえんち','amusement park'),
(20,'遊ぶ','あそぶ','to play'),
(20,'遊び','あそび','playing'),
(21,'接する','せっする','to touch'),
(21,'接ぐ','つぐ','to join'),
(21,'直接','ちょくせつ','direct; immediate'),
(21,'面接','めんせつ','interview'),
(21,'接近','せっきん','getting closer; approaching'),
(22,'村人','むらびと','villager'),
(22,'農村','のうそん','farm village; rural'),
(22,'村長','そんちょう','village headman'),
(23,'山林','さんりん','forest on a mountain'),
(23,'人工林','じんこうりん','planted forest'),
(24,'森林','しんりん','forest on a mountain'),
(24,'青森','あおもり','Aomori (prefecture)'),
(25,'雨雲','あまぐも','rain cloud'),
(25,'風雲','ふううん','nature; the elements'),
(26,'公園','こうえん','park'),
(26,'動物園','どうぶつえん','zoo'),
(27,'合う','あう','to unite'),
(27,'話し合う','はなしあう','discuss'),
(27,'会合','かいごう','meeting; assembly'),
(28,'晴天','せいてん','fine weather'),
(28,'晴雨','せいう','shine or rain'),
(29,'草花','くさばな','flower'),
(29,'草木','くさき','visitation'),
(30,'頭痛','ずつう','headache'),
(30,'先頭','せんとう','first; lead');
";

if ($connection->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $connection->error;
}

$connection->close();
?>
