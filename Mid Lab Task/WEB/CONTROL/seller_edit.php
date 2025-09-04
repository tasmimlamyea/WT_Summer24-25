<?php
include "../model/db.php";

$db = new mydb();
$conn = $db->openCon();

// Check if item ID is provided
if (!isset($_GET['id'])) {
    die("Item ID not provided.");
}

$itemId = intval($_GET['id']);
$item = $db->getMenuItemById($itemId, $conn);

// Handle update form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['item_name'] ?? '';
    $category = $_POST['category'] ?? '';
    $price = floatval($_POST['price']);

    if (!empty($name) && !empty($category) && $price >= 0) {
        $success = $db->updateMenuItem($itemId, $name, $category, $price, $conn);
        if ($success) {
            header("Location: seller_ad.php");
            exit();
        } else {
            echo "Failed to update item.";
        }
    } else {
        echo "All fields are required.";
    }
}

$db->closeCon($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Menu Item</title>
    <link rel="stylesheet" href="../view/seller.css">
</head>
<body>
<div class="container">
    <h2>Edit Menu Item</h2>

    <?php if ($item): ?>
        <form method="POST">
            <table border="1">
                <tr>
                    <td>Item Name:</td>
                    <td><input type="text" name="item_name" value="<?= htmlspecialchars($item['Name']) ?>"></td>
                </tr>
                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category">
                            <option value="coffee" <?= $item['Category'] == 'coffee' ? 'selected' : '' ?>>Coffee</option>
                            <option value="snack" <?= $item['Category'] == 'snack' ? 'selected' : '' ?>>Snack</option>
                            <option value="dessert" <?= $item['Category'] == 'dessert' ? 'selected' : '' ?>>Dessert</option>
                            <option value="other" <?= $item['Category'] == 'other' ? 'selected' : '' ?>>Other</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Price ($):</td>
                    <td><input type="number" step="0.01" name="price" value="<?= htmlspecialchars($item['Price']) ?>"></td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <input type="submit" value="Update Item">
                    </td>
                </tr>
            </table>
        </form>
    <?php else: ?>
        <p>Item not found.</p>
    <?php endif; ?>

    <br>
    <a href="seller_ad.php">← Back to Menu</a>
</div>
</body>
</html>
