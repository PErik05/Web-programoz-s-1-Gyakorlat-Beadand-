<?php
session_start();

// 🔐 BELÉPÉS ELLENŐRZÉS (a te rendszered szerint)
if (!isset($_SESSION['login'])) {
    echo "<h2>Hozzáférés megtagadva</h2>";
    echo "<p>Az üzenetek megtekintéséhez be kell jelentkezni!</p>";
    exit;
}
?>


<h2>Beérkezett üzenetek</h2>

<table border="1">
    <tr>
        <th>Név</th>
        <th>Email</th>
        <th>Üzenet</th>
        <th>Időpont</th>
    </tr>

<?php
// legfrissebb elöl
$stmt = $dbh->query("
    SELECT name, email, message, created_at
    FROM messages
    ORDER BY created_at DESC
");

foreach ($stmt as $row) {

    // ha nincs név → Vendég
    $nev = trim($row['name']);
    if ($nev == "") {
        $nev = "Vendég";
    }

    echo "<tr>";
    echo "<td>{$nev}</td>";
    echo "<td>{$row['email']}</td>";
    echo "<td>{$row['message']}</td>";
    echo "<td>{$row['created_at']}</td>";
    echo "</tr>";
}
?>

</table>