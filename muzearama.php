<?php 
ob_start();
session_start();
include 'adminpanel/baglanti/baglan.php';

$muzearamasorgu;

if (isset($_GET['aranan_muze']) && trim($_GET['aranan_muze']) != '' ){

	$muze_baslik = mb_strtolower($_GET['aranan_muze']);
	

	$muzearamasorgu = $db->prepare("SELECT muze_id,muze_baslik,muze_resim,muze_ilce,muze_il FROM muzeler WHERE muze_baslik like :muze_baslik");

	$muzearamasorgu->execute(array(

		'muze_baslik' => '%'. $muze_baslik . '%'
	));
}

$giris_durumu = false;


if (isset($_SESSION['uye_login'])) {
	$giris_durumu=true;
}


if (isset($_GET['muzeler'])) {

	
	$muzearamasorgu=$db->prepare("SELECT muze_id,muze_baslik,muze_resim,muze_ilce,muze_il FROM muzeler");
	$muzearamasorgu->execute();
	
}

if (isset($_GET['il'])) {
	$muzearamasorgu=$db->prepare("SELECT muze_id,muze_baslik,muze_resim,muze_ilce,muze_il FROM muzeler where muze_il=:il");
	$muzearamasorgu->execute(array(
		'il' => $_GET['il']
	));
}

if (isset($_GET['alfabetik'])) {
	$muzearamasorgu=$db->prepare("SELECT muze_id,muze_baslik,muze_resim,muze_ilce,muze_il FROM muzeler ORDER BY muze_baslik ASC");
	$muzearamasorgu->execute();
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
	
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Free Web tutorials">
	<meta name="keywords" content="HTML,CSS,XML,JavaScript">
	<meta name="author" content="John Doe">


	<link rel="stylesheet" type="text/css" href="css/sayfa-stilleri.css">
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">




	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">



	<title>Müze Arama</title>
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
				<li class="dropdown-item"><a href="profil/index.php" class="dropdown-item">Profil Ayarları</a></li>
				<li class="dropdown-item"><a href="formhandling/islem.php?logout=1" class="dropdown-item">Çıkış Yap</a></li>
			</ul>

		</div>


	</div>
</div>
</nav> 



<div class="container">
	<form class="mt-3" action="" method="GET">
		<div class="input-group mb-3 col-md-12">
			<input name="aranan_muze" type="text" class="form-control form-control-lg" placeholder="Müze Arayın..." aria-label="Recipient's username" aria-describedby="basic-addon2">
			<div class="input-group-append">
				<button class="btn btn-outline-secondary" type="submit" ><i class="fas fa-search mr-2"></i></button>
			</div>
		</div>

		<div class="dropdown col-md-12">
			<div class="row">
				<div class="col-md-4 mt-3">
					<a href="muzearama.php?muzeler=tummuzeler" class="btn btn-success btn-lg btn-block" >Tüm Müzeleri Getir</a>
				</div>

				<div class="col-md-4 mt-3">
					<div class="dropdown">
						<button class="btn btn-dark dropdown-toggle btn-lg btn-block" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
							İl Seçin
						</button>
						<ul class="dropdown-menu pre-scrollable" aria-labelledby="dropdownMenuButton" role="menu">
							<a class="dropdown-item" href="muzearama.php?il=İstanbul">İstanbul</a>
							<a class="dropdown-item" href="muzearama.php?il=Ankara">Ankara</a>
							<a class="dropdown-item" href="muzearama.php?il=İzmir">İzmir</a>
							<a class="dropdown-item" href="muzearama.php?il=Adana">Adana</a>
							<a class="dropdown-item" href="muzearama.php?il=Adıyaman">Adıyaman</a>
							<a class="dropdown-item" href="muzearama.php?il=Afyon">Afyon</a>
							<a class="dropdown-item" href="muzearama.php?il=Ağrı">Ağrı</a>
							<a class="dropdown-item" href="muzearama.php?il=Amasya">Amasya</a>
							<a class="dropdown-item" href="muzearama.php?il=Antalya">Antalya</a>
							<a class="dropdown-item" href="muzearama.php?il=Artvin">Artvin</a>
							<a class="dropdown-item" href="muzearama.php?il=Aydın">Aydın</a>
							<a class="dropdown-item" href="muzearama.php?il=Balıkesir">Balıkesir</a>
							<a class="dropdown-item" href="muzearama.php?il=Bilecik">Bilecik</a>
							<a class="dropdown-item" href="muzearama.php?il=Bingöl">Bingöl</a>
							<a class="dropdown-item" href="muzearama.php?il=Bitlis">Bitlis</a>
							<a class="dropdown-item" href="muzearama.php?il=Bolu">Bolu</a>
							<a class="dropdown-item" href="muzearama.php?il=Burdur">Burdur</a>
							<a class="dropdown-item" href="muzearama.php?il=Bursa">Bursa</a>
							<a class="dropdown-item" href="muzearama.php?il=Çanakkale">Çanakkale</a>
							<a class="dropdown-item" href="muzearama.php?il=Çankırı">Çankırı</a>
							<a class="dropdown-item" href="muzearama.php?il=Çorum">Çorum</a>
							<a class="dropdown-item" href="muzearama.php?il=Denizli">Denizli</a>
							<a class="dropdown-item" href="muzearama.php?il=Diyarbakır">Diyarbakır</a>
							<a class="dropdown-item" href="muzearama.php?il=Edirne">Edirne</a>
							<a class="dropdown-item" href="muzearama.php?il=Elazığ">Elazığ</a>
							<a class="dropdown-item" href="muzearama.php?il=Erzincan">Erzincan</a>
							<a class="dropdown-item" href="muzearama.php?il=Erzurum">Erzurum</a>
							<a class="dropdown-item" href="muzearama.php?il=Eskişehir">Eskişehir</a>
							<a class="dropdown-item" href="muzearama.php?il=Gaziantep">Gaziantep</a>
							<a class="dropdown-item" href="muzearama.php?il=Giresun">Giresun</a>
							<a class="dropdown-item" href="muzearama.php?il=Gümüşhane">Gümüşhane</a>
							<a class="dropdown-item" href="muzearama.php?il=Hakkari">Hakkari</a>
							<a class="dropdown-item" href="muzearama.php?il=Hatay">Hatay</a>
							<a class="dropdown-item" href="muzearama.php?il=Isparta">Isparta</a>
							<a class="dropdown-item" href="muzearama.php?il=Mersin">Mersin</a>
							<a class="dropdown-item" href="muzearama.php?il=Kars">Kars</a>
							<a class="dropdown-item" href="muzearama.php?il=Kastamonu">Kastamonu</a>
							<a class="dropdown-item" href="muzearama.php?il=Kayseri">Kayseri</a>
							<a class="dropdown-item" href="muzearama.php?il=Kırklareli">Kırklareli</a>
							<a class="dropdown-item" href="muzearama.php?il=Kırşehir">Kırşehir</a>
							<a class="dropdown-item" href="muzearama.php?il=Kocaeli">Kocaeli</a>
							<a class="dropdown-item" href="muzearama.php?il=Konya">Konya</a>
							<a class="dropdown-item" href="muzearama.php?il=Kütahya">Kütahya</a>
							<a class="dropdown-item" href="muzearama.php?il=Malatya">Malatya</a>
							<a class="dropdown-item" href="muzearama.php?il=Manisa">Manisa</a>
							<a class="dropdown-item" href="muzearama.php?il=Kahramanmaraş">Kahramanmaraş</a>
							<a class="dropdown-item" href="muzearama.php?il=Mardin">Mardin</a>
							<a class="dropdown-item" href="muzearama.php?il=Muğla">Muğla</a>
							<a class="dropdown-item" href="muzearama.php?il=Muş">Muş</a>
							<a class="dropdown-item" href="muzearama.php?il=Nevşehir">Nevşehir</a>
							<a class="dropdown-item" href="muzearama.php?il=Niğde">Niğde</a>
							<a class="dropdown-item" href="muzearama.php?il=Ordu">Ordu</a>
							<a class="dropdown-item" href="muzearama.php?il=Rize">Rize</a>
							<a class="dropdown-item" href="muzearama.php?il=Sakarya">Sakarya</a>
							<a class="dropdown-item" href="muzearama.php?il=Samsun">Samsun</a>
							<a class="dropdown-item" href="muzearama.php?il=Siirt">Siirt</a>
							<a class="dropdown-item" href="muzearama.php?il=Sinop">Sinop</a>
							<a class="dropdown-item" href="muzearama.php?il=Sivas">Sivas</a>
							<a class="dropdown-item" href="muzearama.php?il=Tekirdağ">Tekirdağ</a>
							<a class="dropdown-item" href="muzearama.php?il=Tokat">Tokat</a>
							<a class="dropdown-item" href="muzearama.php?il=Trabzon">Trabzon</a>
							<a class="dropdown-item" href="muzearama.php?il=Tunceli">Tunceli</a>
							<a class="dropdown-item" href="muzearama.php?il=Şanlıurfa">Şanlıurfa</a>
							<a class="dropdown-item" href="muzearama.php?il=Uşak">Uşak</a>
							<a class="dropdown-item" href="muzearama.php?il=Van">Van</a>
							<a class="dropdown-item" href="muzearama.php?il=Yozgat">Yozgat</a>
							<a class="dropdown-item" href="muzearama.php?il=Zonguldak">Zonguldak</a>
							<a class="dropdown-item" href="muzearama.php?il=Aksaray">Aksaray</a>
							<a class="dropdown-item" href="muzearama.php?il=Bayburt">Bayburt</a>
							<a class="dropdown-item" href="muzearama.php?il=Karaman">Karaman</a>
							<a class="dropdown-item" href="muzearama.php?il=Kırıkkale">Kırıkkale</a>
							<a class="dropdown-item" href="muzearama.php?il=Batman">Batman</a>
							<a class="dropdown-item" href="muzearama.php?il=Şırnak">Şırnak</a>
							<a class="dropdown-item" href="muzearama.php?il=Bartın">Bartın</a>
							<a class="dropdown-item" href="muzearama.php?il=Ardahan">Ardahan</a>
							<a class="dropdown-item" href="muzearama.php?il=Iğdır">Iğdır</a>
							<a class="dropdown-item" href="muzearama.php?il=Yalova">Yalova</a>
							<a class="dropdown-item" href="muzearama.php?il=Karabük">Karabük</a>
							<a class="dropdown-item" href="muzearama.php?il=Kilis">Kilis</a>
							<a class="dropdown-item" href="muzearama.php?il=Osmaniye">Osmaniye</a>
							<a class="dropdown-item" href="muzearama.php?il=Düzce">Düzce</a>
						</ul>
					</div>
				</div>


				<div class="col-md-4 mt-3">
					<a href="muzearama.php?alfabetik=tummuzeler" class="btn btn-info btn-lg btn-block">Müzeleri Alfabetik Sırala</a>
				</div>


			</div>
		</div>


	</form>

	<br>	

	<div class="row">
		<div class="col-md-12">
			<h5 class="text-dark text-center">Arama Sonuçları</h5>
			<hr class="bg-secondary">
		</div>
	</div>


	<div class="row">



		<?php 

		if ((isset($_GET['aranan_muze']) && trim($_GET['aranan_muze']) != '') or $_GET['muzeler'] or $_GET['il'] or $_GET['alfabetik']) {

			while ($muze = $muzearamasorgu->fetch(PDO::FETCH_ASSOC)) {?>

				<div class="col-md-4 d-flex align-items-stretch my-2">
					<div class="card border-dark">
						<div class="card-body d-flex flex-column" >
							<img  class="card-img img-responsive img-fluid" src="assets/images/<?php echo $muze['muze_resim']; ?>" style="width:300px;height:200px;" >
							<h5  class="card-title text-center mt-3 text-justify"><?php echo $muze['muze_baslik']; ?></h5>
							<p class="card-text text-justify text-center"><?php echo $muze['muze_ilce']; ?>/<?php echo $muze['muze_il'] ?></p>
							<a href="muzegoruntule.php?muzeidno=<?php echo $muze['muze_id'] ?>" class="btn btn-outline-dark btn-block mt-auto">Ayrıntılı Bilgi</a>
						</div>
					</div>
				</div>

			<?php 	}

		} else {
			echo "Sonuç Yok";
		}


		?>








	</div>


</div>















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













<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>


</body>
</html>