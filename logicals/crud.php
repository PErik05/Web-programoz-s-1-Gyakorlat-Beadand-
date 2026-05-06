<?php

/* =========================
   ADD USER
========================= */
if (isset($_GET['crud_add']) && $_POST) {

    $stmt = $dbh->prepare("
        INSERT INTO felhasznalok
        (csaladi_nev, uto_nev, bejelentkezes, jelszo)
        VALUES (?, ?, ?, SHA1(?))
    ");

    $stmt->execute([
        $_POST['csaladi_nev'],
        $_POST['uto_nev'],
        $_POST['bejelentkezes'],
        $_POST['jelszo']
    ]);

    header("Location: ?crud");
    exit;
}

/* =========================
   DELETE
========================= */
if (isset($_GET['crud_delete'])) {

    $stmt = $dbh->prepare("DELETE FROM felhasznalok WHERE id = ?");
    $stmt->execute([$_GET['crud_delete']]);

    header("Location: ?crud");
    exit;
}

?>