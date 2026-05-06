<h1 style="text-align:center;">CRUD OPERATIONS</h1>



<form method="post" action="?crud_add">

    

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
            <a class='btn-blue' href='?crud_edit={$row['id']}'>Edit</a>
            <a class='btn-red' href='?crud_delete={$row['id']}'>Delete</a>
          </td>";

    echo "</tr>";
}
?>

</table>