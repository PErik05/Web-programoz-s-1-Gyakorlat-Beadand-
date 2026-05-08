<h1 style="text-align:center; font-family: Arial, sans-serif; font-weight: normal; margin-bottom: 30px;">CRUD OPERATIONS</h1>

<?php

if (isset($_GET['edit'])) {
    $stmt_edit = $dbh->prepare("SELECT * FROM felhasznalok WHERE id = ?");
    $stmt_edit->execute([$_GET['edit']]);
    $user_to_edit = $stmt_edit->fetch();

    if ($user_to_edit) { ?>
        <h3>Felhasználó szerkesztése (ID: <?= $user_to_edit['id'] ?>)</h3>
        <form method="post" action="?crud" style="margin-bottom: 20px; display: flex; gap: 10px; align-items: center;">
            <input type="hidden" name="edit_id" value="<?= $user_to_edit['id'] ?>">
            <input type="text" name="csaladi_nev" value="<?= $user_to_edit['csaladi_nev'] ?>" required class="form-input">
            <input type="text" name="uto_nev" value="<?= $user_to_edit['uto_nev'] ?>" required class="form-input">
            <input type="text" name="bejelentkezes" value="<?= $user_to_edit['bejelentkezes'] ?>" required class="form-input">
            <button class="btn-primary" type="submit">Mentés</button>
            <a href="?crud" style="text-decoration:none; color: gray;">Mégse</a>
        </form>
        <hr>
    <?php }
} else { ?>
    <form method="post" action="?crud&add=true" style="margin-bottom: 20px; display: flex; gap: 10px; align-items: center;">
        <button class="btn-primary" type="submit">Add User</button>
        <input type="text" name="csaladi_nev" placeholder="Családi név" required class="form-input">
        <input type="text" name="uto_nev" placeholder="Utónév" required class="form-input">
        <input type="text" name="bejelentkezes" placeholder="Login név" required class="form-input">
        <input type="password" name="jelszo" placeholder="Jelszó" required class="form-input">
    </form>
<?php } ?>

<table class="crud-table">
    <thead>
        <tr>
            <th>id</th>
            <th>Name</th>
            <th>Login</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    <?php
    $stmt = $dbh->query("SELECT * FROM felhasznalok ORDER BY id ASC");
    foreach ($stmt as $row) {
        echo "<tr>";
        echo "<td>{$row['id']}</td>";
        echo "<td><strong style='color: #222; font-weight: 600;'>{$row['csaladi_nev']} {$row['uto_nev']}</strong></td>";
        echo "<td>{$row['bejelentkezes']}</td>";
        echo "<td style='text-align: right; width: 150px;'>
                <a class='btn-edit' href='?crud&edit={$row['id']}'>Edit</a>
                <a class='btn-delete' href='?crud&delete={$row['id']}' onclick=\"return confirm('Biztosan törlöd?')\">Delete</a>
              </td>";
        echo "</tr>";
    }
    ?>
    </tbody>
</table>