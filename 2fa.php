<?php
	session_start();

	include 'adminpanel/baglanti/baglan.php';

	if(!isset($_SESSION['2fa_mail'])) {
		header("Location:/MuzeRehberi/");
		exit();
	}

	#
	require_once $_SERVER['DOCUMENT_ROOT']. '/MuzeRehberi/google/GoogleAuthenticator.php';

	#
	$ga        = new GoogleAuthenticator();
	$uyeliksorgu=$db->prepare('SELECT * FROM uyeler where uye_mail=:mail');

	$uyeliksorgu->execute(array(
		'mail' => $_SESSION['2fa_mail']
	));

	$uye = $uyeliksorgu->fetch(PDO::FETCH_ASSOC);
	// $qrCodeUrl = $ga->getQRCodeGoogleUrl($_SESSION['2fa_mail'], $get['2fa_secret'], 'Üninot');

	if($_POST) {
		$checkResult = $ga->verifyCode($uye['2fa_secret'], $_POST['secret']);

		if($checkResult === true) {
			$_SESSION['uye_login'] = $uye['uye_adsoyad']; 
			$_SESSION['uye_id'] = $uye['uye_id'];
			$_SESSION['mail_verified'] = $uye['active'];
			$_SESSION['uye_mail'] = $uye['uye_mail'];
			$_SESSION['uye_hash'] = $uye['hash'];
			$_SESSION['uye_nickname'] = $uye['uye_nickname'];

			header("Location:/MuzeRehberi/");
		} else {
			echo "hatalı kod";
		}
	}
?>

<form action="" method="post">
	<input type="text" name="secret">
	<input type="submit" value="Doğrula">
</form>