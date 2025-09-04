<?php
session_start();
if (!isset($_SESSION["username"]) || $_SESSION["userType"] !== "customer") {
    header("Location: ../control/client_login.php");
    exit();
}

include "../model/db.php";
$db = new mydb();
$conn = $db->openCon();

$query = "SELECT Item_id, Name, Price FROM seller WHERE Price > 0";
$result = $conn->query($query);

$products = [];
while ($row = $result->fetch_assoc()) {
    $products[] = $row;
}

$db->closeCon($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Your Cart</title>
  <link rel="stylesheet" href="../view/seller.css">
  <style>
    .container { max-width: 900px; margin: auto; padding: 20px; }
    .cart-table { width: 100%; border-collapse: collapse; }
    .cart-table th, .cart-table td { text-align: center; }
    input[type=number] { width: 60px; }
    .checkout-button { margin-top: 20px; }
    select, button { margin: 5px; padding: 5px 10px; }
  </style>
</head>
<body>
  <div class="container">
    <header>
      <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>! Your Shopping Cart</h2>
    </header>

    <div>
      <label for="productSelector"><strong>Add Item:</strong></label>
      <select id="productSelector">
        <?php foreach ($products as $p): ?>
          <option value="<?php echo $p['Item_id']; ?>" data-name="<?php echo htmlspecialchars($p['Name']); ?>" data-price="<?php echo $p['Price']; ?>">
            <?php echo htmlspecialchars($p['Name']) . " - $" . number_format($p['Price'], 2); ?>
          </option>
        <?php endforeach; ?>
      </select>
      <button onclick="addItem()">Add to Cart</button>
    </div>

    <form id="cartForm" action="../control/cartV.php" method="POST">
      <table border="1" cellpadding="10" cellspacing="0" class="cart-table">
        <thead>
          <tr>
            <th>Item Name</th>
            <th>Price ($)</th>
            <th>Quantity</th>
            <th>Total ($)</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody id="cartItems"></tbody>
        <tfoot>
          <tr>
            <td colspan="3" align="right"><strong>Total Amount:</strong></td>
            <td id="cartTotal">$0.00</td>
            <td></td>
          </tr>
        </tfoot>
      </table>

      <div class="checkout-button" align="center">
        <input type="submit" value="Proceed to Checkout" />
      </div>
    </form>

    <br />
    <a href="client_feedback.php">Feedback Menu</a>
  </div>

  <a href="logout.php" style="float:left;">Logout</a>

  <script>
  const cartItems = {};

  function updateTotals() {
    let grandTotal = 0;
    document.querySelectorAll("#cartItems tr").forEach(row => {
      const price = parseFloat(row.querySelector(".price").dataset.price);
      const quantity = parseInt(row.querySelector("input[type='number']").value) || 0;
      const total = price * quantity;
      row.querySelector(".item-total").textContent = `$${total.toFixed(2)}`;
      grandTotal += total;
    });
    document.getElementById("cartTotal").textContent = `$${grandTotal.toFixed(2)}`;
  }

  function addItem() {
    const select = document.getElementById("productSelector");
    const selectedOption = select.options[select.selectedIndex];
    const id = selectedOption.value;
    const name = selectedOption.getAttribute("data-name");
    const price = parseFloat(selectedOption.getAttribute("data-price"));

    if (cartItems[id]) {
      alert("Item already in cart!");
      return;
    }

    cartItems[id] = true;

    const row = document.createElement("tr");
    row.setAttribute("data-id", id);
    row.innerHTML = `
      <td>${name}</td>
      <td class="price" data-price="${price}">${price.toFixed(2)}</td>
      <td>
        <input type="number" name="quantities[${id}]" value="1" min="1">
      </td>
      <td class="item-total">$${price.toFixed(2)}</td>
      <td>
        <button type="button" onclick="updateItem(this)">Update</button>
        <button type="button" onclick="deleteItem(this)">Delete</button>
      </td>
    `;
    document.getElementById("cartItems").appendChild(row);
    updateTotals();
  }

  function updateItem(source) {
    const row = source.closest("tr");
    const price = parseFloat(row.querySelector(".price").dataset.price);
    const quantityInput = row.querySelector("input[type='number']");
    let quantity = parseInt(quantityInput.value);

    if (isNaN(quantity) || quantity < 1) {
      quantity = 1;
      quantityInput.value = 1;
    }

    const total = price * quantity;
    row.querySelector(".item-total").textContent = `$${total.toFixed(2)}`;
    updateTotals();
  }

  function deleteItem(button) {
    const row = button.closest("tr");
    const id = row.getAttribute("data-id");
    delete cartItems[id];
    row.remove();
    updateTotals();
  }

  document.addEventListener("DOMContentLoaded", updateTotals);
</script>
<script src="../view/cart.js"></script>
</body>
</html>
