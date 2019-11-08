

<style type="text/css">
	
	th {
width: 400px;


	}
	.container{

		width: 600px;
	}
</style>
<?php
//fungsi2
function koneksi() {
	$conn=mysqli_connect("localhost","root","","ra");
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


//endfungsi1

//query data
$jadi=query("SELECT `no`, `nid`, `category`, `state_name`, `channel`, `production_severity`, `code`, `description`, DATE_FORMAT(timestamp,'%Y-%m-%d') 'timestamp' FROM `validation_nid` where DATE_FORMAT(timestamp,'%Y-%m-%d') = '2019-08-13' 
	-- and category = 'expedia' and nid = 229952
;");

// $jadi=query("SELECT count(nid) 'num',
// -- nid, title, PM, Integration,
// state from (SELECT  psm.nid 'nid', n.title 'title', psm.state_name 'state', pv.value 'PM',mc.integration_name 'Integration' FROM radb.property_state_machine psm
// left join property_state_machine_notes note on note.nid = psm.nid
// left join node n on n.nid=psm.nid
// left join users u on u.uid=n.uid
// left join profile_value pv on n.uid = pv.uid AND pv.fid = 21
// left join manager_cc_fees mc on mc.mid=n.uid
// where state_name in ('AccountStatusNotSet','BlockedUnderconstruction','ProductionHalted','OnboardingPaused','CheckAccountStatus','OnboardingUnderReview','LiveNotReviewed','FailedValidationNeedsReview','WaitingForValidation')
// -- and pv.value = 'Seascape Resort'
// -- and not note.state_notes like '%assign%'
// group by psm.nid) a
// group by a.state
// order by a.state
// ;");

 ?>
<!DOCTYPE html>
<html>
<head>
	<link rel="icon" href="redawning/ra.png" type="image/png">		
	<title>All Status</title>
</head>	
<body id="page-top">
	/<pre>
	<?php
	var_dump($jadi); 

	?>
	</pre>
</body>
</html>