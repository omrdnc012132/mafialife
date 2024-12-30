<?php

session_start();
include 'ayar.php';

if (@$_SESSION["uye_id"]) {
    session_destroy();
    header("LOCATION:index.php");

} else {
    header("LOCATION:index.php");
}
