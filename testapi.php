<?php
   define("EZPAY_REVERIFICATION","1");
   define("EZPAY_API_KEY","112121");
   define("REVERIFY_API_URL","http://52.172.209.7/testres.php");
   $tno ="1111112222222222222";
   $pobject = "232231233";
$ezpay = EZPAY_API_KEY;
if(EZPAY_REVERIFICATION == 1){
      $curl = curl_init();
      curl_setopt($curl, CURLINFO_HEADER_OUT, true);
      curl_setopt_array($curl, array( 
	  CURLOPT_URL => REVERIFY_API_URL,
          
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => '',
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 0,
	  CURLOPT_FOLLOWLOCATION => true,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => 'POST',
	  CURLOPT_POSTFIELDS =>"{
	    'transaction_number': $tno, 
	    'pobject': $pobject
	}",
          
	  CURLOPT_HTTPHEADER => array(
	    "X-API-KEY: $ezpay",
	    'Content-Type: application/json'
	  ),

	));
      
	$response = curl_exec($curl);
	
$headerSent = curl_getinfo($curl, CURLINFO_HEADER_OUT ); 
print_r($headerSent);curl_close($curl);
	//print_r(json_decode($information));
	//$verifystatus = $res->status;
}

?>
