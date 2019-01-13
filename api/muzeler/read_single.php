<?php 

include '../../adminpanel/baglanti/baglan.php';

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


$muzesorgu=$db->prepare("SELECT * FROM muzeler where muze_id=:id");








if (isset($_GET['muzeid'])) {
$muzesorgu->execute(
	array(
		'id' => $_GET['muzeid']
	)
);


	$muzeler_arr = array();
	$muzeler_arr['data'] = array();
	$muzecek=$muzesorgu->fetch(PDO::FETCH_ASSOC);
		$muze_data = array(

			'id' =>	$muzecek['muze_id'],
			'baslik' => $muzecek['muze_baslik'],
			'tanim' =>html_entity_decode($muzecek['muze_aciklama']),
			'acilis' => $muzecek['muze_acilis'],
			'kapanis' => $muzecek['muze_kapanis'],
			'ucret' => $muzecek['muze_ucret'],
			'telefon' => $muzecek['muze_telefon'],
			'adres' => $muzecek['muze_adres'],	
			'il' => $muzecek['muze_il'],
			'ilce' => $muzecek['muze_ilce'],
			'tatil_gunu' => $muzecek['muze_tatil_gunu']

		);
	

		array_push($muzeler_arr['data'],$muze_data);
		echo json_encode($muzeler_arr);

	}

	


else {
	echo json_encode(array(

		'message' => 'Muze Bulunamadi'

	));

}



?>