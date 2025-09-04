<?php
// Include the database connection (Ensure the correct path is provided)
include '../model/db.php';  // Adjust the path based on your directory structure

// Initialize error variables
$fullname_error = "";
$username_error = "";
$password_error = "";
$email_error = "";
$phone_error = "";
$address_error = "";
$payment_error = "";
$dob_error = "";
$gender_error = "";

// Check if the form is submitted
if (isset($_POST["submit"])) {
    $valid = true;

    // Validate Full Name
    if (empty($_POST['fullname']) || strlen($_POST['fullname']) < 5) {
        $fullname_error = "Full Name must be at least 5 characters.";
        $valid = false;
    }

    // Validate Username
    if (empty($_POST['username']) || strlen($_POST['username']) < 3) {
        $username_error = "Username must be at least 3 characters.";
        $valid = false;
    }

    // Validate Password
    if (empty($_POST['password']) || strlen($_POST['password']) < 6) {
        $password_error = "Password must be at least 6 characters.";
        $valid = false;
    }

    // Validate Email
    if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) { 
        $email_error = "Invalid email format.";
        $valid = false;
    }

    // Validate Phone Number
    if (empty($_POST['phone']) || !preg_match("/^[0-9]{11}$/", $_POST['phone'])) {
        $phone_error = "Phone number must be 11 digits.";
        $valid = false;
    }

    // Validate Delivery Address
    if (empty($_POST['address'])) {
        $address_error = "Delivery address is required.";
        $valid = false;
    }

    // Validate Payment Method
    if (empty($_POST['payment_method'])) {
        $payment_error = "Please select a payment method.";   
        $valid = false;
    }

    // Validate Date of Birth
    if (empty($_POST['dob'])) {
        $dob_error = "Date of birth is required.";
        $valid = false;
    }

    // Validate Gender
    if (empty($_POST['gender'])) {
        $gender_error = "Please select a gender.";
        $valid = false;
    }

    // If validation passes, proceed to registration
    if ($valid) {
        // Get the form data
        $fullname = $_POST['fullname'];
        $username = $_POST['username'];
        $password = $_POST['password']; // Store password in plain text for now
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $payment_method = $_POST['payment_method'];
        $dob = $_POST['dob'];
        $gender = $_POST['gender'];

        // Open a connection to the database
        $db = new mydb();
        $conn = $db->openCon();

        // Call the registerCustomer function from db.php to insert customer data
        $result = $db->registerCustomer($conn, $fullname, $username, $password, $email, $phone, $address, $payment_method, $dob, $gender);

        if ($result) {
            echo "<p style='color:green; text-align:center;'>Registration successful!</p>";
        } else {
            echo "<p style='color:red; text-align:center;'>Error during registration. Please try again.</p>";
        }

        // Close the database connection
        $db->closeCon($conn);
    } else {
        echo "<p style='color:red; text-align:center;'>Correct the errors and try again.</p>";
    }
}
?>
