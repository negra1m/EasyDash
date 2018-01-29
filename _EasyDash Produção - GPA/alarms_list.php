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

$alarms1 = "CALL alarms_count()";
$alarms2 = "CALL alarms_list_ok()";
$alarms3 = "CALL alarms_list_nok()";

$alarms_count = dbUpdate($alarms1, 2);
$alarms_list_ok = dbUpdate($il_all_qry, 1);
$alarms_list_nok = dbUpdate($fa_man_qry, 1);

$dados = array(
    "alarms_count" => $alarms_count,
    "alarms_list_ok" => $alarms_list_ok,
    "alarms_list_nok" => $alarms_list_nok
);

print_r(json_encode($dados));
?>