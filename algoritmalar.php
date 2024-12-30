<?php

/*
üyelik sistemi,
verilerin yazdırılması,
oyun parası kazanma mekanizması
*/

// üye verilerini çekmek için ayar.php'ye session olduysa veri çek demek ve saati istanbul olarak belirlemek.

//////////////////////////////
// Para kazanma mekanizması
// veri güncelleme, mevcut parama +10 para ekle ve güncelle
// 
// İşlemler tablosundan i_islem ve i_uyeid'den son i_id'ye sahip olan veriyi çektir
// $Para'ya işlem parası ile topla

// i_tarih'e "10 dakika" ileri bir tarih ekle (https://github.com/ugurkilci/hafizilib/blob/master/1-ay-sonra-tarih-date.php)
// işlem tarih > günümüz tarih
if(date("Hi", strtotime(date('Hi', strtotime($_data["i_tarih"])) . "+10 minute")) > date("Hi")){
    // Az önce soygun yaptın ... dakika sonra tekrar gel.
    // İşlem tarih - günümüz tarih
}else{
    // uyeler tablosundan üyenin parasına $Para ile güncelle
}
//////////////////////////////

// Saldırma algoritması
// Rakibimizin sayfasını görebilmemiz için veritabanından onunla ilgili bilgileri yazdımalıyız

// functions.php dosyası açıp bizimsaldiridegeri() fonsiyonu içinde bunları yapmalıyız.
// global $db;
/*

++++ Saygınlık, 40
+++ Koruma, 30
++ Ev, 20
+ Silah, 10

Saygınlık + Koruma + Ev + Silah = Güç

Para != Güç [...]

$deger = 0; yaz
// Silahları array => içine al.
$silahdegeri = array(
    "el-bombasi" => 1,
    "cop" => 2,
    "beyzbol-sopasi" => 3,
    "molotof" => 4,
    "musta" => 5,
    "tabanca" => 6,
    "tufek" => 7
);
// Silahlar veritabanından "uyeid"ye ait silahları listele. İf else içinde array'den değeri çek ve *10 yap ve diğer silaha bu değeri topla.
if($_data["s_ad"] == "musta"){
    $deger += $silahdegeri[$_data["s_ad"]] * 10;
}

------------------------------------------------------

// Ev değeri için uyeler veritabanından "uye_ev" diye türü text olan veri açmak gerek.
// Ukas kayita gidip insert'e "uye_ev" içine "kiralik-ev" yaz
// Ev değeri için array aç
$evdegeri = array(
    "kiralik-ev" => 1,
    "kisisel-ev" => 2,
    "kulube" => 3,
    "villa" => 4,
    "malikane" => 5
);
// Uyeler tablosunda uye_ev de yazan evin tipine göre +=10 puan ekle.
$deger = $deger + ($evdegeri[$_uyedata["uye_ev"]] * 20);

------------------------------------------------------
// Koruma
// Uyeler tablosunda uye_koruma da yazan sayı * 10 += elimizdeki sayı
// Koruma çeşitleri olmadığından dizi işlemi yapmayacağım.

if($_uyedata["uye_koruma"] !== 0){ // 0 * 10 = 0
    $deger = $deger + ($_uyedata["uye_koruma"] * 30);
}

------------------------------------------------------
// Saygınlık
// Uyeler tablosunda uye_sayginlik da yazan sayı * 10 += elimizdeki sayı
// Korumada ne yaptıksak aynısını yapacağız

if($_uyedata["uye_koruma"] !== 0){ // 0 * 10 = 0
    $deger = $deger + ($_uyedata["uye_koruma"] * 40);
}

------------------------------------------------------
// Bu bizim saldırı değerimiz. Şimdi rakibinde saldırı değerini bulmalıyız.
// Bu yüzden bizimsaldiridegeri() fonksiyonunu kopyalayıp rakipsaldiridegeri($uye_id) fonsiyonu olarak değiştiriyoruz. 
// Session olanları $uye_id olarak değiştiriyoruz.
// Bizim ve rakibimimizin saldırı değerini bulduk şimdi onları kıyaslamamız gerek.

if(bizimsaldiridegeri() > rakipsaldiridegeri($_rakipdata["uye_id"])){
    // Kazandık
}else{
    // Kaybettin
}

// Şimdi kazanç ve kaybı kodlamamız lazım. Kazanırsak rakibin parasının %10'unu kendi paramıza eklememiz gerek. Eğer kaybedersek bizim paramızın %10'u rakibin parasına eklenmesi gerek. İşte bu kısım oyununuzu zevkli yapıyor.

// Bunun için yüzde hesaplamayı bilmeniz gerek. Formül: (sayı * 10) / 100 bunu koda şu şekilde yazacağız.
$bizimparadegeri = ($_rakipdata["uye_para"] * 10) / 100;
// İçine kendi paramızı da ilave edelim
$bizimparadegeri = ($_uyedata["uye_para"] + ($_rakipdata["uye_para"] * 10) / 100);
// bizim parasal değerimizi paramıza güncellemeliyiz. veri güncelleme. $paraguncelle

// aynı şekilde rakibin parasal değerini hesaplayıp rakipten bu parayı çıkartmamız gerek. Bu şekilde rakipte zarar edebilsin.

$rakipparadegeri = $_rakipdata["uye_para"] - (($_rakipdata["uye_para"] * 10) / 100);

// veri güncelleme, $rakipparaguncelle

if($rakipparaguncelle && $paraguncelle){ // iki güncelleme de çalıştıysa
    // Kazandın
    // bizim uyeler tablosundaki saygınlığımıza +1 eklemiz gerek.
}else{
    // Bir hata ile karşılaştık lütfen tekrar deneyiniz yada bizimle ileşime geçiniz.
}

--

Buraya kadar kazanmayı yaptık. Şimdi bunun bizim kaybetmemiz tarafından yapmamız gerek.

// az önce yazdığımız kodları kopyalayıp + ları - ve - leri + olarak değiştiriyoruz. ve if else'de kaybettin yazıyoruz.


// Bu şekilde saldırı ve savunma algoritmasını koda dökmüş oluyoruz. 
Bu videoda ne yaptık?
Kısaca hem kendimizin hem de rakibimizin saygınlık, koruma, ev ve silahlarını sayısal değere dönüştürerek ikimiz arasında kıyas yaptık. Kazanana karşı tarafın %10 parasını ekledik.

++++ Saygınlık, 40
+++ Koruma, 30
++ Ev, 20
+ Silah, 10

Yani üyeler oyunda güç sahibi olabilmesi için diğer oyunculara saldırıp kazanması gerek. Kazanmak için koruma ev ve silah gibi materyaller lazım. Bunların içinde en başında sokağımızdaki pizzacıyı sürekli soyması lazım. Pizzacıyı da her 2 dakikada bir soyacağını düşünürsek üyeler oyunda çok zaman harcayacaklar. 👌

*/