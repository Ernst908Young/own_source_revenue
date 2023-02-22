
<?php

if (!isset($_POST['token2'])) {

    $url = 'http://52.172.209.7/backoffice/checkip.php';
    $method = 'POST';
    $header = array(
        'Content-Transfer-Encoding: ',
        'Content-Type: application/x-www-form-urlencoded'
    );
    $body = 'token2=2121';

    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => $method,
        CURLOPT_HTTPHEADER => $header,
    ));
    if ($method == "POST") {
        curl_setopt_array($curl, array(CURLOPT_POSTFIELDS => $body));
    }
    $response = curl_exec($curl);
    curl_close($curl);
    echo $response;
}

if (isset($_POST['token2']) && $_POST['token2'] != "") {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if (getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if (getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if (getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if (getenv('HTTP_FORWARDED'))
        $ipaddress = getenv('HTTP_FORWARDED');
    else if (getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';

    $ipaddress = getenv('REMOTE_ADDR');
    echo $ipaddress;
}

