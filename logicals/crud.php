
<?php
if(isset($_GET['torol'])) {
    try {
        $dbh = new PDO('mysql:host=localhost;dbname=gyakorlat7', 'root', '',
            array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

        $sql = "DELETE FROM varos WHERE id = :id";
        $sth = $dbh->prepare($sql);
        $sth->execute(array(':id' => $_GET['torol']));
    }
    catch (PDOException $e) {
        echo "Hiba: " . $e->getMessage();
    }
}
?>
<?php

if(isset($_POST['nev']) && isset($_POST['megyeid'])) {
    try {
        $dbh = new PDO('mysql:host=localhost;dbname=gyakorlat7', 'root', '',
            array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        
        $sql = "INSERT INTO varos (nev, megyeid, megyeszekhely, megyeijogu)
                VALUES (:nev, :megyeid, 0, 0)";

        $sth = $dbh->prepare($sql);
        $sth->execute(array(
            ':nev' => $_POST['nev'],
            ':megyeid' => $_POST['megyeid']
        ));
    }
    catch (PDOException $e) {
        echo "Hiba: " . $e->getMessage();
    }
}
?>