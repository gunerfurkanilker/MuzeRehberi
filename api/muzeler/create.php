<?php 

include '../../adminpanel/baglanti/baglan.php';

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: application/json');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');


$gelendata= json_decode(file_get_contents('php://input'));



$muzeolustursorgu=$db->prepare("INSERT INTO muzeler (muze_baslik,muze_resim,muze_aciklama,muze_acilis,muze_kapanis,muze_ucret,muze_telefon,muze_adres,muze_il,muze_ilce,muze_konum,muze_tatil_gunu) VALUES (:baslik, :resim, :aciklama, :acilis, :kapanis, :ucret, :telefon, :adres, :il, :ilce, :konum, :tatil_gunu)");

$muzeolustursorgu->execute(

	array(
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
	)

);




if ($muzeolustursorgu) {
	echo json_encode(array(

		'message' => 'Muze Başarı ile eklendi'

	));

	}

	



else {
	echo json_encode(array(

		'message' => 'Muze Eklenemedi'

	));

}








?>