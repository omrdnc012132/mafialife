<?php
session_start();
include 'ayar.php';
    $q = @$_GET["q"];
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

<?php
include 'header.php';
?>

<div class="container">
    <div class="row lightgray">
        <div class="col-lg-12 mt-5 mb-5 text-center">
            <?php
            switch ($q) {
                case 'kuyumcu':
                    if ($_POST) {
                        $cek = $db->prepare("SELECT * FROM islemler WHERE 
                        i_uyeid =:i_uyeid &&
                        i_islem =:i_islem
                        ");
                        $cek->execute([
                            'i_uyeid'=>$_SESSION["uye_id"],
                            'i_islem'=>"kuyumcu"
                        ]);
                        $saydirma = $cek->rowCount();

                        if ($saydirma >0){ // Var
                        $data = $db -> prepare("SELECT * FROM islemler WHERE i_uyeid=? && i_islem=? ORDER BY i_id DESC");
                        $data -> execute([
                            $_SESSION["uye_id"],
                            "kuyumcu"
                        ]);
                        $_data = $data -> fetch(PDO::FETCH_ASSOC);

                        if(date("YmdHis", strtotime($_data["i_tarih"] . "+3 minute")) > date("YmdHis")){
                            echo 'Az önce haraç aldın, 3 dakika sonra tekrar gel.';
                        }else {
                        $para = $_uyedata["uye_para"] + 30;

                        $veriguncelle = $db->prepare("UPDATE uyeler SET uye_para=? WHERE uye_id=?");
                        $veriguncelle ->execute([
                            $para,
                            $_SESSION["uye_id"]
                        ]);

                        $veriekle = $db->prepare("INSERT INTO islemler SET i_uyeid=?, i_islem=?");
                        $veriekle ->execute([
                            $_SESSION["uye_id"],
                            "kuyumcu"
                        ]);

                        if ($veriguncelle && $veriekle) {
                            echo 'Tebrik ederim, 30 para kazandınız.';
                        } else {
                            echo 'Eyvah, bir hata ile karşılaştık';
                        }
                        }
                        }else{ // Yok
                        $para = $_uyedata["uye_para"] + 30;

                        $veriguncelle = $db->prepare("UPDATE uyeler SET uye_para=? WHERE uye_id=?");
                        $veriguncelle ->execute([
                            $para,
                            $_SESSION["uye_id"]
                        ]);

                        $veriekle = $db->prepare("INSERT INTO islemler SET i_uyeid=?, i_islem=?");
                        $veriekle ->execute([
                            $_SESSION["uye_id"],
                            "kuyumcu"
                        ]);

                        if ($veriguncelle && $veriekle) {
                            echo 'Tebrik ederim, 30 para kazandınız.';
                        } else {
                            echo 'Eyvah, bir hata ile karşılaştık';
                        }
                        }

                    }
                    echo '
                    <form action="" method="post">
                        <h3>Kuyumcudan haraç almak istiyor musun?</h3>
                        <button type="submit" class="btn btn-danger">Evet</button>
                        <a href="oyun.php" class="btn btn-danger btn-danger2">Hayır</a>
                        <input type="hidden" name="token" value="">
                    </form>';
                    break;
                
                case 'pizzaci':
                    if ($_POST) {
                        $cek = $db->prepare("SELECT * FROM islemler WHERE 
                        i_uyeid =:i_uyeid &&
                        i_islem =:i_islem
                        ");
                        $cek->execute([
                            'i_uyeid'=>$_SESSION["uye_id"],
                            'i_islem'=>"pizzaci"
                        ]);
                        $saydirma = $cek->rowCount();

                        if ($saydirma >0){ // Var
                        $data = $db -> prepare("SELECT * FROM islemler WHERE i_uyeid=? && i_islem=? ORDER BY i_id DESC");
                        $data -> execute([
                            $_SESSION["uye_id"],
                            "pizzaci"
                        ]);
                        $_data = $data -> fetch(PDO::FETCH_ASSOC);

                        if(date("YmdHis", strtotime($_data["i_tarih"] . "+4 minute")) > date("YmdHis")){
                            echo 'Az önce soydun, 4 dakika sonra tekrar gel.';
                        }else {
                        $para = $_uyedata["uye_para"] + 20;

                        $veriguncelle = $db->prepare("UPDATE uyeler SET uye_para=? WHERE uye_id=?");
                        $veriguncelle ->execute([
                            $para,
                            $_SESSION["uye_id"]
                        ]);

                        $veriekle = $db->prepare("INSERT INTO islemler SET i_uyeid=?, i_islem=?");
                        $veriekle ->execute([
                            $_SESSION["uye_id"],
                            "pizzaci"
                        ]);

                        if ($veriguncelle && $veriekle) {
                            echo 'Tebrik ederim, 20 para kazandınız.';
                        } else {
                            echo 'Eyvah, bir hata ile karşılaştık';
                        }
                        }
                        }else{ // Yok
                        $para = $_uyedata["uye_para"] + 20;

                        $veriguncelle = $db->prepare("UPDATE uyeler SET uye_para=? WHERE uye_id=?");
                        $veriguncelle ->execute([
                            $para,
                            $_SESSION["uye_id"]
                        ]);

                        $veriekle = $db->prepare("INSERT INTO islemler SET i_uyeid=?, i_islem=?");
                        $veriekle ->execute([
                            $_SESSION["uye_id"],
                            "pizzaci"
                        ]);

                        if ($veriguncelle && $veriekle) {
                            echo 'Tebrik ederim, 20 para kazandınız.';
                        } else {
                            echo 'Eyvah, bir hata ile karşılaştık';
                        }
                        }

                    }
                    echo '
                    <form action="" method="post">
                        <h3>Pizzacıyı soymak istiyor musun?</h3>
                        <button type="submit" class="btn btn-danger">Evet</button>
                        <a href="oyun.php" class="btn btn-danger btn-danger2">Hayır</a>
                        <input type="hidden" name="token" value="">
                    </form>';
                    break;

                case 'park':
                    if ($_POST) {
                        $cek = $db->prepare("SELECT * FROM islemler WHERE 
                        i_uyeid =:i_uyeid &&
                        i_islem =:i_islem
                        ");
                        $cek->execute([
                            'i_uyeid'=>$_SESSION["uye_id"],
                            'i_islem'=>"park"
                        ]);
                        $saydirma = $cek->rowCount();

                        if ($saydirma >0){ // Var
                        $data = $db -> prepare("SELECT * FROM islemler WHERE i_uyeid=? && i_islem=? ORDER BY i_id DESC");
                        $data -> execute([
                            $_SESSION["uye_id"],
                            "park"
                        ]);
                        $_data = $data -> fetch(PDO::FETCH_ASSOC);

                        if(date("YmdHis", strtotime($_data["i_tarih"] . "+1 minute")) > date("YmdHis")){
                            echo 'Az önce dolandırdın, 1 dakika sonra tekrar gel.';
                        }else {
                        $para = $_uyedata["uye_para"] + 10;

                        $veriguncelle = $db->prepare("UPDATE uyeler SET uye_para=? WHERE uye_id=?");
                        $veriguncelle ->execute([
                            $para,
                            $_SESSION["uye_id"]
                        ]);

                        $veriekle = $db->prepare("INSERT INTO islemler SET i_uyeid=?, i_islem=?");
                        $veriekle ->execute([
                            $_SESSION["uye_id"],
                            "park"
                        ]);

                        if ($veriguncelle && $veriekle) {
                            echo 'Tebrik ederim, 30 para kazandınız.';
                        } else {
                            echo 'Eyvah, bir hata ile karşılaştık';
                        }
                        }
                        }else{ // Yok
                        $para = $_uyedata["uye_para"] + 10;

                        $veriguncelle = $db->prepare("UPDATE uyeler SET uye_para=? WHERE uye_id=?");
                        $veriguncelle ->execute([
                            $para,
                            $_SESSION["uye_id"]
                        ]);

                        $veriekle = $db->prepare("INSERT INTO islemler SET i_uyeid=?, i_islem=?");
                        $veriekle ->execute([
                            $_SESSION["uye_id"],
                            "park"
                        ]);

                        if ($veriguncelle && $veriekle) {
                            echo 'Tebrik ederim, 10 para kazandınız.';
                        } else {
                            echo 'Eyvah, bir hata ile karşılaştık';
                        }
                        }

                    }
                    echo '
                    <form action="" method="post">
                        <h3>Parktaki insanları dolandırmak istiyor musun?</h3>
                        <button type="submit" class="btn btn-danger">Evet</button>
                        <a href="oyun.php" class="btn btn-danger btn-danger2">Hayır</a>
                        <input type="hidden" name="token" value="">
                    </form>';
                    break;

                default:
                    echo '<h3>Yolunu kaybettin sanırım.</h3><a href="oyun.php" class="btn btn-danger btn-danger2">Eve dön</a>';
                    break;
            }
            ?>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>

</body>
</html>