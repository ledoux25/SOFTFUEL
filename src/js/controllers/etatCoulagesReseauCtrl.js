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

app.controller('etatCoulagesReseauCtrl', ['$scope', '$filter', '$http', '$localStorage',
  function($scope, $filter, $http, $localStorage){

    $scope.dt = {} ;
    $scope.recap_coulages = [] ;

    $scope.role = {};

    if ($localStorage.User.role == 'ADMINISTRATEUR') {
      $scope.role.user = 'ADMINISTRATEUR';
    } else {
      $scope.role.user = 'UTILISATEUR';
    }
    
   
    $scope.today = function() {

      $scope.dt.date_debut = new Date()
       
      $scope.dt.date_fin = new Date();

      $scope.dt.accueil = 0 ;

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




  $scope.station =  function(){

    $http.get('api/pompistes.php?action=get_station').success( function(data, status, headers, config){
          $scope.stations = data ;
          console.log(data);
      })
  
  };
  
  $scope.station_courante =  function(){
  
    $scope.stations = [{id_station:$localStorage.User.id, nom_station:$localStorage.User.nom, email_station:$localStorage.User.email}];
  
  };
  

$scope.coulages = function(){

  console.log($scope.dt);

 $http.post('api/pompistes.php?action=Etats_Coulages_Conso',

               {
                'coulages'    :  $scope.dt,
              }

            ).success( function(data, status, headers, config){
                    
              console.log(data);

              $scope.recap_coulages = data ;

                                      
              });

}

$scope.details_coulages = function(){

  console.log($scope.dt);

 $http.post('api/pompistes.php?action=Etats_Coulages_Reseau_Mensuel',

               {
                'coulages'    :  $scope.dt,
              }

            ).success( function(data, status, headers, config){
                    
              console.log(data);

              $scope.recap_coulages = data ;

                                      
              });

}

$scope.export_pdf = function(){


  $http.post('api/pompistes_export.php?action=Etats_Coulages_Reseau_Pdf',

               {
                'coulages'    :  $scope.recap_coulages,
                'date_debut'    :  $scope.dt.date_debut,
                'date_fin'    :  $scope.dt.date_fin,
              }

  ).success( function(data, status, headers, config){

    console.log(data) ;

    if (data.status === 'OK') {

      window.open(
        '../src/api/DOCUMENTS/details_coulages.pdf', '_blank' 
      );

    }
          
  //  window.location.href="../src/api/etat_ventes.pdf";
                            
    });



}

$scope.export_coulage_reseau = function(){


  $http.post('api/pompistes_export.php?action=coulage_Reseau_Carb_Pdf',

               {
                'coulages'    :  $scope.recap_coulages,
                'date_debut'    :  $scope.dt.date_debut,
                'date_fin'    :  $scope.dt.date_fin,
              }

  ).success( function(data, status, headers, config){

    console.log(data) ;

    if (data.status === 'OK') {

      window.open(
        '../src/api/DOCUMENTS/tableau_coulage_carb.pdf', '_blank'   
      );

    }
                                      
    });



}

$scope.export_excel = function(){
  console.log('totoz');
console.log($scope.recap_coulages);

  $http.post('api/pompistes_export.php?action=Etats_Coulages_Reseau_Excel',

               {
                'coulages'    :  $scope.recap_coulages,
              }

  ).success( function(data, status, headers, config){

    console.log(data) ;

    if (data.status === 'OK') {

      window.open(
        '../src/api/DOCUMENTS/details_coulages.xlsx', '_blank' 
      );

    }
          
  //  window.location.href="../src/api/etat_ventes.pdf";
                            
    });



}




    

}]);
