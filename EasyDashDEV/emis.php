<?php 
/* ******************************************************************/
//  *************************** Easy Dash ***************************
//
//  Description: A tool to show Easy Vision data into Charts powered by
//  Chart-JS.
//  Author: Vinícius Negrão e Filipe Aparecido 
//  Company: GreenYellow do Brasil.
//  Git: www.github.com/vinegrao95/EasyDash
//
/* ******************************************************************/
//  Data to build chart (PIE type) by AJAX require.
/* ******************************************************************/
header('Access-Control-Allow-Origin: *');
session_start();
include ("db.php");
$semana_atual = date('W'); //Ex.: 2017-11-01
$dt_ini = date('Y-m-d');

$qry1="SELECT * FROM emis.dados_emis where Economia < (Target - (Target * 0.10))"; /*vermelha*/
$qry2="SELECT * FROM emis.dados_emis where Economia > (Target)"; /*verde*/
$qry3="SELECT * FROM emis.dados_emis where Economia >= (Target - (Target * 0.10)) and Economia <= (Target)"; /*preta*/

$cond=2; //representa que o retorno será um array com índices nominais.

$vermelha = dbUpdate($qry1, $cond, "EASY_HISTORIC");
$verde = dbUpdate($qry2, $cond, "EASY_HISTORIC");
$preta = dbUpdate($qry3, $cond, "EASY_HISTORIC");

$dados = array(
    "loja_vermelha" => $vermelha,
    "loja_verde" => $verde,
    "loja_neutra" => $preta
);
print_r(json_encode($dados));
?>
