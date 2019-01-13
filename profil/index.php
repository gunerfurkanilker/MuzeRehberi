<?php 
ob_start();
session_start();

if (!isset($_SESSION['uye_login'])) {
    header("Location:../index.php");
}

 ?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Müze Bul - Kullanıcı Sayfası</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/svg" href="icons/landmark.svg"/>
    <link rel="stylesheet" href="css/w3.css" />
    <link rel="stylesheet" href="css/w3-colors-flat.css" />
    <link rel="stylesheet" href="css/w3-colors-metro.css" />
    <link rel="stylesheet" href="css/w3-colors-win8.css" />
    <link href="https://fonts.googleapis.com/css?family=Alegreya" rel="stylesheet">
</head>
<body>
    <div class="w3-row w3-metro-light-blue" style="min-height:1000px;">
        <div class="w3-row w3-metro-darken" style="height:50px;line-height:50px;">

            <h1 class="w3-col l8 m8 w3-hide-small w3-xlarge w3-center" style="margin:0px;font-family: 'Alegreya', serif;"> Kullanıcı Sayfası</h1>
            <span class="w3-col l4 m4 s12 w3-large w3-center w3-right" style="margin:0px;font-family: 'Alegreya', serif;">
                <span class="w3-round-xxlarge w3-white w3-center" style="padding:8px;">
                    <a href="index.php">
                        <img src="icons/ios-finger-print.svg" style="height:30px;"/></span>
                    <?php echo $_SESSION['uye_login']; ?></a>
                    <a href="../index.php" class="w3-right w3-margin-right"><img class='w3-white' src="icons/md-exit.svg" style="height:30px;"></a>
                </span>


            </div>
            <div class="w3-row">

                <div class="w3-col l8 m10 s11" style="float:none;margin:auto;min-height:500px;">

                    <div class="w3-row w3-margin-top">
                        <div class="w3-col l7 m9 s12" style="float:none;margin:auto;">
                            <form action="" method="post">
                                <input id='aa' class="w3-col l10 m9 s9 w3-input w3-center" type="text" placeholder="#Şehir #Müze #AnahtarKelime Aratabilirsiniz." name="kullaniciArama" />
                                <button class="w3-col l2 m3 s3 w3-button w3-white w3-border-bottom w3-border-right" style="height:40px;"><img src="icons/md-search.svg" style="height:100%"/></button>
                            </form>
                        </div>
                    </div>

                    <div class="w3-row w3-margin-top w3-border-bottom">
                        <div class="w3-col l4 m4 s6 w3-padding w3-hover-white" style="height:100%;">
                            <div class="w3-col l12 m12 s12 w3-center">
                                <img src="icons/ios-home.svg" style="height:50px;" />
                                <a href="../index.php"><span class="w3-col l12 m12 s12 w3-large">Ana Sayfa</span></a>
                                <span class="w3-col l12 m12 s12 w3-medium">Bu link ile , ana sayfamıza gidip sitemizi ve bir çok müzeyi keşfedebilirsin.</span>
                            </div>
                        </div>
                        <div class="w3-col l4 m4 s6 w3-padding w3-hover-white" style="height:100%;">
                            <div class="w3-col l12 m12 s12 w3-center">
                                <img src="icons/landmark.svg" style="height:50px;" />
                                <a href="../muzearama.php"><span class="w3-col l12 m12 s12 w3-large">Müzeleri Keşfet</span></a>
                                <span class="w3-col l12 m12 s12 w3-medium">Bu sayfadan müzeleri görüntüleyebilir , şehirlere göre müzeleri listeleyebilirsin.</span>
                            </div>
                        </div>
                        <div class="w3-col l4 m4 s6 w3-padding w3-hover-white" style="height:100%;">
                        <div class="w3-col l12 m12 s12 w3-center">
                            <img src="icons/landmark.svg" style="height:50px;" />
                            <a href="ziyaretler.php"><span class="w3-col l12 m12 s12 w3-large">Ziyaretler</span></a>
                            <span class="w3-col l12 m12 s12 w3-medium">Ziyaret Ettiğiniz Yerleri Görüntüleyin/Düzenleyin.</span>
                        </div>
                    </div>
                    </div>



                    <div class="w3-row w3-margin-top w3-margin-bottom w3-border-bottom">

                     

                    <div class="w3-col l4 m4 s6 w3-padding w3-hover-white" style="height:100%;">
                        <div class="w3-col l12 m12 s12 w3-center">
                            <img src="icons/md-settings.svg" style="height:50px;" />
                            <a href="ayar.php"><span class="w3-col l12 m12 s12 w3-large">Hesap Ayarları</span></a>
                            <span class="w3-col l12 m12 s12 w3-medium">Bu sayfadan şifre ve mail adresini değiştirebilir. Hesabın ile ilgili ayarlara ulaşabilirsin.</span>
                        </div>
                    </div>
                </div>

            </div>

        </div>

        <div class="w3-row w3-metro-darken w3-medium w3-center" style="min-height:200px;line-height:40px;margin-top:150px;">
            MüzeBul © 2018 Tüm Hakları Saklıdır
        </div>
    </div>

    <script src="javascript/javascriptKullanici.js"></script>
</body>
</html>