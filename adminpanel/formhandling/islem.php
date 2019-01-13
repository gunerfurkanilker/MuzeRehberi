<?php
ob_start();
session_start();
include '../baglanti/baglan.php';

if (isset($_POST['admingiris'])) {
	
	$admin_username = $_POST['admin_username'];
	$admin_password = md5($_POST['admin_password']);


	$adminsorgula=$db->prepare("SELECT * FROM admin where admin_username=:username and admin_password=:password");
	$adminsorgula->execute(array(

		'username' => $admin_username,
		'password' => $admin_password

	));

	
	$say = $adminsorgula->rowCount();
	

	if ($say == 1) {
		$_SESSION['admin_session_username'] = $admin_username;
		header("Location:../adminpanelui/index.php");

	}

	else{

	}



}



if (isset($_POST['muze_ekle'])) {
	
	$muze_baslik = $_POST['muze_baslik'];
	$muze_resim	= $_POST['muze_resim'];
	$muze_aciklama = $_POST['muze_aciklama'];
	$muze_acilis = $_POST['muze_acilis'];
	$muze_kapanis = $_POST['muze_kapanis'];
	$muze_ucret = $_POST['muze_ucret'];
	$muze_telefon = $_POST['muze_telefon'];
	$muze_adres = $_POST['muze_adres'];
	$muze_il = $_POST['muze_il'];
	$muze_ilce = $_POST['muze_ilce'];
	$muze_konum = $_POST['muze_konum'];
	$muze_tatil_gunu = $_POST['muze_tatil_gunu'];

	$muzesorgu = $db->prepare("INSERT INTO muzeler (muze_baslik, muze_resim, muze_aciklama, muze_acilis, muze_kapanis, muze_ucret, muze_telefon, muze_adres, muze_il, muze_ilce, muze_enlem, muze_boylam, muze_tatil_gunu) 
		VALUES (:baslik, :resim, :aciklama, :acilis, :kapanis, :ucret, :telefon, :adres, :il, :ilce, :konum, :tatil_gunu );
		");


	$muzesorgu->execute(array(

		'baslik' => $muze_baslik,
		'resim' => $muze_resim,
		'aciklama' => $muze_aciklama,
		'acilis' => $muze_acilis,
		'kapanis' => $muze_kapanis,
		'ucret' => $muze_ucret,
		'telefon' => $muze_telefon,
		'adres' => $muze_adres,
		'il' => $muze_il,
		'ilce' => $muze_ilce,
		'konum' => $muze_konum,
		'tatil_gunu' => $muze_tatil_gunu


	));

	

	if ($muzesorgu) {
		header("Location:../adminpanelui/muze-ekle.php?eklemedurumu=yes");
	}

	else {

		header("Location:../adminpanelui/muze-ekle.php?eklemedurumu=no");
	}


}




if (isset($_POST['muze_guncelle'])) {


	$muze_baslik = $_POST['muze_baslik'];
	$muze_resim	= $_POST['muze_resim'];
	$muze_aciklama = $_POST['muze_aciklama'];
	$muze_acilis = $_POST['muze_acilis'];
	$muze_kapanis = $_POST['muze_kapanis'];
	$muze_ucret = $_POST['muze_ucret'];
	$muze_telefon = $_POST['muze_telefon'];
	$muze_adres = $_POST['muze_adres'];
	$muze_il = $_POST['muze_il'];
	$muze_ilce = $_POST['muze_ilce'];
	$muze_konum = $_POST['muze_konum'];
	$muze_tatil_gunu = $_POST['muze_tatil_gunu'];
	$muze_id_no = $_POST['muze_id_no'];

	var_dump($muze_id_no);
	$muzeguncelle=$db->prepare("UPDATE muzeler SET muze_baslik=:baslik,muze_resim=:resim,muze_aciklama=:aciklama,muze_acilis=:acilis,muze_kapanis=:kapanis,muze_ucret=:ucret,muze_telefon=:telefon,muze_adres=:adres,muze_il=:il,muze_ilce=:ilce,muze_konum=:konum,muze_tatil_gunu=:tatil_gunu 
		where muze_id=:id
		");

	$muzecek = $muzeguncelle->execute(array(
		'baslik' => $muze_baslik,
		'resim' => $muze_resim,
		'aciklama' => $muze_aciklama,
		'acilis' => $muze_acilis,
		'kapanis' => $muze_kapanis,
		'ucret' => $muze_ucret,
		'telefon' => $muze_telefon,
		'adres' => $muze_adres,
		'il' => $muze_il,
		'ilce' => $muze_ilce,
		'konum' => $muze_konum,
		'tatil_gunu' => $muze_tatil_gunu,
		'id' => $muze_id_no
	));
	
	if ($muzecek) {
		$lokasyon = "Location:../adminpanelui/muze-duzenle.php?guncellemedurumu=yes&muzeid=" . $muze_id_no;
		header($lokasyon);
	}
	else {
		header("Location:../adminpanelui/muze-duzenle.php?guncellemedurumu=no&muzeid=" . $muze_id_no);
	}


}

if (isset($_GET['muzeid'])) {

	$muzesilsorgu=$db->prepare("DELETE FROM muzeler where muze_id=:id");
	$muzesilsorgu=$muzesilsorgu->execute(array(

		'id' => $_GET['muzeid']

	));

	if ($muzesilsorgu) {
		header("Location:../adminpanelui/muze-goruntule.php?silmedurumu=yes");
	}
	else {
		header("Location:../adminpanelui/muze-goruntule.php?silmedurumu=no");
	}

}


if (isset($_POST['uye_ekle'])) {
	
	$uye_nickname = $_POST['uye_nickname'];
	$uye_password = md5($_POST['uye_password']);
	$uye_adsoyad = $_POST['uye_adsoyad'];
	$uye_mail = $_POST['uye_mail'];
	$uye_gsm = $_POST['uye_gsm'];


	$uyesorgu = $db->prepare("INSERT INTO uyeler (uye_nickname,uye_password,uye_adsoyad,uye_mail,uye_gsm)
		VALUES (:nickname, :password, :adsoyad, :mail, :gsm)
		");

	$uyesorgu = $uyesorgu->execute(array(
		
		'nickname' => $uye_nickname,
		'password' => $uye_password,
		'adsoyad' => $uye_adsoyad,
		'mail' => $uye_mail,
		'gsm' => $uye_gsm

	));

	if ($uyesorgu) {
		header("Location:../adminpanelui/uye-ekle.php?uyeekledurumu=yes");
	}

	else{
		header("Location:../adminpanelui/uye-ekle.php?uyeekledurumu=no");
	}

}



if (isset($_GET['uyeid'])) {

	$uyesilsorgu=$db->prepare("DELETE FROM uyeler where uye_id=:id");
	$uyesilsorgu=$uyesilsorgu->execute(array(

		'id' => $_GET['uyeid']

	));

	if ($uyesilsorgu) {
		header("Location:../adminpanelui/muze-goruntule.php?silmedurumu=yes");
	}
	else {
		header("Location:../adminpanelui/muze-goruntule.php?silmedurumu=no");
	}

}



if (isset($_POST['uye_guncelle'])) {


	$uye_nickname = $_POST['uye_nickname'];
	$uye_password	= md5($_POST['uye_password']);
	$uye_adsoyad = $_POST['uye_adsoyad'];
	$uye_mail = $_POST['uye_mail'];
	$uye_gsm = $_POST['uye_gsm'];
	$uye_id_no = $_POST['uye_id_no'];
	$uyeguncelle=$db->prepare("UPDATE uyeler SET uye_nickname=:nickname, uye_password=:password, uye_adsoyad=:adsoyad, uye_mail=:mail, uye_gsm=:gsm where uye_id=:id");

	$uyecek = $uyeguncelle->execute(array(
		'nickname' => $uye_nickname,
		'password' => $uye_password,
		'adsoyad' => $uye_adsoyad,
		'mail' => $uye_mail,
		'gsm' => $uye_gsm,
		'id' => $uye_id_no
	));
	
	if ($uyecek) {
		$lokasyon = "Location:../adminpanelui/uye-duzenle.php?guncellemedurumu=yes&uyeid=" . $uye_id_no;
		header($lokasyon);
	}
	else {
		header("Location:../adminpanelui/uye-duzenle.php?guncellemedurumu=no&uyeid=" . $uye_id_no);
	}


}












?>