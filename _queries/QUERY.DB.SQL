set sql_mode = ''
use scadabr;
and ts between unix_timestamp(curdate()-1) and unix_timestamp(curdate()+1)
##teste
select * from(
SELECT DATE_FORMAT(FROM_UNIXTIME(ts/1000), '%d-%m-%Y %H:%i:%s') AS 'date_formatted', (ts/1000) as TS2, pv.pointValue, dp.xid
	from dataPoints dp 
	join pointValues pv on 
	dp.id=pv.dataPointId
	where dp.xid like '%IL%'
	and dp.xid like '%evco%'
	and ts between curdate()-1 and  curdate()+1) A
	#and (DATE_FORMAT(FROM_UNIXTIME(ts/1000), '%d-%m-%Y') < DATE_FORMAT(curdate()+2, '%d-%m-%Y'))
    where A.pointvalue = 1
    group by A.dataSourceId
    
SELECT DATE_FORMAT(FROM_UNIXTIME(ts/1000), '%d-%m-%Y') AS 'date_formatted', pv.pointValue, dp.xid, ts, 1508724000
from dataPoints dp 
join pointValues pv on 
dp.id=pv.dataPointId
where dp.xid like '%IL%'
and dp.xid like '%EVCO%'
and pv.pointValue = 0
and ts >= unix_timestamp(curdate()-1)*1000
#and pv.ts between unix_timestamp(curdate()-1) and unix_timestamp(curdate()+1)
group by dp.dataSourceId

#PEGAR O ULTIMO TS PELO DATASOURCEID - > 

select unix_timestamp(curdate()-1)*1000

