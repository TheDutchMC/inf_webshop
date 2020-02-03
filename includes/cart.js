//Copyright (C) 2020 Tobias de Bruijn (TheDutchMC)
var currency = '€';

$(document).ready(function() {
    ready()
});

function ready() {

    var showCartBtn = document.getElementsByClassName('showCartButton');
    var cartWrappers = document.getElementsByClassName('cart-wrapper');

    //On script load, hide the cart
    for(var i = 0; i < cartWrappers.length; i++) {
        var cartWrapper = cartWrappers[i];
        hideCart(cartWrapper);
    }

    //Loop through every button which can be pressed to display the cart
    for(var i = 0; i < showCartBtn.length; i++) {
        var btn = showCartBtn[i];

        //Add a listener to the button for the click event
        btn.addEventListener('click', function() {

            //loop through all the carts, and toggle their visibility
            for(var j = 0; j < cartWrappers.length; j++) {
                var cartWrapper = cartWrappers[j];
            
                if(cartWrapper.style.display === "none") {
                    showCart(cartWrapper);
                } else {
                    hideCart(cartWrapper);
                }
            }
        })
    }

    //Add the listener to the quantity field, if the content is changed, call the appropriate function
    var quantityInputs = document.getElementsByClassName('qtyInput');
    for(var i = 0; i < quantityInputs.length; i++) {
        var input = quantityInputs[i];

        input.addEventListener('change', quantityChanged);
    }

    //Add the listener to the remove button, if pressed remove the entry from the shopping cart
    var removeBtns = document.getElementsByClassName('remove-button');
    for(var i = 0; i < removeBtns.length; i++) {
        var removeBtn = removeBtns[i];

        removeBtn.addEventListener('click', removeFromCart);
    }
}

//Remove an item from the cart
function removeFromCart(event) {
    var buttonClicked = event.target;
    buttonClicked.parentElement.parentElement.remove();
    updateTotal();
}

//Add an item to the cart, this gets called from cribsController.js
function addToCartClicked(imgSrc, item, price) {
    
    var cartItemNames = document.getElementsByClassName('item');
    for(var i = 0; i < cartItemNames.length; i++) {
        if(cartItemNames[i].innerText == item) {
            openPopup("This item is already in your cart!");
            return;
        }
    }

    var img_path = '/img_store/' + imgSrc + '.png';

    addItemToCart(img_path, item, price);
}

//Add the item to the cart
function addItemToCart(img_path, item, price) {
    var cartRow = document.createElement('tr');
    cartRow.classList.add('item-row');
    var cartTable = document.getElementsByClassName('cart-table')[0];

    var priceWithCurrency = currency + price;

    var cartRowContent = `
        <td class="image-col cart-col"><img class="cart-img" src="${img_path}" alt="Unable to load image!"></img></td>
        <td class="item-col cart-col"><div class="item"> ${item}</div></td>
        <td class="price-col cart-col"><div class="price"> ${priceWithCurrency} </div></td>
        <td class="quantity-col cart-col"><input class="qtyInput" type="text" text="1"></input></td>
        <td class="remove-col cart-col"><button class="remove-button"> REMOVE </button></td>
    `;

    cartRow.innerHTML = cartRowContent;
    cartTable.append(cartRow);
    cartRow.getElementsByClassName('qtyInput')[0].addEventListener('change', quantityChanged);
    cartRow.getElementsByClassName('remove-button')[0].addEventListener('click', removeFromCart);

    cartRow.getElementsByClassName('qtyInput')[0].value = 1;
    updateTotal();

    toBackend("addToCart", price, 1, item);
    }

//Check if the new quantity is a valid number, then update the total
function quantityChanged(event) {
    var input = event.target;
    if(isNaN(input.value) || input.value <= 0) {
        input.value = 1;
    }
    updateTotal();
}

//Uodate the total value.
function updateTotal() {
    var itemRows = document.getElementsByClassName('item-row');

    var total = 0;

    if(itemRows.length != 0) {
        for(var i = 0; i < itemRows.length; i++) {
            var itemRow = itemRows[i];
            var priceElement = itemRow.getElementsByClassName('price')[0];
            var price = parseFloat(priceElement.innerHTML.replace(currency, ''));
    
            var quantityElement = itemRow.getElementsByClassName('qtyInput')[0];
            var quantity = quantityElement.value
    
            total += price*quantity;
    
            var cartTotal = document.getElementsByClassName('total-value')[0];
            cartTotal.innerText = currency + total;
        }
    }
    //Need to this because sometimes it will multiply weird, e.g it'll round to 10 decimals.
    total = Math.round(total * 100) / 100

    var totalElement = document.getElementsByClassName('total-value')[0].innerText = currency + total;
}

function hideCart(cartWrapper) {
    $(".cart-wrapper").fadeOut(100);
}

function showCart(cartWrapper) {
    $(".cart-wrapper").fadeIn(100);
}

function toBackend(goal, price, qty, item) {

    var userEntity = {};
    userEntity = JSON.parse(sessionStorage.getItem('userEntity'));

    var userid = userEntity.id;

    console.log(userid);

    $.ajax({
        method: "POST",
        url: "php/backend_rec.php",
        data: {
            'goal': goal,
            'userid': userid,
            'item': item,
            'qty': qty,
            'price': price
        }
    }).done(function(msg) {
        console.log("Callback \n" + msg);
    });
}