<?php 
function http_request($url){
    // persiapkan curl
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
$profile = http_request("https://EQC_Redawning:EWK3E7KDY4V2iR7@services.expediapartnercentral.com/properties/171975/roomTypes");
								// ubah string JSON menjadi array
                                $profile = json_decode($profile, TRUE);
                                echo "<pre>";
                                var_dump($profile["entity"][0]["resourceId"]);
                                echo "</pre>";

                                // echo "<pre>";
                                // foreach($profile["entity"] as $key){
echo str_replace('https://services.expediapartnercentral.com/properties/171975/roomTypes/','',$profile["entity"][0]["_links"]["self"]["href"]);
                                // }
                                // echo "</pre>";

?>