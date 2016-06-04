<script>

    var app = angular.module('myApp', []);
    app.controller('myCtrl', function($scope) {
        $scope.tresc= "Warunek wyszukiwania";


        $scope.radio1= function () {
            $scope.tresc= "ID rezerwacji pokoju";

        }

        $scope.radio2= function () {
            $scope.tresc= "Nazwisko";

        }

    });
</script >