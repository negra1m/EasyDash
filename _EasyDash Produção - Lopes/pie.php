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
//  Data to build chart (Pie type) by AJAX require.
//
/* ****************************************************************** */
header('Access-Control-Allow-Origin: *');
session_start();
include ("db.php");
$dt_ini = date('Y-m-d'); //2017-11-01

$il = "%IL%"; //iluminação 
$ac = "%AC_____"; //ar condicionado -- NÃO USADO NO LOPES
$rf = '';
$all = 99	; //todas as lojas
$manu = 0; //lojas em manual

$il_man_qry = "CALL status_lojas('$dt_ini', '$il', '$manu')";
$il_all_qry = "CALL status_lojas('$dt_ini', '$il', '$all')";

$fa_man_qry = "CALL status_fa('$dt_ini', '$rf', '$manu')";
$fa_all_qry = "CALL status_fa('$dt_ini', '$rf', $all)";

/*
***************NAO UTILIZADO NO LOPES************************
$ac_man_qry = "CALL status_lojas('$dt_ini', '$ac', '$manu')";
$ac_all_qry = "CALL status_lojas('$dt_ini', '$ac', '$all')";*/

$il_man = dbUpdate($il_man_qry, 2);
$il_all = dbUpdate($il_all_qry, 2);
$fa_man = dbUpdate($fa_man_qry, 2);
$fa_all = dbUpdate($fa_all_qry, 2);
/*
***************NAO UTILIZADO NO LOPES************************
$ac_man = dbUpdate($ac_man_qry, 2);
$ac_all = dbUpdate($ac_all_qry, 2);**************************/

$dados = array(
    "il_man" => $il_man,
    "il_all" => $il_all,
    "fa_man" => $fa_man,
    "fa_all" => $fa_all
/*
***************NAO UTILIZADO NO LOPES************************
"ac_man" => $ac_man,
    // "ac_all" => $ac_all***********************************/
);

print_r(json_encode($dados));
?>