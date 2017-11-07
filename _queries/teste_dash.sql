# iluminação em manual por LOJA

SELECT r2.dataSourceId, date_format(from_unixtime(r1.ts/1000), '%d-%m-%Y %h:%i:%s'), r2.xid, r1.pointValue
FROM (
	SELECT pointValue, dataPointId, ts FROM easy.pointValues WHERE ts < ( (unix_timestamp()) * 1000) AND ts > ( (unix_timestamp()-15*60) * 1000) # point values dos ultimos 15 minutos
) r1
JOIN (
	SELECT dataSourceId, id, xid FROM easy.dataPoints WHERE xid like '%IL%'  # data points de iluminação
) r2
ON r2.id = r1.dataPointId
WHERE r1.pointValue = 0
#WHERE r1.pointValue <> 0
GROUP BY dataSourceId;


# Frio Alimentar em manual por LOJA

SELECT r2.dataSourceId, date_format(from_unixtime(r1.ts/1000), '%d-%m-%Y %h:%i:%s'), r2.xid, r1.pointValue
FROM (
	SELECT pointValue, dataPointId, ts FROM easy.pointValues WHERE ts < ( (unix_timestamp()) * 1000) AND ts > ( (unix_timestamp()-15*60) * 1000) # point values dos ultimos 15 minutos
) r1
JOIN (
	SELECT dataSourceId, id, xid FROM easy.dataPoints WHERE xid like '%FA___%'  # data points de frio
) r2
ON r2.id = r1.dataPointId
WHERE r1.pointValue = 0
#WHERE r1.pointValue <> 0
GROUP BY dataSourceId;

# Ar Condicionado em manual por LOJA

SELECT r2.dataSourceId, date_format(from_unixtime(r1.ts/1000), '%d-%m-%Y %h:%i:%s'), r2.xid, r1.pointValue
FROM (
	SELECT pointValue, dataPointId, ts FROM easy.pointValues WHERE ts < ( (unix_timestamp()) * 1000) AND ts > ( (unix_timestamp()-15*60) * 1000) # point values dos ultimos 15 minutos
) r1
JOIN (
	SELECT dataSourceId, id, xid FROM easy.dataPoints WHERE xid like '%AC___%'  # data points de ac
) r2
ON r2.id = r1.dataPointId
WHERE r1.pointValue = 0
#WHERE r1.pointValue <> 0
GROUP BY dataSourceId;