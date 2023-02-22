<?php
define("IS_HTTP_AUTH",True);
define("HTTP_AUTH_USERNAME","dev");
define("HTTP_AUTH_PASSWORD","devdev");
// sso server
define("DEBUG", true);
define("ENV", 'prod');   //prod, dev, stg
define("APP_NAME", "SSWS");
$server_host = 'http://' . $_SERVER['HTTP_HOST'].'/panchayatiraj';
if (ENV == 'prod') {

    define("DB_SERVER", "localhost");
    define("DB_USER", "DEV_SWCS_UK_AP_USER_PAN");
    define("DB_PASS", 'dy6@#4kSh!&8JSs');
    define("DB_NAME", "panchayati_raj");
    define("API_BASEURL", "$server_host/sso");
    define("SSO_API_PUBLIC_KEY", '1-1eM@1\!T@908#723$$%%^&&*()Thakur)-=/.');
    define("BO_API_BASEURL", "$server_host/backoffice/api/v1");
    define("FRONT_BASEURL", "/");
    define("SWCS_URL", "$server_host/swcs/sample/one");
    define("EMAIL_MESSAGE", "Thank you for registering your IUID number is: ");
    define("SP_KEY", "UK_CHHATISHGARH_$908%#^");
    define('SW_PUBLIC_KEY', '!@#$%^&*()_++_)(*&&^%%%%');
    define("BASE_URL","http://52.172.145.30");
    define("CURL_URL", "http://52.172.145.30");
    define("WEB_BASE_URL", "http://52.172.145.30/panchayatiraj");
    define("WEB_PORTAL_URL", "http://52.172.145.30/panchayatiraj");
    define("EMAIL_API","http://52.172.145.30/backoffice/api/V1/testEmail");
    define("EMAIL_HOST", "smtp.gmail.com");
    define("EMAIL_USERNAME","caipodummy@gmail.com");
    define("EMAIL_PASSWORD","caipo@1234");
    define("EMAIL_PORT","587");
    define("EMAIL_NAME","CAIPO");
    define("WEB_CURL_URL", "http://52.172.145.30/panchayatiraj");
    define("EMAIL_WEB_URL", "http://protected.caipo.gov.bb");

}

define("PASSWORD_SECRET_KEY", 'b99#3H?AQ7Zfsj');
define("UK_URL", "http://caipotesturl.com/UK/sample/one/");
define("OTP_SECRET_KEY", '1-1eM@1\!T@908#723$$%%^&&*()');
define("PRIVATE_KEY", "6LfcnQsTAAAAAIgbSyqg0qkjO2yOvhj6SqX_y3Js");
define("PUBLIC_KEY", "6LfcnQsTAAAAAAP0hADhJ8Ow19ExY-Yl85TLdXVX");
define("SSO_PRIVATE_KEY", '6Lfe5BcTAAAAAJgRtsq75tQ6mLO36T1Nl2ZxFN-h');
define("SSO_PUBLIC_KEY", '6Lfe5BcTAAAAACFRPI_4agKD6GkfTI5sA6qiAXoQ');
