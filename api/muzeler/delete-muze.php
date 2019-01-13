<?php 
include '../../adminpanel/baglanti/baglan.php';

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: application/json');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');


$gelendata= json_decode(file_get_contents('php://input'));



if (isset($_GET['muzeid'])) {
	$muzeid=$gelendata->muzeid;
	

	$muzeupdatesorgu=$db->prepare("DELETE FROM muzeler where muze_id=:id" );

	$muzeupdatesorgu->execute(array(
		'id' => $muzeid
	));

	if ($muzeupdatesorgu) {
		echo "Muze BAşarı ile Silindi.";
	}
	else {
		echo "Muze Silme Başarısız.";
	}

}
else {
	echo "ID numarası bulunamadı";
}



















?>