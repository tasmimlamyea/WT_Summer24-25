<?php
include "../model/db.php";

$db = new mydb();
$conn = $db->openCon();

if (!isset($_POST['quantities']) || !is_array($_POST['quantities'])) {
    die("No quantities submitted.");
}

$quantities = $_POST['quantities'];
$errors = [];
$validatedQuantities = [];

foreach ($quantities as $itemId => $qty) {
    $itemId = intval($itemId);
    $qty = intval($qty);
    
    if ($itemId <= 0) {
        $errors[] = "Invalid item ID: " . htmlspecialchars($itemId);
        continue;
    }
    
    if ($qty < 1) {
        $errors[] = "Quantity for item ID $itemId must be at least 1.";
        continue;
    }

    $stmt = $conn->prepare("SELECT Price FROM seller WHERE Item_id = ?");
    $stmt->bind_param("i", $itemId);
    $stmt->execute();
    $stmt->bind_result($price);
    if (!$stmt->fetch()) {
        $errors[] = "Item ID $itemId does not exist.";
    }
    $stmt->close();

    if (empty($errors)) {
        $validatedQuantities[$itemId] = $qty;
    }
}

if (!empty($errors)) {
    echo "<h3>Errors found:</h3><ul>";
    foreach ($errors as $error) {
        echo "<li>" . htmlspecialchars($error) . "</li>";
    }
    echo "</ul>";
    exit;
}

$totalPrice = 0;
foreach ($validatedQuantities as $itemId => $qty) {
    $stmt = $conn->prepare("SELECT Price FROM seller WHERE Item_id = ?");
    $stmt->bind_param("i", $itemId);
    $stmt->execute();
    $stmt->bind_result($price);
    if ($stmt->fetch()) {
        $totalPrice += $price * $qty;
    }
    $stmt->close();
}

echo "<h3>Order Summary</h3>";
echo "Total Price: $" . number_format($totalPrice, 2);

$db->closeCon($conn);
?>
