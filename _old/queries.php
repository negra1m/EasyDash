<?php 

/*	ILUMINAÇÃO MANUAL */
$sem1_ilu_manual = "
where dp.xid like '%IL%' SELECT max(DATE_FORMAT(FROM_UNIXTIME(ts/1000), '%d-%m-%Y')) AS 'date_formatted', pv.pointValue, dp.xid 
from dataPoints dp 
join pointValues pv on 
dp.id=pv.dataPointId
and pv.pointValue = 0
and (DATE_FORMAT(FROM_UNIXTIME(ts/1000), '%d-%m-%Y') > DATE_FORMAT(FROM_UNIXTIME($datas[0]), '%d-%m-%Y'))
and (DATE_FORMAT(FROM_UNIXTIME(ts/1000), '%d-%m-%Y') < DATE_FORMAT(FROM_UNIXTIME($datas[1]), '%d-%m-%Y'))
group by dp.dataSourceId;";

$sem2_ilu_manual = "SELECT max(DATE_FORMAT(FROM_UNIXTIME(ts/1000), '%d-%m-%Y')) AS 'date_formatted', pv.pointValue, dp.xid 
from dataPoints dp 
join pointValues pv on 
dp.id=pv.dataPointId
where dp.xid like '%IL%' 
and pv.pointValue = 0
and (DATE_FORMAT(FROM_UNIXTIME(ts/1000), '%d-%m-%Y') > DATE_FORMAT(FROM_UNIXTIME($datas[2]), '%d-%m-%Y'))
and (DATE_FORMAT(FROM_UNIXTIME(ts/1000), '%d-%m-%Y') < DATE_FORMAT(FROM_UNIXTIME($datas[3]), '%d-%m-%Y'))
group by dp.dataSourceId;";

$sem3_ilu_manual = "SELECT max(DATE_FORMAT(FROM_UNIXTIME(ts/1000), '%d-%m-%Y')) AS 'date_formatted', pv.pointValue, dp.xid 
from dataPoints dp 
join pointValues pv on 
dp.id=pv.dataPointId
where dp.xid like '%IL%' 
and pv.pointValue = 0
and (DATE_FORMAT(FROM_UNIXTIME(ts/1000), '%d-%m-%Y') > DATE_FORMAT(FROM_UNIXTIME($datas[4]), '%d-%m-%Y'))
and (DATE_FORMAT(FROM_UNIXTIME(ts/1000), '%d-%m-%Y') < DATE_FORMAT(FROM_UNIXTIME($datas[5]), '%d-%m-%Y'))
group by dp.dataSourceId;";

$sem4_ilu_manual = "SELECT max(DATE_FORMAT(FROM_UNIXTIME(ts/1000), '%d-%m-%Y')) AS 'date_formatted', pv.pointValue, dp.xid 
from dataPoints dp 
join pointValues pv on 
dp.id=pv.dataPointId
where dp.xid like '%IL%' 
and pv.pointValue = 0
and (DATE_FORMAT(FROM_UNIXTIME(ts/1000), '%d-%m-%Y') > DATE_FORMAT(FROM_UNIXTIME($datas[6]), '%d-%m-%Y'))
and (DATE_FORMAT(FROM_UNIXTIME(ts/1000), '%d-%m-%Y') < DATE_FORMAT(FROM_UNIXTIME($datas[7]), '%d-%m-%Y'))
group by dp.dataSourceId;";

/*AC MANUAL*/ 

$sem1_ac_manual = "SELECT max(DATE_FORMAT(FROM_UNIXTIME(ts/1000), '%d-%m-%Y')) AS 'date_formatted', pv.pointValue, dp.xid 
from dataPoints dp 
join pointValues pv on 
dp.id=pv.dataPointId
where dp.xid like '%AC_____%'
and pv.pointValue = 0
and (DATE_FORMAT(FROM_UNIXTIME(ts/1000), '%d-%m-%Y') > DATE_FORMAT(FROM_UNIXTIME($datas[0]), '%d-%m-%Y'))
and (DATE_FORMAT(FROM_UNIXTIME(ts/1000), '%d-%m-%Y') < DATE_FORMAT(FROM_UNIXTIME($datas[1]), '%d-%m-%Y'))
group by dp.xid;";

$sem2_ac_manual = "SELECT max(DATE_FORMAT(FROM_UNIXTIME(ts/1000), '%d-%m-%Y')) AS 'date_formatted', pv.pointValue, dp.xid 
from dataPoints dp 
join pointValues pv on 
dp.id=pv.dataPointId
where dp.xid like '%AC_____%'
and pv.pointValue = 0
and (DATE_FORMAT(FROM_UNIXTIME(ts/1000), '%d-%m-%Y') > DATE_FORMAT(FROM_UNIXTIME($datas[2]), '%d-%m-%Y'))
and (DATE_FORMAT(FROM_UNIXTIME(ts/1000), '%d-%m-%Y') < DATE_FORMAT(FROM_UNIXTIME($datas[3]), '%d-%m-%Y'))
group by dp.xid;";

$sem3_ac_manual = "SELECT max(DATE_FORMAT(FROM_UNIXTIME(ts/1000), '%d-%m-%Y')) AS 'date_formatted', pv.pointValue, dp.xid 
from dataPoints dp 
join pointValues pv on 
dp.id=pv.dataPointId
where dp.xid like '%AC_____%'
and pv.pointValue = 0
and (DATE_FORMAT(FROM_UNIXTIME(ts/1000), '%d-%m-%Y') > DATE_FORMAT(FROM_UNIXTIME($datas[4]), '%d-%m-%Y'))
and (DATE_FORMAT(FROM_UNIXTIME(ts/1000), '%d-%m-%Y') < DATE_FORMAT(FROM_UNIXTIME($datas[5]), '%d-%m-%Y'))
group by dp.xid;";

$sem4_ac_manual = "SELECT max(DATE_FORMAT(FROM_UNIXTIME(ts/1000), '%d-%m-%Y')) AS 'date_formatted', pv.pointValue, dp.xid 
from dataPoints dp 
join pointValues pv on 
dp.id=pv.dataPointId
where dp.xid like '%AC_____%'
and pv.pointValue = 0
and (DATE_FORMAT(FROM_UNIXTIME(ts/1000), '%d-%m-%Y') > DATE_FORMAT(FROM_UNIXTIME($datas[6]), '%d-%m-%Y'))
and (DATE_FORMAT(FROM_UNIXTIME(ts/1000), '%d-%m-%Y') < DATE_FORMAT(FROM_UNIXTIME($datas[7]), '%d-%m-%Y'))
group by dp.xid;";

#MANUAL FA CONGELADOS   where (dp.xid like '%FA__CG_' or dp.xid like '%FA__RF_')
$sem1_fa_manu= "SELECT max(DATE_FORMAT(FROM_UNIXTIME(ts/1000), '%d-%m-%Y')) AS 'date_formatted', pv.pointValue, dp.xid 
from dataPoints dp 
join pointValues pv on 
dp.id=pv.dataPointId
where (dp.xid like '%FA__CG_' or dp.xid like '%FA__RF_')
and pv.pointValue = 0
and (DATE_FORMAT(FROM_UNIXTIME(ts/1000), '%d-%m-%Y') > DATE_FORMAT(FROM_UNIXTIME($datas[0]), '%d-%m-%Y'))
and (DATE_FORMAT(FROM_UNIXTIME(ts/1000), '%d-%m-%Y') < DATE_FORMAT(FROM_UNIXTIME($datas[1]), '%d-%m-%Y'))
group by dp.xid;";

$sem2_fa_manu= "SELECT max(DATE_FORMAT(FROM_UNIXTIME(ts/1000), '%d-%m-%Y')) AS 'date_formatted', pv.pointValue, dp.xid 
from dataPoints dp 
join pointValues pv on 
dp.id=pv.dataPointId
where (dp.xid like '%FA__CG_' or dp.xid like '%FA__RF_')
and pv.pointValue = 0
and (DATE_FORMAT(FROM_UNIXTIME(ts/1000), '%d-%m-%Y') > DATE_FORMAT(FROM_UNIXTIME($datas[2]), '%d-%m-%Y'))
and (DATE_FORMAT(FROM_UNIXTIME(ts/1000), '%d-%m-%Y') < DATE_FORMAT(FROM_UNIXTIME($datas[3]), '%d-%m-%Y'))
group by dp.xid;";

$sem3_fa_manu= "SELECT max(DATE_FORMAT(FROM_UNIXTIME(ts/1000), '%d-%m-%Y')) AS 'date_formatted', pv.pointValue, dp.xid 
from dataPoints dp 
join pointValues pv on 
dp.id=pv.dataPointId
where (dp.xid like '%FA__CG_' or dp.xid like '%FA__RF_')
and pv.pointValue = 0
and (DATE_FORMAT(FROM_UNIXTIME(ts/1000), '%d-%m-%Y') > DATE_FORMAT(FROM_UNIXTIME($datas[4]), '%d-%m-%Y'))
and (DATE_FORMAT(FROM_UNIXTIME(ts/1000), '%d-%m-%Y') < DATE_FORMAT(FROM_UNIXTIME($datas[5]), '%d-%m-%Y'))
group by dp.xid;";

$sem4_fa_manu= "SELECT max(DATE_FORMAT(FROM_UNIXTIME(ts/1000), '%d-%m-%Y')) AS 'date_formatted', pv.pointValue, dp.xid 
from dataPoints dp 
join pointValues pv on 
dp.id=pv.dataPointId
where (dp.xid like '%FA__CG_' or dp.xid like '%FA__RF_')
and pv.pointValue = 0
and (DATE_FORMAT(FROM_UNIXTIME(ts/1000), '%d-%m-%Y') > DATE_FORMAT(FROM_UNIXTIME($datas[6]), '%d-%m-%Y'))
and (DATE_FORMAT(FROM_UNIXTIME(ts/1000), '%d-%m-%Y') < DATE_FORMAT(FROM_UNIXTIME($datas[7]), '%d-%m-%Y'))
group by dp.xid;";

/*	ILUMINAÇÃO AUTOMATICO 

$sem1_ilu_auto = "select max(DATE_FORMAT(FROM_UNIXTIME(ts/1000), '%d-%m-%Y')) AS 'date_formatted', pv.pointValue, dp.xid 
from dataPoints dp 
join pointValues pv on 
dp.id=pv.dataPointId
where dp.xid like '%IL%' 
and pv.pointValue = 1
and (DATE_FORMAT(FROM_UNIXTIME(ts/1000), '%d-%m-%Y') > (DATE_FORMAT(FROM_UNIXTIME(".$datas[0]."/1000), '%d-%m-%Y'))
and (DATE_FORMAT(FROM_UNIXTIME(ts/1000), '%d-%m-%Y') < (DATE_FORMAT(FROM_UNIXTIME(".$datas[1]."/1000), '%d-%m-%Y')))
group by dp.dataSourceId;";

$sem2_ilu_auto = "select max(DATE_FORMAT(FROM_UNIXTIME(ts/1000), '%d-%m-%Y')) AS 'date_formatted', pv.pointValue, dp.xid 
from dataPoints dp 
join pointValues pv on 
dp.id=pv.dataPointId
where dp.xid like '%IL%' 
and pv.pointValue = 1
and (DATE_FORMAT(FROM_UNIXTIME(ts/1000), '%d-%m-%Y') > (DATE_FORMAT(FROM_UNIXTIME(".$datas[2]."/1000), '%d-%m-%Y'))
and (DATE_FORMAT(FROM_UNIXTIME(ts/1000), '%d-%m-%Y') < (DATE_FORMAT(FROM_UNIXTIME(".$datas[3]."/1000), '%d-%m-%Y')))
group by dp.dataSourceId;";

$sem3_ilu_auto = "select max(DATE_FORMAT(FROM_UNIXTIME(ts/1000), '%d-%m-%Y')) AS 'date_formatted', pv.pointValue, dp.xid 
from dataPoints dp 
join pointValues pv on 
dp.id=pv.dataPointId
where dp.xid like '%IL%' 
and pv.pointValue = 1
and (DATE_FORMAT(FROM_UNIXTIME(ts/1000), '%d-%m-%Y') > (DATE_FORMAT(FROM_UNIXTIME(".$datas[4]."/1000), '%d-%m-%Y'))
and (DATE_FORMAT(FROM_UNIXTIME(ts/1000), '%d-%m-%Y') < (DATE_FORMAT(FROM_UNIXTIME(".$datas[5]."/1000), '%d-%m-%Y')))
group by dp.dataSourceId;";

$sem4_ilu_auto = "select max(DATE_FORMAT(FROM_UNIXTIME(ts/1000), '%d-%m-%Y')) AS 'date_formatted', pv.pointValue, dp.xid 
from dataPoints dp 
join pointValues pv on 
dp.id=pv.dataPointId
where dp.xid like '%IL%' 
and pv.pointValue = 1
and (DATE_FORMAT(FROM_UNIXTIME(ts/1000), '%d-%m-%Y') > (DATE_FORMAT(FROM_UNIXTIME(".$datas[6]."/1000), '%d-%m-%Y'))
and (DATE_FORMAT(FROM_UNIXTIME(ts/1000), '%d-%m-%Y') < (DATE_FORMAT(FROM_UNIXTIME(".$datas[7]."/1000), '%d-%m-%Y')))
group by dp.dataSourceId;";

*/

/*AC AUTOMATICO

$sem1_ac_auto = "select max(DATE_FORMAT(FROM_UNIXTIME(ts/1000), '%d-%m-%Y')) AS 'date_formatted', pv.pointValue, dp.xid 
from dataPoints dp 
join pointValues pv on 
dp.id=pv.dataPointId
where dp.xid like '%AC_____'
and pv.pointValue = 1
and (DATE_FORMAT(FROM_UNIXTIME(ts/1000), '%d-%m-%Y') > (DATE_FORMAT(FROM_UNIXTIME(".$datas[0]."/1000), '%d-%m-%Y'))
and (DATE_FORMAT(FROM_UNIXTIME(ts/1000), '%d-%m-%Y') < (DATE_FORMAT(FROM_UNIXTIME(".$datas[1]."/1000), '%d-%m-%Y')))
group by dp.dataSourceId;";

$sem2_ac_auto = "select max(DATE_FORMAT(FROM_UNIXTIME(ts/1000), '%d-%m-%Y')) AS 'date_formatted', pv.pointValue, dp.xid 
from dataPoints dp 
join pointValues pv on 
dp.id=pv.dataPointId
where dp.xid like '%AC_____'
and pv.pointValue = 1
and (DATE_FORMAT(FROM_UNIXTIME(ts/1000), '%d-%m-%Y') > (DATE_FORMAT(FROM_UNIXTIME(".$datas[2]."/1000), '%d-%m-%Y'))
and (DATE_FORMAT(FROM_UNIXTIME(ts/1000), '%d-%m-%Y') < (DATE_FORMAT(FROM_UNIXTIME(".$datas[3]."/1000), '%d-%m-%Y')))
group by dp.dataSourceId;";

$sem3_ac_auto = "select max(DATE_FORMAT(FROM_UNIXTIME(ts/1000), '%d-%m-%Y')) AS 'date_formatted', pv.pointValue, dp.xid 
from dataPoints dp 
join pointValues pv on 
dp.id=pv.dataPointId
where dp.xid like '%AC_____'
and pv.pointValue = 1
and (DATE_FORMAT(FROM_UNIXTIME(ts/1000), '%d-%m-%Y') > (DATE_FORMAT(FROM_UNIXTIME(".$datas[4]."/1000), '%d-%m-%Y'))
and (DATE_FORMAT(FROM_UNIXTIME(ts/1000), '%d-%m-%Y') < (DATE_FORMAT(FROM_UNIXTIME(".$datas[5]."/1000), '%d-%m-%Y')))
group by dp.dataSourceId;";

$sem4_ac_auto = "select max(DATE_FORMAT(FROM_UNIXTIME(ts/1000), '%d-%m-%Y')) AS 'date_formatted', pv.pointValue, dp.xid 
from dataPoints dp 
join pointValues pv on 
dp.id=pv.dataPointId
where dp.xid like '%AC_____'
and pv.pointValue = 0
and (DATE_FORMAT(FROM_UNIXTIME(ts/1000), '%d-%m-%Y') > (DATE_FORMAT(FROM_UNIXTIME(".$datas[6]."/1000), '%d-%m-%Y'))
and (DATE_FORMAT(FROM_UNIXTIME(ts/1000), '%d-%m-%Y') < (DATE_FORMAT(FROM_UNIXTIME(".$datas[7]."/1000), '%d-%m-%Y')))
group by dp.dataSourceId;";
*/
 ?>