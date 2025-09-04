<?php
include "../model/db.php";

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate item name
    if (empty($_POST['item_name'])) {
        $errors['item_name'] = "Item name is required.";
    } elseif (!preg_match("/^[a-zA-Z0-9\s]+$/", $_POST['item_name'])) {
        $errors['item_name'] = "Item name can only contain letters, numbers, and spaces.";
    }

    // Validate category
    $valid_categories = ['coffee', 'snack', 'dessert', 'other'];
    if (empty($_POST['category']) || !in_array($_POST['category'], $valid_categories)) {
        $errors['category'] = "Please select a valid category.";
    }

    // Validate price
    if (empty($_POST['price'])) {
        $errors['price'] = "Price is required.";
    } elseif (!is_numeric($_POST['price']) || $_POST['price'] <= 0) {
        $errors['price'] = "Enter a valid positive price.";
    }

    // Insert into DB if no errors
    if (empty($errors)) {
        $item_name = $_POST['item_name'];
        $category = $_POST['category'];
        $price = floatval($_POST['price']);

        $db = new mydb();
        $conn = $db->openCon();

        $result = $db->addMenuItem($item_name, $category, $price, $conn);
        $db->closeCon($conn);

        if ($result) {
            echo "<p style='color:green;'>Menu item added successfully.</p>";
        } else {
            echo "<p style='color:red;'>Failed to add item.</p>";
        }
    } else {
        foreach ($errors as $field => $error) {
            echo "<p style='color:red;'>$error</p>";
        }
    }
}
?>
