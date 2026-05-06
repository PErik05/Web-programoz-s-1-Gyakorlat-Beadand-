<?php
try {
    $dbh = new PDO('mysql:host=localhost;dbname=gyakorlat7', 'root', '',
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    $dbh->query('SET NAMES utf8');
}
catch (PDOException $e) {
    die("DB hiba: " . $e->getMessage());
}

/* =========================
   CREATE (ADD USER)
========================= */
if (isset($_GET['crud_add']) && $_POST) {

    $stmt = $dbh->prepare("
        INSERT INTO users (name, email, mobile)
        VALUES (:name, :email, :mobile)
    ");

    $stmt->execute([
        ':name' => $_POST['name'],
        ':email' => $_POST['email'],
        ':mobile' => $_POST['mobile']
    ]);

    header("Location: ?crud");
    exit;
}

/* =========================
   DELETE
========================= */
if (isset($_GET['crud_delete'])) {

    $stmt = $dbh->prepare("DELETE FROM users WHERE id = :id");
    $stmt->execute([':id' => $_GET['crud_delete']]);

    header("Location: ?crud");
    exit;
}

/* =========================
   UPDATE (EDIT SIMPLE VERSION)
   -> gyors beadandó megoldás
========================= */
if (isset($_GET['crud_edit']) && $_POST) {

    $stmt = $dbh->prepare("
        UPDATE users
        SET name = :name,
            email = :email,
            mobile = :mobile
        WHERE id = :id
    ");

    $stmt->execute([
        ':id' => $_GET['crud_edit'],
        ':name' => $_POST['name'],
        ':email' => $_POST['email'],
        ':mobile' => $_POST['mobile']
    ]);

    header("Location: ?crud");
    exit;
}
?>