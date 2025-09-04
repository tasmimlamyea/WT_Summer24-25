<?php
class mydb {

    public function openCon() {
        $dbhost = "localhost";
        $dbusername = "root";
        $dbpassword = "";
        $dbname = "cafe";

        $conn = new mysqli($dbhost, $dbusername, $dbpassword, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        return $conn;
    }

    public function closeCon($conn) {
        $conn->close();
    }

    public function addMenuItem($name, $category, $price, $conn) {
        $query = "INSERT INTO seller (Name, Category, Price) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($query);
        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }
        $stmt->bind_param("ssd", $name, $category, $price);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    public function getMenuItemById($itemId, $conn) {
        $query = "SELECT * FROM seller WHERE Item_id = ?";
        $stmt = $conn->prepare($query);
        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }
        $stmt->bind_param("i", $itemId);
        $stmt->execute();
        $result = $stmt->get_result();
        $item = $result->fetch_assoc();
        $stmt->close();
        return $item;
    }

    public function updateMenuItem($item_id, $name, $category, $price, $conn) {
        $query = "UPDATE seller SET Name = ?, Category = ?, Price = ? WHERE Item_id = ?";
        $stmt = $conn->prepare($query);
        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }
        $stmt->bind_param("ssdi", $name, $category, $price, $item_id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    public function deleteMenuItemById($item_id, $conn) {
        $query = "DELETE FROM seller WHERE Item_id = ?";
        $stmt = $conn->prepare($query);
        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }
        $stmt->bind_param("i", $item_id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    public function getAllAvailableProducts($conn) {
        $query = "SELECT Item_id, Name, Category, Price FROM seller WHERE Price > 0";
        $result = $conn->query($query);
        if ($result === false) {
            die('Error executing the query: ' . $conn->error);
        }
        return $result;
    }

    public function registerSeller($conn, $Username, $fullname, $email, $password, $confirm_password, $position, $department, $admin_id) {
        $sql = "INSERT INTO tea (Username, fullname, email, password, confirm_password, position, department, admin_id)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            die("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param("ssssssss", 
            $Username, 
            $fullname, 
            $email, 
            $password, 
            $confirm_password, 
            $position, 
            $department, 
            $admin_id
        );

        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Verify login for 'tea' (seller) or 'customer' table
    public function verifyLogin($conn, $Username, $password, $userType) {
        $table = ($userType == 'seller') ? 'tea' : 'customerregistration';
        $sql = "SELECT * FROM $table WHERE Username = ?";

        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            die('Error preparing the statement: ' . $conn->error);
        }

        $stmt->bind_param("s", $Username);
        $stmt->execute();
        $result = $stmt->get_result();

        $user = false;
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if ($password === $row['password']) {
                $user = $row;
            }
        }

        $stmt->close();
        return $user;
    }

    
    public function registerCustomer($conn, $fullname, $username, $password, $email, $phone, $address, $payment_method, $dob, $gender) {
        $sql = "INSERT INTO customerregistration 
                (fullname, username, password, email, phone, address, payment_Method, dob, gender)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            die("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param("sssssssss", 
            $fullname, 
            $username, 
            $password, 
            $email, 
            $phone, 
            $address, 
            $payment_method, 
            $dob, 
            $gender
        );

        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }
    


}
?>
