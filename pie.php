<?php header('Access-Control-Allow-Origin: *');
session_start();
include ("db_pie.php");
$dt_ini = date('Y-m-d'); //2017-11-01

$il = "%IL%"; //iluminação
$ac = "%AC_____"; //ar condicionado
$rf = '';
$all = 3; //todas as lojas
$manu = 0; //lojas em manual

$il_man_qry = "CALL status_lojas('$dt_ini', '$il', '$manu')";
$il_all_qry = "CALL status_lojas('$dt_ini', '$il', '$all')";

$fa_man_qry = "CALL status_fa('$dt_ini', '$rf', '$manu')";
$fa_all_qry = "CALL status_fa('$dt_ini', '$rf', $all)";

$ac_man_qry = "CALL status_lojas('$dt_ini', '$ac', '$manu')";
$ac_all_qry = "CALL status_lojas('$dt_ini', '$ac', '$all')";

$il_man = dbUpdate($il_man_qry);
$il_all = dbUpdate($il_all_qry);
$fa_man = dbUpdate($fa_man_qry);
$fa_all = dbUpdate($fa_all_qry);
$ac_man = dbUpdate($ac_man_qry);
$ac_all = dbUpdate($ac_all_qry);

$dados = array(
    "il_man" => $il_man,
    "il_all" => $il_all,
    "fa_man" => $fa_man,
    "fa_all" => $fa_all,
    "ac_man" => $ac_man,
    "ac_all" => $ac_all
);

print_r(json_encode($dados));
/*call status_lojas('2017-11-01', '0')*/
?>