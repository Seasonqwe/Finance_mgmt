<?php
session_start();

// Security Check: Block non-admin users
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

include 'db.php';

// Handle Add Product
if (isset($_POST['add_product'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $image_url = $_POST['image_url'];
    $stock_status = $_POST['stock_status'];

    $stmt = $conn->prepare("INSERT INTO products (title, description, price, image_url, stock_status) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssdss", $title, $description, $price, $image_url, $stock_status);
    $stmt->execute();
    header("Location: admin.php");
    exit();
}

// Handle Update Product
if (isset($_POST['update_product'])) {
    $id = $_POST['id'];
    $price = $_POST['price'];
    $stock_status = $_POST['stock_status'];

    $stmt = $conn->prepare("UPDATE products SET price = ?, stock_status = ? WHERE id = ?");
    $stmt->bind_param("dsi", $price, $stock_status, $id);
    $stmt->execute();
    header("Location: admin.php");
    exit();
}

// Handle Delete Product
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    header("Location: admin.php");
    exit();
}

$result = $conn->query("SELECT * FROM products ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <style>
        body { font-family: Arial, sans-serif; background: #0b0c10; color: #fff; padding: 20px; }
        .header { display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #333; padding-bottom: 10px; }
        .card { background: #12141c; padding: 20px; border-radius: 6px; margin: 20px 0; border: 1px solid #222; }
        input, select, textarea, button { display: block; width: 100%; margin: 8px 0; padding: 10px; background: #1a1d28; color: #fff; border: 1px solid #333; border-radius: 4px; box-sizing: border-box; }
        button { background: #ffffff; color: #000; font-weight: bold; cursor: pointer; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { padding: 10px; border: 1px solid #222; text-align: left; }
        .btn-logout { color: #ff4d4d; text-decoration: none; font-weight: bold; }
    </style>
</head>
<body>

    <div class="header">
        <h1>Admin Dashboard</h1>
        <a href="logout.php" class="btn-logout">Logout</a>
    </div>

    <div class="card">
        <h3>Add New Product</h3>
        <form method="POST">
            <input type="text" name="title" placeholder="Product Title" required>
            <textarea name="description" placeholder="Product Description" required></textarea>
            <input type="number" step="0.01" name="price" placeholder="Price (NPR)" required>
            <input type="text" name="image_url" placeholder="Image URL / Path (e.g., https://... or images/hoodie.jpg)" required>
            <select name="stock_status">
                <option value="in_stock">In Stock</option>
                <option value="out_of_stock">Out of Stock</option>
            </select>
            <button type="submit" name="add_product">Add Product</button>
        </form>
    </div>

    <div class="card">
        <h3>Current Products</h3>
        <table>
            <tr>
                <th>Title</th>
                <th>Price (NPR)</th>
                <th>Stock Status</th>
                <th>Actions</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['title']); ?></td>
                <form method="POST">
                    <td>
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <input type="number" step="0.01" name="price" value="<?php echo $row['price']; ?>">
                    </td>
                    <td>
                        <select name="stock_status">
                            <option value="in_stock" <?php if($row['stock_status'] == 'in_stock') echo 'selected'; ?>>In Stock</option>
                            <option value="out_of_stock" <?php if($row['stock_status'] == 'out_of_stock') echo 'selected'; ?>>Out of Stock</option>
                        </select>
                    </td>
                    <td>
                        <button type="submit" name="update_product">Save</button>
                        <a href="admin.php?delete=<?php echo $row['id']; ?>" style="color: #ff4d4d;" onclick="return confirm('Delete this product?')">Delete</a>
                    </td>
                </form>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>

</body>
</html>