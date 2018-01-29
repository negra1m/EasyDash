<?php
header('Access-Control-Allow-Origin: *');
// seting the database parameters...
$servername = "10.155.131.16";
$username = "easy";
$password = "easy";
$dbname = "EASY_HISTORIC";
$cond = $_GET['condicao'];
// create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// check connection
if($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sqliluminacao = '
SELECT date_format(from_unixtime(r1.ts/1000), "%d-%m-%Y %h:%i:%s") as "Data", r2.xid as "Loja", r1.pointValue as "Status"
FROM (
	SELECT pointValue, dataPointId, ts FROM easy.pointValues WHERE ts < ((unix_timestamp()) * 1000) AND ts > ( (unix_timestamp()-15*60) * 1000)
) r1
JOIN (
	SELECT dataSourceId, id, xid FROM easy.dataPoints WHERE xid like "%IL%"
) r2
ON r2.id = r1.dataPointId
WHERE r1.pointValue = 0 or r1.pointValue <= 99
ORDER BY r2.xid;
';

$sqlac = '
SELECT date_format(from_unixtime(r1.ts/1000), "%d-%m-%Y %h:%i:%s") as "Data", r2.xid as "Loja", r1.pointValue as "Status"
FROM (
    SELECT pointValue, dataPointId, ts FROM easy.pointValues WHERE ts < ((unix_timestamp()) * 1000) AND ts > ( (unix_timestamp()-15*60) * 1000)
) r1
JOIN (
    SELECT dataSourceId, id, xid FROM easy.dataPoints WHERE xid like "%AC__R__%"
) r2
ON r2.id = r1.dataPointId
WHERE r1.pointValue = 0 or r1.pointValue <= 99
ORDER BY r2.xid
';

$sqlfrioalimentar = '
SELECT date_format(from_unixtime(r1.ts/1000), "%d-%m-%Y %h:%i:%s") as "Data", r2.xid as "Loja", r1.pointValue as "Status"
FROM (
    SELECT pointValue, dataPointId, ts FROM easy.pointValues WHERE ts < ((unix_timestamp()) * 1000) AND ts > ( (unix_timestamp()-15*60) * 1000)
) r1
JOIN (
    SELECT dataSourceId, id, xid FROM easy.dataPoints WHERE xid like "%FA__CG_" or xid like "%FA__RF_"
) r2
ON r2.id = r1.dataPointId
WHERE r1.pointValue = 0 or r1.pointValue <= 99
ORDER BY r2.xid;
';
if ($cond == 1){
    $search = $sqliluminacao;
    $filename = "iluminacao.csv";
}else if($cond == 2){
    $search = $sqlfrioalimentar;
    $filename = "frio-alimentar.csv";
}else if($cond == 3){
    $search = $sqlac;
    $filename = "ar-condicionado.csv";
}
$result = mysqli_query($conn, $search);
echo $search;
echo "<br>";
if (!$result) {
    die('Invalid query: ');
}

$f = fopen($filename, "w");
fputcsv($f, array('Data', 'Loja', 'Status'));
 while($row = $result->fetch_assoc()) {
    fputcsv($f, $row);
}
echo $f;
?>