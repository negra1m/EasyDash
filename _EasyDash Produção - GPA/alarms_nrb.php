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

	$ilu = "select ID, ALARMS_QTY_OPEN_ILU, ALARMS_HOUR from EASY_HISTORIC.ALARMS_GRAPHICS order by ID asc;";	
	$com = "select ID, ALARMS_QTY_OPEN_COM, ALARMS_HOUR from EASY_HISTORIC.ALARMS_GRAPHICS order by ID asc;";	
	$ilu_return = dbUpdate($ilu, 3);
	$com_return = dbUpdate($com, 3);

	$return = array($ilu_return, $com_return);

	// $result = $arrayName = array('' => , );

 	print_r(json_encode($return, JSON_UNESCAPED_UNICODE));
 	// print_r(json_encode($com_return, JSON_UNESCAPED_UNICODE));
 	//print_r($alarms_count);

?>