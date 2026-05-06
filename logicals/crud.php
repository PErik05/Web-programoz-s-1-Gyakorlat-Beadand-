<?php

// DELETE
if (isset($_GET['crud_delete'])) {

    $stmt = $dbh->prepare("DELETE FROM felhasznalok WHERE id = ?");
    $stmt->execute([$_GET['crud_delete']]);

    header("Location: index.php?crud");
    exit;
}

// ADD
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

    header("Location: index.php?crud");
    exit;
}
if (isset($_POST['edit_id'])) {

    $stmt = $dbh->prepare("
        UPDATE felhasznalok
        SET csaladi_nev=?, uto_nev=?, bejelentkezes=?
        WHERE id=?
    ");

    $stmt->execute([
        $_POST['csaladi_nev'],
        $_POST['uto_nev'],
        $_POST['bejelentkezes'],
        $_POST['edit_id']
    ]);

    header("Location: index.php?crud");
    exit;
}

?>