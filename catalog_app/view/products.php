<?php
require_once "../class/Product.php";
require_once "../class/Category.php";
require_once "../class/User.php";

$product = new Product();
$category = new Category();
$user = new User();

if (isset($_POST['add'])) {
    $product->add($_POST['name'], $_POST['price'], $_POST['category_id'], $_POST['user_id']);
    header("Location: products.php");
    exit;
}

if (isset($_POST['update'])) {
    $product->update($_POST['id'], $_POST['name'], $_POST['price'], $_POST['category_id'], $_POST['user_id']);
    header("Location: products.php");
    exit;
}

if (isset($_GET['delete'])) {
    $product->delete($_GET['delete']);
    header("Location: products.php");
    exit;
}

$categories = $category->getAll();
$users = $user->getAll();

// kalau sedang edit
$edit_data = null;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $result = $product->getAll();
    while ($row = $result->fetch_assoc()) {
        if ($row['id'] == $id) {
            $edit_data = $row;
            break;
        }
    }
}

$products = $product->getAll();
?>

<?php include "header.php"; ?>

<h2>Products</h2>

<form method="POST">
    <?php if ($edit_data) { ?>
        <input type="hidden" name="id" value="<?= $edit_data['id']; ?>">
    <?php } ?>

    <input type="text" name="name" placeholder="Product Name" 
           value="<?= $edit_data ? $edit_data['name'] : ''; ?>" required>

    <input type="number" step="0.01" name="price" placeholder="Price"
           value="<?= $edit_data ? $edit_data['price'] : ''; ?>" required>

    <select name="category_id" required>
        <option value="">Select Category</option>
        <?php 
        $cat = $category->getAll();
        while ($c = $cat->fetch_assoc()) { 
            $selected = ($edit_data && $edit_data['category_name'] == $c['name']) ? 'selected' : '';
        ?>
            <option value="<?= $c['id']; ?>" <?= $selected; ?>><?= $c['name']; ?></option>
        <?php } ?>
    </select>

    <select name="user_id" required>
        <option value="">Select User</option>
        <?php 
        $usr = $user->getAll();
        while ($u = $usr->fetch_assoc()) { 
            $selected = ($edit_data && $edit_data['user_name'] == $u['name']) ? 'selected' : '';
        ?>
            <option value="<?= $u['id']; ?>" <?= $selected; ?>><?= $u['name']; ?></option>
        <?php } ?>
    </select>

    <?php if ($edit_data) { ?>
        <button type="submit" name="update">Update</button>
        <a href="products.php">Cancel</a>
    <?php } else { ?>
        <button type="submit" name="add">Add</button>
    <?php } ?>
</form>

<br>

<table border="1" cellpadding="8">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Price</th>
        <th>Category</th>
        <th>Added By</th>
        <th>Action</th>
    </tr>
    <?php while ($row = $products->fetch_assoc()) { ?>
    <tr>
        <td><?= $row['id']; ?></td>
        <td><?= $row['name']; ?></td>
        <td><?= $row['price']; ?></td>
        <td><?= $row['category_name']; ?></td>
        <td><?= $row['user_name']; ?></td>
        <td>
            <a href="?edit=<?= $row['id']; ?>">Edit</a> |
            <a href="?delete=<?= $row['id']; ?>" onclick="return confirm('Yakin hapus data ini?')">Hapus</a>
        </td>
    </tr>
    <?php } ?>
</table>
