<!DOCTYPE html>
<html>
<head>
    <title>Order History</title>
    <link rel="stylesheet" href="../view/customer.css">
</head>
<body>

    <h2>Your Order History</h2>

    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Date</th>
                <th>Items</th>
                <th>Total ($)</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody id="orderHistory">
            <!-- Sample order -->
            <tr>
                <td>#1001</td>
                <td>2025-05-22</td>
                <td>
                    - Espresso x1<br>
                    - Muffin x2
                </td>
                <td>9.00</td>
                <td>Completed</td>
            </tr>
            <!-- Additional orders will be loaded here -->
        </tbody>
    </table>

    <br>
    <a href="menu.php">← Back to Menu</a>

    <script src="../view/orderHistory.js"></script>
</body>
</html>
