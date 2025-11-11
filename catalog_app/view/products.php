<?php
require_once "../class/Product.php";
require_once "../class/Category.php";
require_once "../class/User.php";

// membuat object dari tiap class untuk akses fungsi crud
$product = new Product();
$category = new Category();
$user = new User();

// proses tambah data produk
if (isset($_POST['add'])) {
    // memanggil fungsi add dengan data dari form
    $product->add($_POST['name'], $_POST['price'], $_POST['category_id'], $_POST['user_id']);
    header("Location: products.php"); // refresh halaman
    exit;
}

// proses update data produk
if (isset($_POST['update'])) {
    $product->update($_POST['id'], $_POST['name'], $_POST['price'], $_POST['category_id'], $_POST['user_id']);
    header("Location: products.php");
    exit;
}

// proses hapus data
if (isset($_GET['delete'])) {
    $product->delete($_GET['delete']);
    header("Location: products.php");
    exit;
}

// mengambil semua kategori dan user untuk pilihan select
$categories = $category->getAll();
$users = $user->getAll();

// variabel untuk menampung data yang sedang di edit
$edit_data = null;

// jika tombol edit diklik
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $result = $product->getAll(); // ambil semua produk
    while ($row = $result->fetch_assoc()) {
        // cari data yang id nya sesuai
        if ($row['id'] == $id) {
            $edit_data = $row; // simpan ke variabel edit_data
            break;
        }
    }
}

// ambil semua data untuk ditampilkan di tabel
$products = $product->getAll();
?>

<?php include "header.php"; ?> <!-- memanggil header -->

<h2>products</h2>

<form method="POST">
    <?php if ($edit_data) { ?>
        <!-- jika mode edit, simpan id produk -->
        <input type="hidden" name="id" value="<?= $edit_data['id']; ?>">
    <?php } ?>

    <!-- input nama produk -->
    <input type="text" name="name" placeholder="product name" 
           value="<?= $edit_data ? $edit_data['name'] : ''; ?>" required>

    <!-- input harga -->
    <input type="number" step="0.01" name="price" placeholder="price"
           value="<?= $edit_data ? $edit_data['price'] : ''; ?>" required>

    <!-- dropdown kategori -->
    <select name="category_id" required>
        <option value="">select category</option>
        <?php 
        $cat = $category->getAll();
        while ($c = $cat->fetch_assoc()) { 
            // cek apakah kategori ini yang sedang dipakai saat edit
            $selected = ($edit_data && $edit_data['category_name'] == $c['name']) ? 'selected' : '';
        ?>
            <option value="<?= $c['id']; ?>" <?= $selected; ?>><?= $c['name']; ?></option>
        <?php } ?>
    </select>

    <!-- dropdown user yang menambahkan -->
    <select name="user_id" required>
        <option value="">select user</option>
        <?php 
        $usr = $user->getAll();
        while ($u = $usr->fetch_assoc()) { 
            $selected = ($edit_data && $edit_data['user_name'] == $u['name']) ? 'selected' : '';
        ?>
            <option value="<?= $u['id']; ?>" <?= $selected; ?>><?= $u['name']; ?></option>
        <?php } ?>
    </select>

    <?php if ($edit_data) { ?>
        <!-- tombol update -->
        <button type="submit" name="update">update</button>
        <a href="products.php">cancel</a>
    <?php } else { ?>
        <!-- tombol tambah -->
        <button type="submit" name="add">add</button>
    <?php } ?>
</form>

<br>

<table border="1" cellpadding="8">
    <tr>
        <th>id</th>
        <th>name</th>
        <th>price</th>
        <th>category</th>
        <th>added by</th>
        <th>action</th>
    </tr>

    <!-- menampilkan daftar produk -->
    <?php while ($row = $products->fetch_assoc()) { ?>
    <tr>
        <td><?= $row['id']; ?></td>
        <td><?= $row['name']; ?></td>
        <td><?= $row['price']; ?></td>
        <td><?= $row['category_name']; ?></td>
        <td><?= $row['user_name']; ?></td>
        <td>
            <a href="?edit=<?= $row['id']; ?>">edit</a> |
            <a href="?delete=<?= $row['id']; ?>" onclick="return confirm('yakin hapus data ini?')">hapus</a>
        </td>
    </tr>
    <?php } ?>
</table>
