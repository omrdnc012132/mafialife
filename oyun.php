<?php
session_start();
include 'ayar.php';
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
    <div class="row justify-content-center">
        <div class="col-lg-6 lightgray mb-5 mt-5">
            <div class="row">
                <div class="col-lg-6 text-center">
                    <a href="soy.php?q=kuyumcu" class="gray">
                        <img src="img/kuyumcu.png" width="150">
                        <br />
                        Kuyumcu
                    </a>
                </div>
                <div class="col-lg-6 text-center">
                    <a href="soy.php?q=park" class="gray">
                        <img src="img/park.png" width="150">
                        <br />
                        Park
                    </a>
                </div>
                <div class="col-lg-6 text-center">
                    <a href="soy.php?q=pizzaci" class="gray">
                        <img src="img/pizzaci.png" width="150">
                        <br />
                        Pizzacı
                    </a>
                </div>
                <div class="col-lg-6 text-center">

                <?php
                if ($_uyedata["uye_ev"] == "kulube") {
                    echo '<img src="img/kulube.png" width="150">
                    <br />
                    Kulübe';
                }elseif ($_uyedata["uye_ev"] == "kisisel-ev") {
                    echo '<img src="img/kisisel-ev.png" width="150">
                    <br />
                    Kişisel Ev';
                }elseif ($_uyedata["uye_ev"] == "villa") {
                    echo '<img src="img/villa.png" width="150">
                    <br />
                    Villa';
                }elseif ($_uyedata["uye_ev"] == "malilane") {
                    echo '<img src="img/malikane.png" width="150">
                    <br />
                    Malikane';
                }else {
                    echo '<img src="img/kiralik-ev.png" width="150">
                    <br />
                    Kiralık Evin';
                }
                ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-lg-12 lightgray">
            <div class="serit">
                <strong>Silahlar:</strong>
                <br />
                <?php
                    $silahlar = array(
                        "musta" => "Muşta",
                        "molotof" => "Molotof",
                        "el-bombasi" => "El Bombası",
                        "beyzbol-sopasi" => "Beyzbol Sopası",
                        "tabanca" => "Tabaca",
                        "tufek" => "Tüfek",
                        "cop" => "Cop"
                    );

                    $veri = $db -> prepare("SELECT * FROM silahlar WHERE s_uyeid=?");
                    $veri -> execute([
                        $_SESSION["uye_id"]
                    ]);
                    $islem = $veri -> fetchALL(PDO::FETCH_ASSOC);

                    foreach($islem as $row){
                    echo $silahlar[$row["s_silah"]] . ", ";
                }
                ?>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-lg-12 lightgray">
            <div class="serit">
                <strong>Son Haberler:</strong>
                <br />
                Haber
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>

</body>
</html>