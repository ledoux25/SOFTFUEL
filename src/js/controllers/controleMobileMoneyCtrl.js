
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
  
  app.controller('controleMobileMoneyCtrl', ['$scope', '$filter', '$http','$localStorage',
  function($scope, $filter, $http, $localStorage){
  
    $scope.dt = {} ;
    $scope.dates = [] ;
    $scope.recap_versement = [] ;
    $scope.recap_versement_me = [] ;
    $scope.recap = [] ;
  
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
  
  $scope.versement = function(){
  
  console.log($scope.dt);
  
  $http.post('api/pompistes.php?action=Etats_Versements',
  
               {
                'versement'    :  $scope.dt,
              }
  
            ).success( function(data, status, headers, config){
                    
              console.log(data);
  
              $scope.recap_versement = data ;
  
                                      
              });
  
  }

  $scope.versement_me = function(){
  
    console.log($scope.dt);
    
    $http.post('api/pompistes.php?action=Etats_Versements_ME',
    
                 {
                  'versement'    :  $scope.dt,
                }
    
              ).success( function(data, status, headers, config){
                      
                console.log(data);
    
                $scope.recap_versement_me = data ;
    
                                        
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

  $scope.export_me = function(){

    console.log($scope.dt) ;
    
    $http.post('api/pompistes_export.php?action=Etats_Versements_ME',
    
              {
                'versement'    :  $scope.dt,
              }
  
    
              ).success( function(data, status, headers, config){
  
                console.log(data) ;
  
                if (data.status === 'OK') {
  
                  window.open(
                    '../src/api/etat_versements_me.'+$scope.dt.format, '_blank' 
                  );
  
                }
                      
                });
    
  }
  


  $scope.export_excel = function(){

    console.log($scope.dt) ;
    
    $http.post('api/pompistes_export.php?action=Etats_Versements_Excel',
    
              {
                'versement'    :  $scope.dt,
              }
  
    
              ).success( function(data, status, headers, config){
  
                console.log(data) ;
  
                if (data.status === 'OK') {
  
                  window.open(
                    '../src/api/DOCUMENTS/etat_versements.xlsx', '_blank' 
                  );
  
                }
                      
                });
    
  }
  
    
  
  }]);
  