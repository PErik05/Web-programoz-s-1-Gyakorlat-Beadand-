<h1 style="text-align:center;">CRUD OPERATIONS</h1>

<h3>Add User</h3>

<form method="post" action="?crud_add">
    Name: <input type="text" name="name"><br><br>
    Email: <input type="text" name="email"><br><br>
    Mobile: <input type="text" name="mobile"><br><br>

    <button class="btn-blue" type="submit">Add User</button>
</form>

<hr>

<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Mobile</th>
        <th>Action</th>
    </tr>

<?php
// 🔥 EZ FONTOS: config.inc.php-ból jön $dbh
$stmt = $dbh->query("SELECT * FROM users ORDER BY id DESC");

foreach ($stmt as $row) {
    echo "<tr>";
    echo "<td>{$row['id']}</td>";
    echo "<td>{$row['name']}</td>";
    echo "<td>{$row['email']}</td>";
    echo "<td>{$row['mobile']}</td>";

    echo "<td>
            <a class='btn-blue' href='?crud_edit={$row['id']}'>Edit</a>
            <a class='btn-red' href='?crud_delete={$row['id']}'>Delete</a>
          </td>";

    echo "</tr>";
}
?>

</table>