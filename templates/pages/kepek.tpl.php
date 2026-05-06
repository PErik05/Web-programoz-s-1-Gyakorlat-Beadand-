<?php
global $dbh;

if(isset($_POST['feltolt']) && isset($_SESSION['login'])) {

    $target_dir = "images/upload/";
    $file_name = basename($_FILES["kep"]["name"]);
    $target_file = $target_dir . $file_name;

    if(move_uploaded_file($_FILES["kep"]["tmp_name"], $target_file)) {

        $sql = "INSERT INTO kepek (fajlnev, feltolto, feltoltes_datuma)
                VALUES ('$file_name', '".$_SESSION['login']."', NOW())";

        $dbh->query($sql);

        echo "<p>Sikeres feltöltés!</p>";
    } else {
        echo "<p>Hiba történt a feltöltés során!</p>";
    }
}
?>

<h2>Képgaléria</h2>

<?php
global $dbh;

$sql = "SELECT * FROM kepek ORDER BY feltoltes_datuma DESC";
$result = $dbh->query($sql);

echo '<div class="galeria">';

while($row = $result->fetch_assoc()) {
    echo '<img src="images/upload/'.$row['fajlnev'].'" width="200">';
}

echo '</div>';
?>

<?php if(isset($_SESSION['login'])) { ?>

<h3>Kép feltöltése</h3>

<form method="post" enctype="multipart/form-data">
    <input type="file" name="kep" required>
    <button type="submit" name="feltolt">Feltöltés</button>
</form>

<?php } else { ?>
<p>Csak bejelentkezve tölthetsz fel képet.</p>
<?php } ?>