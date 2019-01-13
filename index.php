<?php 
ob_start();
session_start();

include '/adminpanel/baglanti/baglan.php';

$giris_durumu = false;



if (isset($_SESSION['uye_login'])) {
  $giris_durumu=true;
  
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

<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Free Web tutorials">
  <meta name="keywords" content="HTML,CSS,XML,JavaScript">
  <meta name="author" content="John Doe">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

  

  

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

  <link rel="stylesheet" type="text/css" href="css/sayfa-stilleri.css">

  <title>Muze Rehberi</title>
</head>
<body>

  <div class="container-fluid"  style="<?php 

      if (false) {
          
         if ($_SESSION['mail_verified'] == 0) {
            
         }
        else {
            echo "display:none;";
        }

      }

      else {
        echo "display:none;";
      }


   ?>">
    <div class="jumbotron">
     
      <h5 class="text-dark text-center">Başarı ile giriş yaptınız fakat e-mail hesabından doğrulama yapmanız gerekli.<br> Alttaki linkten mail adresinizi onaylayın</h5>
      <br>
      <p class="text-center lead" ><a href="verify.php" >E-Mail Adresini Doğrula</a></p>
    </div>
  </div>

  <nav  id="baslik" class="navbar navbar-expand-lg sticky-top  navigasyonBari">
    <div class="container">
      <a href="index.php" class="navbar-brand navbarBasligi"><i class="fas fa-landmark mr-2"></i>MÜZE REHBERİ</a>
      <button  type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navmenuleri"><i class="fas fa-bars"></i></button>



      <div class="collapse navbar-collapse" id="navmenuleri">

        <ul class="navbar-nav">


          <li class="nav-item"><a class="nav-link navLinkleri" href="index.php"><i class="fas fa-home mr-2"></i>ANASAYFA</a></li>
          <li class="nav-item"><a class="nav-link navLinkleri" href="muzearama.php"><i class="fas fa-landmark mr-2"></i>MÜZELER</a></li>
          <li class="nav-item"><a class="nav-link navLinkleri" href="#muzekart"><i class="fas fa-credit-card mr-2"></i>MÜZEKART</a></li>
          <li class="nav-item"><a class="nav-link navLinkleri" href="#amacimiz"><i class="fas fa-info mr-2"></i>HAKKIMIZDA</a></li>


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

<!--NAVBAR BİTİŞ -->
<!--CAROUSEL BAŞLANGIÇ -->
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">

  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
  </ol>
  
  <!-- The slideshow -->
  <div class="carousel-inner">
    <div class="carousel-item active">
      <!-- src kısmına muzenin veritabanindan dosya adini cekicez  -->
      <img class="img-fluid"  style="height: auto;width: 100%" src="assets/images/ayasofya-muzesi.jpg" alt="Ayasofya Müzesi">
      <div class="carousel-caption">
       <h5>Ayasofya Müzesi</h5>
       <p>Fatih/İstanbul</p>
     </div>
   </div>
   <div class="carousel-item">
    <img class="img-fluid"  style="height: auto;width: 100%" src="assets/images/efes-antik-kenti.jpg" alt="Celsus Kütüphanesi">
    <div class="carousel-caption ">
     <h5 >Efes Antik Kenti</h5> 
     <p>Selçuk/İzmir</p>
   </div>
 </div>
 <div class="carousel-item">
  <img class="img-fluid" style="height: auto;width: 100%" src="assets/images/aspendos-orenyeri.jpg" alt="Aspendos Tiyatrosu">
  <div class="carousel-caption">
    <h5 >Aspendos Antik Kenti</h5>
    <p>Serik/Antalya</p>
  </div>
</div>
<div class="carousel-item">
  <img class="img-fluid" style="height: auto;width: 100%" src="assets/images/topkapı-sarayı.jpg" alt="Topkapı Sarayı">
  <div class="carousel-caption">
    <h5 >Topkapı Sarayı</h5>
    <p>Fatih/İstanbul</p>
  </div>
</div>
<div class="carousel-item">
  <img class="img-fluid" style="height: auto;width: 100%" src="assets/images/mevlana-muzesi.jpg" alt="Mevlana Müzesi">
  <div class="carousel-caption ">
    <h5 >Mevlana Müzesi</h5>
    <p>Karatay/Konya</p>
  </div>
</div>
</div>

<!-- Left and right controls -->
<a class="carousel-control-prev" href="#carouselExampleIndicators" data-slide="prev">
  <span class="carousel-control-prev-icon"></span>
</a>
<a class="carousel-control-next" href="#carouselExampleIndicators" data-slide="next">
  <span class="carousel-control-next-icon"></span>
</a>
</div>
<!-- Carousel Sonu -->


<!-- MüzeKart Tanıtım Kısmı -->
<div id="muzekart" class="jumbotron jumbotron-fluid">
  <div class="container">
    <img class="img-thumbnail rounded mx-auto d-block" src="https://www.muze.gov.tr/img/muzekartarti.jpg?v=2" width="50%">
    <h1 class="display-4 text-center mt-1"><span style="color:DarkTurquoise">Müze</span>Kart</h1>
    <p class="lead">Türkiye’nin "müze müze gezdiren" kartı Müzekart ile T.C. Kültür ve Turizm Bakanlığı’na bağlı 300’ü aşkın müze ve örenyerini ücretsiz gezebilir, tarihte keyifli bir yolculuğa çıkabilirsiniz.<br><br>
      Müzekart+, geçmişine değer veren kültür ve sanat meraklılarına avantajlarla dolu tarihi bir imkan sağlıyor. Uygarlıkların zevklerini, düşüncelerini, inançlarını, yaşam tarzlarını koruyan ve bu mirası geleceğe taşıyan müzeleri 1 yıl boyunca sınırsız ziyaret etme olanağını veriyor.<br><br>
      Müzekart+ ile sanat, bilim, kültür ve tarih evi sayılan müzelerin kapıları, yani tarihin kapıları sizler için sonuna kadar açılıyor.
      Gezilmedik müze, görülmedik eser kalmasın. Üstelik aldığınız tarihten itibaren 1(bir) yıl süre ile geçerli olan müzekartınız sadece 70 TL.<br><br>
      <p class="text-dark">Müzekart ile gezebileceğiniz T.C Kültür ve Turizm Bakanlığı'na bağlı tüm müze ve örenyerlerini görebilmek için <a target="_blank" href="http://dosim.kulturturizm.gov.tr/giris-ucretleri">tıklayınız.</a></p>
      <p class="text-dark">Müzekart ile alakalı daha detaylı bilgiye <a target="_blank" class="text-primary" href="https://www.muze.gov.tr/tr/kartlar-ve-biletler/muzekart-arti/muzekart-nedir_9.html">buradan</a> ulaşabilirsiniz.</p>
      <p class="text-dark">Müzekart'ı satın almak için <a href="https://www.muze.gov.tr/tr/purchase">buraya</a> tıklayın.</p>


    </div>
  </div>

  <!--Amacımız ve genel tanıtım kısmı -->
  <div class="container" id="amacimiz" style="padding: 10px;">
    <h1 class="h1 text-primary text-center col-md-12" >Amacımız</h1><br>
    <div class="row">
      <div class="col-sm-4 d-flex align-items-stretch">
        <div class="card border-success">
          <div class="card-body d-flex flex-column">
            <img  class="card-img mx-auto" src="https://www.shareicon.net/download/2016/10/29/848594_bank_512x512.png" >
            <h5 class="card-title text-center mt-3 text-justify">Medeniyetlerin Beşiği <span><br>Anadolu</span> </h5>
            <p class="card-text text-justify text-center">Türkiye, bütün insanlığın ortak mirası olarak kabul edilen ve evrensel değerlere sahip kültürel ve doğal varlıkların cennetinde yer almaktadır. Kadim tarihi, kültürel kodları, coğrafi araştırmaları ve uzantılarıyla tüm dünya için oldukça kıymetli bir ülke özelliğine sahiptir.</p>
            <a href="#" class="btn btn-success btn-block mt-auto">Slayt Gösterisi</a>
          </div>
        </div>
      </div>
      <div class="col-sm-4 d-flex align-items-stretch">
        <div class="card border-info">
          <div class="card-body d-flex flex-column" >
            <img class="card-img mx-auto" src="https://cdn4.iconfinder.com/data/icons/small-n-flat/24/user-group-512.png">
            <h5 class="card-title text-center mt-3 text-justify">Paylaşım</h5>
            <p class="card-text text-justify text-center ">Sitemiz Türkiye'deki müze ve ören yerleri hakkında kullanıcıları bilgilendirmek, üyelerimizin bu mekanlar hakkındaki görüş ve düşüncelerini diğer insanlarla paylaşmasını sağlamayı amaçlar.Ayrıca profil oluşturarak ziyaret ettiğiniz müzeleri profilinize kaydedebilir,böylece gelecekteki müze ziyaretlerinizi buna göre planlayabilirsiniz.</p>
            <a href="uyelik.php" class="btn btn-primary btn-block mt-auto">Kayıt Ol!</a>
          </div>
        </div>
      </div>
      <div class="col-sm-4 d-flex align-items-stretch">
        <div class="card border-dark">
          <div class="card-body d-flex flex-column" >
            <img class="card-img mx-auto" src="https://images.vexels.com/media/users/3/132068/isolated/preview/f9bb81e576c1a361c61a8c08945b2c48-search-icon-by-vexels.png">
            <h5 class="card-title text-center mt-3 text-justify">Detaylı Arama</h5>
            <p class="card-text">Detaylı arama sayesinde Türkiye'nin dört bir tarafında bulunan müze ve örenyerlerini kolaylıkla bulabilicek, bu yerler hakkında detaylı bilgi edinebileceksiniz.</p>
            <a href="muzearama.php" class="btn btn-dark mt-auto">Hemen Keşfe Başla!</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <br>
  <br>

  <br>
  <br>


  <!-- Giriş kısmı -->

  <!-- Button trigger modal -->

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