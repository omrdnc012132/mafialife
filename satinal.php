<?php
session_start();
include 'ayar.php';
$q = @$_GET["q"];
$p = @$_GET["p"];

switch ($q) {
    case 'musta': $fiyat = 190; break;
    case 'molotof': $fiyat = 150; break;
    case 'beyzbol-sopai': $fiyat = 200; break;
    case 'cop': $fiyat = 200; break;
    case 'el-bombasi': $fiyat = 90; break;
    case 'tabanca': $fiyat = 500; break;
    case 'tufek': $fiyat = 800; break;

    case 'koruma': $fiyat = 10000; break;

    case 'kisisel-ev': $fiyat = 10000; break;
    case 'kulube': $fiyat = 14000; break;
    case 'villa': $fiyat = 50000; break;
    case 'malikane': $fiyat = 100000; break;

    default:
        header("LOCATION:oyun.php");
        exit;
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Oyun - Mafya Hayatı - Online Mafya Oyunu</title>
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap-reboot.css">
    <link rel="stylesheet" href="css/bootstrap-grid.css">
    <link rel="stylesheet" href="css/style.css?v=<?=time()?>">
</head>
<body>

<?php include 'header.php'; ?>

<div class="container">
    <div class="row lightgray">
        <div class="col-lg-12 mt-5 mb-5 text-center">
            <?php
            if($p == "ev"){
                if ($_uyedata["uye_para"] >= $fiyat) {
                    $ev = $q;

                    $para = $_uyedata["uye_para"] - $fiyat;

                    $veriguncelle = $db->prepare("UPDATE uyeler SET uye_ev=?, uye_para=? WHERE uye_id=?");
                    $veriguncelle->execute([
                        $ev,
                        $para,
                        $_SESSION["uye_id"]
                    ]);

                    if ($veriguncelle) {
                        echo 'Tebrikler, başarıyla satın aldınız.';
                    } else {
                        echo 'Satın alma başarısız.';
                    }
                }else {
                    echo 'Yeterli paranız yok.';
                }
            }elseif ($q == "koruma") {
                // Koruma satın alma işlemi
                if ($_uyedata["uye_para"] >= $fiyat) {
                    $koruma = $_uyedata["uye_koruma"] + 1;
                    $para = $_uyedata["uye_para"] - $fiyat;

                    $veriguncelle = $db->prepare("UPDATE uyeler SET uye_koruma=?, uye_para=? WHERE uye_id=?");
                    $veriguncelle->execute([
                        $koruma,
                        $para,
                        $_SESSION["uye_id"]
                    ]);

                    if ($veriguncelle) {
                        echo 'Tebrikler, başarıyla satın aldınız.';
                        header("REFRESH:1;URL=market.php");
                    } else {
                        echo 'Satın alma başarısız.';
                        header("REFRESH:1;URL=market.php");
                    }
                } else {
                    echo 'Yeterli paranız yok.';
                }
            } else {
                // Silah satın alma işlemi
                if ($_uyedata["uye_para"] >= $fiyat) {
                    $veriekle = $db->prepare("INSERT INTO silahlar SET s_uyeid=?, s_silah=?");
                    $veriekle->execute([
                        $_SESSION["uye_id"],
                        $q
                    ]);

                    $silah = $_uyedata["uye_silah"] + 1;
                    $para = $_uyedata["uye_para"] - $fiyat;

                    $veriguncelle = $db->prepare("UPDATE uyeler SET uye_silah=?, uye_para=? WHERE uye_id=?");
                    $veriguncelle->execute([
                        $silah,
                        $para,
                        $_SESSION["uye_id"]
                    ]);

                    if ($veriekle && $veriguncelle) {
                        echo 'Tebrikler, başarıyla satın aldınız.';
                    } else {
                        echo 'Satın alma başarısız.';
                    }
                } else {
                    echo 'Yeterli paranız yok.';
                }
            }
            ?>
            <form action="" method="post">
                <h3>Satın almak istiyor musunuz?</h3>
                <button type="submit" class="btn btn-danger">Evet</button>
                <a href="market.php" class="btn btn-danger btn-danger2">Hayır</a>
                <input type="hidden" name="token" value="">
            </form>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>

</body>
</html>
