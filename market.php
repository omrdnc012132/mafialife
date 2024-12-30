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
    <title>Market - Mafya Hayatı - Online Mafya Oyunu</title>
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
            <h1 class="text-white">Market</h1>
            <a href="satinal.php?q=musta" class="btn btn-danger btn-danger2 mr-2 mb-2">
                <img src="img/musta.png" alt="">
                <br />
                Muşta (190 Para)
            </a>
            <a href="satinal.php?q=molotof" class="btn btn-danger btn-danger2 mr-2 mb-2">
                <img src="img/molotof.png" alt="">
                <br />
                Molotof (150 Para)
            </a>
            <a href="satinal.php?q=beyzbol-sopasi" class="btn btn-danger btn-danger2 mr-2 mb-2">
                <img src="img/beyzbol-sopasi.png" alt="">
                <br />
                Beyzbol Sopası (200 Para)
            </a>
            <a href="satinal.php?q=cop" class="btn btn-danger btn-danger2 mr-2 mb-2">
                <img src="img/cop.png" alt="">
                <br />
                Cop (200 Para)
            </a>
            <a href="satinal.php?q=el-bombasi" class="btn btn-danger btn-danger2 mr-2 mb-2">
                <img src="img/el-bombasi.png" alt="">
                <br />
                El Bombası (90 Para)
            </a>
            <a href="satinal.php?q=tufek" class="btn btn-danger btn-danger2 mr-2 mb-2">
                <img src="img/tufek.png" alt="">
                <br />
                Tüfek (800 Para)
            </a>
            <a href="satinal.php?q=tabanca" class="btn btn-danger btn-danger2 mr-2 mb-2">
                <img src="img/tabanca.png" alt="">
                <br />
                Tabanca (500 Para)
            </a>
            <a href="satinal.php?q=koruma" class="btn btn-danger btn-danger2 mr-2 mb-2">
                <img src="img/koruma.png" alt="">
                <br />
                Koruma (2000 Para)
            </a>
            <a href="satinal.php?q=kisisel-ev&p=ev" class="btn btn-danger btn-danger2 mr-2 mb-2">
                <img src="img/kisisel-ev.png" height="100px">
                <br />
                Kişisel Ev (10.000 Para)
            </a>
            <a href="satinal.php?q=kulube&p=ev" class="btn btn-danger btn-danger2 mr-2 mb-2">
                <img src="img/kulube.png" height="100px">
                <br />
                Kulübe (14.000 Para)
            </a>
            <a href="satinal.php?q=villa&p=ev" class="btn btn-danger btn-danger2 mr-2 mb-2">
                <img src="img/villa.png" height="100px">
                <br />
                Villa (50.000 Para)
            </a>
            <a href="satinal.php?q=malikane&p=ev" class="btn btn-danger btn-danger2 mr-2 mb-2">
                <img src="img/malikane.png" height="100px">
                <br />
                Malikane (100.000 Para)
            </a>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>

</body>
</html>