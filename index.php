<?php
session_start();
include 'ayar.php';
include 'ukas.php';
    $q = @$_GET["q"];
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mafya Hayatı - Online Mafya Oyunu</title>
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap-reboot.css">
    <link rel="stylesheet" href="css/bootstrap-grid.css">
    <link rel="stylesheet" href="css/style.css?v=<?=time()?>">
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-lg-12 mt-3 mb-3">
        <img src="img/logo.png?V=V" height="100px">
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <img src="img/giris3.png" width="100%">
        </div>
        <div class="col-lg-4">
        
            <?php
                switch ($q) {
                    case 'kayit':
                        ukas_kayit("<p class='text-warning'>Lütfen boş bırakmayınız!</p>", "<p class='text-danger'>Böyle bir eposta mevcut! Lütfen başka bir tane deneyiniz!</p>", "<p class='text-warning'>Böyle bir kullanıcı adı mevcut! Lütfen başka bir tane deneyiniz!</p>", "<p class='text-success'>Başarıyla kaydoldun! :)</p>", "oyun.php", "<p class='text-danger'>Kullanıcı adı veya şifre hatalı!</p>", "<p class='text-danger'>Kayıt başarısız!</p>", "<p>Şifreniz bir birine eşleşmiyor!</p>", "<p>Lütfen gerçek bir eposta giriniz!</p>");
                        echo '
                        <form action="" method="POST">
                            <strong>Ad Soyad:</strong>
                            <input type="text" class="form-control" name="adsoyad">
                            <strong>Kullanıcı adı:</strong>
                            <input type="text" class="form-control" name="kadi">
                            <strong>Şifre:</strong>
                            <input type="password" class="form-control" name="sifre">
                            <strong>Şifre (Tekrar):</strong>
                            <input type="password" class="form-control" name="sifret">
                            <strong>E-Posta:</strong>
                            <input type="text" class="form-control" name="eposta"><br />
                            <input type="submit" class="btn w-100 btn-danger" name="kayit" value="Kayıt Ol">
                        </form>
                        <br />
                        <a href="?q=giris" class="btn btn-lg w-100 btn-danger btn-danger2">Giriş Yap</a>';
                        break;
                    
                    default:
                    ukas_giris("oyun.php", "<p class='text-warning'>Lütfen boş bırakmayınız!</p>", "<p class='text-danger'>Kullanıcı adı veya şifre hatalı!</p>");
                        echo '<form action="" method="post">
                            <strong class="gray">Kullanıcı adı:</strong>
                            <input type="text" name="kadi" class="form-control">
                            <strong class="gray">Şifre:</strong>
                            <input type="password" name="sifre" class="form-control">
                            <br />
                            <input type="submit" name="giris" class="btn w-100 btn-danger" value="Giriş Yap">
                        </form>
                        <br />
                        <a href="?q=kayit" class="btn btn-lg w-100 btn-danger btn-danger2">Kayıt Ol</a>';
                        break;
                }
            ?>
            <br />
            <br />
            <span class="lightgray">Bir Uğur KILCI ürünüdür. &copy; <?=date("Y")?></span>
            <br />
            <a href="" class="gray">Kullanım Koşulları</a> | 
            <a href="" class="gray">Gizlilik</a>
        </div>
    </div>
</div>

    
</body>
</html>