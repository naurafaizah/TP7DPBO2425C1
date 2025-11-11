<?php
require_once "../class/User.php";
$user = new User(); // membuat object user untuk akses fungsi crud

$editData = null; // variabel untuk menampung data yang sedang di edit

// proses tambah user
if (isset($_POST['add'])) {
    $user->add($_POST['name']); // panggil fungsi add
    header("Location: users.php"); // refresh halaman
}

// proses hapus user
if (isset($_GET['delete'])) {
    $user->delete($_GET['delete']); // hapus berdasarkan id
    header("Location: users.php");
}

// mengambil data user untuk form edit
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $result = $user->getAll(); // ambil semua user
    while ($row = $result->fetch_assoc()) {
        // cari user yang sesuai id nya
        if ($row['id'] == $id) {
            $editData = $row; // simpan data ke variabel
        }
    }
}

// proses update user
if (isset($_POST['update'])) {
    $user->update($_POST['id'], $_POST['name']); // update nilai
    header("Location: users.php");
}

// ambil semua user untuk ditampilkan di tabel
$users = $user->getAll();
?>

<?php include "header.php"; ?> <!-- memanggil header -->

<h2>users</h2>

<form method="POST">
    <?php if ($editData): ?>
        <!-- simpan id saat mode edit -->
        <input type="hidden" name="id" value="<?= $editData['id']; ?>">
    <?php endif; ?>

    <!-- input nama user -->
    <input type="text" name="name" placeholder="user name" required
           value="<?= $editData ? $editData['name'] : ''; ?>">

    <!-- tombol berubah sesuai mode -->
    <button type="submit" name="<?= $editData ? 'update' : 'add'; ?>">
        <?= $editData ? 'update' : 'add'; ?>
    </button>
</form>

<br>

<table border="1" cellpadding="8">
    <tr>
        <th>id</th>
        <th>name</th>
        <th>action</th>
    </tr>

    <!-- menampilkan daftar user -->
    <?php while ($row = $users->fetch_assoc()) { ?>
        <tr>
            <td><?= $row['id']; ?></td>
            <td><?= $row['name']; ?></td>
            <td>
                <a href="?edit=<?= $row['id']; ?>">edit</a> |
                <a href="?delete=<?= $row['id']; ?>" onclick="return confirm('yakin hapus user ini?')">delete</a>
            </td>
        </tr>
    <?php } ?>
</table>
