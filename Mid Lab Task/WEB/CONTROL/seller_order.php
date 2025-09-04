<!DOCTYPE html>
<html>
<head>
    <title>Customer Orders</title>
    <link rel="stylesheet" href="../view/owner.css">
</head>
<body>

    <h2>Customer Orders</h2>

    <!-- Orders Table -->
    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Customer Name</th>
                <th>Items</th>
                <th>Total Price ($)</th>
                <th>Order Time</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="orderList">
            <tr>
                <td>101</td>
                <td>John Doe</td>
                <td>
                    - Cappuccino x1<br>
                    - Brownie x2
                </td>
                <td>12.50</td>
                <td>2025-05-23 11:42 AM</td>
                <td>Pending</td>
                <td>
                    <form action="../control/updateOrderStatus.php" method="POST">
                        <input type="hidden" name="order_id" value="101">
                        <select name="status">
                            <option value="Pending" selected>Pending</option>
                            <option value="Prepared">Prepared</option>
                            <option value="Completed">Completed</option>
                        </select>
                        <input type="submit" value="Update">
                    </form>
                </td>
            </tr>
            <!-- More orders would go here -->
        </tbody>
    </table>

    <script src="../view/orders.js"></script>
</body>
</html>
