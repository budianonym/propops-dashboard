<?php 
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
// //endfungsi1
// //query data


// //connectionRA
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


 $nids = query("
 SELECT 
 c.nid
 -- ,
 -- c.title as Title,
 -- c.name as 'username', 
 -- c.mail 'email',
 -- c.value as 'Company Name',
 -- c.uid,  
 -- c.state_name, c.state_notes, 
 ,ponote

 from (select vr.is_deleted, po.state_notes 'ponote', vr.code, vr.nid, n.uid,n.title,pv.value, u.name, ss.state_notes, u.mail, psm.state_name, vc.channel, vc.production_severity, vc.description, b.airbnb_opt, b.bookingcom_opt, b.homeaway_opt, b.expedia_opt, b.tripadvisor_opt from validation_results vr
 left join validation_channels vc on vc.code=vr.code
 left join node n on n.nid = vr.nid
 left join users u on u.uid=n.uid
 left join profile_value pv on n.uid = pv.uid AND pv.fid = 21
 left join field_data_field_calendar_feed_format cal on cal.entity_id=n.nid
 left join property_state_machine psm on n.nid=psm.nid
 left join (
 select nid, state_notes from (select  psmnid, nid, state_notes from property_state_machine_notes
 where
 state_notes like 'assigned to%'
 order by psmnid
 desc) y
 group by y.nid
 ) ss on ss.nid=n.nid
 left join(SELECT b.nid, b.state_notes from (select max(psmnid) 'psmnid' from property_state_machine_notes
 where state_notes like '%[PO]%'
 group by nid) a
 left join property_state_machine_notes b on b.psmnid = a.psmnid) po on po.nid = n.nid
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
 where psm.state_name in ('livenotreviewed','FailedValidationNeedsReview', 'BlockedUnderConstruction')
 and n.type = 'rental_property'
 and vc.description like '[PO]%'
 -- REMOVING [PO] MARK IN B.COM AND EXPEDIA THAT HAS OPTIN NULL 
 and not (b.bookingcom_opt is null && vc.channel='bookingcom')
 and not (b.expedia_opt is null && vc.channel='expedia')
 and (vc.production_severity = 'fatal' || (vc.production_severity = 'warning' && vc.channel = 'redawning' && vc.code in (303, 312, 824)) )
 and vr.is_deleted = 0
 and u.mail not in ('hello@leavetown.com','Vicky.Lova@redawning.com',
 'sarah.herz@redawning.com','brett@redawning.com')
 group by n.nid
 ) c
 where ponote is null
 and state_notes is null
 order by c.state_notes, c.nid

 ;
 	");
// // echo "<pre>";
// // var_dump($nids[0]);
// // echo "</pre>";

 $nid=[];
foreach ($nids as $key) {
	echo $key['nid'];
	echo "<br>";
	$nid[] = $key['nid'];
}
// // var_dump($nid);
// $aa = 'assigned to budi.pramono@redawning.com';
$assign = ["assigned to slamet.awaludin@redawning.com", "assigned to kurniawan.masaji@redawning.com", "assigned to puji.hervianto@redawning.com"];
// echo $assign[1]['kitchen'];
//$assign = ['-test1', '-test2', '-test3', '-test4']; 
$number = count($assign)-1;
// 
//$nid = [4981, 4981, 4981, 4981, 4981, 4981, 4981];
// https://admin.redawning.com/dapi/property_state/4981/message
function avi($a, $b){
$api_key = "redawning";
$password = "everydayisholiday";
// $yourdomain = "$a";
$ticket_data = json_encode(array(
  "notes" => "$b"));
$url = "$a";
$ch = curl_init($url);
$header[] = "Content-type: application/json";
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
curl_setopt($ch, CURLOPT_HEADER, true);
curl_setopt($ch, CURLOPT_USERPWD, "$api_key:$password");
curl_setopt($ch, CURLOPT_POSTFIELDS, $ticket_data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$server_output = curl_exec($ch);
$info = curl_getinfo($ch);
$header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
$headers = substr($server_output, 0, $header_size);
$response = substr($server_output, $header_size);
if($info['http_code'] == 201) {
  // echo "Ticket created successfully, the response is given below \n";
  // echo "Response Headers are \n";
  echo $headers."\n";
  // echo "Response Body \n";
  echo "$response \n";
} else {
  if($info['http_code'] == 404) {
    echo "Error, Please check the end point \n";
  } else {
    echo "Error, HTTP Status Code : " . $info['http_code'] . "\n";
    echo "Headers are ".$headers;
    echo "Response are ".$response;
  }
}
curl_close($ch);

}
foreach ($nid as $key) {
	if ($number==-1) {
		$number = count($assign)-1;
	}
	avi("https://admin.redawning.com/dapi/property_state/".$key."/message", $assign[$number]);
	$number--;
}


 ?>