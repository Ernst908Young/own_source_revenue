<?php

curl_setopt_array($curl, [
  CURLOPT_URL => "https://api.messaging-service.com/sms/1/text/single",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "{\"from\":\"CAIPO\",\"to\":[\"12462629874\"],\"text\":\"Testing SMS API. Please confirm if you get this.\"}",
  CURLOPT_HTTPHEADER => [
    "Accept: application/json",
    "Authorization: Basic Q0JveWNlOldlbGNvbWVAMTIz",
    "Content-Type: application/json"
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}

?>
<?php header('content-type: application/json');
$type = file_get_contents('php://input');
echo json_encode($type);die;?>