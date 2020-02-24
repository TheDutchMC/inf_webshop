<!--
Copyright (C) 2020 Tobias de Bruijn (TheDutchMC)
-->

<div id="item-display-wrapper">
    <div class="items"  ng-repeat="crib in cribs">
        <div class="content" ng-hide="showMore$index">
            <img class="items-img" ng-src="img_store/{{crib.img_path}}.png">
            <div class="itemName"> {{crib.name}} </div>
            <div class="itemPrice"> {{crib.price | currency : "€"}} </div>
            <div class="hidden itemId"> {{crib.id}} </div>
        </div>
        <button class="button" ng-click="showMore$index = !showMore$index">More Info </button>
        <button class="addToCartBtn button" ng-click="addToCart(crib)">Add To Cart </button>
        
        <div class="moreInfo" ng-show="showMore$index"> {{crib.description}} </div>
    </div>
</div>

