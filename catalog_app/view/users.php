<?php
require_once "../class/User.php";
$user = new User();

$editData = null;

// tambah user
if (isset($_POST['add'])) {
    $user->add($_POST['name']);
    header("Location: users.php");
}

// hapus user
if (isset($_GET['delete'])) {
    $user->delete($_GET['delete']);
    header("Location: users.php");
}

// ambil data untuk edit
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $result = $user->getAll();
    while ($row = $result->fetch_assoc()) {
        if ($row['id'] == $id) {
            $editData = $row;
        }
    }
}

// update user
if (isset($_POST['update'])) {
    $user->update($_POST['id'], $_POST['name']);
    header("Location: users.php");
}

$users = $user->getAll();
?>

<?php include "header.php"; ?>

<h2>Users</h2>

<form method="POST">
    <?php if ($editData): ?>
        <input type="hidden" name="id" value="<?= $editData['id']; ?>">
    <?php endif; ?>

    <input type="text" name="name" placeholder="User Name" required
           value="<?= $editData ? $editData['name'] : ''; ?>">

    <button type="submit" name="<?= $editData ? 'update' : 'add'; ?>">
        <?= $editData ? 'Update' : 'Add'; ?>
    </button>
</form>

<br>

<table border="1" cellpadding="8">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Action</th>
    </tr>
    <?php while ($row = $users->fetch_assoc()) { ?>
        <tr>
            <td><?= $row['id']; ?></td>
            <td><?= $row['name']; ?></td>
            <td>
                <a href="?edit=<?= $row['id']; ?>">Edit</a> |
                <a href="?delete=<?= $row['id']; ?>" onclick="return confirm('Yakin hapus user ini?')">Delete</a>
            </td>
        </tr>
    <?php } ?>
</table>
