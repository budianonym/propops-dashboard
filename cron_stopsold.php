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
$ha = "INSERT INTO stopsold (nid, expediaid, manager, stopsold, is_due) VALUE ";
	foreach ($a as $key) {
		$ha .= "(".$key['nid'].", '".$key['channel_id']."', '".$key['manager']."', 'Inactive', '0')";
		if ($counter != count($a)-1){
			$ha .= ",";
		}
		$counter++;
	}
return $ha;
var_dump($ha);
	}
}


	$stopsold=query("
SELECT cp.nid,channel_id,n.title 'propertyname',u.mail 'manager', DATE_FORMAT(convert_tz(created_ts,'US/Pacific','Asia/Jakarta'), '%Y-%m-%d') 'date' from channel_properties cp
left join node n on cp.nid=n.nid
left join users u on u.uid=n.uid
where channel = 'expedia'
-- and nid = 293132
and DATE_FORMAT(convert_tz(created_ts,'US/Pacific','Asia/Jakarta'), '%Y-%m-%d') = DATE_FORMAT(CURDATE(),'%Y-%m-%d')
-- and channel_id != 0

");
	$update1=query1(inputSet($stopsold));
	// 
