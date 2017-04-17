<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "http://".$argv[1].":".$argv[2]."/status/sessions",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "cache-control: no-cache"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

if($err)
{
        echo "offline"; 
        exit;
}

$array=json_decode(json_encode(simplexml_load_string($response)),true);

if(!isset($array['Video'])){
        echo "stop";
        exit;
}
if(isset($array['Video']['@attributes'])){
        if(!isset($array['Video']['Player'])){
                echo "stop";
                exit;
        }
        if($array['Video']['Player']['@attributes']['machineIdentifier'] == $argv[3]){
                echo $array['Video']['Player']['@attributes']['state'];
                exit;
        }
}else{
   foreach ($array['Video'] as $key => $video) {
        if(!isset($video['Player'])){
                continue;
        }
        if($video['Player']['@attributes']['machineIdentifier'] == $argv[3]){
                echo $video['Player']['@attributes']['state'];
                exit;
        }
   }
}

echo "stop";

exit;
