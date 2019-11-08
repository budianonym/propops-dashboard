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


$redawning=query("
SELECT 
d.nid,
n.title as Title,
u.name as 'username', 
u.mail 'email',
pv.value as 'Company Name',
n.uid,  
d.state_name, ss.state_notes

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
where psm.state_name in ('livenotreviewed','FailedValidationNeedsReview','BlockedUnderConstruction')
and n.type = 'rental_property'
-- REMOVING [PO] MARK IN B.COM AND EXPEDIA THAT HAS OPTIN NULL 
and not (vc.description like '[PO]%' && b.bookingcom_opt is null && vc.channel='bookingcom')
and not (vc.description like '[PO]%' && b.expedia_opt is null && vc.channel='expedia')
and vr.is_deleted = 0
) c
-- SHOWING ONLY TAG [PO] with error code 303,312,824,826,825,827,900
where c.description like '[PO]%'
and c.production_severity in ('fatal','warning')
and c.code in (303,312,824,826,825,827,900)
group by c.nid) d
left join node n on n.nid=d.nid
left join users u on u.uid=n.uid
left join profile_value pv on n.uid = pv.uid AND pv.fid = 21
left join field_data_field_calendar_feed_format cal on cal.entity_id=n.nid
-- where d.nid not in (
-- select nid from (select  psmnid, nid, state_notes from property_state_machine_notes
-- where
-- state_notes like 'assigned to%'
-- order by psmnid
-- desc) y
-- group by y.nid
-- ) 

left join (
select nid, state_notes from (select  psmnid, nid, state_notes from property_state_machine_notes
where
state_notes like 'assigned to%'
order by psmnid
desc) y
group by y.nid
) ss on ss.nid=d.nid

where u.mail not in ('hello@leavetown.com','Vicky.Lova@redawning.com',
'sarah.herz@redawning.com','brett@redawning.com')
-- and ss.state_notes like 'assigned to%'
-- and d.nid = 282360
order by ss.state_notes, d.nid
;

");


$counter = 0;
$r = "INSERT INTO backlognid (nid, Channel) VALUE ";
	foreach ($redawning as $key) {
		$r .= "(".$key['nid'].", 'redawning')";
		if ($counter != count($redawning)-1){
			$r .= ",";
		}
		$counter++;
	}

	//var_dump($r);
$update1=query1("$r");


$airbnb=query("
SELECT 
	distinct n.nid 'nid'
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
	and psm.state_name in ('Live') 
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
		);

");


	if ($airbnb!=array ()) {
																													
$counter = 0;
$air = "INSERT INTO backlognid (nid, Channel) VALUE ";
	foreach ($airbnb as $key) {
		$air .= "(".$key['nid'].", 'airbnb')";
		if ($counter != count($airbnb)-1){
			$air .= ",";
		}
		$counter++;
	}

$update1=query1("$air");
	}


$expedia=query("
SELECT
	distinct n.nid 'nid'
from 
	node n 
	left join manager_opt_channel opt on opt.mid=n.uid 
	left join property_state_machine psm on psm.nid=n.nid 
	left join rep_property rep on rep.nid=n.nid 
	left join channel_properties cp on cp.nid=n.nid and cp.channel='expedia'
where 
	opt.channel='expedia' 
	and opt.opt=1 
	and psm.state_name in ('Live') 
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
		);

");


	if ($expedia!=array ()) {
																													
$counter = 0;
$exp = "INSERT INTO backlognid (nid, Channel) VALUE ";
	foreach ($expedia as $key) {
		$exp .= "(".$key['nid'].", 'expedia')";
		if ($counter != count($expedia)-1){
			$exp .= ",";
		}
		$counter++;
	}

$update1=query1("$exp");
	}


	$homeaway=query("
SELECT
	distinct n.nid 'nid'
from 
	node n 
	left join manager_opt_channel opt on opt.mid=n.uid 
	left join property_state_machine psm on psm.nid=n.nid 
	left join rep_property rep on rep.nid=n.nid 
	left join channel_properties cp on cp.nid=n.nid and cp.channel='homeaway'
where 
	opt.channel='homeaway' 
	and opt.opt=1 
	and psm.state_name in ('Live') 
	and n.nid not in 
		( 
		select nid 
		from rep_property rep 
		where rep.parent=0 
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
		);

");


	if ($homeaway!=array ()) {
																													
$counter = 0;
$ha = "INSERT INTO backlognid (nid, Channel) VALUE ";
	foreach ($homeaway as $key) {
		$ha .= "(".$key['nid'].", 'homeaway')";
		if ($counter != count($homeaway)-1){
			$ha .= ",";
		}
		$counter++;
	}

$update1=query1("$ha");
	}
?>