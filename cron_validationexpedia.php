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

function inputSet($a){
	if ($a!=array ()) {

																													
$counter = 0;
$ha = "INSERT INTO validation_nid (nid, category, state_name, channel, production_severity, code, description) VALUE ";
	foreach ($a as $key) {
		$ha .= "(".$key['nid'].", '".$key['category']."', '".$key['state_name']."', '".$key['channel']."', '".$key['production_severity']."', '".$key['code']."', '".$key['description']."')";
		if ($counter != count($a)-1){
			$ha .= ",";
		}
		$counter++;
	}
return $ha;
	}
}


	
	// 

		
	// 
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
and vc.channel IS NOT NULL;



");
		// var_dump($expedia);

// 		if ($expedia!=array ()) {

																													
// $counter = 0;
// $ha = "INSERT INTO validation_nid (nid, category, state_name, channel, production_severity, code, description) VALUE ";
// 	foreach ($expedia as $key) {
// 		$ha .= "(".$key['nid'].", '".$key['category']."', '".$key['state_name']."', '".$key['channel']."', '".$key['production_severity']."', '".$key['code']."', '".$key['description']."')";
// 		if ($counter != count($expedia)-1){
// 			$ha .= ",";
// 		}
// 		$counter++;
// 	}
// 	}
		echo "<pre>";
		var_dump($expedia);
		echo "</pre>";
echo "===========================================";

foreach ($expedia as $key) {
	# code...
	$qa = "INSERT INTO validation_nid (nid, category, state_name, channel, production_severity, code, description) VALUE (".$key['nid'].", '".$key['category']."', '".$key['state_name']."', '".$key['channel']."', '".$key['production_severity']."', '".$key['code']."', '".$key['description']."');";
	echo $qa;
}
	var_dump($qa);

	query1($qa);
	
	


?>