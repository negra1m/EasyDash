use scadabr_12;
select Count(*) from
#select m3.pointValue, m3.xid, DATE_FORMAT(FROM_UNIXTIME(m3.ts/1000), '%d-%m-%Y') as data, m3.dataPointId, m3.DataSourceId from
	(SELECT xid, pointValue, ts, dataSourceId, dataPointId FROM dataPoints dp
	join pointValues pv 
	on (dp.id=pv.dataPointId and ts >= (unix_timestamp(curdate()-1)* 1000))LIMPA_POINTVALUES
	where dp.xid like '%IL%'
	#and ts <= (unix_timestamp(curdate())* 1000)
	#limit 10000
    ) m1
	left join (SELECT xid, pointValue, ts, dataSourceId, dataPointId FROM dataPoints dp
	join pointValues pv 
	on (dp.id=pv.dataPointId and ts >= (unix_timestamp(curdate()-1)* 1000))
	where dp.xid like '%IL%'
	#and ts <= (unix_timestamp(curdate())* 1000)
	#limit 10000
    ) m2
	on (m1.xid = m2.xid and m1.ts < m2.ts)
	WHERE m2.ts is null
    and m1.pointValue = 0
group by m1.dataSourceId;


set max_execution_time = 3333333333;