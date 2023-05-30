
Router.controller('SearchController', function ($scope, $http, $location, $rootScope) {

    $http.defaults.headers.post["Content-Type"] = "application/json";
    $rootScope.ShowNavBar = true;
    $rootScope.ShowFootbar = true;
    $scope.Keyword = "";
    $rootScope.PIDs = [];
    $scope.Category = ''; $scope.SpecialCB = null;
    //localStorage.removeItem("PIDs");

    if (localStorage.getItem("PIDs")) { $rootScope.PIDs = angular.fromJson(localStorage.getItem("PIDs")); }

    $scope.ToggleSelection = function (Product) {

       
        if ($rootScope.PIDs.includes(Product.PID)) {
            
            $rootScope.PIDs.splice($rootScope.PIDs.indexOf(Product.PID), 1);
            $rootScope.SelectedProducts.forEach(SelectedProduct => {
                if(SelectedProduct.PID == Product.PID )
                {
                    $rootScope.SelectedProducts.splice($rootScope.SelectedProducts.indexOf(SelectedProduct),1);
                }
               
           });
        }
        else {
            $rootScope.PIDs.push(Product.PID);
            $rootScope.SelectedProducts.push(Product);
        }


        localStorage.setItem("PIDs", angular.toJson($rootScope.PIDs));
        console.log($rootScope.PIDs);

        //$rootScope.SelectedProducts = [];




    }
    $scope.ToggleCategory = function () {

        if ($scope.CategoryCB) $scope.Category = 'Non';
        else $scope.Category = 'Veg';
        console.log($scope.Category);
    }
    $scope.ToggleRecommended = function (x) {

        $scope.Recommended = $scope.SpecialCB;
        if (!$scope.Recommended) $scope.Recommended = '';
        console.log($scope.Recommended);
    }



});