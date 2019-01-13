<?php
	session_start();

	include 'adminpanel/baglanti/baglan.php';

	# google 2fa
	require_once $_SERVER['DOCUMENT_ROOT']. '/MuzeRehberi/google/GoogleAuthenticator.php';

	#
	$ga        = new GoogleAuthenticator();

	# secret check
	$uyeliksorgu=$db->prepare('SELECT * FROM uyeler where uye_mail=:mail');

	$uyeliksorgu->execute(array(
		'mail' => $_SESSION['2fa_mail']
	));

	$uye = $uyeliksorgu->fetch(PDO::FETCH_ASSOC);

	if($uye['2fa_secret'] != '') {
		$secret = $uye['2fa_secret'];
	} else {
		$secret = $ga->createSecret();

		# update secret
		$uyeliksorgu=$db->prepare("UPDATE uyeler SET 2fa_secret = '{$secret}' where uye_mail='{$_SESSION['2fa_mail']}'");
		$uyeliksorgu->execute();
	}

	# qr code	
	$qrCodeUrl = $ga->getQRCodeGoogleUrl($_SESSION['2fa_mail'], $secret, 'Müze rehberi');
?>

<img src="<?=$qrCodeUrl?>">