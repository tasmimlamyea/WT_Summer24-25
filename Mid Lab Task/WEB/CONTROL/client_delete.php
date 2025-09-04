<?php
// Include the database connection file
include "../model/db.php";

// Check if productID is provided
if (isset($_GET['Item_id'])) {
    $productID = $_GET['Item_id'];

    // Create a new database connection
    $db = new mydb();
    $conn = $db->openCon();

    // Delete the product from the database using productID
    $deleteQuery = "DELETE FROM seller WHERE Item_id = '$Item_id'";

    if ($conn->query($deleteQuery) === TRUE) {
        echo "Product deleted successfully!";
        // Optionally, redirect the user back to the product list page
        header("Location: seller_ad.php");
        exit;
    } else {
        echo "Error deleting product: " . $conn->error;
    }

    // Close the connection
    $db->closeCon($conn);
} else {
    echo "Product ID is missing!";
}
?>
