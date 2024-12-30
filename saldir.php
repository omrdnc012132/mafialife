<?php
session_start();
include 'ayar.php';
include 'functions.php';

$q = @$_GET["mafya"];

if ($q) {
    if ($q == $_SESSION["uye_kadi"]) {
        header("LOCATION:saldir.php");
        exit;
    }

    $data = $db->prepare("SELECT * FROM uyeler WHERE uye_kadi=?");
    $data->execute([$q]);
    $_data = $data->fetch(PDO::FETCH_ASSOC);
} else {
    $rastgele = $db->prepare("SELECT * FROM uyeler WHERE uye_kadi!=? ORDER BY RAND() DESC");
    $rastgele->execute([$_SESSION["uye_kadi"]]);
    $_rastgele = $rastgele->fetch(PDO::FETCH_ASSOC);

    header("LOCATION:saldir.php?mafya=" . $_rastgele["uye_kadi"]);
    exit;
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saldır - Mafya Hayatı - Online Mafya Oyunu</title>
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap-reboot.css">
    <link rel="stylesheet" href="css/bootstrap-grid.css">
    <link rel="stylesheet" href="css/style.css?v=<?= time() ?>">
</head>
<body>

<?php include 'header.php'; ?>

<div class="container">
    <div class="row lightgray">
        <div class="col-lg-12 mt-5 mb-5 text-center">
            <?php
            if ($_POST) {
                // İşlem geçmişini kontrol et
                $cek = $db->prepare("SELECT * FROM islemler WHERE i_uyeid = :i_uyeid AND i_islem = :i_islem");
                $cek->execute([
                    'i_uyeid' => $_SESSION["uye_id"],
                    'i_islem' => "uye-" . $q,
                ]);
                $islem = $cek->fetch(PDO::FETCH_ASSOC);

                // 24 saat kontrolü
                if ($islem) {
                    $saldiri_zamani = strtotime($islem["i_tarih"]);
                    $simdi = time();
                    $fark = $simdi - $saldiri_zamani;

                    if ($fark < 86400) { // 24 saat = 86400 saniye
                        echo "Bir mafyaya daha önce saldırı yaptın, 24 saat sonra gel.";
                        exit;
                    }
                }

                // İşlem geçmişe ekle
                $islemekle = $db->prepare("REPLACE INTO islemler SET i_islem = ?, i_uyeid = ?, i_tarih = NOW()");
                $islemekle->execute([
                    "uye-" . $q,
                    $_SESSION["uye_id"],
                ]);

                if (bizimsaldiridegeri() > rakipsaldiridegeri($q)) {
                    $rakippara = ($_data["uye_para"] * 10) / 100;
                    $bizimpara = $_uyedata["uye_para"] + $rakippara;

                    // Bizim güncelleme
                    $bizimguncelle = $db->prepare("UPDATE uyeler SET uye_para = ? WHERE uye_kadi = ?");
                    $bizimguncelle->execute([$bizimpara, $_SESSION["uye_kadi"]]);

                    $rakippara2 = $_data["uye_para"] - $rakippara;

                    // Rakip güncelleme
                    $rakipguncelle = $db->prepare("UPDATE uyeler SET uye_para = ? WHERE uye_kadi = ?");
                    $rakipguncelle->execute([$rakippara2, $q]);

                    if ($bizimguncelle && $rakipguncelle && $islemekle) {
                        echo 'Tebrikler ' . $rakippara . ' para kazandınız.<a href="saldir.php" class="btn btn-danger">Tekrar Birine Saldır</a>';
                        exit;
                    } else {
                        echo "Veritabanı hatası";
                    }
                } else {
                    $bizimpara = ($_uyedata["uye_para"] * 10) / 100;
                    $rakippara2 = $_uyedata["uye_para"] + $bizimpara;

                    // Rakip güncelleme
                    $rakipguncelle = $db->prepare("UPDATE uyeler SET uye_para = ? WHERE uye_kadi = ?");
                    $rakipguncelle->execute([$rakippara2, $q]);

                    $bizimpara2 = $_uyedata["uye_para"] - $bizimpara;

                    // Bizim güncelleme
                    $bizimguncelle = $db->prepare("UPDATE uyeler SET uye_para = ? WHERE uye_kadi = ?");
                    $bizimguncelle->execute([$bizimpara2, $_SESSION["uye_kadi"]]);

                    if ($bizimguncelle && $rakipguncelle) {
                        echo 'Hay aksi ' . $bizimpara . ' para kaybettin.<a href="saldir.php" class="btn btn-danger">Tekrar Birine Saldır</a>';
                        exit;
                    } else {
                        echo "Veritabanı hatası";
                    }
                }
            }

            // Ev durumu gösterimi
            if ($_data["uye_ev"] == "kulube") {
                echo '<img src="img/kulube.png" width="150"><br />Kulübe';
            } elseif ($_data["uye_ev"] == "kisisel-ev") {
                echo '<img src="img/kisisel-ev.png" width="150"><br />Kişisel Ev';
            } elseif ($_data["uye_ev"] == "villa") {
                echo '<img src="img/villa.png" width="150"><br />Villa';
            } elseif ($_data["uye_ev"] == "malikane") {
                echo '<img src="img/malikane.png" width="150"><br />Malikane';
            } else {
                echo '<img src="img/kiralik-ev.png" width="150"><br />Kiralık Ev';
            }
            ?>
            <br />
            <strong class="lightlightgray ml-1 mr-1">@<?= $_data["uye_kadi"] ?></strong>
            <br />
            <small>
                🤝 Saygınlık: <?= $_data["uye_sayginlik"] ?> &nbsp;&nbsp;
                💲 Para: <?= $_data["uye_para"] ?> &nbsp;&nbsp;
                💪 Koruma: <?= $_data["uye_koruma"] ?> &nbsp;&nbsp;
                🔫 Silah: <?= $_data["uye_silah"] ?>
            </small>
            <br />
            <form action="" method="post">
                <button type="submit" class="btn btn-danger w-50 mt-3 mb-3">Saldır</button>
                <input type="hidden" name="token" value="">
            </form>
            <br />
            <a href="saldir.php" class="btn btn-danger btn-danger2">Rastgele Mafya Bul</a>
            <br />
            NOT: Kazanırsan rakibinin parasının %10'unu alırsın. Kaybedersen rakibin senin paranın %10'unu alır!
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>

</body>
</html>
