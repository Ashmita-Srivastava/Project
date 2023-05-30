
Router.controller('SuggestedController', function ($scope, $http, $location, $rootScope) {

    $http.defaults.headers.post["Content-Type"] = "application/json";
    $rootScope.ShowNavBar = true;
    $rootScope.ShowFootbar = true;
    $scope.Keyword = "";
    $rootScope.PIDs = [];
    $scope.Category = '';
    
    
    //localStorage.removeItem("PIDs");

    


   
    if (localStorage.getItem("PIDs")) { $rootScope.PIDs = angular.fromJson(localStorage.getItem("PIDs")); }
    //console.log($rootScope.PIDs);

    $scope.ToggleSelection = function (Product) {

        console.log($rootScope.PIDs);
        if ($rootScope.PIDs.includes(Product.PID)) {
            $rootScope.PIDs.splice($rootScope.PIDs.indexOf(Product.PID), 1);

        }
        else {
            $rootScope.PIDs.push(Product.PID);
        }


        localStorage.setItem("PIDs", angular.toJson($rootScope.PIDs));
        console.log($rootScope.PIDs);

        $rootScope.SelectedProducts = [];
        $rootScope.Products.forEach(Product => {
            if ($rootScope.PIDs.includes(Product.PID)) $rootScope.SelectedProducts.push(Product);
        });



    }




   

});