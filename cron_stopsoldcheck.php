
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

function http_request($url){
    // persiapkan curll
    $ch = curl_init(); 

    // set url 
    curl_setopt($ch, CURLOPT_URL, $url);
    
    // set user agent    
    curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');

    // return the transfer as a string 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 

    // $output contains the output string 
    $output = curl_exec($ch); 

    // tutup curl 
    curl_close($ch);      

    // mengembalikan hasil curl
    return $output;
}

$isduecheck = query1("UPDATE stopsold SET is_due = '1'
where DATEDIFF(CURDATE(),created_at) > 5");

$due_list = query1("SELECT nid FROM stopsold 
  where (stopsold != 'Active' || expediaid in ('', 0))
    -- || created_at = '2019-09-06 23:55:04')
  -- and nid in (311686,276110,276385,282258,301706,311724,311809,311701,311651,301966,309556,309556,292424,292426,292454,292569, 302075,302299);
  
	");

// var_dump($due_list);
// echo "<pre>";
// var_dump($isduecheck);
// echo "</pre>";
   
$i = 1;
// $expediaStatus = array();
    foreach ($due_list as $id) {
 $profile = http_request("https://EQC_Redawning:EWK3E7KDY4V2iR7@services.expediapartnercentral.com/properties/v1/redawning/".$id['nid']);
// ubah string JSON menjadi array
$profile = json_decode($profile, TRUE); 
             if (array_key_exists("errors",$profile)){
            // 	array_push($expediaStatus, array(
            // 		'nid' => $id['nid'],
            // 		'stopsold' => $profile['errors'][0]['message']
            // 	)
            // );
              query1("UPDATE stopsold
                  SET stopsold = '".$profile['errors'][0]['message']."'
                  WHERE nid = ".$id['nid']." ;");
              echo $id['nid']." -> ".$profile['errors'][0]['message']."<br>";
            } 
            elseif ($profile['entity']['inventorySettings']['onStopSell']==true) {
              //   array_push($expediaStatus, array(
              //   'nid' => $id['nid'],
              //   'stopsold' => 'Active'
              // ));

              query1("UPDATE stopsold
                  SET stopsold = 'Inactive', expediaid = '".$profile['entity']['expediaId']."'
                  WHERE nid = ".$id['nid']." ;");
              
              echo $id['nid']." -> Inactive<br>";
}else{
              //   array_push($expediaStatus, array(
              //   'nid' => $id['nid'],
              //   'stopsold' => 'Inactive'
              // ));
              query1("UPDATE stopsold
                  SET stopsold = 'Active', expediaid = '".$profile['entity']['expediaId']."'
                  WHERE nid = ".$id['nid']." ;");
              
              echo $id['nid']." -> Active<br>";
            }  
if (($i%50)==0 ) {
	sleep(5);
}
// elseif (($i%500)==0) {
//   sleep(30);
// }

 $i++;};
// echo "<pre>";
//  var_dump($expediaStatus) ;
// echo "</pre>";                

					
// foreach ($expediaStatus as $key) {
// 	$nidd = $key['nid'];
// 	$stat = $key['stopsold'];
// 	query1("UPDATE stopsold
// SET stopsold = '".$stat."'
// WHERE nid = ".$nidd." ;");

	// echo $expediaid;
	// echo $stat;
// }		

?>