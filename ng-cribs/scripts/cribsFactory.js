//Copyright (C) 2020 Tobias de Bruijn (TheDutchMC)

angular
    .module('ngCribs')
    .factory('cribsFactory', function($http) {

        function getCribs() {
            return $http.get('data/data.json');
        }

        return {
            getCribs: getCribs
        }
    });