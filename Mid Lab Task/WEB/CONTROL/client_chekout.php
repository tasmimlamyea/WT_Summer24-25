<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    
    <link rel="stylesheet" href="../view/checkout.css">
</head>
<body>
    <div class="container">
        <header>
            <h2>Checkout Summary</h2>
        </header>

        <form id="checkoutForm" action="../control/placeOrder.php" method="POST">
            <div class="checkout-section">
                <h3>Order Items</h3>
                <table class="cart-table">
                    <thead>
                        <tr>
                            <th>Item Name</th>
                            <th>Price ($)</th>
                            <th>Quantity</th>
                            <th>Total ($)</th>
                        </tr>
                    </thead>
                    <tbody id="checkoutItems">
                        <tr>
                            <td>Cappuccino</td>
                            <td>3.50</td>
                            <td>2</td>
                            <td>7.00</td>
                        </tr>
                        <tr>
                            <td>Espresso</td>
                            <td>2.80</td>
                            <td>1</td>
                            <td>2.80</td>
                        </tr>
                        <tr>
                            <td>Latte</td>
                            <td>4.00</td>
                            <td>3</td>
                            <td>12.00</td>
                        </tr>
                        <tr>
                            <td>Mocha</td>
                            <td>4.50</td>
                            <td>1</td>
                            <td>4.50</td>
                        </tr>
                        <tr>
                            <td>Black Tea</td>
                            <td>2.00</td>
                            <td>2</td>
                            <td>4.00</td>
                        </tr>
                        <tr>
                            <td>Green Tea</td>
                            <td>2.20</td>
                            <td>1</td>
                            <td>2.20</td>
                        </tr>
                        <tr>
                            <td>Chai Latte</td>
                            <td>3.00</td>
                            <td>2</td>
                            <td>6.00</td>
                        </tr>
                        <tr>
                            <td>Hot Chocolate</td>
                            <td>3.80</td>
                            <td>1</td>
                            <td>3.80</td>
                        </tr>
                        <tr>
                            <td>Americano</td>
                            <td>2.50</td>
                            <td>3</td>
                            <td>7.50</td>
                        </tr>
                        <tr>
                            <td>Flat White</td>
                            <td>3.60</td>
                            <td>1</td>
                            <td>3.60</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" align="right"><strong>Grand Total:</strong></td>
                            <td id="grandTotal">$52.40</td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div class="checkout-section">
                <h3>Delivery Information</h3>
                <table class="info-table">
                    <tr>
                        <td><label for="delivery_address">Delivery Address:</label></td>
                        <td>
                            <input type="text" name="delivery_address" id="delivery_address" required>
                            <div class="error" id="addressErr"></div>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="payment_method">Payment Method:</label></td>
                        <td>
                            <select name="payment_method" id="payment_method">
                                <option value="card">Credit Card</option>
                                <option value="cash">Cash on Delivery</option>
                                <option value="paypal">PayPal</option>
                            </select>
                            <div class="error" id="paymentErr"></div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center">
                            <input type="submit" value="Place Order" class="btn-submit">
                        </td>
                    </tr>
                </table>
            </div>
        </form>

        <div class="navigation">
            <a href="client_cart.php" class="btn-back">← Back to Cart</a>
        </div>
    </div>

    <script src="../view/checkout.js"></script>
</body>
</html>