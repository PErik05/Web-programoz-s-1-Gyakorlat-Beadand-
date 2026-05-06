<h1 style="text-align:center;">CRUD OPERATIONS</h1>

<h3>Add User</h3>

<form method="post" action="?crud_add">

    Családi név: <input type="text" name="csaladi_nev"><br><br>
    Utónév: <input type="text" name="uto_nev"><br><br>
    Bejelentkezés: <input type="text" name="bejelentkezes"><br><br>
    Jelszó: <input type="password" name="jelszo"><br><br>

    <button class="btn-blue" type="submit">Add User</button>
</form>

<hr>

<table>
    <tr>
        <th>ID</th>
        <th>Családi név</th>
        <th>Utónév</th>
        <th>Login</th>
        <th>Action</th>
    </tr>

<?php
$stmt = $dbh->query("SELECT * FROM felhasznalok ORDER BY id DESC");

foreach ($stmt as $row) {

    echo "<tr>";
    echo "<td>{$row['id']}</td>";
    echo "<td>{$row['csaladi_nev']}</td>";
    echo "<td>{$row['uto_nev']}</td>";
    echo "<td>{$row['bejelentkezes']}</td>";

    echo "<td>
            <a class="btn-blue" href="?crud&edit=<?=$row['id']?>">Edit</a>
            <a class="btn-red" href="?crud&delete=<?=$row['id']?>">Delete</a>
          </td>";

    echo "</tr>";
}
?>

</table>