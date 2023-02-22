<?php
define("DEBUG", true);
define("ENV", 'prod');   //prod, dev, stg
define("SP_TAG","cdn");
define("APP_NAME", "CDN :: SWCS");
$host_url = $_SERVER['HTTP_HOST'];

if (ENV == 'prod') {
	define("DB_SERVER", "localhost");
    define("DB_USER", "");
    define("DB_PASS", "");
    define("DB_NAME", "");

	define("SECRET","907eb5b6e1ba70c2bb1d65bb12ae6c5t");
	define("API_BASEURL","$host_url/sso");
	define("CDN_BASE_URL", "$host_url/cdn");
    define("CDN_PUBLIC_KEY", "1-1eM!-!NT@908#723!@#$%*****");
	define("SSO_URL", "/register");	
	define("SSO_URL1", "/one");
	define("SSO_URL3", "/signin");
	define("SSO_URL2", "/auth1");
    define("FRONT_BASEURL","/frontoffice");
} 
elseif(ENV == 'stg') {
     define("DB_SERVER", "localhost");
    define("DB_NAME", "zuyaii51_ukrnd");
    define("DB_PASS", "P[1,Lndn^Q{[");
    define("DB_USER", "zuyaii51_ukrnd");
	define("SECRET","907eb5b6e1ba70c2bb1d65bb12ae6c5t");
	define("API_BASEURL","http://103.55.64.21/sso");
	define("CDN_BASE_URL", "http://103.55.64.21/cdn");
    define("CDN_PUBLIC_KEY", "1-1eM!-!NT@908#723!@#$%*****");
	define("SSO_URL", "http://103.55.64.21/sso/register");	
	define("SSO_URL1", "http://103.55.64.21/sso/signup/one");
	define("SSO_URL3", "http://103.55.64.21/sso/account/signin");
	define("SSO_URL2", "http://103.55.64.21/sso/auth/auth1");
    define("FRONT_BASEURL","http://103.55.64.21/frontoffice");
	
}
else {
    define("DB_SERVER", "localhost");
    define("DB_NAME", "swcs");
    define("DB_PASS", "iviss");
    define("DB_USER", "root");
	define("SECRET","907eb5b6e1ba70c2bb1d65bb12ae6c5e");
	define("API_BASEURL","http://103.55.64.21/sso");
	define("CDN_BASE_URL", "http://103.55.64.21/cdn");
	define("SSO_URL", "http://103.55.64.21/sso/register");
	define("SSO_URL1", "http://103.55.64.21/sso/signup/one");
	define("SSO_URL3", "http://103.55.64.21/sso/account/signin");
	define("SSO_URL2", "http://103.55.64.21/sso/auth/auth1");
}       
