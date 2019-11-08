
<!-- End Page Header -->
            <div class="row">
              <div class="col-xl-12">
                <!-- Default -->
                <div class="widget has-shadow">
                  
                  <div class="widget-header bordered no-actions d-flex align-items-center">
                    <h4>This table shows all properties number each integration status.</h4>


                  </div>
                  <div class="widget-body">

<!--  -->

<?php 

// SOURCE  VALUE
// Email 1
// Portal  2
// Phone 3
// Chat  7
// Mobihelp  8
// Feedback Widget 9
// Outbound Email  10

// STATUS  VALUE
// Open  2
// Pending 3
// Resolved  4
// Closed  5

// PRIORITY  VALUE
// Low 1
// Medium  2
// High  3
// Urgent  4

// $api_key = "3b30DUPHiL8eIPCeMdg";
// $password = "changeme";
// $yourdomain = "redawning";



if (isset($_POST['tombol'])) {
$api_key = $_POST['apikey'];
$password = $_POST['pass'];
$yourdomain = "redawning";

//CSV
$filename = 'contoh11.csv';

// The nested array to hold all the arrays
$the_big_array = []; 

// Open the file for reading
if (($h = fopen("{$filename}", "r")) !== FALSE) 
{
  // Each line in the file is converted into an individual array that we call $data
  // The items of the array are comma separated
  while (($data = fgetcsv($h, 1000, ",")) !== FALSE) 
  {
    // Each individual array is being pushed into the nested array
    $the_big_array[] = $data;       
  }

  // Close the file
  fclose($h);
}

//END CSV

//PENGULANGAN ARRAY
// $list = [11111, 9999];
/*
0 = uid
1 = username
2 = account name
3 = crm link
4 = manager config link


*/
echo "<b>Result</b><br>";
foreach ($the_big_array as $key) {


$ticket_data = json_encode(array(
  "description" => "<b>This is New Build Ticket For</b><br><br>".
"<b>UID</b> : ".$key[0]."<br>".
"<b>UserName</b> : ".$key[1]."<br>".
"<b>Account</b> : ".$key[2]."<br>".
"<b>Total Properties</b> : ".$key[3]."<br>".
"<b>CRM Link</b> : ".$key[4]."<br>".
"<b>Manager Config Link</b> : ".$key[5]."<br>".
"<b>PIC</b> : ".$key[6]."<br><br>Please follow up data issue to ".$key[7]."<br><br>Thanks,",

  "subject" => "New Build: ".$key[2]." (Leavetown)",
  "email" => "budi.hermawan@redawning.com",
  "priority" => 2,
  "status" => 3,
  "tags" => array("leavetown"),
  "group_id" => 17000125731,
  // "responder_id" => 17009731796,
  // => ini ID assigned to
  // "cc_emails" => array("vicky.lova@redawning.com")
  // "cc_emails" => array("sugeng@redawning.com", "diana@freshdesk.com")
));

$url = "https://$yourdomain.freshdesk.com/api/v2/tickets";

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
  // echo $headers."\n";
  // echo "Response Body \n";
  // echo "$response \n";
// echo"==================server_output======================================";
// // var_dump ($key." : ".$server_output);
// $profile = json_decode($server_output, TRUE);
$profile1 = json_decode($response, TRUE);
// var_dump ($profile);
echo $key[2]." : https://redawning.freshdesk.com/a/tickets/".$profile1['id']."<br>";
// echo"======================info==================================";
// var_dump($info);
// echo"=====================header_size===================================";
// var_dump($header_size);
// echo"=======================headers=================================";
// var_dump($headers);
// echo"========================response================================";
// var_dump($response);
// echo"========================================================";
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
}else{echo"<br><h4 align='center'>Click Submit To Proceed<h4>";}
?>

<!--  -->
<form method="post">
          <div class="uk-margin uk-align-center" style="width: 300px;">
            <input class="uk-input uk-bulet" type="text" placeholder="apikey" name="apikey" autocomplete="off">
          </div>
          <div class="uk-margin uk-align-center" style="width: 300px;">
            <input class="uk-input uk-bulet" type="text" placeholder="password" name="pass" autocomplete="off">
          </div>
    <div class="uk-margin" uk-margin>
        <button class="uk-button uk-button-default uk-align-center uk-bulet" name="tombol" >Submit</button>
    </div>

</form>

                  </div>
                </div>
                 </div>
                </div>