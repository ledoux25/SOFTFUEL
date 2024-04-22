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

app.controller('etatVentesCtrl', ['$scope', '$filter', '$http', '$localStorage',
function($scope, $filter, $http, $localStorage){

  $scope.dt = {} ;
  $scope.dates = [] ;
  $scope.recap_ventesCarb = [] ;
  $scope.recap_ventesLub = [] ;
  $scope.recap_versement = [] ;
  $scope.recap = [] ;
  $scope.stations = [];


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

/**************************************************************************************************************** */

$scope.quarts = [{quart:'QUART 1'},{quart:'QUART 2'},{quart:'JOURNEE ENTIERE'}];

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

 $http.post('api/pompistes.php?action=Etats_Ventes',

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
  
  $http.post('api/pompistes_export.php?action=Etats_Ventes_Export',
  
            {
              'ventes'    :  $scope.dt,
            }

  
            ).success( function(data, status, headers, config){

              console.log(data) ;

              if (data.status === 'OK') {

                window.open(
                  '../src/api/etat_ventes.'+$scope.dt.format, '_blank' 
                );

              }
                    
            //  window.location.href="../src/api/etat_ventes.pdf";
                                      
              });
  
}

$scope.formats_export = [
  
  {nom_format:'PDF', format:'pdf', lien_export:''},
  {nom_format:'HTML', format:'html', lien_export:''},
  {nom_format:'WORD', format:'docx', lien_export:''},
  {nom_format:'EXCEL', format:'xls', lien_export:''},
  {nom_format:'POWERPOINT', format:'pptx', lien_export:''}
  
];



  

  

  

}]);
