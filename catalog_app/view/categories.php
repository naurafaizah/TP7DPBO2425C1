<?php
require_once "../class/Category.php";
$category = new Category(); // membuat object category untuk akses fungsi crud

$editData = null; // variabel untuk menampung data yang mau di edit

// tambah data
if (isset($_POST['add'])) {
    // memanggil fungsi add dari class category
    $category->add($_POST['name']);
    header("Location: categories.php"); // redirect biar data langsung refresh
}

// hapus data
if (isset($_GET['delete'])) {
    // menghapus data berdasarkan id yang dikirim lewat url
    $category->delete($_GET['delete']);
    header("Location: categories.php");
}

// ambil data untuk edit
if (isset($_GET['edit'])) {
    $id = $_GET['edit']; // ambil id dari url
    $result = $category->getAll(); // ambil semua data category
    while ($row = $result->fetch_assoc()) {
        // mencari data yang id nya sama dengan yang mau di edit
        if ($row['id'] == $id) {
            $editData = $row; // menyimpan data yang ketemu untuk ditampilkan di form
        }
    }
}

// update data
if (isset($_POST['update'])) {
    // memanggil fungsi update dengan id dan name yang dikirim dari form
    $category->update($_POST['id'], $_POST['name']);
    header("Location: categories.php");
}

$categories = $category->getAll(); // ambil semua data category untuk ditampilkan di tabel
?>

<?php include "header.php"; ?> <!-- memanggil header agar layout rapi -->

<h2>categories</h2>

<form method="POST">
    <?php if ($editData): ?>
        <!-- input hidden untuk membawa id saat update -->
        <input type="hidden" name="id" value="<?= $editData['id']; ?>">
    <?php endif; ?>

    <!-- input nama kategori, jika mode edit maka value akan terisi -->
    <input type="text" name="name" placeholder="category name" required
           value="<?= $editData ? $editData['name'] : ''; ?>">

    <!-- tombol berubah otomatis sesuai mode: add atau update -->
    <button type="submit" name="<?= $editData ? 'update' : 'add'; ?>">
        <?= $editData ? 'update' : 'add'; ?>
    </button>
</form>

<table border="1" cellpadding="8">
    <tr>
        <th>id</th>
        <th>name</th>
        <th>action</th>
    </tr>

    <!-- menampilkan data category ke dalam tabel -->
    <?php while ($row = $categories->fetch_assoc()) { ?>
        <tr>
            <td><?= $row['id']; ?></td>
            <td><?= $row['name']; ?></td>
            <td>
                <!-- tombol edit dan delete -->
                <a href="?edit=<?= $row['id']; ?>">edit</a> |
                <a href="?delete=<?= $row['id']; ?>" onclick="return confirm('yakin hapus?')">delete</a>
            </td>
        </tr>
    <?php } ?>
</table>
