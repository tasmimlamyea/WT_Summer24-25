<?php 
session_start();
if (!isset($_SESSION["username"]) || $_SESSION["userType"] !== "seller") {
    header("Location: client_login.php");
    exit();
}

include "../control/seller_addv.php"; 
require_once "../model/db.php";

$db = new mydb();
$conn = $db->openCon();

$items = [];
$result = $conn->query("SELECT * FROM seller");

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $items[] = $row;
    }
}

$db->closeCon($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Seller Dashboard - Manage Menu</title>
    <link rel="stylesheet" href="../view/seller.css">
</head>
<body>

<div class="container">
    <header>
        <h2>Welcome, <?= htmlspecialchars($_SESSION["username"]) ?>!</h2>
        <p>Shop: <?= htmlspecialchars($_SESSION["shop_name"] ?? "Your Café") ?></p>
        
    </header>

    <main>
        <!-- Add New Menu Item Form -->
        <section id="form-section">
            <form id="addMenuItemForm" action="seller_ad.php" method="POST">
                <table>
                    <tr>
                        <td>Item Name:</td>
                        <td>
                            <input type="text" name="item_name" id="item_name">
                            <div class="error" id="itemNameErr"></div>
                        </td>
                    </tr>
                    <tr>
                        <td>Category:</td>
                        <td>
                            <select name="category" id="category">
                                <option value="">--Select--</option>
                                <option value="coffee">Coffee</option>
                                <option value="snack">Snack</option>
                                <option value="dessert">Dessert</option>
                                <option value="other">Other</option>
                            </select>
                            <div class="error" id="categoryErr"></div>
                        </td>
                    </tr>
                    <tr>
                        <td>Price:</td>
                        <td>
                            <input type="number" step="0.01" name="price" id="price">
                            <div class="error" id="priceErr"></div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center">
                            <input type="submit" value="Add Menu Item">
                        </td>
                    </tr>
                </table>
            </form>
        </section>

        <br>

        <!-- Existing Items Table -->
        <section id="item-list-section">
            <h3>Current Menu Items</h3>
            <table>
                <thead>
                    <tr>
                        <th>Item ID</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Price ($)</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="menuItemList">
                    <?php if (!empty($items)): ?>
                        <?php foreach ($items as $item): ?>
                            <tr>
                                <td><?= htmlspecialchars($item['Item_id']) ?></td>
                                <td><?= htmlspecialchars($item['Name']) ?></td>
                                <td><?= htmlspecialchars($item['Category']) ?></td>
                                <td><?= htmlspecialchars($item['Price']) ?></td>
                                <td>
                                    <form action="seller_edit.php" method="get">
                                        <input type="hidden" name="id" value="<?= $item['Item_id'] ?>">
                                        <button type="submit" class="edit-btn">Edit</button>
                                    </form>
                                    <form action="seller_delete.php" method="get" onsubmit="return confirm('Are you sure you want to delete this item?');">
                                        <input type="hidden" name="id" value="<?= $item['Item_id'] ?>">
                                        <button type="submit" class="delete-btn">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" align="center">No menu items found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </section>
    </main>

    <footer>
        <p>&copy; <?= date("Y") ?> Sip and Shop Café</p>
    </footer>
</div>

<a href="logout.php" style="float:left;">Logout</a>
<script src="../view/menuManage.js"></script>

</body>
</html>
