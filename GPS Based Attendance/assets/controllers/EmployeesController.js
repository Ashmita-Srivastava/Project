Router.controller('EmployeesController', function ($scope, $http, $location, $rootScope) {
    $http.defaults.headers.post["Content-Type"] = "application/json";

    $scope.Records = [];
    $scope.Employee = { EID: 0, Profile: 'SalesMan' };
    $scope.Lat = 0;
    $scope.Long = 0;


    $scope.Load = function () {
        
        $http({
            url: $rootScope.url + "/api/GetEmployees.php",
            method: "GET"
            //,params: data
        }).then(function (response) {
            
            $scope.Records = response.data;
            console.log($scope.Records);
        });

    }
       
    $scope.Load();
   
    $scope.Save = function () {
        console.log($scope.Employee);
        console.log($rootScope.url + "/api/SaveEmployee.php?EmployeeName=" + $scope.Employee.EmployeeName + "&Profile=" + $scope.Employee.Profile + "&Mobile=" + $scope.Employee.Mobile + "&PWD=" + $scope.Employee.PWD);

        $http({
            url: $rootScope.url + "/api/SaveEmployee.php?EmployeeName=" + $scope.Employee.EmployeeName + "&Profile=" + $scope.Employee.Profile + "&Mobile=" + $scope.Employee.Mobile + "&PWD=" + $scope.Employee.PWD,
            method: "GET"
            //,params: data
        }).then(function (response) {
            if (response.data.Status == 'Success') {

                alertify.success("Employee Added");
                $scope.Employee = { EID: 0, Profile: 'SalesMan' };
                $scope.Load();
                $('#EmployeeModal').modal('hide');
            }
            else { alert(response.data.Message); }

        });

    }
    $scope.Delete = function (Employee,Index) {
        console.log(Employee, Index);
        if (!confirm('Are you Sure?')) return;
        
        
        $http({
            url: $rootScope.url + "/api/DeleteEmployee.php?EID=" + Employee.EID,
            method: "GET"
            //,params: data
        }).then(function (response) {
            if (response.data == 'Success') {
                
                $scope.Records.splice(Index, 1);
                alertify.error('Record Deleted');

            }
            else { console.log(response.data.Message); }
            
        });

    }


    

});
