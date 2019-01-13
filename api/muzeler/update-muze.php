<?php 
include '../../adminpanel/baglanti/baglan.php';

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: application/json');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');


$gelendata= json_decode(file_get_contents('php://input'));



if (isset($_GET['muzeid'])) {
	$muzeid=$gelendata->muzeid;
	

	$muzeupdatesorgu=$db->prepare("UPDATE muzeler SET muze_baslik=:baslik, muze_resim=:resim, muze_aciklama=:aciklama, muze_acilis=:acilis, muze_kapanis=:kapanis, muze_ucret=:ucret, muze_telefon=:telefon, muze_adres=:adres, muze_il=:il, muze_ilce=:ilce, muze_konum=:konum, muze_tatil_gunu=:tatil_gunu WHERE muze_id=:id" );

	$muzeupdatesorgu->execute(array(
		'id' => $muzeid,
		'baslik' => $gelendata->baslik,
		'resim' => $gelendata->resim,
		'aciklama' => $gelendata->aciklama,
		'acilis' => $gelendata->acilis,
		'kapanis' => $gelendata->kapanis,
		'ucret' => $gelendata->ucret,
		'telefon' => $gelendata->telefon,
		'adres' => $gelendata->adres,
		'il' => $gelendata->il,
		'ilce' => $gelendata->ilce,
		'konum' => $gelendata->konum,
		'tatil_gunu' => $gelendata->tatil_gunu
	));

	if ($muzeupdatesorgu) {
		echo "Muze BAşarı ile Güncellendi.";
	}
	else {
		echo "Muze Güncelleme Başarısız.";
	}

}
else {
	echo "ID numarası bulunamadı";
}



















?>