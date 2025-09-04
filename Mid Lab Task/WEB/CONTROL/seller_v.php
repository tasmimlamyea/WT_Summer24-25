
<?php
// Initialize variables and error messages
$username = $fullname = $email = $password = $confirm_password = "";
$position = $dept = $admin_id = "";

$username_error = $fullname_error = $email_error = $password_error = $confirm_error = "";
$position_error = $dept_error = $adminid_error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Username validation: required, min 5 chars, alphanumeric only
    if (empty(trim($_POST["username"]))) {
        $username_error = "Username is required";
    } else {
        $username = trim($_POST["username"]);
        if (!preg_match("/^[a-zA-Z0-9]{5,}$/", $username)) {
            $username_error = "Username must be at least 5 characters and contain only letters and numbers";
        }
    }

    // Full Name validation: required, min 5 chars, letters and spaces only
    if (empty(trim($_POST["fullname"]))) {
        $fullname_error = "Full name is required";
    } else {
        $fullname = trim($_POST["fullname"]);
        if (!preg_match("/^[a-zA-Z ]{5,}$/", $fullname)) {
            $fullname_error = "Full name must be at least 5 characters and contain letters and spaces only";
        }
    }

    // Email validation: required, valid email format
    if (empty(trim($_POST["email"]))) {
        $email_error = "Email is required";
    } else {
        $email = trim($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email_error = "Invalid email format";
        }
    }

    // Password validation: required, min 6 chars
    if (empty($_POST["password"])) {
        $password_error = "Password is required";
    } else {
        $password = $_POST["password"];
        if (strlen($password) < 6) {
            $password_error = "Password must be at least 6 characters";
        }
    }

    // Confirm password validation: must match password
    if (empty($_POST["confirm_password"])) {
        $confirm_error = "Please confirm your password";
    } else {
        $confirm_password = $_POST["confirm_password"];
        if ($password !== $confirm_password) {
            $confirm_error = "Passwords do not match";
        }
    }

    // Position validation: required, must be one of the dropdown options
    $valid_positions = ["Manager", "Cashier", "Barista", "Cleaner"];
    if (empty($_POST["position"])) {
        $position_error = "Please select a position";
    } else {
        $position = $_POST["position"];
        if (!in_array($position, $valid_positions)) {
            $position_error = "Invalid position selected";
        }
    }

    // Department validation: required, must be one of the dropdown options
    $valid_depts = ["Sales", "Inventory", "Customer Service", "HR"];
    if (empty($_POST["dept"])) {
        $dept_error = "Please select a department";
    } else {
        $dept = $_POST["dept"];
        if (!in_array($dept, $valid_depts)) {
            $dept_error = "Invalid department selected";
        }
    }

    // Admin ID validation: required, numeric only
    if (empty(trim($_POST["admin_id"]))) {
        $adminid_error = "Admin ID is required";
    } else {
        $admin_id = trim($_POST["admin_id"]);
        if (!preg_match("/^[0-9]+$/", $admin_id)) {
            $adminid_error = "Admin ID must be numeric";
        }
    }

    // If no errors, you can proceed to store data or other logic
    if (
        empty($username_error) && empty($fullname_error) && empty($email_error) &&
        empty($password_error) && empty($confirm_error) && empty($position_error) &&
        empty($dept_error) && empty($adminid_error)
    ) {
        echo "Customer registration successful! Welcome to Cafe Sip and Shop!";
        // Proceed with saving the seller to the database using registerSeller function
    } else {
        echo "Please fix the errors in the form.";
    }
}
?>


