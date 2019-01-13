<?php
	session_start();

	date_default_timezone_set("Europe/Istanbul");

# facebook register
	use Facebook\Facebook;
	include $_SERVER['DOCUMENT_ROOT']. '/MuzeRehberi/facebook/autoload.php';

	$fb = new Facebook([
		'app_id' => '603833620052990',
		'app_secret' => 'a05d69fe08566a650a26837d94d1fd3c',
		'default_graph_version' => 'v2.2',
	]);


	$helper      = $fb->getRedirectLoginHelper();
	$permissions = ['email'];
	$loginUrl    = $helper->getLoginUrl('http://localhost/MuzeRehberi/fb-callback.php', $permissions);

	# google login
	include_once($_SERVER['DOCUMENT_ROOT']. '/MuzeRehberi/google/vendor/autoload.php');
	include_once($_SERVER['DOCUMENT_ROOT']. '/MuzeRehberi/google/Google/Client.php');
	include_once($_SERVER['DOCUMENT_ROOT']. '/MuzeRehberi/google/Google/AccessToken/Verify.php');

	#
	$oauth_credentials = $_SERVER['DOCUMENT_ROOT']. '/MuzeRehberi/google/Google/client.json'; 
	$redirect_uri = 'http://localhost/MuzeRehberi/gl-callback.php';

	$Google = new Google_Client();
	$Google->setAuthConfig($oauth_credentials);
	$Google->setRedirectUri($redirect_uri);
	$Google->setScopes(array(
	    "https://www.googleapis.com/auth/plus.login",
	    "https://www.googleapis.com/auth/userinfo.email",
	    "https://www.googleapis.com/auth/userinfo.profile"
	));
	
	$google_login_url = $Google->createAuthUrl();
?>

<!DOCTYPE html>
<html>
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Free Web tutorials">
	<meta name="keywords" content="HTML,CSS,XML,JavaScript">
	<meta name="author" content="John Doe">


	<link rel="stylesheet" type="text/css" href="css/sayfa-stilleri.css">
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">




	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

	<title>Üyelik Sayfası</title>
</head>
<body>

	<nav  id="baslik" class="navbar navbar-expand-lg sticky-top  navigasyonBari">
		<div class="container">
			<a href="index.php" class="navbar-brand navbarBasligi"><i class="fas fa-landmark mr-2"></i>MÜZE REHBERİ</a>
			<button  type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navmenuleri"><i class="fas fa-bars"></i></button>

			<div class="collapse navbar-collapse" id="navmenuleri">

				<ul class="navbar-nav">


					<li class="nav-item"><a class="nav-link navLinkleri" href="index.php"><i class="fas fa-home mr-2"></i>ANASAYFA</a></li>
					<li class="nav-item"><a class="nav-link navLinkleri" href="muzearama.php"><i class="fas fa-landmark mr-2"></i>MÜZELER</a></li>
					

				</ul>


				
				<ul class="navbar-nav ml-auto" <?php if ($giris_durumu == true) {
					echo "style='display:none;'";
				} ?>>

				<li class="nav-item"><a class="nav-link navLinkleri" href="uyelik.php"><i class="fas fa-user mr-2"></i>Üye Ol</a></li>
				<li class="nav-item"><a class="nav-link navLinkleri" href="#" data-toggle="modal" data-target="#exampleModalCenter"><i class="fas fa-sign-in-alt mr-2"></i>Giriş Yap</a></li>

			</ul>

			<div class="dropdown  ml-auto " <?php 

			if ($giris_durumu == false) {
				echo "style='display:none;'";
			}

			?> >

			<img src="https://via.placeholder.com/40" class=" img-fluid rounded-circle nav-item"  data-toggle="dropdown">


			<ul class="dropdown-menu"  >
				<li class="dropdown-header"><a href="#" class="dropdown-item"><?php echo $_SESSION['uye_login']; ?></a></li>
				<div class="dropdown-divider"></div>
				<li class="dropdown-item"><a href="#" class="dropdown-item">Profil Ayarları</a></li>
				<li class="dropdown-item"><a href="formhandling/islem.php?logout=1" class="dropdown-item">Çıkış Yap</a></li>
			</ul>

		</div>


	</div>
</div>
</nav> 



<div class="container mt-1">
	<div class="row">
		<div class="jumbotron vitrin col-md-12">
			<h3 class="display-4 text-light text-center">Üyelik Formu</h3>
		</div>
	</div>

	<div class="row">
		<div class="jumbotron col-md-5 vitrin mx-auto" >
			<h5 class="display-4 text-light" >Neden Üyelik?</h5>
			<br><br>
			<ul class="nedenler" style="list-style-type: none;padding: 0px;">
				<li style="color:white"><p>Müzeler ile alâkalı yorum yapma</p></li>
				<li style="color:white"><p>Kişisel profil oluşturma</p></li>
				<li style="color:white"><p>Ziyaret ettiğiniz müzeleri profilinize ekleme</p></li>
				<li style="color:white"><p>Müze ararken ziyaret ettiğiniz müzeleri filtreleyebilirsiniz.</p></li>
				<li style="color:white"><p>Ayrıca bilgi paylaştıkça çoğalır.Sitemize üye olarak elde ettiğiniz deneyimlerinizi diğer ziyaretçilerimizle paylaşabilirsiniz.</p></li>
				<li style="color:white"><p>Öyle ise ne duruyorsunuz,hadi üye olup paylaşmaya başlayın!</p></li>
			</ul>
		</div>	

		<form method="POST" class="col-md-7 mx-auto" action="formhandling/islem.php" >

			<div class="form-group">
				<label for="emal">Adınız Soyadınız : </label>
				<input type="text" class="form-control" id="emal" name="uye_adsoyad" placeholder="" required="">
			</div>

			<div class="form-group">
				<label for="email">Nickname / Kullanıcı Adı</label>
				<input type="text" class="form-control" id="email" name="uye_nickname" placeholder="" required="">
			</div>

			<div class="form-group">
				<label for="email">Email:</label>
				<input type="email" class="form-control" id="email" name="uye_email" placeholder="ornek@foo.com" required="">
			</div>

			<div class="form-group">
				<label for="pwd">Password:</label>
				<input type="password" class="form-control" id="pwd" name="uye_sifre" placeholder="" required="">
			</div>
			<button type="submit" name="uyekayit" class="btn btn-primary btn-block">Kaydı Tamamla</button>
		</form>
	</div>
</div>
<br><br>

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Giriş Yap</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">

				<form action="formhandling/islem.php" method="POST" class="form-horizontal"> 

					<div class="form-group">
						<label for="emailgirdi">Kullanıcı Adı veya E-Mail</label>
						<input type="text" class="form-control" id="kAdiEmail" aria-describedby="emailkismi" placeholder="Enter email" name="uye_adi_mail">
						<small id="emailkismi" class="form-text text-muted">Kayıt olurken aldığınız kullanıcı adı veya e-mail adresiniz.</small>
					</div>

					<div class="form-group">
						<label for="sifrealani">Şifre</label>
						<input type="password" class="form-control" id="sifrealani" placeholder="Şifreniz" name="uye_sifre">
					</div>

					<button type="submit" name="dogrudanlogin" class="btn btn-primary btn-success btn-block">Giriş Yap</button>

					<a href="<?=$loginUrl?>"><button type="button" name="facebooklogin" class="btn btn-block text-light" style="background-color:#3C5A99;"><img  class="img-fluid" src="https://www.dsmranddtaxcredits.co.uk/wp-content/uploads/2018/05/facebook.png">  <span class="text-light">Facebook ile Giriş Yap</span> </button></a>

					<a href="<?=$google_login_url?>"><button type="button" name="facebooklogin" class="btn btn-block btn-primary text-light" >Google ile Giriş Yap</button></a>

				</form>

			</div>


		</div>
	</div>
</div>












<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>