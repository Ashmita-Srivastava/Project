
Router.controller('LoginController', function ($scope, $http, $location,$rootScope) {

  $http.defaults.headers.post["Content-Type"] = "application/json";

    $scope.LoginDetails = { Email: '', PWD: '' };
    $scope.LoginType = 'Employee';

      localStorage.removeItem("User");
  //$rootScope.IsLoggedIn =false;

  $rootScope.ShowFootbar = false;
  $scope.Login = function () {

      console.log($rootScope.url + "/api/LoginApi.php?Email=" + $scope.LoginDetails.Email + "&PWD=" + $scope.LoginDetails.PWD);
      //return;
      //var data = $scope.LoginDetails;


    $http({
        url: $rootScope.url + "/api/LoginApi.php?Email=" + $scope.LoginDetails.Email + "&PWD=" + $scope.LoginDetails.PWD,
      method: "GET"
      //,params: data
    }).then(function (response) {
      console.log(response.data.Status);
      try {
          if (response.data.Status == 'Success') {
              console.log(response.data.Data);
              localStorage.setItem("User", angular.toJson(response.data.Data));
              $rootScope.User = response.data[0];
              $rootScope.IsLoggedIn = true;
       
              $location.url('/history');
      }
      else { alertify.error("Invalid Credentials"); }
      } catch (error) {
        alertify.error("Invalid Credentials");  
      }
      

    });
  }
});