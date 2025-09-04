
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
