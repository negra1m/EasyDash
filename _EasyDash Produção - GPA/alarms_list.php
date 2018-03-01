<?php 
/* ****************************************************************** */
//
//  ***** ***** ***** ********* Easy Dash ********* ***** ***** *****
//
//  Description: A tool to show Easy Vision data into Charts powered by
//  Chart-JS.
//
//  Author: Vinícius Negrão
//  Company: GreenYellow do Brasil.
//  Git: www.github.com/vinegrao95/EasyDash
//
/* ****************************************************************** */

/* ****************************************************************** */
//
//  Data to build alarms List by AJAX require.
//  and to build the graph of alarms number in a period.
//
/* ****************************************************************** */
session_start();
include ("db.php");
header('Access-Control-Allow-Origin: *');
$dt_ini = date('Y-m-d'); //2017-11-01
$alarms=0;

	$alarms1 = "select SUBSTR(message, 21, 4) AS loja, SUBSTR(message, 26, 43) AS mensagem,  date_format(from_unixtime(activeTs/1000), '%d/%m/%Y %H:%i')  as inicio from easy.events WHERE activeTs is not null and rtnTs is null and alarmLevel = 3 order by inicio desc;";			
	$alarms_count = dbUpdate($alarms1, 3);
 	print_r(json_encode($alarms_count, JSON_UNESCAPED_UNICODE));

?>