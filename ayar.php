<?php
	
	$host 		= "localhost";
	$dbname 	= "mafya";
	$charset 	= "utf8";
	$root 		= "root";
	$password 	= "19801980Mr09";

	try{
		$db = new PDO("mysql:host=$host;dbname=$dbname;charset=$charset;", $root, $password);
	}catch(PDOExeption $error){
		echo $error->getMessage();
	}

	// CSRF Token
	if (empty($_SESSION['token'])) {
		$_SESSION['token'] = bin2hex(random_bytes(32));
	}

	$csrf = $_SESSION['token'];

	if($_SESSION) {
		$uyedata = $db -> prepare("SELECT * FROM uyeler WHERE uye_id=?");
		$uyedata -> execute([
			@$_SESSION["uye_id"]
		]);
		$_uyedata = $uyedata -> fetch(PDO::FETCH_ASSOC);
	}
	

	date_default_timezone_set("Europe/Istanbul");
?>
