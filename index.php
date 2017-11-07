<?php header('Access-Control-Allow-Origin: *');
session_start();
include ("db.php");
$semana_atual = date('W'); //2017-11-01
$dt_ini = date('Y-m-d');
$semana1_query = $semana_atual - 1;
$semana2_query = $semana_atual - 2;
$semana3_query = $semana_atual - 3;



$dados_semana_atual = "select * from EASY_HISTORIC.STORE_STATUS WHERE SEMANA_NUMERO = $semana_atual";
$dados_semana1 = "select ALL_IL, MANU_IL, ALL_FA, MANU_FA, ALL_AC, MANU_AC from STORE_STATUS WHERE SEMANA_NUMERO = $semana1_query";
$dados_semana2 = "select ALL_IL, MANU_IL, ALL_FA, MANU_FA, ALL_AC, MANU_AC from STORE_STATUS WHERE SEMANA_NUMERO = $semana2_query";
$dados_semana3 = "select ALL_IL, MANU_IL, ALL_FA, MANU_FA, ALL_AC, MANU_AC from STORE_STATUS WHERE SEMANA_NUMERO = $semana3_query";

$atual = dbUpdate($dados_semana_atual);
$semana1 = dbUpdate($dados_semana1);
$semana2 = dbUpdate($dados_semana2);
$semana3 = dbUpdate($dados_semana3);


$dados = array(
    //ATUAL
    "il_man_atual" => $atual['MANU_IL'],
    "il_all_atual" => $atual['ALL_IL'],
    "fa_man_atual" => $atual['MANU_FA'],
    "fa_all_atual" => $atual['ALL_FA'],
    "ac_man_atual" => $atual['MANU_AC'],
    "ac_all_atual" => $atual['ALL_AC'],
    //SEMANA -1
    "il_all_1" => $semana1['ALL_IL'],
    "il_man_1" => $semana1['MANU_IL'],
    "fa_man_1" => $semana1['MANU_FA'],
    "fa_all_1" => $semana1['ALL_FA'],
    "ac_man_1" => $semana1['MANU_AC'],
    "ac_all_1" => $semana1['ALL_AC'],
    //SEMANA -2
    "il_all_2" => $semana2['ALL_IL'],
    "il_man_2" => $semana2['MANU_IL'],
    "fa_man_2" => $semana2['MANU_FA'],
    "fa_all_2" => $semana2['ALL_FA'],
    "ac_man_2" => $semana2['MANU_AC'],
    "ac_all_2" => $semana2['ALL_AC'],
    //SEMANA -3
    "il_all_3" => $semana3['ALL_IL'],
    "il_man_3" => $semana3['MANU_IL'],
    "fa_man_3" => $semana3['MANU_FA'],
    "fa_all_3" => $semana3['ALL_FA'],
    "ac_man_3" => $semana3['MANU_AC'],
    "ac_all_3" => $semana3['ALL_AC']
);

print_r(json_encode($dados));
/*call status_lojas('2017-11-01', '0')*/
?>