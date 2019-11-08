<html>
<head>
<?php 
// echo $upload_data['full_path'];
$kookie = '[
    {
        "domain": ".admin.redawning.com",
        "expirationDate": 1573123884.515376,
        "hostOnly": false,
        "httpOnly": true,
        "name": "SESS5aff04e77346b9f91f3adac9202a1821",
        "path": "/",
        "sameSite": "unspecified",
        "secure": false,
        "session": false,
        "storeId": "0",
        "value": "hSzUBkdRVckBTs8BUhxoiQQuc6rnNuBbr39ADVFil4s",
        "id": 1
    },
    {
        "domain": ".admin.redawning.com",
        "expirationDate": 1573123884.515469,
        "hostOnly": false,
        "httpOnly": true,
        "name": "SSESS5aff04e77346b9f91f3adac9202a1821",
        "path": "/",
        "sameSite": "unspecified",
        "secure": true,
        "session": false,
        "storeId": "0",
        "value": "oxWf3EhDnld6CNTGhdtPl-cpiNODXfyqOFxG09A7O80",
        "id": 2
    },
    {
        "domain": ".redawning.com",
        "expirationDate": 1602663696.497715,
        "hostOnly": false,
        "httpOnly": true,
        "name": "__cfduid",
        "path": "/",
        "sameSite": "unspecified",
        "secure": true,
        "session": false,
        "storeId": "0",
        "value": "d218da27dd443a9c52df6763bb07203271571127696",
        "id": 3
    },
    {
        "domain": ".redawning.com",
        "expirationDate": 1634370751,
        "hostOnly": false,
        "httpOnly": false,
        "name": "_ga",
        "path": "/",
        "sameSite": "unspecified",
        "secure": false,
        "session": false,
        "storeId": "0",
        "value": "GA1.2.1223775904.1571123870",
        "id": 4
    },
    {
        "domain": ".redawning.com",
        "expirationDate": 1578899875,
        "hostOnly": false,
        "httpOnly": false,
        "name": "_gcl_au",
        "path": "/",
        "sameSite": "unspecified",
        "secure": false,
        "session": false,
        "storeId": "0",
        "value": "1.1.1502687650.1571123876",
        "id": 5
    },
    {
        "domain": ".redawning.com",
        "expirationDate": 1571385151,
        "hostOnly": false,
        "httpOnly": false,
        "name": "_gid",
        "path": "/",
        "sameSite": "unspecified",
        "secure": false,
        "session": false,
        "storeId": "0",
        "value": "GA1.2.815819715.1571123870",
        "id": 6
    },
    {
        "domain": "admin.redawning.com",
        "expirationDate": 1573715875,
        "hostOnly": true,
        "httpOnly": false,
        "name": "currency_translator",
        "path": "/",
        "sameSite": "unspecified",
        "secure": false,
        "session": false,
        "storeId": "0",
        "value": "USD",
        "id": 7
    },
    {
        "domain": "admin.redawning.com",
        "expirationDate": 1602834855,
        "hostOnly": true,
        "httpOnly": false,
        "name": "Drupal.tableDrag.showWeight",
        "path": "/",
        "sameSite": "unspecified",
        "secure": false,
        "session": false,
        "storeId": "0",
        "value": "0",
        "id": 8
    },
    {
        "domain": "admin.redawning.com",
        "hostOnly": true,
        "httpOnly": false,
        "name": "has_js",
        "path": "/",
        "sameSite": "unspecified",
        "secure": false,
        "session": true,
        "storeId": "0",
        "value": "1",
        "id": 9
    },
    {
        "domain": "admin.redawning.com",
        "expirationDate": 1573808864,
        "hostOnly": true,
        "httpOnly": false,
        "name": "propertypage_url_singlepaymentpage_data",
        "path": "/",
        "sameSite": "unspecified",
        "secure": false,
        "session": false,
        "storeId": "0",
        "value": "https%3A%2F%2Fadmin.redawning.com%2Frental-property%2Ftesting-folly-beach",
        "id": 10
    }
    ]';

?>
<title>Done</title>
</head>
<body>
<h3>Done</h3>
<?php 
if (($handle = fopen($upload_data['full_path'], "r")) !== FALSE) {
    $csvs = [];
    while(! feof($handle)) {
       $csvs[] = fgetcsv($handle);
    }
    $datas = [];
    $column_names = [];
    foreach ($csvs[0] as $single_csv) {
        $column_names[] = $single_csv;
    }
    foreach ($csvs as $key => $csv) {
        if ($key === 0) {
            continue;
        }
        foreach ($column_names as $column_key => $column_name) {
            $datas[$key-1][$column_name] = $csv[$column_key];
        }
    }
//     var_dump($datas);
// echo "=============";
unset($datas[count($datas)-1]);
// echo "=============";

    $json = json_encode($datas);
    fclose($handle);
    // echo '<pre>';
    // print_r($json);
    // echo '</pre>';
}
function http_requestt($aa, $bb){
 
    $ch = curl_init();
curl_setopt($ch, CURLOPT_FRESH_CONNECT, TRUE);
curl_setopt($ch, CURLOPT_URL,            "http://192.168.1.7:3333/ra/facilityname" );
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
curl_setopt($ch, CURLOPT_POST,           1 );
curl_setopt($ch, CURLOPT_POSTFIELDS,     '{"data": {"channelid": '.$aa.',"cookie": '.$bb.'}}' ); 
curl_setopt($ch, CURLOPT_HTTPHEADER,     array('Content-Type: application/json', 'Cache-Control: no-cache','Cache-Control', 'no-store, no-cache, must-revalidate, private')); 

$resultJson=curl_exec ($ch);
// return $result;
// tutup curl 
curl_close($ch);      

// mengembalikan hasil curl
return $resultJson;
}
// $resultt = json_decode(http_requestt($json, $kookie), TRUE);
$resultt = json_decode(http_requestt($json, $_POST['cookiee']), TRUE);

echo '<pre>';
print_r($resultt);
echo '</pre>';
// var_dump($_POST['cookiee']);
?>


</body>
</html>