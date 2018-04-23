<?php 
/* ****************************************************************** */
//  ***** ***** ***** ********* Easy Dash ********* ***** ***** *****
//
//  Description: A tool to show Easy Vision data into Charts powered by
//  Chart-JS.
//
//  Author: Vinícius Negrão e Filipe Aparecido 
//  Company: GreenYellow do Brasil.
//  Git: www.github.com/vinegrao95/EasyDash
/* ****************************************************************** */
//  Data to build chart (Pie type) by AJAX require.
/* ****************************************************************** */
header('Access-Control-Allow-Origin: *');
session_start();
include ("db.php");
$dt_ini = date('Y-m-d'); //2017-11-01

$il = "%\_IL%"; //iluminação
$ac = "%AC_____"; //ar condicionado
$rf = "\"%FA__CG_\" or dp.xid like  \"%FA__RF_\"";
$automatico = "AUTOMATICO"; //todas as lojas
$manu = "MANUAL"; //lojas em manual

$il_man_qry = "CALL StatusLojas('$il', '$manu')";
$il_auto_qry = "CALL StatusLojas('$il', '$automatico')";

$fa_man_qry = "CALL StatusLojas('$rf', '$manu')";
$fa_auto_qry = "CALL StatusLojas('$rf', '$automatico')";

$ac_man_qry = "CALL StatusLojas('$ac', '$manu')";
$ac_auto_qry = "CALL StatusLojas('$ac', '$automatico')";

$il_man = dbUpdate($il_man_qry, 2, "EASY_HISTORIC");
$il_auto = dbUpdate($il_auto_qry, 2, "EASY_HISTORIC");
//$fa_man = dbUpdate($fa_man_qry, 2, "EASY_HISTORIC");
//$fa_all = dbUpdate($fa_auto_qry, 2, "EASY_HISTORIC");
$ac_man = dbUpdate($ac_man_qry, 2, "EASY_HISTORIC");
$ac_auto = dbUpdate($ac_auto_qry, 2, "EASY_HISTORIC");

$dados = array(
    "il_man" => $il_man,
    "il_auto" => $il_auto,
    //"fa_man" => $fa_man,
    //"fa_auto" => $fa_all,
    "ac_man" => $ac_man,
    "ac_auto" => $ac_auto
);

print_r(json_encode($dados));
?>