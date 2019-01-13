function hesapAyarlari(islem){
    switch(islem) {
        case 'mail':
            document.getElementById('sifre').classList.add('w3-hide');
            document.getElementById('secenek').classList.add('w3-hide');
            document.getElementById('profil').classList.add('w3-hide');
            document.getElementById('mail').classList.remove('w3-hide');
            document.getElementById('mail').classList.add('w3-animate-zoom');
            document.getElementById('secenek').classList.remove('w3-animate-zoom');
            document.getElementById('sifre').classList.remove('w3-animate-zoom');
            document.getElementById('profil').classList.remove('w3-animate-zoom');
            document.getElementById('mailDegistirmeButon').classList.add('w3-disabled','w3-metro-darken','w3-animate-zoom');
            document.getElementById('sifreDegistirmeButon').classList.remove('w3-disabled','w3-metro-darken','w3-animate-zoom');
            document.getElementById('secenekAyarlariButon').classList.remove('w3-disabled','w3-metro-darken','w3-animate-zoom');
            document.getElementById('profilAyarlariButon').classList.remove('w3-disabled','w3-metro-darken','w3-animate-zoom');
            break;
        case 'secenek':
            document.getElementById('sifre').classList.add('w3-hide');
            document.getElementById('mail').classList.add('w3-hide');
            document.getElementById('profil').classList.add('w3-hide');
            document.getElementById('secenek').classList.remove('w3-hide');
            document.getElementById('secenek').classList.add('w3-animate-zoom');
            document.getElementById('mail').classList.remove('w3-animate-zoom');
            document.getElementById('sifre').classList.remove('w3-animate-zoom');
            document.getElementById('profil').classList.remove('w3-animate-zoom');
            document.getElementById('mailDegistirmeButon').classList.remove('w3-disabled','w3-metro-darken','w3-animate-zoom');
            document.getElementById('sifreDegistirmeButon').classList.remove('w3-disabled','w3-metro-darken','w3-animate-zoom');
            document.getElementById('secenekAyarlariButon').classList.add('w3-disabled','w3-metro-darken','w3-animate-zoom');
            document.getElementById('profilAyarlariButon').classList.remove('w3-disabled','w3-metro-darken','w3-animate-zoom');
            break;
        case 'profil':
            document.getElementById('sifre').classList.add('w3-hide');
            document.getElementById('secenek').classList.add('w3-hide');
            document.getElementById('mail').classList.add('w3-hide');
            document.getElementById('profil').classList.remove('w3-hide');
            document.getElementById('profil').classList.add('w3-animate-zoom');
            document.getElementById('secenek').classList.remove('w3-animate-zoom');
            document.getElementById('sifre').classList.remove('w3-animate-zoom');
            document.getElementById('mail').classList.remove('w3-animate-zoom');
            document.getElementById('mailDegistirmeButon').classList.remove('w3-disabled','w3-metro-darken','w3-animate-zoom');
            document.getElementById('sifreDegistirmeButon').classList.remove('w3-disabled','w3-metro-darken','w3-animate-zoom');
            document.getElementById('secenekAyarlariButon').classList.remove('w3-disabled','w3-metro-darken','w3-animate-zoom');
            document.getElementById('profilAyarlariButon').classList.add('w3-disabled','w3-metro-darken','w3-animate-zoom');
            break;
        case 'sifre':
            document.getElementById('mail').classList.add('w3-hide');
            document.getElementById('secenek').classList.add('w3-hide');
            document.getElementById('profil').classList.add('w3-hide');
            document.getElementById('sifre').classList.remove('w3-hide');
            document.getElementById('sifre').classList.add('w3-animate-zoom');
            document.getElementById('secenek').classList.remove('w3-animate-zoom');
            document.getElementById('mail').classList.remove('w3-animate-zoom');
            document.getElementById('profil').classList.remove('w3-animate-zoom');
            document.getElementById('mailDegistirmeButon').classList.remove('w3-disabled','w3-metro-darken','w3-animate-zoom');
            document.getElementById('sifreDegistirmeButon').classList.add('w3-disabled','w3-metro-darken','w3-animate-zoom');
            document.getElementById('secenekAyarlariButon').classList.remove('w3-disabled','w3-metro-darken','w3-animate-zoom');
            document.getElementById('profilAyarlariButon').classList.remove('w3-disabled','w3-metro-darken','w3-animate-zoom');
            break;
    }
}
function yorumDuzenle(yorumId,yorumAlani,formAlani,textareaId,kaydetButon,iptalButon) {
    var yorum=document.getElementById(yorumId).innerHTML;
    document.getElementById(yorumAlani).classList.add('w3-hide');
    document.getElementById(formAlani).classList.remove('w3-hide');
    document.getElementById(kaydetButon).classList.remove('w3-hide');
    document.getElementById(iptalButon).classList.remove('w3-hide');
    document.getElementById(textareaId).innerHTML=yorum;
}
function yorumDuzenleIptal(yorumId,yorumAlani,formAlani,textareaId,kaydetButon,iptalButon){
    document.getElementById(yorumAlani).classList.remove('w3-hide');
    document.getElementById(formAlani).classList.add('w3-hide');
    document.getElementById(kaydetButon).classList.add('w3-hide');
    document.getElementById(iptalButon).classList.add('w3-hide');
}
function sehirleriGor(){
    document.getElementById('sehirlerDevam').classList.remove('w3-hide');
    document.getElementById('sehirlerDevamIptal').classList.remove('w3-hide');
    document.getElementById('sehirDevamButon').classList.add('w3-hide');
}
function sehirleriGizle(){
    document.getElementById('sehirlerDevam').classList.add('w3-hide');
    document.getElementById('sehirlerDevamIptal').classList.add('w3-hide');
    document.getElementById('sehirDevamButon').classList.remove('w3-hide');
}