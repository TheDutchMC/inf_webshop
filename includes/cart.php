<!--
Copyright (C) 2020 Tobias de Bruijn (TheDutchMC)
-->

<!--CSS specific for the cart-->
<link rel="stylesheet" type="text/css" href="css/cart.css">

<div class="cart-wrapper" >
    <div class="cart-items">
        <table class="cart-table">
            <tr>
                <td></td>
                <td class="item-col"><div class="item-label cart-col"> ITEM </div> </td>
                <td class="price-col"><div class="price-label cart-col"> PRICE </div> </td>
                <td class="quantity-col"> <div class="quantity-label cart-col"> QUANTITY </div></td>
            </tr>
            <!--The cart.js script will add the items into the cart here -->
        </table>
    </div>
    <div class="row total-row">
        <div class="total cart-col"> TOTAL: </div>
        <div class="total-value cart-col"></div>
    </div>
</div>

<!-- Script required for the cart-->
<script src="includes/cart.js"></script>





