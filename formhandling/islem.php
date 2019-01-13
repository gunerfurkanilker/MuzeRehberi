<?php 
ob_start();
session_start();
include '../adminpanel/baglanti/baglan.php';

$muze_arama_sonuclari = null;

if (isset($_POST['dogrudanlogin'])) {
	
	$uye_nick_or_mail = $_POST['uye_adi_mail'];
	$uye_password = md5($_POST['uye_sifre']);


	$uyeliksorgu=$db->prepare('SELECT * FROM uyeler where (uye_mail=:mail or uye_nickname=:nickname) and uye_password=:password');

	$uyeliksorgu->execute(array(

		'mail' => $uye_nick_or_mail,
		'nickname' => $uye_nick_or_mail,
		'password' => $uye_password
	));

	$donensatir=$uyeliksorgu->rowCount();

	
	if ($donensatir > 0) {
		
		$uye=$uyeliksorgu->fetch(PDO::FETCH_ASSOC);
		
		if($uye['2fa_secret'] != '') {
			$_SESSION['2fa_mail'] = $uye['uye_mail'];
			
			header("Location:/MuzeRehberi/2fa.php");
		} else {
			$_SESSION['2fa_mail'] = $uye['uye_mail'];
			
			header("Location:/MuzeRehberi/2fa_create.php");
		}

	}

	else{
		header("Location:../index.php?login=fail");
	}

}

if (isset($_GET['logout'])) {
	

	session_destroy();
	header("Location:../index.php");


}


if (isset($_GET['muze-id']) && isset($_GET['yorum-id'])) {
	
	$yorumsilsorgu = $db->prepare("DELETE FROM yorumlar where yorum_id=:id_yorum and muze_id=:id_muze and uye_id=:id_uye ");

	$yorumsilsorgu->execute(array(

		'id_yorum' => $_GET['yorum-id'],
		'id_muze' => $_GET['muze-id'],
		'id_uye' => $_SESSION['uye_id']


	));

	if($yorumsilsorgu){
		echo "Yorum silindi.";
		header("Location:../muzegoruntule.php?muzeidno=".$_GET['muze-id']);
	}



}


if (isset($_POST['yorum_duzenle'])) {
	
	$yorumguncelle=$db->prepare("UPDATE yorumlar SET yorum_icerik=:icerik WHERE yorum_id=:id_yorum and muze_id=:id_muze and uye_id=:id_uye");

	$yorumguncelle->execute(array(

		'icerik' => $_POST['yorum_duzenle_icerik'],
		'id_yorum' => $_POST['yorum_duzenle_id'],
		'id_muze' => $_POST['muze_id'],
		'id_uye' => $_SESSION['uye_id']

	));

	if ($yorumguncelle) {
		header("Location:../muzegoruntule.php?muzeidno=".$_POST['muze_id']);
	}

}

if (isset($_POST['uyekayit'])) {
	
	$uye_nickname = $_POST['uye_nickname'];
	$uye_adsoyad = $_POST['uye_adsoyad'];
	$uye_password = md5($_POST['uye_sifre']);
	$uye_email = $_POST['uye_email'];
	$hash = md5(rand(0,1000));

	$uyeeklesorgu=$db->prepare("INSERT INTO uyeler (uye_nickname,uye_password,uye_adsoyad,uye_mail,hash) 
		VALUES (:nickname, :password, :adsoyad, :email, :hash)");

	$uyeeklesorgu=$uyeeklesorgu->execute(array(

		'nickname' => $uye_nickname,
		'password' => $uye_password,
		'email' => $uye_email,
		'adsoyad' => $uye_adsoyad,
		'hash' => $hash

	));

	if ($uyeeklesorgu) {
		header("Location:../index.php");
	}
	



}

if (isset($_POST['sifre_degis'])) {
	
	$mevcutsifre=md5($_POST['sifre_mevcut']);
	$yenisifre=md5($_POST['sifre_yeni']);

	$sifredegisssorgu=$db->prepare("SELECT uye_password FROM uyeler where uye_id=:id");

	$sifredegisssorgu->execute(array(

		'id' => $_SESSION['uye_id']

	));

	$kayitlisifre=$sifredegisssorgu->fetch(PDO::FETCH_ASSOC);
	
	if ($mevcutsifre == $kayitlisifre['uye_password']) {
		$sifredegisssorgu=$db->prepare("UPDATE uyeler SET uye_password=:password WHERE uye_id=:id");
		$sifredegisssorgu->execute(array(

			'password' => $yenisifre,
			'id' => $_SESSION['uye_id']

		));
		header("Location:../profil/ayar.php?status=ok");
	}

	else{
		header("Location:../profil/ayar.php?status=no");
	}



}


if (isset($_POST['mail_degis'])) {
	
	$mevcutsifre=md5($_POST['sifre_mevcut']);
	$yenimail=$_POST['mail_yeni'];

	$maildegisssorgu=$db->prepare("SELECT uye_password FROM uyeler where uye_id=:id");

	$maildegisssorgu->execute(array(

		'id' => $_SESSION['uye_id']

	));

	$kayitlisifre=$maildegisssorgu->fetch(PDO::FETCH_ASSOC);
	
	if ($mevcutsifre == $kayitlisifre['uye_password']) {
		$maildegisssorgu=$db->prepare("UPDATE uyeler SET uye_mail=:mail WHERE uye_id=:id");
		$maildegisssorgu->execute(array(

			'mail' => $yenimail,
			'id' => $_SESSION['uye_id']

		));
		header("Location:../profil/ayar.php?stat=ok");
	}

	else{
		header("Location:../profil/ayar.php?stat=no");
	}



}



if (isset($_GET['ziyaretid'])) {
	
	$ziyaretsilsorgu = $db->prepare("DELETE FROM ziyaretler where ziyaret_id=:id_ziyaret");

	$ziyaretsilsorgu->execute(array(

		'id_ziyaret' => $_GET['ziyaretid'],

	));

	if($ziyaretsilsorgu){
		header("Location:../profil/ziyaretler.php");
	}


}



?>