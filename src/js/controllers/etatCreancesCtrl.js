app.controller('ModalInstanceBeatCtrl', ['$scope', '$modalInstance', 'items', function($scope, $modalInstance, items) {
  $scope.items = items;
  console.log($scope.items);

  $scope.OK = function () {
    $modalInstance.close($scope.items);
  };

  $scope.cancel = function () {
    $modalInstance.dismiss('cancel');
  };


}]);

app.controller('etatCreancesCtrl', ['$scope', '$filter', '$http', '$localStorage',
function($scope, $filter, $http, $localStorage){

  $scope.dt = {} ;
  $scope.dates = [] ;
  $scope.clients = [] ;
  $scope.recap_creances = [] ;

  $scope.role = {};

  if ($localStorage.User.role == 'ADMINISTRATEUR') {
    $scope.role.user = 'ADMINISTRATEUR';
  } else {
    $scope.role.user = 'UTILISATEUR';
  }
  
 
  $scope.today = function() {
    $scope.dt.date_debut = new Date();
    $scope.dt.date_fin = new Date();
  };
  $scope.today();


  $scope.toggleMin = function() {
    $scope.minDate = $scope.minDate ? null : new Date();
  };
  $scope.toggleMin();

  $scope.open = function($event) {
    $event.preventDefault();
    $event.stopPropagation();

    $scope.opened = true;
  };

  $scope.open2 = function($event) {
    $event.preventDefault();
    $event.stopPropagation();

    $scope.opened2 = true;
  };

  $scope.dateOptions = {
    formatYear: 'yy',
    startingDay: 1,
    class: 'datepicker'
  };

//  $scope.initDate = new Date('2016-15-20');
  $scope.formats = ['dd-MMMM-yyyy', 'yyyy/MM/dd', 'dd.MM.yyyy', 'shortDate'];
  $scope.format = $scope.formats[0];


$scope.client =  function(){

$http.get('api/pompistes.php?action=get_client').success( function(data, status, headers, config){
      $scope.clients = data ;
      console.log(data);
  })

};

$scope.client_all =  function(){

    $http.get('api/pompistes.php?action=get_client_all').success( function(data, status, headers, config){
          $scope.clients = data ;
          console.log(data);
      })
  
};

$scope.station =  function(){

  $http.get('api/pompistes.php?action=get_station').success( function(data, status, headers, config){
        $scope.stations = data ;
        console.log(data);
    })

};

$scope.station_courante =  function(){

  $scope.stations = [{id_station:$localStorage.User.id, nom_station:$localStorage.User.nom, email_station:$localStorage.User.email}];

};


$scope.creances = function(){

console.log($scope.dt);

$http.post('api/pompistes.php?action=Etats_Creances',

             {
              'creances'    :  $scope.dt,
            }

          ).success( function(data, status, headers, config){
                  
            console.log(data);

            $scope.recap_creances = data ;

                                    
            });

}

$scope.creances_station = function(){

console.log($scope.dt);

$http.post('api/pompistes.php?action=Etats_Creances_Station',

             {
              'creances'    :  $scope.dt,
            }

          ).success( function(data, status, headers, config){
                  
            console.log(data);

            $scope.recap_creances = data ;

                                    
            });

}
  


  

}]);
