<?php 



try {
	$db = new PDO("mysql:host=localhost;dbname=muzerehberi;charset=utf8",'root','Furkan.35');
	
} catch (PDOException $e) {
	echo "Baglanti Basarisiz<br>";
	echo $e->getMessage(); 
}







 ?>