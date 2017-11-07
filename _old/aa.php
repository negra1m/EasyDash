<?php header('Access-Control-Allow-Origin: *');
session_start();
include ("bd.php");
$datas = array(
	(time() - (8*24*60*60)), 
	(time() - (6*24*60*60)),
	(time() - (15*24*60*60)), 
	(time() - (13*24*60*60)), 
	(time() - (22*24*60*60)), 
	(time() - (20*24*60*60)),
	(time() - (29*24*60*60)),
	(time() - (27*24*60*60))
);

include ("queries.php");

$il = array();
$ac = array();
$fa = array();
//$semana4 = array();

$ilu_sem1 = mysqli_query($conn, $sem1_ilu_manual);
$ilu_sem2 = mysqli_query($conn, $sem2_ilu_manual);
$ilu_sem3 = mysqli_query($conn, $sem3_ilu_manual);
$ilu_sem4 = mysqli_query($conn, $sem4_ilu_manual);

$ac_sem1 = mysqli_query($conn, $sem1_ac_manual);
$ac_sem2 = mysqli_query($conn, $sem2_ac_manual);
$ac_sem3 = mysqli_query($conn, $sem3_ac_manual);
$ac_sem4 = mysqli_query($conn, $sem4_ac_manual);

$fa_sem1 = mysqli_query($conn, $sem1_fa_manu);
$fa_sem2 = mysqli_query($conn, $sem2_fa_manu);
$fa_sem3 = mysqli_query($conn, $sem3_fa_manu);
$fa_sem4 = mysqli_query($conn, $sem4_fa_manu);

for ($x=0; $x==10; $x++){
	if(mysqli_num_rows($ilu_sem[x])){
		array_push($il, mysqli_num_rows($ilu_sem[x]));
        $x++;
	}else{
        array_push($il, 0);
    }
}
for ($x=0; $x=10; $x++){
    if(mysqli_num_rows($ac_sem[x]))
    {
        array_push($ac, mysqli_num_rows($ac_sem[x]));
        $x++;
    }
    else{
        array_push($ac, 0);
    }
}
for ($x=0; $x=10; $x++){
    if(mysqli_num_rows($fa_sem[x])){
        array_push($fa, mysqli_num_rows($fa_sem[x]));
        $x++;
    }else{
        array_push($fa, 0);
        
    }
}

$array = array(
    "il1" => $il[0],
    "ac1" => $ac[0],
    "fa1" => $fa[0],

    "il2" => $il[1],
    "ac2" => $ac[1],
    "fa2" => $fa[1],

    "il3" => $il[2],
    "ac3" => $ac[2],
    "fa3" => $fa[2],

    "il4" => $il[3],
    "ac4" => $ac[3],
    "fa4" => $fa[3],
);
//$mysqli->close();
print_r(json_encode($array));
?>