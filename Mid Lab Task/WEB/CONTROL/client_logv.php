<?php
session_start(); // Ensure session is started

$username = $userType = "";
$username_error = $password_error = $userType_error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $valid = true;

    // User Type
    if (empty($_POST["userType"])) {
        $userType_error = "Please select a user type.";
        $valid = false;
    } else {
        $userType = $_POST["userType"];
    }

    // Username
    if (empty($_POST["username"])) {
        $username_error = "Username is required.";
        $valid = false;
    } else {
        $username = trim($_POST["username"]);
        if (strlen($username) < 5) {
            $username_error = "Username must be at least 5 characters.";
            $valid = false;
        }
    }

    // Password
    if (empty($_POST["password"])) {
        $password_error = "Password is required.";
        $valid = false;
    } elseif (strlen($_POST["password"]) < 6) {
        $password_error = "Password must be at least 6 characters.";
        $valid = false;
    }

    if ($valid) {
        include_once "../model/db.php";
        $db = new mydb();
        $conn = $db->openCon();

        // ✅ FIXED: use $username (not $Username)
        $user = $db->verifyLogin($conn, $username, $_POST["password"], $userType);
        $db->closeCon($conn);

        if ($user) {
            $_SESSION["username"] = $user["Username"] ?? $user["username"];
            $_SESSION["userType"] = $userType;
            $_SESSION["userid"] = $user["ID"] ?? null;

            if ($userType == "seller") {
                $_SESSION["shop_name"] = $user["ShopName"] ?? "Seller Shop";
                header("Location: seller_ad.php");
            } else {
                $_SESSION["customer_name"] = $user["fullname"] ?? "Customer";
                header("Location: client_cart.php");
            }
            exit();
        } else {
            $password_error = "Invalid username or password.";
        }
    }
}
?>
