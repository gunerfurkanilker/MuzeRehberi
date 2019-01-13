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
    <title>Müze Bul - Hesap Ayarları Sayfası</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/svg" href="icons/landmark.svg"/>
    <link rel="stylesheet" href="css/w3.css" />
    <link rel="stylesheet" href="css/w3-colors-flat.css" />
    <link rel="stylesheet" href="css/w3-colors-metro.css" />
    <link rel="stylesheet" href="css/w3-colors-win8.css" />
    <link href="https://fonts.googleapis.com/css?family=Alegreya" rel="stylesheet">
</head>
<body>
<div class="w3-row w3-metro-light-blue">
    <div class="w3-row w3-metro-darken" style="height:50px;line-height:50px;">

        <h1 class="w3-col l8 m8 w3-hide-small w3-xlarge w3-center" style="margin:0px;font-family: 'Alegreya', serif;">Hesap Ayarları</h1>
        <span class="w3-col l4 m4 s12 w3-large w3-center w3-right" style="margin:0px;font-family: 'Alegreya', serif;">
        <span class="w3-round-xxlarge w3-white w3-center" style="padding:8px;">
            <img src="icons/ios-finger-print.svg" style="height:30px;"/>
        </span>
            <a href="index.php"><?php echo $_SESSION['uye_login'] ?></a>
        <a href="../index.php" class="w3-right w3-margin-right"><img class='w3-white' src="icons/md-exit.svg" style="height:30px;"></a>
    </span>

    </div>
    <div class="w3-row">

        <div class="w3-col l8 m10 s11" style="float:none;margin:auto;min-height:500px;">

            <div class="w3-row w3-margin-top w3-white" style="float:none;margin:auto;">

                <button id="sifreDegistirmeButon" onclick="hesapAyarlari('sifre');" class="w3-col l3 s12 m3 w3-border-0 w3-border-bottom w3-disabled w3-metro-darken">Şifre Ayarları</button>
                <button id="mailDegistirmeButon"  onclick="hesapAyarlari('mail');" class="w3-col l3 s12 m3 w3-border-0 w3-border-bottom">Mail Ayarları</button>
                <button id="profilAyarlariButon" onclick="hesapAyarlari('profil');" class="w3-col l3 s12 m3 w3-border-0 w3-border-bottom">Profil Ayarları</button>

                <button id="secenekAyarlariButon" onclick="hesapAyarlari('secenek');" class="w3-col l3 s12 m3 w3-border-0 w3-border-bottom">Seçenekler</button>

            </div>

            <div id="sifre" class="w3-row w3-margin-top w3-animate-zoom">

                <h1>Şifre Ayarları:</h1>
                <form method="POST" action="../formhandling/islem.php">
                    <div class="w3-row">
                    <span class="w3-col l3 s7 m4 w3-medium w3-leftbar w3-border-bottom w3-center w3-white" style="height:39px;line-height:39px;">Mevcut Şifreniz :</span>
                      <input class="w3-col l7 s11 m8 w3-input w3-center" placeholder="Mevcut şifrenizi girin." type="password" name="sifre_mevcut" />
                    </div>
                    <div class="w3-row w3-margin-top">
                        <span class="w3-col l3 s7 m4 w3-medium w3-leftbar w3-border-bottom w3-center w3-white" style="height:39px;line-height:39px;">Yeni Şifreniz :</span>
                        <input class="w3-col l7 s11 m8 w3-input w3-center" placeholder="Yeni şifrenizi girin." type="password" name="sifre_yeni" />
                    </div>
                    <div class="w3-col l10 s12 w3-margin-bottom">
                    <button class="w3-col l4 s6 m6 w3-button w3-margin-top w3-margin-right w3-white w3-leftbar w3-border-bottom w3-right" name="sifre_degis">Şifre Değiştir</button>
                    </div>
                </form>

            </div>
            <?php 

            if (isset($_GET['status'])) {
               if ($_GET['status'] == 'ok') {
                   echo "Başarı İle Güncellendi.";
               }
               else {
                   echo "Güncelleme Başarısız.";
               }
            }

            if (isset($_GET['stat'])) {
               if ($_GET['stat'] == 'ok') {
                   echo "Başarı İle Güncellendi.";
               }
               else {
                   echo "Güncelleme Başarısız.";
               }
            }

             ?>
            <div id="mail" class="w3-row w3-margin-top w3-hide">

                <h1>Mail Ayarları:</h1>
                <form method="POST" action="../formhandling/islem.php">
                    <div class="w3-row w3-margin-top">
                        <span class="w3-col l3 s7 m4 w3-medium w3-leftbar w3-border-bottom w3-center w3-white" style="height:39px;line-height:39px;">Yeni Mail Adresi :</span>
                        <input class="w3-col l7 s11 m8 w3-input w3-center" type="mail" placeholder="Yeni mail adresini girin." type="text" name="mail_yeni" />
                    </div>
                    <div class="w3-row w3-margin-top">
                        <span class="w3-col l3 s7 m4 w3-medium w3-leftbar w3-border-bottom w3-center w3-white" style="height:39px;line-height:39px;">Şifreniz :</span>
                        <input class="w3-col l7 s11 m8 w3-input w3-center" placeholder="Şifrenizi girin." type="password" name="sifre_mevcut" />
                    </div>
                    <div class="w3-col l10 w3-margin-bottom">
                        <button class="w3-col l4 s6  m6 w3-button w3-margin-top w3-margin-right w3-white w3-leftbar w3-border-bottom w3-right" name="mail_degis">Mail Değiştir</button>
                        
                    </div>
                   
                </form>

            </div>
            <div id="profil" class="w3-row w3-margin-top w3-hide">

                <h1>Profil Ayarları:</h1>
                <form method="post" action="">
                    <div class="w3-row">
                        <div class="w3-row w3-margin-bottom">
                            <span class="w3-col l3 s9 m7 w3-margin-bottom w3-medium w3-leftbar w3-border-bottom w3-center w3-white" style="height:39px;line-height:39px;">Profil Resminiz :</span>
                            <div class="w3-col l4 s10 m8 w3-white w3-center w3-margin-left w3-border">
                                <img src="icons/ios-finger-print.svg" style="height:150px;width:auto;" />
                            </div>

                        </div>
                        <span class="w3-col l3 s7 m4 w3-medium w3-leftbar w3-border-bottom w3-center w3-white" style="height:39px;line-height:39px;">Resim Değiştir :</span>
                        <div class="w3-col l7 s11 m8 w3-input w3-center w3-white">
                        <input class="w3-col l12 m12 s12" type="file" name="profilResim" />
                        </div>
                    </div>

                    <div class="w3-row w3-margin-top">
                        <span class="w3-col l3 s7 m4 w3-medium w3-leftbar w3-border-bottom w3-center w3-white" style="height:39px;line-height:39px;">İsim :</span>
                        <input class="w3-col l7 s11 m8 w3-input w3-center" placeholder="İsim" type="text" name="profilIsim" />
                    </div>
                    <div class="w3-row w3-margin-top">
                        <span class="w3-col l3 s7 m4 w3-medium w3-leftbar w3-border-bottom w3-center w3-white" style="height:39px;line-height:39px;">Soyisim :</span>
                        <input class="w3-col l7 s11 m8 w3-input w3-center" placeholder="Soyisim" type="text" name="profilSoyisim" />
                    </div>
                    <div class="w3-row w3-margin-top">
                        <span class="w3-col l3 s7 m4 w3-medium w3-leftbar w3-border-bottom w3-center w3-white" style="height:39px;line-height:39px;">Kullanıcı Adı :</span>
                        <input class="w3-col l7 s11 m8 w3-input w3-center" placeholder="@KullaniciAdi" type="password" name="profilKullanici" />
                    </div>
                    <div class="w3-row w3-margin-top">
                        <span class="w3-col l3 s7 m4 w3-medium w3-leftbar w3-border-bottom w3-center w3-white" style="height:39px;line-height:39px;">İletişim :</span>
                        <span class="w3-col l7 s11 m8 w3-medium w3-border-bottom w3-center w3-white" style="height:39px;line-height:39px;">053421321321</span>
                    </div>
                    <div class="w3-row w3-margin-top">
                        <span class="w3-col l3 s7 m4 w3-medium w3-leftbar w3-border-bottom w3-center w3-white" style="height:39px;line-height:39px;">Şifreniz :</span>
                        <input class="w3-col l7 s11 m8 w3-input w3-center" placeholder="Şifrenizi girin." type="password" name="profilSifre" />
                    </div>

                    <div class="w3-col l10 s12 w3-margin-bottom">
                        <button class="w3-col l4 s5 m5 w3-button w3-margin-top w3-margin-right w3-white w3-leftbar w3-border-bottom w3-right">Kaydet</button>
                        <button type="reset" class="w3-col l3 s4 m4 w3-button w3-margin-right w3-margin-top w3-margin-left w3-white w3-leftbar w3-border-bottom w3-right">İptal <span class="w3-hide-small">Et</span></button>
                    </div>
                    <div style="clear:both;"></div>
                </form>

            </div>
            <div id="secenek" class="w3-row w3-margin-top w3-hide">

                <h1>Seçenek Ayarları:</h1>
                <form method="post" action="">
                    <div class="w3-row">
                        <span class="w3-col l10 s12 w3-medium w3-leftbar w3-border-bottom w3-center w3-white" style="height:auto;line-height:39px;">
                            <span class="w3-col l5 s7 m5">Reklam Amaçlı Mail:</span>
                            <span class="w3-col l7 s12 m7">
                                <input class="w3-check" type="checkbox" checked="checked" name="secenekMailIzin" value="evet"> <label>İzin Veriyorum </label>
                                <br class="w3-hide-large w3-hide-medium" />
                                <input class="w3-check w3-margin-left" type="checkbox" name="secenekMailIzın" value="hayir"> <label>İzin Vermiyorum </label>
                            </span>
                        </span>

                    </div>

                    <div class="w3-row w3-margin-top">
                        <span class="w3-col l10 w3-medium w3-leftbar w3-border-bottom w3-center w3-white" style="line-height:39px;">
                            <span class="w3-col l5 s7 m5">Gerçek İsminiz :</span>
                            <span class="w3-col l7 s12 m7">
                            <input class="w3-check" type="checkbox" checked="checked" name="secenekIsimIzin" value="evet"> <label>Görünsün </label>
                            <br class="w3-hide-large w3-hide-medium" />
                            <input class="w3-check w3-margin-left" type="checkbox" name="secenekIsimIzin" value="hayir"> <label>Görünmesin</label>
                            </span>
                        </span>
                    </div>

                    <div class="w3-row w3-margin-top">
                        <span class="w3-col l10 w3-medium w3-leftbar w3-border-bottom w3-center w3-white" style="line-height:39px;">
                            <span class="w3-col l5 s7 m5">Tema Tercihi :</span>
                            <span class="w3-col l7 s12 m7">
                            <input class="w3-check" type="checkbox" name="secenekTemaKoyu" value="koyu" disabled> <label>Koyu </label>
                            <br class="w3-hide-large w3-hide-medium" />
                            <input class="w3-check w3-margin-left" checked="checked" type="checkbox" name="secenekTemaAcik" value="acik"> <label>Açık</label>
                            </span>
                        </span>
                    </div>

                    <div class="w3-row w3-margin-top">
                        <span class="w3-col l10 w3-medium w3-leftbar w3-border-bottom w3-center w3-white" style="line-height:39px;">
                            <span class="w3-col l5 s7 m5">İletişim Bilgisi:</span>
                            <span class="w3-col l7 s12 m7">
                            <input class="w3-check" type="checkbox" name="secenekIletisim" value="gizle" disabled> <label>Gizle</label>
                            <br class="w3-hide-large w3-hide-medium" />
                            <input class="w3-check w3-margin-left" checked="checked" type="checkbox" name="secenekIletisim" value="gizleme" > <label>Gizleme</label>
                            </span>
                        </span>
                    </div>


                    <div class="w3-row w3-margin-top">
                        <span class="w3-col l3 s7 m4 w3-medium w3-leftbar w3-border-bottom w3-center w3-white" style="height:39px;line-height:39px;"> Şifreniz :</span>
                        <input class="w3-col l7 s11 m8 w3-input w3-center" placeholder="Şifrenizi Girin." type="password" name="secenekSifre" />
                    </div>
                    <div class="w3-col l10 s12 w3-margin-bottom">
                        <button class="w3-col l3 s6 w3-button w3-margin-top w3-margin-right w3-white w3-leftbar w3-border-bottom w3-right">Kaydet</button>
                        <button type="reset" class="w3-col l3 s4 w3-button w3-margin-right w3-margin-top w3-margin-left w3-white w3-leftbar w3-border-bottom w3-right">İptal <span class="w3-hide-small">Et</span></button>
                    </div>
                    <div style="clear:both;"></div>
                </form>

            </div>


        </div>
        <div class="w3-row w3-metro-darken w3-margin-top w3-medium w3-center" style="min-height:200px;line-height:40px;">
            MüzeBul © 2018 Tüm Hakları Saklıdır
        </div>

    </div>
</div>






<script src="javascript/javascriptKullanici.js"></script>
</body>
</html>