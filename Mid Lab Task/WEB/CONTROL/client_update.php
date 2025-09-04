<?php
// Include the database connection file
include "../model/db.php";

// Check if productID is provided
if (isset($_GET['Item_id'])) {
    $productID = $_GET['Item_id'];

    // Create a new database connection
    $db = new mydb();
    $conn = $db->openCon();

    // Fetch product details from the database using productID
    $query = "SELECT * FROM seller WHERE Item_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $Item_id);
    $stmt->execute();
    $result = $stmt->get_result();
               
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $name = $row['Name'];
        $category = $row['Category'];
        $price = $row['Price'];
      
    } else {
        echo "Product not found!";
        exit();
    }

    // Check if the form is submitted to update the product
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST["Name"];
        $category = $_POST["Category"];
        $price = $_POST["Price"];
       

        // Update the product in the database
        $updateQuery = "UPDATE products SET prName = ?, prCategory = ?, prPrice = ?, prUnits = ? WHERE Item_id = ?";
        if ($stmtUpdate = $conn->prepare($updateQuery)) {
            $stmtUpdate->bind_param("ssdis", $name, $category, $price,  $Item_id);
            $stmtUpdate->execute();

            echo "<p style='color:green;text-align:center;'>Product updated successfully!</p>";
        } else {
            echo "Error: " . $conn->error;
        }

        $stmtUpdate->close();
    }

    $db->closeCon($conn);
} else {
    echo "Product ID is missing!";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Product</title>
    <link rel="stylesheet" href="../view/cart.css">
</head>
<body>
<div class="container" style="width: 400px; margin: 40px auto;">

    <h2 style="text-align:center;">Update Product</h2>

    <form method="POST">
        <label>Product Name:</label>
        <input type="text" name="Name" value="<?php echo htmlspecialchars($name ?? ''); ?>" required><br>

        <label>Category:</label>
        <input type="text" name="Category" value="<?php echo htmlspecialchars($category ?? ''); ?>" required><br>

        <label>Price:</label>
        <input type="number" step="0.01" name="Price" value="<?php echo htmlspecialchars($price ?? ''); ?>" required><br>

       

        <input type="submit" value="Update Item">
    </form>

    <!-- Back Button -->
    <a href="seller2.php"><button type="button" style="margin-top:15px; width:100%;">Back to Product List</button></a>

</div>
</body>
</html>
