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

app.controller('dashboardCtrl', ['$scope', '$filter', '$http','$localStorage',
function($scope, $filter, $http, $localStorage){


//  console.log($localStorage.User.role) ;

 $scope.stations = [];
 $scope.stat = "";
 $scope.role = {};
 $scope.dt = {} ;
 $scope.coulages = {} ;

 var date = new Date();

 $scope.dt.date_debut = new Date(date.getFullYear(), date.getMonth(), 1);
 $scope.dt.date_fin = new Date(date.getFullYear(), date.getMonth() + 1, 0);

 $scope.coulages.date_debut = $scope.dt.date_debut ;
 $scope.coulages.date_fin = $scope.dt.date_fin ;
 $scope.coulages.accueil = 1 ;

 console.log($scope.coulages);

 $scope.recap_coulages = [] ; 
 $scope.recap_coulages_reseau = [] ; 

 $scope.ventes = [] ; 
 $scope.ventes_reseau = [] ; 

 $scope.objectif_carburant_jour = $localStorage.User.objectif_carburant / 30 ;
 $scope.objectif_coulage_jour = 0 ;

 $scope.objectif_carburant_mois = $localStorage.User.objectif_carburant ;
 $scope.objectif_coulage_mois = 0 ;

 // console.log($scope.objectif_carburant_jour) ;

 $scope.pourcentage_carburant_jour = 0 ;
 $scope.pourcentage_coulage_jour = 0 ;

 $scope.pourcentage_carburant_mois = 0 ;
 $scope.pourcentage_coulage_mois = 0 ;

 $scope.objectif_carburant_reseau_jour = 0 ;
 $scope.objectif_coulage_reseau_jour = 0 ;

 $scope.objectif_carburant_reseau_mois = 0 ;
 $scope.objectif_coulage_reseau_mois = 0 ;

 $scope.pourcentage_carburant_reseau = 0 ;
 $scope.pourcentage_coulage_reseau = 0 ;

 $scope.pourcentage_carburant_reseau_jour = 0 ;
 $scope.pourcentage_coulage_reseau_jour = 0 ;

 $scope.objectif_coulage = 0 ;
 $scope.pourcentage_coulage = 0 ;

 $scope.objectif_carburant = 0 ;
 $scope.pourcentage_carburant = 0 ;

 $scope.realisation_ventes = 0 ;
 $scope.realisation_coulages = 0 ;
 
 $scope.repartition_ventes = [] ;
 $scope.repartition_coulages = [] ;

 $scope.regions = [] ;

 $scope.stat = $localStorage.User.nom_station ;

 $scope.station =  function(){

  $http.get('api/pompistes.php?action=get_station').success( function(data, status, headers, config){

        $scope.stations = data ;
        console.log(data);

        angular.forEach(data, function(value) {

          $scope.objectif_carburant_reseau_mois += parseInt(value.objectif_carburant) ;
    
        });
  })

   // console.log($scope.objectif_carburant_reseau) ;


};

 $scope.station() ;

 if ($localStorage.User.role == 'ADMINISTRATEUR') {

    $scope.role.user = 'ADMINISTRATEUR';
  } else {
    $scope.role.user = 'UTILISATEUR';
  }

  
  $scope.ventes_station = function(){


    $http.post('api/pompistes.php?action=Etats_Ventes_Station',
    
                  {
                  'ventes'    :  $scope.stat,
                }
    
              ).success( function(data, status, headers, config){
                      
                console.log(data);

                let regions = [] ;
    
                $scope.ventes = data ;
    
                $scope.objectif_carburant = $localStorage.User.objectif_carburant/30 ;
                $scope.pourcentage_carburant = ($scope.ventes[($scope.ventes.length-1)].tpc / $scope.objectif_carburant) * 100 ;
                
                console.log($scope.pourcentage_carburant_jour) ;

                angular.forEach($scope.ventes, function(value) {

                  regions.push(value.region) ;
                  

                });

                regions.splice(-1) ;

                var regions_unique = Array.from(new Set(regions)) ;


                angular.forEach(regions_unique, function(value) {

                  var obj = { label: value, data: 0} ;

                  angular.forEach($scope.ventes, function (value2) {

                    if (value == value2.region) {
                      
                      obj.data += value2.tpc ;
                    }

                    
                  });
                  
                  $scope.repartition_ventes.push(obj) ;

                });
    
                                        
      });
    
  }
    
  $scope.ventes_reseau = function(){


    $http.post('api/pompistes.php?action=Etats_Ventes_Reseau'


              ).success( function(data, status, headers, config){
                      
                console.log(data);
                var regions = [] ;
               

                $scope.ventes = data ;

                $scope.objectif_carburant = $scope.objectif_carburant_reseau_mois/30 ;
                $scope.pourcentage_carburant = ($scope.ventes[($scope.ventes.length-1)].tpc / $scope.objectif_carburant) * 100 ;

                angular.forEach($scope.ventes, function(value) {

                  regions.push(value.region) ;
                  

                });

                regions.splice(-1) ;

                var regions_unique = Array.from(new Set(regions)) ;


                angular.forEach(regions_unique, function(value) {

                  var obj = { label: value, data: 0} ;

                  angular.forEach($scope.ventes, function (value2) {

                    if (value == value2.region) {
                      
                      obj.data += value2.tpc ;
                    }

                    
                  });
                  
                  $scope.repartition_ventes.push(obj) ;

                });

                                        
    });

    console.log($scope.repartition_ventes) ;

  }
  
  
  $scope.ventes_station_mensuel = function(){
  
  
    $http.post('api/pompistes.php?action=Etats_Ventes_Station_Mensuel',
    
                  {
                   'ventes'    :  $scope.stat,
                 }
    
               ).success( function(data, status, headers, config){
                       
                 console.log(data);
    
                 $scope.ventes = data ;
    
                 $scope.pourcentage_carburant = ($scope.ventes[($scope.ventes.length-1)].tpc / $scope.objectif_carburant_mois) * 100 ;
                 
                 console.log($scope.pourcentage_carburant_mois) ;

                 angular.forEach($scope.ventes, function(value) {

                  regions.push(value.region) ;
                  

                });

                regions.splice(-1) ;

                var regions_unique = Array.from(new Set(regions)) ;


                angular.forEach(regions_unique, function(value) {

                  var obj = { label: value, data: 0} ;

                  angular.forEach($scope.ventes, function (value2) {

                    if (value == value2.region) {
                      
                      obj.data += value2.tpc ;
                    }

                    
                  });
                  
                  $scope.repartition_ventes.push(obj) ;

                });
    
                                         
      });
    
  }
  
  $scope.ventes_reseau_mensuel = function(){
  
  
    $http.post('api/pompistes.php?action=Etats_Ventes_Reseau_Mensuel'
  
  
              ).success( function(data, status, headers, config){
                      
                console.log(data);
  
                $scope.ventes = data ;
                $scope.objectif_carburant = $scope.objectif_carburant_reseau_mois ;
                $scope.pourcentage_carburant = ($scope.ventes[($scope.ventes.length-1)].tpc / $scope.objectif_carburant_reseau_mois) * 100 ;
  
                angular.forEach($scope.ventes, function(value) {

                  regions.push(value.region) ;
                  

                });

                regions.splice(-1) ;

                var regions_unique = Array.from(new Set(regions)) ;


                angular.forEach(regions_unique, function(value) {

                  var obj = { label: value, data: 0} ;

                  angular.forEach($scope.ventes, function (value2) {

                    if (value == value2.region) {
                      
                      obj.data += value2.tpc ;
                    }

                    
                  });
                  
                  $scope.repartition_ventes.push(obj) ;

                });
                
       });
  
  }
  
  $scope.coulages_station = function(){
  
  
  $http.post('api/pompistes.php?action=Etats_Coulages_Station',
  
               {
                'coulages'    :  $scope.stat,
               }
  
            ).success( function(data, status, headers, config){
                    
              console.log(data);

              let regions = [] ;
  
              $scope.recap_coulages = data ;
  
              $scope.objectif_coulage = $scope.ventes[($scope.ventes.length-1)].tpc * -0.02 ;
                
              $scope.pourcentage_coulage = ((data[(data.length-1)].cou + data[(data.length-2)].cou + data[(data.length-3)].cou) / ($scope.objectif_coulage)) * 100 ;

              $scope.color = ( ($scope.recap_coulages[($scope.recap_coulages.length-1)].cou + $scope.recap_coulages[($scope.recap_coulages.length-2)].cou + $scope.recap_coulages[($scope.recap_coulages.length-3)].cou) <= $scope.objectif_coulage ) ? $scope.app.color.danger : $scope.app.color.success ;
              

              angular.forEach($scope.recap_coulages, function(value) {

                if (! (value.si == '')) {
                  
                  regions.push(value.region) ;

                }
                

              });

              regions.splice(-3) ;

              var regions_unique = Array.from(new Set(regions)) ;


              angular.forEach(regions_unique, function(value) {

                var obj = { label: value, data: 0} ;

                angular.forEach($scope.recap_coulages, function (value2) {

                  if (value == value2.region) {
                    
                    obj.data += value2.cou ;
                  }

                  
                });
                
                $scope.repartition_coulages.push(obj) ;

              });

                                      
      });
  
  }
  
  $scope.coulages_reseau = function(){
  
  
  $http.post('api/pompistes.php?action=Etats_Coulages_Reseau'
  
  
             ).success( function(data, status, headers, config){
                     
               console.log(data);

               var regions = [] ;
  
               $scope.recap_coulages = data ;
  
               $scope.objectif_coulage = $scope.ventes[($scope.ventes.length-1)].tpc * -0.02 ;
                
               $scope.pourcentage_coulage = (($scope.recap_coulages[($scope.recap_coulages.length-1)].cou + $scope.recap_coulages[($scope.recap_coulages.length-2)].cou + $scope.recap_coulages[($scope.recap_coulages.length-3)].cou) / ($scope.objectif_coulage)) * 100 ;

               $scope.color = ( ($scope.recap_coulages[($scope.recap_coulages.length-1)].cou + $scope.recap_coulages[($scope.recap_coulages.length-2)].cou + $scope.recap_coulages[($scope.recap_coulages.length-3)].cou) <= $scope.objectif_coulage ) ? $scope.app.color.danger : $scope.app.color.success ;


               angular.forEach($scope.recap_coulages, function(value) {

                if (! (value.si == '')) {
                  
                  regions.push(value.region) ;

                }
                

              });

              regions.splice(-3) ;

              var regions_unique = Array.from(new Set(regions)) ;


              angular.forEach(regions_unique, function(value) {

                var obj = { label: value, data: 0} ;

                angular.forEach($scope.recap_coulages, function (value2) {

                  if (value == value2.region) {
                    
                    obj.data += value2.cou ;
                  }

                  
                });
                
                $scope.repartition_coulages.push(obj) ;

              });

              console.log($scope.repartition_coulages) ;
                                       
      });
  
  }
  
  $scope.coulages_station_mensuel = function(){
  
  
    $http.post('api/pompistes.php?action=Etats_Coulages_Station_Mensuel',
    
                 {
                  'coulages'    :  $scope.stat,
                }
    
              ).success( function(data, status, headers, config){
                      
                console.log(data);
    
                $scope.recap_coulages = data ;
    
                $scope.objectif_coulage = $scope.ventes[($scope.ventes.length-1)].tpc * -0.02 ;
                  
                $scope.pourcentage_coulage = ((data[(data.length-1)].cou + data[(data.length-2)].cou + data[(data.length-3)].cou) / ($scope.objectif_coulage)) * 100 ;

                $scope.color = ( ($scope.recap_coulages[($scope.recap_coulages.length-1)].cou + $scope.recap_coulages[($scope.recap_coulages.length-2)].cou + $scope.recap_coulages[($scope.recap_coulages.length-3)].cou) <= $scope.objectif_coulage ) ? $scope.app.color.danger : $scope.app.color.success ;
    
                                        
                });
    
  }
    
  $scope.coulages_reseau_mensuel = function(){
  
  
  $http.post('api/pompistes.php?action=Etats_Coulages_Reseau_Mensuel',

            {
              'coulages'    :  $scope.coulages,
            }
  
  
              ).success( function(data, status, headers, config){
                      
                console.log(data);

                var regions = [];
  
                $scope.recap_coulages = data ;
  
                $scope.objectif_coulage = $scope.ventes[($scope.ventes.length-1)].tpc * -0.02 ;
                
                $scope.pourcentage_coulage = (($scope.recap_coulages[($scope.recap_coulages.length-1)].cou + $scope.recap_coulages[($scope.recap_coulages.length-2)].cou + $scope.recap_coulages[($scope.recap_coulages.length-3)].cou) / ($scope.objectif_coulage)) * 100 ;
 
                $scope.color = ( ($scope.recap_coulages[($scope.recap_coulages.length-1)].cou + $scope.recap_coulages[($scope.recap_coulages.length-2)].cou + $scope.recap_coulages[($scope.recap_coulages.length-3)].cou) <= $scope.objectif_coulage ) ? $scope.app.color.danger : $scope.app.color.success ;


                angular.forEach($scope.recap_coulages, function(value) {

                  if (! (value.si == '')) {
                    
                    regions.push(value.region) ;
  
                  }
                  
  
                });
  
                regions.splice(-3) ;
  
                var regions_unique = Array.from(new Set(regions)) ;
  
  
                angular.forEach(regions_unique, function(value) {
  
                  var obj = { label: value, data: 0} ;
  
                  angular.forEach($scope.recap_coulages, function (value2) {
  
                    if (value == value2.region) {
                      
                      obj.data += value2.cou ;
                    }
  
                    
                  });
                  
                  $scope.repartition_coulages.push(obj) ;
  
                });
  
                                        
    });
  
  }
  
// console.log($scope.role.user) ;

  $scope.jour = function() {

  
    if ($localStorage.User.role == 'ADMINISTRATEUR') {

      $scope.ventes_reseau() ;
      $scope.coulages_reseau() ;
      
    } 

    else {

      $scope.ventes_station() ;
      $scope.coulages_station() ;
    }
   
  } 
 
  $scope.mois = function() {

    console.log($localStorage.User.role) ;

    if ($localStorage.User.role == 'ADMINISTRATEUR') {

      $scope.ventes_reseau_mensuel() ;
      $scope.coulages_reseau_mensuel() ;
      
    } 
    
    else {

      $scope.ventes_station_mensuel() ;
      $scope.coulages_station_mensuel() ;
    
    }
    
  }
  
  $scope.annee = function() {

      if ($scope.role.user = 'ADMINISTRATEUR') {
          
      } else {
        
      }
      
  }

  
  $scope.station_courante =  function(){
  
    $scope.stations = [{id_station:$localStorage.User.id, nom_station:$localStorage.User.nom, email_station:$localStorage.User.email}];
  
  };


/***************************************************************************************************************/      

  

}]);
