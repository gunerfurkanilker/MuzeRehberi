
<?php 
ob_start();
session_start();
include 'adminpanel/baglanti/baglan.php';

$giris_durumu = false;


if (isset($_SESSION['uye_login'])) {
	$giris_durumu=true;
}



if (isset($_POST['btn_yorum_yap'])) {
	

	$yorumsorgu = $db->prepare("INSERT INTO yorumlar (muze_id, uye_id, yorum_icerik)
		VALUES (:muzeid, :uyeid, :yorum);
		");

	$yorumsorgu->execute(array(

		'muzeid' => $_POST['muze_id'],
		'uyeid' => $_SESSION['uye_id'],
		'yorum' => $_POST['yorum_icerik']
	));

	if ($yorumsorgu) {
		
		
	}
	else {
		
	}

}











if (isset($_GET['muzeidno'])) {

	$muzesorgu = $db->prepare("SELECT * FROM muzeler WHERE muze_id=:id");

	$muzesorgu->execute(array(
		'id' => $_GET['muzeidno']
	));	

	$muzecek = $muzesorgu->fetch(PDO::FETCH_ASSOC);


	$yorumsorgu=$db->prepare("SELECT * FROM yorumlar where muze_id=:id");

	$yorumsorgu->execute(array(

		'id' => $_GET['muzeidno']

	));




}




if (isset($_POST['btn_muze_kaydet'])) {
	
	$ziyareteklesorgu=$db->prepare("INSERT INTO ziyaretler (uye_id,muze_id) VALUES ( :uyeid, :muzeid) ");

	echo "INSERT INTO ziyaretler (uye_id,muze_id) VALUES ('{$_SESSION['uye_id']}', '{$_GET['muzeidno']}')";

	
	$ziyareteklesorgu->execute(array(

		'uyeid' =>  $_SESSION['uye_id'],
		'muzeid' => $_GET['muzeidno']

	));
}


# facebook register
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
	$redirect_uri = 'http://localhost/gl-callback';

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

	<title><?php echo $muzecek['muze_baslik'] ?></title>
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


			<ul class="dropdown-menu" >
				<li class="dropdown-header"><a href="#" class="dropdown-item"><?php echo $_SESSION['uye_login']; ?></a></li>
				<div class="dropdown-divider"></div>
				<li class="dropdown-item"><a href="profil/index.php" class="dropdown-item">Profil Ayarları</a></li>
				<li class="dropdown-item"><a href="formhandling/islem.php?logout=1" class="dropdown-item">Çıkış Yap</a></li>
			</ul>

		</div>

	</div>
</div>
</nav> 





<div class="container">
	<div class="row mt-1">
		<div class="col-lg-12 jumbotron vitrin">
			<h4 class="display-4 text-left text-light"><?php echo $muzecek['muze_baslik'] ?></h4>
		</div>
	</div>
	<div align="end" class="row">
		<div class="col-md-12 mb-1" <?php 
		$ziyaretbutonactive=true;
		if ($giris_durumu) {
			
		}
		else {
			echo "style=display:none";
		}

		$ziyaretettimisorgu = $db->prepare("SELECT * FROM ziyaretler WHERE uye_id=:id_uye and muze_id=:id_muze");	
		
		$ziyaretettimisorgu->execute(array(

			'id_uye' => $_SESSION['uye_id'],
			'id_muze' => $muzecek['muze_id']

		));

		$say = $ziyaretettimisorgu->rowCount();
		
		if ($say == 1) {
			$ziyaretbutonactive=false;
		}
		else{

		}

		?>>



		<form action="" method="POST">
			<input class="btn  btn-warning float-right" type="submit" name="btn_muze_kaydet" value="<?php if (!$ziyaretbutonactive) {
				
				echo "Bu Yer Ziyaret Listenizde";


			}

			else{
				echo "Ziyaret Listeme Ekle";
			}
			?>" <?php 

			if (!$ziyaretbutonactive) {
				
				echo "disabled";


			}

			?>
			>
		</form>


	</div>
</div>
<div class="row">
	<div class="col-md-4">
		<figure class="figure">
			<img src="assets/images/<?php echo $muzecek['muze_resim'] ?>"  class="figure-img img-fluid rounded" alt="Muze İsmi">
			<figcaption class="figure-caption"><?php echo $muzecek['muze_baslik'] ?></figcaption>
		</figure>

		<div class="card">
			<div class="card-body">
				<h5 class="h5 card-text text-center text-primary">Detaylı Bilgi</h5>
				<div class="row">

					<div class="col-md-6">
						<p class="card-text text-danger">Açılış : <span class="text-muted text-"><?php echo $muzecek['muze_acilis'] ?></span></p>
					</div>
					<div class="col-md-6">
						<p class="card-text text-danger">Kapanış : <span class="text-muted text-"><?php echo $muzecek['muze_kapanis'] ?></span></p>
					</div>


				</div>
				<div class="row">
					<div class="col-md-6">
						<p class="card-text text-danger">Giriş Ücreti : <span class="text-muted text-"><?php echo $muzecek['muze_ucret'] ?></span></p>
					</div>
					<div class="col-md-6">
						<p class="card-text text-danger">Tatil Günü : <span class="text-muted text-"><?php echo $muzecek['muze_tatil_gunu'] ?></span></p>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-md-12">
						<p class="card-text text-primary text-center">Adres</p>
					</div>
					<div class="col-md-12">
						<p class="card-text text-danger text-justify text-center"><?php echo $muzecek['muze_adres'] ?> </p>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-md-12">
						<p class="card-text text-primary text-center">Telefon</p>
					</div>
					<div class="col-md-12">
						<p class="card-text text-danger text-center"><?php echo $muzecek['muze_telefon'] ?> </p>
					</div>
				</div>


				<div class="row">
					<div class="col-md-12">
						<br><br>
						<h6 class="h6 text-danger text-center">UYARI</h6>
						<p class="text-justify ">T.C. Kültür ve Turizm Bakanlığı'nın belirlediği, Müze ve Örenyerlerine girişlerde uygulanacak usul ve esaslar hakkında yönergenin 10.Maddesine göre;
						Müze ve örenyerleri dini bayramların birinci günü saat 13:00’e kadar kapalıdır.</p>
					</div>
				</div>
			</div>
		</div>

		<h4 class="text-center mt-2 text-secondary">Harita Görünümü</h4>
		<?php echo $muzecek['muze_konum'] ?>
		<br>
		<br>
	</div>

	<div class="col-md-8">
		<br>
		<!-- Örnek Metin -->
		<div class="col-md-12">
			<!-- Veritabanında müze bilgisi eğer satır başı varsa <br><br> tagleri yazılmalıdır ki düzgün gözüksün :) -->
			<?php echo $muzecek['muze_aciklama'] ?>

			<h4 class="text-primary">Yorumlar</h4>
			<hr class="bg-primary">
			<!-- EĞER LOGİN YAPILMIŞSA BURADAKİ DİV GİZLENECEK!!!! -->
			
			<!-- Bu Divden 1 tane olcak ne kadar yorum varsa o kadar çoğaltılcak bu div --> 


			<?php while ($yorum = $yorumsorgu->fetch(PDO::FETCH_ASSOC)) { ?>


				<div class="media">
					<div class="row">
						<figure class="figure col-md-3">
							<!-- Kullanıcının Profil Resmi -->
							<img src="https://via.placeholder.com/60" style="width:60px;height:60px;"  class="figure-img img-fluid rounded" alt="Muze İsmi">
							<figcaption class="figure-caption"><?php 

							$uyeadsoyadsorgu=$db->prepare("SELECT uye_adsoyad FROM uyeler INNER JOIN yorumlar ON uyeler.uye_id=yorumlar.uye_id WHERE yorum_id=:id");

							$uyeadsoyadsorgu->execute(array(
								'id' => $yorum['yorum_id']
							));

							$uyeadsoyad = $uyeadsoyadsorgu->fetch(PDO::FETCH_ASSOC);

							echo $uyeadsoyad['uye_adsoyad'];

							?></figcaption>
						</figure>

						<div class="media-body col-md-9">
							
							<p class="yorum"><?php echo $yorum['yorum_icerik'] ?></p>
						</div>
						

						
						
					</div>
					
				</div>
				<div align="end" <?php 

				if (!($_SESSION['uye_id'] == $yorum['uye_id']) ) {
					echo "style='display:none'";
				}

				?>> 
				<ul>
					<a class="btn btn-sm btn-danger " href="formhandling/islem.php?muze-id=<?php echo $muzecek['muze_id'] ?>&yorum-id=<?php echo $yorum['yorum_id'] ?>">Yorumu Sil</a>
					<a class="btn btn-sm btn-secondary " href="#" data-toggle="modal" data-target="#yorumduzenlemodal<?php echo $yorum['yorum_id'] ?>">Yorumu Düzenle</a>
				</ul>
			</div>
			<br>


			<!-- Yorum Düzenleme Modalı --> 
			<div class="modal fade" id="yorumduzenlemodal<?php echo $yorum['yorum_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLongTitle">Yorum Düzenle</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">

							<form action="formhandling/islem.php" method="POST" class="form-horizontal"> 


								<div class="form-group ">
									<label for="yorum">Yorumu Düzenleyin</label>
									<textarea class="form-control" rows="6" id="yorum" name="yorum_duzenle_icerik"><?php echo $yorum['yorum_icerik'] ?></textarea>
									<input type="text" name="yorum_duzenle_id" style="visibility: hidden;" value="<?php echo $yorum['yorum_id'] ?>">
									<input type="text" name="muze_id" style="visibility: hidden;" value="<?php echo $muzecek['muze_id'] ?>">
									<button type="submit" name="yorum_duzenle" class="btn btn-danger btn-block">Düzenlemeyi Tamamla</button>
								</div>
								


							</form>

						</div>


					</div>
				</div>
			</div>





		<?php } ?>


		<!-- EĞER LOGİN YAPILMIŞSA BURADAKİ DİV GİZLENECEK!!!! -->
		<div class="jumbotron uyedegil" <?php 

		if ($giris_durumu) {
			echo "style='display:none'";
		}

		?>>
		<h6 class="text-center">
			<p class="text-muted">Görünüşe göre sitemize üye değilsin. Haydi, gel sitemize üye ol ve müzeler hakkında insanları bilgilendir!</p>
			<a href="uyelik.php" class="btn btn-success btn-lg">Üye Ol</a>
		</h6>
	</div>





	<div class="row" <?php 

	if (!($giris_durumu)) {
		echo "style='display:none'";
	}

	?>>
	<form class="col-md-12" action="" method="POST">
		<div class="form-group ">
			<label for="yorum">Yorum Yap:</label>
			<textarea class="form-control" rows="6" id="yorum" name="yorum_icerik"></textarea>
		</div>

		<div class="" >

			<input class="btn btn-primary float-right" type="submit" name="btn_yorum_yap" value="Yorum Yap" placeholder="Yorum Yazın...">
			<input type="text" name="muze_id" value="<?php echo $muzecek['muze_id']?>" style="visibility:hidden">

		</div>
	</form>
</div>


</div>
</div>

</div>
</div>


<br><br>



  <!-- Giriş Yap Popup penceresi Modal -->
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

          <a href="<?=$loginUrl?>"><button type="button" name="facebooklogin" class="btn btn-block btn-primary text-light" >Google ile Giriş Yap</button></a>

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