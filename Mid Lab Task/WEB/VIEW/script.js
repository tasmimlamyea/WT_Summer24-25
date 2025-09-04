function editItem(id, name, category, price) {
    document.getElementById('editForm').style.display = 'block';
    document.getElementById('edit_id').value = id;
    document.getElementById('edit_name').value = name;
    document.getElementById('edit_category').value = category;
    document.getElementById('edit_price').value = price;
}
