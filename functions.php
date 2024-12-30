<?php

function bizimsaldiridegeri(){
    global $db;
    global $_uyedata;

    $silahdegeri = array(
        "el-bombasi" => 1,
        "cop" => 2,
        "beyzbol-sopasi" => 2,
        "molotof" => 3,
        "musta" => 4,
        "tabanca" => 5,
        "tufek" => 6
    );

    $veri = $db->prepare("SELECT * FROM silahlar WHERE s_uyeid = ?");
    $veri->execute([$_SESSION["uye_id"]]);
    $islem = $veri->fetchAll(PDO::FETCH_ASSOC);

    $silahdegeritoplam = 0;
    foreach ($islem as $row) {
        if (isset($silahdegeri[$row["s_silah"]])) {
            $silahdegeritoplam += $silahdegeri[$row["s_silah"]] * 10;
        }
    }

    // Ev
    $evdegeri = array(
        "kiralik-ev" => 1,
        "kisisel-ev" => 2,
        "kulube" => 3,
        "villa" => 4,
        "malikane" => 5
    );
    $evdegeritoplam = 0;
    if (!empty($_uyedata["uye_ev"]) && isset($evdegeri[$_uyedata["uye_ev"]])) {
        $evdegeritoplam = $evdegeri[$_uyedata["uye_ev"]] * 20;
    }

    // Koruma
    $korumadegeritoplam = isset($_uyedata["uye_koruma"]) ? $_uyedata["uye_koruma"] * 30 : 0;

    // Saygınlık
    $sayginliktoplam = isset($_uyedata["uye_sayginlik"]) ? $_uyedata["uye_sayginlik"] * 40 : 0;

    return $silahdegeritoplam + $evdegeritoplam + $korumadegeritoplam + $sayginliktoplam;
}

// Rakip saldırı
function rakipsaldiridegeri($kadi){
    global $db;

    $uyedata = $db->prepare("SELECT * FROM uyeler WHERE uye_kadi = ?");
    $uyedata->execute([$kadi]);
    $_uyedata = $uyedata->fetch(PDO::FETCH_ASSOC);

    if (!$_uyedata) {
        return 0; // Kullanıcı bulunamazsa 0 döner
    }

    $silahdegeri = array(
        "el-bombasi" => 1,
        "cop" => 2,
        "beyzbol-sopasi" => 2,
        "molotof" => 3,
        "musta" => 4,
        "tabanca" => 5,
        "tufek" => 6
    );

    $veri = $db->prepare("SELECT * FROM silahlar WHERE s_uyeid = ?");
    $veri->execute([$_uyedata["uye_id"]]);
    $islem = $veri->fetchAll(PDO::FETCH_ASSOC);

    $silahdegeritoplam = 0;
    foreach ($islem as $row) {
        if (isset($silahdegeri[$row["s_silah"]])) {
            $silahdegeritoplam += $silahdegeri[$row["s_silah"]] * 10;
        }
    }

    // Ev
    $evdegeri = array(
        "kiralik-ev" => 1,
        "kisisel-ev" => 2,
        "kulube" => 3,
        "villa" => 4,
        "malikane" => 5
    );
    $evdegeritoplam = 0;
    if (!empty($_uyedata["uye_ev"]) && isset($evdegeri[$_uyedata["uye_ev"]])) {
        $evdegeritoplam = $evdegeri[$_uyedata["uye_ev"]] * 20;
    }

    // Koruma
    $korumadegeritoplam = isset($_uyedata["uye_koruma"]) ? $_uyedata["uye_koruma"] * 30 : 0;

    // Saygınlık
    $sayginliktoplam = isset($_uyedata["uye_sayginlik"]) ? $_uyedata["uye_sayginlik"] * 40 : 0;

    return $silahdegeritoplam + $evdegeritoplam + $korumadegeritoplam + $sayginliktoplam;
}
