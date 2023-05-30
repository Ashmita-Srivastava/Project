Router.controller('SignupController', function ($scope, $http, $location, Shared, $rootScope) {
    $http.defaults.headers.post["Content-Type"] = "application/json";
    $rootScope.ShowFootbar = false;

    $scope.User = { UserName: "Test", Email: "test@gmail.com", Mobile: "7788776677", PWD: "aa", Gender: "Male",DOB:new Date(),Address:'Mera Ghar' };
    $scope.CreateUser = function () {

       //alert($rootScope.url + "api/users/Create");
        
        $http({
            url: $rootScope.url + "api/users/Create",
            method: "POST",
            params: $scope.User
          }).then(function (response) {
            console.log(response.data);
            if (response.data.UID) {
               
                // localStorage.setItem("User", JSON.stringify(response.data));
                
                alertify.alert("Profile Created .. Proceed to login",function(){
                    location.href = "#!login";
                });
                
            
            }
            else { alertify.error(response.data.Message); }

        }, "JSON");


    }

});