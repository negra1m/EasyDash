<?php header('Access-Control-Allow-Origin: *');
session_start();
include ("bd.php");

$week1 = strtotime("-1 week");
$week2 = strtotime("-2 week");
$week3 = strtotime("-3 week");
$week4 = strtotime("-4 week");

echo $week1.'<br>'.$week2.'<br>'.$week3.'<br>'.$week4;

//$qry = "SELECT  FROM "
?>