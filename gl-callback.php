<?php
	session_start();

	date_default_timezone_set("Europe/Istanbul");


	#
	include_once($_SERVER['DOCUMENT_ROOT']. '/MuzeRehberi/google/vendor/autoload.php');
	include_once($_SERVER['DOCUMENT_ROOT']. '/MuzeRehberi/google/google/Client.php');
	include_once($_SERVER['DOCUMENT_ROOT']. '/MuzeRehberi/google/google/AccessToken/Verify.php');

	#
	$oauth_credentials = $_SERVER['DOCUMENT_ROOT']. '/MuzeRehberi/google/google/client.json'; 
	$redirect_uri = 'http://localhost/MuzeRehberi/gl-callback.php';
	 
	$Google = new Google_Client();
	$Google->setAuthConfig($oauth_credentials);
	$Google->setRedirectUri($redirect_uri);
	// $this->Google->setScopes('email');
	$Google->setScopes(array(
	    "https://www.googleapis.com/auth/plus.login",
	    "https://www.googleapis.com/auth/userinfo.email",
	    "https://www.googleapis.com/auth/userinfo.profile"
	));

	if (isset($_GET['code'])){
	    $token = $Google->fetchAccessTokenWithAuthCode($_GET['code']);
	    $Google->setAccessToken($token);
	 
	    // store in the session also
	    $_SESSION['google_access_token'] = $token;
	 
	    $Google->setAccessToken($_SESSION['google_access_token']);
	 
	    if ($Google->getAccessToken())
	    {
	        $token_data = $Google->verifyIdToken();
	        
	        $_SESSION['uye_login'] = $token_data['name'];
	        $_SESSION['uye_id']    = $token_data['sub'];

	        header("Location:/MuzeRehberi/");
	    }
	} else {
		echo "Bir hata oluştu. Tekrar girişe dönün: <a href='/giris'>Giriş</a>";
	}
?>