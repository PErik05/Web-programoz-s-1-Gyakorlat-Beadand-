<h2>Beérkezett üzenetek</h2>

<table border="1">
    <tr>
        <th>Név</th>
        <th>Email</th>
        <th>Üzenet</th>
        <th>Dátum</th>
    </tr>

<?php
$stmt = $dbh->query("SELECT * FROM messages ORDER BY created_at DESC");

foreach ($stmt as $row) {
    echo "<tr>";
    echo "<td>{$row['name']}</td>";
    echo "<td>{$row['email']}</td>";
    echo "<td>{$row['message']}</td>";
    echo "<td>{$row['created_at']}</td>";
    echo "</tr>";
}
?>

</table>