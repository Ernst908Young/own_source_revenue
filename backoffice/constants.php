<?php
define("DEBUG", true);
define("ENV", 'prod');
define("ENV_ERROR", 'PROD');
define("IS_HTTP_AUTH",FALSE);
define("HTTP_AUTH_USERNAME","");
define("HTTP_AUTH_PASSWORD","");
define("APP_NAME", "CAIPO");
global $wturls;
$host_url = 'http://'.$_SERVER['HTTP_HOST'].'/panchayatiraj';

if (ENV == 'prod') {
    define("DB_SERVER", "localhost");
    define("DB_USER", "DEV_SWCS_UK_AP_USER_PAN");
    define("DB_PASS", 'dy6@#4kSh!&8JSs');
    define("DB_NAME", "panchayati_raj");
    define("TOKE_API_BASEURL","/sso");
    // TOKEN_API_BASEURL constant is used for api
    define("TOKEN_API_BASEURL","/sso");
    $wturls=array("$host_url/sso/account/register","","/sso");
    define("OTP_SECRET_KEY", '1-1eM@1\!T@908#723$$%%^&&*()');
    define("BO_API_PUBLIC_KEY", '1-1eM@1\!T@908#723$$%%^&&*()Thakur');
    define("SSO_API_PUBLIC_KEY", '1-1eM@1\!T@908#723$$%%^&&*()Thakur)-=/.');
    define("SSO_URL1", "$host_url/swcs/sample/one");
    define("CDN_APIV1", "$host_url/cdn/apiv1/documents");
    define("CDN_PUBLIC_KEY", "1-1eM!-!NT@908#723!@#$%*****");
    define('SW_PUBLIC_KEY','!@#$%^&*()_++_)(*&&^%%%%');
    define("EMAIL_HOST","smtp.gmail.com");
    define("BO_API_BASEURL","/backoffice/api/v1");
    define("EMAIL_USERNAME","caipodummy@gmail.com");
    define("EMAIL_PASSWORD","caipo@1234");
    define("EMAIL_PORT","587");
    define("EMAIL_NAME","CAIPO");
    define("DOC_PASS", "3sc3RL92d17");
    define("DOC_CIPHER", "quelodtncvgeuksi");

    /*sms gateway detail*/
    define("SMS_GATEWAY","https://www.");
    define("SMS_GATEWAY_ID","info");
    define("SMS_GATEWAY_PASSWD",'doasd');
    define("FRONT_BASEURL","/");
    define("EMAIL_MESSAGE","Thank you for registering your UUID number is: ");
    define("PASSWORD_SECRET_KEY","UK_CHHATISGARH!@$%$^$%%$^$^");

    define("PDF_HEADER_TITLE_CAF", 'Corporate Affairs And Intellectual Property Office');
    define("PDF_HEADER_STRING1" ,"A Division Of The Ministry Of International Business And Industry");
    define("PDF_HEADER_STRING2" ,"Barbados");
    define("WORLDLINE_GW_MERCHANT_ID","");
    define("WORLDLINE_ENCRYP_KEY","");
    define("WORLDLINE_CURRENCY","INR");
    define("ADMIN_MOBILE", "9953798953");
    define("BASE_URL","http://52.172.145.30/panchayatiraj");
    define("CURL_URL", "http://52.172.145.30/panchayatiraj");
	define("WEB_CURL_URL", "http://52.172.145.30/panchayatiraj");
    define("WEB_BASE_URL", "http://52.172.145.30/panchayatiraj");
    define("EMAIL_API","http://52.172.145.30/panchayatiraj/backoffice/api/V1/testEmail");
    define("PAYMENT_JS","https://dev.ezpay.gov.bb/portal/scripts/ezpay_plugin_eservices.js");
    define("REVERIFY_API_URL","https://dev.ezpay.gov.bb/portal/scripts/eservices_api.php");
    define("EZPAY_API_KEY","SwtBAQt23WcP3xt9RrmwFMUvNAhxy5rERrzuTgWx");
    define("EZPAY_REVERIFICATION",0);
    define("EMAIL_WEB_URL", "http://protected.caipo.gov.bb");
    define("IS_NOTIFICATION_ON",1);
}
