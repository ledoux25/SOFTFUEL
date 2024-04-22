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
  
  app.controller('etatVentesReseauCtrl', ['$scope', '$filter', '$http', '$localStorage',
  function($scope, $filter, $http, $localStorage){
  
    $scope.dt = {} ;
    $scope.dates = [] ;
    $scope.recap_ventesCarb = [] ;
    $scope.recap_ventesLub = [] ;
    $scope.recap_versement = [] ;
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
  
  console.log($scope.dt);
  
  $http.post('api/pompistes.php?action=Etats_Ventes_Reseau_Conso',
  
               {
                'ventes'    :  $scope.dt,
              }
  
            ).success( function(data, status, headers, config){
                    
              console.log(data);
  
              $scope.recap_ventesCarb = data ;
  
                                      
              });
  
  }

  $scope.export = function(){

    console.log($scope.dt) ;
    
    $http.post('api/pompistes_export.php?action=Etats_Ventes_Reseau_Conso',
    
              {
                'ventes'    :  $scope.dt,
              }
  
    
              ).success( function(data, status, headers, config){
  
                console.log(data) ;
  
                if (data.status === 'OK') {
  
                  window.open(
                    '../src/api/etat_ventes_conso.'+$scope.dt.format, '_blank' 
                  );
  
                }
                      
              //  window.location.href="../src/api/etat_ventes.pdf";
                                        
                });
    
  }


  $scope.export_ventes_conso_pdf = function(){


    $http.post('api/pompistes_export.php?action=Vente_Reseau_Carb_Pdf',
  
                 {
                  'coulages'    :  $scope.recap_ventesCarb,
                  'date_debut'    :  $scope.dt.date_debut,
                  'date_fin'    :  $scope.dt.date_fin,
                }
  
    ).success( function(data, status, headers, config){
  
      console.log(data) ;
  
      if (data.status === 'OK') {
  
        window.open(
          '../src/api/DOCUMENTS/tableau_vente_carb.pdf', '_blank' 
        );
  
      }
            
    //  window.location.href="../src/api/etat_ventes.pdf";
                              
      });
  
  
  
  }
  
  $scope.export_ventes_conso_excel = function(){


    $http.post('api/pompistes_export.php?action=Ventes_Conso_Excel',
  
                {
                  'ventes'    :  $scope.recap_ventesCarb,
                }
  
    ).success( function(data, status, headers, config){
  
      console.log(data) ;
  
      if (data.status === 'OK') {
  
        window.open(
          '../src/api/DOCUMENTS/ventes_conso_excel.xlsx', '_blank' 
        );
  
      }
            
    //  window.location.href="../src/api/etat_ventes.pdf";
                              
      });
  
  
  
  }
    
    
  
  }]);
  