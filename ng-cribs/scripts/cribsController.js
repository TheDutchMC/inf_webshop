//Copyright (C) 2020 Tobias de Bruijn (TheDutchMC)

var items = [];

var data;
angular
    .module('ngCribs')
    .controller('cribsController', function($scope, cribsFactory) {
        $scope.cribs;

        cribsFactory.getCribs().then(function(response) {
            data = response.data;
            $scope.cribs = response.data;

        }).catch(function(response) {
            console.log(response.status);
        });

        $scope.addToCart = function(crib) {
            var imgSrc = crib.img_path;
            var item = crib.name;
            var price = crib.price;
            addToCartClicked(imgSrc, item, price);
        }
    });