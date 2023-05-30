Router.controller('AttendenceController', function ($scope, $http, $location, $rootScope, $interval) {
    $http.defaults.headers.post["Content-Type"] = "application/json";
    $rootScope.ShowNavBar = true;
    $rootScope.ShowFootbar = true;
    $scope.Records = [];
    $scope.Date = new Date().toLocaleDateString('en-CA');
    
    console.log(new Date());
    console.log(new Date().toLocaleDateString('en-CA'));
    //console.log(new Date());
    $scope.GetHistoryOnDate = function (dt) {
        $http({
            url: $rootScope.url + "/api/GetTodayAttendence.php",
            method: "GET",
            async: false
        }).then(function (response) {
            console.log(response.data);
            $scope.Records = response.data;
        });
    }

    $scope.Load = function () {

        $scope.GetHistoryOnDate($scope.Date);
    }
    $scope.Load();
    $scope.MarkAttendence = function (EID) {
        if (!confirm('Are you Sure')) return;


        const dt = new Date().toLocaleDateString('en-CA');
        $http({
            url: $rootScope.url + "/api/MarkAttendence.php?EID=" + EID + "&Date=" + dt,
            method: "GET"
            //params: data
        }).then(function (response) {
            console.log(response.data);
            alertify.success("Attendance Marked");
            $scope.GetHistoryOnDate($scope.Date);

        });
        
    }

});
