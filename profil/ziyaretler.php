<?php 
ob_start();
session_start();
include '../adminpanel/baglanti/baglan.php';




$ziyaretsorgusu=$db->prepare("SELECT * FROM ziyaretler where uye_id=:id");

$ziyaretsorgusu->execute(array(

	'id' => $_SESSION['uye_id']

));




?>





<!doctype html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Free Web tutorials">
	<meta name="keywords" content="HTML,CSS,XML,JavaScript">
	<meta name="author" content="John Doe">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">





	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">


	<script src="https://cdn.ckeditor.com/4.11.1/standard/ckeditor.js"></script>



	<title>Ziyaretler</title>
</head>
<body>
	

	<div class="container-fluid" style="background-color:teal">
		<div class="row">
			<div class="col-sm-12 mt-2">
				<h4 class="text-center h4 text-light">Ziyaret Listesi</h4>
			</div>
			
		</div>	




	</div>
	<br>

	<div class="container-fluid">
		
		<div class="row">
			<div class="col-sm-12">
				
				<div class="table-responsive">
					<table class="table">
						<thead>
							
							<th>Müze Adı</th>
							<th>Müze İl</th>
							<th>Müze İlçe</th>
							<th>Ziyaret Tarihi</th>
							<th>Sil</th>

						</thead>

						<tbody>
							
							<?php while ($ziyaret=$ziyaretsorgusu->fetch(PDO::FETCH_ASSOC)) { 

								$muzesorgusu=$db->prepare("SELECT muze_baslik,muze_il,muze_ilce FROM muzeler inner join ziyaretler on muzeler.muze_id=:idmuze");

								$muzesorgusu->execute(array(

									'idmuze' => $ziyaret['muze_id']

								));

								$muze = $muzesorgusu->fetch(PDO::FETCH_ASSOC);

								?>
								<tr>
								
								<td><?php echo $muze['muze_baslik']; ?></td>
								<td><?php echo $muze['muze_il']; ?></td>
								<td><?php echo $muze['muze_ilce']; ?></td>
								<td><?php echo $ziyaret['ziyaret_tarih'] ?></td>
								<td align="center"><a href="../formhandling/islem.php?muzeid=<?php echo $muze['ziyaret_id']?>&ziyaretid=<?php echo $ziyaret['ziyaret_id'] ?>" class="btn btn-sm btn-danger">Sil</a></td>
								</tr>
						<?php }  ?>	




						</tbody>



					</table>
				</div>

			</div>
		</div>	
		<div class="row">
			<div class="col-sm-4 mx-auto">
				<a href="index.php" class="btn btn-block btn-outline-primary btn-lg ">Profile Dön</a>	
			</div>
		</div>

		<h4 class="text-center text-danger"><?php 

			if (isset($_GET['silmedurumu'])) {

				if ($_GET['silmedurumu'] == 'yes') {
					echo "Silme İşlemi Başarılı";
				}
				else {
					echo "Silme İşlemi Başarısız";
				}
			}

			

		 ?></h4>


	</div>




	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>