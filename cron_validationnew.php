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
$qq = query1("select * from user;");
//var_dump($qq);

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


	

																								
	



$expedia=query("
SELECT 
distinct
n.nid, 
'expedia' as category,
psm.state_name,
vc.channel,
       vc.production_severity, 
vc.code,
vc.description
from 
node n 
left join manager_opt_channel opt on opt.mid=n.uid 
left join property_state_machine psm on psm.nid=n.nid 
left join rep_property rep on rep.nid=n.nid 
left join channel_properties cp on cp.nid=n.nid and cp.channel='expedia'
    left join radb.validation_results vr on vr.nid=n.nid and vr.is_deleted = 0
left join radb.validation_channels vc on vc.code=vr.code and vc.channel in ('redawning','expedia')
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
)
and vc.channel is not null



");
$counter = 0;
$ha = "INSERT INTO validation_nid (nid, category, state_name, channel, production_severity, code) VALUE ";			
	foreach ($expedia as $key) {
$nid = $key['nid'];
$cat = $key['category'];
$stat = $key['state_name'];
$chann = $key['channel'];
$prod = $key['production_severity'];
$cod = $key['code'];
$ha .= "('$nid','$cat','$stat','$chann','$prod','$cod')";
if ($counter != count($expedia)-1){
	$ha .= ",";
}
$counter++;
	}
//var_dump ($ha);
query1($ha);
	//$update1=query1(inputSet($expedia));
//	echo "<pre>";
//	var_dump ($expedia); 
//	echo "</pre>";
	//$qq = query1("select * from validation_nid where date_format(timestamp, '%Y-%m-%d') =  '2019-08-19';");
	//echo "==================================== <hr> <br>";
	//var_dump($qq);
// 

$redawning=query("
SELECT 
vr.nid,
'redawning' as category,
psm.state_name,
vc.channel,
vc.production_severity,
vr.code,
vc.description
from validation_results vr
left join validation_channels vc on vc.code=vr.code
left join node n on n.nid = vr.nid
left join property_state_machine psm on n.nid=psm.nid
left join users u on u.uid=n.uid
left join
(select 
a.mid 'uid', 
group_concat(if((a.channel = 'airbnb' && opt = 1),1,null)) as 'airbnb_opt', 
group_concat(if((a.channel = 'homeaway' && opt = 1),1,null)) as 'homeaway_opt',
group_concat(if((a.channel = 'bookingcom' && opt = 1),1,null)) as 'bookingcom_opt',
group_concat(if((a.channel = 'expedia' && opt = 1), 1,null)) as 'expedia_opt',
group_concat(if((a.channel = 'tripadvisor' && opt = 1),1,null)) as 'tripadvisor_opt'
from
(select * from manager_opt_channel where channel in ('expedia','bookingcom','tripadvisor','airbnb','homeaway')
) a	
group by a.mid
) b
on b.uid = n.uid
where psm.state_name in ('LiveNotReviewed','FailedValidationNeedsReview', 'BlockedUnderConstruction')
and not (vc.description like '[PO]%' && b.bookingcom_opt=null && vc.channel='bookingcom')
and not (vc.description like '[PO]%' && b.expedia_opt=null && vc.channel='expedia')
and not (vc.description like '[PO]%' && b.airbnb_opt=null && vc.channel='airbnb')
and not (vc.description like '[PO]%' && b.homeaway_opt=null && vc.channel='homeaway')
and not (vc.description like '[PO]%' && b.tripadvisor_opt=null && vc.channel='tripadvisor')
and vr.is_deleted = 0
and vc.description like '[PO]%'
and vc.production_severity in ('fatal','warning')
and vc.code in (303,312,824,826,825,827,900)
and u.mail not in ('hello@leavetown.com','Vicky.Lova@redawning.com','sarah.herz@redawning.com','brett@redawning.com')
;

");

$counter = 0;
$ha = "INSERT INTO validation_nid (nid, category, state_name, channel, production_severity, code) VALUE ";			
	foreach ($redawning as $key) {
$nid = $key['nid'];
$cat = $key['category'];
$stat = $key['state_name'];
$chann = $key['channel'];
$prod = $key['production_severity'];
$cod = $key['code'];
$ha .= "('$nid','$cat','$stat','$chann','$prod','$cod')";
if ($counter != count($redawning)-1){
	$ha .= ",";
}
$counter++;
	}
//var_dump ($ha);
query1($ha);


$airbnb=query("
SELECT 
distinct
n.nid, 
'airbnb' as category,
psm.state_name,
vc.channel,
       vc.production_severity, 
vc.code,
vc.description
from 
node n 
left join manager_opt_channel opt on opt.mid=n.uid 
left join property_state_machine psm on psm.nid=n.nid 
left join rep_property rep on rep.nid=n.nid 
left join channel_properties cp on cp.nid=n.nid and cp.channel='airbnb'
    left join radb.validation_results vr on vr.nid=n.nid and vr.is_deleted = 0
left join radb.validation_channels vc on vc.code=vr.code and vc.channel in ('redawning','airbnb')
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
)



");
$counter = 0;
$ha = "INSERT INTO validation_nid (nid, category, state_name, channel, production_severity, code) VALUE ";			
	foreach ($airbnb as $key) {
$nid = $key['nid'];
$cat = $key['category'];
$stat = $key['state_name'];
$chann = $key['channel'];
$prod = $key['production_severity'];
$cod = $key['code'];
$ha .= "('$nid','$cat','$stat','$chann','$prod','$cod')";
if ($counter != count($airbnb)-1){
	$ha .= ",";
}
$counter++;
	}
//var_dump ($ha);
query1($ha);

$homeaway=query("
SELECT 
distinct
n.nid, 
'homeaway' as category,
psm.state_name,
vc.channel,
    vc.production_severity, 
vc.code,
vc.description
FROM 
node n 
left join manager_opt_channel opt on opt.mid=n.uid 
left join property_state_machine psm on psm.nid=n.nid 
left join rep_property rep on rep.nid=n.nid 
left join channel_properties cp on cp.nid=n.nid and cp.channel='homeaway'
left join users u ON n.uid = u.uid
left join radb.validation_results vr on vr.nid=n.nid and vr.is_deleted = 0
left join radb.validation_channels vc on vc.code=vr.code and vc.channel in ('redawning','homeaway')
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

$counter = 0;
$ha = "INSERT INTO validation_nid (nid, category, state_name, channel, production_severity, code) VALUE ";			
	foreach ($homeaway as $key) {
$nid = $key['nid'];
$cat = $key['category'];
$stat = $key['state_name'];
$chann = $key['channel'];
$prod = $key['production_severity'];
$cod = $key['code'];
$ha .= "('$nid','$cat','$stat','$chann','$prod','$cod')";
if ($counter != count($homeaway)-1){
	$ha .= ",";
}
$counter++;
	}
//var_dump ($ha);
query1($ha);
?>