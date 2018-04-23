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
$dt_ini = date('Y-m-d'); //Ex.: 2017-11-01
$alarms=0;

	$alarms1 = "SELECT SUBSTR(message, 21, 4) AS loja,
					   CASE when SUBSTR(message, 26, 43) = 'Sem Comunicação|' then 'Sem Comunicação' else SUBSTR(message, 26, 43) END AS mensagem,
					   DATE_FORMAT(FROM_UNIXTIME(activeTs / 1000),'%d/%m/%Y %H:%i') AS inicio
				FROM
    				easy.events
				WHERE
    				activeTs IS NOT NULL AND rtnTs IS NULL AND alarmLevel = 3
				ORDER BY activeTs desc;";			
	$alarms_count = dbUpdate($alarms1, 3);
 	print_r(json_encode($alarms_count, JSON_UNESCAPED_UNICODE));

?>
