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
  
  app.controller('etatLubrifiantsCtrl', ['$scope', '$filter', '$http','$localStorage',
  function($scope, $filter, $http, $localStorage){
  
    $scope.dt = {} ;
    $scope.dates = [] ;
    $scope.recap_ventesCarb = [] ;
    $scope.recap_ventesLub = [] ;
    $scope.recap_versement = [] ;
    $scope.recap = [] ;
    $scope.pompistes = [] ;
  
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
  
  /*
    $scope.clear = function () {
      $scope.date_debut = null;
      $scope.date_fin = null;
    };
  
    
    $scope.disabled = function(date, mode) {
      return ( mode === 'day' && ( date.getDay() === 0 || date.getDay() === 6 ) );
    };
  */
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
  
  /**************************************************************************************************************** */
  
  
   $scope.quarts = [{quart:'QUART 1'},{quart:'QUART 2'},{quart:'JOURNEE ENTIERE'}];
   $scope.stations = [];
  /***************************************************************************************************************/      
  
  
  $scope.station =  function(){
  
  $http.get('api/pompistes.php?action=get_station').success( function(data, status, headers, config){
        $scope.stations = data ;
        console.log(data);
    })
  
  };
  
  $scope.station_courante =  function(){
  
    $scope.stations = [{id_station:$localStorage.User.id, nom_station:$localStorage.User.nom, email_station:$localStorage.User.email}];
  
  };
  
  
  $scope.ventes = function(){
  
  console.log($scope.dt) ;
  
  $http.post('api/pompistes.php?action=Etats_Ventes_Lub',
  
               {
                'ventes'    :  $scope.dt,
              }
  
            ).success( function(data, status, headers, config){
                    
              console.log(data) ;
  
              $scope.recap_ventes = data ;
  
                                      
              });
  
  }
  
  
  
  $scope.date = function(){
  
  console.log($scope.dt);
  
  $http.post('api/pompistes.php?action=Get_dates',
  
               {
                'date'    :  $scope.dt,
              }
  
            ).success( function(data, status, headers, config){
                    
              console.log(data);
  
              $scope.dates = data ;
  
                                      
              });
  
  }

  $scope.stock = function(){

    console.log($scope.dt);
  
   $http.post('api/pompistes.php?action=Etats_Stock_Lubrifiant',
  
                 {
                  'stocks'    :  $scope.dt,
                }
  
              ).success( function(data, status, headers, config){
                      
                console.log(data);
  
                $scope.recap_stock = data ;
  
                                        
                });
  
  }
    
  
  
    
  
  }]);
  