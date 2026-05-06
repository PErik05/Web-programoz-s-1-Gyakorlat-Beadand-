<?php
	// include('./includes/config.inc.php');
	// $oldal = $_SERVER['QUERY_STRING'];
	// if ($oldal!="") {
	// 	if (isset($oldalak[$oldal]) && file_exists("./templates/pages/{$oldalak[$oldal]['fajl']}.tpl.php")) {
	// 		$keres = $oldalak[$oldal];
	// 	}
	// 	else { 
	// 		$keres = $hiba_oldal;
	// 		header("HTTP/1.0 404 Not Found");
	// 	}
	// }
	// else $keres = $oldalak['/'];
	// include('./templates/index.tpl.php'); 


include('./includes/config.inc.php');

//$oldal = $_SERVER['QUERY_STRING'];
$oldal = $_GET;

// 🔥 ÜZENET KÜLDÉS KEZELÉS
if ($oldal == "kapcsolat_kuld" && $_POST) {

    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $message = trim($_POST["message"]);

    // 🔴 szerver oldali validáció
    if ($name == "" || $email == "" || $message == "") {
        die("Hiányzó adat!");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Hibás email!");
    }

    // mentés DB-be
    $stmt = $dbh->prepare("INSERT INTO messages (name, email, message) VALUES (?, ?, ?)");
    $stmt->execute([$name, $email, $message]);

    // átirányítás
    header("Location: index.php?uzenetek");
    exit;
}

// OLDAL KEZELÉS
if ($oldal != "") {
    if (isset($oldalak[$oldal]) && file_exists("./templates/pages/{$oldalak[$oldal]['fajl']}.tpl.php")) {
        $keres = $oldalak[$oldal];
    } else {
        $keres = $hiba_oldal;
        header("HTTP/1.0 404 Not Found");
    }
} else {
    $keres = $oldalak['/'];
}

include('./templates/index.tpl.php');


?>

