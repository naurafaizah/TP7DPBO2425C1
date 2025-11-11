<?php
require_once "../class/Category.php";
$category = new Category();

$editData = null;

// tambah data
if (isset($_POST['add'])) {
    $category->add($_POST['name']);
    header("Location: categories.php");
}

// hapus data
if (isset($_GET['delete'])) {
    $category->delete($_GET['delete']);
    header("Location: categories.php");
}

// ambil data untuk edit
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $result = $category->getAll();
    while ($row = $result->fetch_assoc()) {
        if ($row['id'] == $id) {
            $editData = $row;
        }
    }
}

// update data
if (isset($_POST['update'])) {
    $category->update($_POST['id'], $_POST['name']);
    header("Location: categories.php");
}

$categories = $category->getAll();
?>

<?php include "header.php"; ?>

<h2>Categories</h2>

<form method="POST">
    <?php if ($editData): ?>
        <input type="hidden" name="id" value="<?= $editData['id']; ?>">
    <?php endif; ?>

    <input type="text" name="name" placeholder="Category Name" required
           value="<?= $editData ? $editData['name'] : ''; ?>">

    <button type="submit" name="<?= $editData ? 'update' : 'add'; ?>">
        <?= $editData ? 'Update' : 'Add'; ?>
    </button>
</form>

<table border="1" cellpadding="8">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Action</th>
    </tr>
    <?php while ($row = $categories->fetch_assoc()) { ?>
        <tr>
            <td><?= $row['id']; ?></td>
            <td><?= $row['name']; ?></td>
            <td>
                <a href="?edit=<?= $row['id']; ?>">Edit</a> |
                <a href="?delete=<?= $row['id']; ?>" onclick="return confirm('Yakin hapus?')">Delete</a>
            </td>
        </tr>
    <?php } ?>
</table>
