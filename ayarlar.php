<?php
session_start();
include 'ayar.php';

// Oturum kontrolü
if (!isset($_SESSION["uye_id"]) || empty($_SESSION["uye_id"])) {
    header("LOCATION:index.php"); // Kullanıcı giriş yapmadıysa yönlendir
    exit; // Kodun geri kalanını çalıştırma
}

// Kullanıcı bilgilerini al
$uye_id = $_SESSION["uye_id"]; 

// Üye verilerini kontrol et
$uye_sorgu = $db->prepare("SELECT * FROM uyeler WHERE uye_id = ?");
$uye_sorgu->execute([$uye_id]);
$_uyedata = $uye_sorgu->fetch(PDO::FETCH_ASSOC);

// Kullanıcı geçerli değilse çıkışa zorla
if (!$uye_sorgu->rowCount()) {
    session_destroy(); // Oturumu sonlandır
    header("LOCATION:index.php");
    exit;
}

$q = @$_GET["q"];
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ayarlar - Mafya Hayatı - Online Mafya Oyunu</title>
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap-reboot.css">
    <link rel="stylesheet" href="css/bootstrap-grid.css">
    <link rel="stylesheet" href="css/style.css?v=<?=time()?>">
</head>
<body>

<?php
include 'header.php';
?>

<div class="container">
    <div class="row lightgray">
        <div class="col-lg-12 mt-5 mb-5">
            <h1 class="text-white">Ayarlar</h1>
            <a href="ayarlar.php?q=genel" class="btn btn-danger btn-danger2">Genel Ayarlar</a>
            <a href="ayarlar.php?q=sifre" class="btn btn-danger btn-danger2">Şifre Güncelle</a>
            <a href="cikisyap.php" class="btn btn-danger btn-danger2">Çıkış Yap</a>
            <br /> <br />

            <?php
            switch ($q) {
                case 'sifre':
                    // Şifre güncelle
                    if ($_POST) {
                        if (hash_equals($csrf, $_POST['token'])) {


                        $msifre = htmlspecialchars($_POST["msifre"]);
                        $ysifre = htmlspecialchars($_POST["ysifre"]);
                        $tsifre = htmlspecialchars($_POST["tsifre"]);

                        if (empty($msifre) || empty($ysifre) || empty($tsifre)) {
                            echo 'Lütfen boş bırakmayınız!';
                        } else {
                            $msifre = md5(sha1($msifre));
                            $ysifre = md5(sha1($ysifre));
                            $tsifre = md5(sha1($tsifre));

                            if ($msifre == $_uyedata["uye_sifre"]) {
                                if ($ysifre == $tsifre) {
                                    $veriguncelle = $db->prepare("UPDATE uyeler SET uye_sifre=? WHERE uye_id=?");
                                    $veriguncelle->execute([$tsifre, $_SESSION["uye_id"]]);

                                    if ($veriguncelle) {
                                        echo 'Başarıyla güncellendi.';
                                        header("REFRESH:1;URL=ayarlar.php?q=sifre");
                                    } else {
                                        echo 'Güncelleme başarısız.';
                                        header("REFRESH:1;URL=ayarlar.php?q=sifre");
                                    }
                                } else {
                                    echo 'Şifreler birbirine uyumlu değil!';
                                }
                            } else {
                                echo 'Mevcut şifreniz yanlış!';
                            }
                        }
                        }else {
                            echo 'Token hatalı';
                        }
                    }

                    echo '<form action="" method="post">
                        <strong class="text-white">Mevcut Şifre</strong>
                        <input type="password" name="msifre" class="form-control">
                        <strong class="text-white">Yeni Şifre</strong>
                        <input type="password" name="ysifre" class="form-control">
                        <strong class="text-white">Şifreyi Doğrula</strong>
                        <input type="password" name="tsifre" class="form-control">

                        <button type="submit" class="btn btn-danger mt-5">Bilgileri Güncelle</button>
                    </form>';
                    break;

                default:
                    // Kullanıcı adı ve eposta güncelle
                    if ($_POST) {
                        if (hash_equals($csrf, $_POST['token'])) {


                        $kadi = htmlspecialchars($_POST["kadi"]);
                        $eposta = htmlspecialchars($_POST["eposta"]);

                        if (empty($kadi) || empty($eposta)) {
                            echo 'Lütfen kullanıcı adı veya epostayı boş bırakmayınız!';
                        } else {
                            // Kullanıcı adı kontrolü
                            $cek = $db->prepare("SELECT * FROM uyeler WHERE uye_kadi = :uye_kadi AND uye_id != :uye_id");
                            $cek->execute(['uye_kadi' => $kadi, 'uye_id' => $_SESSION["uye_id"]]);
                            if ($cek->rowCount() > 0) {
                                echo '"' . $kadi . '" isimli kullanıcı mevcut lütfen başka bir tane deneyiniz.';
                            } else {
                                // Eposta kontrolü
                                $cek = $db->prepare("SELECT * FROM uyeler WHERE uye_eposta = :uye_eposta AND uye_id != :uye_id");
                                $cek->execute(['uye_eposta' => $eposta, 'uye_id' => $_SESSION["uye_id"]]);
                                if ($cek->rowCount() > 0) {
                                    echo '"' . $eposta . '" isimli eposta mevcut lütfen başka bir tane deneyiniz.';
                                } else {
                                    // Güncelleme işlemi
                                    $veriguncelle = $db->prepare("UPDATE uyeler SET uye_kadi=?, uye_eposta=? WHERE uye_id=?");
                                    $veriguncelle->execute([$kadi, $eposta, $_SESSION["uye_id"]]);

                                    if ($veriguncelle) {
                                        echo 'Başarıyla güncellendi.';
                                        header("REFRESH:1;URL=ayarlar.php");
                                    } else {
                                        echo 'Başarısız güncelleme.';
                                    }
                                }
                            }
                        }
                        }else {
                            echo 'Token hatalı';
                        }
                    }

                    echo '<form action="" method="post">
                        <strong class="text-white">Kullanıcı Adı</strong>
                        <input type="text" name="kadi" class="form-control" value="' . $_uyedata["uye_kadi"] . '">
                        <br />
                        <strong class="text-white">Eposta</strong>
                        <input type="text" name="eposta" class="form-control" value="' . $_uyedata["uye_eposta"] . '">
                        <input type="hidden" name="token" value="'.$csrf.'">
                        <button type="submit" class="btn btn-danger mt-5">Bilgileri Güncelle</button>
                    </form>';
                    break;
            }
            ?>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>

</body>
</html>
