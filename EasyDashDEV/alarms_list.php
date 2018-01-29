<?php 
/* ****************************************************************** */
//
//  ***** ***** ***** ********* Easy Dash ********* ***** ***** *****
//
//  Description: A tool to show Easy Vision data into Charts powered by
//  Chart-JS.
//
//  Author: Vinícius Negrão e Filipe Aparecido 
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
header('Access-Control-Allow-Origin: *');
session_start();
include ("db.php");
$dt_ini = date('Y-m-d'); //2017-11-01
$alarms=0;

$alarms1 = "select message, activeTs from easy.events WHERE activeTs is not null and rtnTs is null and alarmLevel = 3";

$alarms_count = dbUpdate($alarms1, 3);
//$nonsequential = array(1=>"foo", 2=>"bar", 3=>"baz", 4=>"blong");
var_dump(
 $alarms_count,
 json_encode($alarms_count)
);
?>