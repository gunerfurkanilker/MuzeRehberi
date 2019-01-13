<?php 
ob_start();
session_start();
include '../baglanti/baglan.php';

if (!isset($_SESSION['admin_session_username'])) {
	header("Location:login.php");
}
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



	<title>Admin Paneli</title>
</head>
<body>
	

	<div class="container-fluid" style="background-color:teal">
		<div class="row">
			<div class="col-sm-12 mt-2">
				<h4 class="text-center h4 text-light">Admin Paneli </h4>
				<h5 class="text-warning text-center" ><small > <?php echo $_SESSION['admin_session_username'] ?> olarak giriş yaptınız</small></h5>
				<form action="" method="POST">
					<a class="btn btn-sm btn-danger float-right" href="logout.php" >Çıkış yap</a>
				</form>
			</div>
			
		</div>	




	</div>
	<br>

	<div class="container-fluid">
		
		<div class="row">
			<div class="col-sm-3">
				<h5 class="text-center text-muted">Müze CRUD İşlemleri</h5>
				<a class="btn btn-dark btn-block" href="muze-ekle.php">Müze Ekle</a>
				<a class="btn btn-dark btn-block" href="muze-goruntule.php">Müzeleri Görüntüle</a>
				<hr>
				<h5 class="text-center text-muted">Kullanici CRUD İşlemleri</h5>
				<a class="btn btn-primary btn-block" href="uye-ekle.php">Üye Ekle</a>
				<a class="btn btn-primary btn-block" href="uye-goruntule.php">Üyeleri Görüntüle</a>
				<hr>
				<h5 class="text-center text-muted">Ziyaret Edilen Müzeler</h5>
				<a class="btn btn-warning btn-block" href="#">Ziyaret Edilen Müzeler</a>
				<hr>
				<h5 class="text-center text-muted">Hakkımızda</h5>
				<a class="btn btn-success btn-block" href="#">Hakkımızda Düzenle</a>
				<hr>
				<h5 class="text-center text-muted">Admin Hesap Ayarları</h5>
				<a class="btn btn-danger btn-block" href="#">Admin Ekle</a>
				<a class="btn btn-danger btn-block" href="#">Admin Sil</a>
			</div>
			<form class="col-sm-9" action="../formhandling/islem.php" method="POST">
				<h4 class="text-primary text-center">Müze Ekleme İşlemleri</h4>
				<hr>
				<div>

					<div class="form-group">
						<label class="control-label" for="first-name">Müze Başlığı <span class="required">*</span>
						</label>
						<div class="">
							<input type="text" id="first-name" required="required" name="muze_baslik" value="" class="form-control">
						</div>
					</div>

					<div class="form-group">
						<label class="control-label" for="first-name">Müze Resim Linki <span class="required">*</span>
						</label>
						<div class="">
							<input type="text" id="first-name" required="required" name="muze_resim" value="" class="form-control">
						</div>
					</div>


					<div class="form-group">
						<label class="control-label" for="first-name">Müze Açıklaması <span class="required">*</span></label>
						<textarea  class="ckeditor" id="editor1" name="muze_aciklama"></textarea>
					</div>

					<script type="text/javascript">

						CKEDITOR.replace( 'editor1',

						{

							filebrowserBrowseUrl : 'ckfinder/ckfinder.html',

							filebrowserImageBrowseUrl : 'ckfinder/ckfinder.html?type=Images',

							filebrowserFlashBrowseUrl : 'ckfinder/ckfinder.html?type=Flash',

							filebrowserUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',

							filebrowserImageUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',

							filebrowserFlashUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',

							forcePasteAsPlainText: true

						} 

						);

					</script>




					<div class="form-group">
						<label class="control-label" for="first-name">Müze Açılış Saati <span class="required">*</span>
						</label>
						<div class="">
							<input type="text" id="first-name" required="required" name="muze_acilis" value="" class="form-control" placeholder="Örn : 11:00">
						</div>
					</div>

					<div class="form-group">
						<label class="control-label" for="first-name">Müze Kapanış Saati <span class="required">*</span>
						</label>
						<div class="">
							<input type="text" id="first-name" required="required" name="muze_kapanis" value="" class="form-control" placeholder="Örn : 11:00">
						</div>
					</div>


					<div class="form-group">
						<label class="control-label" for="first-name">Müze Ücreti <span class="required">*</span>
						</label>
						<div class="">
							<input type="text" id="first-name" required="required" name="muze_ucret" value="" class="form-control" placeholder="60TL gibi...">
						</div>
					</div>


					<div class="form-group">
						<label class="control-label" for="first-name">Müze Telefon <span class="required">*</span>
						</label>
						<div class="">
							<input type="text" id="first-name" required="required" name="muze_telefon" value="" class="form-control" placeholder="">
						</div>
					</div>

					<div class="form-group">
						<label class="control-label" for="first-name">Müze Adresi <span class="required">*</span>
						</label>
						<div class="">
							<input type="text" id="first-name" required="required" name="muze_adres" value="" class="form-control" placeholder="">
						</div>
					</div>

					<div class="form-group">
						<label class="control-label" for="first-name">Müze İl <span class="required">*</span>
						</label>
						<div class="">
							<input type="text" id="first-name" required="required" name="muze_il" value="" class="form-control" placeholder="">
						</div>
					</div>

					<div class="form-group">
						<label class="control-label" for="first-name">Müze İlce <span class="required">*</span>
						</label>
						<div class="">
							<input type="text" id="first-name" required="required" name="muze_ilce" value="" class="form-control" placeholder="">
						</div>
					</div>

				
					<div class="form-group">
						<label class="control-label" for="first-name">Müze Konum --Kaynak Seçeneiğini işaretle-- <span class="required">*</span></label>
						<textarea  class="ckeditor" id="editor2" name="muze_konum"></textarea>
					</div>

					<script type="text/javascript">

						CKEDITOR.replace( 'editor2',

						{

							filebrowserBrowseUrl : 'ckfinder/ckfinder.html',

							filebrowserImageBrowseUrl : 'ckfinder/ckfinder.html?type=Images',

							filebrowserFlashBrowseUrl : 'ckfinder/ckfinder.html?type=Flash',

							filebrowserUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',

							filebrowserImageUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',

							filebrowserFlashUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',

							forcePasteAsPlainText: true

						} 

						);

					</script>
					<div class="form-group">
						<label class="control-label" for="first-name">Müze Tatil Günleri <span class="required">*</span>
						</label>
						<div class="">
							<input type="text" id="first-name" required="required" name="muze_tatil_gunu" value="" class="form-control" placeholder="Pazartesi,Salı">
						</div>
					</div>

					<div class="row">
						<input type="submit" name="muze_ekle" value="Kaydı Tamamla" class="btn btn-sm btn-block btn-danger">
					</div>

					<br>

					<h4 class="text-primary text-center"><?php 

						if (isset($_GET['eklemedurumu'])) {
							if ($_GET['eklemedurumu'] == 'yes') {
								echo "Müze Başarı ile Eklendi";
							}

							else {
								echo "Müze Ekleme Başarısız";
							}
							
						}




					 ?></h4>

				</div>
			</form>
		</div>	

	


		<br><br>


	</div>




	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>