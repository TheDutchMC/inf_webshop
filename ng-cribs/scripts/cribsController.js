//Copyright (C) 2020 Tobias de Bruijn (TheDutchMC)

var items = [];

var loaded = false;

angular
    .module('ngCribs')
    .controller('cribsController', function($scope, cribsFactory) {
        $scope.cribs;
        cribsFactory.getCribs().then(function(response) {
            $scope.cribs = response.data;
        }).catch(function(response) {
            console.log(response.status);
        });

        $scope.finishedLoading = function() {
            if(!loaded) {
                loaded = true;
                ready();
            }
        }

        $scope.addToCart = function(crib) {
            var imgSrc = crib.img_path;
            var item = crib.name;
            var price = crib.price;
            addToCartClicked(imgSrc, item, price);
        }
    });