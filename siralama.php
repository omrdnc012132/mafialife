<?php
session_start();
include 'ayar.php';

$q = @$_REQUEST["q"]; // Gelen 'q' değerini al

// Varsayılan değerler ve class atamaları
$deger = "uye_sayginlik"; // Varsayılan sıralama sütunu
$classsayginlik = $classpara = $classkoruma = $classsilah = "text-white"; // Varsayılan class

// Gelen 'q' değerine göre sütunu ve class'ı belirle
switch ($q) {
    case 'sayginlik':
        $deger = "uye_sayginlik";
        $classsayginlik = "text-red";
        break;
    case 'para':
        $deger = "uye_para";
        $classpara = "text-red";
        break;
    case 'koruma':
        $deger = "uye_koruma";
        $classkoruma = "text-red";
        break;
    case 'silah':
        $deger = "uye_silah";
        $classsilah = "text-red";
        break;
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sıralama - Mafya Hayatı - Online Mafya Oyunu</title>
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap-reboot.css">
    <link rel="stylesheet" href="css/bootstrap-grid.css">
    <link rel="stylesheet" href="css/style.css?v=<?=time()?>">
</head>
<body>

<?php
if (@$_SESSION["uye_id"]) {
    include 'header.php';
} else {
    echo '<div class="container">
    <div class="row">
        <div class="col-lg-12 mt-3 mb-3">
            <img src="img/logo.png?v=v" height="50px">
        </div>
    </div>
        <div class="col-lg-12">
            <div class="serit">
                <a href="index.php" class="btn btn-danger btn-danger2">Giriş Yap</a>
                <a href="index.php?q=kayit" class="btn btn-danger">Kayıt Ol</a>
            </div>
        </div>
    </div>
</div>';
}
?>

<div class="container">
    <div class="row lightgray">
        <div class="col-lg-12 mt-5 mb-5">
            <style>
                body { counter-reset: Count-Value; }
                table { border-collapse: separate; }
                .tr .td:first-child:before { counter-increment: Count-Value; content: "" counter(Count-Value); }
            </style>
            <h1 class="text-white">Sıralama</h1>
            <table class="table table-dark">
                <tr>
                    <td><strong>#</strong></td>
                    <td><strong>Mafya Adı</strong></td>
                    <td><a href="siralama.php?q=sayginlik" class="<?= $classsayginlik ?>"><strong>Saygınlık</strong></a></td>
                    <td><a href="siralama.php?q=para" class="<?= $classpara ?>"><strong>Para</strong></a></td>
                    <td><a href="siralama.php?q=silah" class="<?= $classsilah ?>"><strong>Silah Sayısı</strong></a></td>
                    <td><a href="siralama.php?q=koruma" class="<?= $classkoruma ?>"><strong>Koruma Sayısı</strong></a></td>
                </tr>
                <?php
                $veri = $db->prepare("SELECT * FROM uyeler ORDER BY $deger DESC");
                $veri->execute();
                $islem = $veri->fetchALL(PDO::FETCH_ASSOC);

                foreach ($islem as $row) {
                    echo '<tr class="tr">
                            <td class="td"></td>
                            <td class="td">' . $row["uye_kadi"] . '</td>
                            <td class="td">' . $row["uye_sayginlik"] . '</td>
                            <td class="td">' . $row["uye_para"] . '</td>
                            <td class="td">' . $row["uye_silah"] . '</td>
                            <td class="td">' . $row["uye_koruma"] . '</td>
                          </tr>';
                }
                ?>
            </table>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>

</body>
</html>
