Router.controller('EmployeeAttendenceController', function ($scope, $http, $location, $rootScope, $interval) {
    $http.defaults.headers.post["Content-Type"] = "application/json";
    $rootScope.ShowNavBar = true;
    $rootScope.ShowFootbar = true;
    $scope.Records = [];
    $scope.Attendence = {Mobile:'9988998899',PWD: 'aa',Lat:'0',Long:'0'};

    $scope.Date = new Date().toLocaleDateString('en-CA');
    


    $scope.GetHistoryOnDate = function (dt) {
        $http({
            url: $rootScope.url + "/api/GetTodayAttendence.php",
            method: "GET"
            //params: data
        }).then(function (response) {
            console.log(response);
            $scope.Records = response.data;
        });
    }

    $scope.Load = function () {

        //$scope.GetHistoryOnDate($scope.Date);
    }
    $scope.Load();


    $scope.MarkAttendence = function (EID) {
        if (!confirm('Are you Sure')) return;
       
        const dt = new Date().toLocaleDateString('en-CA');
        var url = $rootScope.url + "/api/SaveEmployeeLocation.php?Mobile=" + $scope.Attendence.Mobile + "&PWD=" + $scope.Attendence.PWD + "&Date=" + dt + "&Lat=" + $scope.Attendence.Lat + "&Long=" + $scope.Attendence.Long;

        console.log(url);
        
        $http({
            url: url,
            method: "GET"
            //params: data
        }).then(function (response) {
            if (response.data == 'Success') {
                alertify.success("Attendance Marked");
            }
            else {
                alertify.error(response.data);
            }
            
            //$scope.GetHistoryOnDate($scope.Date);

        });
        
    }

    $scope.getLocation = function () {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            x.innerHTML = "Geolocation is not supported by this browser.";
        }
    }

    function showPosition(position) {
        //console.log("Latitude: " + position.coords.latitude + "<br>Longitude: " + position.coords.longitude);

        $scope.$apply(() => {
            $scope.Attendence.Lat = position.coords.latitude;
            $scope.Attendence.Long = position.coords.longitude;
            $scope.Attendence.Location = $scope.Attendence.Lat + ", " + $scope.Attendence.Long;
        });
       
    }
   

});
