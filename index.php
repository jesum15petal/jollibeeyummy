<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Sari-sari Store Inventory System</title>


<style>
body {
    font-family: Arial, sans-serif;
    background: #fff;
    color: #000;
    margin: 20px;
}

h1 {
    text-align: center;
}

.container {
    max-width: 900px;
    margin: auto;
}

form {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 10px;
    margin-bottom: 20px;
}

input, button {
    padding: 10px;
    border: 1px solid #000;
    background: #fff;
    color: #000;
}

button {
    cursor: pointer;
    transition: 0.3s;
}

button:hover {
    background: #000;
    color: #fff;
}

table {
    width: 100%;
    border-collapse: collapse;
}

table, th, td {
    border: 1px solid #000;
}

th, td {
    padding: 10px;
    text-align: center;
}

.actions button {
    margin: 2px;
}
</style>
</head>

<body>

<div class="container">
    <h1>Sari-sari Store Inventory System</h1>

    <form id="productForm">
        <input type="text" id="productName" placeholder="Product Name" required>
        <input type="number" id="price" placeholder="Price" required>
        <input type="text" id="category" placeholder="Category" required>
        <input type="number" id="stock" placeholder="Stock" required>
        <button type="submit">Add</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Category</th>
                <th>Stock</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="productTable"></tbody>
    </table>
</div>

<script>
let products = [];
let editIndex = -1;

const form = document.getElementById("productForm");
const table = document.getElementById("productTable");

form.addEventListener("submit", function(e) {
    e.preventDefault();

    const product = {
        id: editIndex === -1 ? Date.now() : products[editIndex].id,
        name: document.getElementById("productName").value,
        price: document.getElementById("price").value,
        category: document.getElementById("category").value,
        stock: document.getElementById("stock").value
    };

    if (editIndex === -1) {
        products.push(product);
    } else {
        products[editIndex] = product;
        editIndex = -1;
    }

    form.reset();
    displayProducts();
});

function displayProducts() {
    table.innerHTML = "";

    products.forEach((product, index) => {
        table.innerHTML += `
            <tr>
                <td>${product.id}</td>
                <td>${product.name}</td>
                <td>${product.price}</td>
                <td>${product.category}</td>
                <td>${product.stock}</td>
                <td class="actions">
                    <button onclick="editProduct(${index})">Edit</button>
                    <button onclick="deleteProduct(${index})">Delete</button>
                </td>
            </tr>
        `;
    });
}

function editProduct(index) {
    const product = products[index];s

    document.getElementById("productName").value = product.name;
    document.getElementById("price").value = product.price;
    document.getElementById("category").value = product.category;
    document.getElementById("stock").value = product.stock;

    editIndex = index;
}

function deleteProduct(index) {
    if (confirm("Delete this product?")) {
        products.splice(index, 1);
        displayProducts();
    }
}
</script>

</body>
</html>