<?php
include('./includes/config.inc.php');

$queryString = $_SERVER['QUERY_STRING'];
$params = explode('&', $_SERVER['QUERY_STRING']);
$oldal = $params[0];

if ($oldal == "kapcsolat_kuld" && $_POST) {

    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $message = trim($_POST["message"]);

    if ($name == "" || $email == "" || $message == "") {
        die("Hiányzó adat!");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Hibás email!");
    }

    $stmt = $dbh->prepare("INSERT INTO messages (name, email, message) VALUES (?, ?, ?)");
    $stmt->execute([$name, $email, $message]);

    header("Location: index.php?uzenetek");
    exit;
}

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