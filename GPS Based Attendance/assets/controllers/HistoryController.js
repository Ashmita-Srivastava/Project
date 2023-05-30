Router.controller('HistoryController', function ($scope, $http, $location, $rootScope, $interval) {
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
            url: $rootScope.url + "/api/GetHistory.php?Date=" + dt,
            method: "GET"
            //params: data
        }).then(function (response) {
            console.log(response);
            $scope.Records = response.data;
        });
    }

    $scope.Load = function () {

        $scope.GetHistoryOnDate($scope.Date);
    }
    $scope.Load();
    $scope.Change = function () {

        
        $scope.GetHistoryOnDate(new Date($scope.Date).toLocaleDateString('en-CA'));

    }
   

    $scope.Change(new Date().toLocaleDateString('en-CA'));
    


    



    //$scope.SetStatus = function (OID, Status, Index) {
    //    var data = { Status: Status, OID: OID };
    //    console.log(data);
    //    if (!confirm("Are You Sure")) { return; }
    //    $http({
    //        url: $rootScope.url + "/api/SetOrderStatus",
    //        method: "POST",
    //        params: data
    //    }).then(function (response) {

    //        $scope.Orders[Index].Status = Status;

    //        console.log($scope.Orders);
    //    });
    //};
});
