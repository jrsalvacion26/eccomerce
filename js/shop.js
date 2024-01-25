function addToCart(productName, price, stock, productId) {
    // Get the existing cart items from local storage
    var cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];

    // Check if the product is already in the cart
    var existingProduct = cartItems.find(item => item.id === productId);

    if (existingProduct) {
        // Product already exists in the cart
        // You can choose to update quantity or prevent adding it again
        // For simplicity, updating quantity
        existingProduct.quantity += 1;
    } else {
        // Add the current product details to the cart items
        var productDetails = {
            id: productId,
            name: productName,
            price: price, // Pass the price here
            stock: stock,
            quantity: 1
        };

        cartItems.push(productDetails);
    }

    // Save the updated cart items to local storage
    localStorage.setItem('cartItems', JSON.stringify(cartItems));

    // Update the cart counter
    updateCartCounter();

    // Update the cart details and display
    updateCartDetails();

  
}

// Function to update cart details
function updateCartDetails() {
    var cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
    var cartTable = document.getElementById("cartTable");
    var totalAmountInput = document.getElementsByName("total_amount")[0];

    var totalAmount = 0;
    var totalQuantity = 0;

    // Clear the content of the table body
    var tbody = cartTable.getElementsByTagName('tbody')[0];
    tbody.innerHTML = '';

    cartItems.forEach(item => {
        if (item.quantity <= item.stock) {
            // Create a new row for each item
            var row = tbody.insertRow();

            // Fill the row cells with item details
            row.innerHTML = `
            <input type="hidden" name="product_id[]" value="${item.id}">
            
                <td>${item.name}</td>
                <td>${item.price}</td>
                <td>${item.price * item.quantity}</td>
                <td>${item.stock}</td>
                <td>
                    <input type="number" min="1" max="${item.stock}" name="quantity[]" value="${item.quantity}" 
                        data-product="${item.name}" onchange="changeQuantity('${item.name}', this.value)">
                </td>
                <td><button onclick="deleteItem('${item.name}')" class="btn btn-danger">Delete</button></td>
            `;

            totalAmount += item.price * item.quantity;
            totalQuantity += item.quantity;
        } else {
            // If quantity exceeds stock, display a warning row
            var warningRow = tbody.insertRow();
            warningRow.innerHTML = `<td colspan="6">${item.name} - <span style="color: red;">Quantity exceeds stock!</span> <button onclick="deleteItem('${item.name}')">Delete</button></td>`;
        }
    });

    // Set the total amount in the total_amount input field
    totalAmountInput.value = totalAmount;
}


updateCartDetails()


function changeQuantity(productName, newQuantity) {
    // Retrieve the cart data from local storage
    var cartData = localStorage.getItem('cartItems');

    // Parse the cart data as an array or set a default empty array
    var cartItems = cartData ? JSON.parse(cartData) : [];

    // Get the current item by product name
    var currentItem = cartItems.find(item => item.name === productName);

    // Update the quantity of the item
    currentItem.quantity = parseInt(newQuantity);

    // Update the local storage with the modified cart items
    localStorage.setItem('cartItems', JSON.stringify(cartItems));

    // Re-render the cart display
    updateCartDetails();
}



// Function to handle delete button click
function deleteItem(productName) {
    // Get the existing cart items from local storage
    var cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];

    // Find the index of the item to be deleted
    var index = cartItems.findIndex(item => item.name === productName);

    if (index !== -1) {
        // Remove the item from the cartItems array
        cartItems.splice(index, 1);

        // Save the updated cart items to local storage
        localStorage.setItem('cartItems', JSON.stringify(cartItems));

        // Update the cart counter
        updateCartCounter();

        // Update the cart details and display
        updateCartDetails();
    }
}



// Update the cart counter and display cart details when the page loads
window.onload = function() {
    // Update the cart details on page load
    updateCartDetails();
};

document.addEventListener("DOMContentLoaded", function () {
    var cart = document.getElementById("cart");
    var addToCartBox = document.getElementById("add-to-cart-box");

    cart.addEventListener("click", function () {
        if (addToCartBox.style.opacity === "0" || addToCartBox.style.opacity === "") {
            addToCartBox.style.display = "block";
            setTimeout(function () {
                addToCartBox.style.opacity = "1";
            }, 10);
        } else {
            addToCartBox.style.opacity = "0";
            setTimeout(function () {
                addToCartBox.style.display = "none";
            }, 300);
        }
    });
});


function updateCartCounter() {
    var cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
    var cartCounter = cartItems.reduce((total, item) => total + item.quantity, 0);
    document.getElementById('cart-counter').innerText = cartCounter;
}


function handleCartFormSubmit(event) {
    event.preventDefault();
    alert("Form submitted!");
}



function submitOrder() {
    // Your order submission logic goes here

    // Clear the cartItems from localStorage after submitting the order
    localStorage.removeItem('cartItems');

    // Redirect or display a success message after order submission
    window.location.href = 'shop.php';

    updateCartDetails()

}



 // Function to toggle the active state of the dropdown button
 function toggleDropdown() {
    var dropdownButton = document.querySelector('.dropdown-button');
    dropdownButton.classList.toggle('active');
}




