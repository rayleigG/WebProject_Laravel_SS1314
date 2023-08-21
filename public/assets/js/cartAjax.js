const getCartItems = () => {
    const xhr = new XMLHttpRequest();
    xhr.responseType = 'json';
    xhr.open('GET', '/cart-ajax', true);
    xhr.onload = () => {
        if (xhr.status === 200) {
            const cartItems = xhr.response;
            updateCartItemsWithProductInfo(cartItems);
        }
    }
    xhr.send();
}
const updateCartItemsWithProductInfo = (cartItems) => {
    const cartItemsBody = document.getElementById('cart-items-body');
    cartItemsBody.innerHTML = ''; // Clear previous items
    let totalAmount = 0;
    let cart_count = 0;
    if (cartItems.productsInCart.length > 0) {
        cartItems.productsInCart.forEach(cartItem => {
            const productXhr = new XMLHttpRequest();
            productXhr.responseType = 'json';
            productXhr.open('GET', `/get-product-info?product_id=${cartItem.product_id}`, true);
            productXhr.onload = () => {
                if (productXhr.status === 200) {
                    const response = productXhr.response;
                    if (response.productInfo) {
                        const productInfo = response.productInfo;
                        totalAmount += parseFloat(cartItem.quantity * productInfo.price);
                        cart_count += parseInt(cartItem.quantity);
                        // Create a new row for the cart item
                        const newRow = document.createElement('tr');
                        newRow.innerHTML = `
                            <td>
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <img src="image/product/thumbnail/${productInfo.img}" alt="Product Image" width="40px" height="40px">
                                    </div>
                                    <div class="col">
                                        <h6>${productInfo.pname}</h6>
                                    </div>
                                </div>
                            </td>
                            <td class="align-items-center justify-content-center">${cartItem.quantity}</td>
                            <td class="align-items-center justify-content-center">${'$' + parseFloat(productInfo.price).toFixed(2)}</td>
                            <td class="align-items-center justify-content-center">${'$' + parseFloat(cartItem.quantity * productInfo.price).toFixed(2)}</td>
                            <td class="align-items-center justify-content-center">
                                <a onclick="removeProductFromCart(${cartItem.cart_id}, ${cartItem.product_id})" style="cursor:pointer; color:red">
                                     <i class="fas fa-trash-alt"></i>
                                </a>                        
                            </td>
                        `;

                        // Append the new row to the table body
                        cartItemsBody.appendChild(newRow);
                        const taxRate = 0.1;
                        const shippingRate = 0.05;
                        const taxAmount = totalAmount * taxRate;
                        const shippingCost = totalAmount * shippingRate;
                        console.log(cart_count);
                        // Update tax and shipping cost elements
                        document.getElementById('cart_count').textContent = cart_count;
                        document.getElementById('subtotal').textContent = `Subtotal: $${totalAmount.toFixed(2)}`;
                        document.getElementById('total_to_pay').value = (totalAmount + shippingCost + taxAmount).toFixed(2);
                        document.getElementById('tax_amount').textContent = `Tax amount: $${taxAmount.toFixed(2)}`;
                        document.getElementById('shipping_cost').textContent = `Shipping Cost: $${shippingCost.toFixed(2)}`;
                        document.getElementById('total_amount').textContent = `Total amount: $${(totalAmount + shippingCost + taxAmount).toFixed(2)}`;
                    } else {
                        console.log('Product not found');
                    }
                }
            };
            productXhr.send();
        });
        // Calculate tax and shipping cost based on the final totalAmount
    } else {
        setTimeout(() => {
            window.location.reload();
        }, 0); // Adjust the delay as needed
    }
};
const removeProductFromCart = (cart_id, product_id) => {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    const xhr = new XMLHttpRequest();
    xhr.open('POST', '/removeProductFromCart', true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken); // Add this line
    xhr.onload = () => {
        if (xhr.status === 200) {
            $('#cart-items-body').fadeOut(200, function () {
                getCartItems();
                $('#cart-items-body').fadeIn(200);
            });

            $('#check-out').fadeOut(200, function () {
                updateTaxAndShipping();
                $('#check-out').fadeIn(200);
            });

        } else {
            console.log('Something went wrong!');
        }
    }
    const data = JSON.stringify({
        cartID: cart_id,
        p_id: product_id
    });
    xhr.send(data);
}
const updateTaxAndShipping = () => {
    const totalAmountElement = document.getElementById('total_amount');
    const taxAmountElement = document.getElementById('tax_amount');
    const shippingCostElement = document.getElementById('shipping_cost');

    // Calculate tax and shipping cost based on the updated totalAmount
    const taxRate = 0.1;
    const shippingRate = 0.05;
    const totalAmount = parseFloat(totalAmountElement.textContent);
    const taxAmount = totalAmount * taxRate;
    const shippingCost = totalAmount * shippingRate;

    // Update tax and shipping cost elements
    totalAmountElement.textContent = `Total amount: $${(totalAmount + taxAmount + shippingCost).toFixed(2)}`
    taxAmountElement.textContent = `Tax amount: $${taxAmount.toFixed(2)}`;
    shippingCostElement.textContent = `Shipping Cost: $${shippingCost.toFixed(2)}`;
};
// Call the initial function to start the process
getCartItems();


