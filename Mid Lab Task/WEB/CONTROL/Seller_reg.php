<?php
include "../control/seller_v.php"; 
include "../model/db.php"; // Include the database class

// Initialize the database connection
$db = new mydb();
$conn = $db->openCon(); // Open the connection

if ($_SERVER["REQUEST_METHOD"] == "POST" && empty($username_error) && empty($fullname_error) && empty($email_error) && empty($password_error) && empty($confirm_error) && empty($position_error) && empty($dept_error) && empty($adminid_error)) {
    // Call registerSeller function from db.php to save data
    $result = $db->registerSeller($conn, $username, $fullname, $email, $password, $confirm_password, $position, $dept, $admin_id);
    if ($result) {
        echo "Seller registration successful!";
    } else {
        echo "There was an error during registration. Please try again.";
    }
    $db->closeCon($conn); // Close the database connection
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Cafe Shop Seller Registration</title>
    <link rel="stylesheet" href="../view/seller.css">
</head>
<body>

<header>
    <div class="container">
        <h1>Cafe Shop Seller Registration</h1>
    </div>
</header>

<main>
    <div class="container">
        <form action="" method="post" novalidate>
            <table>
                <tr>
                    <td><label for="username">Username:</label></td>
                    <td>
                        <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($username); ?>" />
                        <span class="error"><?php echo $username_error; ?></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="fullname">Full Name:</label></td>
                    <td>
                        <input type="text" id="fullname" name="fullname" value="<?php echo htmlspecialchars($fullname); ?>" />
                        <span class="error"><?php echo $fullname_error; ?></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="email">Email:</label></td>
                    <td>
                        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" />
                        <span class="error"><?php echo $email_error; ?></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="password">Password:</label></td>
                    <td>
                        <input type="password" id="password" name="password" />
                        <span class="error"><?php echo $password_error; ?></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="confirm_password">Confirm Password:</label></td>
                    <td>
                        <input type="password" id="confirm_password" name="confirm_password" />
                        <span class="error"><?php echo $confirm_error; ?></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="position">Position:</label></td>
                    <td>
                        <select id="position" name="position">
                            <option value="">Select Position</option>
                            <option value="Manager" <?php if ($position == "Manager") echo "selected"; ?>>Manager</option>
                            <option value="Cashier" <?php if ($position == "Cashier") echo "selected"; ?>>Cashier</option>
                            <option value="Barista" <?php if ($position == "Barista") echo "selected"; ?>>Barista</option>
                            <option value="Cleaner" <?php if ($position == "Cleaner") echo "selected"; ?>>Cleaner</option>
                        </select>
                        <span class="error"><?php echo $position_error; ?></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="dept">Department:</label></td>
                    <td>
                        <select id="dept" name="dept">
                            <option value="">Select Department</option>
                            <option value="Sales" <?php if ($dept == "Sales") echo "selected"; ?>>Sales</option>
                            <option value="Inventory" <?php if ($dept == "Inventory") echo "selected"; ?>>Inventory</option>
                            <option value="Customer Service" <?php if ($dept == "Customer Service") echo "selected"; ?>>Customer Service</option>
                            <option value="HR" <?php if ($dept == "HR") echo "selected"; ?>>HR</option>
                        </select>
                        <span class="error"><?php echo $dept_error; ?></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="admin_id">Admin ID:</label></td>
                    <td>
                        <input type="text" id="admin_id" name="admin_id" value="<?php echo htmlspecialchars($admin_id); ?>" />
                        <span class="error"><?php echo $adminid_error; ?></span>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align:center;">
                        <input type="submit" name="submit" value="Register as Seller" />
                    </td>
                </tr>
            </table>
        </form>
    </div>
</main>

<footer>
    <div class="container">
        <p>&copy; <?php echo date("Y"); ?> Cafe Shop Management</p>
    </div>
</footer>

</body>
</html>
