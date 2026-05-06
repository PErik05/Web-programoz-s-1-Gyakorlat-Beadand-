
<h3>Új város hozzáadása</h3>

<form method="post" action="?crud">

    Név: <input type="text" name="nev" required><br>

    Megye:
    <select name="megyeid">
        <?php
        $dbh = new PDO('mysql:host=localhost;dbname=gyakorlat7', 'root', '');
        foreach($dbh->query("SELECT id, nev FROM megye") as $m) {
            echo "<option value='{$m['id']}'>{$m['nev']}</option>";
        }
        ?>
    </select><br>

    <button type="submit">Hozzáadás</button>
</form>
<h2>Városok</h2>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Név</th>
        <th>Megye</th>
        <th>Művelet</th>
    </tr>

<?php
try {
    $dbh = new PDO('mysql:host=localhost;dbname=gyakorlat7', 'root', '',
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    $dbh->query('SET NAMES utf8');

    $sql = "SELECT varos.id, varos.nev, megye.nev AS megye_nev
            FROM varos
            JOIN megye ON varos.megyeid = megye.id
            ORDER BY varos.nev";

    foreach ($dbh->query($sql) as $row) {
        echo "<tr>";
        echo "<td>{$row['id']}</td>";
        echo "<td>{$row['nev']}</td>";
        echo "<td>{$row['megye_nev']}</td>";
        echo "<td>
                <a href='crud&torol={$row['id']}'>Törlés</a>
              </td>";
        echo "</tr>";
    }
}
catch (PDOException $e) {
    echo "Hiba: " . $e->getMessage();
}
?>

</table>