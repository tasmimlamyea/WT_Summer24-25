<?php
// Include the database connection file
include "../model/db.php";

// Check if Item ID is provided
if (isset($_GET['id'])) {
    $item_id = intval($_GET['id']);  // Sanitize input

    // Create a new database connection
    $db = new mydb();
    $conn = $db->openCon();

    // Delete the item using a method
    $deleteSuccess = $db->deleteMenuItemById($item_id, $conn);
    $db->closeCon($conn);

    if ($deleteSuccess) {
        // Redirect after successful deletion
        header("Location: seller_ad.php");
        exit;
    } else {
        echo "Error deleting menu item.";
    }

} else {
    echo "Item ID is missing!";
}
?>
