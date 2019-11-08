<?php 
//fungsi2
$b = date('Y-m-d');
function sqlCheck($a){
	if ($a==null) {
		return 0;
	}else{return $a;};
};

function koneksi1() {
  $conn1=mysqli_connect("localhost","root","","ra");
  return $conn1;
}
function query1($sql1) {
  $conn1 = koneksi1();
  $result1 = mysqli_query($conn1, $sql1);
  $rows1 = [];
  while( $row1 = mysqli_fetch_assoc($result1) ) {
    $rows1[] = $row1;
  }
  return $rows1;
}
//endfungsi1
//query data


//connectionRA
function koneksi() {
	$conn=mysqli_connect("radbw2a-cluster.cluster-ro-cqyy7fkqd6u0.us-west-2.rds.amazonaws.com","bhermawan","lTNM0d6CS3Eb%7(_","radb");
	return $conn;
}
function query($sql) {
	$conn = koneksi();
	$result = mysqli_query($conn, $sql);
	$rows = [];
	while( $row = mysqli_fetch_assoc($result) ) {
		$rows[] = $row;
	}
	return $rows;
}


// $result1=query1("
// SELECT * FROM `backlog` WHERE date>='2019-05-21'
// ");
// var_dump($result1);
// $result11=query1("
// SELECT * FROM backlogtotal;");

// $daily_backlog = query("
// SELECT count(nid) 'total',timestamp1 FROM (SELECT nid, uid,
// DATE_FORMAT(convert_tz(FROM_UNIXTIME(created),'US/Pacific','Asia/Jakarta'), '%Y-%m-%d') 'timestamp1' FROM node) a
// where
// -- timestamp1 = DATE_FORMAT(CURDATE(),'%Y-%m-%d')
// timestamp1 like '2019-04-05'
// group by timestamp1;

// ");

//endfungsi1

$raoutreal=query("SELECT count(a.nid) 'total', Status, timestamp1 FROM (SELECT 
min(psmnid), nid, destination_state 'Status', 
state_notes, date_format(convert_tz(created_at, 
'US/Pacific','Asia/Jakarta'),'%Y-%m-%d') 'timestamp1', created_by 
FROM radb.property_state_machine_notes 
where destination_state = 'Live' 
group by nid 
) a 
-- where timestamp = DATE_FORMAT(CURDATE()-1,'%Y-%m-%d')
where  timestamp1 = CURDATE()

group by timestamp1");
// var_dump($raoutreal);

$airoutreal=query("
SELECT count(nid) 'total', b.timestamp1 from (select nid,channel_id,uid,email,opt_in,channel_status, created_on, timestamp1 from (select
	n.nid,
    cp.channel_id,
    n.uid,
    u.name as 'email',
    #cp.account as 'airbnb_account',
	cp.opt_in,
    cp.status as 'channel_status',
    cp.created_ts as 'created_on',
    substring(convert_tz(created_ts,'US/Pacific','Asia/Jakarta'),1, 10) 'timestamp1'
from
	node n
    left join channel_properties cp on cp.nid=n.nid
    left join users u on u.uid=n.uid
where
	cp.channel='airbnb'
--     and convert_tz(created_ts,'US/Pacific','Asia/Jakarta')>=( CURDATE() - INTERVAL 8 DAY )
    ) a
    where  a.timestamp1 = CURDATE()) b
group by b.timestamp1
");


$bookoutreal=query("
SELECT count(nid) 'total', b.timestamp1 from (select nid,channel_id,uid,email,opt_in,channel_status, created_on, timestamp1 from (select
	n.nid,
    cp.channel_id,
    n.uid,
    u.name as 'email',
    #cp.account as 'airbnb_account',
	cp.opt_in,
    cp.status as 'channel_status',
    cp.created_ts as 'created_on',
    substring(convert_tz(created_ts,'US/Pacific','Asia/Jakarta'),1, 10) 'timestamp1'
from
	node n
    left join channel_properties cp on cp.nid=n.nid
    left join users u on u.uid=n.uid
where
	cp.channel='bookingcom'
--     and convert_tz(created_ts,'US/Pacific','Asia/Jakarta')>=( CURDATE() - INTERVAL 8 DAY )
    ) a
    where  a.timestamp1 = CURDATE()) b
group by b.timestamp1
");

$expeoutreal=query("
SELECT count(nid) 'total', b.timestamp1 from (select nid,channel_id,uid,email,opt_in,channel_status, created_on, timestamp1 from (select
	n.nid,
    cp.channel_id,
    n.uid,
    u.name as 'email',
    #cp.account as 'airbnb_account',
	cp.opt_in,
    cp.status as 'channel_status',
    cp.created_ts as 'created_on',
    substring(convert_tz(created_ts,'US/Pacific','Asia/Jakarta'),1, 10) 'timestamp1'
from
	node n
    left join channel_properties cp on cp.nid=n.nid
    left join users u on u.uid=n.uid
where
	cp.channel='expedia'
--     and convert_tz(created_ts,'US/Pacific','Asia/Jakarta')>=( CURDATE() - INTERVAL 8 DAY )
    ) a
    where  a.timestamp1 = CURDATE()) b
group by b.timestamp1
");

$homeoutreal=query("
SELECT count(nid) 'total', b.timestamp1 from (select nid,channel_id,uid,email,opt_in,channel_status, created_on, timestamp1 from (select
	n.nid,
    cp.channel_id,
    n.uid,
    u.name as 'email',
    #cp.account as 'airbnb_account',
	cp.opt_in,
    cp.status as 'channel_status',
    cp.created_ts as 'created_on',
    substring(convert_tz(created_ts,'US/Pacific','Asia/Jakarta'),1, 10) 'timestamp1'
from
	node n
    left join channel_properties cp on cp.nid=n.nid
    left join users u on u.uid=n.uid
where
	cp.channel='homeaway'
--     and convert_tz(created_ts,'US/Pacific','Asia/Jakarta')>=( CURDATE() - INTERVAL 8 DAY )
    ) a
    where a.timestamp1 = CURDATE()) b
group by b.timestamp1
");

$tripoutreal=query("
SELECT count(nid) 'total', b.timestamp1 from (select nid,channel_id,uid,email,opt_in,channel_status, created_on, timestamp1 from (select
	n.nid,
    cp.channel_id,
    n.uid,
    u.name as 'email',
    #cp.account as 'airbnb_account',
	cp.opt_in,
    cp.status as 'channel_status',
    cp.created_ts as 'created_on',
    substring(convert_tz(created_ts,'US/Pacific','Asia/Jakarta'),1, 10) 'timestamp1'
from
	node n
    left join channel_properties cp on cp.nid=n.nid
    left join users u on u.uid=n.uid
where
	cp.channel='tripadvisor'
--     and convert_tz(created_ts,'US/Pacific','Asia/Jakarta')>=( CURDATE() - INTERVAL 8 DAY )
    ) a
    where  a.timestamp1 = CURDATE()) b
group by b.timestamp1
");

//query data
$b_perday=query("SELECT count(nid) 'total',
timestamp1

FROM (SELECT nid, uid,
DATE_FORMAT(convert_tz(FROM_UNIXTIME(created),'US/Pacific','Asia/Jakarta'), '%Y-%m-%d') 'timestamp1' FROM node) a
where
-- timestamp1 = DATE_FORMAT(CURDATE(),'%Y-%m-%d')
 timestamp1 = CURDATE()
group by timestamp1;");

$b_perday_expedia=query("SELECT c.timestamp1, count(c.nid) 'total' from (
select
	n.nid, 
	u.uid, 
	u.name as 'email',
	#FROM_UNIXTIME(n.created) as 'creation date',
	psm.state_name,
	cal.field_calendar_feed_format_value as cal_format,
	opt.opt as 'opt_pm_level',
	case when rep.parent=0 then 'parent' when rep.parent!=0 then 'child' else 'key' end as 'level',
	rep.parent as 'parent_nid',
    
    DATE_FORMAT(convert_tz(b.timestamp1,'US/Pacific','Asia/Jakarta'), '%Y-%m-%d') 'timestamp1'
	#aa.account_name as 'airbnb_account'
from
	node n
	left join manager_opt_channel opt on opt.mid=n.uid
	left join users u on u.uid=n.uid
	left join property_state_machine psm on psm.nid=n.nid
	left join rep_property rep on rep.nid=n.nid
	left join channel_properties cp on cp.nid=n.nid and cp.channel='expedia'
	left join field_data_field_calendar_feed_format cal on cal.entity_id=n.nid
    left join 
    (select a.nid, a.state, a.timestamp1 from (SELECT nid, destination_state 'state', created_at 'timestamp1' FROM radb.property_state_machine_notes
-- where nid = 263883
order by psmnid
desc) a
group by nid) b on b.nid=n.nid
	#left join airbnb_account aa on aa.uid=n.uid
where
	opt.channel = 'expedia'
	and opt.opt = 1
	and psm.state_name in ('Live','LiveNotReviewed')
	and n.nid not in
		(
		select nid
		from radb.rep_property rep
		where rep.parent!=0
		)
	and n.nid not in 
		(
		select nid
		from channel_properties cp
		where channel = 'expedia'
		#and channel_id !=0
		#and channel_id is not null
		)
group by uid, nid) c
where c.timestamp1 = CURDATE()
group by c.timestamp1");
// var_dump($b_perday_expedia); 



$b_perday_airbnb=query("SELECT c.timestamp1, count(c.nid) 'total' from (
select
	n.nid, 
	u.uid, 
	u.name as 'email',
	#FROM_UNIXTIME(n.created) as 'creation date',
	psm.state_name,
	cal.field_calendar_feed_format_value as cal_format,
	opt.opt as 'opt_pm_level',
	case when rep.parent=0 then 'parent' when rep.parent!=0 then 'child' else 'key' end as 'level',
	rep.parent as 'parent_nid',
    
    DATE_FORMAT(convert_tz(b.timestamp1,'US/Pacific','Asia/Jakarta'), '%Y-%m-%d') 'timestamp1'
	#aa.account_name as 'airbnb_account'
from
	node n
	left join manager_opt_channel opt on opt.mid=n.uid
	left join users u on u.uid=n.uid
	left join property_state_machine psm on psm.nid=n.nid
	left join rep_property rep on rep.nid=n.nid
	left join channel_properties cp on cp.nid=n.nid and cp.channel='airbnb'
	left join field_data_field_calendar_feed_format cal on cal.entity_id=n.nid
    left join 
    (select a.nid, a.state, a.timestamp1 from (SELECT nid, destination_state 'state', created_at 'timestamp1' FROM radb.property_state_machine_notes
-- where nid = 263883
order by psmnid
desc) a
group by nid) b on b.nid=n.nid
	#left join airbnb_account aa on aa.uid=n.uid
where
	opt.channel = 'airbnb'
	and opt.opt = 1
	and psm.state_name in ('Live','LiveNotReviewed')
	and n.nid not in
		(
		select nid
		from radb.rep_property rep
		where rep.parent!=0
		)
	and n.nid not in 
		(
		select nid
		from channel_properties cp
		where channel = 'airbnb'
		#and channel_id !=0
		#and channel_id is not null
		)
group by uid, nid) c
where c.timestamp1 = CURDATE()
group by c.timestamp1");

$b_perday_booking=query("SELECT c.timestamp1, count(c.nid) 'total' from (
select
	n.nid, 
	u.uid, 
	u.name as 'email',
	#FROM_UNIXTIME(n.created) as 'creation date',
	psm.state_name,
	cal.field_calendar_feed_format_value as cal_format,
	opt.opt as 'opt_pm_level',
	case when rep.parent=0 then 'parent' when rep.parent!=0 then 'child' else 'key' end as 'level',
	rep.parent as 'parent_nid',
    
    DATE_FORMAT(convert_tz(b.timestamp1,'US/Pacific','Asia/Jakarta'), '%Y-%m-%d') 'timestamp1'
	#aa.account_name as 'airbnb_account'
from
	node n
	left join manager_opt_channel opt on opt.mid=n.uid
	left join users u on u.uid=n.uid
	left join property_state_machine psm on psm.nid=n.nid
	left join rep_property rep on rep.nid=n.nid
	left join channel_properties cp on cp.nid=n.nid and cp.channel='bookingcom'
	left join field_data_field_calendar_feed_format cal on cal.entity_id=n.nid
    left join 
    (select a.nid, a.state, a.timestamp1 from (SELECT nid, destination_state 'state', created_at 'timestamp1' FROM radb.property_state_machine_notes
-- where nid = 263883
order by psmnid
desc) a
group by nid) b on b.nid=n.nid
	#left join airbnb_account aa on aa.uid=n.uid
where
	opt.channel = 'bookingcom'
	and opt.opt = 1
	and psm.state_name in ('Live','LiveNotReviewed')
	and n.nid not in
		(
		select nid
		from radb.rep_property rep
		where rep.parent!=0
		)
	and n.nid not in 
		(
		select nid
		from channel_properties cp
		where channel = 'bookingcom'
		#and channel_id !=0
		#and channel_id is not null
		)
group by uid, nid) c
where c.timestamp1 = CURDATE()
group by c.timestamp1");
// var_dump($b_perday_expedia); 



$b_perday_homeaway=query("SELECT c.timestamp1, count(c.nid) 'total' from (
select
	n.nid, 
	u.uid, 
	u.name as 'email',
	#FROM_UNIXTIME(n.created) as 'creation date',
	psm.state_name,
	cal.field_calendar_feed_format_value as cal_format,
	opt.opt as 'opt_pm_level',
	case when rep.parent=0 then 'parent' when rep.parent!=0 then 'child' else 'key' end as 'level',
	rep.parent as 'parent_nid',
    
    DATE_FORMAT(convert_tz(b.timestamp1,'US/Pacific','Asia/Jakarta'), '%Y-%m-%d') 'timestamp1'
	#aa.account_name as 'airbnb_account'
from
	node n
	left join manager_opt_channel opt on opt.mid=n.uid
	left join users u on u.uid=n.uid
	left join property_state_machine psm on psm.nid=n.nid
	left join rep_property rep on rep.nid=n.nid
	left join channel_properties cp on cp.nid=n.nid and cp.channel='homeaway'
	left join field_data_field_calendar_feed_format cal on cal.entity_id=n.nid
    left join 
    (select a.nid, a.state, a.timestamp1 from (SELECT nid, destination_state 'state', created_at 'timestamp1' FROM radb.property_state_machine_notes
-- where nid = 263883
order by psmnid
desc) a
group by nid) b on b.nid=n.nid
	#left join airbnb_account aa on aa.uid=n.uid
where
	opt.channel = 'homeaway'
	and opt.opt = 1
	and psm.state_name in ('Live','LiveNotReviewed')
	and n.nid not in
		(
		select nid
		from radb.rep_property rep
		where rep.parent=0
		)
	and n.nid not in 
		(
		select nid
		from channel_properties cp
		where channel = 'homeaway'
		#and channel_id !=0
		#and channel_id is not null
		)
group by uid, nid) c
where c.timestamp1 = CURDATE()
group by c.timestamp1");


$b_perday_tripadvisor=query("SELECT c.timestamp1, count(c.nid) 'total' from (
select
	n.nid, 
	u.uid, 
	u.name as 'email',
	#FROM_UNIXTIME(n.created) as 'creation date',
	psm.state_name,
	cal.field_calendar_feed_format_value as cal_format,
	opt.opt as 'opt_pm_level',
	case when rep.parent=0 then 'parent' when rep.parent!=0 then 'child' else 'key' end as 'level',
	rep.parent as 'parent_nid',
    
    DATE_FORMAT(convert_tz(b.timestamp1,'US/Pacific','Asia/Jakarta'), '%Y-%m-%d') 'timestamp1'
	#aa.account_name as 'airbnb_account'
from
	node n
	left join manager_opt_channel opt on opt.mid=n.uid
	left join users u on u.uid=n.uid
	left join property_state_machine psm on psm.nid=n.nid
	left join rep_property rep on rep.nid=n.nid
	left join channel_properties cp on cp.nid=n.nid and cp.channel='tripadvisor'
	left join field_data_field_calendar_feed_format cal on cal.entity_id=n.nid
    left join 
    (select a.nid, a.state, a.timestamp1 from (SELECT nid, destination_state 'state', created_at 'timestamp1' FROM radb.property_state_machine_notes
-- where nid = 263883
order by psmnid
desc) a
group by nid) b on b.nid=n.nid
	#left join airbnb_account aa on aa.uid=n.uid
where
	opt.channel = 'tripadvisor'
	and opt.opt = 1
	and psm.state_name in ('Live','LiveNotReviewed')
	and n.nid not in
		(
		select nid
		from radb.rep_property rep
		where rep.parent!=0
		)
	and n.nid not in 
		(
		select nid
		from channel_properties cp
		where channel = 'tripadvisor'
		#and channel_id !=0
		#and channel_id is not null
		)
group by uid, nid) c
where c.timestamp1 = CURDATE()
group by c.timestamp1");


$ra_pending=query("
SELECT count(import_pending_id) 'total' FROM radb.pending_property
where last_action_info in ('Waiting SQS for processing','New pending property')
;
");


$livenotreviewed=query("SELECT count(nid) 'total' from (
SELECT 
d.nid,
n.title as Title,
u.name as 'username', 
u.mail 'email',
n.uid,  
d.state_name

from (select nid, state_name from (select vr.is_deleted, vr.code, vr.nid, n.uid, psm.state_name, vc.channel, vc.production_severity, vc.description, b.airbnb_opt, b.bookingcom_opt, b.homeaway_opt, b.expedia_opt, b.tripadvisor_opt from validation_results vr
left join validation_channels vc on vc.code=vr.code
left join node n on n.nid = vr.nid
left join property_state_machine psm on n.nid=psm.nid
left join 
-- TABLE CHANNELS OPT IN 2 (CONVERT ROW INTO COLUMN)--
(
select a.mid 'uid', 
group_concat( 
if( 
(a.channel = 'airbnb' && opt = 1), 1, 
null 
) 
) as 'airbnb_opt', 
group_concat( 
if( 
(a.channel = 'homeaway' && opt = 1), 1, 
null 
) 
) as 'homeaway_opt',
group_concat( 
if( 
(a.channel = 'bookingcom' && opt = 1), 1, 
null 
) 
) as 'bookingcom_opt',
group_concat( 
if( 
(a.channel = 'expedia' && opt = 1), 1, 
null 
) 
) as 'expedia_opt',
group_concat( 
if( 
(a.channel = 'tripadvisor' && opt = 1), 1, 
null 
) 
) as 'tripadvisor_opt'
from
-- TABLE CHANNELS OPT IN 1 (SHOWING ONLY 5 PRIMARY CHANNELS)--
(select * from manager_opt_channel
where channel in ('expedia','bookingcom','tripadvisor','airbnb','homeaway')
) a
-- [END]TABLE CHANNELS OPT IN 1 (SHOWING ONLY 5 PRIMARY CHANNELS)--
group by a.mid) b
-- [END]TABLE CHANNELS OPT IN 2 (CONVERT ROW INTO COLUMN)--
on b.uid = n.uid
where psm.state_name = 'livenotreviewed'
-- REMOVING [PO] MARK IN B.COM AND EXPEDIA THAT HAS OPTIN NULL 
and not (vc.description like '[PO]%' && b.bookingcom_opt=null && vc.channel='bookingcom')
and not (vc.description like '[PO]%' && b.expedia_opt=null && vc.channel='expedia')
and vr.is_deleted = 0
) c
-- SHOWING ONLY TAG [PO] with error code 303,312,824,826,825,827,900
where c.description like '[PO]%'
and c.production_severity in ('fatal','warning')
and c.code in (303,312,824,826,825,827,900)
group by c.nid) d
left join node n on n.nid=d.nid
left join users u on u.uid=n.uid
where u.mail not in ('hello@leavetown.com','Vicky.Lova@redawning.com','sarah.herz@redawning.com','brett@redawning.com')
order by d.nid
desc
) count_table
;
");

$ra_in=query("
SELECT count(a.num) 'num' 
from (select psm.nid 'num' from radb.property_state_machine psm 
left join node n on n.nid=psm.nid 
left join profile_value pv on n.uid = pv.uid and pv.fid = 21 
left join manager_cc_fees mc on mc.mid=n.uid 
left join validation_results vr on vr.nid=n.nid and vr.is_deleted=0 
left join validation_channels vc on vc.code=vr.code 
where psm.state_name in (
'FailedValidationNeedsReview', 'WaitingForValidation', 'BlockedUnderConstruction') 
and vc.production_severity in ('fatal') 
and vc.description like ('[PO]%') 
group by psm.nid 
) a

");

$airbnb_in=query("
SELECT 
	count(distinct n.nid) 'num'
from 
	node n 
	left join manager_opt_channel opt on opt.mid=n.uid 
	left join users u on u.uid=n.uid
	left join property_state_machine psm on psm.nid=n.nid 
	left join rep_property rep on rep.nid=n.nid 
	left join channel_properties cp on cp.nid=n.nid and cp.channel='airbnb'
	left join airbnb_account aa on aa.uid=n.uid 
where 
	opt.channel='airbnb' 
	and opt.opt=1 
	and psm.state_name in ('Live','LiveNotReviewed') 
	and n.nid not in 
		( 
		select nid 
		from rep_property rep 
		where rep.parent!=0 
		) 
	and n.nid not in 
		( 
		select nid 
		from channel_properties cp 
		where channel='airbnb' 
		)
	and n.nid not in
		(
		select nid
		from validation_results vr
		left join validation_channels vc on vc.code=vr.code
		where vr.is_deleted=0
		and vc.channel in ('redawning','airbnb')
		and vc.production_severity='fatal'
		)
");


$booking_in=query("
SELECT
	count(distinct n.nid) 'num'
from
	node n
	left join manager_opt_channel opt on opt.mid=n.uid
	left join users u on u.uid=n.uid
	left join property_state_machine psm on psm.nid=n.nid
	left join rep_property rep on rep.nid=n.nid
	left join channel_properties cp on cp.nid=n.nid and cp.channel='bookingcom'
	left join field_data_field_calendar_feed_format cal on cal.entity_id=n.nid
	#left join airbnb_account aa on aa.uid=n.uid
where
	opt.channel = 'bookingcom'
	and opt.opt = 1
	and psm.state_name in ('Live','LiveNotReviewed')
	and n.nid not in
		(
		select nid
		from radb.rep_property rep
		where rep.parent!=0
		)
	and n.nid not in 
		(
		select nid
		from channel_properties cp
		where channel = 'bookingcom'
		#and channel_id !=0
		#and channel_id is not null
		)
");

$expedia_in=query("
SELECT
	count(distinct n.nid) 'num'
from 
	node n 
	left join manager_opt_channel opt on opt.mid=n.uid 
	left join property_state_machine psm on psm.nid=n.nid 
	left join rep_property rep on rep.nid=n.nid 
	left join channel_properties cp on cp.nid=n.nid and cp.channel='expedia'
where 
	opt.channel='expedia' 
	and opt.opt=1 
	and psm.state_name in ('Live','LiveNotReviewed') 
	and n.nid not in 
		( 
		select nid 
		from rep_property rep 
		where rep.parent!=0 
		) 
	and n.nid not in 
		( 
		select nid 
		from channel_properties cp 
		where channel='expedia' 
		)
	and n.nid not in
		(
		select nid
		from validation_results vr
		left join validation_channels vc on vc.code=vr.code
		where vr.is_deleted=0
		and vc.channel in ('redawning','expedia')
		and vc.production_severity='fatal'
		)
");

$homeaway_in=query("
SELECT
	count(distinct n.nid) 'num'
from 
	node n 
	left join manager_opt_channel opt on opt.mid=n.uid 
	left join property_state_machine psm on psm.nid=n.nid 
	left join rep_property rep on rep.nid=n.nid 
	left join channel_properties cp on cp.nid=n.nid and cp.channel='homeaway'
where 
	opt.channel='homeaway' 
	and opt.opt=1 
	and psm.state_name in ('Live','LiveNotReviewed') 
	and n.nid in 
		( 
		select nid 
		from rep_property rep 
		where rep.parent!=0 
		) 
	and n.nid not in 
		( 
		select nid 
		from channel_properties cp 
		where channel='homeaway' 
		)
	and n.nid not in
		(
		select nid
		from validation_results vr
		left join validation_channels vc on vc.code=vr.code
		where vr.is_deleted=0
		and vc.channel in ('redawning','homeaway')
		and vc.production_severity='fatal'
		)
");

$tripadvisor_in=query("
SELECT
	count(distinct n.nid) 'num'
from
	node n
	left join manager_opt_channel opt on opt.mid=n.uid
	left join users u on u.uid=n.uid
	left join property_state_machine psm on psm.nid=n.nid
	left join rep_property rep on rep.nid=n.nid
	left join channel_properties cp on cp.nid=n.nid and cp.channel='tripadvisor'
	left join field_data_field_calendar_feed_format cal on cal.entity_id=n.nid
	#left join airbnb_account aa on aa.uid=n.uid
where
	opt.channel = 'tripadvisor'
	and opt.opt = 1
	and psm.state_name in ('Live','LiveNotReviewed')
	and n.nid not in
		(
		select nid
		from radb.rep_property rep
		where rep.parent!=0
		)
	and n.nid not in 
		(
		select nid
		from channel_properties cp
		where channel = 'tripadvisor'
		#and channel_id !=0
		#and channel_id is not null
		)
");






$a = sqlCheck($ra_in[0]['num']);
$pending1 = sqlCheck($ra_pending[0]['total']);
$livenotreviewed1 = sqlCheck($livenotreviewed[0]['total']);
$c = sqlCheck($airbnb_in[0]['num']);
$d = sqlCheck($booking_in[0]['num']);
$e = sqlCheck($expedia_in[0]['num']);
$f = sqlCheck($homeaway_in[0]['num']);
$g = sqlCheck($tripadvisor_in[0]['num']);

$ra_in1 = sqlCheck($b_perday[0]['total']);
$ra_out1 = sqlCheck($raoutreal[0]['total']);
$airbnb_in1 = sqlCheck($b_perday_airbnb[0]['total']);
$airbnb_out1 = sqlCheck($airoutreal[0]['total']);
$expedia_in1 = sqlCheck($b_perday_expedia[0]['total']);
$expedia_out1 =  sqlCheck($expeoutreal[0]['total']);
$homeaway_in1 = sqlCheck($b_perday_homeaway[0]['total']);
$homeaway_out1 =  sqlCheck($homeoutreal[0]['total']);
$bookingcom_in1 = sqlCheck($b_perday_booking[0]['total']);
$bookingcom_out1 = sqlCheck($bookoutreal[0]['total']);
$tripadvisor_in1 = sqlCheck($b_perday_tripadvisor[0]['total']);
$tripadvisor_out1 = sqlCheck($tripoutreal[0]['total']);




// $b1 = date('Y-m-d',time()-(86400*1));
// echo $b1;
// insert


$update1=query1("UPDATE backlog_statistic
SET
ra_backlog = '$a',
airbnb_backlog = '$c',
bookingcom_backlog = '$d',
expedia_backlog = '$e',
homeaway_backlog = '$f',
tripadvisor_backlog = '$g',
ra_pending = $pending1,
ra_livenot = $livenotreviewed1,
ra_in  = $ra_in1,
ra_out  = $ra_out1,
airbnb_in  = $airbnb_in1,
airbnb_out  = $airbnb_out1,
expedia_in  = $expedia_in1,
expedia_out  = $expedia_out1,
homeaway_in  = $homeaway_in1,
homeaway_out  = $homeaway_out1,
bookingcom_in  = $bookingcom_in1,
bookingcom_out  = $bookingcom_out1,
tripadvisor_in  = $tripadvisor_in1,
tripadvisor_out  = $tripadvisor_out1

WHERE date = '$b';");

// $update2=query1("UPDATE backlogtotal
// SET
// ra_in = '$a',
// airbnb_in = '$c',
// booking_in = '$d',
// expedia_in = '$e',
// homeaway_in = '$f',
// tripadvisor_in = '$g'

// WHERE date = '$b';");

// header("Location: http://192.168.1.90/statistic.php"); /* Redirect browser */
// exit();

// var_dump($a);
// echo "<br>";
// var_dump($pending1);
// echo "<br>";
// var_dump($livenotreviewed1);
// echo "<br>";
// var_dump($c);
// echo "<br>";
// var_dump($d);
// echo "<br>";
// var_dump($e);
// echo "<br>";
// var_dump($f);
// echo "<br>";
// var_dump($g);
// echo "<br>";
// var_dump($ra_in1);
// echo "<br>";
// var_dump($ra_out1);
// echo "<br>";
// var_dump($airbnb_in1);
// echo "<br>";
// var_dump($airbnb_out1);
// echo "<br>";
// var_dump($expedia_in1);
// echo "<br>";
// var_dump($expedia_out1);
// echo "<br>";
// var_dump($homeaway_in1);
// echo "<br>";
// var_dump($homeaway_out1);
// echo "<br>";
// var_dump($bookingcom_in1);
// echo "<br>";
// var_dump($bookingcom_out1);
// echo "<br>";
// var_dump($tripadvisor_in1);
// echo "<br>";
// var_dump($tripadvisor_out1);
// echo "<br>";



?>