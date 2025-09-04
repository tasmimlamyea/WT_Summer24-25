<?php
session_start();

if (!isset($_SESSION['userID']) || !isset($_SESSION['username'])) {
    header("Location: customer_login.php");
    exit();
}

include "../model/db.php";

$db = new mydb();
$conn = $db->openCon();

$userID = $_SESSION['userID'];

$query = "SELECT * FROM customerregistration WHERE customerID = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $userID);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

$db->closeCon($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Customer Profile Information</title>
    <link rel="stylesheet" href="../view/cart.css">
</head>
<body>

<div class="profile-container">
    <h2>Customer Profile</h2>

    <table class="profile-table">
        <tr>
            <td><b>Full Name:</b></td>
            <td><?php echo htmlspecialchars($user['fullname']); ?></td>
        </tr>
        <tr>
            <td><b>Username:</b></td>
            <td><?php echo htmlspecialchars($user['username']); ?></td>
        </tr>
        <tr>
            <td><b>Password:</b></td>
            <td>********</td>
        </tr>
        <tr>
            <td><b>Email:</b></td>
            <td><?php echo htmlspecialchars($user['email']); ?></td>
        </tr>
        <tr>
            <td><b>Phone Number:</b></td>
            <td><?php echo htmlspecialchars($user['phone']); ?></td>
        </tr>
        <tr>
            <td><b>Delivery Address:</b></td>
            <td><?php echo htmlspecialchars($user['address']); ?></td>
        </tr>
        <tr>
            <td><b>Payment
::contentReference[oaicite:0]{index=0}
 
